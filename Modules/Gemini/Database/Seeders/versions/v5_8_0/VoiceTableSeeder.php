<?php

namespace Modules\Gemini\Database\Seeders\versions\v5_8_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Achernar',
                    'voice_name' => 'Achernar',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-achernar.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":36.43359375,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 36.43,
                    'file_name' => '20231007/6a0a67163cb2e7b9ab02b84f691d9305.png',
                    'original_file_name' => '100-years-ago-the-figure-of-a-smile-womanoid-reflecting-the-style-of-dress-in-the-23th-century-ele-969506291.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Achird',
                    'voice_name' => 'Achird',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-achird.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":16.763671875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_name' => '20240110/94b10b3b2419e9c8ae6952a1a3a7b5df.png',
                    'file_size' => 16.76,
                    'original_file_name' => 'a-handsome-20-year-old-guy-in-full-height-brown-hair-brown-eyes-freckles-on-his-face-angular-app-257326473.png',
                ],
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Algenib',
                    'voice_name' => 'Algenib',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-algenib.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":21.673828125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_name' => '20231207/a6d17870a845df5bc95ee0d7cb4d6cc8.png',
                    'file_size' => 21.67,
                    'original_file_name' => 'conventionally-attractive-twenty-five-year-old-american-man-messy-light-brown-hair-blue-eyes-fit - 176165787.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Algieba',
                    'voice_name' => 'Algieba',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-algieba.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":27.1220703125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 27.12,
                    'file_name' => '20231007/e910d5fdf52c2ac080289e1223217fff.png',
                    'original_file_name' => 'a-moroccan-young-man-in-peasant-clothes-30-years-old-with-good-features-appears-to-have-a-kind-he-504078789.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Alnilam',
                    'voice_name' => 'Alnilam',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-alnilam.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":25.34765625,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 25.35,
                    'file_name' => '20231007/bafb7886bc935b538fd4625c9a56167e.png',
                    'original_file_name' => 'a-handsome-young-man-of-age-28-wearing-suit-looking-forwardmasculineconfidentdark-soft-background-892812288.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Aoede',
                    'voice_name' => 'Aoede',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-aoeda.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":26.9033203125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 26.9,
                    'file_name' => '20231007/940a5da2219e1ff2dd821f2e1dd52505.png',
                    'original_file_name' => 'full-scene-modern-bengali-girl-teenager-girl-normal-saree-long-black-hair-head-and-shoulders-po-656062952.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Autonoe',
                    'voice_name' => 'Autonoe',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-autonoe.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":39.650390625,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 39.65,
                    'file_name' => '20231007/e7125b837753faa9de628013f1c42998.png',
                    'original_file_name' => 'beautiful-woman-writer-brown-blonde-brown--eyes-round-frame-glasses-cute-face-ultra-detailed-i-189023692.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Callirrhoe',
                    'voice_name' => 'Callirrhoe',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-callirrhoe.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":22.537109375,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 22.54,
                    'file_name' => '20231007/0beb148526429036d054618558439ece.png',
                    'original_file_name' => 'portrait-of-an-adult-woman-40-yo-chromakey-beautiful-detailed-intricate-insanely-detailed-octane--229190450.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Charon',
                    'voice_name' => 'Charon',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-charon.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":32.6083984375,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_name' => '20231207/a553199ca0497038bde8699e2f70a857.png',
                    'file_size' => 32.61,
                    'original_file_name' => 'good-looking-young-male-as-a-character-in-a-comedy-moviemovie-scene-funnya-highly-detailed-fa.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Despina',
                    'voice_name' => 'Despina',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-despina.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.5302734375,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_name' => '20231207/43bfb22d5132665241162a919fc51f47.png',
                    'file_size' => 24.53,
                    'original_file_name' => 'perfect-face-beautiful-swedish-army-woman-m90-camoflage-outfit-swedish-flag - brunette-hair-idea-436053226.png',
                ]
                
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Enceladus',
                    'voice_name' => 'Enceladus',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-enceladus.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.4404296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.44,
                    'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
                    'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Erinome',
                    'voice_name' => 'Erinome',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-erinome.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":17.376953125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_name' => '20231207/6e4e6ef0d9e271617258b239501d6594.png',
                    'file_size' => 17.38,
                    'original_file_name' => 'women-brown-hair-small-eye-straight-hair-front-low-nose-white-shirts-brown-eye-trending-on-a-443234400.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Gacrux',
                    'voice_name' => 'Gacrux',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-gacrux.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":35.322265625,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 35.32,
                    'file_name' => '20231007/e4c0f1a201e9ae05a16d3086175103af.png',
                    'original_file_name' => 'xi-jin-ping-clear-bright-eyes-head-and-shoulders-portrait-detailed-and-intricate-environment-4k-7860793.png',
                ]
                
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Iapetus',
                    'voice_name' => 'Iapetus',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-iapetus.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":18.0283203125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_name' => '20231207/e80a86d1f709b6397efabb26f4732494.png',
                    'file_size' => 18.03,
                    'original_file_name' => 'an-alluring-and-fierce-israeli-man-with-short-blond-hair-and-brown-eyes-exuding-confidence-and-st-246686631.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Kore',
                    'voice_name' => 'Kore',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-kore.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":32.0380859375,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 32.04,
                    'file_name' => '20231007/4ede9083362d921883ff3f25cd713516.png',
                    'original_file_name' => 'asian-modern-and-beautiful-hijab-girl-blue-hijab-color-plain-white-background-color-4k-hd-supe-563824481.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Laomedeia',
                    'voice_name' => 'Laomedeia',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-laomedeia.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":25.416015625,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 25.42,
                    'file_name' => '20231007/ee9e7c3e94faa77629b773a9e7cd50dc.png',
                    'original_file_name' => 'ilse-koch-buchenwald-1942-nazi-highly-detailed-professional-digital-painting-unreal-engine-5-pho-334769933.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Leda',
                    'voice_name' => 'Leda',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-leda.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":22.845703125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 22.85,
                    'file_name' => '20231007/efad894c4cc7512cdc1b51b27f51f3eb.png',
                    'original_file_name' => 'pixar-portrait-style-woman-painted-background-soft-lighting-589346799.png',
                ]
                
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Orus',
                    'voice_name' => 'Orus',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-orus.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":29.783203125,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 29.78,
                    'file_name' => '20231007/612121884d8f0902a50b7bbeeb42198d.png',
                    'original_file_name' => 'olpntng-style-full-head-photorealistic-photorealism-golden-ratio-present-day-attiretrendin-3905584.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Pulcherrima',
                    'voice_name' => 'Pulcherrima',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-pulcherrima.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":39.650390625,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 39.65,
                    'file_name' => '20231007/e7125b837753faa9de628013f1c42998.png',
                    'original_file_name' => 'beautiful-woman-writer-brown-blonde-brown--eyes-round-frame-glasses-cute-face-ultra-detailed-i-189023692.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Puck',
                    'voice_name' => 'Puck',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-puck.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.4404296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.44,
                    'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
                    'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Rasalgethi',
                    'voice_name' => 'Rasalgethi',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-rasalgethi.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.4404296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.44,
                    'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
                    'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Rasalgethi',
                    'voice_name' => 'Rasalgethi',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-rasalgethi.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.4404296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.44,
                    'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
                    'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Sadaltager',
                    'voice_name' => 'Sadaltager',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-sadaltager.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.4404296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.44,
                    'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
                    'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Schedar',
                    'voice_name' => 'Schedar',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-schedar.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.171875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.17,
                    'file_name' => '20231007/ffd3bb38e93d6472904c5d410a03f733.png',
                    'original_file_name' => 'ultra-realistic-digital-illustration-of-50-years-old-man-similar-with-uploaded-photo-intricate-deta-244647170.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Sulafat',
                    'voice_name' => 'Sulafat',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-sulafat.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":39.650390625,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 39.65,
                    'file_name' => '20231007/e7125b837753faa9de628013f1c42998.png',
                    'original_file_name' => 'beautiful-woman-writer-brown-blonde-brown--eyes-round-frame-glasses-cute-face-ultra-detailed-i-189023692.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Umbriel',
                    'voice_name' => 'Umbriel',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-umbriel.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":24.4404296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 24.44,
                    'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
                    'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Vindemiatrix',
                    'voice_name' => 'Vindemiatrix',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-vindemiatrix.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'file_name' => '20231007/a1aa430a949c13d17d93f8a002a61ea8.png',
                    'original_file_name' => 'a-colorful-illustration--of-a-beautiful-woman-reading-a-book-sticker-style-colorful-sticker-2d-c-686460080.png',
                    'params' => '{"size":35.779296875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 35.78,
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Zephyr',
                    'voice_name' => 'Zephyr',
                    'gender' => 'Female',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-zephyr.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'params' => '{"size":36.43359375,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 36.43,
                    'file_name' => '20231007/6a0a67163cb2e7b9ab02b84f691d9305.png',
                    'original_file_name' => '100-years-ago-the-figure-of-a-smile-womanoid-reflecting-the-style-of-dress-in-the-23th-century-ele-969506291.png',
                ]
            ],
            [
                'voice' => [
                    'user_id' => 1,
                    'name' => 'Zubenelgenubi',
                    'voice_name' => 'Zubenelgenubi',
                    'gender' => 'Male',
                    'file_name' => 'https://cloud.google.com/static/text-to-speech/docs/audio/chirp3-hd-zubenelgenubi.wav',
                    'status' => 'Active',
                    'providers' => 'gemini',
                    'language_code' => 'en',
                ],
                'file' => [
                    'file_name' => '20231007/a1b6bd47771bdd70eb59dfba3b9cab80.png',
                    'params' => '{"size":25.998046875,"type":"png"}',
                    'object_type' => 'png',
                    'object_id' => NULL,
                    'uploaded_by' => 1,
                    'file_size' => 26.0,
                    'original_file_name' => 'a-man-standing-outside-with-a-microphone-935719209.png',
                ]
            ]
        ];
        
        foreach ($data as $entry) {
            DB::table('voices')->upsert(
                [$entry['voice']],
                ['name'],
                ['voice_name']
            );
        
            // Get the voice ID (either from the upsert or the existing record)
            $voiceId = DB::table('voices')->where('name', $entry['voice']['name'])->value('id');
        
            // Upsert file data
            $fileId = DB::table('files')->insertGetId($entry['file']);
        
            // Insert into object_files table
            DB::table('object_files')->upsert(
                [
                    'object_type' => 'voices',
                    'object_id' => $voiceId,
                    'file_id' => $fileId,
                ],
                ['object_type', 'object_id', 'file_id'],
                []
            );
        }
        
    }
}
