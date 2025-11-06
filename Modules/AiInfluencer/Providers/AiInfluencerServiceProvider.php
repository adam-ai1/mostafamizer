<?php

namespace Modules\AiInfluencer\Providers;

use App\Facades\AiProviderManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class AiInfluencerServiceProvider extends ServiceProvider
{
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $providers = [
            [
                "provider" => \Modules\AiInfluencer\VizardProvider::class,
                "alias" => "vizard",
                "credentials" => [
                    'api_key' => ['env' => 'VIZARD', 'label' => "Vizard"],
                ]
            ],
            [
                "provider" => \Modules\AiInfluencer\CreatifyProvider::class,
                "alias" => "creatify",
                "credentials" => [
                    'api_key' => ['env' => 'CREATIFY', 'label' => "CREATIFY"],
                    'api_id' => ['env' => 'CREATIFY_API_ID', 'label' => __(":x API ID", ["x" => "CREATIFY"])],
                ]
            ],
            [
                "provider" => \Modules\AiInfluencer\KlapProvider::class,
                "alias" => "klap",
                "credentials" => [
                    'api_key' => ['env' => 'KLAP', 'label' => 'Klap'],
                ]
            ],
            [
                "provider" => \Modules\AiInfluencer\TopViewProvider::class,
                "alias" => "topview",
                "credentials" => [
                    'api_key' => ['env' => 'TOPVIEW', 'label' => __('Top View')],
                    'api_id' => ['env' => 'TOPVIEW_API_ID', 'label' => __(":x API ID", ["x" => "Top View"])],
                ]
            ]
        ];

        foreach ($providers as $config) {
            AiProviderManager::add($config['provider'], $config['alias']);

            foreach ($config['credentials'] as $credType => $credConfig) {
                \Config::set("aiKeys.{$credConfig['env']}.API_KEY", env($credConfig['env'], false));
                
                add_action('before_provider_api_key_section_retrived', function() use ($config, $credType, $credConfig) {
                    $fieldName = $credType === 'api_key' ? $config['alias'] : "{$config['alias']}_{$credType}";
                    $demoValue = config("openAI.is_demo") ? "sk-xxxxxxxxxxxxxxx" : config("aiKeys.{$credConfig['env']}.API_KEY");
                    
                    echo sprintf(
                        '<div class="form-group row">
                            <label class="col-sm-3 control-label text-left">%s</label>
                            <div class="col-sm-8">
                                <input type="text" value="%s" class="form-control inputFieldDesign" name="apiKey[%s]" id="%s_key">
                            </div>
                        </div>',
                        $credType === 'api_key' ? __(":x API Key", ["x" => $credConfig['label']]) : $credConfig['label'],
                        htmlspecialchars($demoValue),
                        $fieldName,
                        $fieldName
                    );
                });
            }
        }

        add_filter('modify_feature_data', function ($features) {
            $data = [
                [
                    'id' => 'ai_shorts',
                    'name' => __('Ai Shorts'),
                    'description' => __('Generate comprehensive, well-structured long-form content and articles.'),
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="24" height="24">
                        <defs>
                            <linearGradient id="gradient64" x1="4" x2="60" y1="31.928" y2="31.928" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="' .  (activeMenu(route('user.ai-shorts.template'))['color1'] ?? '#141414') . '"/>
                            <stop offset="1" stop-color="' .  (activeMenu(route('user.ai-shorts.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                        </defs>
                        <path fill="url(#gradient64)" d="M32 4A28.03 28.03 0 0 0 4 32c1.537 37.146 54.469 37.135 56 0A28.03 28.03 0 0 0 32 4zm8.86 30.6-14.72 8.5a3.02 3.02 0 0 1-4.5-2.6v-17a3 3 0 0 1 4.5-2.6l14.72 8.5a3.02 3.02 0 0 1 0 5.2zm-.5-2.6a.994.994 0 0 1-.5.87l-14.72 8.5a1 1 0 0 1-1.5-.87v-17a.997.997 0 0 1 .5-.87 1.047 1.047 0 0 1 1 0l14.72 8.5a.994.994 0 0 1 .5.87z"/>
                    </svg>',
                    'access' => hasAccess('ai_shorts') && customerPanelAccess('video'),
                    'route' => route('user.ai-shorts.template'),
                    'menu' => activeMenu(route('user.ai-shorts.template')),
                    'settings' => [
                        'toggle_id' => 'hide_ai_shorts',
                        'label' => __('Disable Ai Shorts'),
                        'description' => __('Toggle to enable or disable support for ai shorts.'),
                    ],
                    'type' => 'feature'
                ],
                [
                    'id' => 'url_to_video',
                    'name' => __('Url To Video'),
                    'description' => __('Convert url to video'),
                    'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.119 15.3232C21.9289 13.9463 19.9924 13.9463 18.8024 15.3232C18.5639 15.5991 18.5639 16.0461 18.8024 16.3219C19.0409 16.5978 19.4273 16.5979 19.6658 16.3219C20.3797 15.496 21.5418 15.496 22.2556 16.3219C22.962 17.1392 22.9613 18.5024 22.2556 19.3188C22.1989 19.3844 22.154 19.4623 22.1233 19.5479C22.0926 19.6336 22.0768 19.7255 22.0768 19.8182C22.0768 19.911 22.0926 20.0028 22.1233 20.0885C22.154 20.1742 22.1989 20.252 22.2556 20.3176C22.4915 20.5905 22.8836 20.59 23.119 20.3176C24.2942 18.958 24.293 16.6805 23.119 15.3232Z" fill="url(#paint0_linear_25479_1247)"/>
                        <path d="M19.9536 21.9818C19.2612 22.783 18.0549 22.783 17.3633 21.9818C16.6494 21.1556 16.6494 19.8119 17.3633 18.9856C17.6018 18.7096 17.6018 18.2627 17.3633 17.9867C17.1248 17.7108 16.7384 17.7108 16.4999 17.9867C15.3099 19.3636 15.3099 21.6039 16.4999 22.9807C17.6753 24.3406 19.6433 24.3384 20.8168 22.9807C21.0553 22.7047 21.0553 22.2579 20.8168 21.9819C20.5783 21.706 20.1921 21.706 19.9536 21.9819V21.9818Z" fill="url(#paint1_linear_25479_1247)"/>
                        <path d="M20.5293 17.3197L18.2267 19.9836C18.17 20.0492 18.125 20.1271 18.0943 20.2127C18.0636 20.2984 18.0479 20.3903 18.0479 20.483C18.0479 20.5758 18.0636 20.6676 18.0943 20.7533C18.125 20.839 18.17 20.9168 18.2267 20.9824C18.4534 21.2448 18.8543 21.2552 19.09 20.9824L21.3926 18.3185C21.6311 18.0426 21.6311 17.5957 21.3926 17.3197C21.1541 17.0438 20.7677 17.0438 20.5292 17.3197H20.5293Z" fill="url(#paint2_linear_25479_1247)"/>
                        <path d="M13.8546 18.8356H2.23855C1.67728 18.8356 1.22103 18.3076 1.22103 17.6584V9.1824C1.22103 8.79251 0.947516 8.47607 0.610513 8.47607C0.27351 8.47607 0 8.79251 0 9.1824V17.6584C0 19.0867 1.00442 20.2482 2.23855 20.2482H13.8546C14.1916 20.2482 14.4651 19.9318 14.4651 19.5419C14.4651 19.152 14.1916 18.8356 13.8546 18.8356Z" fill="url(#paint3_linear_25479_1247)"/>
                        <path d="M0.610513 7.06329H17.7049C18.0419 7.06329 18.3154 6.74686 18.3154 6.35696C18.3154 5.96707 18.0419 5.65064 17.7049 5.65064H1.22103V2.58987C1.22103 1.94052 1.67728 1.41266 2.23855 1.41266H18.5189C19.0801 1.41266 19.5364 1.94052 19.5364 2.58987V12.2619C19.5364 12.6518 19.8099 12.9682 20.1469 12.9682C20.4839 12.9682 20.7574 12.6518 20.7574 12.2619V2.58987C20.7574 1.16205 19.7534 0 18.5189 0H2.23855C1.00401 0 0 1.16205 0 2.58987V6.35696C0 6.74686 0.27351 7.06329 0.610513 7.06329Z" fill="url(#paint4_linear_25479_1247)"/>
                        <path d="M3.05265 4.23785C3.38983 4.23785 3.66316 3.92162 3.66316 3.53152C3.66316 3.14143 3.38983 2.8252 3.05265 2.8252C2.71547 2.8252 2.44214 3.14143 2.44214 3.53152C2.44214 3.92162 2.71547 4.23785 3.05265 4.23785Z" fill="url(#paint5_linear_25479_1247)"/>
                        <path d="M5.49455 4.23785C5.83172 4.23785 6.10506 3.92162 6.10506 3.53152C6.10506 3.14143 5.83172 2.8252 5.49455 2.8252C5.15737 2.8252 4.88403 3.14143 4.88403 3.53152C4.88403 3.92162 5.15737 4.23785 5.49455 4.23785Z" fill="url(#paint6_linear_25479_1247)"/>
                        <path d="M7.93668 4.23785C8.27386 4.23785 8.5472 3.92162 8.5472 3.53152C8.5472 3.14143 8.27386 2.8252 7.93668 2.8252C7.59951 2.8252 7.32617 3.14143 7.32617 3.53152C7.32617 3.92162 7.59951 4.23785 7.93668 4.23785Z" fill="url(#paint7_linear_25479_1247)"/>
                        <path d="M14.4486 2.8252C13.6735 2.8252 13.657 4.23785 14.4486 4.23785H17.7047C18.4715 4.23785 18.4982 2.8252 17.7047 2.8252H14.4486Z" fill="url(#paint8_linear_25479_1247)"/>
                        <path d="M9.93711 9.61136C9.00799 8.87433 7.70654 9.67258 7.70654 10.9707V14.9291C7.70654 16.2106 9.00449 17.0278 9.93711 16.2884L12.4317 14.3092C13.2362 13.6709 13.2343 12.2271 12.4321 11.5906L9.93711 9.61136ZM11.7412 13.144L9.24626 15.1232C9.11194 15.2303 8.92757 15.1153 8.92757 14.9292V10.9706C8.92757 10.7898 9.11723 10.6731 9.24634 10.7766L11.7418 12.7559C11.859 12.8489 11.8577 13.0523 11.7412 13.144Z" fill="url(#paint9_linear_25479_1247)"/>
                        <defs>
                            <linearGradient id="paint0_linear_25479_1247" x1="-0.134474" y1="17.4063" x2="23.1578" y2="17.4063" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear_25479_1247" x1="-0.134424" y1="20.8898" x2="23.1579" y2="20.8898" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint2_linear_25479_1247" x1="-0.134267" y1="19.1479" x2="23.158" y2="19.1479" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint3_linear_25479_1247" x1="-0.134231" y1="14.3622" x2="23.1581" y2="14.3622" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint4_linear_25479_1247" x1="-0.134231" y1="6.4841" x2="23.1581" y2="6.4841" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint5_linear_25479_1247" x1="3.05265" y1="2.8252" x2="3.05265" y2="4.23785" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint6_linear_25479_1247" x1="5.49455" y1="2.8252" x2="5.49455" y2="4.23785" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint7_linear_25479_1247" x1="7.93668" y1="2.8252" x2="7.93668" y2="4.23785" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint8_linear_25479_1247" x1="13.8611" y1="3.53152" x2="18.2899" y2="3.53152" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                            <linearGradient id="paint9_linear_25479_1247" x1="-0.134233" y1="12.9491" x2="23.1581" y2="12.9491" gradientUnits="userSpaceOnUse">
                                <stop stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color1'] ?? '#141414') . '"/>
                                <stop offset="1" stop-color="' .  (activeMenu(route('user.url-to-video.template'))['color2'] ?? '#141414') . '"/>
                            </linearGradient>
                        </defs>
                    </svg>',
                    'access' => hasAccess('url_to_video') && customerPanelAccess('video'),
                    'route' => route('user.url-to-video.template'),
                    'menu' => activeMenu(route('user.url-to-video.template')),
                    'settings' => [
                        'toggle_id' => 'hide_url_to_video',
                        'label' => __('Disable Url To Video'),
                        'description' => __('Toggle to enable or disable support for url to video.'),
                    ],
                    'type' => 'feature'
                ],
                [
                    'id' => 'influencer_avatar',
                    'name' => __('Influencer Avatar'),
                    'description' => __('Add an avatar to your influencer profile.'),
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve" fill-rule="evenodd" class="">
                        <g>
                            <linearGradient id="a_122" x1="0" x2="1" y1="0" y2="0" gradientTransform="rotate(-43.421 617.019 246.743) scale(704.86)" gradientUnits="userSpaceOnUse">
                            <stop stop-opacity="1" stop-color="' .  (activeMenu(route('user.influencer-avatar.template'))['color1'] ?? '#141414') . '" offset="0"></stop>
                            <stop stop-opacity="1" stop-color="' .  (activeMenu(route('user.influencer-avatar.template'))['color2'] ?? '#141414') . '" offset="1"></stop>
                            </linearGradient>
                            <path fill="url(#a_122)" d="M48.73 231.554C23.704 216.288 7 188.732 7 157.269c0-48.029 38.926-86.954 86.954-86.954 31.463 0 59.019 16.704 74.285 41.729 16.349-4.932 33.682-7.584 51.63-7.584 20.024 0 39.284 3.302 57.265 9.387 16.834-20.188 30.461-43.683 42.905-65.295.068-.136.141-.272.218-.405 1.575-2.739 3.142-5.445 4.691-8.11 1.791-3.094 3.562-6.133 5.32-9.1l.021-.034c4.202-7.075 11.211-11.037 19.396-10.979 8.183.057 15.165 4.114 19.248 11.186l26.174 45.336c16.015-5.644 34.278.723 43.076 15.961s5.18 34.238-7.715 45.285l26.175 45.336c4.203 7.281 4.101 15.631-.255 22.798-4.35 7.156-11.636 11.092-20.036 10.761h-.018c-3.417-.133-6.849-.269-10.291-.392-13.36-.456-26.907-.675-40.499-.124 8.413 20.726 13.049 43.382 13.049 67.113 0 17.947-2.653 35.281-7.585 51.629 25.025 15.266 41.73 42.823 41.73 74.285 0 48.029-38.926 86.955-86.954 86.955-31.463 0-59.02-16.705-74.286-41.73-16.348 4.932-33.681 7.585-51.629 7.585s-35.281-2.653-51.63-7.585c-15.266 25.025-42.822 41.73-74.285 41.73C45.926 496.053 7 457.127 7 409.098c0-31.462 16.704-59.019 41.73-74.285-4.933-16.348-7.585-33.682-7.585-51.629 0-17.948 2.652-35.281 7.585-51.63zm126.628-104.923c3.588 9.529 5.55 19.854 5.55 30.638 0 48.028-38.925 86.954-86.954 86.954-10.784 0-21.109-1.963-30.638-5.55-4.02 14.149-6.171 29.08-6.171 44.511 0 15.43 2.151 30.362 6.171 44.51 9.529-3.587 19.854-5.55 30.638-5.55 48.029 0 86.954 38.926 86.954 86.954 0 10.785-1.962 21.11-5.55 30.638 14.149 4.021 29.081 6.172 44.511 6.172s30.362-2.151 44.51-6.172c-3.587-9.528-5.549-19.853-5.549-30.638 0-48.028 38.925-86.954 86.954-86.954 10.784 0 21.109 1.963 30.638 5.55 4.02-14.148 6.171-29.08 6.171-44.51 0-23.487-4.985-45.819-13.957-65.993-15.483 1.459-30.949 4.201-46.193 9.013l38.347 66.419a8 8 0 0 1-2.928 10.928l-7.891 4.556c-16.219 9.364-37.114 3.766-46.478-12.453l-26.187-45.357-5.737 3.313c-26.382 15.232-60.414 6.081-75.624-20.264s-6.119-60.393 20.263-75.625l42.383-24.47a167.038 167.038 0 0 0 6.692-6.36c-14.416-4.188-29.655-6.431-45.414-6.431-15.43 0-30.362 2.151-44.511 6.171zM327.154 68.07c-14.994 25.526-31.996 52.385-53.727 73.235l40.839 70.736c29.265-9.789 59.344-12.264 88.93-12.264zm76.214 22.683 18.84 32.632c5.352-6.253 6.469-15.444 2.119-22.978s-12.867-11.162-20.959-9.654zm33.603 109.846h.006c2.407.095 4.493-1.034 5.739-3.084 1.239-2.039 1.266-4.415.07-6.487L355.077 39.11c-1.167-2.02-3.167-3.17-5.505-3.187-2.332-.016-4.321 1.127-5.521 3.14l-.005.01c-2.481 4.223-5.031 8.59-7.618 13.06l85.397 147.913c2.381.073 4.757.157 7.128.245 2.68.095 5.353.199 8.018.308zm-176.597-49.902-36.166 20.881c-18.757 10.83-25.221 35.037-14.407 53.768s35.011 25.237 53.768 14.407l36.166-20.88zm30.789 91.6 26.186 45.357c4.961 8.592 16.03 11.558 24.622 6.597l.963-.556-35.199-60.966zm113.409 206.547c7.68-11.339 12.166-25.018 12.166-39.746 0-39.191-31.763-70.954-70.954-70.954s-70.954 31.763-70.954 70.954c0 14.728 4.485 28.407 12.165 39.746 6.083-15.529 18.136-28.063 33.332-34.774-6.438-6.494-10.427-15.419-10.427-25.233 0-19.742 16.142-35.883 35.884-35.883s35.883 16.141 35.883 35.883c0 9.814-3.989 18.739-10.427 25.233 15.196 6.711 27.249 19.245 33.332 34.774zm-105.056 14.053c12.422 10.692 28.589 17.156 46.268 17.156 17.678 0 33.845-6.464 46.267-17.156-4.181-21.746-23.313-38.177-46.267-38.177-22.955 0-42.086 16.431-46.268 38.177zm46.268-54.177c10.939 0 19.883-8.944 19.883-19.883s-8.944-19.883-19.883-19.883c-10.94 0-19.884 8.944-19.884 19.883s8.944 19.883 19.884 19.883zm-193.042 40.124c7.68-11.339 12.166-25.018 12.166-39.746 0-39.191-31.763-70.954-70.954-70.954S23 369.907 23 409.098c0 14.728 4.486 28.407 12.166 39.746 6.083-15.529 18.135-28.063 33.331-34.774-6.437-6.494-10.426-15.419-10.426-25.233 0-19.742 16.141-35.883 35.883-35.883s35.883 16.141 35.883 35.883c0 9.814-3.989 18.739-10.426 25.233 15.196 6.711 27.249 19.245 33.331 34.774zM47.687 462.897c12.422 10.692 28.589 17.156 46.267 17.156 17.679 0 33.846-6.464 46.268-17.156-4.182-21.746-23.313-38.177-46.268-38.177s-42.086 16.431-46.267 38.177zm46.267-54.177c10.939 0 19.883-8.944 19.883-19.883s-8.944-19.883-19.883-19.883-19.883 8.944-19.883 19.883 8.944 19.883 19.883 19.883zm58.788-211.706c7.68-11.338 12.166-25.017 12.166-39.745 0-39.191-31.763-70.954-70.954-70.954S23 118.078 23 157.269c0 14.728 4.486 28.407 12.166 39.745 6.083-15.528 18.135-28.063 33.331-34.774-6.437-6.494-10.426-15.418-10.426-25.232 0-19.742 16.141-35.883 35.883-35.883s35.883 16.141 35.883 35.883c0 9.814-3.989 18.738-10.426 25.232 15.196 6.711 27.249 19.246 33.331 34.774zM47.687 211.067c12.422 10.693 28.589 17.156 46.267 17.156 17.679 0 33.846-6.463 46.268-17.156-4.182-21.746-23.313-38.176-46.268-38.176s-42.086 16.43-46.267 38.176zm46.267-54.176c10.939 0 19.883-8.944 19.883-19.883s-8.944-19.883-19.883-19.883-19.883 8.944-19.883 19.883 8.944 19.883 19.883 19.883zM430.591 50.194a8.004 8.004 0 0 1-9.798 5.657c-4.265-1.143-6.8-5.534-5.657-9.798l7.014-26.176a8.003 8.003 0 0 1 9.797-5.657 8.004 8.004 0 0 1 5.657 9.798zm36.137 85.604c-4.264-1.147-6.795-5.54-5.648-9.803a8.004 8.004 0 0 1 9.804-5.648l26.194 7.047c4.264 1.146 6.794 5.539 5.647 9.803s-5.539 6.794-9.803 5.647zm-.352-50.257c-3.824 2.207-8.721.895-10.928-2.928a8.004 8.004 0 0 1 2.928-10.929l23.512-13.574c3.824-2.208 8.72-.896 10.928 2.928s.896 8.721-2.928 10.928z" opacity="1" data-original="url(#a_122)" class=""></path>
                        </g>
                    </svg>',
                    'access' => hasAccess('influencer_avatar') && customerPanelAccess('video'),
                    'route' => route('user.influencer-avatar.template'),
                    'menu' => activeMenu(route('user.influencer-avatar.template')),
                    'settings' => [
                        'toggle_id' => 'hide_influencer_avatar',
                        'label' => __('Disable Influencer Avatar'),
                        'description' => __('Toggle to enable or disable support for Influencer Avatar.'),
                    ],
                    'type' => 'feature'
                ]
            ];
            return array_merge($features, $data);
        });

        // for gallery only
        add_filter('modify_gallery_data', function ($types) {

            $data = [
                'aishorts',
                'urltovideo',
                'influencer_avatar'
            ];

            return array_merge($types, $data);
        });

        // for drive only
        add_filter('modify_drive_data', function ($types) {

            $data = [
                'aishorts',
                'urltovideo',
                'influencer_avatar'
            ];

            return array_merge($types, $data);
        });

        // for avatar sync only
        add_filter('sync_avatar_data', function ($types) {

            $data = [
                'influenceravatar'
            ];

            return array_merge($types, $data);
        });

        // for avatar voice sync only
        add_filter('sync_avatar_voice_data', function ($types) {

            $data = [
                'influenceravatar'
            ];

            return array_merge($types, $data);
        });
    }
}
