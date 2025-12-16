<?php

namespace Modules\MarketingBot\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\MarketingBot\Entities\Template;
use Modules\MarketingBot\Responses\ChannelResponse;
use Modules\MarketingBot\Contract\Resources\TemplateContract;
use ChannelManager;

class TemplateService
{
    /**
     * Sync templates from the channel API.
     *
     * @param string $channel The channel name (e.g., 'whatsapp').
     * @param int|null $userId The user ID. If null, uses authenticated user.
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws Exception
     */
    public function syncTemplates(string $channel, ?int $userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        if (!$userId) {
            throw new Exception(__('User not found.'));
        }

        // Get the channel manager instance
        $channelInstance = ChannelManager::isActive($channel, $userId);
        
        if (!$channelInstance) {
            throw new Exception(__('Channel not found or not active.'));
        }

        try {
            // Get template handler from manager
            if (!method_exists($channelInstance, 'getTemplateHandler')) {
                throw new Exception(__('Channel does not support template operations.'));
            }

            $handler = $channelInstance->getTemplateHandler();

            if (!$handler instanceof TemplateContract) {
                throw new Exception(__('Channel does not support template fetching.'));
            }

            $response = $handler->fetchTemplates($userId);

            if (!$response instanceof ChannelResponse) {
                throw new Exception(__('Invalid response from channel API.'));
            }

            if ($response->failed()) {
                $error = $response->getError();
                $message = $error['message'] ?? $response->getMessage();
                throw new Exception($message);
            }

            $templatesData = $response->getData();
            
            if (!isset($templatesData['data']) || !is_array($templatesData['data'])) {
                throw new Exception(__('Invalid template data received from channel.'));
            }

            DB::beginTransaction();

            // Get existing template IDs (check original_template_id column directly)
            $templateIds = Template::where('user_id', $userId)
                ->get()
                ->flatMap->originalTemplateIds()
                ->toArray();

            // Process each template from API
            foreach ($templatesData['data'] as $res) {
                // Skip if template already exists
                if (in_array($res['id'], $templateIds)) {
                    continue;
                }

                $template = new Template();
                $template->user_id = $userId;
                $template->channel = lcfirst($channel);
                $template->title = $res['name'] ?? '';
                $template->language = $res['language'] ?? 'en_US';
                $template->status = $res['status'] ?? '';
                $template->category = $res['category'] ?? '';
                $template->original_template_id = $res['id'];
                $template->parameter_format = $res['parameter_format'] ?? null;
                $template->components = json_encode($res['components'] ?? []);
                $template->save();
            }

            DB::commit();

            return Template::with('metas')->where('user_id', $userId);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete a template.
     *
     * @param int $templateId The template ID.
     * @param string $channel The channel name.
     * @param int|null $userId The user ID. If null, uses authenticated user.
     * @return bool
     * @throws Exception
     */
    public function deleteTemplate(int $templateId, string $channel, ?int $userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        if (!$userId) {
            throw new Exception(__('User not found.'));
        }

        try {
            // Find the template
            $template = Template::where('id', $templateId)
                ->where('user_id', $userId)
                ->firstOrFail();

            // Get the channel manager instance
            $channelInstance = ChannelManager::isActive($channel, $userId);
            
            if (!$channelInstance) {
                throw new Exception(__('Channel not found or not active.'));
            }

            // Get template handler from manager
            if (!method_exists($channelInstance, 'getTemplateHandler')) {
                throw new Exception(__('Channel does not support template operations.'));
            }

            $handler = $channelInstance->getTemplateHandler();

            if (!$handler instanceof TemplateContract) {
                throw new Exception(__('Channel does not support template deletion.'));
            }

            $response = $handler->deleteTemplate($template->title, $userId);

            if (!$response instanceof ChannelResponse) {
                throw new Exception(__('Invalid response from channel API.'));
            }

            if ($response->failed()) {
                $error = $response->getError();
                $errorMessage = $error['error_user_msg'] ?? $error['message'] ?? $response->getMessage();
                throw new Exception($errorMessage);
            }

            // Delete from database
            return $template->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

