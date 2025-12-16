<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArabicTranslationsSeeder extends Seeder
{
    /**
     * الترجمات العربية لصفحة الهبوط
     * يمكنك تشغيل هذا الـ Seeder في أي وقت لاستعادة الترجمات
     * php artisan db:seed --class=ArabicTranslationsSeeder
     */
    public function run()
    {
        $this->command->info('=== بدء تحديث الترجمات العربية ===');

        // الترجمات بناءً على ID في جدول component_properties
        $updates = [
            // Hero Section - Write 10x faster...
            1619 => 'اكتب أسرع 10 مرات، وتفاعل مع جمهورك، ولا تعاني أبدًا من الصفحة الفارغة مرة أخرى. البرنامج التعاوني الأول للذكاء الاصطناعي الذي ستحتاجه.',
            
            // Image Generator - Create AI art or images...
            1458 => 'أنشئ أعمالًا فنية أو صورًا بالذكاء الاصطناعي من النص لتحوّل خيالك إلى صور فريدة خلال ثوانٍ. ستحصل أخيرًا على الصورة المثالية التي تناسب رسالتك.',
            
            // voxcraft Studio is the ultimate AI-powered...
            1564 => 'voxcraft Studio هي أداة إنشاء المحتوى المدعومة بالذكاء الاصطناعي لمساعدتك على إنشاء محتوى عالي الجودة بسرعة بأقل جهد ووقت وتكلفة.',
            
            // Unlock the power of AI...
            1576 => 'أطلق العنان لقوة الذكاء الاصطناعي من خلال تقنيتنا المتطورة التي تساعدك على إنشاء محتوى أصلي متقن ومبهج دون عناء.',
            
            // Save time and money...
            1588 => 'وفر الوقت والمال مع نظامنا الآلي الذي يمكّنك من خفض نفقاتك مع الاستمرار في تحقيق نتائج رائعة.',
            
            // The Only voxcraft Studio Intelligence Service...
            1598 => 'خدمة ذكاء voxcraft Studio <span style="color:#E22861;">الوحيدة</span> التي ستحتاج إليها على الإطلاق',
            
            // Intuitive interface and minimal learning curve...
            1599 => 'واجهة سهلة ومنحنى تعلم بسيط يجعل voxcraft Studio الخيار المثالي لأي شخص يحتاج لكتابة محتوى بسرعة دون التضحية بالجودة والوصول لأهدافك أسرع 10 مرات!',
            
            // Our Use Cases help you...
            1507 => 'تساعدك حالات الاستخدام الخاصة بنا على إنشاء محتوى عالي الكفاءة وصديق للإنسان للتطبيقات ووسائل التواصل الاجتماعي، ونصوص لمقاطع الفيديو، وتعزيز تحسين محركات البحث، وإنشاء فن رقمي بسرعة وسهولة - كل ذلك بجزء بسيط من التكلفة وفي مكان واحد!',
            
            // You can also create a custom use case...
            1508 => 'يمكنك أيضًا إنشاء حالة استخدام مخصصة وفقًا لتفضيلاتك وحفظها للاستخدام المستقبلي.',
        ];

        $totalUpdated = 0;

        foreach ($updates as $id => $newValue) {
            $updated = DB::table('component_properties')
                ->where('id', $id)
                ->update(['value' => $newValue]);
            
            if ($updated > 0) {
                $totalUpdated++;
            }
        }

        $this->command->info("✅ تم تحديث $totalUpdated ترجمة بنجاح!");
    }
}
