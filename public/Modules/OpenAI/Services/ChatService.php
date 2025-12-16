<?php

/**
 * @package ChatService
 * @author TechVillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 30-05-2023
 */

namespace Modules\OpenAI\Services;

use App\Lib\Env;

use Infoamin\Installer\Helpers\PermissionsChecker;

class ChatService
{

    /**
     * Ai key
     *
     * @var string
     */
    protected $aiKey = false;

    /**
     * get Api Key
     *
     * @param string|null $keyName
     * @return string
     */
    public function aiKey($keyName = 'openai'): string
    {
        if (!config('aiKeys.' . strtoupper($keyName) . '.API_KEY')) {
            $this->envKey($keyName);
            return $this->aiKey;
        } else {
            return config('aiKeys.' . strtoupper($keyName) . '.API_KEY');
        }
    }

    /**
     * Set Ai key from preference to.env file
     *
     * @param string $keyName
     * @return void
     */
    public function envKey($keyName): void
    { 
        if (!is_null(preference($keyName))) {
            $preferenceAiKey = preference($keyName);
        } else {
            $preferenceAiKey = preference($keyName.'_api');
        }
        $checker = new PermissionsChecker;
        $permissions = $checker->checkPermission([".env" => 666]);
        if ($permissions['permissions'][0]['isActive'] == true) {
            Env::set(strtoupper($keyName), $preferenceAiKey ? $preferenceAiKey : false);
            $this->aiKey = $preferenceAiKey ?? false;
        }else {
            $this->aiKey = false;
        }
    }
}
