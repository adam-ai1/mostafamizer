<?php

namespace Modules\OpenAI\Database\Seeders\versions\v4_9_0;

use Illuminate\Database\Seeder;

class AvatarMetasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('avatar_metas')->delete();
        
        \DB::table('avatar_metas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1ad51ab9fee24ae88af067206e14a1d8_44250/preview_target.webp',
            ),
            1 => 
            array (
                'id' => 2,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1ad51ab9fee24ae88af067206e14a1d8_44250/preview_video_target.mp4',
            ),
            2 => 
            array (
                'id' => 3,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 2,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/463208b6cad140d2b263535826838e3a_39240/preview_target.webp',
            ),
            3 => 
            array (
                'id' => 4,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 2,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/463208b6cad140d2b263535826838e3a_39240/preview_video_target.mp4',
            ),
            4 => 
            array (
                'id' => 5,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 3,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9886d46db7f24260bb219c756ca0d759_39250/preview_target.webp',
            ),
            5 => 
            array (
                'id' => 6,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 3,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9886d46db7f24260bb219c756ca0d759_39250/preview_video_target.mp4',
            ),
            6 => 
            array (
                'id' => 7,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 4,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cfdab85e050048d2abc901bf882c89a7_39220/preview_target.webp',
            ),
            7 => 
            array (
                'id' => 8,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 4,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cfdab85e050048d2abc901bf882c89a7_39220/preview_video_target.mp4',
            ),
            8 => 
            array (
                'id' => 9,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 5,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e5e2683161894616b4cdf73d4f6ed6ea_39230/preview_target.webp',
            ),
            9 => 
            array (
                'id' => 10,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 5,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e5e2683161894616b4cdf73d4f6ed6ea_39230/preview_video_target.mp4',
            ),
            10 => 
            array (
                'id' => 11,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 6,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c3d1baaebbe84752b7a473373c6cd385_42780/preview_target.webp',
            ),
            11 => 
            array (
                'id' => 12,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 6,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c3d1baaebbe84752b7a473373c6cd385_42780/preview_video_target.mp4',
            ),
            12 => 
            array (
                'id' => 13,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 7,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5fb6d7ff842944f69d1ba419e15e2d77_42450/preview_talk_2.webp',
            ),
            13 => 
            array (
                'id' => 14,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 7,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5fb6d7ff842944f69d1ba419e15e2d77_42450/preview_video_talk_2.mp4',
            ),
            14 => 
            array (
                'id' => 15,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 8,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88dbd2785def417ca7a2b79d4cf40c6d_42780/preview_talk_3.webp',
            ),
            15 => 
            array (
                'id' => 16,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 8,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88dbd2785def417ca7a2b79d4cf40c6d_42780/preview_video_talk_3.mp4',
            ),
            16 => 
            array (
                'id' => 17,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 9,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b68bcf81edc44fabdc9070e62ca1f82_42780/preview_talk_2.webp',
            ),
            17 => 
            array (
                'id' => 18,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 9,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b68bcf81edc44fabdc9070e62ca1f82_42780/preview_video_talk_2.mp4',
            ),
            18 => 
            array (
                'id' => 19,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 10,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18f25fd5ce0040a29a954e95165e233a_42770/preview_target.webp',
            ),
            19 => 
            array (
                'id' => 20,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 10,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18f25fd5ce0040a29a954e95165e233a_42770/preview_video_target.mp4',
            ),
            20 => 
            array (
                'id' => 21,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 11,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ab83416187164ac386f72e7c7288e70b_42780/preview_talk_1.webp',
            ),
            21 => 
            array (
                'id' => 22,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 11,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ab83416187164ac386f72e7c7288e70b_42780/preview_video_talk_1.mp4',
            ),
            22 => 
            array (
                'id' => 23,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 12,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1cc18796d5e44342b3247c1aa847bc8f_52250/preview_target.webp',
            ),
            23 => 
            array (
                'id' => 24,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 12,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1cc18796d5e44342b3247c1aa847bc8f_52250/preview_video_target.mp4',
            ),
            24 => 
            array (
                'id' => 25,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 13,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/74982c18df0f43fbbf304133b49b2170_35020/preview_target.webp',
            ),
            25 => 
            array (
                'id' => 26,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 13,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/74982c18df0f43fbbf304133b49b2170_35020/preview_video_target.mp4',
            ),
            26 => 
            array (
                'id' => 27,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 14,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/df3a17e47a5c4cada4199c4bab4b4cff_35030/preview_target.webp',
            ),
            27 => 
            array (
                'id' => 28,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 14,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/df3a17e47a5c4cada4199c4bab4b4cff_35030/preview_video_target.mp4',
            ),
            28 => 
            array (
                'id' => 29,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 15,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/912f2e54677a4f29b1dc877d20e3ce49_35040/preview_target.webp',
            ),
            29 => 
            array (
                'id' => 30,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 15,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/912f2e54677a4f29b1dc877d20e3ce49_35040/preview_video_target.mp4',
            ),
            30 => 
            array (
                'id' => 31,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 16,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0233ba6aea01411ab07ddafbf97886f2_39260/preview_talk_2.webp',
            ),
            31 => 
            array (
                'id' => 32,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 16,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0233ba6aea01411ab07ddafbf97886f2_39260/preview_video_talk_2.mp4',
            ),
            32 => 
            array (
                'id' => 33,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 17,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/20cf0b98ae164abdb4a814dab98e69ca_39260/preview_talk_3.webp',
            ),
            33 => 
            array (
                'id' => 34,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 17,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/20cf0b98ae164abdb4a814dab98e69ca_39260/preview_video_talk_3.mp4',
            ),
            34 => 
            array (
                'id' => 35,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 18,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/af703fd4f280409c87ba7d5376ca8cb3_39270/preview_talk_3.webp',
            ),
            35 => 
            array (
                'id' => 36,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 18,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/af703fd4f280409c87ba7d5376ca8cb3_39270/preview_video_talk_3.mp4',
            ),
            36 => 
            array (
                'id' => 37,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 19,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/16741476b7a549288bfefdf05ed8aa5d_39270/preview_talk_4.webp',
            ),
            37 => 
            array (
                'id' => 38,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 19,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/16741476b7a549288bfefdf05ed8aa5d_39270/preview_video_talk_4.mp4',
            ),
            38 => 
            array (
                'id' => 39,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 20,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d684929e24d545de9fd98ae031541265_39260/preview_talk_5.webp',
            ),
            39 => 
            array (
                'id' => 40,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 20,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d684929e24d545de9fd98ae031541265_39260/preview_video_talk_5.mp4',
            ),
            40 => 
            array (
                'id' => 41,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 21,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5e0c02e028214c5d83a8fb6f93d8af8b_39260/preview_talk_4.webp',
            ),
            41 => 
            array (
                'id' => 42,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 21,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5e0c02e028214c5d83a8fb6f93d8af8b_39260/preview_video_talk_4.mp4',
            ),
            42 => 
            array (
                'id' => 43,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 22,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/373b306eb011498f86f1b02803baf9d9_39280/preview_target.webp',
            ),
            43 => 
            array (
                'id' => 44,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 22,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/373b306eb011498f86f1b02803baf9d9_39280/preview_video_target.mp4',
            ),
            44 => 
            array (
                'id' => 45,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 23,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3a8835d393646f3af4154c470440004_39270/preview_target.webp',
            ),
            45 => 
            array (
                'id' => 46,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 23,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3a8835d393646f3af4154c470440004_39270/preview_video_target.mp4',
            ),
            46 => 
            array (
                'id' => 47,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 24,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dea59fe8a4d34fb9a28bb24b30424fd3_39260/preview_talk_1.webp',
            ),
            47 => 
            array (
                'id' => 48,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 24,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dea59fe8a4d34fb9a28bb24b30424fd3_39260/preview_video_talk_1.mp4',
            ),
            48 => 
            array (
                'id' => 49,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 25,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1f58c0f60faa4cb5bf6c465615e3fb18_39260/preview_target.webp',
            ),
            49 => 
            array (
                'id' => 50,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 25,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1f58c0f60faa4cb5bf6c465615e3fb18_39260/preview_video_target.mp4',
            ),
            50 => 
            array (
                'id' => 51,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 26,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2f6cd925494e4bafa15aec123bda28f0_39270/preview_talk_2.webp',
            ),
            51 => 
            array (
                'id' => 52,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 26,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2f6cd925494e4bafa15aec123bda28f0_39270/preview_video_talk_2.mp4',
            ),
            52 => 
            array (
                'id' => 53,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 27,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b047b9088c09438a997a62ba0f06750e_39270/preview_talk_1.webp',
            ),
            53 => 
            array (
                'id' => 54,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 27,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b047b9088c09438a997a62ba0f06750e_39270/preview_video_talk_1.mp4',
            ),
            54 => 
            array (
                'id' => 55,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 28,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1686261ff904a379b032b8f41ed0628_37480/preview_talk_1.webp',
            ),
            55 => 
            array (
                'id' => 56,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 28,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1686261ff904a379b032b8f41ed0628_37480/preview_video_talk_1.mp4',
            ),
            56 => 
            array (
                'id' => 57,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 29,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fc4d76cc1a894dd3af35ccdf46ae3219_37490/preview_talk_1.webp',
            ),
            57 => 
            array (
                'id' => 58,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 29,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fc4d76cc1a894dd3af35ccdf46ae3219_37490/preview_video_talk_1.mp4',
            ),
            58 => 
            array (
                'id' => 59,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 30,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0150899ce4b34efeb7d1d103c1048414_37480/preview_target.webp',
            ),
            59 => 
            array (
                'id' => 60,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 30,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0150899ce4b34efeb7d1d103c1048414_37480/preview_video_target.mp4',
            ),
            60 => 
            array (
                'id' => 61,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 31,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bc5e4c3817334bb7a8f85e1aece8d7a9_37480/preview_talk_2.webp',
            ),
            61 => 
            array (
                'id' => 62,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 31,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bc5e4c3817334bb7a8f85e1aece8d7a9_37480/preview_video_talk_2.mp4',
            ),
            62 => 
            array (
                'id' => 63,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 32,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2d45fa08de4b44cbb32c5c54d1bd8548_37490/preview_target.webp',
            ),
            63 => 
            array (
                'id' => 64,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 32,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2d45fa08de4b44cbb32c5c54d1bd8548_37490/preview_video_target.mp4',
            ),
            64 => 
            array (
                'id' => 65,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 33,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cca66f3ac6fe48c6972b375692466ecc_37490/preview_talk_2.webp',
            ),
            65 => 
            array (
                'id' => 66,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 33,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cca66f3ac6fe48c6972b375692466ecc_37490/preview_video_talk_2.mp4',
            ),
            66 => 
            array (
                'id' => 67,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 34,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f66130157ead439eb05bcf63b0469163_37110/preview_target.webp',
            ),
            67 => 
            array (
                'id' => 68,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 34,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f66130157ead439eb05bcf63b0469163_37110/preview_video_target.mp4',
            ),
            68 => 
            array (
                'id' => 69,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 35,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b9dc9ae77684964b226b74075a59e22_37170/preview_target.webp',
            ),
            69 => 
            array (
                'id' => 70,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 35,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b9dc9ae77684964b226b74075a59e22_37170/preview_video_target.mp4',
            ),
            70 => 
            array (
                'id' => 71,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 36,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00de8c52f5884155997a643d9732e669_37110/preview_talk_3.webp',
            ),
            71 => 
            array (
                'id' => 72,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 36,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00de8c52f5884155997a643d9732e669_37110/preview_video_talk_3.mp4',
            ),
            72 => 
            array (
                'id' => 73,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 37,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/347c5bbf9a1e40bc8fc76fe89887f1b5_37180/preview_talk_1.webp',
            ),
            73 => 
            array (
                'id' => 74,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 37,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/347c5bbf9a1e40bc8fc76fe89887f1b5_37180/preview_video_talk_1.mp4',
            ),
            74 => 
            array (
                'id' => 75,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 38,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/51161fccd84d4c71b686cfe67c34f1b6_48010/preview_target.webp',
            ),
            75 => 
            array (
                'id' => 76,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 38,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/51161fccd84d4c71b686cfe67c34f1b6_48010/preview_video_target.mp4',
            ),
            76 => 
            array (
                'id' => 77,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 39,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5ebc357fa7934d258d605a2237ccd9f6_48000/preview_target.webp',
            ),
            77 => 
            array (
                'id' => 78,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 39,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5ebc357fa7934d258d605a2237ccd9f6_48000/preview_video_target.mp4',
            ),
            78 => 
            array (
                'id' => 79,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 40,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c664108fcc4a48bc985fa77dc995e623_48040/preview_target.webp',
            ),
            79 => 
            array (
                'id' => 80,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 40,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c664108fcc4a48bc985fa77dc995e623_48040/preview_video_target.mp4',
            ),
            80 => 
            array (
                'id' => 81,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 41,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d9bbc52a62994d8ea2f04c6d287b28bb_48050/preview_target.webp',
            ),
            81 => 
            array (
                'id' => 82,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 41,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d9bbc52a62994d8ea2f04c6d287b28bb_48050/preview_video_target.mp4',
            ),
            82 => 
            array (
                'id' => 83,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 42,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d05c5212e1014846a53b7cea76bc3c9c_48030/preview_target.webp',
            ),
            83 => 
            array (
                'id' => 84,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 42,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d05c5212e1014846a53b7cea76bc3c9c_48030/preview_video_target.mp4',
            ),
            84 => 
            array (
                'id' => 85,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 43,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88734c28f9d040b08e129b876aedc981_48020/preview_target.webp',
            ),
            85 => 
            array (
                'id' => 86,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 43,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88734c28f9d040b08e129b876aedc981_48020/preview_video_target.mp4',
            ),
            86 => 
            array (
                'id' => 87,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 44,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26de369b2d4443e586dedf27af1e0c1d_45570/preview_talk_1.webp',
            ),
            87 => 
            array (
                'id' => 88,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 44,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26de369b2d4443e586dedf27af1e0c1d_45570/preview_video_talk_1.mp4',
            ),
            88 => 
            array (
                'id' => 89,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 45,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/699a4c2995914d39b2cb311a930d7720_45570/preview_talk_3.webp',
            ),
            89 => 
            array (
                'id' => 90,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 45,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/699a4c2995914d39b2cb311a930d7720_45570/preview_video_talk_3.mp4',
            ),
            90 => 
            array (
                'id' => 91,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 46,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/abe1d571bfc94dc9bc2ef44ea3a2ce0e_47980/preview_target.webp',
            ),
            91 => 
            array (
                'id' => 92,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 46,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/abe1d571bfc94dc9bc2ef44ea3a2ce0e_47980/preview_video_target.mp4',
            ),
            92 => 
            array (
                'id' => 93,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 47,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3b375f65c8f4f5c8ce695c3ed49e4d5_48810/preview_talk_3.webp',
            ),
            93 => 
            array (
                'id' => 94,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 47,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3b375f65c8f4f5c8ce695c3ed49e4d5_48810/preview_video_talk_3.mp4',
            ),
            94 => 
            array (
                'id' => 95,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 48,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75e0a87b7fd94f0981ff398b593dd47f_45570/preview_talk_4.webp',
            ),
            95 => 
            array (
                'id' => 96,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 48,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75e0a87b7fd94f0981ff398b593dd47f_45570/preview_video_talk_4.mp4',
            ),
            96 => 
            array (
                'id' => 97,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 49,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b76b3d8f146c4a0ab7b2b865d87eb801_55500/preview_target.webp',
            ),
            97 => 
            array (
                'id' => 98,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 49,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b76b3d8f146c4a0ab7b2b865d87eb801_55500/preview_video_target.mp4',
            ),
            98 => 
            array (
                'id' => 99,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 50,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/561ec5deb3f74a27b6b12fd8a6a2f76e_56970/preview_target.webp',
            ),
            99 => 
            array (
                'id' => 100,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 50,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/561ec5deb3f74a27b6b12fd8a6a2f76e_56970/preview_video_target.mp4',
            ),
            100 => 
            array (
                'id' => 101,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 51,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/262658a5bb3346e38b68c623019fd5b2_55470/preview_target.webp',
            ),
            101 => 
            array (
                'id' => 102,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 51,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/262658a5bb3346e38b68c623019fd5b2_55470/preview_video_target.mp4',
            ),
            102 => 
            array (
                'id' => 103,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 52,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35a188d174c446859764803cd63d7332_55540/preview_target.webp',
            ),
            103 => 
            array (
                'id' => 104,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 52,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35a188d174c446859764803cd63d7332_55540/preview_video_target.mp4',
            ),
            104 => 
            array (
                'id' => 105,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 53,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2f27d7394d1546ceb091516e188b869f_55510/preview_target.webp',
            ),
            105 => 
            array (
                'id' => 106,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 53,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2f27d7394d1546ceb091516e188b869f_55510/preview_video_target.mp4',
            ),
            106 => 
            array (
                'id' => 107,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 54,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/823b3e996c4b4244957f4d4326f74b35_53400/preview_target.webp',
            ),
            107 => 
            array (
                'id' => 108,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 54,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/823b3e996c4b4244957f4d4326f74b35_53400/preview_video_target.mp4',
            ),
            108 => 
            array (
                'id' => 109,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 55,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f4b1d27d912f405a8abb2ace86cb67d6_56130/preview_target.webp',
            ),
            109 => 
            array (
                'id' => 110,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 55,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f4b1d27d912f405a8abb2ace86cb67d6_56130/preview_video_target.mp4',
            ),
            110 => 
            array (
                'id' => 111,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 56,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a643fb413d7e460ea257d0f4c15d0179_56150/preview_target.webp',
            ),
            111 => 
            array (
                'id' => 112,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 56,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a643fb413d7e460ea257d0f4c15d0179_56150/preview_video_target.mp4',
            ),
            112 => 
            array (
                'id' => 113,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 57,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5b476f692d1c488bab6c7aed3ef00823_54010/preview_target.webp',
            ),
            113 => 
            array (
                'id' => 114,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 57,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5b476f692d1c488bab6c7aed3ef00823_54010/preview_video_target.mp4',
            ),
            114 => 
            array (
                'id' => 115,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 58,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5d8649146ffe4644858c56b3c63be17a_55490/preview_target.webp',
            ),
            115 => 
            array (
                'id' => 116,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 58,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5d8649146ffe4644858c56b3c63be17a_55490/preview_video_target.mp4',
            ),
            116 => 
            array (
                'id' => 117,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 59,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ff430195ff74d8ba32d629246898304_56120/preview_target.webp',
            ),
            117 => 
            array (
                'id' => 118,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 59,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ff430195ff74d8ba32d629246898304_56120/preview_video_target.mp4',
            ),
            118 => 
            array (
                'id' => 119,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 60,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5d5a9a07c612460d882861e0e8931564_54040/preview_target.webp',
            ),
            119 => 
            array (
                'id' => 120,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 60,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5d5a9a07c612460d882861e0e8931564_54040/preview_video_target.mp4',
            ),
            120 => 
            array (
                'id' => 121,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 61,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b244fd523ba4135b6a2a8ecaf19b510_56090/preview_target.webp',
            ),
            121 => 
            array (
                'id' => 122,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 61,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b244fd523ba4135b6a2a8ecaf19b510_56090/preview_video_target.mp4',
            ),
            122 => 
            array (
                'id' => 123,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 62,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b724e937b6af472689a91de64233a66b_56100/preview_target.webp',
            ),
            123 => 
            array (
                'id' => 124,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 62,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b724e937b6af472689a91de64233a66b_56100/preview_video_target.mp4',
            ),
            124 => 
            array (
                'id' => 125,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 63,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6eeb8d4212d84bfdb968d00aba9960b2_56090/preview_talk_2.webp',
            ),
            125 => 
            array (
                'id' => 126,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 63,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6eeb8d4212d84bfdb968d00aba9960b2_56090/preview_video_talk_2.mp4',
            ),
            126 => 
            array (
                'id' => 127,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 64,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/56ecee33b1d144bbb4efa65f68dcbb03_56110/preview_target.webp',
            ),
            127 => 
            array (
                'id' => 128,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 64,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/56ecee33b1d144bbb4efa65f68dcbb03_56110/preview_video_target.mp4',
            ),
            128 => 
            array (
                'id' => 129,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 65,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0a38df14afa46d8b25f7745331cdb89_56090/preview_talk_1.webp',
            ),
            129 => 
            array (
                'id' => 130,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 65,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0a38df14afa46d8b25f7745331cdb89_56090/preview_video_talk_1.mp4',
            ),
            130 => 
            array (
                'id' => 131,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 66,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/63948e2e772543deae18844327e27877_56100/preview_talk_3.webp',
            ),
            131 => 
            array (
                'id' => 132,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 66,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/63948e2e772543deae18844327e27877_56100/preview_video_talk_3.mp4',
            ),
            132 => 
            array (
                'id' => 133,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 67,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbc71c5b9e754f809621b4d5706009ab_56100/preview_talk_2.webp',
            ),
            133 => 
            array (
                'id' => 134,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 67,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbc71c5b9e754f809621b4d5706009ab_56100/preview_video_talk_2.mp4',
            ),
            134 => 
            array (
                'id' => 135,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 68,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ba51441b61d445db8443c83f8a8d0d15_56100/preview_talk_1.webp',
            ),
            135 => 
            array (
                'id' => 136,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 68,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ba51441b61d445db8443c83f8a8d0d15_56100/preview_video_talk_1.mp4',
            ),
            136 => 
            array (
                'id' => 137,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 69,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59ab28f846a24d25b3e91a2a87222c4c_56020/preview_talk_1.webp',
            ),
            137 => 
            array (
                'id' => 138,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 69,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59ab28f846a24d25b3e91a2a87222c4c_56020/preview_video_talk_1.mp4',
            ),
            138 => 
            array (
                'id' => 139,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 70,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1777b1afdb8436cb3b3f0833c6ed492_56020/preview_target.webp',
            ),
            139 => 
            array (
                'id' => 140,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 70,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1777b1afdb8436cb3b3f0833c6ed492_56020/preview_video_target.mp4',
            ),
            140 => 
            array (
                'id' => 141,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 71,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/78f858c6cf2845bb9c31b3cea76b0e58_56030/preview_talk_3.webp',
            ),
            141 => 
            array (
                'id' => 142,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 71,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/78f858c6cf2845bb9c31b3cea76b0e58_56030/preview_video_talk_3.mp4',
            ),
            142 => 
            array (
                'id' => 143,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 72,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e87a78fbcb074752a4a7770be54513b1_56030/preview_talk_2.webp',
            ),
            143 => 
            array (
                'id' => 144,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 72,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e87a78fbcb074752a4a7770be54513b1_56030/preview_video_talk_2.mp4',
            ),
            144 => 
            array (
                'id' => 145,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 73,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b06ffc57270417ba7da3dc24decd433_55980/preview_talk_1.webp',
            ),
            145 => 
            array (
                'id' => 146,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 73,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b06ffc57270417ba7da3dc24decd433_55980/preview_video_talk_1.mp4',
            ),
            146 => 
            array (
                'id' => 147,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 74,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/782ffba0e0584bd6935e7e57d5f7e444_55980/preview_target.webp',
            ),
            147 => 
            array (
                'id' => 148,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 74,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/782ffba0e0584bd6935e7e57d5f7e444_55980/preview_video_target.mp4',
            ),
            148 => 
            array (
                'id' => 149,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 75,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b1a099cf17a4bcaa09b14d2f9727485_55990/preview_talk_1.webp',
            ),
            149 => 
            array (
                'id' => 150,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 75,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b1a099cf17a4bcaa09b14d2f9727485_55990/preview_video_talk_1.mp4',
            ),
            150 => 
            array (
                'id' => 151,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 76,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ce758a257b7f4be3a8c2cf37dbc9e5d7_55990/preview_target.webp',
            ),
            151 => 
            array (
                'id' => 152,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 76,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ce758a257b7f4be3a8c2cf37dbc9e5d7_55990/preview_video_target.mp4',
            ),
            152 => 
            array (
                'id' => 153,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 77,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8e1eb5dd8aa649b3a2736ad3ae63d6c8_56040/preview_talk_2.webp',
            ),
            153 => 
            array (
                'id' => 154,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 77,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8e1eb5dd8aa649b3a2736ad3ae63d6c8_56040/preview_video_talk_2.mp4',
            ),
            154 => 
            array (
                'id' => 155,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 78,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5d3bb0f157d4f05b52828702f47230e_55980/preview_talk_2.webp',
            ),
            155 => 
            array (
                'id' => 156,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 78,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5d3bb0f157d4f05b52828702f47230e_55980/preview_video_talk_2.mp4',
            ),
            156 => 
            array (
                'id' => 157,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 79,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39eeeab7f75e411a82a3185ee8ef3901_56050/preview_talk_1.webp',
            ),
            157 => 
            array (
                'id' => 158,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 79,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39eeeab7f75e411a82a3185ee8ef3901_56050/preview_video_talk_1.mp4',
            ),
            158 => 
            array (
                'id' => 159,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 80,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c76fa4a2be354fccbb503909d32f1a64_55990/preview_talk_2.webp',
            ),
            159 => 
            array (
                'id' => 160,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 80,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c76fa4a2be354fccbb503909d32f1a64_55990/preview_video_talk_2.mp4',
            ),
            160 => 
            array (
                'id' => 161,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 81,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33d3475370b94bb7942dcbbdc445b03f_56070/preview_target.webp',
            ),
            161 => 
            array (
                'id' => 162,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 81,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33d3475370b94bb7942dcbbdc445b03f_56070/preview_video_target.mp4',
            ),
            162 => 
            array (
                'id' => 163,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 82,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/10c2cfbc1c1b4fa9a5fc08162b1709e2_56040/preview_talk_3.webp',
            ),
            163 => 
            array (
                'id' => 164,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 82,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/10c2cfbc1c1b4fa9a5fc08162b1709e2_56040/preview_video_talk_3.mp4',
            ),
            164 => 
            array (
                'id' => 165,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 83,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a130a0f3225c4fdb91de800cd836b778_56080/preview_target.webp',
            ),
            165 => 
            array (
                'id' => 166,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 83,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a130a0f3225c4fdb91de800cd836b778_56080/preview_video_target.mp4',
            ),
            166 => 
            array (
                'id' => 167,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 84,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea08ae4933164707bc0e9b1536b28bc9_56050/preview_target.webp',
            ),
            167 => 
            array (
                'id' => 168,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 84,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea08ae4933164707bc0e9b1536b28bc9_56050/preview_video_target.mp4',
            ),
            168 => 
            array (
                'id' => 169,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 85,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/363e6f1f39b540b4adbfdae8ebda75ae_55960/preview_talk_2.webp',
            ),
            169 => 
            array (
                'id' => 170,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 85,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/363e6f1f39b540b4adbfdae8ebda75ae_55960/preview_video_talk_2.mp4',
            ),
            170 => 
            array (
                'id' => 171,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 86,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e621bd1f24c14305a2233e93a8c8715e_55970/preview_talk_1.webp',
            ),
            171 => 
            array (
                'id' => 172,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 86,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e621bd1f24c14305a2233e93a8c8715e_55970/preview_video_talk_1.mp4',
            ),
            172 => 
            array (
                'id' => 173,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 87,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6f1c6120e79f48ed834be24a94b05931_56070/preview_talk_2.webp',
            ),
            173 => 
            array (
                'id' => 174,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 87,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6f1c6120e79f48ed834be24a94b05931_56070/preview_video_talk_2.mp4',
            ),
            174 => 
            array (
                'id' => 175,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 88,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b5272572b25143fbb1af3b874a03bdaf_56020/preview_talk_2.webp',
            ),
            175 => 
            array (
                'id' => 176,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 88,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b5272572b25143fbb1af3b874a03bdaf_56020/preview_video_talk_2.mp4',
            ),
            176 => 
            array (
                'id' => 177,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 89,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6bd64a550919413f8257aabfb74c22fb_56080/preview_talk_1.webp',
            ),
            177 => 
            array (
                'id' => 178,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 89,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6bd64a550919413f8257aabfb74c22fb_56080/preview_video_talk_1.mp4',
            ),
            178 => 
            array (
                'id' => 179,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 90,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/58d47dbbb5d7454dbda0f53bc34fd9ea_56030/preview_target.webp',
            ),
            179 => 
            array (
                'id' => 180,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 90,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/58d47dbbb5d7454dbda0f53bc34fd9ea_56030/preview_video_target.mp4',
            ),
            180 => 
            array (
                'id' => 181,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 91,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4166f08ed46f40fb87ca14b9ef48765d_56020/preview_talk_3.webp',
            ),
            181 => 
            array (
                'id' => 182,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 91,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4166f08ed46f40fb87ca14b9ef48765d_56020/preview_video_talk_3.mp4',
            ),
            182 => 
            array (
                'id' => 183,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 92,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad51bc760ed54ab3bc2f3f8eccaf8e30_56030/preview_talk_1.webp',
            ),
            183 => 
            array (
                'id' => 184,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 92,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad51bc760ed54ab3bc2f3f8eccaf8e30_56030/preview_video_talk_1.mp4',
            ),
            184 => 
            array (
                'id' => 185,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 93,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/adcd9c28596f40389a926f2b7a4153d0_56310/preview_talk_1.webp',
            ),
            185 => 
            array (
                'id' => 186,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 93,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/adcd9c28596f40389a926f2b7a4153d0_56310/preview_video_talk_1.mp4',
            ),
            186 => 
            array (
                'id' => 187,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 94,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96b055e7536f4d99b8c5f519fbad7179_55960/preview_target.webp',
            ),
            187 => 
            array (
                'id' => 188,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 94,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96b055e7536f4d99b8c5f519fbad7179_55960/preview_video_target.mp4',
            ),
            188 => 
            array (
                'id' => 189,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 95,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c6fc843d9eb4b4a83e6e15d4dd1414a_55970/preview_target.webp',
            ),
            189 => 
            array (
                'id' => 190,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 95,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c6fc843d9eb4b4a83e6e15d4dd1414a_55970/preview_video_target.mp4',
            ),
            190 => 
            array (
                'id' => 191,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 96,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/46bf2baf90bc4333a8a40d01f22e606d_56320/preview_target.webp',
            ),
            191 => 
            array (
                'id' => 192,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 96,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/46bf2baf90bc4333a8a40d01f22e606d_56320/preview_video_target.mp4',
            ),
            192 => 
            array (
                'id' => 193,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 97,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9f42d5a83d84ed6b3f42989f0ef20b4_56310/preview_target.webp',
            ),
            193 => 
            array (
                'id' => 194,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 97,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9f42d5a83d84ed6b3f42989f0ef20b4_56310/preview_video_target.mp4',
            ),
            194 => 
            array (
                'id' => 195,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 98,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7f2caecd8b8b4e5f94b1ee92fe697322_55960/preview_talk_1.webp',
            ),
            195 => 
            array (
                'id' => 196,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 98,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7f2caecd8b8b4e5f94b1ee92fe697322_55960/preview_video_talk_1.mp4',
            ),
            196 => 
            array (
                'id' => 197,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 99,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b56dba4dc8114414bc16d39d7aa051bc_56040/preview_target.webp',
            ),
            197 => 
            array (
                'id' => 198,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 99,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b56dba4dc8114414bc16d39d7aa051bc_56040/preview_video_target.mp4',
            ),
            198 => 
            array (
                'id' => 199,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 100,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aa2a61c1d5834ece938375d412132580_56320/preview_talk_1.webp',
            ),
            199 => 
            array (
                'id' => 200,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 100,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aa2a61c1d5834ece938375d412132580_56320/preview_video_talk_1.mp4',
            ),
            200 => 
            array (
                'id' => 201,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 101,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/456807b0fc8e4f8da62760594118c2a6_56040/preview_talk_1.webp',
            ),
            201 => 
            array (
                'id' => 202,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 101,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/456807b0fc8e4f8da62760594118c2a6_56040/preview_video_talk_1.mp4',
            ),
            202 => 
            array (
                'id' => 203,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 102,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/30184bf113ce49bfac8cdf00c225046f_56060/preview_target.webp',
            ),
            203 => 
            array (
                'id' => 204,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 102,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/30184bf113ce49bfac8cdf00c225046f_56060/preview_video_target.mp4',
            ),
            204 => 
            array (
                'id' => 205,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 103,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa717f667b7b4e41b0d7e4fd320ab080_43280/preview_talk_1.webp',
            ),
            205 => 
            array (
                'id' => 206,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 103,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa717f667b7b4e41b0d7e4fd320ab080_43280/preview_video_talk_1.mp4',
            ),
            206 => 
            array (
                'id' => 207,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 104,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/36dff2ade72644a4a3103341a0bfe7d5_43290/preview_talk_2.webp',
            ),
            207 => 
            array (
                'id' => 208,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 104,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/36dff2ade72644a4a3103341a0bfe7d5_43290/preview_video_talk_2.mp4',
            ),
            208 => 
            array (
                'id' => 209,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 105,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7e412117419c468ab441a52e0db47ab6_43280/preview_talk_4.webp',
            ),
            209 => 
            array (
                'id' => 210,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 105,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7e412117419c468ab441a52e0db47ab6_43280/preview_video_talk_4.mp4',
            ),
            210 => 
            array (
                'id' => 211,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 106,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d12122d6f83476e843394e69451c03a_43280/preview_talk_3.webp',
            ),
            211 => 
            array (
                'id' => 212,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 106,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d12122d6f83476e843394e69451c03a_43280/preview_video_talk_3.mp4',
            ),
            212 => 
            array (
                'id' => 213,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 107,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6360c23d795460182cc96331161d74f_43290/preview_talk_4.webp',
            ),
            213 => 
            array (
                'id' => 214,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 107,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6360c23d795460182cc96331161d74f_43290/preview_video_talk_4.mp4',
            ),
            214 => 
            array (
                'id' => 215,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 108,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6aa7211edc3048538569da077618e256_43290/preview_talk_3.webp',
            ),
            215 => 
            array (
                'id' => 216,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 108,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6aa7211edc3048538569da077618e256_43290/preview_video_talk_3.mp4',
            ),
            216 => 
            array (
                'id' => 217,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 109,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea847ee0ca44468fb6119d16396bf8f1_37890/preview_target.webp',
            ),
            217 => 
            array (
                'id' => 218,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 109,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea847ee0ca44468fb6119d16396bf8f1_37890/preview_video_target.mp4',
            ),
            218 => 
            array (
                'id' => 219,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 110,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0d69336d41f48359261cefc05678c38_37890/preview_talk_3.webp',
            ),
            219 => 
            array (
                'id' => 220,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 110,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0d69336d41f48359261cefc05678c38_37890/preview_video_talk_3.mp4',
            ),
            220 => 
            array (
                'id' => 221,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 111,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/95cb5001e58e4ed986632d66826278cd_37900/preview_talk_1.webp',
            ),
            221 => 
            array (
                'id' => 222,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 111,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/95cb5001e58e4ed986632d66826278cd_37900/preview_video_talk_1.mp4',
            ),
            222 => 
            array (
                'id' => 223,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 112,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aab51cd1942d42d6a15457516e682570_37910/preview_target.webp',
            ),
            223 => 
            array (
                'id' => 224,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 112,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aab51cd1942d42d6a15457516e682570_37910/preview_video_target.mp4',
            ),
            224 => 
            array (
                'id' => 225,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 113,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/34590e9ed41648b997d90f8436b2b447_37890/preview_talk_2.webp',
            ),
            225 => 
            array (
                'id' => 226,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 113,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/34590e9ed41648b997d90f8436b2b447_37890/preview_video_talk_2.mp4',
            ),
            226 => 
            array (
                'id' => 227,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 114,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d97c6a964bbe4ccca11c99fe9d451618_37890/preview_talk_1.webp',
            ),
            227 => 
            array (
                'id' => 228,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 114,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d97c6a964bbe4ccca11c99fe9d451618_37890/preview_video_talk_1.mp4',
            ),
            228 => 
            array (
                'id' => 229,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 115,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3a119d8bef7942309046fafc809da3f3_37900/preview_target.webp',
            ),
            229 => 
            array (
                'id' => 230,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 115,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3a119d8bef7942309046fafc809da3f3_37900/preview_video_target.mp4',
            ),
            230 => 
            array (
                'id' => 231,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 116,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/37d7cd5b84d74a22bc7fc97eda3c3011_37900/preview_talk_2.webp',
            ),
            231 => 
            array (
                'id' => 232,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 116,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/37d7cd5b84d74a22bc7fc97eda3c3011_37900/preview_video_talk_2.mp4',
            ),
            232 => 
            array (
                'id' => 233,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 117,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cabc74337c474348ab080ca75d55111b_39680/preview_target.webp',
            ),
            233 => 
            array (
                'id' => 234,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 117,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cabc74337c474348ab080ca75d55111b_39680/preview_video_target.mp4',
            ),
            234 => 
            array (
                'id' => 235,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 118,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c1794f8106eb4f9391b3f7283473ca9c_44710/preview_talk_1.webp',
            ),
            235 => 
            array (
                'id' => 236,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 118,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c1794f8106eb4f9391b3f7283473ca9c_44710/preview_video_talk_1.mp4',
            ),
            236 => 
            array (
                'id' => 237,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 119,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33fda333525e41b4bbff63fe17169507_39530/preview_target.webp',
            ),
            237 => 
            array (
                'id' => 238,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 119,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33fda333525e41b4bbff63fe17169507_39530/preview_video_target.mp4',
            ),
            238 => 
            array (
                'id' => 239,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 120,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c4745b302cb848b7a9352ece1a6d1211_39400/preview_target.webp',
            ),
            239 => 
            array (
                'id' => 240,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 120,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c4745b302cb848b7a9352ece1a6d1211_39400/preview_video_target.mp4',
            ),
            240 => 
            array (
                'id' => 241,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 121,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e18ecbc69acb465b905beb42597496dc_39500/preview_target.webp',
            ),
            241 => 
            array (
                'id' => 242,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 121,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e18ecbc69acb465b905beb42597496dc_39500/preview_video_target.mp4',
            ),
            242 => 
            array (
                'id' => 243,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 122,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21f4de0e5c484eaabc74729e0be42fb3_39570/preview_target.webp',
            ),
            243 => 
            array (
                'id' => 244,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 122,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21f4de0e5c484eaabc74729e0be42fb3_39570/preview_video_target.mp4',
            ),
            244 => 
            array (
                'id' => 245,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 123,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7ee4b62fcfd2497592d0f7f564bad649_42700/preview_talk_1.webp',
            ),
            245 => 
            array (
                'id' => 246,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 123,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7ee4b62fcfd2497592d0f7f564bad649_42700/preview_video_talk_1.mp4',
            ),
            246 => 
            array (
                'id' => 247,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 124,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/97c26ee40b2d411482b98dfcaa634216_46890/preview_target.webp',
            ),
            247 => 
            array (
                'id' => 248,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 124,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/97c26ee40b2d411482b98dfcaa634216_46890/preview_video_target.mp4',
            ),
            248 => 
            array (
                'id' => 249,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 125,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/232789c980374dc39fc445cc2b4734ab_43140/preview_target.webp',
            ),
            249 => 
            array (
                'id' => 250,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 125,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/232789c980374dc39fc445cc2b4734ab_43140/preview_video_target.mp4',
            ),
            250 => 
            array (
                'id' => 251,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 126,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2808dbe6335043d5b5d5215cc97c4d78_44540/preview_talk_2.webp',
            ),
            251 => 
            array (
                'id' => 252,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 126,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2808dbe6335043d5b5d5215cc97c4d78_44540/preview_video_talk_2.mp4',
            ),
            252 => 
            array (
                'id' => 253,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 127,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/81bc1d34f34646c5a294b8861fb21bed_43180/preview_talk_2.webp',
            ),
            253 => 
            array (
                'id' => 254,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 127,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/81bc1d34f34646c5a294b8861fb21bed_43180/preview_video_talk_2.mp4',
            ),
            254 => 
            array (
                'id' => 255,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 128,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9e030e6461744e93b035a1c127d82516_43190/preview_talk_1.webp',
            ),
            255 => 
            array (
                'id' => 256,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 128,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9e030e6461744e93b035a1c127d82516_43190/preview_video_talk_1.mp4',
            ),
            256 => 
            array (
                'id' => 257,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 129,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9fbd6e6291044a5a74059166d17938a_43180/preview_talk_1.webp',
            ),
            257 => 
            array (
                'id' => 258,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 129,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9fbd6e6291044a5a74059166d17938a_43180/preview_video_talk_1.mp4',
            ),
            258 => 
            array (
                'id' => 259,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 130,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6f1c0a1b71304658bff0456a27671898_43190/preview_target.webp',
            ),
            259 => 
            array (
                'id' => 260,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 130,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6f1c0a1b71304658bff0456a27671898_43190/preview_video_target.mp4',
            ),
            260 => 
            array (
                'id' => 261,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 131,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a806334b76254cb7b3d483c75b5eeee6_42880/preview_talk_2.webp',
            ),
            261 => 
            array (
                'id' => 262,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 131,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a806334b76254cb7b3d483c75b5eeee6_42880/preview_video_talk_2.mp4',
            ),
            262 => 
            array (
                'id' => 263,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 132,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbe58d21cb154a09a06e73d8db614c64_42890/preview_talk_2.webp',
            ),
            263 => 
            array (
                'id' => 264,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 132,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbe58d21cb154a09a06e73d8db614c64_42890/preview_video_talk_2.mp4',
            ),
            264 => 
            array (
                'id' => 265,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 133,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b05489f9bf14615854a09786646fcc7_43170/preview_target.webp',
            ),
            265 => 
            array (
                'id' => 266,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 133,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b05489f9bf14615854a09786646fcc7_43170/preview_video_target.mp4',
            ),
            266 => 
            array (
                'id' => 267,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 134,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75429efd268945039288e4de35324817_42890/preview_talk_3.webp',
            ),
            267 => 
            array (
                'id' => 268,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 134,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75429efd268945039288e4de35324817_42890/preview_video_talk_3.mp4',
            ),
            268 => 
            array (
                'id' => 269,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 135,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a8b8b04207104269b45867d8911cc5ae_36840/preview_target.webp',
            ),
            269 => 
            array (
                'id' => 270,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 135,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a8b8b04207104269b45867d8911cc5ae_36840/preview_video_target.mp4',
            ),
            270 => 
            array (
                'id' => 271,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 136,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/190896214fa74092ae3b8a51a78bcd6a_36840/preview_talk_1.webp',
            ),
            271 => 
            array (
                'id' => 272,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 136,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/190896214fa74092ae3b8a51a78bcd6a_36840/preview_video_talk_1.mp4',
            ),
            272 => 
            array (
                'id' => 273,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 137,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae5aed552f1143549b0ffc4a935b93b7_36850/preview_target.webp',
            ),
            273 => 
            array (
                'id' => 274,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 137,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae5aed552f1143549b0ffc4a935b93b7_36850/preview_video_target.mp4',
            ),
            274 => 
            array (
                'id' => 275,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 138,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/985188a6d38348a38cf75aeae4f35c93_36850/preview_talk_1.webp',
            ),
            275 => 
            array (
                'id' => 276,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 138,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/985188a6d38348a38cf75aeae4f35c93_36850/preview_video_talk_1.mp4',
            ),
            276 => 
            array (
                'id' => 277,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 139,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/696bf477e22d4b51971a2e5d1f35192f_37360/preview_target.webp',
            ),
            277 => 
            array (
                'id' => 278,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 139,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/696bf477e22d4b51971a2e5d1f35192f_37360/preview_video_target.mp4',
            ),
            278 => 
            array (
                'id' => 279,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 140,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1734c69cbbaf40dba6c31a201dffc086_37090/preview_talk_1.webp',
            ),
            279 => 
            array (
                'id' => 280,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 140,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1734c69cbbaf40dba6c31a201dffc086_37090/preview_video_talk_1.mp4',
            ),
            280 => 
            array (
                'id' => 281,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 141,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b88ee6496cc74f21aeaea9a6d51f3998_37370/preview_talk_1.webp',
            ),
            281 => 
            array (
                'id' => 282,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 141,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b88ee6496cc74f21aeaea9a6d51f3998_37370/preview_video_talk_1.mp4',
            ),
            282 => 
            array (
                'id' => 283,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 142,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee82213708334fada41000f7e3758c47_37100/preview_talk_1.webp',
            ),
            283 => 
            array (
                'id' => 284,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 142,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee82213708334fada41000f7e3758c47_37100/preview_video_talk_1.mp4',
            ),
            284 => 
            array (
                'id' => 285,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 143,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/51d99b18bdec4ad39b58ca10b9973473_38510/preview_target.webp',
            ),
            285 => 
            array (
                'id' => 286,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 143,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/51d99b18bdec4ad39b58ca10b9973473_38510/preview_video_target.mp4',
            ),
            286 => 
            array (
                'id' => 287,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 144,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fb7baae003b44539b1d9f4a8b2b7f500_38520/preview_talk_1.webp',
            ),
            287 => 
            array (
                'id' => 288,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 144,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fb7baae003b44539b1d9f4a8b2b7f500_38520/preview_video_talk_1.mp4',
            ),
            288 => 
            array (
                'id' => 289,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 145,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4df6714eaf9c41659b064af419016c9d_38350/preview_target.webp',
            ),
            289 => 
            array (
                'id' => 290,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 145,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4df6714eaf9c41659b064af419016c9d_38350/preview_video_target.mp4',
            ),
            290 => 
            array (
                'id' => 291,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 146,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae8af02981248d998dd2f45e2366d3c_38370/preview_target.webp',
            ),
            291 => 
            array (
                'id' => 292,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 146,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae8af02981248d998dd2f45e2366d3c_38370/preview_video_target.mp4',
            ),
            292 => 
            array (
                'id' => 293,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 147,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e62dc394fe8459aad0978193425a19e_38380/preview_target.webp',
            ),
            293 => 
            array (
                'id' => 294,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 147,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e62dc394fe8459aad0978193425a19e_38380/preview_video_target.mp4',
            ),
            294 => 
            array (
                'id' => 295,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 148,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f7fc084722ab4cf49a60b961cc7a1aba_38390/preview_target.webp',
            ),
            295 => 
            array (
                'id' => 296,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 148,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f7fc084722ab4cf49a60b961cc7a1aba_38390/preview_video_target.mp4',
            ),
            296 => 
            array (
                'id' => 297,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 149,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/edd66a35d1d24c70b96cf534dd8bf4f3_38350/preview_talk_1.webp',
            ),
            297 => 
            array (
                'id' => 298,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 149,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/edd66a35d1d24c70b96cf534dd8bf4f3_38350/preview_video_talk_1.mp4',
            ),
            298 => 
            array (
                'id' => 299,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 150,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/91746ac0ba6d4fc6945141a7fd7ba94f_39450/preview_target.webp',
            ),
            299 => 
            array (
                'id' => 300,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 150,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/91746ac0ba6d4fc6945141a7fd7ba94f_39450/preview_video_target.mp4',
            ),
            300 => 
            array (
                'id' => 301,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 151,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/391d7595784140d0b627958c1c93aff1_39290/preview_talk_2.webp',
            ),
            301 => 
            array (
                'id' => 302,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 151,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/391d7595784140d0b627958c1c93aff1_39290/preview_video_talk_2.mp4',
            ),
            302 => 
            array (
                'id' => 303,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 152,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2823b7672add411f9152b61e9a35cb3e_39290/preview_talk_3.webp',
            ),
            303 => 
            array (
                'id' => 304,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 152,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2823b7672add411f9152b61e9a35cb3e_39290/preview_video_talk_3.mp4',
            ),
            304 => 
            array (
                'id' => 305,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 153,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c5516397fe54b60a88301e631a4ac01_39300/preview_talk_3.webp',
            ),
            305 => 
            array (
                'id' => 306,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 153,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c5516397fe54b60a88301e631a4ac01_39300/preview_video_talk_3.mp4',
            ),
            306 => 
            array (
                'id' => 307,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 154,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60cba321b0204363be5b256483187398_39300/preview_talk_2.webp',
            ),
            307 => 
            array (
                'id' => 308,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 154,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60cba321b0204363be5b256483187398_39300/preview_video_talk_2.mp4',
            ),
            308 => 
            array (
                'id' => 309,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 155,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c6fba3e91e34effa4dbab98b8bb9c14_39290/preview_talk_5.webp',
            ),
            309 => 
            array (
                'id' => 310,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 155,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c6fba3e91e34effa4dbab98b8bb9c14_39290/preview_video_talk_5.mp4',
            ),
            310 => 
            array (
                'id' => 311,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 156,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bad55976711c4992ab1fbc8cabaed126_39290/preview_talk_4.webp',
            ),
            311 => 
            array (
                'id' => 312,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 156,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bad55976711c4992ab1fbc8cabaed126_39290/preview_video_talk_4.mp4',
            ),
            312 => 
            array (
                'id' => 313,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 157,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/332cecb7cce14727b52a30ce699a542f_39310/preview_target.webp',
            ),
            313 => 
            array (
                'id' => 314,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 157,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/332cecb7cce14727b52a30ce699a542f_39310/preview_video_target.mp4',
            ),
            314 => 
            array (
                'id' => 315,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 158,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9945877106754f28a3bfe27533dce139_39300/preview_talk_4.webp',
            ),
            315 => 
            array (
                'id' => 316,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 158,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9945877106754f28a3bfe27533dce139_39300/preview_video_talk_4.mp4',
            ),
            316 => 
            array (
                'id' => 317,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 159,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cb0ae5ed511f4f38abe47351d7aa7619_39290/preview_talk_1.webp',
            ),
            317 => 
            array (
                'id' => 318,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 159,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cb0ae5ed511f4f38abe47351d7aa7619_39290/preview_video_talk_1.mp4',
            ),
            318 => 
            array (
                'id' => 319,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 160,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/365e65ba93b24697ab9be6b5c7535888_39290/preview_target.webp',
            ),
            319 => 
            array (
                'id' => 320,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 160,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/365e65ba93b24697ab9be6b5c7535888_39290/preview_video_target.mp4',
            ),
            320 => 
            array (
                'id' => 321,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 161,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0e68f5d5255648a685618487017b58a4_39300/preview_talk_1.webp',
            ),
            321 => 
            array (
                'id' => 322,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 161,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0e68f5d5255648a685618487017b58a4_39300/preview_video_talk_1.mp4',
            ),
            322 => 
            array (
                'id' => 323,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 162,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/721015cf222c44da922c7fe1d4ebcb5d_39300/preview_target.webp',
            ),
            323 => 
            array (
                'id' => 324,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 162,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/721015cf222c44da922c7fe1d4ebcb5d_39300/preview_video_target.mp4',
            ),
            324 => 
            array (
                'id' => 325,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 163,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c422d0fd8a0645458a084b68e3223a5b_34490/preview_talk_1.webp',
            ),
            325 => 
            array (
                'id' => 326,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 163,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c422d0fd8a0645458a084b68e3223a5b_34490/preview_video_talk_1.mp4',
            ),
            326 => 
            array (
                'id' => 327,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 164,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49f1225a81254457961a2a7baf887a28_34500/preview_talk_1.webp',
            ),
            327 => 
            array (
                'id' => 328,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 164,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49f1225a81254457961a2a7baf887a28_34500/preview_video_talk_1.mp4',
            ),
            328 => 
            array (
                'id' => 329,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 165,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9cbd922a3e324a1081a8b409a7c601b4_34510/preview_talk_1.webp',
            ),
            329 => 
            array (
                'id' => 330,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 165,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9cbd922a3e324a1081a8b409a7c601b4_34510/preview_video_talk_1.mp4',
            ),
            330 => 
            array (
                'id' => 331,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 166,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5f57202f32dc4604845dc3da6372e5e4_53100/preview_target.webp',
            ),
            331 => 
            array (
                'id' => 332,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 166,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5f57202f32dc4604845dc3da6372e5e4_53100/preview_video_target.mp4',
            ),
            332 => 
            array (
                'id' => 333,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 167,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60eee91ed9164189bca7b2cfe7d9f25f_53110/preview_target.webp',
            ),
            333 => 
            array (
                'id' => 334,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 167,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60eee91ed9164189bca7b2cfe7d9f25f_53110/preview_video_target.mp4',
            ),
            334 => 
            array (
                'id' => 335,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 168,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0978953f30744f8dbf7100b60d2a09b9_53210/preview_target.webp',
            ),
            335 => 
            array (
                'id' => 336,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 168,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0978953f30744f8dbf7100b60d2a09b9_53210/preview_video_target.mp4',
            ),
            336 => 
            array (
                'id' => 337,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 169,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4fd0dacf93e74e9ea1c8f9029bf16b25_56470/preview_talk_1.webp',
            ),
            337 => 
            array (
                'id' => 338,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 169,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4fd0dacf93e74e9ea1c8f9029bf16b25_56470/preview_video_talk_1.mp4',
            ),
            338 => 
            array (
                'id' => 339,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 170,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/73bd9bd18fc54d569badd2d51e87636c_56430/preview_target.webp',
            ),
            339 => 
            array (
                'id' => 340,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 170,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/73bd9bd18fc54d569badd2d51e87636c_56430/preview_video_target.mp4',
            ),
            340 => 
            array (
                'id' => 341,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 171,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/acdd45e9119c4c068e9685cdf93c687b_56470/preview_target.webp',
            ),
            341 => 
            array (
                'id' => 342,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 171,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/acdd45e9119c4c068e9685cdf93c687b_56470/preview_video_target.mp4',
            ),
            342 => 
            array (
                'id' => 343,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 172,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b501d62780243a78391bcd935f42a28_56480/preview_target.webp',
            ),
            343 => 
            array (
                'id' => 344,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 172,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b501d62780243a78391bcd935f42a28_56480/preview_video_target.mp4',
            ),
            344 => 
            array (
                'id' => 345,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 173,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13f7552901c7408dadd2b286d0a56885_56460/preview_target.webp',
            ),
            345 => 
            array (
                'id' => 346,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 173,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13f7552901c7408dadd2b286d0a56885_56460/preview_video_target.mp4',
            ),
            346 => 
            array (
                'id' => 347,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 174,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed920c43b4744d97b087340ff2736146_56420/preview_talk_3.webp',
            ),
            347 => 
            array (
                'id' => 348,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 174,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed920c43b4744d97b087340ff2736146_56420/preview_video_talk_3.mp4',
            ),
            348 => 
            array (
                'id' => 349,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 175,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d167565dc233493db56ed3f0de1515bd_56440/preview_talk_3.webp',
            ),
            349 => 
            array (
                'id' => 350,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 175,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d167565dc233493db56ed3f0de1515bd_56440/preview_video_talk_3.mp4',
            ),
            350 => 
            array (
                'id' => 351,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 176,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9e12b52fc964426a42e67e4349f14aa_56420/preview_talk_2.webp',
            ),
            351 => 
            array (
                'id' => 352,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 176,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9e12b52fc964426a42e67e4349f14aa_56420/preview_video_talk_2.mp4',
            ),
            352 => 
            array (
                'id' => 353,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 177,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f976a69d5c7c46a9a38f21497775453c_56440/preview_talk_2.webp',
            ),
            353 => 
            array (
                'id' => 354,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 177,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f976a69d5c7c46a9a38f21497775453c_56440/preview_video_talk_2.mp4',
            ),
            354 => 
            array (
                'id' => 355,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 178,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d83075f7f6cc4394aba9e7bc9cc7eaa9_56420/preview_talk_1.webp',
            ),
            355 => 
            array (
                'id' => 356,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 178,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d83075f7f6cc4394aba9e7bc9cc7eaa9_56420/preview_video_talk_1.mp4',
            ),
            356 => 
            array (
                'id' => 357,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 179,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f91ca96713e04efaa5c37e58c00fff5a_56440/preview_target.webp',
            ),
            357 => 
            array (
                'id' => 358,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 179,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f91ca96713e04efaa5c37e58c00fff5a_56440/preview_video_target.mp4',
            ),
            358 => 
            array (
                'id' => 359,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 180,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/caf1662da32b4224a20424b4f04560b9_56450/preview_target.webp',
            ),
            359 => 
            array (
                'id' => 360,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 180,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/caf1662da32b4224a20424b4f04560b9_56450/preview_video_target.mp4',
            ),
            360 => 
            array (
                'id' => 361,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 181,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a135e32af9ff4a70bfe66a75f274541b_56460/preview_talk_1.webp',
            ),
            361 => 
            array (
                'id' => 362,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 181,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a135e32af9ff4a70bfe66a75f274541b_56460/preview_video_talk_1.mp4',
            ),
            362 => 
            array (
                'id' => 363,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 182,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fc4d9cfbfe454b17a27d8ccfbd0f5461_56450/preview_talk_2.webp',
            ),
            363 => 
            array (
                'id' => 364,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 182,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fc4d9cfbfe454b17a27d8ccfbd0f5461_56450/preview_video_talk_2.mp4',
            ),
            364 => 
            array (
                'id' => 365,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 183,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77f01bf4c99047b6a0c07bd4546edb29_56460/preview_talk_2.webp',
            ),
            365 => 
            array (
                'id' => 366,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 183,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77f01bf4c99047b6a0c07bd4546edb29_56460/preview_video_talk_2.mp4',
            ),
            366 => 
            array (
                'id' => 367,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 184,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b69cbbb5f8274ef4b8592ebcfacc643a_56450/preview_talk_1.webp',
            ),
            367 => 
            array (
                'id' => 368,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 184,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b69cbbb5f8274ef4b8592ebcfacc643a_56450/preview_video_talk_1.mp4',
            ),
            368 => 
            array (
                'id' => 369,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 185,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dec54fe437c94fb2a1877282cc3bd584_56440/preview_talk_1.webp',
            ),
            369 => 
            array (
                'id' => 370,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 185,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dec54fe437c94fb2a1877282cc3bd584_56440/preview_video_talk_1.mp4',
            ),
            370 => 
            array (
                'id' => 371,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 186,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b0ee32f7d0040bb93a0de37aca11530_56420/preview_target.webp',
            ),
            371 => 
            array (
                'id' => 372,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 186,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b0ee32f7d0040bb93a0de37aca11530_56420/preview_video_target.mp4',
            ),
            372 => 
            array (
                'id' => 373,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 187,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d018125159b44e01847bc192c85a2e8b_36800/preview_talk_1.webp',
            ),
            373 => 
            array (
                'id' => 374,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 187,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d018125159b44e01847bc192c85a2e8b_36800/preview_video_talk_1.mp4',
            ),
            374 => 
            array (
                'id' => 375,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 188,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/032a89b9f70440a49aade4e7a9069229_36790/preview_talk_9.webp',
            ),
            375 => 
            array (
                'id' => 376,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 188,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/032a89b9f70440a49aade4e7a9069229_36790/preview_video_talk_9.mp4',
            ),
            376 => 
            array (
                'id' => 377,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 189,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e543f891e849403fb1836d43c2ae9a6c_36810/preview_target.webp',
            ),
            377 => 
            array (
                'id' => 378,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 189,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e543f891e849403fb1836d43c2ae9a6c_36810/preview_video_target.mp4',
            ),
            378 => 
            array (
                'id' => 379,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 190,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48ab1b4af8564d1888bbc1aa4023c573_36780/preview_talk_9.webp',
            ),
            379 => 
            array (
                'id' => 380,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 190,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48ab1b4af8564d1888bbc1aa4023c573_36780/preview_video_talk_9.mp4',
            ),
            380 => 
            array (
                'id' => 381,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 191,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f8a2243b054942a69b4bc529a8a58651_36720/preview_talk_2.webp',
            ),
            381 => 
            array (
                'id' => 382,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 191,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f8a2243b054942a69b4bc529a8a58651_36720/preview_video_talk_2.mp4',
            ),
            382 => 
            array (
                'id' => 383,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 192,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3eda8aa23aec402f82b7c7f4b1c276fa_36700/preview_talk_1.webp',
            ),
            383 => 
            array (
                'id' => 384,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 192,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3eda8aa23aec402f82b7c7f4b1c276fa_36700/preview_video_talk_1.mp4',
            ),
            384 => 
            array (
                'id' => 385,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 193,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8cf0bd0a90d94364b5133c62b9a06cf0_36730/preview_talk_3.webp',
            ),
            385 => 
            array (
                'id' => 386,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 193,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8cf0bd0a90d94364b5133c62b9a06cf0_36730/preview_video_talk_3.mp4',
            ),
            386 => 
            array (
                'id' => 387,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 194,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c904025bcfbb44c093cbfbb4aa69d39c_36710/preview_talk_2.webp',
            ),
            387 => 
            array (
                'id' => 388,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 194,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c904025bcfbb44c093cbfbb4aa69d39c_36710/preview_video_talk_2.mp4',
            ),
            388 => 
            array (
                'id' => 389,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 195,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/06885be851ed42d1a2a5192598d9ab80_52290/preview_target.webp',
            ),
            389 => 
            array (
                'id' => 390,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 195,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/06885be851ed42d1a2a5192598d9ab80_52290/preview_video_target.mp4',
            ),
            390 => 
            array (
                'id' => 391,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 196,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7fbef4dd1d6641bc8777b26a6aaac85e_45580/preview_talk_1.webp',
            ),
            391 => 
            array (
                'id' => 392,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 196,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7fbef4dd1d6641bc8777b26a6aaac85e_45580/preview_video_talk_1.mp4',
            ),
            392 => 
            array (
                'id' => 393,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 197,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33c9ac4aead44dfc8bc0082a35062a70_45580/preview_talk_3.webp',
            ),
            393 => 
            array (
                'id' => 394,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 197,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33c9ac4aead44dfc8bc0082a35062a70_45580/preview_video_talk_3.mp4',
            ),
            394 => 
            array (
                'id' => 395,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 198,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec48aa774b094e82bbafc1767852174f_43310/preview_talk_1.webp',
            ),
            395 => 
            array (
                'id' => 396,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 198,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec48aa774b094e82bbafc1767852174f_43310/preview_video_talk_1.mp4',
            ),
            396 => 
            array (
                'id' => 397,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 199,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a0d217c2271045e28d16473f244cc20d_43320/preview_talk_3.webp',
            ),
            397 => 
            array (
                'id' => 398,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 199,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a0d217c2271045e28d16473f244cc20d_43320/preview_video_talk_3.mp4',
            ),
            398 => 
            array (
                'id' => 399,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 200,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f9ac3130d26b408589e2cfbf8c9d3c2a_45540/preview_talk_2.webp',
            ),
            399 => 
            array (
                'id' => 400,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 200,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f9ac3130d26b408589e2cfbf8c9d3c2a_45540/preview_video_talk_2.mp4',
            ),
            400 => 
            array (
                'id' => 401,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 201,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8564c18a136840e29a0c54fad090ba36_45530/preview_target.webp',
            ),
            401 => 
            array (
                'id' => 402,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 201,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8564c18a136840e29a0c54fad090ba36_45530/preview_video_target.mp4',
            ),
            402 => 
            array (
                'id' => 403,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 202,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d7d37e8b1aef4d5ab925ab3eeac488c5_45540/preview_target.webp',
            ),
            403 => 
            array (
                'id' => 404,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 202,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d7d37e8b1aef4d5ab925ab3eeac488c5_45540/preview_video_target.mp4',
            ),
            404 => 
            array (
                'id' => 405,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 203,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d50c1347171c4d9586d1a8b868b88d20_34520/preview_talk_1.webp',
            ),
            405 => 
            array (
                'id' => 406,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 203,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d50c1347171c4d9586d1a8b868b88d20_34520/preview_video_talk_1.mp4',
            ),
            406 => 
            array (
                'id' => 407,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 204,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9c63740a813e4670948914a8a92df3e0_34540/preview_talk_1.webp',
            ),
            407 => 
            array (
                'id' => 408,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 204,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9c63740a813e4670948914a8a92df3e0_34540/preview_video_talk_1.mp4',
            ),
            408 => 
            array (
                'id' => 409,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 205,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1aebde1aec54c11b8b1cd16c14de3db_34530/preview_talk_1.webp',
            ),
            409 => 
            array (
                'id' => 410,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 205,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1aebde1aec54c11b8b1cd16c14de3db_34530/preview_video_talk_1.mp4',
            ),
            410 => 
            array (
                'id' => 411,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 206,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d8d24a798bf42fa8ff1210c4ca783c0_35270/preview_talk_1.webp',
            ),
            411 => 
            array (
                'id' => 412,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 206,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d8d24a798bf42fa8ff1210c4ca783c0_35270/preview_video_talk_1.mp4',
            ),
            412 => 
            array (
                'id' => 413,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 207,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9191fd6306e48019135729eefc8547d_35460/preview_target.webp',
            ),
            413 => 
            array (
                'id' => 414,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 207,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9191fd6306e48019135729eefc8547d_35460/preview_video_target.mp4',
            ),
            414 => 
            array (
                'id' => 415,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 208,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aa0d9b88e3824c049210c2f4b9cb2ced_35270/preview_target.webp',
            ),
            415 => 
            array (
                'id' => 416,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 208,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aa0d9b88e3824c049210c2f4b9cb2ced_35270/preview_video_target.mp4',
            ),
            416 => 
            array (
                'id' => 417,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 209,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/99b4106e46494a4cb9731de8fb7a02b2_35280/preview_target.webp',
            ),
            417 => 
            array (
                'id' => 418,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 209,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/99b4106e46494a4cb9731de8fb7a02b2_35280/preview_video_target.mp4',
            ),
            418 => 
            array (
                'id' => 419,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 210,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/de842dc5e72d46e19769f266d6592cec_46200/preview_target.webp',
            ),
            419 => 
            array (
                'id' => 420,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 210,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/de842dc5e72d46e19769f266d6592cec_46200/preview_video_target.mp4',
            ),
            420 => 
            array (
                'id' => 421,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 211,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2e4a1f950b7e433a82266ca1b3b3b35e_46120/preview_target.webp',
            ),
            421 => 
            array (
                'id' => 422,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 211,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2e4a1f950b7e433a82266ca1b3b3b35e_46120/preview_video_target.mp4',
            ),
            422 => 
            array (
                'id' => 423,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 212,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8a6b6606ed164dd686941b9cf7b454b3_47080/preview_talk_1.webp',
            ),
            423 => 
            array (
                'id' => 424,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 212,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8a6b6606ed164dd686941b9cf7b454b3_47080/preview_video_talk_1.mp4',
            ),
            424 => 
            array (
                'id' => 425,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 213,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/df6bd16e971e49f8920a035288729936_47090/preview_target.webp',
            ),
            425 => 
            array (
                'id' => 426,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 213,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/df6bd16e971e49f8920a035288729936_47090/preview_video_target.mp4',
            ),
            426 => 
            array (
                'id' => 427,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 214,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75e4f326918c45028fe06bc9dc0c45da_56520/preview_talk_2.webp',
            ),
            427 => 
            array (
                'id' => 428,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 214,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75e4f326918c45028fe06bc9dc0c45da_56520/preview_video_talk_2.mp4',
            ),
            428 => 
            array (
                'id' => 429,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 215,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/888acf282a044ad5a782bae81896a2e5_56500/preview_target.webp',
            ),
            429 => 
            array (
                'id' => 430,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 215,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/888acf282a044ad5a782bae81896a2e5_56500/preview_video_target.mp4',
            ),
            430 => 
            array (
                'id' => 431,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 216,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0b2e86f53a914241bed4a852044c1a07_56520/preview_talk_3.webp',
            ),
            431 => 
            array (
                'id' => 432,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 216,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0b2e86f53a914241bed4a852044c1a07_56520/preview_video_talk_3.mp4',
            ),
            432 => 
            array (
                'id' => 433,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 217,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f3fcaa4f09e7472a852114b590fa2a8d_56530/preview_talk_1.webp',
            ),
            433 => 
            array (
                'id' => 434,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 217,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f3fcaa4f09e7472a852114b590fa2a8d_56530/preview_video_talk_1.mp4',
            ),
            434 => 
            array (
                'id' => 435,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 218,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa1a44f802eb451b8378fa28a313f4a8_53460/preview_target.webp',
            ),
            435 => 
            array (
                'id' => 436,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 218,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa1a44f802eb451b8378fa28a313f4a8_53460/preview_video_target.mp4',
            ),
            436 => 
            array (
                'id' => 437,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 219,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60c45d1ba2ef4b50ba05ba44393531b6_53200/preview_target.webp',
            ),
            437 => 
            array (
                'id' => 438,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 219,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60c45d1ba2ef4b50ba05ba44393531b6_53200/preview_video_target.mp4',
            ),
            438 => 
            array (
                'id' => 439,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 220,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09c735e083fa4821ba29ab077518b6f0_53190/preview_target.webp',
            ),
            439 => 
            array (
                'id' => 440,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 220,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09c735e083fa4821ba29ab077518b6f0_53190/preview_video_target.mp4',
            ),
            440 => 
            array (
                'id' => 441,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 221,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cdf4aff51ea147e0bd88e88d86cdd0c6_53080/preview_target.webp',
            ),
            441 => 
            array (
                'id' => 442,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 221,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cdf4aff51ea147e0bd88e88d86cdd0c6_53080/preview_video_target.mp4',
            ),
            442 => 
            array (
                'id' => 443,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 222,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f39a2f74c5fb4a4e862b5ff1a199aa10_56530/preview_target.webp',
            ),
            443 => 
            array (
                'id' => 444,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 222,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f39a2f74c5fb4a4e862b5ff1a199aa10_56530/preview_video_target.mp4',
            ),
            444 => 
            array (
                'id' => 445,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 223,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/82300d1188ef452199bef275affea43a_56490/preview_talk_1.webp',
            ),
            445 => 
            array (
                'id' => 446,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 223,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/82300d1188ef452199bef275affea43a_56490/preview_video_talk_1.mp4',
            ),
            446 => 
            array (
                'id' => 447,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 224,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fc911d9b046040a0a59a2cc487915189_56510/preview_talk_3.webp',
            ),
            447 => 
            array (
                'id' => 448,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 224,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fc911d9b046040a0a59a2cc487915189_56510/preview_video_talk_3.mp4',
            ),
            448 => 
            array (
                'id' => 449,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 225,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/646555f344894ad2aa5f5cd78847e411_56490/preview_talk_3.webp',
            ),
            449 => 
            array (
                'id' => 450,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 225,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/646555f344894ad2aa5f5cd78847e411_56490/preview_video_talk_3.mp4',
            ),
            450 => 
            array (
                'id' => 451,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 226,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2d4cd479a784aef8266f1408800a49e_56510/preview_talk_2.webp',
            ),
            451 => 
            array (
                'id' => 452,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 226,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2d4cd479a784aef8266f1408800a49e_56510/preview_video_talk_2.mp4',
            ),
            452 => 
            array (
                'id' => 453,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 227,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/eb18399de63e44409044ce7dd551c7d7_56490/preview_talk_2.webp',
            ),
            453 => 
            array (
                'id' => 454,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 227,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/eb18399de63e44409044ce7dd551c7d7_56490/preview_video_talk_2.mp4',
            ),
            454 => 
            array (
                'id' => 455,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 228,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7be8979f94954968bafa45388069f7e5_56520/preview_target.webp',
            ),
            455 => 
            array (
                'id' => 456,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 228,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7be8979f94954968bafa45388069f7e5_56520/preview_video_target.mp4',
            ),
            456 => 
            array (
                'id' => 457,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 229,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/90ccd5692fec46c6a26156893bcbfa77_56540/preview_talk_1.webp',
            ),
            457 => 
            array (
                'id' => 458,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 229,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/90ccd5692fec46c6a26156893bcbfa77_56540/preview_video_talk_1.mp4',
            ),
            458 => 
            array (
                'id' => 459,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 230,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/662d937a621d4fc5be1d68c626bf9c62_56520/preview_talk_1.webp',
            ),
            459 => 
            array (
                'id' => 460,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 230,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/662d937a621d4fc5be1d68c626bf9c62_56520/preview_video_talk_1.mp4',
            ),
            460 => 
            array (
                'id' => 461,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 231,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/efb7fc61fcdb43968fd2486af63c0017_56540/preview_talk_1.webp',
            ),
            461 => 
            array (
                'id' => 462,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 231,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/efb7fc61fcdb43968fd2486af63c0017_56540/preview_video_talk_1.mp4',
            ),
            462 => 
            array (
                'id' => 463,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 232,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed6a1f3702ad4248b0d04f9d6f3470a0_56510/preview_talk_1.webp',
            ),
            463 => 
            array (
                'id' => 464,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 232,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed6a1f3702ad4248b0d04f9d6f3470a0_56510/preview_video_talk_1.mp4',
            ),
            464 => 
            array (
                'id' => 465,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 233,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48a976bfc7ca4db0b83e68995edc17ca_56540/preview_talk_2.webp',
            ),
            465 => 
            array (
                'id' => 466,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 233,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48a976bfc7ca4db0b83e68995edc17ca_56540/preview_video_talk_2.mp4',
            ),
            466 => 
            array (
                'id' => 467,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 234,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e52b899fc5c54b519d0c79b3c4faa514_56510/preview_target.webp',
            ),
            467 => 
            array (
                'id' => 468,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 234,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e52b899fc5c54b519d0c79b3c4faa514_56510/preview_video_target.mp4',
            ),
            468 => 
            array (
                'id' => 469,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 235,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/875a9f8fbea74bfe85b65beae04f056a_56490/preview_target.webp',
            ),
            469 => 
            array (
                'id' => 470,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 235,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/875a9f8fbea74bfe85b65beae04f056a_56490/preview_video_target.mp4',
            ),
            470 => 
            array (
                'id' => 471,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 236,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/575f7e5be4084f57a7d0790766b52714_34900/preview_target.webp',
            ),
            471 => 
            array (
                'id' => 472,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 236,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/575f7e5be4084f57a7d0790766b52714_34900/preview_video_target.mp4',
            ),
            472 => 
            array (
                'id' => 473,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 237,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/06e9e5ebb60e41d58d03f9b3fff8ddd6_34910/preview_target.webp',
            ),
            473 => 
            array (
                'id' => 474,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 237,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/06e9e5ebb60e41d58d03f9b3fff8ddd6_34910/preview_video_target.mp4',
            ),
            474 => 
            array (
                'id' => 475,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 238,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5394a7147272444a9464b5510f9cf1a2_34920/preview_target.webp',
            ),
            475 => 
            array (
                'id' => 476,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 238,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5394a7147272444a9464b5510f9cf1a2_34920/preview_video_target.mp4',
            ),
            476 => 
            array (
                'id' => 477,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 239,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbb6d8112bf94261b0359c436d84e7af_34990/preview_target.webp',
            ),
            477 => 
            array (
                'id' => 478,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 239,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbb6d8112bf94261b0359c436d84e7af_34990/preview_video_target.mp4',
            ),
            478 => 
            array (
                'id' => 479,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 240,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5722a2844e74401fbdcc7cd738b04841_35010/preview_target.webp',
            ),
            479 => 
            array (
                'id' => 480,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 240,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5722a2844e74401fbdcc7cd738b04841_35010/preview_video_target.mp4',
            ),
            480 => 
            array (
                'id' => 481,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 241,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6fb001cf69dc43f9a751a54b4b46d347_35190/preview_target.webp',
            ),
            481 => 
            array (
                'id' => 482,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 241,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6fb001cf69dc43f9a751a54b4b46d347_35190/preview_video_target.mp4',
            ),
            482 => 
            array (
                'id' => 483,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 242,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/66a0acd4479e467b8d8f31eaadb9aa35_44820/preview_target.webp',
            ),
            483 => 
            array (
                'id' => 484,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 242,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/66a0acd4479e467b8d8f31eaadb9aa35_44820/preview_video_target.mp4',
            ),
            484 => 
            array (
                'id' => 485,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 243,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/874b8f9546d34bb49a7f536c8efaabdd_38950/preview_talk_2.webp',
            ),
            485 => 
            array (
                'id' => 486,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 243,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/874b8f9546d34bb49a7f536c8efaabdd_38950/preview_video_talk_2.mp4',
            ),
            486 => 
            array (
                'id' => 487,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 244,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f9cf88722b454aee8275454fde3c1ac1_38950/preview_target.webp',
            ),
            487 => 
            array (
                'id' => 488,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 244,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f9cf88722b454aee8275454fde3c1ac1_38950/preview_video_target.mp4',
            ),
            488 => 
            array (
                'id' => 489,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 245,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a5489521612d405ea3bb6e8bcdcc0f58_38950/preview_talk_1.webp',
            ),
            489 => 
            array (
                'id' => 490,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 245,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a5489521612d405ea3bb6e8bcdcc0f58_38950/preview_video_talk_1.mp4',
            ),
            490 => 
            array (
                'id' => 491,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 246,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26ab680d5c5a46bf919d3c84f66ae49a_43050/preview_talk_6.webp',
            ),
            491 => 
            array (
                'id' => 492,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 246,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26ab680d5c5a46bf919d3c84f66ae49a_43050/preview_video_talk_6.mp4',
            ),
            492 => 
            array (
                'id' => 493,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 247,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6523884e1c354d6f98442537b84608e0_44910/preview_talk_1.webp',
            ),
            493 => 
            array (
                'id' => 494,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 247,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6523884e1c354d6f98442537b84608e0_44910/preview_video_talk_1.mp4',
            ),
            494 => 
            array (
                'id' => 495,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 248,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3bf8bd3d5e7f4b86a6f5215bdb7ec4be_44920/preview_target.webp',
            ),
            495 => 
            array (
                'id' => 496,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 248,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3bf8bd3d5e7f4b86a6f5215bdb7ec4be_44920/preview_video_target.mp4',
            ),
            496 => 
            array (
                'id' => 497,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 249,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea333829d88c4fc8b6d08e8baf80297a_37140/preview_talk_3.webp',
            ),
            497 => 
            array (
                'id' => 498,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 249,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea333829d88c4fc8b6d08e8baf80297a_37140/preview_video_talk_3.mp4',
            ),
            498 => 
            array (
                'id' => 499,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 250,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/374c45b0a3e448b4800d2e324b0c71d5_37230/preview_target.webp',
            ),
            499 => 
            array (
                'id' => 500,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 250,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/374c45b0a3e448b4800d2e324b0c71d5_37230/preview_video_target.mp4',
            ),
        ));
        \DB::table('avatar_metas')->insert(array (
            0 => 
            array (
                'id' => 501,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 251,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e45585843830421496f598bf27e00dee_37140/preview_target.webp',
            ),
            1 => 
            array (
                'id' => 502,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 251,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e45585843830421496f598bf27e00dee_37140/preview_video_target.mp4',
            ),
            2 => 
            array (
                'id' => 503,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 252,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c93e6cf24e9c4fd9b65fffeb676e43d7_37240/preview_target.webp',
            ),
            3 => 
            array (
                'id' => 504,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 252,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c93e6cf24e9c4fd9b65fffeb676e43d7_37240/preview_video_target.mp4',
            ),
            4 => 
            array (
                'id' => 505,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 253,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fe8d76f83ac745c58c9e36c86f1c46b3_48730/preview_target.webp',
            ),
            5 => 
            array (
                'id' => 506,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 253,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fe8d76f83ac745c58c9e36c86f1c46b3_48730/preview_video_target.mp4',
            ),
            6 => 
            array (
                'id' => 507,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 254,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/251e0ab5bc5f481da0f1392c86411cde_48750/preview_target.webp',
            ),
            7 => 
            array (
                'id' => 508,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 254,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/251e0ab5bc5f481da0f1392c86411cde_48750/preview_video_target.mp4',
            ),
            8 => 
            array (
                'id' => 509,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 255,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9bfe2cb582ea4471914db54b7014333d_45990/preview_talk_2.webp',
            ),
            9 => 
            array (
                'id' => 510,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 255,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9bfe2cb582ea4471914db54b7014333d_45990/preview_video_talk_2.mp4',
            ),
            10 => 
            array (
                'id' => 511,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 256,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8184dd633854458f921b3ecdc84f6bb9_45990/preview_talk_1.webp',
            ),
            11 => 
            array (
                'id' => 512,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 256,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8184dd633854458f921b3ecdc84f6bb9_45990/preview_video_talk_1.mp4',
            ),
            12 => 
            array (
                'id' => 513,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 257,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/595bcc34f197459397203cc71eef4fcc_46000/preview_talk_2.webp',
            ),
            13 => 
            array (
                'id' => 514,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 257,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/595bcc34f197459397203cc71eef4fcc_46000/preview_video_talk_2.mp4',
            ),
            14 => 
            array (
                'id' => 515,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 258,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c9ad0e45b104e38806d38ea99d307b6_46000/preview_talk_1.webp',
            ),
            15 => 
            array (
                'id' => 516,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 258,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c9ad0e45b104e38806d38ea99d307b6_46000/preview_video_talk_1.mp4',
            ),
            16 => 
            array (
                'id' => 517,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 259,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/50929322ce354a5e8891de769339ec02_45990/preview_talk_4.webp',
            ),
            17 => 
            array (
                'id' => 518,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 259,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/50929322ce354a5e8891de769339ec02_45990/preview_video_talk_4.mp4',
            ),
            18 => 
            array (
                'id' => 519,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 260,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/609219c42e98438eb83e79d27ef30994_48730/preview_talk_1.webp',
            ),
            19 => 
            array (
                'id' => 520,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 260,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/609219c42e98438eb83e79d27ef30994_48730/preview_video_talk_1.mp4',
            ),
            20 => 
            array (
                'id' => 521,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 261,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/61e413f7cb0d4e29b66ad59fcda6fc91_48740/preview_target.webp',
            ),
            21 => 
            array (
                'id' => 522,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 261,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/61e413f7cb0d4e29b66ad59fcda6fc91_48740/preview_video_target.mp4',
            ),
            22 => 
            array (
                'id' => 523,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 262,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e63eebb8055a4b16ac51d77e0fb4f8ed_45460/preview_talk_1.webp',
            ),
            23 => 
            array (
                'id' => 524,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 262,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e63eebb8055a4b16ac51d77e0fb4f8ed_45460/preview_video_talk_1.mp4',
            ),
            24 => 
            array (
                'id' => 525,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 263,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9d2aa21493724557bd0228de61382f05_45470/preview_talk_1.webp',
            ),
            25 => 
            array (
                'id' => 526,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 263,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9d2aa21493724557bd0228de61382f05_45470/preview_video_talk_1.mp4',
            ),
            26 => 
            array (
                'id' => 527,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 264,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae32614418ff4f229decdb497c35a013_48710/preview_talk_1.webp',
            ),
            27 => 
            array (
                'id' => 528,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 264,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae32614418ff4f229decdb497c35a013_48710/preview_video_talk_1.mp4',
            ),
            28 => 
            array (
                'id' => 529,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 265,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4297793cdef44da0b830cf9b404a9a5f_48720/preview_target.webp',
            ),
            29 => 
            array (
                'id' => 530,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 265,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4297793cdef44da0b830cf9b404a9a5f_48720/preview_video_target.mp4',
            ),
            30 => 
            array (
                'id' => 531,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 266,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/373673b402554493af33d61d76ce9c8d_34550/preview_talk_1.webp',
            ),
            31 => 
            array (
                'id' => 532,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 266,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/373673b402554493af33d61d76ce9c8d_34550/preview_video_talk_1.mp4',
            ),
            32 => 
            array (
                'id' => 533,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 267,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e5bf9c0cf4b4430f863785dbbe1c4861_34560/preview_talk_1.webp',
            ),
            33 => 
            array (
                'id' => 534,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 267,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e5bf9c0cf4b4430f863785dbbe1c4861_34560/preview_video_talk_1.mp4',
            ),
            34 => 
            array (
                'id' => 535,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 268,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/447b8c46b2f942f183d24d80724fd96f_34570/preview_talk_1.webp',
            ),
            35 => 
            array (
                'id' => 536,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 268,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/447b8c46b2f942f183d24d80724fd96f_34570/preview_video_talk_1.mp4',
            ),
            36 => 
            array (
                'id' => 537,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 269,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c37a49d797a94e038a72b25d000b887f_36860/preview_talk_1.webp',
            ),
            37 => 
            array (
                'id' => 538,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 269,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c37a49d797a94e038a72b25d000b887f_36860/preview_video_talk_1.mp4',
            ),
            38 => 
            array (
                'id' => 539,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 270,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09afea387ab6458c96ffa792357f8b98_36860/preview_talk_3.webp',
            ),
            39 => 
            array (
                'id' => 540,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 270,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09afea387ab6458c96ffa792357f8b98_36860/preview_video_talk_3.mp4',
            ),
            40 => 
            array (
                'id' => 541,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 271,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6c9c809bf75546e3931aabc1e84cf219_36870/preview_talk_1.webp',
            ),
            41 => 
            array (
                'id' => 542,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 271,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6c9c809bf75546e3931aabc1e84cf219_36870/preview_video_talk_1.mp4',
            ),
            42 => 
            array (
                'id' => 543,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 272,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db02a94ab35b490e843d522953dc415f_36870/preview_talk_3.webp',
            ),
            43 => 
            array (
                'id' => 544,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 272,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db02a94ab35b490e843d522953dc415f_36870/preview_video_talk_3.mp4',
            ),
            44 => 
            array (
                'id' => 545,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 273,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9c63c979d47f431382993c741ea5da25_36960/preview_talk_1.webp',
            ),
            45 => 
            array (
                'id' => 546,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 273,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9c63c979d47f431382993c741ea5da25_36960/preview_video_talk_1.mp4',
            ),
            46 => 
            array (
                'id' => 547,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 274,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0942815c4e10448c9b3566554c66ef49_36960/preview_target.webp',
            ),
            47 => 
            array (
                'id' => 548,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 274,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0942815c4e10448c9b3566554c66ef49_36960/preview_video_target.mp4',
            ),
            48 => 
            array (
                'id' => 549,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 275,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec27ac59aa0c41a0b8e950172031ee4b_36970/preview_target.webp',
            ),
            49 => 
            array (
                'id' => 550,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 275,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec27ac59aa0c41a0b8e950172031ee4b_36970/preview_video_target.mp4',
            ),
            50 => 
            array (
                'id' => 551,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 276,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8553ece9db5f4cc78e0ab5f49911cb1c_36970/preview_talk_1.webp',
            ),
            51 => 
            array (
                'id' => 552,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 276,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8553ece9db5f4cc78e0ab5f49911cb1c_36970/preview_video_talk_1.mp4',
            ),
            52 => 
            array (
                'id' => 553,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 277,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f83fffc45faa4368b6db9597e6b323ca_45590/preview_talk_3.webp',
            ),
            53 => 
            array (
                'id' => 554,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 277,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f83fffc45faa4368b6db9597e6b323ca_45590/preview_video_talk_3.mp4',
            ),
            54 => 
            array (
                'id' => 555,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 278,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88d421f939044bb08d892e833931948b_45590/preview_talk_1.webp',
            ),
            55 => 
            array (
                'id' => 556,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 278,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88d421f939044bb08d892e833931948b_45590/preview_video_talk_1.mp4',
            ),
            56 => 
            array (
                'id' => 557,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 279,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e20ac0c902184ff793e75ae4e139b7dc_45600/preview_target.webp',
            ),
            57 => 
            array (
                'id' => 558,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 279,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e20ac0c902184ff793e75ae4e139b7dc_45600/preview_video_target.mp4',
            ),
            58 => 
            array (
                'id' => 559,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 280,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b3389bc365d4c7980141f50fc27d1cb_42070/preview_target.webp',
            ),
            59 => 
            array (
                'id' => 560,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 280,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b3389bc365d4c7980141f50fc27d1cb_42070/preview_video_target.mp4',
            ),
            60 => 
            array (
                'id' => 561,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 281,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b40abfbefb84a429591dce31a1902e1_42080/preview_talk_2.webp',
            ),
            61 => 
            array (
                'id' => 562,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 281,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b40abfbefb84a429591dce31a1902e1_42080/preview_video_talk_2.mp4',
            ),
            62 => 
            array (
                'id' => 563,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 282,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f23c696b73ea44fc86eb7e7c5c9eaf23_42330/preview_talk_2.webp',
            ),
            63 => 
            array (
                'id' => 564,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 282,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f23c696b73ea44fc86eb7e7c5c9eaf23_42330/preview_video_talk_2.mp4',
            ),
            64 => 
            array (
                'id' => 565,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 283,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80ffca2ba14545149b90e56ee65a3e24_42330/preview_talk_1.webp',
            ),
            65 => 
            array (
                'id' => 566,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 283,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80ffca2ba14545149b90e56ee65a3e24_42330/preview_video_talk_1.mp4',
            ),
            66 => 
            array (
                'id' => 567,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 284,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f6d41d04e1384d58a3d2447f2f8d5e17_42320/preview_target.webp',
            ),
            67 => 
            array (
                'id' => 568,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 284,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f6d41d04e1384d58a3d2447f2f8d5e17_42320/preview_video_target.mp4',
            ),
            68 => 
            array (
                'id' => 569,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 285,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a50ecbe2d54f4aefb90b03d3df561228_42320/preview_talk_2.webp',
            ),
            69 => 
            array (
                'id' => 570,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 285,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a50ecbe2d54f4aefb90b03d3df561228_42320/preview_video_talk_2.mp4',
            ),
            70 => 
            array (
                'id' => 571,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 286,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0993152f8f6447d5b33be7baba4d3736_42330/preview_target.webp',
            ),
            71 => 
            array (
                'id' => 572,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 286,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0993152f8f6447d5b33be7baba4d3736_42330/preview_video_target.mp4',
            ),
            72 => 
            array (
                'id' => 573,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 287,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/50c76013151b4ad0a9e1b2641bbebe88_42320/preview_talk_1.webp',
            ),
            73 => 
            array (
                'id' => 574,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 287,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/50c76013151b4ad0a9e1b2641bbebe88_42320/preview_video_talk_1.mp4',
            ),
            74 => 
            array (
                'id' => 575,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 288,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e5afdfe8bdb44f3ae18b90281ab034c_45610/preview_talk_1.webp',
            ),
            75 => 
            array (
                'id' => 576,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 288,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e5afdfe8bdb44f3ae18b90281ab034c_45610/preview_video_talk_1.mp4',
            ),
            76 => 
            array (
                'id' => 577,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 289,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e097a0182d5e4f5a8dabc656fd39c063_45610/preview_target.webp',
            ),
            77 => 
            array (
                'id' => 578,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 289,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e097a0182d5e4f5a8dabc656fd39c063_45610/preview_video_target.mp4',
            ),
            78 => 
            array (
                'id' => 579,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 290,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbd4a69890a040e6a0d54088e606a559_45610/preview_talk_3.webp',
            ),
            79 => 
            array (
                'id' => 580,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 290,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbd4a69890a040e6a0d54088e606a559_45610/preview_video_talk_3.mp4',
            ),
            80 => 
            array (
                'id' => 581,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 291,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ecb3781b0b1420f8244d7ac13f00407_37150/preview_target.webp',
            ),
            81 => 
            array (
                'id' => 582,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 291,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ecb3781b0b1420f8244d7ac13f00407_37150/preview_video_target.mp4',
            ),
            82 => 
            array (
                'id' => 583,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 292,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1d81ce162544fb0955bc9896411514b_37250/preview_talk_1.webp',
            ),
            83 => 
            array (
                'id' => 584,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 292,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1d81ce162544fb0955bc9896411514b_37250/preview_video_talk_1.mp4',
            ),
            84 => 
            array (
                'id' => 585,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 293,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b18507ce1ab74d1dacb7112bb16f2440_37150/preview_talk_2.webp',
            ),
            85 => 
            array (
                'id' => 586,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 293,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b18507ce1ab74d1dacb7112bb16f2440_37150/preview_video_talk_2.mp4',
            ),
            86 => 
            array (
                'id' => 587,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 294,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b6d50563342f4037b1561b9b9c011527_37260/preview_target.webp',
            ),
            87 => 
            array (
                'id' => 588,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 294,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b6d50563342f4037b1561b9b9c011527_37260/preview_video_target.mp4',
            ),
            88 => 
            array (
                'id' => 589,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 295,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5ee7536c7271417a971f08a55efcfa91_38320/preview_talk_1.webp',
            ),
            89 => 
            array (
                'id' => 590,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 295,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5ee7536c7271417a971f08a55efcfa91_38320/preview_video_talk_1.mp4',
            ),
            90 => 
            array (
                'id' => 591,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 296,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5fb4ea7f6494dafbea81435b19ef74f_38340/preview_target.webp',
            ),
            91 => 
            array (
                'id' => 592,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 296,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5fb4ea7f6494dafbea81435b19ef74f_38340/preview_video_target.mp4',
            ),
            92 => 
            array (
                'id' => 593,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 297,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/08cd771666d1401697c738fceed4f2d3_38470/preview_talk_1.webp',
            ),
            93 => 
            array (
                'id' => 594,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 297,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/08cd771666d1401697c738fceed4f2d3_38470/preview_video_talk_1.mp4',
            ),
            94 => 
            array (
                'id' => 595,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 298,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/137d2a33e1d246fd8d528b3040f25714_38470/preview_target.webp',
            ),
            95 => 
            array (
                'id' => 596,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 298,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/137d2a33e1d246fd8d528b3040f25714_38470/preview_video_target.mp4',
            ),
            96 => 
            array (
                'id' => 597,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 299,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/635f87f70ed74107ae3535d8cbc7a41f_38480/preview_talk_1.webp',
            ),
            97 => 
            array (
                'id' => 598,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 299,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/635f87f70ed74107ae3535d8cbc7a41f_38480/preview_video_talk_1.mp4',
            ),
            98 => 
            array (
                'id' => 599,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 300,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/604bdf31284940c1acb1ac31d08a8a21_38320/preview_target.webp',
            ),
            99 => 
            array (
                'id' => 600,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 300,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/604bdf31284940c1acb1ac31d08a8a21_38320/preview_video_target.mp4',
            ),
            100 => 
            array (
                'id' => 601,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 301,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/974306439e5046fa93e4aeb36269816a_38330/preview_target.webp',
            ),
            101 => 
            array (
                'id' => 602,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 301,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/974306439e5046fa93e4aeb36269816a_38330/preview_video_target.mp4',
            ),
            102 => 
            array (
                'id' => 603,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 302,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e259aabd01a24e958299ce130b6f4928_2623/preview_target.webp',
            ),
            103 => 
            array (
                'id' => 604,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 302,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e259aabd01a24e958299ce130b6f4928_2623/preview_video_target.mp4',
            ),
            104 => 
            array (
                'id' => 605,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 303,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/203425112ca0467990d1b2327ab394b6_39010/preview_talk_5.webp',
            ),
            105 => 
            array (
                'id' => 606,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 303,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/203425112ca0467990d1b2327ab394b6_39010/preview_video_talk_5.mp4',
            ),
            106 => 
            array (
                'id' => 607,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 304,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/654d4253f9e64dbb990ec673f136cc02_39030/preview_talk_5.webp',
            ),
            107 => 
            array (
                'id' => 608,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 304,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/654d4253f9e64dbb990ec673f136cc02_39030/preview_video_talk_5.mp4',
            ),
            108 => 
            array (
                'id' => 609,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 305,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b06323de19040bf9ca490f55c1286c5_39010/preview_talk_4.webp',
            ),
            109 => 
            array (
                'id' => 610,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 305,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b06323de19040bf9ca490f55c1286c5_39010/preview_video_talk_4.mp4',
            ),
            110 => 
            array (
                'id' => 611,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 306,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/30f7858a50834089928f7409c2407454_39010/preview_talk_3.webp',
            ),
            111 => 
            array (
                'id' => 612,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 306,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/30f7858a50834089928f7409c2407454_39010/preview_video_talk_3.mp4',
            ),
            112 => 
            array (
                'id' => 613,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 307,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80c9802f265b48a0a1fef8cbd323fcd7_39030/preview_talk_2.webp',
            ),
            113 => 
            array (
                'id' => 614,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 307,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80c9802f265b48a0a1fef8cbd323fcd7_39030/preview_video_talk_2.mp4',
            ),
            114 => 
            array (
                'id' => 615,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 308,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/72f925de0b85401daa342edb27d40aa0_39010/preview_talk_2.webp',
            ),
            115 => 
            array (
                'id' => 616,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 308,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/72f925de0b85401daa342edb27d40aa0_39010/preview_video_talk_2.mp4',
            ),
            116 => 
            array (
                'id' => 617,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 309,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/53b0890c59a74386a36d8cee752223f1_39030/preview_target.webp',
            ),
            117 => 
            array (
                'id' => 618,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 309,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/53b0890c59a74386a36d8cee752223f1_39030/preview_video_target.mp4',
            ),
            118 => 
            array (
                'id' => 619,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 310,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b7fc0ac85619411fb2635b18c111c2f3_39010/preview_target.webp',
            ),
            119 => 
            array (
                'id' => 620,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 310,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b7fc0ac85619411fb2635b18c111c2f3_39010/preview_video_target.mp4',
            ),
            120 => 
            array (
                'id' => 621,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 311,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4c142c4734ea42a6a1eec3f08aafa31f_39040/preview_talk_1.webp',
            ),
            121 => 
            array (
                'id' => 622,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 311,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4c142c4734ea42a6a1eec3f08aafa31f_39040/preview_video_talk_1.mp4',
            ),
            122 => 
            array (
                'id' => 623,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 312,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5b31d7f1d1354605831fdb23bc01db9d_47240/preview_talk_2.webp',
            ),
            123 => 
            array (
                'id' => 624,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 312,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5b31d7f1d1354605831fdb23bc01db9d_47240/preview_video_talk_2.mp4',
            ),
            124 => 
            array (
                'id' => 625,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 313,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d3ba0e24035844028e16b57c820c1eb0_47250/preview_talk_1.webp',
            ),
            125 => 
            array (
                'id' => 626,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 313,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d3ba0e24035844028e16b57c820c1eb0_47250/preview_video_talk_1.mp4',
            ),
            126 => 
            array (
                'id' => 627,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 314,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8369305348c40078ea929bccd4d6e5d_47220/preview_target.webp',
            ),
            127 => 
            array (
                'id' => 628,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 314,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8369305348c40078ea929bccd4d6e5d_47220/preview_video_target.mp4',
            ),
            128 => 
            array (
                'id' => 629,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 315,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d599304e6ace4b1aba7375fed14959e2_47230/preview_target.webp',
            ),
            129 => 
            array (
                'id' => 630,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 315,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d599304e6ace4b1aba7375fed14959e2_47230/preview_video_target.mp4',
            ),
            130 => 
            array (
                'id' => 631,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 316,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/215cd27932924fccbc47142bd8f2e763_47240/preview_talk_1.webp',
            ),
            131 => 
            array (
                'id' => 632,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 316,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/215cd27932924fccbc47142bd8f2e763_47240/preview_video_talk_1.mp4',
            ),
            132 => 
            array (
                'id' => 633,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 317,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fb61612fe550432f8d77051767781048_47240/preview_target.webp',
            ),
            133 => 
            array (
                'id' => 634,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 317,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fb61612fe550432f8d77051767781048_47240/preview_video_target.mp4',
            ),
            134 => 
            array (
                'id' => 635,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 318,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0d93ce6bfb76485fb7cdf8cecada86ec_47250/preview_target.webp',
            ),
            135 => 
            array (
                'id' => 636,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 318,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0d93ce6bfb76485fb7cdf8cecada86ec_47250/preview_video_target.mp4',
            ),
            136 => 
            array (
                'id' => 637,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 319,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/89cdfa4f4f754ff585e47a4f124f26bb_47250/preview_talk_2.webp',
            ),
            137 => 
            array (
                'id' => 638,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 319,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/89cdfa4f4f754ff585e47a4f124f26bb_47250/preview_video_talk_2.mp4',
            ),
            138 => 
            array (
                'id' => 639,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 320,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/994f6d5fde7544ccb7dd22cf7640ab9d_35230/preview_target.webp',
            ),
            139 => 
            array (
                'id' => 640,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 320,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/994f6d5fde7544ccb7dd22cf7640ab9d_35230/preview_video_target.mp4',
            ),
            140 => 
            array (
                'id' => 641,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 321,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d0eac4fe3444ac48ea15f71e09ec0f0_35240/preview_target.webp',
            ),
            141 => 
            array (
                'id' => 642,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 321,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d0eac4fe3444ac48ea15f71e09ec0f0_35240/preview_video_target.mp4',
            ),
            142 => 
            array (
                'id' => 643,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 322,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/81d8cf20df564e7090b91c48a694b858_35250/preview_target.webp',
            ),
            143 => 
            array (
                'id' => 644,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 322,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/81d8cf20df564e7090b91c48a694b858_35250/preview_video_target.mp4',
            ),
            144 => 
            array (
                'id' => 645,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 323,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c604d6632324854af8bb933d2359aa7_34930/preview_target.webp',
            ),
            145 => 
            array (
                'id' => 646,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 323,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c604d6632324854af8bb933d2359aa7_34930/preview_video_target.mp4',
            ),
            146 => 
            array (
                'id' => 647,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 324,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13e6f145706e457bb972b4b3e0009efd_34940/preview_target.webp',
            ),
            147 => 
            array (
                'id' => 648,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 324,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13e6f145706e457bb972b4b3e0009efd_34940/preview_video_target.mp4',
            ),
            148 => 
            array (
                'id' => 649,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 325,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/57730aa7292a4efa94de7347463f2618_34950/preview_target.webp',
            ),
            149 => 
            array (
                'id' => 650,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 325,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/57730aa7292a4efa94de7347463f2618_34950/preview_video_target.mp4',
            ),
            150 => 
            array (
                'id' => 651,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 326,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/651c3060f1da41bf80e90b8c8fd9855a_34930/preview_talk_1.webp',
            ),
            151 => 
            array (
                'id' => 652,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 326,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/651c3060f1da41bf80e90b8c8fd9855a_34930/preview_video_talk_1.mp4',
            ),
            152 => 
            array (
                'id' => 653,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 327,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8fa0edf49fd84dd28f66302f768d9090_34940/preview_talk_1.webp',
            ),
            153 => 
            array (
                'id' => 654,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 327,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8fa0edf49fd84dd28f66302f768d9090_34940/preview_video_talk_1.mp4',
            ),
            154 => 
            array (
                'id' => 655,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 328,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2400daae083f4139ae8fa3fb457f4bf7_34950/preview_talk_1.webp',
            ),
            155 => 
            array (
                'id' => 656,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 328,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2400daae083f4139ae8fa3fb457f4bf7_34950/preview_video_talk_1.mp4',
            ),
            156 => 
            array (
                'id' => 657,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 329,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a58cfb99694d483ea8d84dad75e67312_38970/preview_talk_3.webp',
            ),
            157 => 
            array (
                'id' => 658,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 329,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a58cfb99694d483ea8d84dad75e67312_38970/preview_video_talk_3.mp4',
            ),
            158 => 
            array (
                'id' => 659,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 330,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8352487eb0e846449665f25823c2ea0a_38970/preview_talk_1.webp',
            ),
            159 => 
            array (
                'id' => 660,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 330,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8352487eb0e846449665f25823c2ea0a_38970/preview_video_talk_1.mp4',
            ),
            160 => 
            array (
                'id' => 661,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 331,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d56a50a2f56f47798d25a3ad193b911f_38970/preview_talk_10.webp',
            ),
            161 => 
            array (
                'id' => 662,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 331,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d56a50a2f56f47798d25a3ad193b911f_38970/preview_video_talk_10.mp4',
            ),
            162 => 
            array (
                'id' => 663,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 332,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96a78a5d17d04e75adc4b53a89eb3fe4_38970/preview_talk_7.webp',
            ),
            163 => 
            array (
                'id' => 664,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 332,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96a78a5d17d04e75adc4b53a89eb3fe4_38970/preview_video_talk_7.mp4',
            ),
            164 => 
            array (
                'id' => 665,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 333,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/357be7ac0ca94cf3a306b5d059f30dde_39000/preview_target.webp',
            ),
            165 => 
            array (
                'id' => 666,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 333,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/357be7ac0ca94cf3a306b5d059f30dde_39000/preview_video_target.mp4',
            ),
            166 => 
            array (
                'id' => 667,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 334,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/73a764d526b7473982e6df730298ce93_39000/preview_talk_2.webp',
            ),
            167 => 
            array (
                'id' => 668,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 334,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/73a764d526b7473982e6df730298ce93_39000/preview_video_talk_2.mp4',
            ),
            168 => 
            array (
                'id' => 669,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 335,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2fe3f146ffe40f995e2d70429e1d48a_39000/preview_talk_1.webp',
            ),
            169 => 
            array (
                'id' => 670,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 335,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2fe3f146ffe40f995e2d70429e1d48a_39000/preview_video_talk_1.mp4',
            ),
            170 => 
            array (
                'id' => 671,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 336,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2114731c94764e489ccbb735d0ea454b_38970/preview_target.webp',
            ),
            171 => 
            array (
                'id' => 672,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 336,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2114731c94764e489ccbb735d0ea454b_38970/preview_video_target.mp4',
            ),
            172 => 
            array (
                'id' => 673,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 337,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c3c5a973ecf744f2bc29652c01ee9ecb_39000/preview_talk_10.webp',
            ),
            173 => 
            array (
                'id' => 674,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 337,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c3c5a973ecf744f2bc29652c01ee9ecb_39000/preview_video_talk_10.mp4',
            ),
            174 => 
            array (
                'id' => 675,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 338,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3ee7c7d8354940539ed6fbd0d326de44_39000/preview_talk_6.webp',
            ),
            175 => 
            array (
                'id' => 676,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 338,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3ee7c7d8354940539ed6fbd0d326de44_39000/preview_video_talk_6.mp4',
            ),
            176 => 
            array (
                'id' => 677,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 339,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/025975fe53df4ae3bcb08e98ef7ce01c_38970/preview_talk_12.webp',
            ),
            177 => 
            array (
                'id' => 678,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 339,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/025975fe53df4ae3bcb08e98ef7ce01c_38970/preview_video_talk_12.mp4',
            ),
            178 => 
            array (
                'id' => 679,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 340,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2de6815b4d0d4b388e42c1640ac596b5_39000/preview_talk_3.webp',
            ),
            179 => 
            array (
                'id' => 680,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 340,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2de6815b4d0d4b388e42c1640ac596b5_39000/preview_video_talk_3.mp4',
            ),
            180 => 
            array (
                'id' => 681,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 341,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59efeb8f6b244693bd9d60f2094c8e4e_38970/preview_talk_6.webp',
            ),
            181 => 
            array (
                'id' => 682,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 341,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59efeb8f6b244693bd9d60f2094c8e4e_38970/preview_video_talk_6.mp4',
            ),
            182 => 
            array (
                'id' => 683,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 342,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33bb4fd328e447f38484e426b43424cb_38970/preview_talk_2.webp',
            ),
            183 => 
            array (
                'id' => 684,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 342,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33bb4fd328e447f38484e426b43424cb_38970/preview_video_talk_2.mp4',
            ),
            184 => 
            array (
                'id' => 685,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 343,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/babf386c73c541169ba57087cc1c4cd7_38970/preview_talk_4.webp',
            ),
            185 => 
            array (
                'id' => 686,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 343,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/babf386c73c541169ba57087cc1c4cd7_38970/preview_video_talk_4.mp4',
            ),
            186 => 
            array (
                'id' => 687,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 344,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4b03062d8e0548afa00afd8079bcf192_39000/preview_talk_8.webp',
            ),
            187 => 
            array (
                'id' => 688,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 344,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4b03062d8e0548afa00afd8079bcf192_39000/preview_video_talk_8.mp4',
            ),
            188 => 
            array (
                'id' => 689,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 345,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d090c9b5f58d4e81a54b9abaf020a3ef_39000/preview_talk_4.webp',
            ),
            189 => 
            array (
                'id' => 690,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 345,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d090c9b5f58d4e81a54b9abaf020a3ef_39000/preview_video_talk_4.mp4',
            ),
            190 => 
            array (
                'id' => 691,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 346,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea6b1f336a8247caadb29d920c959ce0_39000/preview_talk_7.webp',
            ),
            191 => 
            array (
                'id' => 692,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 346,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea6b1f336a8247caadb29d920c959ce0_39000/preview_video_talk_7.mp4',
            ),
            192 => 
            array (
                'id' => 693,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 347,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96a3bee923cd4d518963b1782ee18df3_44380/preview_talk_1.webp',
            ),
            193 => 
            array (
                'id' => 694,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 347,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96a3bee923cd4d518963b1782ee18df3_44380/preview_video_talk_1.mp4',
            ),
            194 => 
            array (
                'id' => 695,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 348,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/767af13a47a1455da7d18b7e5de39eea_39190/preview_talk_1.webp',
            ),
            195 => 
            array (
                'id' => 696,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 348,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/767af13a47a1455da7d18b7e5de39eea_39190/preview_video_talk_1.mp4',
            ),
            196 => 
            array (
                'id' => 697,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 349,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a648cceba67144efb80c0ea0df164e48_39210/preview_target.webp',
            ),
            197 => 
            array (
                'id' => 698,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 349,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a648cceba67144efb80c0ea0df164e48_39210/preview_video_target.mp4',
            ),
            198 => 
            array (
                'id' => 699,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 350,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26c9a98335d7429da6ed3215d961e080_39190/preview_target.webp',
            ),
            199 => 
            array (
                'id' => 700,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 350,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26c9a98335d7429da6ed3215d961e080_39190/preview_video_target.mp4',
            ),
            200 => 
            array (
                'id' => 701,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 351,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0f3cc005468d46df823f9d946312cc16_39200/preview_target.webp',
            ),
            201 => 
            array (
                'id' => 702,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 351,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0f3cc005468d46df823f9d946312cc16_39200/preview_video_target.mp4',
            ),
            202 => 
            array (
                'id' => 703,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 352,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0da8faf4b30419487dbee70d86e4a12_39690/preview_target.webp',
            ),
            203 => 
            array (
                'id' => 704,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 352,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0da8faf4b30419487dbee70d86e4a12_39690/preview_video_target.mp4',
            ),
            204 => 
            array (
                'id' => 705,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 353,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/70ad59514ade40fb96740b0f2ce14304_39510/preview_target.webp',
            ),
            205 => 
            array (
                'id' => 706,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 353,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/70ad59514ade40fb96740b0f2ce14304_39510/preview_video_target.mp4',
            ),
            206 => 
            array (
                'id' => 707,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 354,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbf90618ebd34cc6b8308f5cf59cb995_39620/preview_target.webp',
            ),
            207 => 
            array (
                'id' => 708,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 354,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbf90618ebd34cc6b8308f5cf59cb995_39620/preview_video_target.mp4',
            ),
            208 => 
            array (
                'id' => 709,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 355,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0cd9d7795dba4acca0982dc5a59a5975_39560/preview_target.webp',
            ),
            209 => 
            array (
                'id' => 710,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 355,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0cd9d7795dba4acca0982dc5a59a5975_39560/preview_video_target.mp4',
            ),
            210 => 
            array (
                'id' => 711,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 356,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/11af9745b4fb470bad72bf5496a12007_39550/preview_target.webp',
            ),
            211 => 
            array (
                'id' => 712,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 356,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/11af9745b4fb470bad72bf5496a12007_39550/preview_video_target.mp4',
            ),
            212 => 
            array (
                'id' => 713,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 357,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee7686e267ba4af2a6eec2fe349ed6a1_39410/preview_target.webp',
            ),
            213 => 
            array (
                'id' => 714,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 357,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee7686e267ba4af2a6eec2fe349ed6a1_39410/preview_video_target.mp4',
            ),
            214 => 
            array (
                'id' => 715,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 358,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6f043fd0c804e83944a732d8af5d329_39490/preview_target.webp',
            ),
            215 => 
            array (
                'id' => 716,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 358,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6f043fd0c804e83944a732d8af5d329_39490/preview_video_target.mp4',
            ),
            216 => 
            array (
                'id' => 717,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 359,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/64e4d35dddc54c92a98328cd2a921bb2_39600/preview_target.webp',
            ),
            217 => 
            array (
                'id' => 718,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 359,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/64e4d35dddc54c92a98328cd2a921bb2_39600/preview_video_target.mp4',
            ),
            218 => 
            array (
                'id' => 719,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 360,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80f65ad6ce5f4e85b3489a663008b130_37440/preview_talk_1.webp',
            ),
            219 => 
            array (
                'id' => 720,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 360,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80f65ad6ce5f4e85b3489a663008b130_37440/preview_video_talk_1.mp4',
            ),
            220 => 
            array (
                'id' => 721,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 361,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9d6af555388045e2bd0613321b815ef3_37440/preview_target.webp',
            ),
            221 => 
            array (
                'id' => 722,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 361,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9d6af555388045e2bd0613321b815ef3_37440/preview_video_target.mp4',
            ),
            222 => 
            array (
                'id' => 723,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 362,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b651f125d7a444f805fe650e6d8cae3_37450/preview_talk_1.webp',
            ),
            223 => 
            array (
                'id' => 724,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 362,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b651f125d7a444f805fe650e6d8cae3_37450/preview_video_talk_1.mp4',
            ),
            224 => 
            array (
                'id' => 725,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 363,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4548d30469b4469bbf3778d603d502f9_37450/preview_target.webp',
            ),
            225 => 
            array (
                'id' => 726,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 363,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4548d30469b4469bbf3778d603d502f9_37450/preview_video_target.mp4',
            ),
            226 => 
            array (
                'id' => 727,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 364,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c120df50527f4a8e93f2d6fab98aa335_37400/preview_target.webp',
            ),
            227 => 
            array (
                'id' => 728,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 364,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c120df50527f4a8e93f2d6fab98aa335_37400/preview_video_target.mp4',
            ),
            228 => 
            array (
                'id' => 729,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 365,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5e60879e278a42a8a8bd1850aab6dff9_37410/preview_target.webp',
            ),
            229 => 
            array (
                'id' => 730,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 365,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5e60879e278a42a8a8bd1850aab6dff9_37410/preview_video_target.mp4',
            ),
            230 => 
            array (
                'id' => 731,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 366,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b0f22026f8ae46db8099bd02e3472977_37400/preview_talk_1.webp',
            ),
            231 => 
            array (
                'id' => 732,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 366,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b0f22026f8ae46db8099bd02e3472977_37400/preview_video_talk_1.mp4',
            ),
            232 => 
            array (
                'id' => 733,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 367,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/55854c68aff34a2c8da13df11ff354c2_37410/preview_talk_1.webp',
            ),
            233 => 
            array (
                'id' => 734,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 367,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/55854c68aff34a2c8da13df11ff354c2_37410/preview_video_talk_1.mp4',
            ),
            234 => 
            array (
                'id' => 735,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 368,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b3158190121468c92b74fd59cb2a349_38110/preview_talk_1.webp',
            ),
            235 => 
            array (
                'id' => 736,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 368,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b3158190121468c92b74fd59cb2a349_38110/preview_video_talk_1.mp4',
            ),
            236 => 
            array (
                'id' => 737,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 369,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6f8a40c394b547339572c92540cf1f70_38110/preview_target.webp',
            ),
            237 => 
            array (
                'id' => 738,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 369,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6f8a40c394b547339572c92540cf1f70_38110/preview_video_target.mp4',
            ),
            238 => 
            array (
                'id' => 739,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 370,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01abf34f669e46f6b63816a3b4db8c2b_38120/preview_talk_1.webp',
            ),
            239 => 
            array (
                'id' => 740,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 370,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01abf34f669e46f6b63816a3b4db8c2b_38120/preview_video_talk_1.mp4',
            ),
            240 => 
            array (
                'id' => 741,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 371,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cdeafe31b47a406da4ef31f631b9237e_38120/preview_target.webp',
            ),
            241 => 
            array (
                'id' => 742,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 371,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cdeafe31b47a406da4ef31f631b9237e_38120/preview_video_target.mp4',
            ),
            242 => 
            array (
                'id' => 743,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 372,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3968fde1e2ab4cccaf79bae77e7b7387_37940/preview_target.webp',
            ),
            243 => 
            array (
                'id' => 744,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 372,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3968fde1e2ab4cccaf79bae77e7b7387_37940/preview_video_target.mp4',
            ),
            244 => 
            array (
                'id' => 745,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 373,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d70b6fe0626f44069a393baa6ede6315_37940/preview_talk_1.webp',
            ),
            245 => 
            array (
                'id' => 746,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 373,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d70b6fe0626f44069a393baa6ede6315_37940/preview_video_talk_1.mp4',
            ),
            246 => 
            array (
                'id' => 747,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 374,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/591c6df250d042fc907365186511eed4_37950/preview_target.webp',
            ),
            247 => 
            array (
                'id' => 748,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 374,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/591c6df250d042fc907365186511eed4_37950/preview_video_target.mp4',
            ),
            248 => 
            array (
                'id' => 749,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 375,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d4430f0a543f493f92339928fb3cad37_37960/preview_target.webp',
            ),
            249 => 
            array (
                'id' => 750,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 375,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d4430f0a543f493f92339928fb3cad37_37960/preview_video_target.mp4',
            ),
            250 => 
            array (
                'id' => 751,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 376,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/189ce28f3ee34165930055c25a21ef15_47490/preview_target.webp',
            ),
            251 => 
            array (
                'id' => 752,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 376,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/189ce28f3ee34165930055c25a21ef15_47490/preview_video_target.mp4',
            ),
            252 => 
            array (
                'id' => 753,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 377,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/683bc8e6662b41d4b2c02a3d91247d5d_47500/preview_target.webp',
            ),
            253 => 
            array (
                'id' => 754,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 377,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/683bc8e6662b41d4b2c02a3d91247d5d_47500/preview_video_target.mp4',
            ),
            254 => 
            array (
                'id' => 755,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 378,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f40fddd75bd49b89a289d31a155ade6_47370/preview_talk_3.webp',
            ),
            255 => 
            array (
                'id' => 756,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 378,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f40fddd75bd49b89a289d31a155ade6_47370/preview_video_talk_3.mp4',
            ),
            256 => 
            array (
                'id' => 757,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 379,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/40fa1765701247d68739098e106bde91_47370/preview_talk_4.webp',
            ),
            257 => 
            array (
                'id' => 758,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 379,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/40fa1765701247d68739098e106bde91_47370/preview_video_talk_4.mp4',
            ),
            258 => 
            array (
                'id' => 759,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 380,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75591308ed8146bc83eba3469cac4455_47390/preview_talk_2.webp',
            ),
            259 => 
            array (
                'id' => 760,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 380,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/75591308ed8146bc83eba3469cac4455_47390/preview_video_talk_2.mp4',
            ),
            260 => 
            array (
                'id' => 761,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 381,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b8ef7ec09e5c4887aa0838d8e45a4cf5_47390/preview_talk_1.webp',
            ),
            261 => 
            array (
                'id' => 762,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 381,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b8ef7ec09e5c4887aa0838d8e45a4cf5_47390/preview_video_talk_1.mp4',
            ),
            262 => 
            array (
                'id' => 763,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 382,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/099f6e2117f8423797f7cbd9f1bd8178_47370/preview_talk_2.webp',
            ),
            263 => 
            array (
                'id' => 764,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 382,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/099f6e2117f8423797f7cbd9f1bd8178_47370/preview_video_talk_2.mp4',
            ),
            264 => 
            array (
                'id' => 765,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 383,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e4289af9992e4abfaca282f5eda61bf4_47390/preview_target.webp',
            ),
            265 => 
            array (
                'id' => 766,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 383,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e4289af9992e4abfaca282f5eda61bf4_47390/preview_video_target.mp4',
            ),
            266 => 
            array (
                'id' => 767,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 384,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c268c69724b742689233bfbab7e615da_47360/preview_target.webp',
            ),
            267 => 
            array (
                'id' => 768,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 384,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c268c69724b742689233bfbab7e615da_47360/preview_video_target.mp4',
            ),
            268 => 
            array (
                'id' => 769,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 385,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/07df34eaa6db47de83105a11807ef45d_47360/preview_talk_1.webp',
            ),
            269 => 
            array (
                'id' => 770,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 385,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/07df34eaa6db47de83105a11807ef45d_47360/preview_video_talk_1.mp4',
            ),
            270 => 
            array (
                'id' => 771,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 386,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3db20b2382534622868aa8034d2f8025_47350/preview_talk_2.webp',
            ),
            271 => 
            array (
                'id' => 772,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 386,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3db20b2382534622868aa8034d2f8025_47350/preview_video_talk_2.mp4',
            ),
            272 => 
            array (
                'id' => 773,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 387,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9b00953974a4da3a400e3d325b9a74e_47840/preview_target.webp',
            ),
            273 => 
            array (
                'id' => 774,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 387,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9b00953974a4da3a400e3d325b9a74e_47840/preview_video_target.mp4',
            ),
            274 => 
            array (
                'id' => 775,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 388,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fc90cad006e409a916e54c21a258b8b_47820/preview_target.webp',
            ),
            275 => 
            array (
                'id' => 776,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 388,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fc90cad006e409a916e54c21a258b8b_47820/preview_video_target.mp4',
            ),
            276 => 
            array (
                'id' => 777,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 389,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/955b1dcde3ba481d914b0086cc54e1cf_47850/preview_target.webp',
            ),
            277 => 
            array (
                'id' => 778,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 389,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/955b1dcde3ba481d914b0086cc54e1cf_47850/preview_video_target.mp4',
            ),
            278 => 
            array (
                'id' => 779,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 390,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/312bf2c4cf0b4bdbb4fafd980d81d9b0_45410/preview_target.webp',
            ),
            279 => 
            array (
                'id' => 780,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 390,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/312bf2c4cf0b4bdbb4fafd980d81d9b0_45410/preview_video_target.mp4',
            ),
            280 => 
            array (
                'id' => 781,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 391,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f1e297570b5c4b4b9133e79916d1de5a_45420/preview_target.webp',
            ),
            281 => 
            array (
                'id' => 782,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 391,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f1e297570b5c4b4b9133e79916d1de5a_45420/preview_video_target.mp4',
            ),
            282 => 
            array (
                'id' => 783,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 392,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/40083b4aa0c943a0b4c34856e8467752_46360/preview_talk_1.webp',
            ),
            283 => 
            array (
                'id' => 784,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 392,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/40083b4aa0c943a0b4c34856e8467752_46360/preview_video_talk_1.mp4',
            ),
            284 => 
            array (
                'id' => 785,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 393,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ab72d3e275548daa55bb21fa3aa9a48_45410/preview_talk_1.webp',
            ),
            285 => 
            array (
                'id' => 786,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 393,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ab72d3e275548daa55bb21fa3aa9a48_45410/preview_video_talk_1.mp4',
            ),
            286 => 
            array (
                'id' => 787,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 394,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0c93e4499914c3cb8a6a80c75d0c1ae_46360/preview_target.webp',
            ),
            287 => 
            array (
                'id' => 788,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 394,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0c93e4499914c3cb8a6a80c75d0c1ae_46360/preview_video_target.mp4',
            ),
            288 => 
            array (
                'id' => 789,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 395,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4ec8f26f56bc44bda131c3b1029fc397_42910/preview_talk_2.webp',
            ),
            289 => 
            array (
                'id' => 790,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 395,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4ec8f26f56bc44bda131c3b1029fc397_42910/preview_video_talk_2.mp4',
            ),
            290 => 
            array (
                'id' => 791,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 396,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/43d573edb9ac4e018f0668e3568329d2_45420/preview_talk_1.webp',
            ),
            291 => 
            array (
                'id' => 792,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 396,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/43d573edb9ac4e018f0668e3568329d2_45420/preview_video_talk_1.mp4',
            ),
            292 => 
            array (
                'id' => 793,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 397,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/889c74e161ad443a9ea558d9dd5664c3_45420/preview_talk_2.webp',
            ),
            293 => 
            array (
                'id' => 794,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 397,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/889c74e161ad443a9ea558d9dd5664c3_45420/preview_video_talk_2.mp4',
            ),
            294 => 
            array (
                'id' => 795,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 398,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f505c876f0ab4a8d98a1421438420528_46370/preview_target.webp',
            ),
            295 => 
            array (
                'id' => 796,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 398,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f505c876f0ab4a8d98a1421438420528_46370/preview_video_target.mp4',
            ),
            296 => 
            array (
                'id' => 797,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 399,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b4ffc8decf2747f6a9240d6ef64d0eff_45440/preview_target.webp',
            ),
            297 => 
            array (
                'id' => 798,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 399,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b4ffc8decf2747f6a9240d6ef64d0eff_45440/preview_video_target.mp4',
            ),
            298 => 
            array (
                'id' => 799,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 400,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8aa97ee9b3c1434ab405e7a05d78f91b_42910/preview_talk_5.webp',
            ),
            299 => 
            array (
                'id' => 800,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 400,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8aa97ee9b3c1434ab405e7a05d78f91b_42910/preview_video_talk_5.mp4',
            ),
            300 => 
            array (
                'id' => 801,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 401,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f5a725c910f4545a158332bab676b35_44520/preview_target.webp',
            ),
            301 => 
            array (
                'id' => 802,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 401,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f5a725c910f4545a158332bab676b35_44520/preview_video_target.mp4',
            ),
            302 => 
            array (
                'id' => 803,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 402,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/04c7ae8760d149bb8717d29fedf2b84b_43380/preview_talk_1.webp',
            ),
            303 => 
            array (
                'id' => 804,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 402,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/04c7ae8760d149bb8717d29fedf2b84b_43380/preview_video_talk_1.mp4',
            ),
            304 => 
            array (
                'id' => 805,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 403,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/487e90522be14c76a050b213a1448e55_43390/preview_talk_2.webp',
            ),
            305 => 
            array (
                'id' => 806,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 403,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/487e90522be14c76a050b213a1448e55_43390/preview_video_talk_2.mp4',
            ),
            306 => 
            array (
                'id' => 807,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 404,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d2e79d47a2464bdbb0062f46b51630dc_43400/preview_talk_1.webp',
            ),
            307 => 
            array (
                'id' => 808,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 404,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d2e79d47a2464bdbb0062f46b51630dc_43400/preview_video_talk_1.mp4',
            ),
            308 => 
            array (
                'id' => 809,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 405,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8bbe48df011d4a79abe4086acc63dac4_43410/preview_talk_1.webp',
            ),
            309 => 
            array (
                'id' => 810,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 405,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8bbe48df011d4a79abe4086acc63dac4_43410/preview_video_talk_1.mp4',
            ),
            310 => 
            array (
                'id' => 811,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 406,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e76da3050bbd4e7ba05f99986c8ed594_43400/preview_talk_2.webp',
            ),
            311 => 
            array (
                'id' => 812,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 406,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e76da3050bbd4e7ba05f99986c8ed594_43400/preview_video_talk_2.mp4',
            ),
            312 => 
            array (
                'id' => 813,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 407,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f643dd66c5a94239ac94812976e4eebb_43410/preview_talk_2.webp',
            ),
            313 => 
            array (
                'id' => 814,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 407,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f643dd66c5a94239ac94812976e4eebb_43410/preview_video_talk_2.mp4',
            ),
            314 => 
            array (
                'id' => 815,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 408,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/52491deef4b242c2898192f07743d4ce_36750/preview_target.webp',
            ),
            315 => 
            array (
                'id' => 816,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 408,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/52491deef4b242c2898192f07743d4ce_36750/preview_video_target.mp4',
            ),
            316 => 
            array (
                'id' => 817,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 409,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec29586b231045748569b7576aa1d6a3_36760/preview_talk_2.webp',
            ),
            317 => 
            array (
                'id' => 818,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 409,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec29586b231045748569b7576aa1d6a3_36760/preview_video_talk_2.mp4',
            ),
            318 => 
            array (
                'id' => 819,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 410,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47f18af1b24747798d4fa32dbfa79ed9_36740/preview_target.webp',
            ),
            319 => 
            array (
                'id' => 820,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 410,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47f18af1b24747798d4fa32dbfa79ed9_36740/preview_video_target.mp4',
            ),
            320 => 
            array (
                'id' => 821,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 411,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d8ff1a875fef4416bef4fa617558ed69_36770/preview_talk_1.webp',
            ),
            321 => 
            array (
                'id' => 822,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 411,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d8ff1a875fef4416bef4fa617558ed69_36770/preview_video_talk_1.mp4',
            ),
            322 => 
            array (
                'id' => 823,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 412,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/24ae8e68ba1d44a3bfd928e33459a399_36680/preview_talk_4.webp',
            ),
            323 => 
            array (
                'id' => 824,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 412,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/24ae8e68ba1d44a3bfd928e33459a399_36680/preview_video_talk_4.mp4',
            ),
            324 => 
            array (
                'id' => 825,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 413,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3019184debd34a2e8206c441cad2289d_36670/preview_target.webp',
            ),
            325 => 
            array (
                'id' => 826,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 413,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3019184debd34a2e8206c441cad2289d_36670/preview_video_target.mp4',
            ),
            326 => 
            array (
                'id' => 827,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 414,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b44135a6206e4e58b913c5e090a39597_36690/preview_talk_3.webp',
            ),
            327 => 
            array (
                'id' => 828,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 414,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b44135a6206e4e58b913c5e090a39597_36690/preview_video_talk_3.mp4',
            ),
            328 => 
            array (
                'id' => 829,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 415,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/56f4c5e2157d47578ad209a08d4c0324_36660/preview_talk_1.webp',
            ),
            329 => 
            array (
                'id' => 830,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 415,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/56f4c5e2157d47578ad209a08d4c0324_36660/preview_video_talk_1.mp4',
            ),
            330 => 
            array (
                'id' => 831,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 416,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/812e4c922e0d4ba0b2c5a21a0dd43fb1_39100/preview_target.webp',
            ),
            331 => 
            array (
                'id' => 832,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 416,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/812e4c922e0d4ba0b2c5a21a0dd43fb1_39100/preview_video_target.mp4',
            ),
            332 => 
            array (
                'id' => 833,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 417,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9db20d88c7b74d9c8d458a0fda92839f_39110/preview_target.webp',
            ),
            333 => 
            array (
                'id' => 834,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 417,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9db20d88c7b74d9c8d458a0fda92839f_39110/preview_video_target.mp4',
            ),
            334 => 
            array (
                'id' => 835,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 418,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b8a3c58ffefb4428a83030f5a9a5eed6_39100/preview_talk_4.webp',
            ),
            335 => 
            array (
                'id' => 836,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 418,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b8a3c58ffefb4428a83030f5a9a5eed6_39100/preview_video_talk_4.mp4',
            ),
            336 => 
            array (
                'id' => 837,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 419,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d60f4de42c784e6e8ebe07958dd804be_39110/preview_talk_2.webp',
            ),
            337 => 
            array (
                'id' => 838,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 419,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d60f4de42c784e6e8ebe07958dd804be_39110/preview_video_talk_2.mp4',
            ),
            338 => 
            array (
                'id' => 839,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 420,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9bd3ad912fe448f917753ac55db2157_39100/preview_talk_2.webp',
            ),
            339 => 
            array (
                'id' => 840,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 420,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9bd3ad912fe448f917753ac55db2157_39100/preview_video_talk_2.mp4',
            ),
            340 => 
            array (
                'id' => 841,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 421,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/40ad4cc57ad74b1ba3e0aaf39be1b9e1_39110/preview_talk_4.webp',
            ),
            341 => 
            array (
                'id' => 842,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 421,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/40ad4cc57ad74b1ba3e0aaf39be1b9e1_39110/preview_video_talk_4.mp4',
            ),
            342 => 
            array (
                'id' => 843,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 422,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b87e55b560894b4190552fbb1fb5ef3c_44430/preview_talk_4.webp',
            ),
            343 => 
            array (
                'id' => 844,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 422,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b87e55b560894b4190552fbb1fb5ef3c_44430/preview_video_talk_4.mp4',
            ),
            344 => 
            array (
                'id' => 845,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 423,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e66b500dd5034538835f52a71a6cae66_38730/preview_target.webp',
            ),
            345 => 
            array (
                'id' => 846,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 423,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e66b500dd5034538835f52a71a6cae66_38730/preview_video_target.mp4',
            ),
            346 => 
            array (
                'id' => 847,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 424,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cda83478bc14c07965b690934292a55_38730/preview_talk_1.webp',
            ),
            347 => 
            array (
                'id' => 848,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 424,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cda83478bc14c07965b690934292a55_38730/preview_video_talk_1.mp4',
            ),
            348 => 
            array (
                'id' => 849,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 425,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4dae6fb1f34c41fcac301ec9c7e9467a_38740/preview_talk_1.webp',
            ),
            349 => 
            array (
                'id' => 850,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 425,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4dae6fb1f34c41fcac301ec9c7e9467a_38740/preview_video_talk_1.mp4',
            ),
            350 => 
            array (
                'id' => 851,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 426,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d8cef0ba3f04af1a0ca33b3001c6db0_38740/preview_target.webp',
            ),
            351 => 
            array (
                'id' => 852,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 426,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d8cef0ba3f04af1a0ca33b3001c6db0_38740/preview_video_target.mp4',
            ),
            352 => 
            array (
                'id' => 853,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 427,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a603f3dcbf3c4db6b75ca2ea35a3a9ee_38910/preview_target.webp',
            ),
            353 => 
            array (
                'id' => 854,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 427,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a603f3dcbf3c4db6b75ca2ea35a3a9ee_38910/preview_video_target.mp4',
            ),
            354 => 
            array (
                'id' => 855,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 428,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88e941fd3b90448aa1366e3839a126a4_37750/preview_talk_5.webp',
            ),
            355 => 
            array (
                'id' => 856,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 428,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88e941fd3b90448aa1366e3839a126a4_37750/preview_video_talk_5.mp4',
            ),
            356 => 
            array (
                'id' => 857,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 429,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/98ad0dbc87334362addae4c56b8e5add_38010/preview_target.webp',
            ),
            357 => 
            array (
                'id' => 858,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 429,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/98ad0dbc87334362addae4c56b8e5add_38010/preview_video_target.mp4',
            ),
            358 => 
            array (
                'id' => 859,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 430,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f1d2170d0d72439dbff597c801b8fce3_37750/preview_talk_6.webp',
            ),
            359 => 
            array (
                'id' => 860,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 430,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f1d2170d0d72439dbff597c801b8fce3_37750/preview_video_talk_6.mp4',
            ),
            360 => 
            array (
                'id' => 861,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 431,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f87e6f6954844d8881669e5686e66b79_38020/preview_talk_1.webp',
            ),
            361 => 
            array (
                'id' => 862,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 431,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f87e6f6954844d8881669e5686e66b79_38020/preview_video_talk_1.mp4',
            ),
            362 => 
            array (
                'id' => 863,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 432,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2fe0f56a53ec41feb071aa1541c7b80f_37750/preview_talk_3.webp',
            ),
            363 => 
            array (
                'id' => 864,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 432,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2fe0f56a53ec41feb071aa1541c7b80f_37750/preview_video_talk_3.mp4',
            ),
            364 => 
            array (
                'id' => 865,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 433,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae2530fb96374adebfc6e3b6c0fd8931_37760/preview_talk_4.webp',
            ),
            365 => 
            array (
                'id' => 866,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 433,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae2530fb96374adebfc6e3b6c0fd8931_37760/preview_video_talk_4.mp4',
            ),
            366 => 
            array (
                'id' => 867,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 434,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d92013ef9f594744b50ca39d10926d49_37750/preview_talk_2.webp',
            ),
            367 => 
            array (
                'id' => 868,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 434,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d92013ef9f594744b50ca39d10926d49_37750/preview_video_talk_2.mp4',
            ),
            368 => 
            array (
                'id' => 869,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 435,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/682a899bf7664a45a6bd71236f970385_44360/preview_talk_3.webp',
            ),
            369 => 
            array (
                'id' => 870,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 435,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/682a899bf7664a45a6bd71236f970385_44360/preview_video_talk_3.mp4',
            ),
            370 => 
            array (
                'id' => 871,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 436,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d353f3140b245188cf495976e79312a_38690/preview_target.webp',
            ),
            371 => 
            array (
                'id' => 872,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 436,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d353f3140b245188cf495976e79312a_38690/preview_video_target.mp4',
            ),
            372 => 
            array (
                'id' => 873,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 437,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01bf1b75c57e4c99b143b1d185beb21c_38690/preview_talk_1.webp',
            ),
            373 => 
            array (
                'id' => 874,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 437,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01bf1b75c57e4c99b143b1d185beb21c_38690/preview_video_talk_1.mp4',
            ),
            374 => 
            array (
                'id' => 875,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 438,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/15b6f2f7e8c84384bbc59be99a23eb01_38700/preview_talk_1.webp',
            ),
            375 => 
            array (
                'id' => 876,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 438,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/15b6f2f7e8c84384bbc59be99a23eb01_38700/preview_video_talk_1.mp4',
            ),
            376 => 
            array (
                'id' => 877,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 439,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ceff773b835a441abfac40f06475cc69_38700/preview_target.webp',
            ),
            377 => 
            array (
                'id' => 878,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 439,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ceff773b835a441abfac40f06475cc69_38700/preview_video_target.mp4',
            ),
            378 => 
            array (
                'id' => 879,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 440,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13efef4d129e4f16ae6b350e225389b0_45830/preview_talk_4.webp',
            ),
            379 => 
            array (
                'id' => 880,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 440,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13efef4d129e4f16ae6b350e225389b0_45830/preview_video_talk_4.mp4',
            ),
            380 => 
            array (
                'id' => 881,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 441,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/375e726a54994c5e8233da3703377813_44930/preview_talk_3.webp',
            ),
            381 => 
            array (
                'id' => 882,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 441,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/375e726a54994c5e8233da3703377813_44930/preview_video_talk_3.mp4',
            ),
            382 => 
            array (
                'id' => 883,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 442,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e98ffec26b642dba14ddd3e10014041_46210/preview_target.webp',
            ),
            383 => 
            array (
                'id' => 884,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 442,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e98ffec26b642dba14ddd3e10014041_46210/preview_video_target.mp4',
            ),
            384 => 
            array (
                'id' => 885,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 443,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9e3a06df9b045d0860513635d5e6d32_44930/preview_talk_2.webp',
            ),
            385 => 
            array (
                'id' => 886,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 443,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9e3a06df9b045d0860513635d5e6d32_44930/preview_video_talk_2.mp4',
            ),
            386 => 
            array (
                'id' => 887,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 444,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7957e7c9ad8e4b5dbdbdb366de09c1d1_44930/preview_target.webp',
            ),
            387 => 
            array (
                'id' => 888,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 444,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7957e7c9ad8e4b5dbdbdb366de09c1d1_44930/preview_video_target.mp4',
            ),
            388 => 
            array (
                'id' => 889,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 445,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6a3fcb04382948e38442ba263bfc001d_46300/preview_talk_1.webp',
            ),
            389 => 
            array (
                'id' => 890,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 445,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6a3fcb04382948e38442ba263bfc001d_46300/preview_video_talk_1.mp4',
            ),
            390 => 
            array (
                'id' => 891,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 446,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e92b609f7fb4d8abefd71d763a65448_46320/preview_talk_1.webp',
            ),
            391 => 
            array (
                'id' => 892,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 446,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e92b609f7fb4d8abefd71d763a65448_46320/preview_video_talk_1.mp4',
            ),
            392 => 
            array (
                'id' => 893,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 447,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/403b42c52cd54a42ab633c2d653584a7_46320/preview_target.webp',
            ),
            393 => 
            array (
                'id' => 894,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 447,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/403b42c52cd54a42ab633c2d653584a7_46320/preview_video_target.mp4',
            ),
            394 => 
            array (
                'id' => 895,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 448,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e684f0e1af47434486fd14d52b44dee8_46330/preview_target.webp',
            ),
            395 => 
            array (
                'id' => 896,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 448,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e684f0e1af47434486fd14d52b44dee8_46330/preview_video_target.mp4',
            ),
            396 => 
            array (
                'id' => 897,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 449,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/022cdb1f07914e75887c693f0c5f97dd_45650/preview_talk_1.webp',
            ),
            397 => 
            array (
                'id' => 898,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 449,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/022cdb1f07914e75887c693f0c5f97dd_45650/preview_video_talk_1.mp4',
            ),
            398 => 
            array (
                'id' => 899,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 450,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13bc0ed39627493da8404a4beb373f3a_45650/preview_talk_3.webp',
            ),
            399 => 
            array (
                'id' => 900,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 450,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/13bc0ed39627493da8404a4beb373f3a_45650/preview_video_talk_3.mp4',
            ),
            400 => 
            array (
                'id' => 901,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 451,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a7c86cb77b3144948bf8020f6e734bbf_45640/preview_talk_1.webp',
            ),
            401 => 
            array (
                'id' => 902,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 451,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a7c86cb77b3144948bf8020f6e734bbf_45640/preview_video_talk_1.mp4',
            ),
            402 => 
            array (
                'id' => 903,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 452,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0dc3bbebe2a4f7e916e28e938aa9130_46280/preview_talk_2.webp',
            ),
            403 => 
            array (
                'id' => 904,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 452,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0dc3bbebe2a4f7e916e28e938aa9130_46280/preview_video_talk_2.mp4',
            ),
            404 => 
            array (
                'id' => 905,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 453,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7acd8877508b472297012ebd986796eb_46280/preview_talk_1.webp',
            ),
            405 => 
            array (
                'id' => 906,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 453,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7acd8877508b472297012ebd986796eb_46280/preview_video_talk_1.mp4',
            ),
            406 => 
            array (
                'id' => 907,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 454,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09c5a65006354e949a4f0c74b5ed0b60_46290/preview_talk_2.webp',
            ),
            407 => 
            array (
                'id' => 908,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 454,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09c5a65006354e949a4f0c74b5ed0b60_46290/preview_video_talk_2.mp4',
            ),
            408 => 
            array (
                'id' => 909,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 455,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/546d27d9dcd648e5b208da04d1c63a52_46290/preview_talk_1.webp',
            ),
            409 => 
            array (
                'id' => 910,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 455,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/546d27d9dcd648e5b208da04d1c63a52_46290/preview_video_talk_1.mp4',
            ),
            410 => 
            array (
                'id' => 911,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 456,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5d360b50467145cf80d6398d65028f6b_43240/preview_target.webp',
            ),
            411 => 
            array (
                'id' => 912,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 456,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5d360b50467145cf80d6398d65028f6b_43240/preview_video_target.mp4',
            ),
            412 => 
            array (
                'id' => 913,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 457,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d7f9cc78bf63408fbae9aead248aeb81_46280/preview_target.webp',
            ),
            413 => 
            array (
                'id' => 914,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 457,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d7f9cc78bf63408fbae9aead248aeb81_46280/preview_video_target.mp4',
            ),
            414 => 
            array (
                'id' => 915,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 458,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/44586761c46341e5a490725647672c4d_46290/preview_target.webp',
            ),
            415 => 
            array (
                'id' => 916,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 458,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/44586761c46341e5a490725647672c4d_46290/preview_video_target.mp4',
            ),
            416 => 
            array (
                'id' => 917,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 459,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f2144fa87b3143a490471ee015b941b4_43250/preview_target.webp',
            ),
            417 => 
            array (
                'id' => 918,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 459,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f2144fa87b3143a490471ee015b941b4_43250/preview_video_target.mp4',
            ),
            418 => 
            array (
                'id' => 919,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 460,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94ae3e89f4c4ff98541ab59efa5878b_45630/preview_talk_2.webp',
            ),
            419 => 
            array (
                'id' => 920,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 460,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94ae3e89f4c4ff98541ab59efa5878b_45630/preview_video_talk_2.mp4',
            ),
            420 => 
            array (
                'id' => 921,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 461,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/68fbd9f64a4948baa3c295d35f49b61c_45630/preview_target.webp',
            ),
            421 => 
            array (
                'id' => 922,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 461,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/68fbd9f64a4948baa3c295d35f49b61c_45630/preview_video_target.mp4',
            ),
            422 => 
            array (
                'id' => 923,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 462,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6cd7031aa97e496897391dd44dae56be_45630/preview_talk_1.webp',
            ),
            423 => 
            array (
                'id' => 924,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 462,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6cd7031aa97e496897391dd44dae56be_45630/preview_video_talk_1.mp4',
            ),
            424 => 
            array (
                'id' => 925,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 463,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cf9ab8786b64aee871d07c02deedce2_44370/preview_target.webp',
            ),
            425 => 
            array (
                'id' => 926,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 463,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cf9ab8786b64aee871d07c02deedce2_44370/preview_video_target.mp4',
            ),
            426 => 
            array (
                'id' => 927,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 464,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/74447a27859a456c955e01f21ef18216_45620/preview_talk_1.webp',
            ),
            427 => 
            array (
                'id' => 928,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 464,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/74447a27859a456c955e01f21ef18216_45620/preview_video_talk_1.mp4',
            ),
            428 => 
            array (
                'id' => 929,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 465,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/251ff4bcc6b8474991c9922146f73093_38910/preview_talk_1.webp',
            ),
            429 => 
            array (
                'id' => 930,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 465,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/251ff4bcc6b8474991c9922146f73093_38910/preview_video_talk_1.mp4',
            ),
            430 => 
            array (
                'id' => 931,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 466,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6564b06a89a4b46b94ce065e21659dc_38900/preview_talk_1.webp',
            ),
            431 => 
            array (
                'id' => 932,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 466,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6564b06a89a4b46b94ce065e21659dc_38900/preview_video_talk_1.mp4',
            ),
            432 => 
            array (
                'id' => 933,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 467,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6e26a23d50914a37a2c2fedc9ae9925b_38900/preview_target.webp',
            ),
            433 => 
            array (
                'id' => 934,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 467,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6e26a23d50914a37a2c2fedc9ae9925b_38900/preview_video_target.mp4',
            ),
            434 => 
            array (
                'id' => 935,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 468,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dd930d203c7d4ae4ac94b66c8ade49bb_38910/preview_talk_3.webp',
            ),
            435 => 
            array (
                'id' => 936,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 468,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dd930d203c7d4ae4ac94b66c8ade49bb_38910/preview_video_talk_3.mp4',
            ),
            436 => 
            array (
                'id' => 937,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 469,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/809a54ee11864a7c9d869fad045e57c6_38910/preview_talk_2.webp',
            ),
            437 => 
            array (
                'id' => 938,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 469,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/809a54ee11864a7c9d869fad045e57c6_38910/preview_video_talk_2.mp4',
            ),
            438 => 
            array (
                'id' => 939,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 470,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39c7a3ecded342c895f73fd3d5956acf_38900/preview_talk_3.webp',
            ),
            439 => 
            array (
                'id' => 940,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 470,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39c7a3ecded342c895f73fd3d5956acf_38900/preview_video_talk_3.mp4',
            ),
            440 => 
            array (
                'id' => 941,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 471,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/074ce0017cbf4199926e898a98539724_38900/preview_talk_2.webp',
            ),
            441 => 
            array (
                'id' => 942,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 471,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/074ce0017cbf4199926e898a98539724_38900/preview_video_talk_2.mp4',
            ),
            442 => 
            array (
                'id' => 943,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 472,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef598b5c12c04153b22c81b713a6bb4e_42500/preview_talk_3.webp',
            ),
            443 => 
            array (
                'id' => 944,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 472,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef598b5c12c04153b22c81b713a6bb4e_42500/preview_video_talk_3.mp4',
            ),
            444 => 
            array (
                'id' => 945,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 473,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8c74761cbae4383955090c67b62c479_42500/preview_talk_2.webp',
            ),
            445 => 
            array (
                'id' => 946,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 473,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8c74761cbae4383955090c67b62c479_42500/preview_video_talk_2.mp4',
            ),
            446 => 
            array (
                'id' => 947,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 474,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b470a434226d47b4b6d596036211c8ea_42850/preview_target.webp',
            ),
            447 => 
            array (
                'id' => 948,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 474,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b470a434226d47b4b6d596036211c8ea_42850/preview_video_target.mp4',
            ),
            448 => 
            array (
                'id' => 949,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 475,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/174cec361d9843cea39fa1bbb74846bd_42850/preview_talk_2.webp',
            ),
            449 => 
            array (
                'id' => 950,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 475,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/174cec361d9843cea39fa1bbb74846bd_42850/preview_video_talk_2.mp4',
            ),
            450 => 
            array (
                'id' => 951,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 476,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/376de02794904f96bd4576e34a1dbc83_42800/preview_target.webp',
            ),
            451 => 
            array (
                'id' => 952,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 476,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/376de02794904f96bd4576e34a1dbc83_42800/preview_video_target.mp4',
            ),
            452 => 
            array (
                'id' => 953,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 477,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/029cdc814dcb41998b253637de5d54f3_42860/preview_talk_1.webp',
            ),
            453 => 
            array (
                'id' => 954,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 477,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/029cdc814dcb41998b253637de5d54f3_42860/preview_video_talk_1.mp4',
            ),
            454 => 
            array (
                'id' => 955,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 478,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/007655cd288f4cae9c52b9b20e224ef4_42500/preview_target.webp',
            ),
            455 => 
            array (
                'id' => 956,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 478,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/007655cd288f4cae9c52b9b20e224ef4_42500/preview_video_target.mp4',
            ),
            456 => 
            array (
                'id' => 957,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 479,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/19965a20aa5243bbbef261181c6cba84_42490/preview_talk_1.webp',
            ),
            457 => 
            array (
                'id' => 958,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 479,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/19965a20aa5243bbbef261181c6cba84_42490/preview_video_talk_1.mp4',
            ),
            458 => 
            array (
                'id' => 959,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 480,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/587af8b69d9b4aa8940bd66d44e86999_42500/preview_talk_1.webp',
            ),
            459 => 
            array (
                'id' => 960,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 480,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/587af8b69d9b4aa8940bd66d44e86999_42500/preview_video_talk_1.mp4',
            ),
            460 => 
            array (
                'id' => 961,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 481,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a2ed055244374cd293032d7ee3a27563_42490/preview_talk_2.webp',
            ),
            461 => 
            array (
                'id' => 962,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 481,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a2ed055244374cd293032d7ee3a27563_42490/preview_video_talk_2.mp4',
            ),
            462 => 
            array (
                'id' => 963,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 482,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9736f5d005a48b9a33ff925ca21acdb_42840/preview_target.webp',
            ),
            463 => 
            array (
                'id' => 964,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 482,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9736f5d005a48b9a33ff925ca21acdb_42840/preview_video_target.mp4',
            ),
            464 => 
            array (
                'id' => 965,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 483,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d06377b067484b38bb15d6145074d083_42850/preview_talk_1.webp',
            ),
            465 => 
            array (
                'id' => 966,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 483,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d06377b067484b38bb15d6145074d083_42850/preview_video_talk_1.mp4',
            ),
            466 => 
            array (
                'id' => 967,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 484,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1765991ae2749758a5c806208eb55c8_42500/preview_talk_5.webp',
            ),
            467 => 
            array (
                'id' => 968,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 484,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1765991ae2749758a5c806208eb55c8_42500/preview_video_talk_5.mp4',
            ),
            468 => 
            array (
                'id' => 969,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 485,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77aac0edfba14076b140a4d151dd180c_13140/preview_talk_1.webp',
            ),
            469 => 
            array (
                'id' => 970,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 485,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77aac0edfba14076b140a4d151dd180c_13140/preview_video_talk_1.mp4',
            ),
            470 => 
            array (
                'id' => 971,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 486,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77aac0edfba14076b140a4d151dd180c_13140/preview_talk_3.webp',
            ),
            471 => 
            array (
                'id' => 972,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 486,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77aac0edfba14076b140a4d151dd180c_13140/preview_video_talk_3.mp4',
            ),
            472 => 
            array (
                'id' => 973,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 487,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77aac0edfba14076b140a4d151dd180c_13140/preview_talk_4.webp',
            ),
            473 => 
            array (
                'id' => 974,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 487,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77aac0edfba14076b140a4d151dd180c_13140/preview_video_talk_4.mp4',
            ),
            474 => 
            array (
                'id' => 975,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 488,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc0dc576a0b249759f8e26fd892e1a76_39540/preview_target.webp',
            ),
            475 => 
            array (
                'id' => 976,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 488,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc0dc576a0b249759f8e26fd892e1a76_39540/preview_video_target.mp4',
            ),
            476 => 
            array (
                'id' => 977,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 489,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d640fcc06f304f4aab78766bc161c982_39630/preview_target.webp',
            ),
            477 => 
            array (
                'id' => 978,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 489,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d640fcc06f304f4aab78766bc161c982_39630/preview_video_target.mp4',
            ),
            478 => 
            array (
                'id' => 979,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 490,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8eac6460a57747359330bfcfa0abbe96_39670/preview_target.webp',
            ),
            479 => 
            array (
                'id' => 980,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 490,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8eac6460a57747359330bfcfa0abbe96_39670/preview_video_target.mp4',
            ),
            480 => 
            array (
                'id' => 981,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 491,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/56470a9a70304e25a1f67f1b8d1d28d2_39380/preview_talk_1.webp',
            ),
            481 => 
            array (
                'id' => 982,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 491,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/56470a9a70304e25a1f67f1b8d1d28d2_39380/preview_video_talk_1.mp4',
            ),
            482 => 
            array (
                'id' => 983,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 492,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/37481bb8748940fb87ba3fcafaaa2539_39470/preview_target.webp',
            ),
            483 => 
            array (
                'id' => 984,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 492,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/37481bb8748940fb87ba3fcafaaa2539_39470/preview_video_target.mp4',
            ),
            484 => 
            array (
                'id' => 985,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 493,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7ce2094fd02547ae8a859d72c1b5c5bc_39590/preview_target.webp',
            ),
            485 => 
            array (
                'id' => 986,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 493,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7ce2094fd02547ae8a859d72c1b5c5bc_39590/preview_video_target.mp4',
            ),
            486 => 
            array (
                'id' => 987,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 494,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/23a34d8f91754a4d9855420362330358_39700/preview_target.webp',
            ),
            487 => 
            array (
                'id' => 988,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 494,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/23a34d8f91754a4d9855420362330358_39700/preview_video_target.mp4',
            ),
            488 => 
            array (
                'id' => 989,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 495,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3b245bcf41b497da8d5f6dedddf3fdc_34380/preview_talk_1.webp',
            ),
            489 => 
            array (
                'id' => 990,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 495,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3b245bcf41b497da8d5f6dedddf3fdc_34380/preview_video_talk_1.mp4',
            ),
            490 => 
            array (
                'id' => 991,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 496,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/68e38a4ca8354698a6a2a98094a92dc8_34390/preview_talk_1.webp',
            ),
            491 => 
            array (
                'id' => 992,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 496,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/68e38a4ca8354698a6a2a98094a92dc8_34390/preview_video_talk_1.mp4',
            ),
            492 => 
            array (
                'id' => 993,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 497,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0d42e29dde746e7a8bfe17626b8c08a_34400/preview_talk_1.webp',
            ),
            493 => 
            array (
                'id' => 994,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 497,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f0d42e29dde746e7a8bfe17626b8c08a_34400/preview_video_talk_1.mp4',
            ),
            494 => 
            array (
                'id' => 995,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 498,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94222a03cee4adaa110761a374cfadc_13181/preview_target.webp',
            ),
            495 => 
            array (
                'id' => 996,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 498,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94222a03cee4adaa110761a374cfadc_13181/preview_video_target.mp4',
            ),
            496 => 
            array (
                'id' => 997,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 499,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94222a03cee4adaa110761a374cfadc_13181/preview_talk_2.webp',
            ),
            497 => 
            array (
                'id' => 998,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 499,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94222a03cee4adaa110761a374cfadc_13181/preview_video_talk_2.mp4',
            ),
            498 => 
            array (
                'id' => 999,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 500,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94222a03cee4adaa110761a374cfadc_13181/preview_talk_5.webp',
            ),
            499 => 
            array (
                'id' => 1000,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 500,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f94222a03cee4adaa110761a374cfadc_13181/preview_video_talk_5.mp4',
            ),
        ));
        \DB::table('avatar_metas')->insert(array (
            0 => 
            array (
                'id' => 1001,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 501,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aab1172d472e474e98a85e262dab0dae_38050/preview_talk_1.webp',
            ),
            1 => 
            array (
                'id' => 1002,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 501,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aab1172d472e474e98a85e262dab0dae_38050/preview_video_talk_1.mp4',
            ),
            2 => 
            array (
                'id' => 1003,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 502,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/167f0f21269445be8eb3964aee62bbad_38050/preview_target.webp',
            ),
            3 => 
            array (
                'id' => 1004,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 502,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/167f0f21269445be8eb3964aee62bbad_38050/preview_video_target.mp4',
            ),
            4 => 
            array (
                'id' => 1005,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 503,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bb7d7a3065934a589ce70b208624edfd_38060/preview_talk_1.webp',
            ),
            5 => 
            array (
                'id' => 1006,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 503,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bb7d7a3065934a589ce70b208624edfd_38060/preview_video_talk_1.mp4',
            ),
            6 => 
            array (
                'id' => 1007,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 504,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/774bc8aa4baa452ea438af6ae7a7ab3d_38060/preview_target.webp',
            ),
            7 => 
            array (
                'id' => 1008,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 504,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/774bc8aa4baa452ea438af6ae7a7ab3d_38060/preview_video_target.mp4',
            ),
            8 => 
            array (
                'id' => 1009,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 505,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/038adceb6f2a443099edf51f2836e12b_38260/preview_talk_1.webp',
            ),
            9 => 
            array (
                'id' => 1010,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 505,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/038adceb6f2a443099edf51f2836e12b_38260/preview_video_talk_1.mp4',
            ),
            10 => 
            array (
                'id' => 1011,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 506,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4da0419e57454aab9e321f42aa972375_38260/preview_target.webp',
            ),
            11 => 
            array (
                'id' => 1012,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 506,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4da0419e57454aab9e321f42aa972375_38260/preview_video_target.mp4',
            ),
            12 => 
            array (
                'id' => 1013,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 507,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dcbef159fe8047c88710734ecd77dc63_38270/preview_talk_1.webp',
            ),
            13 => 
            array (
                'id' => 1014,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 507,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dcbef159fe8047c88710734ecd77dc63_38270/preview_video_talk_1.mp4',
            ),
            14 => 
            array (
                'id' => 1015,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 508,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/62caaf8e206a413e9783ce865b116832_38270/preview_target.webp',
            ),
            15 => 
            array (
                'id' => 1016,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 508,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/62caaf8e206a413e9783ce865b116832_38270/preview_video_target.mp4',
            ),
            16 => 
            array (
                'id' => 1017,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 509,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/67f5c5d34f304271a3d25de529ce669b_38490/preview_talk_1.webp',
            ),
            17 => 
            array (
                'id' => 1018,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 509,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/67f5c5d34f304271a3d25de529ce669b_38490/preview_video_talk_1.mp4',
            ),
            18 => 
            array (
                'id' => 1019,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 510,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1995ed4d96bd4879937e7cbaae09eb4f_38500/preview_talk_2.webp',
            ),
            19 => 
            array (
                'id' => 1020,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 510,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1995ed4d96bd4879937e7cbaae09eb4f_38500/preview_video_talk_2.mp4',
            ),
            20 => 
            array (
                'id' => 1021,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 511,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2536850380f14112b84b9dfa0ce5a8fb_38410/preview_target.webp',
            ),
            21 => 
            array (
                'id' => 1022,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 511,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2536850380f14112b84b9dfa0ce5a8fb_38410/preview_video_target.mp4',
            ),
            22 => 
            array (
                'id' => 1023,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 512,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/050132ae00574515a38afaf93820c80d_38400/preview_target.webp',
            ),
            23 => 
            array (
                'id' => 1024,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 512,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/050132ae00574515a38afaf93820c80d_38400/preview_video_target.mp4',
            ),
            24 => 
            array (
                'id' => 1025,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 513,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0b4a8f1afbe7449b9f06020ef550e486_38410/preview_talk_1.webp',
            ),
            25 => 
            array (
                'id' => 1026,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 513,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0b4a8f1afbe7449b9f06020ef550e486_38410/preview_video_talk_1.mp4',
            ),
            26 => 
            array (
                'id' => 1027,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 514,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0380256385f64860b4fa5cb67661212d_38400/preview_talk_1.webp',
            ),
            27 => 
            array (
                'id' => 1028,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 514,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0380256385f64860b4fa5cb67661212d_38400/preview_video_talk_1.mp4',
            ),
            28 => 
            array (
                'id' => 1029,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 515,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6bcdc43cd4be4b098f3338aefb83fe4c_38490/preview_talk_2.webp',
            ),
            29 => 
            array (
                'id' => 1030,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 515,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6bcdc43cd4be4b098f3338aefb83fe4c_38490/preview_video_talk_2.mp4',
            ),
            30 => 
            array (
                'id' => 1031,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 516,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/225b314b878f4cdc88a378a08e346610_38500/preview_target.webp',
            ),
            31 => 
            array (
                'id' => 1032,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 516,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/225b314b878f4cdc88a378a08e346610_38500/preview_video_target.mp4',
            ),
            32 => 
            array (
                'id' => 1033,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 517,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b596c0849b7942778ad27f63c5995e33_2626/preview_talk_1.webp',
            ),
            33 => 
            array (
                'id' => 1034,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 517,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b596c0849b7942778ad27f63c5995e33_2626/preview_video_talk_1.mp4',
            ),
            34 => 
            array (
                'id' => 1035,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 518,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dcbb1272edce4003b63f5f87cdb99ea0_48370/preview_target.webp',
            ),
            35 => 
            array (
                'id' => 1036,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 518,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dcbb1272edce4003b63f5f87cdb99ea0_48370/preview_video_target.mp4',
            ),
            36 => 
            array (
                'id' => 1037,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 519,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f362f513eb5241d795aa555d47e02db5_48370/preview_talk_2.webp',
            ),
            37 => 
            array (
                'id' => 1038,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 519,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f362f513eb5241d795aa555d47e02db5_48370/preview_video_talk_2.mp4',
            ),
            38 => 
            array (
                'id' => 1039,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 520,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8a770e4e91864a5db7dd09eee74d7d4b_48360/preview_talk_1.webp',
            ),
            39 => 
            array (
                'id' => 1040,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 520,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8a770e4e91864a5db7dd09eee74d7d4b_48360/preview_video_talk_1.mp4',
            ),
            40 => 
            array (
                'id' => 1041,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 521,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/07ec261b50144715a8c8c37dd078a481_48360/preview_talk_2.webp',
            ),
            41 => 
            array (
                'id' => 1042,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 521,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/07ec261b50144715a8c8c37dd078a481_48360/preview_video_talk_2.mp4',
            ),
            42 => 
            array (
                'id' => 1043,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 522,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/190a8bd537fd4fda840e09f49d277599_48370/preview_talk_1.webp',
            ),
            43 => 
            array (
                'id' => 1044,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 522,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/190a8bd537fd4fda840e09f49d277599_48370/preview_video_talk_1.mp4',
            ),
            44 => 
            array (
                'id' => 1045,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 523,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/719ea3283dae4fc6bae76daec69e29a5_48360/preview_target.webp',
            ),
            45 => 
            array (
                'id' => 1046,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 523,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/719ea3283dae4fc6bae76daec69e29a5_48360/preview_video_target.mp4',
            ),
            46 => 
            array (
                'id' => 1047,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 524,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3d8888d911904c1ab0059ca69c1e8814_46190/preview_talk_3.webp',
            ),
            47 => 
            array (
                'id' => 1048,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 524,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3d8888d911904c1ab0059ca69c1e8814_46190/preview_video_talk_3.mp4',
            ),
            48 => 
            array (
                'id' => 1049,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 525,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d26efc602e347fead32af0ac6eb3345_46190/preview_talk_3.webp',
            ),
            49 => 
            array (
                'id' => 1050,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 525,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d26efc602e347fead32af0ac6eb3345_46190/preview_video_talk_3.mp4',
            ),
            50 => 
            array (
                'id' => 1051,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 526,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/11a1509a55e84ef38bf543c4fc780765_46180/preview_talk_3.webp',
            ),
            51 => 
            array (
                'id' => 1052,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 526,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/11a1509a55e84ef38bf543c4fc780765_46180/preview_video_talk_3.mp4',
            ),
            52 => 
            array (
                'id' => 1053,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 527,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/007d329047914a5d84ee892b602df5bb_46180/preview_talk_1.webp',
            ),
            53 => 
            array (
                'id' => 1054,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 527,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/007d329047914a5d84ee892b602df5bb_46180/preview_video_talk_1.mp4',
            ),
            54 => 
            array (
                'id' => 1055,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 528,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/339bf2081af24616a55b77b3ecc2092f_48330/preview_target.webp',
            ),
            55 => 
            array (
                'id' => 1056,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 528,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/339bf2081af24616a55b77b3ecc2092f_48330/preview_video_target.mp4',
            ),
            56 => 
            array (
                'id' => 1057,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 529,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/98738abc27534cf49da0564ef1890b61_46190/preview_target.webp',
            ),
            57 => 
            array (
                'id' => 1058,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 529,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/98738abc27534cf49da0564ef1890b61_46190/preview_video_target.mp4',
            ),
            58 => 
            array (
                'id' => 1059,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 530,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c8b23fdc76245949ce9faff8dbfcdbc_37600/preview_target.webp',
            ),
            59 => 
            array (
                'id' => 1060,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 530,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c8b23fdc76245949ce9faff8dbfcdbc_37600/preview_video_target.mp4',
            ),
            60 => 
            array (
                'id' => 1061,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 531,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2e4e61ab29cf4ea39594c386fd16bdfa_37590/preview_target.webp',
            ),
            61 => 
            array (
                'id' => 1062,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 531,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2e4e61ab29cf4ea39594c386fd16bdfa_37590/preview_video_target.mp4',
            ),
            62 => 
            array (
                'id' => 1063,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 532,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/010c467cc97c4081a8f556c7e0e8e8b7_37610/preview_target.webp',
            ),
            63 => 
            array (
                'id' => 1064,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 532,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/010c467cc97c4081a8f556c7e0e8e8b7_37610/preview_video_target.mp4',
            ),
            64 => 
            array (
                'id' => 1065,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 533,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ba066c0c9a9a479d800b1f5f9ac5ee4a_37580/preview_talk_1.webp',
            ),
            65 => 
            array (
                'id' => 1066,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 533,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ba066c0c9a9a479d800b1f5f9ac5ee4a_37580/preview_video_talk_1.mp4',
            ),
            66 => 
            array (
                'id' => 1067,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 534,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1078424d53474b42bff67530381084b2_37660/preview_talk_2.webp',
            ),
            67 => 
            array (
                'id' => 1068,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 534,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1078424d53474b42bff67530381084b2_37660/preview_video_talk_2.mp4',
            ),
            68 => 
            array (
                'id' => 1069,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 535,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8497d541ca504e73bd8a2105edcb2104_37660/preview_talk_1.webp',
            ),
            69 => 
            array (
                'id' => 1070,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 535,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8497d541ca504e73bd8a2105edcb2104_37660/preview_video_talk_1.mp4',
            ),
            70 => 
            array (
                'id' => 1071,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 536,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/44a4c6decaa341a2b9f48e2f0d6d9fca_38440/preview_target.webp',
            ),
            71 => 
            array (
                'id' => 1072,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 536,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/44a4c6decaa341a2b9f48e2f0d6d9fca_38440/preview_video_target.mp4',
            ),
            72 => 
            array (
                'id' => 1073,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 537,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e52d3897dce14eaf8e1bb68a23dfdb45_37650/preview_talk_1.webp',
            ),
            73 => 
            array (
                'id' => 1074,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 537,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e52d3897dce14eaf8e1bb68a23dfdb45_37650/preview_video_talk_1.mp4',
            ),
            74 => 
            array (
                'id' => 1075,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 538,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4db63bc961c84f7bb8709b91961f39f5_52230/preview_target.webp',
            ),
            75 => 
            array (
                'id' => 1076,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 538,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4db63bc961c84f7bb8709b91961f39f5_52230/preview_video_target.mp4',
            ),
            76 => 
            array (
                'id' => 1077,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 539,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5cedd38b227746ea95edc4a0332c7746_52300/preview_target.webp',
            ),
            77 => 
            array (
                'id' => 1078,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 539,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5cedd38b227746ea95edc4a0332c7746_52300/preview_video_target.mp4',
            ),
            78 => 
            array (
                'id' => 1079,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 540,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c326a7d470be4cd0b949cde567a68567_14857/preview_talk_3.webp',
            ),
            79 => 
            array (
                'id' => 1080,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 540,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c326a7d470be4cd0b949cde567a68567_14857/preview_video_talk_3.mp4',
            ),
            80 => 
            array (
                'id' => 1081,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 541,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5e3416381f2345569991010c35d5c8cb_45820/preview_target.webp',
            ),
            81 => 
            array (
                'id' => 1082,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 541,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5e3416381f2345569991010c35d5c8cb_45820/preview_video_target.mp4',
            ),
            82 => 
            array (
                'id' => 1083,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 542,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e9090ab80f24aedbda3edcc5477aa10_45740/preview_talk_2.webp',
            ),
            83 => 
            array (
                'id' => 1084,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 542,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e9090ab80f24aedbda3edcc5477aa10_45740/preview_video_talk_2.mp4',
            ),
            84 => 
            array (
                'id' => 1085,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 543,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/85ade20079d74bfbb1e06c76c49ea387_45750/preview_talk_2.webp',
            ),
            85 => 
            array (
                'id' => 1086,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 543,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/85ade20079d74bfbb1e06c76c49ea387_45750/preview_video_talk_2.mp4',
            ),
            86 => 
            array (
                'id' => 1087,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 544,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/630c5090f8444f88b5fb4f2780df5d05_45740/preview_talk_1.webp',
            ),
            87 => 
            array (
                'id' => 1088,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 544,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/630c5090f8444f88b5fb4f2780df5d05_45740/preview_video_talk_1.mp4',
            ),
            88 => 
            array (
                'id' => 1089,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 545,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/596aeb26dece4bb7a7b78cbed4f52898_45750/preview_talk_1.webp',
            ),
            89 => 
            array (
                'id' => 1090,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 545,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/596aeb26dece4bb7a7b78cbed4f52898_45750/preview_video_talk_1.mp4',
            ),
            90 => 
            array (
                'id' => 1091,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 546,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59f9b51a1c3c4218a74dd324b0ac9e1e_13310/preview_talk_3.webp',
            ),
            91 => 
            array (
                'id' => 1092,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 546,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59f9b51a1c3c4218a74dd324b0ac9e1e_13310/preview_video_talk_3.mp4',
            ),
            92 => 
            array (
                'id' => 1093,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 547,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/25257e48e8034131a3a055b234cd4683_38090/preview_talk_1.webp',
            ),
            93 => 
            array (
                'id' => 1094,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 547,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/25257e48e8034131a3a055b234cd4683_38090/preview_video_talk_1.mp4',
            ),
            94 => 
            array (
                'id' => 1095,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 548,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9712d1bcebed4c5d9869d36af796a532_38090/preview_target.webp',
            ),
            95 => 
            array (
                'id' => 1096,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 548,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9712d1bcebed4c5d9869d36af796a532_38090/preview_video_target.mp4',
            ),
            96 => 
            array (
                'id' => 1097,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 549,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fd973e3d6bbd4954a42ee559a2bff6e6_38100/preview_talk_1.webp',
            ),
            97 => 
            array (
                'id' => 1098,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 549,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fd973e3d6bbd4954a42ee559a2bff6e6_38100/preview_video_talk_1.mp4',
            ),
            98 => 
            array (
                'id' => 1099,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 550,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59c8f4452d1f461c9404568f189df4f3_38100/preview_target.webp',
            ),
            99 => 
            array (
                'id' => 1100,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 550,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59c8f4452d1f461c9404568f189df4f3_38100/preview_video_target.mp4',
            ),
            100 => 
            array (
                'id' => 1101,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 551,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48b6894526c84bdda40330d3325df5fa_38790/preview_target.webp',
            ),
            101 => 
            array (
                'id' => 1102,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 551,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48b6894526c84bdda40330d3325df5fa_38790/preview_video_target.mp4',
            ),
            102 => 
            array (
                'id' => 1103,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 552,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fd17e321d8bb460487ab34acf75eeae7_38300/preview_target.webp',
            ),
            103 => 
            array (
                'id' => 1104,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 552,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fd17e321d8bb460487ab34acf75eeae7_38300/preview_video_target.mp4',
            ),
            104 => 
            array (
                'id' => 1105,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 553,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1c55173e68245ad886a30cce161c351_38310/preview_talk_1.webp',
            ),
            105 => 
            array (
                'id' => 1106,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 553,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1c55173e68245ad886a30cce161c351_38310/preview_video_talk_1.mp4',
            ),
            106 => 
            array (
                'id' => 1107,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 554,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88e9c715d39f45869626baee48cf6249_38310/preview_target.webp',
            ),
            107 => 
            array (
                'id' => 1108,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 554,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88e9c715d39f45869626baee48cf6249_38310/preview_video_target.mp4',
            ),
            108 => 
            array (
                'id' => 1109,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 555,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e2b628b892a740efbde8a8bf9371d410_37860/preview_talk_2.webp',
            ),
            109 => 
            array (
                'id' => 1110,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 555,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e2b628b892a740efbde8a8bf9371d410_37860/preview_video_talk_2.mp4',
            ),
            110 => 
            array (
                'id' => 1111,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 556,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a295712797d54bf4b6426c5e8593909a_37860/preview_talk_3.webp',
            ),
            111 => 
            array (
                'id' => 1112,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 556,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a295712797d54bf4b6426c5e8593909a_37860/preview_video_talk_3.mp4',
            ),
            112 => 
            array (
                'id' => 1113,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 557,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26715cbc2f664a4798da60f6b8118da1_37880/preview_talk_1.webp',
            ),
            113 => 
            array (
                'id' => 1114,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 557,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26715cbc2f664a4798da60f6b8118da1_37880/preview_video_talk_1.mp4',
            ),
            114 => 
            array (
                'id' => 1115,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 558,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/16b1efeaaa274e65904d0edfa720067e_37880/preview_target.webp',
            ),
            115 => 
            array (
                'id' => 1116,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 558,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/16b1efeaaa274e65904d0edfa720067e_37880/preview_video_target.mp4',
            ),
            116 => 
            array (
                'id' => 1117,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 559,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/174699c01e7c47e990196259a02e027d_37860/preview_talk_1.webp',
            ),
            117 => 
            array (
                'id' => 1118,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 559,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/174699c01e7c47e990196259a02e027d_37860/preview_video_talk_1.mp4',
            ),
            118 => 
            array (
                'id' => 1119,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 560,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/42238f78ef4c49b6bfb77e7cd7913977_37860/preview_target.webp',
            ),
            119 => 
            array (
                'id' => 1120,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 560,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/42238f78ef4c49b6bfb77e7cd7913977_37860/preview_video_target.mp4',
            ),
            120 => 
            array (
                'id' => 1121,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 561,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad2f42ddac064e0b93e14bff4e1f9551_37870/preview_target.webp',
            ),
            121 => 
            array (
                'id' => 1122,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 561,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad2f42ddac064e0b93e14bff4e1f9551_37870/preview_video_target.mp4',
            ),
            122 => 
            array (
                'id' => 1123,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 562,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5059349cb10c4599a3c98ef45466382f_37870/preview_talk_1.webp',
            ),
            123 => 
            array (
                'id' => 1124,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 562,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5059349cb10c4599a3c98ef45466382f_37870/preview_video_talk_1.mp4',
            ),
            124 => 
            array (
                'id' => 1125,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 563,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7425ff40f38498085030cafa8108034_14757/preview_talk_3.webp',
            ),
            125 => 
            array (
                'id' => 1126,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 563,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7425ff40f38498085030cafa8108034_14757/preview_video_talk_3.mp4',
            ),
            126 => 
            array (
                'id' => 1127,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 564,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c4434f25263b4de48eafe838338272fe_37420/preview_talk_1.webp',
            ),
            127 => 
            array (
                'id' => 1128,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 564,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c4434f25263b4de48eafe838338272fe_37420/preview_video_talk_1.mp4',
            ),
            128 => 
            array (
                'id' => 1129,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 565,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/600142856eb648cbb6786783d3fe25fd_37420/preview_target.webp',
            ),
            129 => 
            array (
                'id' => 1130,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 565,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/600142856eb648cbb6786783d3fe25fd_37420/preview_video_target.mp4',
            ),
            130 => 
            array (
                'id' => 1131,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 566,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1526fb587854cfa839cd03749f0c1b9_37430/preview_talk_1.webp',
            ),
            131 => 
            array (
                'id' => 1132,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 566,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1526fb587854cfa839cd03749f0c1b9_37430/preview_video_talk_1.mp4',
            ),
            132 => 
            array (
                'id' => 1133,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 567,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b287941ebe2437fb8a6f4c313be1738_37430/preview_target.webp',
            ),
            133 => 
            array (
                'id' => 1134,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 567,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b287941ebe2437fb8a6f4c313be1738_37430/preview_video_target.mp4',
            ),
            134 => 
            array (
                'id' => 1135,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 568,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a63084fab5a14c509459500877a4f2c0_37380/preview_talk_1.webp',
            ),
            135 => 
            array (
                'id' => 1136,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 568,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a63084fab5a14c509459500877a4f2c0_37380/preview_video_talk_1.mp4',
            ),
            136 => 
            array (
                'id' => 1137,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 569,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3f123e7884aa4024ab9d623566449f1d_37380/preview_target.webp',
            ),
            137 => 
            array (
                'id' => 1138,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 569,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3f123e7884aa4024ab9d623566449f1d_37380/preview_video_target.mp4',
            ),
            138 => 
            array (
                'id' => 1139,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 570,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6e3c56e3f2a04041836ae4449bdcb808_37390/preview_target.webp',
            ),
            139 => 
            array (
                'id' => 1140,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 570,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6e3c56e3f2a04041836ae4449bdcb808_37390/preview_video_target.mp4',
            ),
            140 => 
            array (
                'id' => 1141,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 571,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c1b5f6e2702140bea7658c9af83aaa19_37390/preview_talk_1.webp',
            ),
            141 => 
            array (
                'id' => 1142,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 571,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c1b5f6e2702140bea7658c9af83aaa19_37390/preview_video_talk_1.mp4',
            ),
            142 => 
            array (
                'id' => 1143,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 572,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c66b96c447b4c79a8ee93512afc73a6_44390/preview_talk_4.webp',
            ),
            143 => 
            array (
                'id' => 1144,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 572,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c66b96c447b4c79a8ee93512afc73a6_44390/preview_video_talk_4.mp4',
            ),
            144 => 
            array (
                'id' => 1145,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 573,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5316bfe35e3a41a99af40650698e8ca4_39520/preview_target.webp',
            ),
            145 => 
            array (
                'id' => 1146,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 573,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5316bfe35e3a41a99af40650698e8ca4_39520/preview_video_target.mp4',
            ),
            146 => 
            array (
                'id' => 1147,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 574,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea8708c75dd14ce1b0aa0f56addd79ff_39610/preview_target.webp',
            ),
            147 => 
            array (
                'id' => 1148,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 574,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea8708c75dd14ce1b0aa0f56addd79ff_39610/preview_video_target.mp4',
            ),
            148 => 
            array (
                'id' => 1149,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 575,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/613d8444f5264ee8997725a087ce520c_39390/preview_talk_2.webp',
            ),
            149 => 
            array (
                'id' => 1150,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 575,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/613d8444f5264ee8997725a087ce520c_39390/preview_video_talk_2.mp4',
            ),
            150 => 
            array (
                'id' => 1151,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 576,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d5321631a09475ab759d39f15d4de52_39480/preview_target.webp',
            ),
            151 => 
            array (
                'id' => 1152,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 576,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d5321631a09475ab759d39f15d4de52_39480/preview_video_target.mp4',
            ),
            152 => 
            array (
                'id' => 1153,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 577,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/69d07b8f02194765befda0c2d2a9588d_37730/preview_talk_7.webp',
            ),
            153 => 
            array (
                'id' => 1154,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 577,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/69d07b8f02194765befda0c2d2a9588d_37730/preview_video_talk_7.mp4',
            ),
            154 => 
            array (
                'id' => 1155,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 578,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/732ab382194149198f3c29d85988890e_37740/preview_talk_4.webp',
            ),
            155 => 
            array (
                'id' => 1156,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 578,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/732ab382194149198f3c29d85988890e_37740/preview_video_talk_4.mp4',
            ),
            156 => 
            array (
                'id' => 1157,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 579,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/82c60b4406aa4aa08449f0f4fb2604c0_38000/preview_talk_1.webp',
            ),
            157 => 
            array (
                'id' => 1158,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 579,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/82c60b4406aa4aa08449f0f4fb2604c0_38000/preview_video_talk_1.mp4',
            ),
            158 => 
            array (
                'id' => 1159,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 580,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2c71265382fd443385abff2833c985c0_37740/preview_target.webp',
            ),
            159 => 
            array (
                'id' => 1160,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 580,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2c71265382fd443385abff2833c985c0_37740/preview_video_target.mp4',
            ),
            160 => 
            array (
                'id' => 1161,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 581,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/22a0b782d84f46ddac70d67212979d1d_37730/preview_talk_3.webp',
            ),
            161 => 
            array (
                'id' => 1162,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 581,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/22a0b782d84f46ddac70d67212979d1d_37730/preview_video_talk_3.mp4',
            ),
            162 => 
            array (
                'id' => 1163,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 582,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0bfb786b43c147eea67f56152f469b37_37730/preview_talk_1.webp',
            ),
            163 => 
            array (
                'id' => 1164,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 582,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0bfb786b43c147eea67f56152f469b37_37730/preview_video_talk_1.mp4',
            ),
            164 => 
            array (
                'id' => 1165,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 583,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f0ed7f8c8d848e98a5e5ad1884be249_37740/preview_talk_5.webp',
            ),
            165 => 
            array (
                'id' => 1166,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 583,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f0ed7f8c8d848e98a5e5ad1884be249_37740/preview_video_talk_5.mp4',
            ),
            166 => 
            array (
                'id' => 1167,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 584,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e4e069ceaa2143c8bdfd33c08c2cc1b1_37740/preview_talk_2.webp',
            ),
            167 => 
            array (
                'id' => 1168,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 584,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e4e069ceaa2143c8bdfd33c08c2cc1b1_37740/preview_video_talk_2.mp4',
            ),
            168 => 
            array (
                'id' => 1169,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 585,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09782079cbb14d97be82de2fe867c690_44410/preview_talk_4.webp',
            ),
            169 => 
            array (
                'id' => 1170,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 585,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09782079cbb14d97be82de2fe867c690_44410/preview_video_talk_4.mp4',
            ),
            170 => 
            array (
                'id' => 1171,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 586,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c18ac00b6a8c422c89aab25bf0182da3_37460/preview_talk_1.webp',
            ),
            171 => 
            array (
                'id' => 1172,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 586,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c18ac00b6a8c422c89aab25bf0182da3_37460/preview_video_talk_1.mp4',
            ),
            172 => 
            array (
                'id' => 1173,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 587,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/02f5b414d63e49e8905031b93f4784ae_37470/preview_talk_1.webp',
            ),
            173 => 
            array (
                'id' => 1174,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 587,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/02f5b414d63e49e8905031b93f4784ae_37470/preview_video_talk_1.mp4',
            ),
            174 => 
            array (
                'id' => 1175,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 588,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/185238c6e6824ec7b4bba8ea3d9650a2_37460/preview_talk_2.webp',
            ),
            175 => 
            array (
                'id' => 1176,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 588,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/185238c6e6824ec7b4bba8ea3d9650a2_37460/preview_video_talk_2.mp4',
            ),
            176 => 
            array (
                'id' => 1177,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 589,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2297b2619b784d6db35ce56c6a93c385_37460/preview_talk_3.webp',
            ),
            177 => 
            array (
                'id' => 1178,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 589,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2297b2619b784d6db35ce56c6a93c385_37460/preview_video_talk_3.mp4',
            ),
            178 => 
            array (
                'id' => 1179,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 590,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49d3cbae2df44edd9690b4ec329ada1f_37470/preview_talk_2.webp',
            ),
            179 => 
            array (
                'id' => 1180,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 590,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49d3cbae2df44edd9690b4ec329ada1f_37470/preview_video_talk_2.mp4',
            ),
            180 => 
            array (
                'id' => 1181,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 591,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fcf2a5f6b1ba4e5c9582c49e0c52f8ad_37470/preview_talk_3.webp',
            ),
            181 => 
            array (
                'id' => 1182,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 591,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fcf2a5f6b1ba4e5c9582c49e0c52f8ad_37470/preview_video_talk_3.mp4',
            ),
            182 => 
            array (
                'id' => 1183,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 592,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/216fc0bd22ce4456a7565d6ce3793125_39020/preview_talk_7.webp',
            ),
            183 => 
            array (
                'id' => 1184,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 592,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/216fc0bd22ce4456a7565d6ce3793125_39020/preview_video_talk_7.mp4',
            ),
            184 => 
            array (
                'id' => 1185,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 593,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/089414f8a06c4cf7a47d3a14a5019ce3_39050/preview_talk_3.webp',
            ),
            185 => 
            array (
                'id' => 1186,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 593,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/089414f8a06c4cf7a47d3a14a5019ce3_39050/preview_video_talk_3.mp4',
            ),
            186 => 
            array (
                'id' => 1187,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 594,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a6c1b75d2edc484f8f5d9a274aa55f00_39020/preview_talk_3.webp',
            ),
            187 => 
            array (
                'id' => 1188,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 594,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a6c1b75d2edc484f8f5d9a274aa55f00_39020/preview_video_talk_3.mp4',
            ),
            188 => 
            array (
                'id' => 1189,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 595,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c70eb76fb3b4631acbfd0ef6a2540e8_39020/preview_target.webp',
            ),
            189 => 
            array (
                'id' => 1190,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 595,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c70eb76fb3b4631acbfd0ef6a2540e8_39020/preview_video_target.mp4',
            ),
            190 => 
            array (
                'id' => 1191,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 596,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/19f986f218ec4231b8154bfd24ddba45_39050/preview_target.webp',
            ),
            191 => 
            array (
                'id' => 1192,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 596,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/19f986f218ec4231b8154bfd24ddba45_39050/preview_video_target.mp4',
            ),
            192 => 
            array (
                'id' => 1193,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 597,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d6473c9b66c742138e45b05f2451d4ac_39020/preview_talk_5.webp',
            ),
            193 => 
            array (
                'id' => 1194,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 597,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d6473c9b66c742138e45b05f2451d4ac_39020/preview_video_talk_5.mp4',
            ),
            194 => 
            array (
                'id' => 1195,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 598,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d6f671298a974005b092d2790516d2d2_39060/preview_target.webp',
            ),
            195 => 
            array (
                'id' => 1196,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 598,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d6f671298a974005b092d2790516d2d2_39060/preview_video_target.mp4',
            ),
            196 => 
            array (
                'id' => 1197,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 599,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/845a1bdc03f84f15a668f9401797a661_37800/preview_talk_2.webp',
            ),
            197 => 
            array (
                'id' => 1198,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 599,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/845a1bdc03f84f15a668f9401797a661_37800/preview_video_talk_2.mp4',
            ),
            198 => 
            array (
                'id' => 1199,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 600,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/673145fb1fa34b59a438db24b700fb08_37800/preview_talk_6.webp',
            ),
            199 => 
            array (
                'id' => 1200,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 600,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/673145fb1fa34b59a438db24b700fb08_37800/preview_video_talk_6.mp4',
            ),
            200 => 
            array (
                'id' => 1201,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 601,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/91a6bc464d714d2da4881c2e561235cc_37500/preview_target.webp',
            ),
            201 => 
            array (
                'id' => 1202,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 601,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/91a6bc464d714d2da4881c2e561235cc_37500/preview_video_target.mp4',
            ),
            202 => 
            array (
                'id' => 1203,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 602,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a59def73e84b44b09cc569f0511c1c8c_37500/preview_talk_6.webp',
            ),
            203 => 
            array (
                'id' => 1204,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 602,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a59def73e84b44b09cc569f0511c1c8c_37500/preview_video_talk_6.mp4',
            ),
            204 => 
            array (
                'id' => 1205,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 603,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9aa7ff78e8db413d928776af36428403_37540/preview_talk_1.webp',
            ),
            205 => 
            array (
                'id' => 1206,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 603,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9aa7ff78e8db413d928776af36428403_37540/preview_video_talk_1.mp4',
            ),
            206 => 
            array (
                'id' => 1207,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 604,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3087f1536485453dad659ccd912305a9_37550/preview_talk_1.webp',
            ),
            207 => 
            array (
                'id' => 1208,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 604,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3087f1536485453dad659ccd912305a9_37550/preview_video_talk_1.mp4',
            ),
            208 => 
            array (
                'id' => 1209,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 605,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2a5c4cc52e8c4fc09c19d73aacde95a3_37810/preview_target.webp',
            ),
            209 => 
            array (
                'id' => 1210,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 605,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2a5c4cc52e8c4fc09c19d73aacde95a3_37810/preview_video_target.mp4',
            ),
            210 => 
            array (
                'id' => 1211,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 606,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/93e28fce67c84bf095686a6d6af86a00_37810/preview_talk_4.webp',
            ),
            211 => 
            array (
                'id' => 1212,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 606,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/93e28fce67c84bf095686a6d6af86a00_37810/preview_video_talk_4.mp4',
            ),
            212 => 
            array (
                'id' => 1213,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 607,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4c5a7f8082fe4eb4a396f9c2c58f7fa0_37530/preview_talk_4.webp',
            ),
            213 => 
            array (
                'id' => 1214,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 607,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4c5a7f8082fe4eb4a396f9c2c58f7fa0_37530/preview_video_talk_4.mp4',
            ),
            214 => 
            array (
                'id' => 1215,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 608,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/14aafc7022fa48ada98d21b7ebe47b04_37530/preview_target.webp',
            ),
            215 => 
            array (
                'id' => 1216,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 608,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/14aafc7022fa48ada98d21b7ebe47b04_37530/preview_video_target.mp4',
            ),
            216 => 
            array (
                'id' => 1217,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 609,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/36ea896236c6453c9587d29e92741154_52310/preview_target.webp',
            ),
            217 => 
            array (
                'id' => 1218,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 609,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/36ea896236c6453c9587d29e92741154_52310/preview_video_target.mp4',
            ),
            218 => 
            array (
                'id' => 1219,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 610,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9f2cd4dc7a234405b54994d57a94e727_39350/preview_talk_1.webp',
            ),
            219 => 
            array (
                'id' => 1220,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 610,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9f2cd4dc7a234405b54994d57a94e727_39350/preview_video_talk_1.mp4',
            ),
            220 => 
            array (
                'id' => 1221,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 611,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/32c5fd108f364c178cf538819f9ddc44_39350/preview_target.webp',
            ),
            221 => 
            array (
                'id' => 1222,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 611,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/32c5fd108f364c178cf538819f9ddc44_39350/preview_video_target.mp4',
            ),
            222 => 
            array (
                'id' => 1223,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 612,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b6a74ee4609f4e948ccd53fe7983a51b_39370/preview_talk_3.webp',
            ),
            223 => 
            array (
                'id' => 1224,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 612,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b6a74ee4609f4e948ccd53fe7983a51b_39370/preview_video_talk_3.mp4',
            ),
            224 => 
            array (
                'id' => 1225,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 613,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/652c2c7739e643559ae7a7678a934914_39360/preview_target.webp',
            ),
            225 => 
            array (
                'id' => 1226,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 613,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/652c2c7739e643559ae7a7678a934914_39360/preview_video_target.mp4',
            ),
            226 => 
            array (
                'id' => 1227,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 614,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6ca1846860fc45e6bc0c244833a33b51_39350/preview_talk_3.webp',
            ),
            227 => 
            array (
                'id' => 1228,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 614,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6ca1846860fc45e6bc0c244833a33b51_39350/preview_video_talk_3.mp4',
            ),
            228 => 
            array (
                'id' => 1229,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 615,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b863aacea458444b9cf3ffba065cc12c_39350/preview_talk_2.webp',
            ),
            229 => 
            array (
                'id' => 1230,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 615,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b863aacea458444b9cf3ffba065cc12c_39350/preview_video_talk_2.mp4',
            ),
            230 => 
            array (
                'id' => 1231,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 616,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0132a00094284f16af2fd2f4260a3a7d_39370/preview_target.webp',
            ),
            231 => 
            array (
                'id' => 1232,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 616,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0132a00094284f16af2fd2f4260a3a7d_39370/preview_video_target.mp4',
            ),
            232 => 
            array (
                'id' => 1233,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 617,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48611017d9bc4d439ea871039ffb60db_39360/preview_talk_1.webp',
            ),
            233 => 
            array (
                'id' => 1234,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 617,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/48611017d9bc4d439ea871039ffb60db_39360/preview_video_talk_1.mp4',
            ),
            234 => 
            array (
                'id' => 1235,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 618,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2e19cc1ed67640d2bbe2c14187d30f55_39350/preview_talk_4.webp',
            ),
            235 => 
            array (
                'id' => 1236,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 618,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2e19cc1ed67640d2bbe2c14187d30f55_39350/preview_video_talk_4.mp4',
            ),
            236 => 
            array (
                'id' => 1237,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 619,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c05c1d7066a145189ac40c91e8c1faa6_39350/preview_talk_5.webp',
            ),
            237 => 
            array (
                'id' => 1238,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 619,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c05c1d7066a145189ac40c91e8c1faa6_39350/preview_video_talk_5.mp4',
            ),
            238 => 
            array (
                'id' => 1239,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 620,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0781e9c3c667432eb001d5ad3ac07a5e_39370/preview_talk_2.webp',
            ),
            239 => 
            array (
                'id' => 1240,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 620,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0781e9c3c667432eb001d5ad3ac07a5e_39370/preview_video_talk_2.mp4',
            ),
            240 => 
            array (
                'id' => 1241,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 621,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5546a1dfbb544b3e85dc712eb73cdb39_39370/preview_talk_1.webp',
            ),
            241 => 
            array (
                'id' => 1242,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 621,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5546a1dfbb544b3e85dc712eb73cdb39_39370/preview_video_talk_1.mp4',
            ),
            242 => 
            array (
                'id' => 1243,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 622,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b888f44224124d04b9b880cf26e331b7_45850/preview_talk_1.webp',
            ),
            243 => 
            array (
                'id' => 1244,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 622,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b888f44224124d04b9b880cf26e331b7_45850/preview_video_talk_1.mp4',
            ),
            244 => 
            array (
                'id' => 1245,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 623,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/518bf85d31c54b7e85dd047b3b4dc6ef_42180/preview_talk_1.webp',
            ),
            245 => 
            array (
                'id' => 1246,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 623,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/518bf85d31c54b7e85dd047b3b4dc6ef_42180/preview_video_talk_1.mp4',
            ),
            246 => 
            array (
                'id' => 1247,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 624,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef7e96cf5a7346fab65b205a884be691_42210/preview_target.webp',
            ),
            247 => 
            array (
                'id' => 1248,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 624,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef7e96cf5a7346fab65b205a884be691_42210/preview_video_target.mp4',
            ),
            248 => 
            array (
                'id' => 1249,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 625,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc4f098b8e8843e7a6e7928cb74b47f2_42180/preview_target.webp',
            ),
            249 => 
            array (
                'id' => 1250,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 625,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc4f098b8e8843e7a6e7928cb74b47f2_42180/preview_video_target.mp4',
            ),
            250 => 
            array (
                'id' => 1251,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 626,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d523a647d1a47b799df54c1a82f4608_42190/preview_target.webp',
            ),
            251 => 
            array (
                'id' => 1252,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 626,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d523a647d1a47b799df54c1a82f4608_42190/preview_video_target.mp4',
            ),
            252 => 
            array (
                'id' => 1253,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 627,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/57b649cf7b5d4cbe9dd753270384fc65_44690/preview_talk_2.webp',
            ),
            253 => 
            array (
                'id' => 1254,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 627,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/57b649cf7b5d4cbe9dd753270384fc65_44690/preview_video_talk_2.mp4',
            ),
            254 => 
            array (
                'id' => 1255,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 628,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1665a4594bf547a997119c0452c19047_44320/preview_talk_2.webp',
            ),
            255 => 
            array (
                'id' => 1256,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 628,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1665a4594bf547a997119c0452c19047_44320/preview_video_talk_2.mp4',
            ),
            256 => 
            array (
                'id' => 1257,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 629,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fe43ddff45e480fa0a8df275c0bbcf7_38710/preview_target.webp',
            ),
            257 => 
            array (
                'id' => 1258,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 629,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fe43ddff45e480fa0a8df275c0bbcf7_38710/preview_video_target.mp4',
            ),
            258 => 
            array (
                'id' => 1259,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 630,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77c8e6b6c3174f1c91f9f6b4f3c07c3a_38710/preview_talk_1.webp',
            ),
            259 => 
            array (
                'id' => 1260,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 630,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77c8e6b6c3174f1c91f9f6b4f3c07c3a_38710/preview_video_talk_1.mp4',
            ),
            260 => 
            array (
                'id' => 1261,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 631,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e611e730595d4778a73689a8acd6e000_38720/preview_target.webp',
            ),
            261 => 
            array (
                'id' => 1262,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 631,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e611e730595d4778a73689a8acd6e000_38720/preview_video_target.mp4',
            ),
            262 => 
            array (
                'id' => 1263,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 632,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fd508efa20d446eb923a3cb2d04623de_38720/preview_talk_1.webp',
            ),
            263 => 
            array (
                'id' => 1264,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 632,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fd508efa20d446eb923a3cb2d04623de_38720/preview_video_talk_1.mp4',
            ),
            264 => 
            array (
                'id' => 1265,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 633,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/316476fb812b42cfadd138761e861ca9_38070/preview_talk_1.webp',
            ),
            265 => 
            array (
                'id' => 1266,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 633,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/316476fb812b42cfadd138761e861ca9_38070/preview_video_talk_1.mp4',
            ),
            266 => 
            array (
                'id' => 1267,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 634,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fbdc079af804651aeef77c68b20a70f_38070/preview_target.webp',
            ),
            267 => 
            array (
                'id' => 1268,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 634,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fbdc079af804651aeef77c68b20a70f_38070/preview_video_target.mp4',
            ),
            268 => 
            array (
                'id' => 1269,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 635,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18f0e70f53a94934915107b7af6b09a6_38080/preview_talk_1.webp',
            ),
            269 => 
            array (
                'id' => 1270,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 635,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18f0e70f53a94934915107b7af6b09a6_38080/preview_video_talk_1.mp4',
            ),
            270 => 
            array (
                'id' => 1271,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 636,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6cb7a4d8db774db6a7b9dd974964630c_38080/preview_target.webp',
            ),
            271 => 
            array (
                'id' => 1272,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 636,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6cb7a4d8db774db6a7b9dd974964630c_38080/preview_video_target.mp4',
            ),
            272 => 
            array (
                'id' => 1273,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 637,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c2d94b111f744c9b9c782f6b304bd2aa_38280/preview_talk_1.webp',
            ),
            273 => 
            array (
                'id' => 1274,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 637,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c2d94b111f744c9b9c782f6b304bd2aa_38280/preview_video_talk_1.mp4',
            ),
            274 => 
            array (
                'id' => 1275,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 638,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fefb436423624173b15b894a6040e034_38280/preview_target.webp',
            ),
            275 => 
            array (
                'id' => 1276,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 638,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fefb436423624173b15b894a6040e034_38280/preview_video_target.mp4',
            ),
            276 => 
            array (
                'id' => 1277,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 639,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa9b0cb249c64f8b924e9fd6b576fa3a_38290/preview_talk_1.webp',
            ),
            277 => 
            array (
                'id' => 1278,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 639,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa9b0cb249c64f8b924e9fd6b576fa3a_38290/preview_video_talk_1.mp4',
            ),
            278 => 
            array (
                'id' => 1279,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 640,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/67e1e02efd0047f194cdc30e91fe875a_38290/preview_target.webp',
            ),
            279 => 
            array (
                'id' => 1280,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 640,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/67e1e02efd0047f194cdc30e91fe875a_38290/preview_video_target.mp4',
            ),
            280 => 
            array (
                'id' => 1281,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 641,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1eb7937698e5413dab36e496121dc4b5_38670/preview_talk_1.webp',
            ),
            281 => 
            array (
                'id' => 1282,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 641,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1eb7937698e5413dab36e496121dc4b5_38670/preview_video_talk_1.mp4',
            ),
            282 => 
            array (
                'id' => 1283,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 642,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dff28f22812d44c0be4ec48cf29198f7_38670/preview_target.webp',
            ),
            283 => 
            array (
                'id' => 1284,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 642,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dff28f22812d44c0be4ec48cf29198f7_38670/preview_video_target.mp4',
            ),
            284 => 
            array (
                'id' => 1285,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 643,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/78b24bcbb2394f3595e8279e8f71374e_38680/preview_talk_1.webp',
            ),
            285 => 
            array (
                'id' => 1286,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 643,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/78b24bcbb2394f3595e8279e8f71374e_38680/preview_video_talk_1.mp4',
            ),
            286 => 
            array (
                'id' => 1287,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 644,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b0facc55512a4250904297f3d9fa1441_38680/preview_target.webp',
            ),
            287 => 
            array (
                'id' => 1288,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 644,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b0facc55512a4250904297f3d9fa1441_38680/preview_video_target.mp4',
            ),
            288 => 
            array (
                'id' => 1289,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 645,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/46c6e9fe736d40d4bf8b89baafede4a5_38860/preview_talk_1.webp',
            ),
            289 => 
            array (
                'id' => 1290,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 645,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/46c6e9fe736d40d4bf8b89baafede4a5_38860/preview_video_talk_1.mp4',
            ),
            290 => 
            array (
                'id' => 1291,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 646,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d7e665309c1465ea581e93f978844c5_38850/preview_talk_1.webp',
            ),
            291 => 
            array (
                'id' => 1292,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 646,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d7e665309c1465ea581e93f978844c5_38850/preview_video_talk_1.mp4',
            ),
            292 => 
            array (
                'id' => 1293,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 647,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8d2f5b65d084dea9004a1a1bfc17351_38860/preview_talk_2.webp',
            ),
            293 => 
            array (
                'id' => 1294,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 647,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8d2f5b65d084dea9004a1a1bfc17351_38860/preview_video_talk_2.mp4',
            ),
            294 => 
            array (
                'id' => 1295,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 648,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/477948257ba041709365a229559b7b19_38850/preview_talk_3.webp',
            ),
            295 => 
            array (
                'id' => 1296,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 648,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/477948257ba041709365a229559b7b19_38850/preview_video_talk_3.mp4',
            ),
            296 => 
            array (
                'id' => 1297,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 649,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5944e77da5c44394b95b8b565e64dcf1_38850/preview_target.webp',
            ),
            297 => 
            array (
                'id' => 1298,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 649,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5944e77da5c44394b95b8b565e64dcf1_38850/preview_video_target.mp4',
            ),
            298 => 
            array (
                'id' => 1299,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 650,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/94cf5b24a14f4b898643cf7f0f43fbe4_38860/preview_target.webp',
            ),
            299 => 
            array (
                'id' => 1300,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 650,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/94cf5b24a14f4b898643cf7f0f43fbe4_38860/preview_video_target.mp4',
            ),
            300 => 
            array (
                'id' => 1301,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 651,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77ac231a83d04523839b014d7413aba7_38850/preview_talk_2.webp',
            ),
            301 => 
            array (
                'id' => 1302,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 651,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/77ac231a83d04523839b014d7413aba7_38850/preview_video_talk_2.mp4',
            ),
            302 => 
            array (
                'id' => 1303,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 652,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0dcdbd20783f4a2a9333bfbd7cce304e_38930/preview_talk_1.webp',
            ),
            303 => 
            array (
                'id' => 1304,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 652,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0dcdbd20783f4a2a9333bfbd7cce304e_38930/preview_video_talk_1.mp4',
            ),
            304 => 
            array (
                'id' => 1305,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 653,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cb9f9458f2d493398468ba81fbcd9f9_38920/preview_target.webp',
            ),
            305 => 
            array (
                'id' => 1306,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 653,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cb9f9458f2d493398468ba81fbcd9f9_38920/preview_video_target.mp4',
            ),
            306 => 
            array (
                'id' => 1307,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 654,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b48addfc8c6454eab8beb14c004e3eb_38930/preview_target.webp',
            ),
            307 => 
            array (
                'id' => 1308,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 654,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2b48addfc8c6454eab8beb14c004e3eb_38930/preview_video_target.mp4',
            ),
            308 => 
            array (
                'id' => 1309,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 655,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d683e10d637a42ec9825b0cc794094da_38920/preview_talk_1.webp',
            ),
            309 => 
            array (
                'id' => 1310,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 655,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d683e10d637a42ec9825b0cc794094da_38920/preview_video_talk_1.mp4',
            ),
            310 => 
            array (
                'id' => 1311,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 656,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/37adfc229dae4acc929ba755bf88a665_38130/preview_talk_1.webp',
            ),
            311 => 
            array (
                'id' => 1312,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 656,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/37adfc229dae4acc929ba755bf88a665_38130/preview_video_talk_1.mp4',
            ),
            312 => 
            array (
                'id' => 1313,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 657,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad3bfd21175b46cf88b63c016e7aeac0_38130/preview_target.webp',
            ),
            313 => 
            array (
                'id' => 1314,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 657,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad3bfd21175b46cf88b63c016e7aeac0_38130/preview_video_target.mp4',
            ),
            314 => 
            array (
                'id' => 1315,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 658,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f93fcde33f954ace8c45b72b22df5958_38140/preview_target.webp',
            ),
            315 => 
            array (
                'id' => 1316,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 658,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f93fcde33f954ace8c45b72b22df5958_38140/preview_video_target.mp4',
            ),
            316 => 
            array (
                'id' => 1317,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 659,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8c3c8ad7c78341c2b0de01b33100a235_38140/preview_talk_1.webp',
            ),
            317 => 
            array (
                'id' => 1318,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 659,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8c3c8ad7c78341c2b0de01b33100a235_38140/preview_video_talk_1.mp4',
            ),
            318 => 
            array (
                'id' => 1319,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 660,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9e6f4d1c42a04599b6a743f2c89920b0_37970/preview_target.webp',
            ),
            319 => 
            array (
                'id' => 1320,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 660,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9e6f4d1c42a04599b6a743f2c89920b0_37970/preview_video_target.mp4',
            ),
            320 => 
            array (
                'id' => 1321,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 661,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4113768e26354c7199130d8219517c2c_37970/preview_talk_1.webp',
            ),
            321 => 
            array (
                'id' => 1322,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 661,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4113768e26354c7199130d8219517c2c_37970/preview_video_talk_1.mp4',
            ),
            322 => 
            array (
                'id' => 1323,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 662,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8c33ea45f2a493f9be9b18ba4d252ac_37990/preview_target.webp',
            ),
            323 => 
            array (
                'id' => 1324,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 662,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c8c33ea45f2a493f9be9b18ba4d252ac_37990/preview_video_target.mp4',
            ),
            324 => 
            array (
                'id' => 1325,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 663,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/033c2fa38a7142c1bc369dc81d8d9829_37980/preview_target.webp',
            ),
            325 => 
            array (
                'id' => 1326,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 663,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/033c2fa38a7142c1bc369dc81d8d9829_37980/preview_video_target.mp4',
            ),
            326 => 
            array (
                'id' => 1327,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 664,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7549c7fd53b949ba80a569a93b9077b0_44260/preview_talk_2.webp',
            ),
            327 => 
            array (
                'id' => 1328,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 664,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7549c7fd53b949ba80a569a93b9077b0_44260/preview_video_talk_2.mp4',
            ),
            328 => 
            array (
                'id' => 1329,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 665,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f27279aef6934f7684abc2f73dd38bfd_38820/preview_talk_1.webp',
            ),
            329 => 
            array (
                'id' => 1330,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 665,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f27279aef6934f7684abc2f73dd38bfd_38820/preview_video_talk_1.mp4',
            ),
            330 => 
            array (
                'id' => 1331,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 666,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47632ccb9f494df6b03fe8ba0e6d3022_38820/preview_target.webp',
            ),
            331 => 
            array (
                'id' => 1332,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 666,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47632ccb9f494df6b03fe8ba0e6d3022_38820/preview_video_target.mp4',
            ),
            332 => 
            array (
                'id' => 1333,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 667,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/41c3092e0e7d463d9580585df9922a43_38980/preview_talk_4.webp',
            ),
            333 => 
            array (
                'id' => 1334,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 667,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/41c3092e0e7d463d9580585df9922a43_38980/preview_video_talk_4.mp4',
            ),
            334 => 
            array (
                'id' => 1335,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 668,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d9f3aac2fdde4c77864c7efa48705198_38980/preview_talk_3.webp',
            ),
            335 => 
            array (
                'id' => 1336,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 668,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d9f3aac2fdde4c77864c7efa48705198_38980/preview_video_talk_3.mp4',
            ),
            336 => 
            array (
                'id' => 1337,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 669,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5aec38e5d9e64bf78ec67c2c9c6f6990_38810/preview_talk_2.webp',
            ),
            337 => 
            array (
                'id' => 1338,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 669,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5aec38e5d9e64bf78ec67c2c9c6f6990_38810/preview_video_talk_2.mp4',
            ),
            338 => 
            array (
                'id' => 1339,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 670,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee1bd0cf3a48471eba4e889982e24810_38810/preview_talk_3.webp',
            ),
            339 => 
            array (
                'id' => 1340,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 670,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee1bd0cf3a48471eba4e889982e24810_38810/preview_video_talk_3.mp4',
            ),
            340 => 
            array (
                'id' => 1341,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 671,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/74544a929b514efe9df9d6a03557fe8f_38980/preview_talk_2.webp',
            ),
            341 => 
            array (
                'id' => 1342,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 671,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/74544a929b514efe9df9d6a03557fe8f_38980/preview_video_talk_2.mp4',
            ),
            342 => 
            array (
                'id' => 1343,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 672,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fe6ec3d1189140c19ec36546b57b90c3_38980/preview_talk_1.webp',
            ),
            343 => 
            array (
                'id' => 1344,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 672,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fe6ec3d1189140c19ec36546b57b90c3_38980/preview_video_talk_1.mp4',
            ),
            344 => 
            array (
                'id' => 1345,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 673,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fcdc331a145547ca9db17fefb9e5779f_38810/preview_talk_1.webp',
            ),
            345 => 
            array (
                'id' => 1346,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 673,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fcdc331a145547ca9db17fefb9e5779f_38810/preview_video_talk_1.mp4',
            ),
            346 => 
            array (
                'id' => 1347,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 674,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/94b1cfff270846c686235e47d763d11c_38990/preview_target.webp',
            ),
            347 => 
            array (
                'id' => 1348,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 674,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/94b1cfff270846c686235e47d763d11c_38990/preview_video_target.mp4',
            ),
            348 => 
            array (
                'id' => 1349,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 675,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5b7ccb338dc4477d89db916950207884_38810/preview_target.webp',
            ),
            349 => 
            array (
                'id' => 1350,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 675,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5b7ccb338dc4477d89db916950207884_38810/preview_video_target.mp4',
            ),
            350 => 
            array (
                'id' => 1351,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 676,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d3f9f70da51449299e5801114d67f73_38990/preview_talk_1.webp',
            ),
            351 => 
            array (
                'id' => 1352,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 676,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d3f9f70da51449299e5801114d67f73_38990/preview_video_talk_1.mp4',
            ),
            352 => 
            array (
                'id' => 1353,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 677,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5fc7aa3a15e9462d9380987074814805_38960/preview_target.webp',
            ),
            353 => 
            array (
                'id' => 1354,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 677,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5fc7aa3a15e9462d9380987074814805_38960/preview_video_target.mp4',
            ),
            354 => 
            array (
                'id' => 1355,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 678,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a47ab167ad2c41b293a05610bbfa84b0_38810/preview_talk_4.webp',
            ),
            355 => 
            array (
                'id' => 1356,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 678,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a47ab167ad2c41b293a05610bbfa84b0_38810/preview_video_talk_4.mp4',
            ),
            356 => 
            array (
                'id' => 1357,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 679,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/982fa2306a4f46059c40053b1971fc4f_38980/preview_talk_5.webp',
            ),
            357 => 
            array (
                'id' => 1358,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 679,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/982fa2306a4f46059c40053b1971fc4f_38980/preview_video_talk_5.mp4',
            ),
            358 => 
            array (
                'id' => 1359,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 680,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d2971b6d6ff49718afb6f7277b8be29_38800/preview_talk_2.webp',
            ),
            359 => 
            array (
                'id' => 1360,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 680,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d2971b6d6ff49718afb6f7277b8be29_38800/preview_video_talk_2.mp4',
            ),
            360 => 
            array (
                'id' => 1361,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 681,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/31f4e77edac645c4b0526925f4aa6fde_38800/preview_talk_1.webp',
            ),
            361 => 
            array (
                'id' => 1362,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 681,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/31f4e77edac645c4b0526925f4aa6fde_38800/preview_video_talk_1.mp4',
            ),
            362 => 
            array (
                'id' => 1363,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 682,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6a5635f104264794b3f3e27f21f444cb_38980/preview_talk_6.webp',
            ),
            363 => 
            array (
                'id' => 1364,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 682,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6a5635f104264794b3f3e27f21f444cb_38980/preview_video_talk_6.mp4',
            ),
            364 => 
            array (
                'id' => 1365,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 683,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dc0fb90040c84a7ba05f782553edfe38_38980/preview_target.webp',
            ),
            365 => 
            array (
                'id' => 1366,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 683,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dc0fb90040c84a7ba05f782553edfe38_38980/preview_video_target.mp4',
            ),
            366 => 
            array (
                'id' => 1367,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 684,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3248bab4279f45738c1397c06978e1d4_54470/preview_target.webp',
            ),
            367 => 
            array (
                'id' => 1368,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 684,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3248bab4279f45738c1397c06978e1d4_54470/preview_video_target.mp4',
            ),
            368 => 
            array (
                'id' => 1369,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 685,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b66c9f3dabf74b03832ebe2dfadd935f_44330/preview_talk_1.webp',
            ),
            369 => 
            array (
                'id' => 1370,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 685,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b66c9f3dabf74b03832ebe2dfadd935f_44330/preview_video_talk_1.mp4',
            ),
            370 => 
            array (
                'id' => 1371,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 686,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/65d19cdc69434a4797599255a6fdcba9_37790/preview_target.webp',
            ),
            371 => 
            array (
                'id' => 1372,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 686,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/65d19cdc69434a4797599255a6fdcba9_37790/preview_video_target.mp4',
            ),
            372 => 
            array (
                'id' => 1373,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 687,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/11e57f2100ae4fc4b97cb99e7d23ad6a_37790/preview_talk_6.webp',
            ),
            373 => 
            array (
                'id' => 1374,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 687,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/11e57f2100ae4fc4b97cb99e7d23ad6a_37790/preview_video_talk_6.mp4',
            ),
            374 => 
            array (
                'id' => 1375,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 688,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a319de11cfdb4fa0808be9088fd78261_37510/preview_talk_1.webp',
            ),
            375 => 
            array (
                'id' => 1376,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 688,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a319de11cfdb4fa0808be9088fd78261_37510/preview_video_talk_1.mp4',
            ),
            376 => 
            array (
                'id' => 1377,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 689,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db2ef7f814fa4e778d1c6ed1d11e5064_37510/preview_talk_3.webp',
            ),
            377 => 
            array (
                'id' => 1378,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 689,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db2ef7f814fa4e778d1c6ed1d11e5064_37510/preview_video_talk_3.mp4',
            ),
            378 => 
            array (
                'id' => 1379,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 690,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21d6f432bc3a44baa5fb2612d1f4e600_37570/preview_talk_1.webp',
            ),
            379 => 
            array (
                'id' => 1380,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 690,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21d6f432bc3a44baa5fb2612d1f4e600_37570/preview_video_talk_1.mp4',
            ),
            380 => 
            array (
                'id' => 1381,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 691,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e325408d81694f46aaa220267e969dca_37830/preview_talk_1.webp',
            ),
            381 => 
            array (
                'id' => 1382,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 691,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e325408d81694f46aaa220267e969dca_37830/preview_video_talk_1.mp4',
            ),
            382 => 
            array (
                'id' => 1383,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 692,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3b007fa40a5427fbc92a1f1c3b18ca6_37820/preview_talk_2.webp',
            ),
            383 => 
            array (
                'id' => 1384,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 692,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3b007fa40a5427fbc92a1f1c3b18ca6_37820/preview_video_talk_2.mp4',
            ),
            384 => 
            array (
                'id' => 1385,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 693,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18baef94e29f4f5b8d61e306437e50bf_37820/preview_talk_3.webp',
            ),
            385 => 
            array (
                'id' => 1386,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 693,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18baef94e29f4f5b8d61e306437e50bf_37820/preview_video_talk_3.mp4',
            ),
            386 => 
            array (
                'id' => 1387,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 694,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f577d604d660437597cafa97471a86ae_37520/preview_talk_2.webp',
            ),
            387 => 
            array (
                'id' => 1388,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 694,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f577d604d660437597cafa97471a86ae_37520/preview_video_talk_2.mp4',
            ),
            388 => 
            array (
                'id' => 1389,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 695,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4303bd96d1974a56aa3a118258cddcd9_37520/preview_talk_3.webp',
            ),
            389 => 
            array (
                'id' => 1390,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 695,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4303bd96d1974a56aa3a118258cddcd9_37520/preview_video_talk_3.mp4',
            ),
            390 => 
            array (
                'id' => 1391,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 696,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7687a6937865431d8ecfb5703adc72f9_44300/preview_talk_1.webp',
            ),
            391 => 
            array (
                'id' => 1392,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 696,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7687a6937865431d8ecfb5703adc72f9_44300/preview_video_talk_1.mp4',
            ),
            392 => 
            array (
                'id' => 1393,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 697,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f01b66bbb9f541bc9eb296e04513584e_39170/preview_talk_1.webp',
            ),
            393 => 
            array (
                'id' => 1394,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 697,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f01b66bbb9f541bc9eb296e04513584e_39170/preview_video_talk_1.mp4',
            ),
            394 => 
            array (
                'id' => 1395,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 698,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/550f41aaa75f42829a4f2839617e111d_39180/preview_talk_1.webp',
            ),
            395 => 
            array (
                'id' => 1396,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 698,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/550f41aaa75f42829a4f2839617e111d_39180/preview_video_talk_1.mp4',
            ),
            396 => 
            array (
                'id' => 1397,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 699,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f850e87f38bf4643ac17dadd574dc557_39170/preview_target.webp',
            ),
            397 => 
            array (
                'id' => 1398,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 699,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f850e87f38bf4643ac17dadd574dc557_39170/preview_video_target.mp4',
            ),
            398 => 
            array (
                'id' => 1399,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 700,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d4bd025395643e59136ecbade0f8089_39180/preview_target.webp',
            ),
            399 => 
            array (
                'id' => 1400,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 700,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8d4bd025395643e59136ecbade0f8089_39180/preview_video_target.mp4',
            ),
            400 => 
            array (
                'id' => 1401,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 701,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5922b17fcffa4a038ba098501f8e085e_38420/preview_target.webp',
            ),
            401 => 
            array (
                'id' => 1402,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 701,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5922b17fcffa4a038ba098501f8e085e_38420/preview_video_target.mp4',
            ),
            402 => 
            array (
                'id' => 1403,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 702,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/439cc8dd23d045b786c7b7a941890e78_38430/preview_target.webp',
            ),
            403 => 
            array (
                'id' => 1404,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 702,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/439cc8dd23d045b786c7b7a941890e78_38430/preview_video_target.mp4',
            ),
            404 => 
            array (
                'id' => 1405,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 703,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09ffd4a3fba04940a5ee89df873d1eed_37120/preview_talk_3.webp',
            ),
            405 => 
            array (
                'id' => 1406,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 703,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/09ffd4a3fba04940a5ee89df873d1eed_37120/preview_video_talk_3.mp4',
            ),
            406 => 
            array (
                'id' => 1407,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 704,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/884f8cb7bf7f4be295519756d601e1c9_37120/preview_target.webp',
            ),
            407 => 
            array (
                'id' => 1408,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 704,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/884f8cb7bf7f4be295519756d601e1c9_37120/preview_video_target.mp4',
            ),
            408 => 
            array (
                'id' => 1409,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 705,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1c283b1805e04780bfb5ebd8493fd848_37190/preview_target.webp',
            ),
            409 => 
            array (
                'id' => 1410,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 705,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1c283b1805e04780bfb5ebd8493fd848_37190/preview_video_target.mp4',
            ),
            410 => 
            array (
                'id' => 1411,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 706,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b8e909ae9aaf4268959bbd03bab832ee_37200/preview_target.webp',
            ),
            411 => 
            array (
                'id' => 1412,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 706,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b8e909ae9aaf4268959bbd03bab832ee_37200/preview_video_target.mp4',
            ),
            412 => 
            array (
                'id' => 1413,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 707,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/54958fee867744dba6a1f8d32136c0bc_47020/preview_target.webp',
            ),
            413 => 
            array (
                'id' => 1414,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 707,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/54958fee867744dba6a1f8d32136c0bc_47020/preview_video_target.mp4',
            ),
            414 => 
            array (
                'id' => 1415,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 708,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18b537e455684ecebccf13c1b7cfe419_47050/preview_target.webp',
            ),
            415 => 
            array (
                'id' => 1416,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 708,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18b537e455684ecebccf13c1b7cfe419_47050/preview_video_target.mp4',
            ),
            416 => 
            array (
                'id' => 1417,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 709,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c1f72d2c3b2c4c299c294c4ba7d19597_47030/preview_target.webp',
            ),
            417 => 
            array (
                'id' => 1418,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 709,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c1f72d2c3b2c4c299c294c4ba7d19597_47030/preview_video_target.mp4',
            ),
            418 => 
            array (
                'id' => 1419,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 710,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/adcdaee1522347f79a6032cdf10d0340_47040/preview_target.webp',
            ),
            419 => 
            array (
                'id' => 1420,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 710,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/adcdaee1522347f79a6032cdf10d0340_47040/preview_video_target.mp4',
            ),
            420 => 
            array (
                'id' => 1421,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 711,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4468ba9a9b1744bd9948c8d28436db14_47010/preview_target.webp',
            ),
            421 => 
            array (
                'id' => 1422,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 711,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4468ba9a9b1744bd9948c8d28436db14_47010/preview_video_target.mp4',
            ),
            422 => 
            array (
                'id' => 1423,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 712,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b4e464bf15f4194b082be0e631354c6_46860/preview_target.webp',
            ),
            423 => 
            array (
                'id' => 1424,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 712,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b4e464bf15f4194b082be0e631354c6_46860/preview_video_target.mp4',
            ),
            424 => 
            array (
                'id' => 1425,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 713,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/665d8eb0fe2640e9b5485f48077c0036_46870/preview_target.webp',
            ),
            425 => 
            array (
                'id' => 1426,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 713,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/665d8eb0fe2640e9b5485f48077c0036_46870/preview_video_target.mp4',
            ),
            426 => 
            array (
                'id' => 1427,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 714,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3d5904b6fef640eebda2a4deea943492_39070/preview_talk_1.webp',
            ),
            427 => 
            array (
                'id' => 1428,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 714,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3d5904b6fef640eebda2a4deea943492_39070/preview_video_talk_1.mp4',
            ),
            428 => 
            array (
                'id' => 1429,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 715,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5920bf0d18a42148c6e40496df82108_39070/preview_target.webp',
            ),
            429 => 
            array (
                'id' => 1430,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 715,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5920bf0d18a42148c6e40496df82108_39070/preview_video_target.mp4',
            ),
            430 => 
            array (
                'id' => 1431,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 716,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b76dafe61b948c9a73d10759142bd97_39080/preview_target.webp',
            ),
            431 => 
            array (
                'id' => 1432,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 716,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b76dafe61b948c9a73d10759142bd97_39080/preview_video_target.mp4',
            ),
            432 => 
            array (
                'id' => 1433,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 717,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7bc0d0bec9a9491cb38db1329b2563f9_39080/preview_talk_1.webp',
            ),
            433 => 
            array (
                'id' => 1434,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 717,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7bc0d0bec9a9491cb38db1329b2563f9_39080/preview_video_talk_1.mp4',
            ),
            434 => 
            array (
                'id' => 1435,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 718,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47ce0a4dcbf34c99a9073b03dd88c2d8_39070/preview_talk_3.webp',
            ),
            435 => 
            array (
                'id' => 1436,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 718,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47ce0a4dcbf34c99a9073b03dd88c2d8_39070/preview_video_talk_3.mp4',
            ),
            436 => 
            array (
                'id' => 1437,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 719,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/420ccd165b5644fa89f292d695b6900a_39090/preview_talk_4.webp',
            ),
            437 => 
            array (
                'id' => 1438,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 719,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/420ccd165b5644fa89f292d695b6900a_39090/preview_video_talk_4.mp4',
            ),
            438 => 
            array (
                'id' => 1439,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 720,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/761c137b109e49a69991344904e2bf0a_39070/preview_talk_4.webp',
            ),
            439 => 
            array (
                'id' => 1440,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 720,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/761c137b109e49a69991344904e2bf0a_39070/preview_video_talk_4.mp4',
            ),
            440 => 
            array (
                'id' => 1441,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 721,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/78632df837f24ef6ba86972276699267_39090/preview_talk_1.webp',
            ),
            441 => 
            array (
                'id' => 1442,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 721,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/78632df837f24ef6ba86972276699267_39090/preview_video_talk_1.mp4',
            ),
            442 => 
            array (
                'id' => 1443,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 722,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/946f804908de47fda0b9bb71fc266e9e_39070/preview_talk_7.webp',
            ),
            443 => 
            array (
                'id' => 1444,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 722,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/946f804908de47fda0b9bb71fc266e9e_39070/preview_video_talk_7.mp4',
            ),
            444 => 
            array (
                'id' => 1445,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 723,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d06d641f0294a16a1781459ef9fdc16_39090/preview_talk_3.webp',
            ),
            445 => 
            array (
                'id' => 1446,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 723,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d06d641f0294a16a1781459ef9fdc16_39090/preview_video_talk_3.mp4',
            ),
            446 => 
            array (
                'id' => 1447,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 724,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6a279d11751c485ca95bff6c884f8dc0_46610/preview_target.webp',
            ),
            447 => 
            array (
                'id' => 1448,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 724,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6a279d11751c485ca95bff6c884f8dc0_46610/preview_video_target.mp4',
            ),
            448 => 
            array (
                'id' => 1449,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 725,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f4fb5445e3c4d4591823c636c8df6dc_46600/preview_target.webp',
            ),
            449 => 
            array (
                'id' => 1450,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 725,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f4fb5445e3c4d4591823c636c8df6dc_46600/preview_video_target.mp4',
            ),
            450 => 
            array (
                'id' => 1451,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 726,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a4ccf276f977430db7614b5f545e4459_46590/preview_target.webp',
            ),
            451 => 
            array (
                'id' => 1452,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 726,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a4ccf276f977430db7614b5f545e4459_46590/preview_video_target.mp4',
            ),
            452 => 
            array (
                'id' => 1453,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 727,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ac74f908f355476ca3b4f1126d7c78e8_46580/preview_target.webp',
            ),
            453 => 
            array (
                'id' => 1454,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 727,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ac74f908f355476ca3b4f1126d7c78e8_46580/preview_video_target.mp4',
            ),
            454 => 
            array (
                'id' => 1455,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 728,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db2fb7fd0d044b908395a011166ab22d_45680/preview_target.webp',
            ),
            455 => 
            array (
                'id' => 1456,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 728,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db2fb7fd0d044b908395a011166ab22d_45680/preview_video_target.mp4',
            ),
            456 => 
            array (
                'id' => 1457,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 729,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/14995aaea1924915871517cb158b47e6_44790/preview_talk_2.webp',
            ),
            457 => 
            array (
                'id' => 1458,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 729,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/14995aaea1924915871517cb158b47e6_44790/preview_video_talk_2.mp4',
            ),
            458 => 
            array (
                'id' => 1459,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 730,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1ed8c71e4bf4e6cb9071d2b7cd71e4e_45660/preview_talk_1.webp',
            ),
            459 => 
            array (
                'id' => 1460,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 730,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a1ed8c71e4bf4e6cb9071d2b7cd71e4e_45660/preview_video_talk_1.mp4',
            ),
            460 => 
            array (
                'id' => 1461,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 731,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/582ee8fe072a48fda3bc68241aeff660_45660/preview_target.webp',
            ),
            461 => 
            array (
                'id' => 1462,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 731,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/582ee8fe072a48fda3bc68241aeff660_45660/preview_video_target.mp4',
            ),
            462 => 
            array (
                'id' => 1463,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 732,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/896caa087e3d49ffa2e6d005976afa92_38940/preview_talk_3.webp',
            ),
            463 => 
            array (
                'id' => 1464,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 732,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/896caa087e3d49ffa2e6d005976afa92_38940/preview_video_talk_3.mp4',
            ),
            464 => 
            array (
                'id' => 1465,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 733,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4dac6a63f16e46aaaf9b11612708986b_38940/preview_talk_1.webp',
            ),
            465 => 
            array (
                'id' => 1466,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 733,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4dac6a63f16e46aaaf9b11612708986b_38940/preview_video_talk_1.mp4',
            ),
            466 => 
            array (
                'id' => 1467,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 734,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a5cee5be23464220b6b14eb62ed0dedd_38940/preview_talk_2.webp',
            ),
            467 => 
            array (
                'id' => 1468,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 734,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a5cee5be23464220b6b14eb62ed0dedd_38940/preview_video_talk_2.mp4',
            ),
            468 => 
            array (
                'id' => 1469,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 735,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a08231ecda954006845dc00c7db296bb_38940/preview_target.webp',
            ),
            469 => 
            array (
                'id' => 1470,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 735,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a08231ecda954006845dc00c7db296bb_38940/preview_video_target.mp4',
            ),
            470 => 
            array (
                'id' => 1471,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 736,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bf0bd8403ab441a0afc403d99e751132_52220/preview_target.webp',
            ),
            471 => 
            array (
                'id' => 1472,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 736,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bf0bd8403ab441a0afc403d99e751132_52220/preview_video_target.mp4',
            ),
            472 => 
            array (
                'id' => 1473,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 737,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c4b72e953f62494aa1fc3be88d038dcb_35290/preview_talk_2.webp',
            ),
            473 => 
            array (
                'id' => 1474,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 737,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c4b72e953f62494aa1fc3be88d038dcb_35290/preview_video_talk_2.mp4',
            ),
            474 => 
            array (
                'id' => 1475,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 738,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/364291e5f11348b683da5b4ae98dae88_35300/preview_talk_2.webp',
            ),
            475 => 
            array (
                'id' => 1476,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 738,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/364291e5f11348b683da5b4ae98dae88_35300/preview_video_talk_2.mp4',
            ),
            476 => 
            array (
                'id' => 1477,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 739,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d2aa5c663b5e400188ab759aa3b8ce6f_35310/preview_talk_2.webp',
            ),
            477 => 
            array (
                'id' => 1478,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 739,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d2aa5c663b5e400188ab759aa3b8ce6f_35310/preview_video_talk_2.mp4',
            ),
            478 => 
            array (
                'id' => 1479,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 740,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f915c62f58a485fb313813f4c98b231_35290/preview_talk_1.webp',
            ),
            479 => 
            array (
                'id' => 1480,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 740,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f915c62f58a485fb313813f4c98b231_35290/preview_video_talk_1.mp4',
            ),
            480 => 
            array (
                'id' => 1481,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 741,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cd14264de05b4e7bace6b6752501d4e1_35300/preview_talk_1.webp',
            ),
            481 => 
            array (
                'id' => 1482,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 741,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cd14264de05b4e7bace6b6752501d4e1_35300/preview_video_talk_1.mp4',
            ),
            482 => 
            array (
                'id' => 1483,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 742,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc6713b765664f5b91dde30bc3f9e11e_35310/preview_talk_1.webp',
            ),
            483 => 
            array (
                'id' => 1484,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 742,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc6713b765664f5b91dde30bc3f9e11e_35310/preview_video_talk_1.mp4',
            ),
            484 => 
            array (
                'id' => 1485,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 743,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/716f272a484f48c3a8af6a3f627a5aae_35290/preview_target.webp',
            ),
            485 => 
            array (
                'id' => 1486,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 743,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/716f272a484f48c3a8af6a3f627a5aae_35290/preview_video_target.mp4',
            ),
            486 => 
            array (
                'id' => 1487,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 744,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01a321fa3f7245c1b8cfbf60f253bb47_35300/preview_target.webp',
            ),
            487 => 
            array (
                'id' => 1488,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 744,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01a321fa3f7245c1b8cfbf60f253bb47_35300/preview_video_target.mp4',
            ),
            488 => 
            array (
                'id' => 1489,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 745,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d44ebc774f04c27b6447913d69a2fb8_35310/preview_target.webp',
            ),
            489 => 
            array (
                'id' => 1490,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 745,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d44ebc774f04c27b6447913d69a2fb8_35310/preview_video_target.mp4',
            ),
            490 => 
            array (
                'id' => 1491,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 746,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e241718935e14f9f8c3f13077c29f01c_44340/preview_target.webp',
            ),
            491 => 
            array (
                'id' => 1492,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 746,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e241718935e14f9f8c3f13077c29f01c_44340/preview_video_target.mp4',
            ),
            492 => 
            array (
                'id' => 1493,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 747,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c8a6b980667470da7417a65578438b6_38030/preview_talk_1.webp',
            ),
            493 => 
            array (
                'id' => 1494,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 747,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c8a6b980667470da7417a65578438b6_38030/preview_video_talk_1.mp4',
            ),
            494 => 
            array (
                'id' => 1495,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 748,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35eb79d55dae43c682a1226352b64553_38030/preview_target.webp',
            ),
            495 => 
            array (
                'id' => 1496,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 748,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35eb79d55dae43c682a1226352b64553_38030/preview_video_target.mp4',
            ),
            496 => 
            array (
                'id' => 1497,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 749,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/02767eb6d66748c3a7757eb5b56d13f1_38040/preview_talk_1.webp',
            ),
            497 => 
            array (
                'id' => 1498,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 749,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/02767eb6d66748c3a7757eb5b56d13f1_38040/preview_video_talk_1.mp4',
            ),
            498 => 
            array (
                'id' => 1499,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 750,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4c4e5ab65e7d40ebb34554dfc027243f_38040/preview_target.webp',
            ),
            499 => 
            array (
                'id' => 1500,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 750,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4c4e5ab65e7d40ebb34554dfc027243f_38040/preview_video_target.mp4',
            ),
        ));
        \DB::table('avatar_metas')->insert(array (
            0 => 
            array (
                'id' => 1501,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 751,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8010656f2fcb4da7bcd5ace4e71afa5e_38240/preview_talk_1.webp',
            ),
            1 => 
            array (
                'id' => 1502,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 751,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8010656f2fcb4da7bcd5ace4e71afa5e_38240/preview_video_talk_1.mp4',
            ),
            2 => 
            array (
                'id' => 1503,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 752,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a5007e956bf44558b1f1a031735c2f20_38240/preview_target.webp',
            ),
            3 => 
            array (
                'id' => 1504,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 752,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a5007e956bf44558b1f1a031735c2f20_38240/preview_video_target.mp4',
            ),
            4 => 
            array (
                'id' => 1505,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 753,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/df8241390c6f40dca46d0da4a01e34e8_38250/preview_talk_1.webp',
            ),
            5 => 
            array (
                'id' => 1506,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 753,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/df8241390c6f40dca46d0da4a01e34e8_38250/preview_video_talk_1.mp4',
            ),
            6 => 
            array (
                'id' => 1507,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 754,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae25f1a2d9e14280a3a024b155578beb_38250/preview_target.webp',
            ),
            7 => 
            array (
                'id' => 1508,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 754,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae25f1a2d9e14280a3a024b155578beb_38250/preview_video_target.mp4',
            ),
            8 => 
            array (
                'id' => 1509,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 755,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/644dcda7d0974a3a8aa96a5f5bc56811_44680/preview_talk_1.webp',
            ),
            9 => 
            array (
                'id' => 1510,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 755,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/644dcda7d0974a3a8aa96a5f5bc56811_44680/preview_video_talk_1.mp4',
            ),
            10 => 
            array (
                'id' => 1511,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 756,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2e3b88f48fe43a0a7f303f8ad6b08c2_39150/preview_talk_1.webp',
            ),
            11 => 
            array (
                'id' => 1512,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 756,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2e3b88f48fe43a0a7f303f8ad6b08c2_39150/preview_video_talk_1.mp4',
            ),
            12 => 
            array (
                'id' => 1513,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 757,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d5433eb527d421e9238e11acafed426_39160/preview_talk_1.webp',
            ),
            13 => 
            array (
                'id' => 1514,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 757,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1d5433eb527d421e9238e11acafed426_39160/preview_video_talk_1.mp4',
            ),
            14 => 
            array (
                'id' => 1515,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 758,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8208663e1ab7412faa52ed38b4504442_39150/preview_target.webp',
            ),
            15 => 
            array (
                'id' => 1516,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 758,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8208663e1ab7412faa52ed38b4504442_39150/preview_video_target.mp4',
            ),
            16 => 
            array (
                'id' => 1517,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 759,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b49044f317c14044a149fc9e56ef286b_39160/preview_target.webp',
            ),
            17 => 
            array (
                'id' => 1518,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 759,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b49044f317c14044a149fc9e56ef286b_39160/preview_video_target.mp4',
            ),
            18 => 
            array (
                'id' => 1519,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 760,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/889019dbee2c4eed983f9ef5675c02fd_42270/preview_talk_1.webp',
            ),
            19 => 
            array (
                'id' => 1520,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 760,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/889019dbee2c4eed983f9ef5675c02fd_42270/preview_video_talk_1.mp4',
            ),
            20 => 
            array (
                'id' => 1521,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 761,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80a004ab8be24abfa2d84ba40b50f3b7_42280/preview_talk_2.webp',
            ),
            21 => 
            array (
                'id' => 1522,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 761,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/80a004ab8be24abfa2d84ba40b50f3b7_42280/preview_video_talk_2.mp4',
            ),
            22 => 
            array (
                'id' => 1523,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 762,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee998336b07d4564aee85884dc0b402f_37160/preview_talk_3.webp',
            ),
            23 => 
            array (
                'id' => 1524,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 762,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ee998336b07d4564aee85884dc0b402f_37160/preview_video_talk_3.mp4',
            ),
            24 => 
            array (
                'id' => 1525,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 763,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3baac19e399e4ac9b57881a74e6eae33_37270/preview_target.webp',
            ),
            25 => 
            array (
                'id' => 1526,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 763,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3baac19e399e4ac9b57881a74e6eae33_37270/preview_video_target.mp4',
            ),
            26 => 
            array (
                'id' => 1527,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 764,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/be4edc2cba0c4723ac6145dfa2f7e37c_37160/preview_talk_1.webp',
            ),
            27 => 
            array (
                'id' => 1528,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 764,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/be4edc2cba0c4723ac6145dfa2f7e37c_37160/preview_video_talk_1.mp4',
            ),
            28 => 
            array (
                'id' => 1529,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 765,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/108aa323e16249659cf2eff1f858c02e_37280/preview_target.webp',
            ),
            29 => 
            array (
                'id' => 1530,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 765,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/108aa323e16249659cf2eff1f858c02e_37280/preview_video_target.mp4',
            ),
            30 => 
            array (
                'id' => 1531,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 766,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/de79ab31586142f993dced04e5a29e7b_37680/preview_talk_2.webp',
            ),
            31 => 
            array (
                'id' => 1532,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 766,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/de79ab31586142f993dced04e5a29e7b_37680/preview_video_talk_2.mp4',
            ),
            32 => 
            array (
                'id' => 1533,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 767,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9735e871f87648598d735dfda878775a_37680/preview_target.webp',
            ),
            33 => 
            array (
                'id' => 1534,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 767,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9735e871f87648598d735dfda878775a_37680/preview_video_target.mp4',
            ),
            34 => 
            array (
                'id' => 1535,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 768,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8607947e70594881815ae096e3eb1fbc_37690/preview_target.webp',
            ),
            35 => 
            array (
                'id' => 1536,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 768,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8607947e70594881815ae096e3eb1fbc_37690/preview_video_target.mp4',
            ),
            36 => 
            array (
                'id' => 1537,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 769,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ce29e50eeead44718c872976b4adcc5b_37700/preview_target.webp',
            ),
            37 => 
            array (
                'id' => 1538,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 769,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ce29e50eeead44718c872976b4adcc5b_37700/preview_video_target.mp4',
            ),
            38 => 
            array (
                'id' => 1539,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 770,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/392967d6c52642a4968a8dd82572bd6c_37130/preview_target.webp',
            ),
            39 => 
            array (
                'id' => 1540,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 770,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/392967d6c52642a4968a8dd82572bd6c_37130/preview_video_target.mp4',
            ),
            40 => 
            array (
                'id' => 1541,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 771,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0e741b23ce7441d99182b802752ee20_37210/preview_target.webp',
            ),
            41 => 
            array (
                'id' => 1542,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 771,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0e741b23ce7441d99182b802752ee20_37210/preview_video_target.mp4',
            ),
            42 => 
            array (
                'id' => 1543,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 772,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d42bc057bdbb44aabb7db78121032510_37130/preview_talk_2.webp',
            ),
            43 => 
            array (
                'id' => 1544,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 772,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d42bc057bdbb44aabb7db78121032510_37130/preview_video_talk_2.mp4',
            ),
            44 => 
            array (
                'id' => 1545,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 773,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/077686d2d0d14d8c8a01321479017229_37220/preview_target.webp',
            ),
            45 => 
            array (
                'id' => 1546,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 773,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/077686d2d0d14d8c8a01321479017229_37220/preview_video_target.mp4',
            ),
            46 => 
            array (
                'id' => 1547,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 774,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6dc4290ab2524788a4e4f7f425662ce8_44310/preview_talk_2.webp',
            ),
            47 => 
            array (
                'id' => 1548,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 774,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6dc4290ab2524788a4e4f7f425662ce8_44310/preview_video_talk_2.mp4',
            ),
            48 => 
            array (
                'id' => 1549,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 775,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9071409a63f498bb6ea379d75fa7e72_37620/preview_talk_2.webp',
            ),
            49 => 
            array (
                'id' => 1550,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 775,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9071409a63f498bb6ea379d75fa7e72_37620/preview_video_talk_2.mp4',
            ),
            50 => 
            array (
                'id' => 1551,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 776,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96e71d061f024f5b822ceb93bb3bcb15_37640/preview_talk_1.webp',
            ),
            51 => 
            array (
                'id' => 1552,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 776,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/96e71d061f024f5b822ceb93bb3bcb15_37640/preview_video_talk_1.mp4',
            ),
            52 => 
            array (
                'id' => 1553,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 777,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e26558b7bd114340b29140917deea434_37630/preview_target.webp',
            ),
            53 => 
            array (
                'id' => 1554,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 777,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e26558b7bd114340b29140917deea434_37630/preview_video_target.mp4',
            ),
            54 => 
            array (
                'id' => 1555,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 778,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2d8c3fcc029f4b9883b6668ece780419_44760/preview_talk_1.webp',
            ),
            55 => 
            array (
                'id' => 1556,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 778,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2d8c3fcc029f4b9883b6668ece780419_44760/preview_video_talk_1.mp4',
            ),
            56 => 
            array (
                'id' => 1557,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 779,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c95be48f8f6e41bf83fa6e41212decbd_38890/preview_talk_2.webp',
            ),
            57 => 
            array (
                'id' => 1558,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 779,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c95be48f8f6e41bf83fa6e41212decbd_38890/preview_video_talk_2.mp4',
            ),
            58 => 
            array (
                'id' => 1559,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 780,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0734f4397d5d45b380befb3aa5e22366_38890/preview_talk_3.webp',
            ),
            59 => 
            array (
                'id' => 1560,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 780,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0734f4397d5d45b380befb3aa5e22366_38890/preview_video_talk_3.mp4',
            ),
            60 => 
            array (
                'id' => 1561,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 781,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ac89a4662cba4f7ea314d3973e48006e_38880/preview_target.webp',
            ),
            61 => 
            array (
                'id' => 1562,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 781,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ac89a4662cba4f7ea314d3973e48006e_38880/preview_video_target.mp4',
            ),
            62 => 
            array (
                'id' => 1563,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 782,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a0c02c9ed6954a8d870a910d80061abe_38870/preview_talk_2.webp',
            ),
            63 => 
            array (
                'id' => 1564,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 782,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a0c02c9ed6954a8d870a910d80061abe_38870/preview_video_talk_2.mp4',
            ),
            64 => 
            array (
                'id' => 1565,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 783,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/995711537c174575901529c0c235a061_38890/preview_talk_1.webp',
            ),
            65 => 
            array (
                'id' => 1566,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 783,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/995711537c174575901529c0c235a061_38890/preview_video_talk_1.mp4',
            ),
            66 => 
            array (
                'id' => 1567,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 784,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cca4cbbd012b4f0e899c73d25e8bd192_38890/preview_target.webp',
            ),
            67 => 
            array (
                'id' => 1568,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 784,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cca4cbbd012b4f0e899c73d25e8bd192_38890/preview_video_target.mp4',
            ),
            68 => 
            array (
                'id' => 1569,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 785,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7a09279f8c7f4ad58461080e54b6c207_38870/preview_talk_1.webp',
            ),
            69 => 
            array (
                'id' => 1570,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 785,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7a09279f8c7f4ad58461080e54b6c207_38870/preview_video_talk_1.mp4',
            ),
            70 => 
            array (
                'id' => 1571,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 786,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1af844a83c5f45698fac330aec8487b5_38870/preview_target.webp',
            ),
            71 => 
            array (
                'id' => 1572,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 786,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1af844a83c5f45698fac330aec8487b5_38870/preview_video_target.mp4',
            ),
            72 => 
            array (
                'id' => 1573,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 787,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/247dbd4c290146d39cd40f91ca548da0_42580/preview_target.webp',
            ),
            73 => 
            array (
                'id' => 1574,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 787,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/247dbd4c290146d39cd40f91ca548da0_42580/preview_video_target.mp4',
            ),
            74 => 
            array (
                'id' => 1575,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 788,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2225712da23643059562c93f60c3fe30_42580/preview_talk_3.webp',
            ),
            75 => 
            array (
                'id' => 1576,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 788,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2225712da23643059562c93f60c3fe30_42580/preview_video_talk_3.mp4',
            ),
            76 => 
            array (
                'id' => 1577,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 789,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f24752591bae408b9664d0ded3e107b1_42560/preview_talk_2.webp',
            ),
            77 => 
            array (
                'id' => 1578,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 789,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f24752591bae408b9664d0ded3e107b1_42560/preview_video_talk_2.mp4',
            ),
            78 => 
            array (
                'id' => 1579,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 790,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea2c27c7adf440bcbd1098950058d48c_42550/preview_talk_2.webp',
            ),
            79 => 
            array (
                'id' => 1580,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 790,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea2c27c7adf440bcbd1098950058d48c_42550/preview_video_talk_2.mp4',
            ),
            80 => 
            array (
                'id' => 1581,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 791,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbb4ae3b6ce04de0a428a164831df9ab_42580/preview_talk_2.webp',
            ),
            81 => 
            array (
                'id' => 1582,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 791,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbb4ae3b6ce04de0a428a164831df9ab_42580/preview_video_talk_2.mp4',
            ),
            82 => 
            array (
                'id' => 1583,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 792,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc66810a615c44cd97765c62ec66e9f3_42550/preview_target.webp',
            ),
            83 => 
            array (
                'id' => 1584,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 792,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc66810a615c44cd97765c62ec66e9f3_42550/preview_video_target.mp4',
            ),
            84 => 
            array (
                'id' => 1585,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 793,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d59b6b4db079421aa2009f21a8b89fd2_45280/preview_target.webp',
            ),
            85 => 
            array (
                'id' => 1586,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 793,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d59b6b4db079421aa2009f21a8b89fd2_45280/preview_video_target.mp4',
            ),
            86 => 
            array (
                'id' => 1587,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 794,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f472fbabd2b8424795d5261861e0049a_45280/preview_talk_1.webp',
            ),
            87 => 
            array (
                'id' => 1588,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 794,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f472fbabd2b8424795d5261861e0049a_45280/preview_video_talk_1.mp4',
            ),
            88 => 
            array (
                'id' => 1589,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 795,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/196936a7e593432aa3ff9fe8b093310e_45300/preview_target.webp',
            ),
            89 => 
            array (
                'id' => 1590,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 795,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/196936a7e593432aa3ff9fe8b093310e_45300/preview_video_target.mp4',
            ),
            90 => 
            array (
                'id' => 1591,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 796,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b78702f28784018bade5421caf8588c_46410/preview_target.webp',
            ),
            91 => 
            array (
                'id' => 1592,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 796,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b78702f28784018bade5421caf8588c_46410/preview_video_target.mp4',
            ),
            92 => 
            array (
                'id' => 1593,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 797,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1431fa0723d441d3b4e5f207828a6ea8_42560/preview_target.webp',
            ),
            93 => 
            array (
                'id' => 1594,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 797,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1431fa0723d441d3b4e5f207828a6ea8_42560/preview_video_target.mp4',
            ),
            94 => 
            array (
                'id' => 1595,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 798,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ced7fc80c3b24dc98e37a633beacf541_13256/preview_talk_1.webp',
            ),
            95 => 
            array (
                'id' => 1596,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 798,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ced7fc80c3b24dc98e37a633beacf541_13256/preview_video_talk_1.mp4',
            ),
            96 => 
            array (
                'id' => 1597,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 799,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49b25ad2cbfe4f8ea1259998f77cd54b_2633/preview_target.webp',
            ),
            97 => 
            array (
                'id' => 1598,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 799,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49b25ad2cbfe4f8ea1259998f77cd54b_2633/preview_video_target.mp4',
            ),
            98 => 
            array (
                'id' => 1599,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 800,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fb2f9ff60114f71a9ea7be31da84a19_2573/preview_target.webp',
            ),
            99 => 
            array (
                'id' => 1600,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 800,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0fb2f9ff60114f71a9ea7be31da84a19_2573/preview_video_target.mp4',
            ),
            100 => 
            array (
                'id' => 1601,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 801,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e21df8179ad46b4a81281c5575690af_2634/preview_talk_1.webp',
            ),
            101 => 
            array (
                'id' => 1602,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 801,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e21df8179ad46b4a81281c5575690af_2634/preview_video_talk_1.mp4',
            ),
            102 => 
            array (
                'id' => 1603,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 802,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d618bfca0bd74fdeaa3c7bf1cd3916d5_2634/preview_talk_2.webp',
            ),
            103 => 
            array (
                'id' => 1604,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 802,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d618bfca0bd74fdeaa3c7bf1cd3916d5_2634/preview_video_talk_2.mp4',
            ),
            104 => 
            array (
                'id' => 1605,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 803,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Candace_Pink_Blazer_Front_3_0_20240910/preview_target.webp',
            ),
            105 => 
            array (
                'id' => 1606,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 803,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Candace_Pink_Blazer_Front_3_0_20240910/preview_video_target.mp4',
            ),
            106 => 
            array (
                'id' => 1607,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 804,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Chad_in_Blue_Shirt_Front_3_0_20240910/preview_target.webp',
            ),
            107 => 
            array (
                'id' => 1608,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 804,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Chad_in_Blue_Shirt_Front_3_0_20240910/preview_video_target.mp4',
            ),
            108 => 
            array (
                'id' => 1609,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 805,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d99ba541a2c9413b941fa7efe90a1130_1059/preview_talk_4.webp',
            ),
            109 => 
            array (
                'id' => 1610,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 805,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d99ba541a2c9413b941fa7efe90a1130_1059/preview_video_talk_4.mp4',
            ),
            110 => 
            array (
                'id' => 1611,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 806,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d99ba541a2c9413b941fa7efe90a1130_1059/preview_talk_7.webp',
            ),
            111 => 
            array (
                'id' => 1612,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 806,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d99ba541a2c9413b941fa7efe90a1130_1059/preview_video_talk_7.mp4',
            ),
            112 => 
            array (
                'id' => 1613,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 807,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/942859e6a10243d5816dd9b941c0a5d3_1041/preview_talk_1.webp',
            ),
            113 => 
            array (
                'id' => 1614,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 807,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/942859e6a10243d5816dd9b941c0a5d3_1041/preview_video_talk_1.mp4',
            ),
            114 => 
            array (
                'id' => 1615,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 808,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Francis_in_Blazer_Front_3_0_20240910/preview_target.webp',
            ),
            115 => 
            array (
                'id' => 1616,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 808,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Francis_in_Blazer_Front_3_0_20240910/preview_video_target.mp4',
            ),
            116 => 
            array (
                'id' => 1617,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 809,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5c304ab1e7534e2c887e2f795fbe6568_1354/preview_talk_1.webp',
            ),
            117 => 
            array (
                'id' => 1618,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 809,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5c304ab1e7534e2c887e2f795fbe6568_1354/preview_video_talk_1.mp4',
            ),
            118 => 
            array (
                'id' => 1619,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 810,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/448086197fe64997b29c44a479db5853_1435/preview_target.webp',
            ),
            119 => 
            array (
                'id' => 1620,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 810,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/448086197fe64997b29c44a479db5853_1435/preview_video_target.mp4',
            ),
            120 => 
            array (
                'id' => 1621,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 811,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Nik_Black_3_0_20240910/preview_target.webp',
            ),
            121 => 
            array (
                'id' => 1622,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 811,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Nik_Black_3_0_20240910/preview_video_target.mp4',
            ),
            122 => 
            array (
                'id' => 1623,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 812,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Nik_Blue_3_0_20240910/preview_target.webp',
            ),
            123 => 
            array (
                'id' => 1624,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 812,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/Nik_Blue_3_0_20240910/preview_video_target.mp4',
            ),
            124 => 
            array (
                'id' => 1625,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 813,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/696e5afe51ee4794aa232753fa703fea_14947/preview_talk_2.webp',
            ),
            125 => 
            array (
                'id' => 1626,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 813,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/696e5afe51ee4794aa232753fa703fea_14947/preview_video_talk_2.mp4',
            ),
            126 => 
            array (
                'id' => 1627,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 814,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/25ef6c86b1e946969d9a684870c47dfe_14947/preview_talk_1.webp',
            ),
            127 => 
            array (
                'id' => 1628,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 814,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/25ef6c86b1e946969d9a684870c47dfe_14947/preview_video_talk_1.mp4',
            ),
            128 => 
            array (
                'id' => 1629,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 815,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e3d8f2231e44f73af86ff2f68b7649a_14947/preview_talk_4.webp',
            ),
            129 => 
            array (
                'id' => 1630,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 815,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e3d8f2231e44f73af86ff2f68b7649a_14947/preview_video_talk_4.mp4',
            ),
            130 => 
            array (
                'id' => 1631,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 816,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3dfd4ec90884caeae05430db04334dd_42440/preview_target.webp',
            ),
            131 => 
            array (
                'id' => 1632,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 816,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3dfd4ec90884caeae05430db04334dd_42440/preview_video_target.mp4',
            ),
            132 => 
            array (
                'id' => 1633,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 817,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79c13347a41a43059ddbad785a5836d6_47140/preview_target.webp',
            ),
            133 => 
            array (
                'id' => 1634,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 817,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79c13347a41a43059ddbad785a5836d6_47140/preview_video_target.mp4',
            ),
            134 => 
            array (
                'id' => 1635,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 818,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/599c75d72b0545f9908327b491a9ec36_42450/preview_talk_4.webp',
            ),
            135 => 
            array (
                'id' => 1636,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 818,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/599c75d72b0545f9908327b491a9ec36_42450/preview_video_talk_4.mp4',
            ),
            136 => 
            array (
                'id' => 1637,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 819,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6a3c89a0e0f4170be2bdb5e2c3616b3_42450/preview_talk_3.webp',
            ),
            137 => 
            array (
                'id' => 1638,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 819,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6a3c89a0e0f4170be2bdb5e2c3616b3_42450/preview_video_talk_3.mp4',
            ),
            138 => 
            array (
                'id' => 1639,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 820,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ffe91c78a70469696ed793bc01a682b_42450/preview_target.webp',
            ),
            139 => 
            array (
                'id' => 1640,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 820,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ffe91c78a70469696ed793bc01a682b_42450/preview_video_target.mp4',
            ),
            140 => 
            array (
                'id' => 1641,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 821,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ecd4d2f8ee2b4178929876bb86efa799_35020/preview_talk_1.webp',
            ),
            141 => 
            array (
                'id' => 1642,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 821,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ecd4d2f8ee2b4178929876bb86efa799_35020/preview_video_talk_1.mp4',
            ),
            142 => 
            array (
                'id' => 1643,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 822,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f6f77b67900e45ffaf5f3fe756ba2bc2_35030/preview_talk_1.webp',
            ),
            143 => 
            array (
                'id' => 1644,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 822,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f6f77b67900e45ffaf5f3fe756ba2bc2_35030/preview_video_talk_1.mp4',
            ),
            144 => 
            array (
                'id' => 1645,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 823,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/93b2b6e3ceb34ca880a8c053ade3293c_35040/preview_talk_1.webp',
            ),
            145 => 
            array (
                'id' => 1646,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 823,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/93b2b6e3ceb34ca880a8c053ade3293c_35040/preview_video_talk_1.mp4',
            ),
            146 => 
            array (
                'id' => 1647,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 824,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/23807df66d6c4a2d89248ed269ef1a14_35020/preview_talk_2.webp',
            ),
            147 => 
            array (
                'id' => 1648,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 824,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/23807df66d6c4a2d89248ed269ef1a14_35020/preview_video_talk_2.mp4',
            ),
            148 => 
            array (
                'id' => 1649,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 825,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7736e274ddb24d08a1168653ea5c11b2_35030/preview_talk_2.webp',
            ),
            149 => 
            array (
                'id' => 1650,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 825,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7736e274ddb24d08a1168653ea5c11b2_35030/preview_video_talk_2.mp4',
            ),
            150 => 
            array (
                'id' => 1651,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 826,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21a54eff27e54a98acd49ad2b33cc657_35040/preview_talk_2.webp',
            ),
            151 => 
            array (
                'id' => 1652,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 826,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21a54eff27e54a98acd49ad2b33cc657_35040/preview_video_talk_2.mp4',
            ),
            152 => 
            array (
                'id' => 1653,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 827,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed0577c3046545018aade5e35fc6e491_2750/preview_target.webp',
            ),
            153 => 
            array (
                'id' => 1654,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 827,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed0577c3046545018aade5e35fc6e491_2750/preview_video_target.mp4',
            ),
            154 => 
            array (
                'id' => 1655,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 828,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed0577c3046545018aade5e35fc6e491_2750/preview_talk_2.webp',
            ),
            155 => 
            array (
                'id' => 1656,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 828,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed0577c3046545018aade5e35fc6e491_2750/preview_video_talk_2.mp4',
            ),
            156 => 
            array (
                'id' => 1657,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 829,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5f78b56b91d4117b3902fe168257530_2724/preview_target.webp',
            ),
            157 => 
            array (
                'id' => 1658,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 829,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5f78b56b91d4117b3902fe168257530_2724/preview_video_target.mp4',
            ),
            158 => 
            array (
                'id' => 1659,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 830,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cd8a8ebd400418a97274f159f27b531_2745/preview_talk_1.webp',
            ),
            159 => 
            array (
                'id' => 1660,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 830,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7cd8a8ebd400418a97274f159f27b531_2745/preview_video_talk_1.mp4',
            ),
            160 => 
            array (
                'id' => 1661,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 831,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c427d8c81414355b04c2b25a1e7873a_13216/preview_target.webp',
            ),
            161 => 
            array (
                'id' => 1662,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 831,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c427d8c81414355b04c2b25a1e7873a_13216/preview_video_target.mp4',
            ),
            162 => 
            array (
                'id' => 1663,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 832,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c427d8c81414355b04c2b25a1e7873a_13216/preview_talk_4.webp',
            ),
            163 => 
            array (
                'id' => 1664,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 832,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c427d8c81414355b04c2b25a1e7873a_13216/preview_video_talk_4.mp4',
            ),
            164 => 
            array (
                'id' => 1665,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 833,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c427d8c81414355b04c2b25a1e7873a_13216/preview_talk_3.webp',
            ),
            165 => 
            array (
                'id' => 1666,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 833,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c427d8c81414355b04c2b25a1e7873a_13216/preview_video_talk_3.mp4',
            ),
            166 => 
            array (
                'id' => 1667,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 834,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef41b4d270ae48b0af554464adde71aa_43280/preview_talk_5.webp',
            ),
            167 => 
            array (
                'id' => 1668,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 834,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef41b4d270ae48b0af554464adde71aa_43280/preview_video_talk_5.mp4',
            ),
            168 => 
            array (
                'id' => 1669,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 835,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/866961acf5084781b1557068ada1dd28_43460/preview_target.webp',
            ),
            169 => 
            array (
                'id' => 1670,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 835,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/866961acf5084781b1557068ada1dd28_43460/preview_video_target.mp4',
            ),
            170 => 
            array (
                'id' => 1671,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 836,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/483f52a8e2c84a41ad2b3c2dc985e2a1_42700/preview_talk_2.webp',
            ),
            171 => 
            array (
                'id' => 1672,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 836,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/483f52a8e2c84a41ad2b3c2dc985e2a1_42700/preview_video_talk_2.mp4',
            ),
            172 => 
            array (
                'id' => 1673,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 837,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/acf277577bc74c7a9cf97f06b04f9aa1_42700/preview_target.webp',
            ),
            173 => 
            array (
                'id' => 1674,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 837,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/acf277577bc74c7a9cf97f06b04f9aa1_42700/preview_video_target.mp4',
            ),
            174 => 
            array (
                'id' => 1675,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 838,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/587df623272843cca6ccbe4db2b27abe_42700/preview_talk_3.webp',
            ),
            175 => 
            array (
                'id' => 1676,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 838,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/587df623272843cca6ccbe4db2b27abe_42700/preview_video_talk_3.mp4',
            ),
            176 => 
            array (
                'id' => 1677,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 839,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c39391b38b9341e3b1bf3395d601f910_42700/preview_talk_4.webp',
            ),
            177 => 
            array (
                'id' => 1678,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 839,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c39391b38b9341e3b1bf3395d601f910_42700/preview_video_talk_4.mp4',
            ),
            178 => 
            array (
                'id' => 1679,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 840,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/94b3783586ad4a5bad570b07e81613a4_42880/preview_talk_1.webp',
            ),
            179 => 
            array (
                'id' => 1680,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 840,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/94b3783586ad4a5bad570b07e81613a4_42880/preview_video_talk_1.mp4',
            ),
            180 => 
            array (
                'id' => 1681,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 841,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a96302474efd47ab9f42313e5a82ee05_42890/preview_talk_1.webp',
            ),
            181 => 
            array (
                'id' => 1682,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 841,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a96302474efd47ab9f42313e5a82ee05_42890/preview_video_talk_1.mp4',
            ),
            182 => 
            array (
                'id' => 1683,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 842,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bdf6a54fc1cc412fb59b7dbd4e96713c_43180/preview_target.webp',
            ),
            183 => 
            array (
                'id' => 1684,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 842,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bdf6a54fc1cc412fb59b7dbd4e96713c_43180/preview_video_target.mp4',
            ),
            184 => 
            array (
                'id' => 1685,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 843,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4fc10ac8217f45beb88e41f24ba13aa6_43190/preview_talk_2.webp',
            ),
            185 => 
            array (
                'id' => 1686,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 843,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4fc10ac8217f45beb88e41f24ba13aa6_43190/preview_video_talk_2.mp4',
            ),
            186 => 
            array (
                'id' => 1687,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 844,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/964bf1663527476f8903cf7752e10200_42880/preview_talk_4.webp',
            ),
            187 => 
            array (
                'id' => 1688,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 844,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/964bf1663527476f8903cf7752e10200_42880/preview_video_talk_4.mp4',
            ),
            188 => 
            array (
                'id' => 1689,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 845,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f913b5aba2349b190292af2e0e41fa1_42890/preview_talk_5.webp',
            ),
            189 => 
            array (
                'id' => 1690,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 845,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f913b5aba2349b190292af2e0e41fa1_42890/preview_video_talk_5.mp4',
            ),
            190 => 
            array (
                'id' => 1691,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 846,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e09fcd146f1342fd9ad2ece55e5e4bba_42880/preview_talk_3.webp',
            ),
            191 => 
            array (
                'id' => 1692,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 846,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e09fcd146f1342fd9ad2ece55e5e4bba_42880/preview_video_talk_3.mp4',
            ),
            192 => 
            array (
                'id' => 1693,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 847,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d0c09fbdcae4689bcbb23d634b62ac9_42890/preview_talk_4.webp',
            ),
            193 => 
            array (
                'id' => 1694,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 847,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d0c09fbdcae4689bcbb23d634b62ac9_42890/preview_video_talk_4.mp4',
            ),
            194 => 
            array (
                'id' => 1695,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 848,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1cab6f2c26f14b18a05aa972b9f229e8_42880/preview_target.webp',
            ),
            195 => 
            array (
                'id' => 1696,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 848,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1cab6f2c26f14b18a05aa972b9f229e8_42880/preview_video_target.mp4',
            ),
            196 => 
            array (
                'id' => 1697,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 849,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/95893e8e41ce40288e0dba37058a6f3f_42890/preview_target.webp',
            ),
            197 => 
            array (
                'id' => 1698,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 849,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/95893e8e41ce40288e0dba37058a6f3f_42890/preview_video_target.mp4',
            ),
            198 => 
            array (
                'id' => 1699,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 850,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49220aa3db2541c5b56e1386e0014ecf_34490/preview_talk_2.webp',
            ),
            199 => 
            array (
                'id' => 1700,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 850,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49220aa3db2541c5b56e1386e0014ecf_34490/preview_video_talk_2.mp4',
            ),
            200 => 
            array (
                'id' => 1701,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 851,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2c266f31fb9f4f92b9c00ef56bf5fdef_34500/preview_talk_2.webp',
            ),
            201 => 
            array (
                'id' => 1702,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 851,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2c266f31fb9f4f92b9c00ef56bf5fdef_34500/preview_video_talk_2.mp4',
            ),
            202 => 
            array (
                'id' => 1703,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 852,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/706eac56881e4a4d8494f6e1dc08fd93_34510/preview_talk_2.webp',
            ),
            203 => 
            array (
                'id' => 1704,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 852,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/706eac56881e4a4d8494f6e1dc08fd93_34510/preview_video_talk_2.mp4',
            ),
            204 => 
            array (
                'id' => 1705,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 853,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ab93928a6e14473f81880393e92ebfcf_34490/preview_target.webp',
            ),
            205 => 
            array (
                'id' => 1706,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 853,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ab93928a6e14473f81880393e92ebfcf_34490/preview_video_target.mp4',
            ),
            206 => 
            array (
                'id' => 1707,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 854,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7f5cd2b39cc949b8a52fc00479ab9679_34500/preview_target.webp',
            ),
            207 => 
            array (
                'id' => 1708,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 854,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7f5cd2b39cc949b8a52fc00479ab9679_34500/preview_video_target.mp4',
            ),
            208 => 
            array (
                'id' => 1709,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 855,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/090fb330b0e14f5184595bd585fcb011_34510/preview_target.webp',
            ),
            209 => 
            array (
                'id' => 1710,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 855,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/090fb330b0e14f5184595bd585fcb011_34510/preview_video_target.mp4',
            ),
            210 => 
            array (
                'id' => 1711,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 856,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e50a097f50b541749c318dfedfe9c640_13311/preview_talk_1.webp',
            ),
            211 => 
            array (
                'id' => 1712,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 856,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e50a097f50b541749c318dfedfe9c640_13311/preview_video_talk_1.mp4',
            ),
            212 => 
            array (
                'id' => 1713,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 857,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e50a097f50b541749c318dfedfe9c640_13311/preview_talk_2.webp',
            ),
            213 => 
            array (
                'id' => 1714,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 857,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e50a097f50b541749c318dfedfe9c640_13311/preview_video_talk_2.mp4',
            ),
            214 => 
            array (
                'id' => 1715,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 858,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e50a097f50b541749c318dfedfe9c640_13311/preview_talk_4.webp',
            ),
            215 => 
            array (
                'id' => 1716,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 858,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e50a097f50b541749c318dfedfe9c640_13311/preview_video_talk_4.mp4',
            ),
            216 => 
            array (
                'id' => 1717,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 859,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/081f26a79daa4f38b6dd91c65b9d0889_43310/preview_target.webp',
            ),
            217 => 
            array (
                'id' => 1718,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 859,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/081f26a79daa4f38b6dd91c65b9d0889_43310/preview_video_target.mp4',
            ),
            218 => 
            array (
                'id' => 1719,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 860,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1e2f2a63828044a8914069748fe264ab_43320/preview_target.webp',
            ),
            219 => 
            array (
                'id' => 1720,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 860,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1e2f2a63828044a8914069748fe264ab_43320/preview_video_target.mp4',
            ),
            220 => 
            array (
                'id' => 1721,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 861,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4a77fc7cc1cb4304b40c61ac1e11921a_43310/preview_talk_2.webp',
            ),
            221 => 
            array (
                'id' => 1722,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 861,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4a77fc7cc1cb4304b40c61ac1e11921a_43310/preview_video_talk_2.mp4',
            ),
            222 => 
            array (
                'id' => 1723,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 862,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a2592f1e4fdb4af5868f6f01b1a2e83e_43320/preview_talk_2.webp',
            ),
            223 => 
            array (
                'id' => 1724,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 862,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a2592f1e4fdb4af5868f6f01b1a2e83e_43320/preview_video_talk_2.mp4',
            ),
            224 => 
            array (
                'id' => 1725,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 863,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dc8ae4ecccac4ac2a5d37a4e6b687936_46450/preview_talk_1.webp',
            ),
            225 => 
            array (
                'id' => 1726,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 863,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dc8ae4ecccac4ac2a5d37a4e6b687936_46450/preview_video_talk_1.mp4',
            ),
            226 => 
            array (
                'id' => 1727,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 864,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/574a6db186404f0a9298c4fe08d846a9_43440/preview_target.webp',
            ),
            227 => 
            array (
                'id' => 1728,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 864,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/574a6db186404f0a9298c4fe08d846a9_43440/preview_video_target.mp4',
            ),
            228 => 
            array (
                'id' => 1729,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 865,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae8e24c71de14670a6326419007d6129_46460/preview_target.webp',
            ),
            229 => 
            array (
                'id' => 1730,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 865,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae8e24c71de14670a6326419007d6129_46460/preview_video_target.mp4',
            ),
            230 => 
            array (
                'id' => 1731,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 866,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8ba3e815f497464ba506ee1b16bd2687_43450/preview_talk_1.webp',
            ),
            231 => 
            array (
                'id' => 1732,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 866,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8ba3e815f497464ba506ee1b16bd2687_43450/preview_video_talk_1.mp4',
            ),
            232 => 
            array (
                'id' => 1733,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 867,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1e6143eb608c48b4a5c011550c6b7267_46440/preview_target.webp',
            ),
            233 => 
            array (
                'id' => 1734,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 867,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1e6143eb608c48b4a5c011550c6b7267_46440/preview_video_target.mp4',
            ),
            234 => 
            array (
                'id' => 1735,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 868,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/61293cf6fb9c41b592665d637e539aaf_46430/preview_target.webp',
            ),
            235 => 
            array (
                'id' => 1736,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 868,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/61293cf6fb9c41b592665d637e539aaf_46430/preview_video_target.mp4',
            ),
            236 => 
            array (
                'id' => 1737,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 869,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dfd1b15d97ed47b2b112e9c8ed0cac2b_46470/preview_talk_1.webp',
            ),
            237 => 
            array (
                'id' => 1738,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 869,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dfd1b15d97ed47b2b112e9c8ed0cac2b_46470/preview_video_talk_1.mp4',
            ),
            238 => 
            array (
                'id' => 1739,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 870,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/73f3eb112e9a47dab0e1d44bdd0b26a2_45510/preview_talk_2.webp',
            ),
            239 => 
            array (
                'id' => 1740,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 870,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/73f3eb112e9a47dab0e1d44bdd0b26a2_45510/preview_video_talk_2.mp4',
            ),
            240 => 
            array (
                'id' => 1741,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 871,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b527a84a8ae64488892a4c45bf6779b3_46480/preview_target.webp',
            ),
            241 => 
            array (
                'id' => 1742,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 871,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b527a84a8ae64488892a4c45bf6779b3_46480/preview_video_target.mp4',
            ),
            242 => 
            array (
                'id' => 1743,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 872,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6d986b9c617d4c70945977d73c0d10c6_45520/preview_talk_1.webp',
            ),
            243 => 
            array (
                'id' => 1744,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 872,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6d986b9c617d4c70945977d73c0d10c6_45520/preview_video_talk_1.mp4',
            ),
            244 => 
            array (
                'id' => 1745,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 873,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3a491556539c4522bdf2928ce5029613_46470/preview_target.webp',
            ),
            245 => 
            array (
                'id' => 1746,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 873,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3a491556539c4522bdf2928ce5029613_46470/preview_video_target.mp4',
            ),
            246 => 
            array (
                'id' => 1747,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 874,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fb2fa69c65704aee895309236591901a_46480/preview_talk_1.webp',
            ),
            247 => 
            array (
                'id' => 1748,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 874,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fb2fa69c65704aee895309236591901a_46480/preview_video_talk_1.mp4',
            ),
            248 => 
            array (
                'id' => 1749,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 875,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d906050dc688415080200145a6f98630_46450/preview_target.webp',
            ),
            249 => 
            array (
                'id' => 1750,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 875,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d906050dc688415080200145a6f98630_46450/preview_video_target.mp4',
            ),
            250 => 
            array (
                'id' => 1751,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 876,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/caef8e33487246f093470f1a7678f0d5_43440/preview_talk_2.webp',
            ),
            251 => 
            array (
                'id' => 1752,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 876,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/caef8e33487246f093470f1a7678f0d5_43440/preview_video_talk_2.mp4',
            ),
            252 => 
            array (
                'id' => 1753,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 877,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ff7697329c2f4f66888736580068739f_45720/preview_talk_2.webp',
            ),
            253 => 
            array (
                'id' => 1754,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 877,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ff7697329c2f4f66888736580068739f_45720/preview_video_talk_2.mp4',
            ),
            254 => 
            array (
                'id' => 1755,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 878,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bb948a1bf0fb4f9b9b2039cf3ed2013d_34520/preview_target.webp',
            ),
            255 => 
            array (
                'id' => 1756,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 878,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bb948a1bf0fb4f9b9b2039cf3ed2013d_34520/preview_video_target.mp4',
            ),
            256 => 
            array (
                'id' => 1757,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 879,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/209f38334f324ce489edc92f83605c45_34530/preview_target.webp',
            ),
            257 => 
            array (
                'id' => 1758,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 879,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/209f38334f324ce489edc92f83605c45_34530/preview_video_target.mp4',
            ),
            258 => 
            array (
                'id' => 1759,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 880,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bbff688b03724c0da88c13bcd65033e5_34540/preview_target.webp',
            ),
            259 => 
            array (
                'id' => 1760,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 880,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bbff688b03724c0da88c13bcd65033e5_34540/preview_video_target.mp4',
            ),
            260 => 
            array (
                'id' => 1761,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 881,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/61368abc197e4cd6ad4f3d2d3a5c0054_34850/preview_target.webp',
            ),
            261 => 
            array (
                'id' => 1762,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 881,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/61368abc197e4cd6ad4f3d2d3a5c0054_34850/preview_video_target.mp4',
            ),
            262 => 
            array (
                'id' => 1763,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 882,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3f24528591ce4cc39823537683f4ba02_34860/preview_target.webp',
            ),
            263 => 
            array (
                'id' => 1764,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 882,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3f24528591ce4cc39823537683f4ba02_34860/preview_video_target.mp4',
            ),
            264 => 
            array (
                'id' => 1765,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 883,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbb8126d62064cbba68145d2e8f308aa_34870/preview_target.webp',
            ),
            265 => 
            array (
                'id' => 1766,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 883,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbb8126d62064cbba68145d2e8f308aa_34870/preview_video_target.mp4',
            ),
            266 => 
            array (
                'id' => 1767,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 884,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0ce4e8f76382460f90c8200db2ea18b8_35400/preview_target.webp',
            ),
            267 => 
            array (
                'id' => 1768,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 884,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0ce4e8f76382460f90c8200db2ea18b8_35400/preview_video_target.mp4',
            ),
            268 => 
            array (
                'id' => 1769,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 885,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/98a665dd632248559fb25a7cecafe4ed_35270/preview_talk_2.webp',
            ),
            269 => 
            array (
                'id' => 1770,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 885,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/98a665dd632248559fb25a7cecafe4ed_35270/preview_video_talk_2.mp4',
            ),
            270 => 
            array (
                'id' => 1771,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 886,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9a8136d450f4570a51fd2b11081c55a_35280/preview_talk_2.webp',
            ),
            271 => 
            array (
                'id' => 1772,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 886,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9a8136d450f4570a51fd2b11081c55a_35280/preview_video_talk_2.mp4',
            ),
            272 => 
            array (
                'id' => 1773,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 887,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f2e273b9eb654a5a8cb26aacfb26e24e_46130/preview_target.webp',
            ),
            273 => 
            array (
                'id' => 1774,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 887,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f2e273b9eb654a5a8cb26aacfb26e24e_46130/preview_video_target.mp4',
            ),
            274 => 
            array (
                'id' => 1775,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 888,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9cca635ae43a4b259a6a2f607c418702_46150/preview_target.webp',
            ),
            275 => 
            array (
                'id' => 1776,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 888,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9cca635ae43a4b259a6a2f607c418702_46150/preview_video_target.mp4',
            ),
            276 => 
            array (
                'id' => 1777,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 889,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/673f0954600a4253a84bf0aec53b760b_46130/preview_talk_2.webp',
            ),
            277 => 
            array (
                'id' => 1778,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 889,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/673f0954600a4253a84bf0aec53b760b_46130/preview_video_talk_2.mp4',
            ),
            278 => 
            array (
                'id' => 1779,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 890,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47ed824e72624ca7ae53c72854332d52_46140/preview_target.webp',
            ),
            279 => 
            array (
                'id' => 1780,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 890,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/47ed824e72624ca7ae53c72854332d52_46140/preview_video_target.mp4',
            ),
            280 => 
            array (
                'id' => 1781,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 891,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9ed556b88074ec29ce49a008d564a42_46130/preview_talk_1.webp',
            ),
            281 => 
            array (
                'id' => 1782,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 891,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c9ed556b88074ec29ce49a008d564a42_46130/preview_video_talk_1.mp4',
            ),
            282 => 
            array (
                'id' => 1783,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 892,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0c3418dc38c74fdeac9d1610186353db_47110/preview_target.webp',
            ),
            283 => 
            array (
                'id' => 1784,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 892,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0c3418dc38c74fdeac9d1610186353db_47110/preview_video_target.mp4',
            ),
            284 => 
            array (
                'id' => 1785,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 893,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/667582ceb33d493fbeaa6180331e1b29_47110/preview_talk_1.webp',
            ),
            285 => 
            array (
                'id' => 1786,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 893,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/667582ceb33d493fbeaa6180331e1b29_47110/preview_video_talk_1.mp4',
            ),
            286 => 
            array (
                'id' => 1787,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 894,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3f3bc580bfe4aae9d9d5da54f8aa95e_47100/preview_target.webp',
            ),
            287 => 
            array (
                'id' => 1788,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 894,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3f3bc580bfe4aae9d9d5da54f8aa95e_47100/preview_video_target.mp4',
            ),
            288 => 
            array (
                'id' => 1789,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 895,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/627b45da78184333962ece812d2d5ce1_47100/preview_talk_2.webp',
            ),
            289 => 
            array (
                'id' => 1790,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 895,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/627b45da78184333962ece812d2d5ce1_47100/preview_video_talk_2.mp4',
            ),
            290 => 
            array (
                'id' => 1791,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 896,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7bd16caf2e04a3395ac9c15a9c8080a_47100/preview_talk_1.webp',
            ),
            291 => 
            array (
                'id' => 1792,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 896,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7bd16caf2e04a3395ac9c15a9c8080a_47100/preview_video_talk_1.mp4',
            ),
            292 => 
            array (
                'id' => 1793,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 897,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2be5dffeb3b14fa0b2991ef05dc67dde_47120/preview_target.webp',
            ),
            293 => 
            array (
                'id' => 1794,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 897,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2be5dffeb3b14fa0b2991ef05dc67dde_47120/preview_video_target.mp4',
            ),
            294 => 
            array (
                'id' => 1795,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 898,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/525340ba68ed423bb9bd8620ac7e66ea_34900/preview_talk_1.webp',
            ),
            295 => 
            array (
                'id' => 1796,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 898,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/525340ba68ed423bb9bd8620ac7e66ea_34900/preview_video_talk_1.mp4',
            ),
            296 => 
            array (
                'id' => 1797,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 899,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/38de15d384614b3c8004e7286eac43ad_34910/preview_talk_1.webp',
            ),
            297 => 
            array (
                'id' => 1798,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 899,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/38de15d384614b3c8004e7286eac43ad_34910/preview_video_talk_1.mp4',
            ),
            298 => 
            array (
                'id' => 1799,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 900,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/69ed9db7f4c14a848ac10a4971d961e5_34920/preview_talk_1.webp',
            ),
            299 => 
            array (
                'id' => 1800,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 900,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/69ed9db7f4c14a848ac10a4971d961e5_34920/preview_video_talk_1.mp4',
            ),
            300 => 
            array (
                'id' => 1801,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 901,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ac048b34f66c4526a396842915c438c8_34900/preview_talk_2.webp',
            ),
            301 => 
            array (
                'id' => 1802,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 901,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ac048b34f66c4526a396842915c438c8_34900/preview_video_talk_2.mp4',
            ),
            302 => 
            array (
                'id' => 1803,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 902,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bcc11928ea3e4af2a56f03403aaf59a2_34910/preview_talk_2.webp',
            ),
            303 => 
            array (
                'id' => 1804,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 902,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bcc11928ea3e4af2a56f03403aaf59a2_34910/preview_video_talk_2.mp4',
            ),
            304 => 
            array (
                'id' => 1805,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 903,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d7c033a06a4843a185c7206dcacd16cd_34920/preview_talk_2.webp',
            ),
            305 => 
            array (
                'id' => 1806,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 903,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d7c033a06a4843a185c7206dcacd16cd_34920/preview_video_talk_2.mp4',
            ),
            306 => 
            array (
                'id' => 1807,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 904,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1455b446cbb841ec80b14cbce4f9abed_34990/preview_talk_1.webp',
            ),
            307 => 
            array (
                'id' => 1808,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 904,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1455b446cbb841ec80b14cbce4f9abed_34990/preview_video_talk_1.mp4',
            ),
            308 => 
            array (
                'id' => 1809,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 905,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2df99c3628df4d61b2a9a1b8aaf3751d_35200/preview_target.webp',
            ),
            309 => 
            array (
                'id' => 1810,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 905,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2df99c3628df4d61b2a9a1b8aaf3751d_35200/preview_video_target.mp4',
            ),
            310 => 
            array (
                'id' => 1811,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 906,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/446b8476089c4469bcb77d92c5b5bb37_35010/preview_talk_1.webp',
            ),
            311 => 
            array (
                'id' => 1812,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 906,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/446b8476089c4469bcb77d92c5b5bb37_35010/preview_video_talk_1.mp4',
            ),
            312 => 
            array (
                'id' => 1813,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 907,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2c9f905ae82942a895aaef96c366d670_43050/preview_talk_4.webp',
            ),
            313 => 
            array (
                'id' => 1814,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 907,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2c9f905ae82942a895aaef96c366d670_43050/preview_video_talk_4.mp4',
            ),
            314 => 
            array (
                'id' => 1815,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 908,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b7b5e97f604d4ab08f0db2cc3fd894f9_43060/preview_target.webp',
            ),
            315 => 
            array (
                'id' => 1816,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 908,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b7b5e97f604d4ab08f0db2cc3fd894f9_43060/preview_video_target.mp4',
            ),
            316 => 
            array (
                'id' => 1817,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 909,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5d39d6a461c40a2bf1cb1d0335af444_43050/preview_talk_5.webp',
            ),
            317 => 
            array (
                'id' => 1818,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 909,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5d39d6a461c40a2bf1cb1d0335af444_43050/preview_video_talk_5.mp4',
            ),
            318 => 
            array (
                'id' => 1819,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 910,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa6a353bb4de486a8277a70d29de5f66_43050/preview_talk_2.webp',
            ),
            319 => 
            array (
                'id' => 1820,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 910,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fa6a353bb4de486a8277a70d29de5f66_43050/preview_video_talk_2.mp4',
            ),
            320 => 
            array (
                'id' => 1821,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 911,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4436c61923a646749b4a29852a3032f7_43050/preview_talk_3.webp',
            ),
            321 => 
            array (
                'id' => 1822,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 911,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4436c61923a646749b4a29852a3032f7_43050/preview_video_talk_3.mp4',
            ),
            322 => 
            array (
                'id' => 1823,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 912,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9410c73299a4e9ead25f48a96ca7851_46270/preview_talk_2.webp',
            ),
            323 => 
            array (
                'id' => 1824,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 912,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e9410c73299a4e9ead25f48a96ca7851_46270/preview_video_talk_2.mp4',
            ),
            324 => 
            array (
                'id' => 1825,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 913,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/87ae6fed85af45fd987aadc4305242b1_48090/preview_target.webp',
            ),
            325 => 
            array (
                'id' => 1826,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 913,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/87ae6fed85af45fd987aadc4305242b1_48090/preview_video_target.mp4',
            ),
            326 => 
            array (
                'id' => 1827,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 914,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9cafc6c918544a3aa9247d77b99110ac_46230/preview_target.webp',
            ),
            327 => 
            array (
                'id' => 1828,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 914,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9cafc6c918544a3aa9247d77b99110ac_46230/preview_video_target.mp4',
            ),
            328 => 
            array (
                'id' => 1829,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 915,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b61f67ac59f437f9f5cb7fe3e13b26e_48060/preview_target.webp',
            ),
            329 => 
            array (
                'id' => 1830,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 915,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7b61f67ac59f437f9f5cb7fe3e13b26e_48060/preview_video_target.mp4',
            ),
            330 => 
            array (
                'id' => 1831,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 916,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d28f8c4f7e6c4d168b477f22078f17c2_46240/preview_target.webp',
            ),
            331 => 
            array (
                'id' => 1832,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 916,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d28f8c4f7e6c4d168b477f22078f17c2_46240/preview_video_target.mp4',
            ),
            332 => 
            array (
                'id' => 1833,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 917,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d95121630b014d01a518f3dbd0dffbe2_48120/preview_target.webp',
            ),
            333 => 
            array (
                'id' => 1834,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 917,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d95121630b014d01a518f3dbd0dffbe2_48120/preview_video_target.mp4',
            ),
            334 => 
            array (
                'id' => 1835,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 918,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21c4669a288344f2bef3a5adaf141f37_46730/preview_target.webp',
            ),
            335 => 
            array (
                'id' => 1836,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 918,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21c4669a288344f2bef3a5adaf141f37_46730/preview_video_target.mp4',
            ),
            336 => 
            array (
                'id' => 1837,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 919,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/057e96a18c7944f3bcc94190ebcc1a9a_46700/preview_target.webp',
            ),
            337 => 
            array (
                'id' => 1838,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 919,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/057e96a18c7944f3bcc94190ebcc1a9a_46700/preview_video_target.mp4',
            ),
            338 => 
            array (
                'id' => 1839,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 920,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b56065afb3264e778cd874d68fafa489_48110/preview_target.webp',
            ),
            339 => 
            array (
                'id' => 1840,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 920,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b56065afb3264e778cd874d68fafa489_48110/preview_video_target.mp4',
            ),
            340 => 
            array (
                'id' => 1841,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 921,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b32a4abaded44bd840b3a67522cd96b_46250/preview_target.webp',
            ),
            341 => 
            array (
                'id' => 1842,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 921,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b32a4abaded44bd840b3a67522cd96b_46250/preview_video_target.mp4',
            ),
            342 => 
            array (
                'id' => 1843,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 922,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/20e170c632a54485976059171a45eb93_48110/preview_talk_1.webp',
            ),
            343 => 
            array (
                'id' => 1844,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 922,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/20e170c632a54485976059171a45eb93_48110/preview_video_talk_1.mp4',
            ),
            344 => 
            array (
                'id' => 1845,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 923,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0f737b39c5d409c85a23e1e3727e0ba_46270/preview_talk_1.webp',
            ),
            345 => 
            array (
                'id' => 1846,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 923,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0f737b39c5d409c85a23e1e3727e0ba_46270/preview_video_talk_1.mp4',
            ),
            346 => 
            array (
                'id' => 1847,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 924,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01cb076fd95f4541a7ca6c2cc436e0ec_45460/preview_talk_2.webp',
            ),
            347 => 
            array (
                'id' => 1848,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 924,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01cb076fd95f4541a7ca6c2cc436e0ec_45460/preview_video_talk_2.mp4',
            ),
            348 => 
            array (
                'id' => 1849,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 925,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bb2a62d02b0c4fddb7dc21daca1c32e3_45460/preview_target.webp',
            ),
            349 => 
            array (
                'id' => 1850,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 925,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bb2a62d02b0c4fddb7dc21daca1c32e3_45460/preview_video_target.mp4',
            ),
            350 => 
            array (
                'id' => 1851,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 926,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/341339be217141169b38894cebc6ad29_45470/preview_target.webp',
            ),
            351 => 
            array (
                'id' => 1852,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 926,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/341339be217141169b38894cebc6ad29_45470/preview_video_target.mp4',
            ),
            352 => 
            array (
                'id' => 1853,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 927,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b6838290a19843ecb2314f41f411e88c_45470/preview_talk_2.webp',
            ),
            353 => 
            array (
                'id' => 1854,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 927,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b6838290a19843ecb2314f41f411e88c_45470/preview_video_talk_2.mp4',
            ),
            354 => 
            array (
                'id' => 1855,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 928,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d87ef7888ba49fdb6e591523286bcce_34550/preview_target.webp',
            ),
            355 => 
            array (
                'id' => 1856,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 928,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d87ef7888ba49fdb6e591523286bcce_34550/preview_video_target.mp4',
            ),
            356 => 
            array (
                'id' => 1857,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 929,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4118c7aecff5413c8adf07d6017f54dd_34560/preview_target.webp',
            ),
            357 => 
            array (
                'id' => 1858,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 929,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4118c7aecff5413c8adf07d6017f54dd_34560/preview_video_target.mp4',
            ),
            358 => 
            array (
                'id' => 1859,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 930,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dae7a6dbfe324a5ea9a039b3eb09bc4a_34570/preview_target.webp',
            ),
            359 => 
            array (
                'id' => 1860,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 930,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dae7a6dbfe324a5ea9a039b3eb09bc4a_34570/preview_video_target.mp4',
            ),
            360 => 
            array (
                'id' => 1861,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 931,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5f998247bd44b8db4b5e1968660c59a_34550/preview_talk_2.webp',
            ),
            361 => 
            array (
                'id' => 1862,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 931,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f5f998247bd44b8db4b5e1968660c59a_34550/preview_video_talk_2.mp4',
            ),
            362 => 
            array (
                'id' => 1863,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 932,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39d3d1460aa34c7fa6b33c57859c5a9e_34560/preview_talk_2.webp',
            ),
            363 => 
            array (
                'id' => 1864,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 932,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39d3d1460aa34c7fa6b33c57859c5a9e_34560/preview_video_talk_2.mp4',
            ),
            364 => 
            array (
                'id' => 1865,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 933,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8115f90b34374623b3ef741a002a1a8c_34570/preview_talk_2.webp',
            ),
            365 => 
            array (
                'id' => 1866,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 933,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8115f90b34374623b3ef741a002a1a8c_34570/preview_video_talk_2.mp4',
            ),
            366 => 
            array (
                'id' => 1867,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 934,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/587683450ec943279bce9afc783b933f_43260/preview_target.webp',
            ),
            367 => 
            array (
                'id' => 1868,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 934,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/587683450ec943279bce9afc783b933f_43260/preview_video_target.mp4',
            ),
            368 => 
            array (
                'id' => 1869,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 935,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1f822595f1fb4c6281147bd1d1538c92_43270/preview_target.webp',
            ),
            369 => 
            array (
                'id' => 1870,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 935,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1f822595f1fb4c6281147bd1d1538c92_43270/preview_video_target.mp4',
            ),
            370 => 
            array (
                'id' => 1871,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 936,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/288aae5264734e64b14de9231572cf92_43260/preview_talk_2.webp',
            ),
            371 => 
            array (
                'id' => 1872,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 936,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/288aae5264734e64b14de9231572cf92_43260/preview_video_talk_2.mp4',
            ),
            372 => 
            array (
                'id' => 1873,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 937,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88fa92f1f60543f8944909337264f8fa_43270/preview_talk_2.webp',
            ),
            373 => 
            array (
                'id' => 1874,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 937,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/88fa92f1f60543f8944909337264f8fa_43270/preview_video_talk_2.mp4',
            ),
            374 => 
            array (
                'id' => 1875,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 938,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/30a5aea324364db5872aabd1a0a8721d_43260/preview_talk_1.webp',
            ),
            375 => 
            array (
                'id' => 1876,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 938,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/30a5aea324364db5872aabd1a0a8721d_43260/preview_video_talk_1.mp4',
            ),
            376 => 
            array (
                'id' => 1877,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 939,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/602b80061fb04631b08e975c5985d2cf_43270/preview_talk_1.webp',
            ),
            377 => 
            array (
                'id' => 1878,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 939,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/602b80061fb04631b08e975c5985d2cf_43270/preview_video_talk_1.mp4',
            ),
            378 => 
            array (
                'id' => 1879,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 940,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/70850f0bfc214a58a1c51e27de52fa84_15336/preview_talk_1.webp',
            ),
            379 => 
            array (
                'id' => 1880,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 940,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/70850f0bfc214a58a1c51e27de52fa84_15336/preview_video_talk_1.mp4',
            ),
            380 => 
            array (
                'id' => 1881,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 941,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/43fe3f127f0d49d08729d621c2b534c9_15336/preview_talk_3.webp',
            ),
            381 => 
            array (
                'id' => 1882,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 941,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/43fe3f127f0d49d08729d621c2b534c9_15336/preview_video_talk_3.mp4',
            ),
            382 => 
            array (
                'id' => 1883,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 942,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cfaac1bd37ac4a97b44f4232fc88a724_15336/preview_talk_5.webp',
            ),
            383 => 
            array (
                'id' => 1884,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 942,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cfaac1bd37ac4a97b44f4232fc88a724_15336/preview_video_talk_5.mp4',
            ),
            384 => 
            array (
                'id' => 1885,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 943,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e477a746635a447abf4a914add4647e8_42070/preview_talk_1.webp',
            ),
            385 => 
            array (
                'id' => 1886,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 943,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e477a746635a447abf4a914add4647e8_42070/preview_video_talk_1.mp4',
            ),
            386 => 
            array (
                'id' => 1887,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 944,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/419bbd32272a49558b2d64002b2d36e5_42080/preview_talk_1.webp',
            ),
            387 => 
            array (
                'id' => 1888,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 944,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/419bbd32272a49558b2d64002b2d36e5_42080/preview_video_talk_1.mp4',
            ),
            388 => 
            array (
                'id' => 1889,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 945,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b4f0f441120c4b91829474d2eec04a94_42290/preview_target.webp',
            ),
            389 => 
            array (
                'id' => 1890,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 945,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b4f0f441120c4b91829474d2eec04a94_42290/preview_video_target.mp4',
            ),
            390 => 
            array (
                'id' => 1891,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 946,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bded73fa5ae04fbe99c627027170b2af_42080/preview_target.webp',
            ),
            391 => 
            array (
                'id' => 1892,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 946,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bded73fa5ae04fbe99c627027170b2af_42080/preview_video_target.mp4',
            ),
            392 => 
            array (
                'id' => 1893,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 947,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e548e03f4b184e468686a9f6601cd03f_42070/preview_talk_2.webp',
            ),
            393 => 
            array (
                'id' => 1894,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 947,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e548e03f4b184e468686a9f6601cd03f_42070/preview_video_talk_2.mp4',
            ),
            394 => 
            array (
                'id' => 1895,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 948,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5f0ecfb9ce22464fbdbd6cf85af39bd6_42080/preview_talk_3.webp',
            ),
            395 => 
            array (
                'id' => 1896,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 948,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5f0ecfb9ce22464fbdbd6cf85af39bd6_42080/preview_video_talk_3.mp4',
            ),
            396 => 
            array (
                'id' => 1897,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 949,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/af6571f2bf534d9ebe401af37cf43c05_42340/preview_target.webp',
            ),
            397 => 
            array (
                'id' => 1898,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 949,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/af6571f2bf534d9ebe401af37cf43c05_42340/preview_video_target.mp4',
            ),
            398 => 
            array (
                'id' => 1899,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 950,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9c11e91378d7476c9b9d36e9ea8dc60d_42350/preview_target.webp',
            ),
            399 => 
            array (
                'id' => 1900,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 950,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9c11e91378d7476c9b9d36e9ea8dc60d_42350/preview_video_target.mp4',
            ),
            400 => 
            array (
                'id' => 1901,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 951,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7ee42a37066f496790e1070606547b90_42290/preview_talk_1.webp',
            ),
            401 => 
            array (
                'id' => 1902,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 951,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7ee42a37066f496790e1070606547b90_42290/preview_video_talk_1.mp4',
            ),
            402 => 
            array (
                'id' => 1903,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 952,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b400a91cb9f44e97925b930da45532e6_42300/preview_target.webp',
            ),
            403 => 
            array (
                'id' => 1904,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 952,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b400a91cb9f44e97925b930da45532e6_42300/preview_video_target.mp4',
            ),
            404 => 
            array (
                'id' => 1905,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 953,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b62300f2487e44c5be5b5ea14c90717e_43220/preview_talk_3.webp',
            ),
            405 => 
            array (
                'id' => 1906,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 953,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b62300f2487e44c5be5b5ea14c90717e_43220/preview_video_talk_3.mp4',
            ),
            406 => 
            array (
                'id' => 1907,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 954,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d13e6bed695440acbe3a18fa87a35fcc_43230/preview_talk_3.webp',
            ),
            407 => 
            array (
                'id' => 1908,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 954,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d13e6bed695440acbe3a18fa87a35fcc_43230/preview_video_talk_3.mp4',
            ),
            408 => 
            array (
                'id' => 1909,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 955,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f674b92def174246b17570b2b25c2cb2_43220/preview_talk_2.webp',
            ),
            409 => 
            array (
                'id' => 1910,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 955,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f674b92def174246b17570b2b25c2cb2_43220/preview_video_talk_2.mp4',
            ),
            410 => 
            array (
                'id' => 1911,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 956,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dd36ae26fdae453e8b255cf9f0294be5_43230/preview_talk_2.webp',
            ),
            411 => 
            array (
                'id' => 1912,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 956,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dd36ae26fdae453e8b255cf9f0294be5_43230/preview_video_talk_2.mp4',
            ),
            412 => 
            array (
                'id' => 1913,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 957,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc3775c857904e5ca2c1e9f0704eeb8f_43220/preview_talk_1.webp',
            ),
            413 => 
            array (
                'id' => 1914,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 957,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc3775c857904e5ca2c1e9f0704eeb8f_43220/preview_video_talk_1.mp4',
            ),
            414 => 
            array (
                'id' => 1915,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 958,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f06c1cfc15574d7bbfed820c52cd35bc_43230/preview_target.webp',
            ),
            415 => 
            array (
                'id' => 1916,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 958,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f06c1cfc15574d7bbfed820c52cd35bc_43230/preview_video_target.mp4',
            ),
            416 => 
            array (
                'id' => 1917,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 959,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/15e5253e9ae94a08a720b3ba45522eb5_2606/preview_talk_1.webp',
            ),
            417 => 
            array (
                'id' => 1918,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 959,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/15e5253e9ae94a08a720b3ba45522eb5_2606/preview_video_talk_1.mp4',
            ),
            418 => 
            array (
                'id' => 1919,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 960,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bab998cb82fb4423b521341a9e962017_2662/preview_target.webp',
            ),
            419 => 
            array (
                'id' => 1920,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 960,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bab998cb82fb4423b521341a9e962017_2662/preview_video_target.mp4',
            ),
            420 => 
            array (
                'id' => 1921,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 961,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f4db5688f278411ab3353f92b9b41df7_46060/preview_talk_2.webp',
            ),
            421 => 
            array (
                'id' => 1922,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 961,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f4db5688f278411ab3353f92b9b41df7_46060/preview_video_talk_2.mp4',
            ),
            422 => 
            array (
                'id' => 1923,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 962,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6791432e4c3b4234b02d0a09b59f4bb8_46060/preview_talk_1.webp',
            ),
            423 => 
            array (
                'id' => 1924,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 962,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6791432e4c3b4234b02d0a09b59f4bb8_46060/preview_video_talk_1.mp4',
            ),
            424 => 
            array (
                'id' => 1925,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 963,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4b1c65a25855430db1d95d300c1303fb_48300/preview_talk_2.webp',
            ),
            425 => 
            array (
                'id' => 1926,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 963,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4b1c65a25855430db1d95d300c1303fb_48300/preview_video_talk_2.mp4',
            ),
            426 => 
            array (
                'id' => 1927,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 964,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c25a30861f1f406ca2642f0b6c344321_48300/preview_talk_1.webp',
            ),
            427 => 
            array (
                'id' => 1928,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 964,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c25a30861f1f406ca2642f0b6c344321_48300/preview_video_talk_1.mp4',
            ),
            428 => 
            array (
                'id' => 1929,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 965,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/757d14d78f704e82aae30524c4f5cd2f_48310/preview_target.webp',
            ),
            429 => 
            array (
                'id' => 1930,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 965,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/757d14d78f704e82aae30524c4f5cd2f_48310/preview_video_target.mp4',
            ),
            430 => 
            array (
                'id' => 1931,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 966,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35173ee1f75644a493e479bedce54b31_48310/preview_talk_1.webp',
            ),
            431 => 
            array (
                'id' => 1932,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 966,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35173ee1f75644a493e479bedce54b31_48310/preview_video_talk_1.mp4',
            ),
            432 => 
            array (
                'id' => 1933,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 967,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c5d86dd89e614d438486858229cf2c56_48300/preview_target.webp',
            ),
            433 => 
            array (
                'id' => 1934,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 967,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c5d86dd89e614d438486858229cf2c56_48300/preview_video_target.mp4',
            ),
            434 => 
            array (
                'id' => 1935,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 968,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a7f246ec7df54d16b8427cfcd3b7efaf_48840/preview_target.webp',
            ),
            435 => 
            array (
                'id' => 1936,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 968,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a7f246ec7df54d16b8427cfcd3b7efaf_48840/preview_video_target.mp4',
            ),
            436 => 
            array (
                'id' => 1937,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 969,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39b063f1e03b478c9f6732e7404c5879_48660/preview_talk_1.webp',
            ),
            437 => 
            array (
                'id' => 1938,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 969,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/39b063f1e03b478c9f6732e7404c5879_48660/preview_video_talk_1.mp4',
            ),
            438 => 
            array (
                'id' => 1939,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 970,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/818c73f503434c1296abdf4f6686669f_48650/preview_talk_1.webp',
            ),
            439 => 
            array (
                'id' => 1940,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 970,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/818c73f503434c1296abdf4f6686669f_48650/preview_video_talk_1.mp4',
            ),
            440 => 
            array (
                'id' => 1941,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 971,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0b96a42ff264c7085dd2c5740c026de_48660/preview_target.webp',
            ),
            441 => 
            array (
                'id' => 1942,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 971,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0b96a42ff264c7085dd2c5740c026de_48660/preview_video_target.mp4',
            ),
            442 => 
            array (
                'id' => 1943,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 972,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c49d50763f20456e8d9e61c37eb62c55_48680/preview_target.webp',
            ),
            443 => 
            array (
                'id' => 1944,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 972,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c49d50763f20456e8d9e61c37eb62c55_48680/preview_video_target.mp4',
            ),
            444 => 
            array (
                'id' => 1945,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 973,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3387a579d5b54c90aaaac4fd40502e13_48690/preview_target.webp',
            ),
            445 => 
            array (
                'id' => 1946,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 973,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3387a579d5b54c90aaaac4fd40502e13_48690/preview_video_target.mp4',
            ),
            446 => 
            array (
                'id' => 1947,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 974,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6e035f8d60c44e9e82ab83d950a188e2_48670/preview_target.webp',
            ),
            447 => 
            array (
                'id' => 1948,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 974,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6e035f8d60c44e9e82ab83d950a188e2_48670/preview_video_target.mp4',
            ),
            448 => 
            array (
                'id' => 1949,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 975,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/08b96fb7b9a24758ab3ea01e839b70e2_46050/preview_target.webp',
            ),
            449 => 
            array (
                'id' => 1950,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 975,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/08b96fb7b9a24758ab3ea01e839b70e2_46050/preview_video_target.mp4',
            ),
            450 => 
            array (
                'id' => 1951,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 976,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1feb21c4a972455884b3827c551a373a_48680/preview_talk_1.webp',
            ),
            451 => 
            array (
                'id' => 1952,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 976,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1feb21c4a972455884b3827c551a373a_48680/preview_video_talk_1.mp4',
            ),
            452 => 
            array (
                'id' => 1953,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 977,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1dcec33ac696411e841aeb1f552b281e_48700/preview_target.webp',
            ),
            453 => 
            array (
                'id' => 1954,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 977,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1dcec33ac696411e841aeb1f552b281e_48700/preview_video_target.mp4',
            ),
            454 => 
            array (
                'id' => 1955,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 978,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b3996a8508d4060b6031549f161eafa_47220/preview_talk_2.webp',
            ),
            455 => 
            array (
                'id' => 1956,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 978,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8b3996a8508d4060b6031549f161eafa_47220/preview_video_talk_2.mp4',
            ),
            456 => 
            array (
                'id' => 1957,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 979,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6010f06908ef489cbd83bbb25363e9c2_47220/preview_talk_1.webp',
            ),
            457 => 
            array (
                'id' => 1958,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 979,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6010f06908ef489cbd83bbb25363e9c2_47220/preview_video_talk_1.mp4',
            ),
            458 => 
            array (
                'id' => 1959,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 980,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01ddd912ed994a26bae4cd38097c4475_47230/preview_talk_2.webp',
            ),
            459 => 
            array (
                'id' => 1960,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 980,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/01ddd912ed994a26bae4cd38097c4475_47230/preview_video_talk_2.mp4',
            ),
            460 => 
            array (
                'id' => 1961,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 981,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59db27f7418c4df8b14e7ad6d5c35c66_47230/preview_talk_1.webp',
            ),
            461 => 
            array (
                'id' => 1962,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 981,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59db27f7418c4df8b14e7ad6d5c35c66_47230/preview_video_talk_1.mp4',
            ),
            462 => 
            array (
                'id' => 1963,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 982,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/811f924027e4432dab06d4b2f47d8cc1_35230/preview_talk_1.webp',
            ),
            463 => 
            array (
                'id' => 1964,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 982,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/811f924027e4432dab06d4b2f47d8cc1_35230/preview_video_talk_1.mp4',
            ),
            464 => 
            array (
                'id' => 1965,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 983,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d04fefce25b94677b4b4a793d12e2c6f_35240/preview_talk_1.webp',
            ),
            465 => 
            array (
                'id' => 1966,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 983,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d04fefce25b94677b4b4a793d12e2c6f_35240/preview_video_talk_1.mp4',
            ),
            466 => 
            array (
                'id' => 1967,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 984,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c0ec26484ee44784b79327627a127908_35250/preview_talk_1.webp',
            ),
            467 => 
            array (
                'id' => 1968,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 984,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c0ec26484ee44784b79327627a127908_35250/preview_video_talk_1.mp4',
            ),
            468 => 
            array (
                'id' => 1969,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 985,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7394dfe88e74f468eca3054a8cad2a1_35230/preview_talk_2.webp',
            ),
            469 => 
            array (
                'id' => 1970,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 985,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7394dfe88e74f468eca3054a8cad2a1_35230/preview_video_talk_2.mp4',
            ),
            470 => 
            array (
                'id' => 1971,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 986,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a16a917ce742404da06db49a9dd4f52d_35240/preview_talk_2.webp',
            ),
            471 => 
            array (
                'id' => 1972,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 986,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a16a917ce742404da06db49a9dd4f52d_35240/preview_video_talk_2.mp4',
            ),
            472 => 
            array (
                'id' => 1973,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 987,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7344b244f0274501947605c5f694c021_35250/preview_talk_2.webp',
            ),
            473 => 
            array (
                'id' => 1974,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 987,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7344b244f0274501947605c5f694c021_35250/preview_video_talk_2.mp4',
            ),
            474 => 
            array (
                'id' => 1975,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 988,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cad18b5267ef4f2299bb14b0dedf7987_17230/preview_talk_2.webp',
            ),
            475 => 
            array (
                'id' => 1976,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 988,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cad18b5267ef4f2299bb14b0dedf7987_17230/preview_video_talk_2.mp4',
            ),
            476 => 
            array (
                'id' => 1977,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 989,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d977251fe0944f579eae1c40f4350909_17230/preview_talk_5.webp',
            ),
            477 => 
            array (
                'id' => 1978,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 989,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d977251fe0944f579eae1c40f4350909_17230/preview_video_talk_5.mp4',
            ),
            478 => 
            array (
                'id' => 1979,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 990,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b35452c5e5dd469d90502860e8e411d6_17230/preview_talk_1.webp',
            ),
            479 => 
            array (
                'id' => 1980,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 990,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b35452c5e5dd469d90502860e8e411d6_17230/preview_video_talk_1.mp4',
            ),
            480 => 
            array (
                'id' => 1981,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 991,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e16ac8a870c4235aaed50ce2db3158e_44180/preview_talk_2.webp',
            ),
            481 => 
            array (
                'id' => 1982,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 991,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4e16ac8a870c4235aaed50ce2db3158e_44180/preview_video_talk_2.mp4',
            ),
            482 => 
            array (
                'id' => 1983,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 992,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a4a9f7552e2048f1a0a2af80691c8e2c_44190/preview_talk_1.webp',
            ),
            483 => 
            array (
                'id' => 1984,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 992,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a4a9f7552e2048f1a0a2af80691c8e2c_44190/preview_video_talk_1.mp4',
            ),
            484 => 
            array (
                'id' => 1985,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 993,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18d30133b9b942c18e441261118acb4a_44180/preview_target.webp',
            ),
            485 => 
            array (
                'id' => 1986,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 993,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/18d30133b9b942c18e441261118acb4a_44180/preview_video_target.mp4',
            ),
            486 => 
            array (
                'id' => 1987,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 994,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1c3787bed85043a994220f22dd6b7b5e_45000/preview_target.webp',
            ),
            487 => 
            array (
                'id' => 1988,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 994,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1c3787bed85043a994220f22dd6b7b5e_45000/preview_video_target.mp4',
            ),
            488 => 
            array (
                'id' => 1989,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 995,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/703b1aa602534a5f8f5ee01860acfe51_44180/preview_talk_1.webp',
            ),
            489 => 
            array (
                'id' => 1990,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 995,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/703b1aa602534a5f8f5ee01860acfe51_44180/preview_video_talk_1.mp4',
            ),
            490 => 
            array (
                'id' => 1991,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 996,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d6ccc751de604ca8ba437b60a86f35de_44990/preview_target.webp',
            ),
            491 => 
            array (
                'id' => 1992,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 996,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d6ccc751de604ca8ba437b60a86f35de_44990/preview_video_target.mp4',
            ),
            492 => 
            array (
                'id' => 1993,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 997,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9fa3a0b039c04c298ec879e61d792ef1_44190/preview_talk_2.webp',
            ),
            493 => 
            array (
                'id' => 1994,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 997,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9fa3a0b039c04c298ec879e61d792ef1_44190/preview_video_talk_2.mp4',
            ),
            494 => 
            array (
                'id' => 1995,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 998,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/711d72691ab64e99a76616e3b3f631f7_44190/preview_target.webp',
            ),
            495 => 
            array (
                'id' => 1996,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 998,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/711d72691ab64e99a76616e3b3f631f7_44190/preview_video_target.mp4',
            ),
            496 => 
            array (
                'id' => 1997,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 999,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c917762dec9a4db6b0ee92b69bc14a93_45020/preview_target.webp',
            ),
            497 => 
            array (
                'id' => 1998,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 999,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c917762dec9a4db6b0ee92b69bc14a93_45020/preview_video_target.mp4',
            ),
            498 => 
            array (
                'id' => 1999,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1000,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26e4b9c25df84940bd1d8829a89f54e4_45010/preview_target.webp',
            ),
            499 => 
            array (
                'id' => 2000,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1000,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26e4b9c25df84940bd1d8829a89f54e4_45010/preview_video_target.mp4',
            ),
        ));
        \DB::table('avatar_metas')->insert(array (
            0 => 
            array (
                'id' => 2001,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1001,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f58bdbeedb74bf5b827097852d13432_45780/preview_target.webp',
            ),
            1 => 
            array (
                'id' => 2002,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1001,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8f58bdbeedb74bf5b827097852d13432_45780/preview_video_target.mp4',
            ),
            2 => 
            array (
                'id' => 2003,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1002,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c9fc1cc2b4f4b8eb4429438bdd1f054_45790/preview_target.webp',
            ),
            3 => 
            array (
                'id' => 2004,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1002,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3c9fc1cc2b4f4b8eb4429438bdd1f054_45790/preview_video_target.mp4',
            ),
            4 => 
            array (
                'id' => 2005,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1003,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c3b773fd6744488886fd26ffedffcc34_43300/preview_talk_1.webp',
            ),
            5 => 
            array (
                'id' => 2006,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1003,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c3b773fd6744488886fd26ffedffcc34_43300/preview_video_talk_1.mp4',
            ),
            6 => 
            array (
                'id' => 2007,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1004,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b067ea74fb7848e49ed1fde8ceb2e710_43300/preview_talk_2.webp',
            ),
            7 => 
            array (
                'id' => 2008,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1004,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b067ea74fb7848e49ed1fde8ceb2e710_43300/preview_video_talk_2.mp4',
            ),
            8 => 
            array (
                'id' => 2009,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1005,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1110ae32c5e14ff3bd15c25aa9ddae80_42510/preview_talk_4.webp',
            ),
            9 => 
            array (
                'id' => 2010,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1005,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1110ae32c5e14ff3bd15c25aa9ddae80_42510/preview_video_talk_4.mp4',
            ),
            10 => 
            array (
                'id' => 2011,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1006,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ff03ea60b2984ae3a14bba341d0178db_42510/preview_target.webp',
            ),
            11 => 
            array (
                'id' => 2012,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1006,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ff03ea60b2984ae3a14bba341d0178db_42510/preview_video_target.mp4',
            ),
            12 => 
            array (
                'id' => 2013,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1007,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c0d0ac2b731941efae72f63f3c9d18bc_43300/preview_target.webp',
            ),
            13 => 
            array (
                'id' => 2014,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1007,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c0d0ac2b731941efae72f63f3c9d18bc_43300/preview_video_target.mp4',
            ),
            14 => 
            array (
                'id' => 2015,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1008,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae0df3236f904dff8874014cb4b618d3_42510/preview_talk_2.webp',
            ),
            15 => 
            array (
                'id' => 2016,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1008,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ae0df3236f904dff8874014cb4b618d3_42510/preview_video_talk_2.mp4',
            ),
            16 => 
            array (
                'id' => 2017,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1009,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/662dc6736d624041bba54b818dcdf61e_42510/preview_talk_1.webp',
            ),
            17 => 
            array (
                'id' => 2018,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1009,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/662dc6736d624041bba54b818dcdf61e_42510/preview_video_talk_1.mp4',
            ),
            18 => 
            array (
                'id' => 2019,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1010,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8ad113a9695d472ea8d825c41bdbbf04_15060/preview_target.webp',
            ),
            19 => 
            array (
                'id' => 2020,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1010,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8ad113a9695d472ea8d825c41bdbbf04_15060/preview_video_target.mp4',
            ),
            20 => 
            array (
                'id' => 2021,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1011,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0989ba9890542e7b88b8939392eb93b_15060/preview_talk_4.webp',
            ),
            21 => 
            array (
                'id' => 2022,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1011,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d0989ba9890542e7b88b8939392eb93b_15060/preview_video_talk_4.mp4',
            ),
            22 => 
            array (
                'id' => 2023,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1012,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cca5c6471a834e05b11056261082b22d_15060/preview_talk_2.webp',
            ),
            23 => 
            array (
                'id' => 2024,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1012,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cca5c6471a834e05b11056261082b22d_15060/preview_video_talk_2.mp4',
            ),
            24 => 
            array (
                'id' => 2025,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1013,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/038552b4f7d647bb8ae98c7663d7b83e_15054/preview_talk_3.webp',
            ),
            25 => 
            array (
                'id' => 2026,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1013,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/038552b4f7d647bb8ae98c7663d7b83e_15054/preview_video_talk_3.mp4',
            ),
            26 => 
            array (
                'id' => 2027,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1014,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ebcd9c44cdb4424680c739d82d97d019_15054/preview_talk_1.webp',
            ),
            27 => 
            array (
                'id' => 2028,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1014,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ebcd9c44cdb4424680c739d82d97d019_15054/preview_video_talk_1.mp4',
            ),
            28 => 
            array (
                'id' => 2029,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1015,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e652fd9e04c243dda50e0b77a3b03198_15054/preview_talk_4.webp',
            ),
            29 => 
            array (
                'id' => 2030,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1015,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e652fd9e04c243dda50e0b77a3b03198_15054/preview_video_talk_4.mp4',
            ),
            30 => 
            array (
                'id' => 2031,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1016,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef7684d3ba9c46ca8b86393432d90e72_47370/preview_target.webp',
            ),
            31 => 
            array (
                'id' => 2032,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1016,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef7684d3ba9c46ca8b86393432d90e72_47370/preview_video_target.mp4',
            ),
            32 => 
            array (
                'id' => 2033,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1017,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1574caab00294ceab1cc027eceddda3a_47380/preview_target.webp',
            ),
            33 => 
            array (
                'id' => 2034,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1017,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1574caab00294ceab1cc027eceddda3a_47380/preview_video_target.mp4',
            ),
            34 => 
            array (
                'id' => 2035,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1018,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f930e659ce0e446fa9f64c3058df5f77_47370/preview_talk_1.webp',
            ),
            35 => 
            array (
                'id' => 2036,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1018,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f930e659ce0e446fa9f64c3058df5f77_47370/preview_video_talk_1.mp4',
            ),
            36 => 
            array (
                'id' => 2037,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1019,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e111c586d575485681d656c683e51c9a_47380/preview_talk_1.webp',
            ),
            37 => 
            array (
                'id' => 2038,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1019,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e111c586d575485681d656c683e51c9a_47380/preview_video_talk_1.mp4',
            ),
            38 => 
            array (
                'id' => 2039,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1020,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7e2c41a638174c099ada043b4c03e351_14903/preview_target.webp',
            ),
            39 => 
            array (
                'id' => 2040,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1020,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7e2c41a638174c099ada043b4c03e351_14903/preview_video_target.mp4',
            ),
            40 => 
            array (
                'id' => 2041,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1021,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d7e75a13e2149769093feccebc765de_14903/preview_talk_2.webp',
            ),
            41 => 
            array (
                'id' => 2042,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1021,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d7e75a13e2149769093feccebc765de_14903/preview_video_talk_2.mp4',
            ),
            42 => 
            array (
                'id' => 2043,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1022,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/edbc3c434aa64141beb3e6b20602d781_14903/preview_talk_1.webp',
            ),
            43 => 
            array (
                'id' => 2044,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1022,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/edbc3c434aa64141beb3e6b20602d781_14903/preview_video_talk_1.mp4',
            ),
            44 => 
            array (
                'id' => 2045,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1023,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/835cf0a1642c4e8e92d206ea277920e1_14903/preview_talk_5.webp',
            ),
            45 => 
            array (
                'id' => 2046,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1023,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/835cf0a1642c4e8e92d206ea277920e1_14903/preview_video_talk_5.mp4',
            ),
            46 => 
            array (
                'id' => 2047,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1024,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21374cc61f4c4a81971088ea00bbfd1f_15009/preview_target.webp',
            ),
            47 => 
            array (
                'id' => 2048,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1024,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21374cc61f4c4a81971088ea00bbfd1f_15009/preview_video_target.mp4',
            ),
            48 => 
            array (
                'id' => 2049,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1025,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0622907387de443193028d6f055a1343_15009/preview_talk_4.webp',
            ),
            49 => 
            array (
                'id' => 2050,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1025,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0622907387de443193028d6f055a1343_15009/preview_video_talk_4.mp4',
            ),
            50 => 
            array (
                'id' => 2051,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1026,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7315c3664db441a48a19d55ef80c0cac_15009/preview_talk_2.webp',
            ),
            51 => 
            array (
                'id' => 2052,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1026,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7315c3664db441a48a19d55ef80c0cac_15009/preview_video_talk_2.mp4',
            ),
            52 => 
            array (
                'id' => 2053,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1027,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/20c964c5869042c687c5813c8a8a8c90_43380/preview_talk_2.webp',
            ),
            53 => 
            array (
                'id' => 2054,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1027,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/20c964c5869042c687c5813c8a8a8c90_43380/preview_video_talk_2.mp4',
            ),
            54 => 
            array (
                'id' => 2055,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1028,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e6b6af595712410bbb77af0a4e77dbce_43390/preview_target.webp',
            ),
            55 => 
            array (
                'id' => 2056,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1028,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e6b6af595712410bbb77af0a4e77dbce_43390/preview_video_target.mp4',
            ),
            56 => 
            array (
                'id' => 2057,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1029,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21e007276a5044a3ae5ac61b300cfe42_43420/preview_target.webp',
            ),
            57 => 
            array (
                'id' => 2058,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1029,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/21e007276a5044a3ae5ac61b300cfe42_43420/preview_video_target.mp4',
            ),
            58 => 
            array (
                'id' => 2059,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1030,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33322c2138e34155bbddb19239f90853_43430/preview_talk_1.webp',
            ),
            59 => 
            array (
                'id' => 2060,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1030,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/33322c2138e34155bbddb19239f90853_43430/preview_video_talk_1.mp4',
            ),
            60 => 
            array (
                'id' => 2061,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1031,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b46b4b37c5d4cf492bd9e81cdc04356_43420/preview_talk_2.webp',
            ),
            61 => 
            array (
                'id' => 2062,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1031,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b46b4b37c5d4cf492bd9e81cdc04356_43420/preview_video_talk_2.mp4',
            ),
            62 => 
            array (
                'id' => 2063,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1032,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e39d646223545509db0d44b8f546e99_43430/preview_target.webp',
            ),
            63 => 
            array (
                'id' => 2064,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1032,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3e39d646223545509db0d44b8f546e99_43430/preview_video_target.mp4',
            ),
            64 => 
            array (
                'id' => 2065,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1033,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5dc4b23bcbf49b493a3379c10f48781_43380/preview_target.webp',
            ),
            65 => 
            array (
                'id' => 2066,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1033,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5dc4b23bcbf49b493a3379c10f48781_43380/preview_video_target.mp4',
            ),
            66 => 
            array (
                'id' => 2067,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1034,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ddb844f42a5455fba4de7d080b1e1e2_43390/preview_talk_1.webp',
            ),
            67 => 
            array (
                'id' => 2068,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1034,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ddb844f42a5455fba4de7d080b1e1e2_43390/preview_video_talk_1.mp4',
            ),
            68 => 
            array (
                'id' => 2069,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1035,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1911c218dec4cf388b0b0de1b588d05_43420/preview_talk_1.webp',
            ),
            69 => 
            array (
                'id' => 2070,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1035,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d1911c218dec4cf388b0b0de1b588d05_43420/preview_video_talk_1.mp4',
            ),
            70 => 
            array (
                'id' => 2071,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1036,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aefa97afc4014d3388e80194d617a74f_43430/preview_talk_2.webp',
            ),
            71 => 
            array (
                'id' => 2072,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1036,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/aefa97afc4014d3388e80194d617a74f_43430/preview_video_talk_2.mp4',
            ),
            72 => 
            array (
                'id' => 2073,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1037,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/65a1d2c0c10c4983ad91b790839e40fc_43400/preview_target.webp',
            ),
            73 => 
            array (
                'id' => 2074,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1037,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/65a1d2c0c10c4983ad91b790839e40fc_43400/preview_video_target.mp4',
            ),
            74 => 
            array (
                'id' => 2075,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1038,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b27c3fb37e454e5b8455aa8fd2d86b24_43410/preview_target.webp',
            ),
            75 => 
            array (
                'id' => 2076,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1038,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b27c3fb37e454e5b8455aa8fd2d86b24_43410/preview_video_target.mp4',
            ),
            76 => 
            array (
                'id' => 2077,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1039,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a08094ae19ba4e27a48fbe094fe9afd6_44930/preview_talk_1.webp',
            ),
            77 => 
            array (
                'id' => 2078,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1039,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a08094ae19ba4e27a48fbe094fe9afd6_44930/preview_video_talk_1.mp4',
            ),
            78 => 
            array (
                'id' => 2079,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1040,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6ef055097a96469c87aa215da0b7454c_44930/preview_talk_5.webp',
            ),
            79 => 
            array (
                'id' => 2080,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1040,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6ef055097a96469c87aa215da0b7454c_44930/preview_video_talk_5.mp4',
            ),
            80 => 
            array (
                'id' => 2081,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1041,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b6a41491c5646b0b957cabe0a45a839_46300/preview_target.webp',
            ),
            81 => 
            array (
                'id' => 2082,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1041,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1b6a41491c5646b0b957cabe0a45a839_46300/preview_video_target.mp4',
            ),
            82 => 
            array (
                'id' => 2083,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1042,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a98b00a590f34a908a2bd29ba16b3de9_46310/preview_target.webp',
            ),
            83 => 
            array (
                'id' => 2084,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1042,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a98b00a590f34a908a2bd29ba16b3de9_46310/preview_video_target.mp4',
            ),
            84 => 
            array (
                'id' => 2085,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1043,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4a1b866440034b6e80a7d8299788e9c4_43240/preview_talk_3.webp',
            ),
            85 => 
            array (
                'id' => 2086,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1043,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4a1b866440034b6e80a7d8299788e9c4_43240/preview_video_talk_3.mp4',
            ),
            86 => 
            array (
                'id' => 2087,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1044,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35ac2c490fcd4e5abeb4cfe6d85493ec_43250/preview_talk_4.webp',
            ),
            87 => 
            array (
                'id' => 2088,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1044,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/35ac2c490fcd4e5abeb4cfe6d85493ec_43250/preview_video_talk_4.mp4',
            ),
            88 => 
            array (
                'id' => 2089,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1045,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b5e2d4736a014d688957c0b0f9399f46_43240/preview_talk_2.webp',
            ),
            89 => 
            array (
                'id' => 2090,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1045,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b5e2d4736a014d688957c0b0f9399f46_43240/preview_video_talk_2.mp4',
            ),
            90 => 
            array (
                'id' => 2091,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1046,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/af7607a5d023418eaec9596b89bd6edb_43250/preview_talk_2.webp',
            ),
            91 => 
            array (
                'id' => 2092,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1046,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/af7607a5d023418eaec9596b89bd6edb_43250/preview_video_talk_2.mp4',
            ),
            92 => 
            array (
                'id' => 2093,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1047,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9b93d5caa494bd1ba9eb07b2eeceb91_43240/preview_talk_4.webp',
            ),
            93 => 
            array (
                'id' => 2094,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1047,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a9b93d5caa494bd1ba9eb07b2eeceb91_43240/preview_video_talk_4.mp4',
            ),
            94 => 
            array (
                'id' => 2095,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1048,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6ed033c167474e0a8b61f2924541a59c_43250/preview_talk_3.webp',
            ),
            95 => 
            array (
                'id' => 2096,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1048,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6ed033c167474e0a8b61f2924541a59c_43250/preview_video_talk_3.mp4',
            ),
            96 => 
            array (
                'id' => 2097,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1049,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae54bef2c444d68bbbb63021df4bbbb_14944/preview_talk_2.webp',
            ),
            97 => 
            array (
                'id' => 2098,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1049,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae54bef2c444d68bbbb63021df4bbbb_14944/preview_video_talk_2.mp4',
            ),
            98 => 
            array (
                'id' => 2099,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1050,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae54bef2c444d68bbbb63021df4bbbb_14944/preview_talk_5.webp',
            ),
            99 => 
            array (
                'id' => 2100,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1050,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae54bef2c444d68bbbb63021df4bbbb_14944/preview_video_talk_5.mp4',
            ),
            100 => 
            array (
                'id' => 2101,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1051,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae54bef2c444d68bbbb63021df4bbbb_14944/preview_target.webp',
            ),
            101 => 
            array (
                'id' => 2102,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1051,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9ae54bef2c444d68bbbb63021df4bbbb_14944/preview_video_target.mp4',
            ),
            102 => 
            array (
                'id' => 2103,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1052,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d810f2227674342ac60646c2434ad73_34380/preview_target.webp',
            ),
            103 => 
            array (
                'id' => 2104,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1052,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7d810f2227674342ac60646c2434ad73_34380/preview_video_target.mp4',
            ),
            104 => 
            array (
                'id' => 2105,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1053,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/04980c3e031d44f1a255ee0320eb0e86_34390/preview_target.webp',
            ),
            105 => 
            array (
                'id' => 2106,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1053,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/04980c3e031d44f1a255ee0320eb0e86_34390/preview_video_target.mp4',
            ),
            106 => 
            array (
                'id' => 2107,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1054,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc36136a7fcf423ba1569f9d8523b226_34400/preview_target.webp',
            ),
            107 => 
            array (
                'id' => 2108,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1054,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc36136a7fcf423ba1569f9d8523b226_34400/preview_video_target.mp4',
            ),
            108 => 
            array (
                'id' => 2109,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1055,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/022319a6924342cb9d20a55a2bb3ea5e_34380/preview_talk_2.webp',
            ),
            109 => 
            array (
                'id' => 2110,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1055,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/022319a6924342cb9d20a55a2bb3ea5e_34380/preview_video_talk_2.mp4',
            ),
            110 => 
            array (
                'id' => 2111,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1056,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2322f9adec6647d9a6c8fb20ca326204_34390/preview_talk_2.webp',
            ),
            111 => 
            array (
                'id' => 2112,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1056,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2322f9adec6647d9a6c8fb20ca326204_34390/preview_video_talk_2.mp4',
            ),
            112 => 
            array (
                'id' => 2113,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1057,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7dd586797b57486084c509fb0c20930f_34400/preview_talk_2.webp',
            ),
            113 => 
            array (
                'id' => 2114,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1057,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7dd586797b57486084c509fb0c20930f_34400/preview_video_talk_2.mp4',
            ),
            114 => 
            array (
                'id' => 2115,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1058,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/51267c0f0f2045518a8c66bb1709bf2a_2654/preview_target.webp',
            ),
            115 => 
            array (
                'id' => 2116,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1058,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/51267c0f0f2045518a8c66bb1709bf2a_2654/preview_video_target.mp4',
            ),
            116 => 
            array (
                'id' => 2117,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1059,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4233989bd7a744ffba03f17a438a256a_48340/preview_talk_1.webp',
            ),
            117 => 
            array (
                'id' => 2118,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1059,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4233989bd7a744ffba03f17a438a256a_48340/preview_video_talk_1.mp4',
            ),
            118 => 
            array (
                'id' => 2119,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1060,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c88381419d6d4318aabdf066aea096b1_45960/preview_talk_1.webp',
            ),
            119 => 
            array (
                'id' => 2120,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1060,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c88381419d6d4318aabdf066aea096b1_45960/preview_video_talk_1.mp4',
            ),
            120 => 
            array (
                'id' => 2121,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1061,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3361373eff2c466f88f1a2797668b018_48350/preview_target.webp',
            ),
            121 => 
            array (
                'id' => 2122,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1061,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3361373eff2c466f88f1a2797668b018_48350/preview_video_target.mp4',
            ),
            122 => 
            array (
                'id' => 2123,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1062,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6a3fe9b7ed64889a76387bd70e36b37_48340/preview_target.webp',
            ),
            123 => 
            array (
                'id' => 2124,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1062,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c6a3fe9b7ed64889a76387bd70e36b37_48340/preview_video_target.mp4',
            ),
            124 => 
            array (
                'id' => 2125,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1063,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a92f50e226da436b8d9169a4d3084c3f_45960/preview_talk_2.webp',
            ),
            125 => 
            array (
                'id' => 2126,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1063,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a92f50e226da436b8d9169a4d3084c3f_45960/preview_video_talk_2.mp4',
            ),
            126 => 
            array (
                'id' => 2127,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1064,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c24b776620094c2db9c0366160cec82d_48320/preview_talk_1.webp',
            ),
            127 => 
            array (
                'id' => 2128,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1064,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c24b776620094c2db9c0366160cec82d_48320/preview_video_talk_1.mp4',
            ),
            128 => 
            array (
                'id' => 2129,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1065,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1509c4fc0cc5444188561aa6c02d761b_46190/preview_talk_2.webp',
            ),
            129 => 
            array (
                'id' => 2130,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1065,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1509c4fc0cc5444188561aa6c02d761b_46190/preview_video_talk_2.mp4',
            ),
            130 => 
            array (
                'id' => 2131,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1066,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c326a7d470be4cd0b949cde567a68567_14857/preview_talk_5.webp',
            ),
            131 => 
            array (
                'id' => 2132,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1066,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c326a7d470be4cd0b949cde567a68567_14857/preview_video_talk_5.mp4',
            ),
            132 => 
            array (
                'id' => 2133,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1067,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c326a7d470be4cd0b949cde567a68567_14857/preview_target.webp',
            ),
            133 => 
            array (
                'id' => 2134,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1067,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c326a7d470be4cd0b949cde567a68567_14857/preview_video_target.mp4',
            ),
            134 => 
            array (
                'id' => 2135,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1068,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fcd327bcfd654842b64f0a2eafff9d4b_45740/preview_target.webp',
            ),
            135 => 
            array (
                'id' => 2136,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1068,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/fcd327bcfd654842b64f0a2eafff9d4b_45740/preview_video_target.mp4',
            ),
            136 => 
            array (
                'id' => 2137,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1069,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/92c0f5925e6e4a90b77970fc7f7c1945_45270/preview_target.webp',
            ),
            137 => 
            array (
                'id' => 2138,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1069,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/92c0f5925e6e4a90b77970fc7f7c1945_45270/preview_video_target.mp4',
            ),
            138 => 
            array (
                'id' => 2139,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1070,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49442ddc578f452cbcf29c2eb414e55c_45750/preview_target.webp',
            ),
            139 => 
            array (
                'id' => 2140,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1070,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/49442ddc578f452cbcf29c2eb414e55c_45750/preview_video_target.mp4',
            ),
            140 => 
            array (
                'id' => 2141,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1071,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/080e0d3b42474117bb95ed72d710c024_45260/preview_talk_1.webp',
            ),
            141 => 
            array (
                'id' => 2142,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1071,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/080e0d3b42474117bb95ed72d710c024_45260/preview_video_talk_1.mp4',
            ),
            142 => 
            array (
                'id' => 2143,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1072,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/62d76dab37344c3ead7b9b1878740253_45760/preview_talk_1.webp',
            ),
            143 => 
            array (
                'id' => 2144,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1072,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/62d76dab37344c3ead7b9b1878740253_45760/preview_video_talk_1.mp4',
            ),
            144 => 
            array (
                'id' => 2145,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1073,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/443080c52a90427eaa37e7d88e3aaf94_45770/preview_talk_2.webp',
            ),
            145 => 
            array (
                'id' => 2146,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1073,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/443080c52a90427eaa37e7d88e3aaf94_45770/preview_video_talk_2.mp4',
            ),
            146 => 
            array (
                'id' => 2147,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1074,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/804201392f074f23aa895748049b739c_45760/preview_talk_2.webp',
            ),
            147 => 
            array (
                'id' => 2148,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1074,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/804201392f074f23aa895748049b739c_45760/preview_video_talk_2.mp4',
            ),
            148 => 
            array (
                'id' => 2149,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1075,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbe0810db99e480a9c32d0548e8af687_45770/preview_talk_1.webp',
            ),
            149 => 
            array (
                'id' => 2150,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1075,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/dbe0810db99e480a9c32d0548e8af687_45770/preview_video_talk_1.mp4',
            ),
            150 => 
            array (
                'id' => 2151,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1076,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/70912c8e123d424ab3aca412d1c90ffa_45760/preview_target.webp',
            ),
            151 => 
            array (
                'id' => 2152,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1076,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/70912c8e123d424ab3aca412d1c90ffa_45760/preview_video_target.mp4',
            ),
            152 => 
            array (
                'id' => 2153,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1077,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c7ea16acf92424889919cb2f508bb62_45770/preview_target.webp',
            ),
            153 => 
            array (
                'id' => 2154,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1077,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7c7ea16acf92424889919cb2f508bb62_45770/preview_video_target.mp4',
            ),
            154 => 
            array (
                'id' => 2155,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1078,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9661e2e3108f4ea182429fbc2fb7e777_45270/preview_talk_2.webp',
            ),
            155 => 
            array (
                'id' => 2156,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1078,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9661e2e3108f4ea182429fbc2fb7e777_45270/preview_video_talk_2.mp4',
            ),
            156 => 
            array (
                'id' => 2157,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1079,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d9d5af955f34e8091528b3f5ea6bdd2_45260/preview_talk_2.webp',
            ),
            157 => 
            array (
                'id' => 2158,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1079,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d9d5af955f34e8091528b3f5ea6bdd2_45260/preview_video_talk_2.mp4',
            ),
            158 => 
            array (
                'id' => 2159,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1080,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e2ebd7fc67994cf9870c8a2226ea2fef_45270/preview_talk_1.webp',
            ),
            159 => 
            array (
                'id' => 2160,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1080,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e2ebd7fc67994cf9870c8a2226ea2fef_45270/preview_video_talk_1.mp4',
            ),
            160 => 
            array (
                'id' => 2161,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1081,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/69f7bbca82d84d4c945b93b1fb01798f_45260/preview_target.webp',
            ),
            161 => 
            array (
                'id' => 2162,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1081,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/69f7bbca82d84d4c945b93b1fb01798f_45260/preview_video_target.mp4',
            ),
            162 => 
            array (
                'id' => 2163,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1082,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59f9b51a1c3c4218a74dd324b0ac9e1e_13310/preview_talk_1.webp',
            ),
            163 => 
            array (
                'id' => 2164,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1082,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59f9b51a1c3c4218a74dd324b0ac9e1e_13310/preview_video_talk_1.mp4',
            ),
            164 => 
            array (
                'id' => 2165,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1083,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59f9b51a1c3c4218a74dd324b0ac9e1e_13310/preview_talk_4.webp',
            ),
            165 => 
            array (
                'id' => 2166,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1083,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/59f9b51a1c3c4218a74dd324b0ac9e1e_13310/preview_video_talk_4.mp4',
            ),
            166 => 
            array (
                'id' => 2167,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1084,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7425ff40f38498085030cafa8108034_14757/preview_talk_5.webp',
            ),
            167 => 
            array (
                'id' => 2168,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1084,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7425ff40f38498085030cafa8108034_14757/preview_video_talk_5.mp4',
            ),
            168 => 
            array (
                'id' => 2169,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1085,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7425ff40f38498085030cafa8108034_14757/preview_talk_1.webp',
            ),
            169 => 
            array (
                'id' => 2170,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1085,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e7425ff40f38498085030cafa8108034_14757/preview_video_talk_1.mp4',
            ),
            170 => 
            array (
                'id' => 2171,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1086,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d64ba0e79efb4f7b8b156d429b035ae0_18200/preview_talk_2.webp',
            ),
            171 => 
            array (
                'id' => 2172,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1086,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d64ba0e79efb4f7b8b156d429b035ae0_18200/preview_video_talk_2.mp4',
            ),
            172 => 
            array (
                'id' => 2173,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1087,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3266036ba1f427c8c3267f894006e11_18200/preview_talk_4.webp',
            ),
            173 => 
            array (
                'id' => 2174,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1087,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e3266036ba1f427c8c3267f894006e11_18200/preview_video_talk_4.mp4',
            ),
            174 => 
            array (
                'id' => 2175,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1088,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/71c4aa021e6f4b10b0b1b4bb3742b8c4_18200/preview_target.webp',
            ),
            175 => 
            array (
                'id' => 2176,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1088,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/71c4aa021e6f4b10b0b1b4bb3742b8c4_18200/preview_video_target.mp4',
            ),
            176 => 
            array (
                'id' => 2177,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1089,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad5ddeb5b3b2417c8474fc2f3b93af72_16270/preview_target.webp',
            ),
            177 => 
            array (
                'id' => 2178,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1089,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ad5ddeb5b3b2417c8474fc2f3b93af72_16270/preview_video_target.mp4',
            ),
            178 => 
            array (
                'id' => 2179,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1090,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8c5b23e75d7c4584a0cbb8471fd7ac17_16270/preview_talk_2.webp',
            ),
            179 => 
            array (
                'id' => 2180,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1090,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8c5b23e75d7c4584a0cbb8471fd7ac17_16270/preview_video_talk_2.mp4',
            ),
            180 => 
            array (
                'id' => 2181,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1091,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/12c23ceab7ca4022824e1d20c48efdcf_16270/preview_talk_4.webp',
            ),
            181 => 
            array (
                'id' => 2182,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1091,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/12c23ceab7ca4022824e1d20c48efdcf_16270/preview_video_talk_4.mp4',
            ),
            182 => 
            array (
                'id' => 2183,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1092,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/89e785397e134e74b9d151cef186fd18_42170/preview_target.webp',
            ),
            183 => 
            array (
                'id' => 2184,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1092,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/89e785397e134e74b9d151cef186fd18_42170/preview_video_target.mp4',
            ),
            184 => 
            array (
                'id' => 2185,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1093,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/460be1b4e464490aac05dd49a015fc36_42160/preview_target.webp',
            ),
            185 => 
            array (
                'id' => 2186,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1093,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/460be1b4e464490aac05dd49a015fc36_42160/preview_video_target.mp4',
            ),
            186 => 
            array (
                'id' => 2187,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1094,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea9dbb4e93064b91998f52ce4ce4dbe1_43160/preview_talk_1.webp',
            ),
            187 => 
            array (
                'id' => 2188,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1094,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea9dbb4e93064b91998f52ce4ce4dbe1_43160/preview_video_talk_1.mp4',
            ),
            188 => 
            array (
                'id' => 2189,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1095,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1e698e3842864d18b5150798de032a29_42200/preview_target.webp',
            ),
            189 => 
            array (
                'id' => 2190,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1095,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1e698e3842864d18b5150798de032a29_42200/preview_video_target.mp4',
            ),
            190 => 
            array (
                'id' => 2191,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1096,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b85308fcc45649a59de48e1bc3d33c36_42130/preview_target.webp',
            ),
            191 => 
            array (
                'id' => 2192,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1096,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b85308fcc45649a59de48e1bc3d33c36_42130/preview_video_target.mp4',
            ),
            192 => 
            array (
                'id' => 2193,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1097,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef074452bf15468e8bc3da2899696ac9_42210/preview_talk_2.webp',
            ),
            193 => 
            array (
                'id' => 2194,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1097,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ef074452bf15468e8bc3da2899696ac9_42210/preview_video_talk_2.mp4',
            ),
            194 => 
            array (
                'id' => 2195,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1098,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e2811ccbb3b247fabf76a93d288a75a6_43160/preview_target.webp',
            ),
            195 => 
            array (
                'id' => 2196,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1098,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e2811ccbb3b247fabf76a93d288a75a6_43160/preview_video_target.mp4',
            ),
            196 => 
            array (
                'id' => 2197,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1099,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/62f72ca3ed5d4ea29fb67ebe233028c8_42140/preview_target.webp',
            ),
            197 => 
            array (
                'id' => 2198,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1099,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/62f72ca3ed5d4ea29fb67ebe233028c8_42140/preview_video_target.mp4',
            ),
            198 => 
            array (
                'id' => 2199,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1100,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1959775809d7446294b1dc722a9a23a3_42200/preview_talk_1.webp',
            ),
            199 => 
            array (
                'id' => 2200,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1100,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1959775809d7446294b1dc722a9a23a3_42200/preview_video_talk_1.mp4',
            ),
            200 => 
            array (
                'id' => 2201,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1101,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/481794844cf140e6a6d0f36e74d65315_42210/preview_talk_1.webp',
            ),
            201 => 
            array (
                'id' => 2202,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1101,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/481794844cf140e6a6d0f36e74d65315_42210/preview_video_talk_1.mp4',
            ),
            202 => 
            array (
                'id' => 2203,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1102,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed1a51a567dd477cb274621e36a11ad3_42220/preview_target.webp',
            ),
            203 => 
            array (
                'id' => 2204,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1102,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ed1a51a567dd477cb274621e36a11ad3_42220/preview_video_target.mp4',
            ),
            204 => 
            array (
                'id' => 2205,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1103,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/096643a51ba74748abdf53f77c804fd8_42150/preview_target.webp',
            ),
            205 => 
            array (
                'id' => 2206,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1103,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/096643a51ba74748abdf53f77c804fd8_42150/preview_video_target.mp4',
            ),
            206 => 
            array (
                'id' => 2207,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1104,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3aceb5e1b2cc4cc5993d703220dd9bf8_34960/preview_target.webp',
            ),
            207 => 
            array (
                'id' => 2208,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1104,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3aceb5e1b2cc4cc5993d703220dd9bf8_34960/preview_video_target.mp4',
            ),
            208 => 
            array (
                'id' => 2209,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1105,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e79c1ae85ac94afb9f0fbde8a68b4db4_34970/preview_target.webp',
            ),
            209 => 
            array (
                'id' => 2210,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1105,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e79c1ae85ac94afb9f0fbde8a68b4db4_34970/preview_video_target.mp4',
            ),
            210 => 
            array (
                'id' => 2211,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1106,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea0b6f61b0c54fafb25984cb944b5069_34980/preview_target.webp',
            ),
            211 => 
            array (
                'id' => 2212,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1106,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ea0b6f61b0c54fafb25984cb944b5069_34980/preview_video_target.mp4',
            ),
            212 => 
            array (
                'id' => 2213,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1107,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/be2e19842ffb406a994d78c624a05ada_47190/preview_target.webp',
            ),
            213 => 
            array (
                'id' => 2214,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1107,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/be2e19842ffb406a994d78c624a05ada_47190/preview_video_target.mp4',
            ),
            214 => 
            array (
                'id' => 2215,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1108,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbf1739a848e41cc92b7e888195fe9f0_47930/preview_target.webp',
            ),
            215 => 
            array (
                'id' => 2216,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1108,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cbf1739a848e41cc92b7e888195fe9f0_47930/preview_video_target.mp4',
            ),
            216 => 
            array (
                'id' => 2217,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1109,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2fb44fa7ea0c4ba7bbbada51d687e96e_47960/preview_target.webp',
            ),
            217 => 
            array (
                'id' => 2218,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1109,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2fb44fa7ea0c4ba7bbbada51d687e96e_47960/preview_video_target.mp4',
            ),
            218 => 
            array (
                'id' => 2219,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1110,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b9ea37604b94cfeb32903c1ed2234c2_47200/preview_target.webp',
            ),
            219 => 
            array (
                'id' => 2220,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1110,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3b9ea37604b94cfeb32903c1ed2234c2_47200/preview_video_target.mp4',
            ),
            220 => 
            array (
                'id' => 2221,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1111,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/797c7a3c48104002b3e91f55f2a53067_47940/preview_target.webp',
            ),
            221 => 
            array (
                'id' => 2222,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1111,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/797c7a3c48104002b3e91f55f2a53067_47940/preview_video_target.mp4',
            ),
            222 => 
            array (
                'id' => 2223,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1112,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5162ec8fb2db41d1b624848e7aab1579_47200/preview_talk_1.webp',
            ),
            223 => 
            array (
                'id' => 2224,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1112,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5162ec8fb2db41d1b624848e7aab1579_47200/preview_video_talk_1.mp4',
            ),
            224 => 
            array (
                'id' => 2225,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1113,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/341378ee6556423c835a4ac0dcd66abc_47950/preview_target.webp',
            ),
            225 => 
            array (
                'id' => 2226,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1113,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/341378ee6556423c835a4ac0dcd66abc_47950/preview_video_target.mp4',
            ),
            226 => 
            array (
                'id' => 2227,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1114,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec2ac8be5bf340db835a3317d67ea0f6_47180/preview_target.webp',
            ),
            227 => 
            array (
                'id' => 2228,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1114,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ec2ac8be5bf340db835a3317d67ea0f6_47180/preview_video_target.mp4',
            ),
            228 => 
            array (
                'id' => 2229,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1115,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cb8970e1e10141f6a7ff6bf2fc2eefdd_45910/preview_talk_2.webp',
            ),
            229 => 
            array (
                'id' => 2230,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1115,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cb8970e1e10141f6a7ff6bf2fc2eefdd_45910/preview_video_talk_2.mp4',
            ),
            230 => 
            array (
                'id' => 2231,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1116,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/95fb8526c7e34bbdad5658ff0dbf27d0_48640/preview_talk_1.webp',
            ),
            231 => 
            array (
                'id' => 2232,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1116,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/95fb8526c7e34bbdad5658ff0dbf27d0_48640/preview_video_talk_1.mp4',
            ),
            232 => 
            array (
                'id' => 2233,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1117,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/54bde094ff504ba181d641bd16689ecb_45920/preview_target.webp',
            ),
            233 => 
            array (
                'id' => 2234,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1117,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/54bde094ff504ba181d641bd16689ecb_45920/preview_video_target.mp4',
            ),
            234 => 
            array (
                'id' => 2235,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1118,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5393508e61154f86af3d5d303dcd0705_47810/preview_target.webp',
            ),
            235 => 
            array (
                'id' => 2236,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1118,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5393508e61154f86af3d5d303dcd0705_47810/preview_video_target.mp4',
            ),
            236 => 
            array (
                'id' => 2237,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1119,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/138a39cb5b794709a543f4ddb70f08f1_48280/preview_target.webp',
            ),
            237 => 
            array (
                'id' => 2238,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1119,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/138a39cb5b794709a543f4ddb70f08f1_48280/preview_video_target.mp4',
            ),
            238 => 
            array (
                'id' => 2239,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1120,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e8e19bc909f24c24a0956f4528e5faa7_46590/preview_talk_1.webp',
            ),
            239 => 
            array (
                'id' => 2240,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1120,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e8e19bc909f24c24a0956f4528e5faa7_46590/preview_video_talk_1.mp4',
            ),
            240 => 
            array (
                'id' => 2241,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1121,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a63591deb71d40f29b082f8ba37770cf_48270/preview_target.webp',
            ),
            241 => 
            array (
                'id' => 2242,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1121,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a63591deb71d40f29b082f8ba37770cf_48270/preview_video_target.mp4',
            ),
            242 => 
            array (
                'id' => 2243,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1122,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/44e21323366e4ec090e4842f22d809a3_45060/preview_target.webp',
            ),
            243 => 
            array (
                'id' => 2244,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1122,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/44e21323366e4ec090e4842f22d809a3_45060/preview_video_target.mp4',
            ),
            244 => 
            array (
                'id' => 2245,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1123,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/952cdab029a2486aa4607aad95219927_44880/preview_target.webp',
            ),
            245 => 
            array (
                'id' => 2246,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1123,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/952cdab029a2486aa4607aad95219927_44880/preview_video_target.mp4',
            ),
            246 => 
            array (
                'id' => 2247,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1124,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cd941d947b4d4a4daaefa467ef6684e9_46420/preview_target.webp',
            ),
            247 => 
            array (
                'id' => 2248,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1124,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cd941d947b4d4a4daaefa467ef6684e9_46420/preview_video_target.mp4',
            ),
            248 => 
            array (
                'id' => 2249,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1125,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f91459962a364969aef913e10e3694c0_45690/preview_talk_2.webp',
            ),
            249 => 
            array (
                'id' => 2250,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1125,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f91459962a364969aef913e10e3694c0_45690/preview_video_talk_2.mp4',
            ),
            250 => 
            array (
                'id' => 2251,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1126,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6588befdd56f48df837e401a5c4da40e_45710/preview_target.webp',
            ),
            251 => 
            array (
                'id' => 2252,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1126,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6588befdd56f48df837e401a5c4da40e_45710/preview_video_target.mp4',
            ),
            252 => 
            array (
                'id' => 2253,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1127,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ffc94dccec8d421bbf3202213cef54c0_45690/preview_target.webp',
            ),
            253 => 
            array (
                'id' => 2254,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1127,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ffc94dccec8d421bbf3202213cef54c0_45690/preview_video_target.mp4',
            ),
            254 => 
            array (
                'id' => 2255,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1128,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f90306f2d74f4a99a2f4a0a3b8fafb0b_44890/preview_talk_2.webp',
            ),
            255 => 
            array (
                'id' => 2256,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1128,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f90306f2d74f4a99a2f4a0a3b8fafb0b_44890/preview_video_talk_2.mp4',
            ),
            256 => 
            array (
                'id' => 2257,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1129,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0389fc0a88df45d09151a719ad697a5f_45730/preview_talk_1.webp',
            ),
            257 => 
            array (
                'id' => 2258,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1129,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0389fc0a88df45d09151a719ad697a5f_45730/preview_video_talk_1.mp4',
            ),
            258 => 
            array (
                'id' => 2259,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1130,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2470140cbd5246fa8ac3c1ade076ba86_44900/preview_target.webp',
            ),
            259 => 
            array (
                'id' => 2260,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1130,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2470140cbd5246fa8ac3c1ade076ba86_44900/preview_video_target.mp4',
            ),
            260 => 
            array (
                'id' => 2261,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1131,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ccdadf0a61a4d4780d2c862055f521d_44890/preview_talk_1.webp',
            ),
            261 => 
            array (
                'id' => 2262,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1131,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2ccdadf0a61a4d4780d2c862055f521d_44890/preview_video_talk_1.mp4',
            ),
            262 => 
            array (
                'id' => 2263,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1132,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3355b47ef7084bff99a386bb92ca7bc5_45730/preview_target.webp',
            ),
            263 => 
            array (
                'id' => 2264,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1132,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3355b47ef7084bff99a386bb92ca7bc5_45730/preview_video_target.mp4',
            ),
            264 => 
            array (
                'id' => 2265,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1133,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6c57ef81cca44edf8adae37f109098b5_44900/preview_talk_2.webp',
            ),
            265 => 
            array (
                'id' => 2266,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1133,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6c57ef81cca44edf8adae37f109098b5_44900/preview_video_talk_2.mp4',
            ),
            266 => 
            array (
                'id' => 2267,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1134,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5bf46b1f2b144419b398a2d03678c0f_45550/preview_target.webp',
            ),
            267 => 
            array (
                'id' => 2268,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1134,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d5bf46b1f2b144419b398a2d03678c0f_45550/preview_video_target.mp4',
            ),
            268 => 
            array (
                'id' => 2269,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1135,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3fc7194dc44943709502dccdd8ae812b_45560/preview_target.webp',
            ),
            269 => 
            array (
                'id' => 2270,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1135,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3fc7194dc44943709502dccdd8ae812b_45560/preview_video_target.mp4',
            ),
            270 => 
            array (
                'id' => 2271,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1136,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8292035385c94619a5715cc8fc7fd255_44890/preview_target.webp',
            ),
            271 => 
            array (
                'id' => 2272,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1136,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8292035385c94619a5715cc8fc7fd255_44890/preview_video_target.mp4',
            ),
            272 => 
            array (
                'id' => 2273,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1137,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/63c8757eed4e405aaa7b945355a0fdd0_44900/preview_talk_1.webp',
            ),
            273 => 
            array (
                'id' => 2274,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1137,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/63c8757eed4e405aaa7b945355a0fdd0_44900/preview_video_talk_1.mp4',
            ),
            274 => 
            array (
                'id' => 2275,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1138,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f2a74c7c295149518c3048efe8c25b0f_45060/preview_talk_1.webp',
            ),
            275 => 
            array (
                'id' => 2276,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1138,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/f2a74c7c295149518c3048efe8c25b0f_45060/preview_video_talk_1.mp4',
            ),
            276 => 
            array (
                'id' => 2277,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1139,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b22fb15b75e4e60ae50f3559259b818_44880/preview_talk_1.webp',
            ),
            277 => 
            array (
                'id' => 2278,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1139,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b22fb15b75e4e60ae50f3559259b818_44880/preview_video_talk_1.mp4',
            ),
            278 => 
            array (
                'id' => 2279,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1140,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5ea6e259de514d50905cdfc5cd1d3554_15278/preview_talk_5.webp',
            ),
            279 => 
            array (
                'id' => 2280,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1140,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5ea6e259de514d50905cdfc5cd1d3554_15278/preview_video_talk_5.mp4',
            ),
            280 => 
            array (
                'id' => 2281,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1141,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/075e21343582402892ceec9744dba2fe_15278/preview_talk_3.webp',
            ),
            281 => 
            array (
                'id' => 2282,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1141,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/075e21343582402892ceec9744dba2fe_15278/preview_video_talk_3.mp4',
            ),
            282 => 
            array (
                'id' => 2283,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1142,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/446572d3d2174b3b9245c966fe183207_15278/preview_target.webp',
            ),
            283 => 
            array (
                'id' => 2284,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1142,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/446572d3d2174b3b9245c966fe183207_15278/preview_video_target.mp4',
            ),
            284 => 
            array (
                'id' => 2285,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1143,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5dc05aef0295473da983300f43abf7fd_17860/preview_talk_5.webp',
            ),
            285 => 
            array (
                'id' => 2286,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1143,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/5dc05aef0295473da983300f43abf7fd_17860/preview_video_talk_5.mp4',
            ),
            286 => 
            array (
                'id' => 2287,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1144,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc39522acd1a4a8694847d655d8c1540_17860/preview_target.webp',
            ),
            287 => 
            array (
                'id' => 2288,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1144,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cc39522acd1a4a8694847d655d8c1540_17860/preview_video_target.mp4',
            ),
            288 => 
            array (
                'id' => 2289,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1145,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4ea29d1f60c1497bae28bdce8a4cc07c_17860/preview_talk_2.webp',
            ),
            289 => 
            array (
                'id' => 2290,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1145,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4ea29d1f60c1497bae28bdce8a4cc07c_17860/preview_video_talk_2.mp4',
            ),
            290 => 
            array (
                'id' => 2291,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1146,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0849ce36668940cb998f49d37748ea5e_47260/preview_talk_1.webp',
            ),
            291 => 
            array (
                'id' => 2292,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1146,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/0849ce36668940cb998f49d37748ea5e_47260/preview_video_talk_1.mp4',
            ),
            292 => 
            array (
                'id' => 2293,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1147,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ff20f3298057456b98c2e48bf166aa8e_47260/preview_target.webp',
            ),
            293 => 
            array (
                'id' => 2294,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1147,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/ff20f3298057456b98c2e48bf166aa8e_47260/preview_video_target.mp4',
            ),
            294 => 
            array (
                'id' => 2295,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1148,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/639cfed50c3449d79b2b4deeab1aa7a3_47270/preview_talk_1.webp',
            ),
            295 => 
            array (
                'id' => 2296,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1148,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/639cfed50c3449d79b2b4deeab1aa7a3_47270/preview_video_talk_1.mp4',
            ),
            296 => 
            array (
                'id' => 2297,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1149,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/eaaa19323f33498a9f417d70731e8b01_47270/preview_talk_2.webp',
            ),
            297 => 
            array (
                'id' => 2298,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1149,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/eaaa19323f33498a9f417d70731e8b01_47270/preview_video_talk_2.mp4',
            ),
            298 => 
            array (
                'id' => 2299,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1150,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3957df30e5f43ef98ea54a78fa99586_47260/preview_talk_2.webp',
            ),
            299 => 
            array (
                'id' => 2300,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1150,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3957df30e5f43ef98ea54a78fa99586_47260/preview_video_talk_2.mp4',
            ),
            300 => 
            array (
                'id' => 2301,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1151,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d78b66af29f74ea6a652b7b97c5cc7bd_47270/preview_target.webp',
            ),
            301 => 
            array (
                'id' => 2302,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1151,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d78b66af29f74ea6a652b7b97c5cc7bd_47270/preview_video_target.mp4',
            ),
            302 => 
            array (
                'id' => 2303,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1152,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d834524455e4a709e41b0da3aee3d7e_47670/preview_talk_1.webp',
            ),
            303 => 
            array (
                'id' => 2304,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1152,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4d834524455e4a709e41b0da3aee3d7e_47670/preview_video_talk_1.mp4',
            ),
            304 => 
            array (
                'id' => 2305,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1153,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3ee9776df2ad4415ac7878feef00c7fc_47670/preview_target.webp',
            ),
            305 => 
            array (
                'id' => 2306,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1153,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/3ee9776df2ad4415ac7878feef00c7fc_47670/preview_video_target.mp4',
            ),
            306 => 
            array (
                'id' => 2307,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1154,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00af0421f5bc4a84bb46754f595bf05a_47680/preview_talk_2.webp',
            ),
            307 => 
            array (
                'id' => 2308,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1154,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00af0421f5bc4a84bb46754f595bf05a_47680/preview_video_talk_2.mp4',
            ),
            308 => 
            array (
                'id' => 2309,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1155,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/648c75f23af548a9aea63ddd908b9851_47680/preview_talk_1.webp',
            ),
            309 => 
            array (
                'id' => 2310,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1155,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/648c75f23af548a9aea63ddd908b9851_47680/preview_video_talk_1.mp4',
            ),
            310 => 
            array (
                'id' => 2311,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1156,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/691a1ab64ca74aff83d5b258c1881e6d_47680/preview_target.webp',
            ),
            311 => 
            array (
                'id' => 2312,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1156,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/691a1ab64ca74aff83d5b258c1881e6d_47680/preview_video_target.mp4',
            ),
            312 => 
            array (
                'id' => 2313,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1157,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/02c97e4ea76a416484a2dbdff50e82a9_47280/preview_target.webp',
            ),
            313 => 
            array (
                'id' => 2314,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1157,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/02c97e4ea76a416484a2dbdff50e82a9_47280/preview_video_target.mp4',
            ),
            314 => 
            array (
                'id' => 2315,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1158,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/86b985536eda4927988209d6788ab7c1_47300/preview_target.webp',
            ),
            315 => 
            array (
                'id' => 2316,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1158,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/86b985536eda4927988209d6788ab7c1_47300/preview_video_target.mp4',
            ),
            316 => 
            array (
                'id' => 2317,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1159,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b4d01ae899e64dbebcc3e2a3399cb56e_47290/preview_talk_1.webp',
            ),
            317 => 
            array (
                'id' => 2318,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1159,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b4d01ae899e64dbebcc3e2a3399cb56e_47290/preview_video_talk_1.mp4',
            ),
            318 => 
            array (
                'id' => 2319,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1160,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/eb0309ca6c8145aa9fc83d4a03495077_47310/preview_talk_1.webp',
            ),
            319 => 
            array (
                'id' => 2320,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1160,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/eb0309ca6c8145aa9fc83d4a03495077_47310/preview_video_talk_1.mp4',
            ),
            320 => 
            array (
                'id' => 2321,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1161,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3a0e8e360d9444eb4c9e67b5b05e417_47290/preview_target.webp',
            ),
            321 => 
            array (
                'id' => 2322,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1161,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a3a0e8e360d9444eb4c9e67b5b05e417_47290/preview_video_target.mp4',
            ),
            322 => 
            array (
                'id' => 2323,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1162,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0301de245614a3c84417cd88dffa276_14677/preview_talk_4.webp',
            ),
            323 => 
            array (
                'id' => 2324,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1162,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0301de245614a3c84417cd88dffa276_14677/preview_video_talk_4.mp4',
            ),
            324 => 
            array (
                'id' => 2325,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1163,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0301de245614a3c84417cd88dffa276_14677/preview_target.webp',
            ),
            325 => 
            array (
                'id' => 2326,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1163,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0301de245614a3c84417cd88dffa276_14677/preview_video_target.mp4',
            ),
            326 => 
            array (
                'id' => 2327,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1164,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0301de245614a3c84417cd88dffa276_14677/preview_talk_2.webp',
            ),
            327 => 
            array (
                'id' => 2328,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1164,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e0301de245614a3c84417cd88dffa276_14677/preview_video_talk_2.mp4',
            ),
            328 => 
            array (
                'id' => 2329,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1165,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/28f8c854f95e4e518ff9470028ef0c2c_20470/preview_talk_5.webp',
            ),
            329 => 
            array (
                'id' => 2330,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1165,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/28f8c854f95e4e518ff9470028ef0c2c_20470/preview_video_talk_5.mp4',
            ),
            330 => 
            array (
                'id' => 2331,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1166,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/acdf79c5062b4f8580ec4d5672419cfd_20470/preview_talk_1.webp',
            ),
            331 => 
            array (
                'id' => 2332,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1166,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/acdf79c5062b4f8580ec4d5672419cfd_20470/preview_video_talk_1.mp4',
            ),
            332 => 
            array (
                'id' => 2333,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1167,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/feca55a0d4c14ff48fb563ccc009c3cd_20470/preview_talk_4.webp',
            ),
            333 => 
            array (
                'id' => 2334,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1167,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/feca55a0d4c14ff48fb563ccc009c3cd_20470/preview_video_talk_4.mp4',
            ),
            334 => 
            array (
                'id' => 2335,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1168,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00d3b6f510e54748a7e1160a2ac6ab72_20470/preview_talk_3.webp',
            ),
            335 => 
            array (
                'id' => 2336,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1168,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00d3b6f510e54748a7e1160a2ac6ab72_20470/preview_video_talk_3.mp4',
            ),
            336 => 
            array (
                'id' => 2337,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1169,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cb54e51ab5d14f7486183f8134d2d7bc_42280/preview_target.webp',
            ),
            337 => 
            array (
                'id' => 2338,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1169,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/cb54e51ab5d14f7486183f8134d2d7bc_42280/preview_video_target.mp4',
            ),
            338 => 
            array (
                'id' => 2339,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1170,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f3f441889d142048906647bdfb47fb2_42360/preview_talk_1.webp',
            ),
            339 => 
            array (
                'id' => 2340,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1170,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4f3f441889d142048906647bdfb47fb2_42360/preview_video_talk_1.mp4',
            ),
            340 => 
            array (
                'id' => 2341,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1171,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bf44d8896af14612bace5a4b0fe5418d_42270/preview_talk_2.webp',
            ),
            341 => 
            array (
                'id' => 2342,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1171,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/bf44d8896af14612bace5a4b0fe5418d_42270/preview_video_talk_2.mp4',
            ),
            342 => 
            array (
                'id' => 2343,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1172,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e730fc5471e041e8af66b2af6d4e9674_42280/preview_talk_3.webp',
            ),
            343 => 
            array (
                'id' => 2344,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1172,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/e730fc5471e041e8af66b2af6d4e9674_42280/preview_video_talk_3.mp4',
            ),
            344 => 
            array (
                'id' => 2345,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1173,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d2351661ad9544fe96a6f3f7c7d28523_42360/preview_talk_2.webp',
            ),
            345 => 
            array (
                'id' => 2346,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1173,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d2351661ad9544fe96a6f3f7c7d28523_42360/preview_video_talk_2.mp4',
            ),
            346 => 
            array (
                'id' => 2347,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1174,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7211da1532624ba0a733e7830baebe1d_42370/preview_talk_1.webp',
            ),
            347 => 
            array (
                'id' => 2348,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1174,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/7211da1532624ba0a733e7830baebe1d_42370/preview_video_talk_1.mp4',
            ),
            348 => 
            array (
                'id' => 2349,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1175,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26ecd21683704123a9d439488b47e151_42360/preview_target.webp',
            ),
            349 => 
            array (
                'id' => 2350,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1175,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/26ecd21683704123a9d439488b47e151_42360/preview_video_target.mp4',
            ),
            350 => 
            array (
                'id' => 2351,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1176,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/954d5769b5a5406590cc6ec8f118ed3d_42370/preview_target.webp',
            ),
            351 => 
            array (
                'id' => 2352,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1176,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/954d5769b5a5406590cc6ec8f118ed3d_42370/preview_video_target.mp4',
            ),
            352 => 
            array (
                'id' => 2353,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1177,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60f07a8f4c874797b63e55413fb4c6d4_42270/preview_target.webp',
            ),
            353 => 
            array (
                'id' => 2354,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1177,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/60f07a8f4c874797b63e55413fb4c6d4_42270/preview_video_target.mp4',
            ),
            354 => 
            array (
                'id' => 2355,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1178,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9e720ab0f4fe4876af12b1119fa881c9_42280/preview_talk_1.webp',
            ),
            355 => 
            array (
                'id' => 2356,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1178,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9e720ab0f4fe4876af12b1119fa881c9_42280/preview_video_talk_1.mp4',
            ),
            356 => 
            array (
                'id' => 2357,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1179,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/413a17b67fd448e8928bd4e598d1e8c6_15204/preview_target.webp',
            ),
            357 => 
            array (
                'id' => 2358,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1179,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/413a17b67fd448e8928bd4e598d1e8c6_15204/preview_video_target.mp4',
            ),
            358 => 
            array (
                'id' => 2359,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1180,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2bf6af4afbc24ad0ae8e1f2f5a8ac25b_15204/preview_talk_3.webp',
            ),
            359 => 
            array (
                'id' => 2360,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1180,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/2bf6af4afbc24ad0ae8e1f2f5a8ac25b_15204/preview_video_talk_3.mp4',
            ),
            360 => 
            array (
                'id' => 2361,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1181,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/413a17b67fd448e8928bd4e598d1e8c6_15204/preview_talk_4.webp',
            ),
            361 => 
            array (
                'id' => 2362,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1181,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/413a17b67fd448e8928bd4e598d1e8c6_15204/preview_video_talk_4.mp4',
            ),
            362 => 
            array (
                'id' => 2363,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1182,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c427c8f4a1764b388a867c026b6e593f_43200/preview_talk_3.webp',
            ),
            363 => 
            array (
                'id' => 2364,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1182,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/c427c8f4a1764b388a867c026b6e593f_43200/preview_video_talk_3.mp4',
            ),
            364 => 
            array (
                'id' => 2365,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1183,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b69ce1846d2455abc4b055d621cb813_43210/preview_talk_5.webp',
            ),
            365 => 
            array (
                'id' => 2366,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1183,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/9b69ce1846d2455abc4b055d621cb813_43210/preview_video_talk_5.mp4',
            ),
            366 => 
            array (
                'id' => 2367,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1184,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4be4a55f70ac455e8938d0614725a667_43200/preview_talk_7.webp',
            ),
            367 => 
            array (
                'id' => 2368,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1184,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4be4a55f70ac455e8938d0614725a667_43200/preview_video_talk_7.mp4',
            ),
            368 => 
            array (
                'id' => 2369,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1185,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00cc713cf40642d2a2c2bf19079206ba_43210/preview_talk_8.webp',
            ),
            369 => 
            array (
                'id' => 2370,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1185,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/00cc713cf40642d2a2c2bf19079206ba_43210/preview_video_talk_8.mp4',
            ),
            370 => 
            array (
                'id' => 2371,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1186,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8287215eba254997af78eb66d9b95e2d_43200/preview_talk_2.webp',
            ),
            371 => 
            array (
                'id' => 2372,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1186,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/8287215eba254997af78eb66d9b95e2d_43200/preview_video_talk_2.mp4',
            ),
            372 => 
            array (
                'id' => 2373,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1187,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db021f1343a04ed3b818268268948ae4_43210/preview_talk_3.webp',
            ),
            373 => 
            array (
                'id' => 2374,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1187,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/db021f1343a04ed3b818268268948ae4_43210/preview_video_talk_3.mp4',
            ),
            374 => 
            array (
                'id' => 2375,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1188,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4bc8ef5ac61446faa6c540f0eb39f6f3_43200/preview_target.webp',
            ),
            375 => 
            array (
                'id' => 2376,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1188,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/4bc8ef5ac61446faa6c540f0eb39f6f3_43200/preview_video_target.mp4',
            ),
            376 => 
            array (
                'id' => 2377,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1189,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/859dc28cba1c422a9171ffd6dece244c_43210/preview_target.webp',
            ),
            377 => 
            array (
                'id' => 2378,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1189,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/859dc28cba1c422a9171ffd6dece244c_43210/preview_video_target.mp4',
            ),
            378 => 
            array (
                'id' => 2379,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1190,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6c581c410603496f8a150f706fc97754_43200/preview_talk_5.webp',
            ),
            379 => 
            array (
                'id' => 2380,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1190,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/6c581c410603496f8a150f706fc97754_43200/preview_video_talk_5.mp4',
            ),
            380 => 
            array (
                'id' => 2381,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1191,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1fe0ee28343e4bcfa560003f3ad3faf1_43210/preview_talk_6.webp',
            ),
            381 => 
            array (
                'id' => 2382,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1191,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/1fe0ee28343e4bcfa560003f3ad3faf1_43210/preview_video_talk_6.mp4',
            ),
            382 => 
            array (
                'id' => 2383,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1192,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d99ba541a2c9413b941fa7efe90a1130_1059/preview_target.webp',
            ),
            383 => 
            array (
                'id' => 2384,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1192,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/d99ba541a2c9413b941fa7efe90a1130_1059/preview_video_target.mp4',
            ),
            384 => 
            array (
                'id' => 2385,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1193,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2464b1b3d6d4e8d8b3695a4cbc3bba5_1434/preview_target.webp',
            ),
            385 => 
            array (
                'id' => 2386,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1193,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/b2464b1b3d6d4e8d8b3695a4cbc3bba5_1434/preview_video_target.mp4',
            ),
            386 => 
            array (
                'id' => 2387,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1194,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a0620cb143784340af00d5c9c36605c1_1430/preview_talk_2.webp',
            ),
            387 => 
            array (
                'id' => 2388,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1194,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/a0620cb143784340af00d5c9c36605c1_1430/preview_video_talk_2.mp4',
            ),
            388 => 
            array (
                'id' => 2389,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1195,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79b245561ad448e796b7e77cd2773d0b_14263/preview_talk_11.webp',
            ),
            389 => 
            array (
                'id' => 2390,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1195,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79b245561ad448e796b7e77cd2773d0b_14263/preview_video_talk_11.mp4',
            ),
            390 => 
            array (
                'id' => 2391,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1196,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79b245561ad448e796b7e77cd2773d0b_14263/preview_talk_2.webp',
            ),
            391 => 
            array (
                'id' => 2392,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1196,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79b245561ad448e796b7e77cd2773d0b_14263/preview_video_talk_2.mp4',
            ),
            392 => 
            array (
                'id' => 2393,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1197,
                'type' => 'string',
                'key' => 'image_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79b245561ad448e796b7e77cd2773d0b_14263/preview_talk_5.webp',
            ),
            393 => 
            array (
                'id' => 2394,
                'owner_type' => 'Modules\\OpenAI\\Entities\\Avatar',
                'owner_id' => 1197,
                'type' => 'string',
                'key' => 'video_url',
                'value' => 'https://files2.heygen.ai/avatar/v3/79b245561ad448e796b7e77cd2773d0b_14263/preview_video_talk_5.mp4',
            ),
        ));
    }
}