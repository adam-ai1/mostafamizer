<?php

namespace Modules\OpenAI\Database\Seeders\versions\v5_4_0;

use Illuminate\Database\Seeder;

class PreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providers = [
            'voiceover_google' => '[{"type":"checkbox","label":"Provider State","name":"status","value":"on","visibility":true},{"type":"text","label":"Provider","name":"provider","value":"google","visibility":true},{"type":"dropdown","label":"Languages","name":"language","value":["English","Bengali","French","Chinese","Arabic","Bulgarian","Dutch","Russian","Spanish","Portuguese","Polish","German","Sweden","Catalan"],"visibility":true,"note":"<p>Please note that you can add any language you wish, but a corresponding actor must be available. Without an actor, <br> the language feature may not function properly. Kindly ensure provider support and system availability.<\/p>\r\n"},{"type":"dropdown","label":"Volumes","name":"volume","value":["Low","Default","High"],"default_value":"Default","visibility":true,"note":"<p>The value of the levels are as follows:<\/p>\r\n                    <ul>\r\n                        <li><strong>-6.00<\/strong> indicates a Low level<\/li>\r\n                        <li><strong>0.00<\/strong> represents the Default level<\/li>\r\n                        <li><strong>6.00<\/strong> signifies a High level<\/li>\r\n                    <\/ul>"},{"type":"dropdown","label":"Pitches","name":"pitch","value":["Low","Default","High"],"default_value":"Default","visibility":true,"note":"<p>The value of the levels are as follows:<\/p>\r\n                    <ul>\r\n                        <li><strong>-20.00<\/strong> indicates a Low level<\/li>\r\n                        <li><strong>0.00<\/strong> represents the Default level<\/li>\r\n                        <li><strong>20.00<\/strong> signifies a High level<\/li>\r\n                    <\/ul>"},{"type":"dropdown","label":"Speeds","name":"speed","value":["Super Slow","Slow","Default","Fast","Super Fast"],"default_value":"Default","visibility":true,"note":"<p>The value of the levels are as follows:<\/p>\r\n                    <ul>\r\n                        <li><strong>0.25<\/strong> indicates Super Slow<\/li>\r\n                        <li><strong>0.50<\/strong> represents Slow<\/li>\r\n                        <li><strong>1.00<\/strong> signifies Default<\/li>\r\n                        <li><strong>2.00<\/strong> represents Fast<\/li>\r\n                        <li><strong>4.00<\/strong> represents Super Fast<\/li>\r\n                    <\/ul>"},{"type":"dropdown","label":"Pauses","name":"pause","value":["0s","1s","2s","3s","4s","5s"],"default_value":"0s","visibility":true},{"type":"dropdown","label":"Audio Effect","name":"audio_effect","value":{"0":"Smart Watch","1":"Smartphone","2":"Headphone","4":"Smart Bluetooth","5":"Smart TV","6":"Car Speaker","7":"Telephone"},"default_value":"Smart Watch","visibility":true},{"type":"dropdown","label":"Converted To","name":"target_format","value":["MP3","WAV","OGG"],"default_value":"MP3","visibility":true,"required":true},{"type":"number","label":"Conversation Limit","name":"conversation_limit","min":1,"max":6,"value":"4","visibility":true,"required":true}]',

            'voiceover_openai' => '[{"type":"checkbox","label":"Provider State","name":"status","value":"on","visibility":true},{"type":"text","label":"Provider","name":"provider","value":"openai","visibility":true},{"type":"dropdown","label":"Models","name":"model","value":["TTS","TTS HD","GPT-4o Mini TTS"],"visibility":true,"required":true},{"type":"dropdown","label":"Converted To","name":"target_format","value":["MP3","AAC","Opus","FLAC"],"visibility":true,"required":true},{"type":"number","label":"Conversation Limit","name":"conversation_limit","min":1,"max":6,"value":"2","visibility":true,"required":true}]',

            'voiceover_azureopenai' => '[{"type":"checkbox","label":"Provider State","name":"status","value":"on","visibility":true},{"type":"text","label":"Provider","name":"provider","value":"azureopenai","visibility":true},{"type":"dropdown","label":"Models","name":"model","value":["TTS","TTS HD","GPT-4o Mini TTS"],"visibility":true,"required":true},{"type":"dropdown","label":"Converted To","name":"target_format","value":["MP3","AAC","Opus","FLAC"],"visibility":true,"required":true},{"type":"number","label":"Conversation Limit","name":"conversation_limit","min":1,"max":6,"value":"2","visibility":true,"required":true}]',

            'voiceover_elevenlabs' => '[{"type":"checkbox","label":"Provider State","name":"status","value":"on","visibility":true},{"type":"text","label":"Provider","name":"provider","value":"elevenlabs","visibility":true},{"type":"dropdown","label":"Models","name":"model","value":["Eleven Multilingual V2","Eleven Turbo V2_5","Eleven Turbo V2","Eleven Multilingual V1","Eleven Monolingual V1"],"visibility":true},{"type":"dropdown","label":"Converted To","name":"target_format","value":["MP3 at 22.05kHz, 32 kbps","MP3 at 44.1kHz, 32 kbps","MP3 at 44.1kHz, 64 kbps","MP3 at 44.1kHz, 96 kbps","MP3 at 44.1kHz, 128 kbps","MP3 at 44.1kHz, 192 kbps","PCM at 16kHz","PCM at 22.05kHz","PCM at 24kHz","PCM at 44.1kHz","uLaw at 8kHz"],"default_value":"MP3 at 44.1kHz, 128 kbps","visibility":true},{"type":"dropdown","label":"Stability","name":"stability","value":["0.0","0.2","0.4","0.6","0.8","1.0"],"default_value":"0.0","tooltip":"Increasing stability will make the voice more consistent between re-generations, but it can also make it sounds a bit monotone. On longer text fragments we recommend lowering this value.","visibility":true},{"type":"dropdown","label":"Similarity Boost","name":"similarity_boost","value":["0.0","0.2","0.4","0.6","0.8","1.0"],"default_value":"0.0","tooltip":"High enhancement improves voice clarity and enhances speaker similarity. However, setting it too high may introduce artifacts. Adjust this setting to achieve the best results.","visibility":true},{"type":"number","label":"Conversation Limit","name":"conversation_limit","min":1,"max":6,"value":"2","visibility":true,"required":true}]'
        ];

        foreach ($providers as $field => $config) {
            $row = \DB::table('preferences')->where('field', $field)->first();
            if ($row) {
                \DB::table('preferences')
                    ->where('field', $field)
                    ->update(['value' => $config]);
            }
        }
    }
}
