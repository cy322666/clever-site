<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\JsPlugin;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Widget;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'CRM Integrator',
                'phone' => '+7 (900) 123-45-67',
                'email' => 'hello@crm-integrator.test',
                'telegram_link' => 'https://t.me/example',
                'youtube_link' => 'https://youtube.com/@example',
                'vk_link' => 'https://vk.com/example',
                'max_link' => 'https://max.ru/example',
                'teletype_link' => 'https://teletype.in/@example',
                'address' => 'Калининград, ул. Примерная, 1',
                'hero_title' => 'CRM и маркетинг без потерь лидов',
                'hero_subtitle' => 'Проектируем и внедряем процессы, которые масштабируются вместе с бизнесом.',
            ]
        );

        Service::query()->delete();
        CaseStudy::query()->delete();
        Article::query()->delete();
        Widget::query()->delete();
        Testimonial::query()->delete();
        Faq::query()->delete();
        JsPlugin::query()->delete();

        Service::query()->create([
            'title' => 'Аудит CRM-процессов',
            'slug' => 'audit-crm-processes',
            'short_label' => 'CRM Аудит',
            'icon_name' => 'chart-bar',
            'short_description' => 'Разбор воронки и точек потери лидов.',
            'full_content' => 'Проводим интервью, анализируем источники лидов, выявляем узкие места и формируем дорожную карту.',
            'status' => 'published',
            'sort_order' => 10,
            'seo_title' => 'Аудит CRM-процессов',
            'seo_description' => 'Проверяем CRM, продажи и маркетинговую воронку.',
        ]);

        Service::query()->create([
            'title' => 'Сквозная аналитика и отчеты',
            'slug' => 'end-to-end-analytics',
            'short_label' => 'Аналитика',
            'icon_name' => 'presentation-chart-line',
            'short_description' => 'Объединяем рекламу, CRM и финрезультат в единую систему отчетности.',
            'full_content' => 'Настраиваем UTM-метки, источники, BI-отчеты и SLA для команды.',
            'status' => 'published',
            'sort_order' => 20,
            'seo_title' => 'Сквозная аналитика',
            'seo_description' => 'Считаем эффективность каналов до выручки.',
        ]);

        CaseStudy::query()->create([
            'title' => 'Внедрение CRM для B2B-интегратора',
            'slug' => 'crm-implementation-b2b-integrator',
            'client_name' => 'ООО Пример',
            'niche' => 'B2B услуги',
            'result_summary' => '+34% к конверсии в оплату за 3 месяца',
            'problem_block' => 'Не было единой воронки и прозрачной аналитики.',
            'solution_block' => 'Связали рекламу, CRM, телефонию и сквозные отчеты.',
            'result_block' => 'Сократили время реакции отдела продаж и повысили конверсию.',
            'short_description' => 'Кейс внедрения CRM и аналитики.',
            'full_content' => 'Подробное описание проекта.',
            'status' => 'published',
            'sort_order' => 10,
            'seo_title' => 'Кейс внедрения CRM',
            'seo_description' => 'Как CRM-интеграция дала рост конверсии.',
        ]);

        Article::query()->create([
            'title' => '5 ошибок внедрения CRM в маркетинге',
            'slug' => '5-crm-implementation-mistakes',
            'excerpt' => 'Коротко о частых провалах и как их избежать.',
            'short_description' => 'Разбор типичных ошибок.',
            'full_content' => 'Подробная статья по этапам внедрения CRM.',
            'status' => 'published',
            'sort_order' => 10,
            'published_at' => now()->subDays(7),
            'seo_title' => 'Ошибки внедрения CRM',
            'seo_description' => 'Практические советы для руководителей и маркетологов.',
        ]);

        Widget::query()->create([
            'title' => 'Виджет лид-формы',
            'slug' => 'lead-form-widget',
            'price_text' => 'от 9 900 ₽',
            'platform_compatibility' => 'amoCRM, Bitrix24',
            'external_link' => 'https://example.com/widgets/lead-form',
            'short_description' => 'Собирает лиды с сайта и отправляет в CRM.',
            'full_content' => 'Описание возможностей и вариантов интеграции.',
            'status' => 'published',
            'sort_order' => 10,
            'seo_title' => 'Виджет лид-формы',
            'seo_description' => 'Интеграция лид-формы с CRM.',
        ]);

        Testimonial::query()->create([
            'title' => 'Отзыв директора по маркетингу',
            'slug' => 'marketing-director-review',
            'author_name' => 'Анна Иванова',
            'company_name' => 'ООО Пример',
            'role' => 'CMO',
            'quote' => 'Команда выстроила прозрачный процесс от заявки до сделки, и мы наконец видим реальную окупаемость рекламы.',
            'short_description' => 'Результат после внедрения CRM.',
            'full_content' => 'Детальный отзыв о проекте.',
            'status' => 'published',
            'sort_order' => 10,
            'seo_title' => 'Отзыв клиента',
            'seo_description' => 'Опыт внедрения CRM и маркетинговой аналитики.',
        ]);

        Faq::query()->create([
            'title' => 'Сколько длится внедрение?',
            'slug' => 'how-long-implementation-takes',
            'question' => 'Сколько времени занимает внедрение CRM?',
            'answer' => 'Обычно от 3 до 8 недель, в зависимости от сложности процессов и интеграций.',
            'short_description' => 'Сроки внедрения CRM.',
            'full_content' => 'Дополнительные детали про этапы внедрения.',
            'status' => 'published',
            'sort_order' => 10,
            'seo_title' => 'Сроки внедрения CRM',
            'seo_description' => 'Оценка сроков запуска проекта.',
        ]);

        JsPlugin::query()->create([
            'title' => 'Пример JS плагина аналитики',
            'slug' => 'analytics-js-plugin',
            'placement' => 'body_end',
            'script_snippet' => "console.log('JS plugin loaded');",
            'status' => 'draft',
            'sort_order' => 10,
        ]);
    }
}
