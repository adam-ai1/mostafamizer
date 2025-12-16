<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckChannelEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $channel  The channel to check (whatsapp|telegram)
     */
    public function handle(Request $request, Closure $next, string $channel): Response
    {
        // Get marketing bot channel preferences
        $channelPreferences = $this->getChannelPreferences();

        // Check if the requested channel is enabled
        $channelKey = $channel . '_enabled';
        if (!isset($channelPreferences[$channelKey]) || !$channelPreferences[$channelKey]) {
            abort(403, ucfirst($channel) . ' channel is not enabled.');
        }

        return $next($request);
    }

    /**
     * Get marketing bot channel preferences
     *
     * @return array
     */
    private function getChannelPreferences(): array
    {
        $marketingBotPreference = \Modules\OpenAI\Entities\FeaturePreference::where('slug', 'marketing-bot')
            ->with('metas')
            ->first();

        $whatsappEnabled = false;
        $telegramEnabled = false;

        if ($marketingBotPreference) {
            $generalOptionsMeta = $marketingBotPreference->metas->where('key', 'general_options')->first();
            if ($generalOptionsMeta) {
                $generalOptions = json_decode($generalOptionsMeta->value, true);
                $whatsappEnabled = isset($generalOptions['whatsapp']) && $generalOptions['whatsapp'] === 'on';
                $telegramEnabled = isset($generalOptions['telegram']) && $generalOptions['telegram'] === 'on';
            }
        }

        return [
            'whatsapp_enabled' => $whatsappEnabled,
            'telegram_enabled' => $telegramEnabled,
        ];
    }
}
