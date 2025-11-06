<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\OpenAI\Entities\FeaturePreference;

class CheckDocChatFile implements Rule
{
    protected $errorMessage;
    private $size = 0;

    public function __construct()
    {
        $docChat = FeaturePreference::whereSlug('ai_doc_chat')->first();

        if ($docChat && $docChat->settings) {
            $restrictions = json_decode($docChat->settings, true);
            
            $this->size = $restrictions['file_size'];
        }
    }

    public function passes($attribute, $value)
    {
        foreach ($value as $file) {
            $fileSize = $file->getSize() / (1024 * 1024);
            // Check each file size
            if ($fileSize > $this->size) {
                $this->errorMessage = __("Each file must not exceed :x MB.", ['x' => $this->size]);
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return $this->errorMessage ?: __('The uploaded file does not meet the required standards. Please check the file size, and try again.');
    }
}
