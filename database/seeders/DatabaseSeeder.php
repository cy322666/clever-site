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
                'site_name' => 'CleverCRM',
                'phone' => '+7 (900) 123-45-67',
                'email' => 'info@clevercrm.ru',
                'telegram_link' => 'https://t.me/clevercrm',
                'youtube_link' => 'https://youtube.com/@clevercrm',
                'vk_link' => 'https://vk.com/clevercrm',
                'max_link' => 'https://max.ru/clevercrm',
                'teletype_link' => 'https://teletype.in/@clevercrm',
                'address' => 'Калининград',
                'hero_title' => 'CRM есть,<br>а выручка <span>все равно<br>утекает</span>',
                'hero_subtitle' => 'Покажем, где бизнес теряет заявки, повторные продажи и контроль над отделом',
            ]
        );

        Service::query()->delete();
        CaseStudy::query()->delete();
        Article::query()->delete();
        Widget::query()->delete();
        Testimonial::query()->delete();
        Faq::query()->delete();
        JsPlugin::query()->delete();

        // --- Услуги (из статического HTML) ---

        Service::query()->create([
            'title' => 'Внедрение amoCRM',
            'slug' => 'vnedrenie-amocrm',
            'short_label' => 'Внедрение',
            'icon_name' => 'rocket',
            'short_description' => 'Соберем amoCRM под реальные продажи',
            'full_content' => 'Полный цикл внедрения amoCRM: аудит процессов, настройка воронок, интеграции с телефонией и сайтом, обучение команды.',
            'status' => 'published',
            'sort_order' => 10,
        ]);

        Service::query()->create([
            'title' => 'Перевнедрение amoCRM',
            'slug' => 'perevnedrenie-amocrm',
            'short_label' => 'Перевнедрение',
            'icon_name' => 'refresh',
            'short_description' => 'Переделаем CRM, если текущее внедрение не работает',
            'full_content' => 'Разберем текущую CRM, найдем точки потерь и пересоберем систему под реальные процессы продаж.',
            'status' => 'published',
            'sort_order' => 20,
        ]);

        Service::query()->create([
            'title' => 'Аналитика продаж в amoCRM',
            'slug' => 'analitika-prodazh-v-amocrm',
            'short_label' => 'Аналитика',
            'icon_name' => 'chart-bar',
            'short_description' => 'Покажем цифры, на которые можно опираться',
            'full_content' => 'Настроим сквозную аналитику, дашборды в DataLens, отчеты по воронке, конверсии и каналам.',
            'status' => 'published',
            'sort_order' => 30,
        ]);

        Service::query()->create([
            'title' => 'Разработка CRM-решений',
            'slug' => 'razrabotka-crm',
            'short_label' => 'Разработка',
            'icon_name' => 'code',
            'short_description' => 'Доработаем CRM под вашу логику бизнеса',
            'full_content' => 'Кастомные виджеты, интеграции, автоматизации и доработки amoCRM под нестандартные задачи.',
            'status' => 'published',
            'sort_order' => 40,
        ]);

        Service::query()->create([
            'title' => 'Реанимация amoCRM',
            'slug' => 'reanimaciya-amocrm',
            'short_label' => 'Реанимация',
            'icon_name' => 'heart',
            'short_description' => 'Вернем CRM к жизни, если она перестала работать',
            'full_content' => 'Диагностика и восстановление работоспособности amoCRM после неудачных внедрений.',
            'status' => 'published',
            'sort_order' => 50,
        ]);

        Service::query()->create([
            'title' => 'Сопровождение CRM',
            'slug' => 'soprovozhdenie-crm',
            'short_label' => 'Сопровождение',
            'icon_name' => 'shield-check',
            'short_description' => 'Поддержка и развитие CRM после внедрения',
            'full_content' => 'Регулярная поддержка, доработки, консультации и обучение команды.',
            'status' => 'published',
            'sort_order' => 60,
        ]);

        Service::query()->create([
            'title' => 'Сквозная аналитика',
            'slug' => 'skvoznaya-analitika',
            'short_label' => 'Аналитика',
            'icon_name' => 'presentation-chart-line',
            'short_description' => 'Объединяем рекламу, CRM и финрезультат в единую систему',
            'full_content' => 'Настраиваем UTM-метки, источники, BI-отчеты и SLA для команды.',
            'status' => 'published',
            'sort_order' => 70,
        ]);

        Service::query()->create([
            'title' => 'Аудит amoCRM',
            'slug' => 'audit-amocrm',
            'short_label' => 'Аудит',
            'icon_name' => 'magnifying-glass',
            'short_description' => 'Покажем слабые места в текущей CRM',
            'full_content' => 'Полный разбор текущей CRM: воронки, автоматизации, интеграции, потери лидов.',
            'status' => 'published',
            'sort_order' => 80,
        ]);

        Service::query()->create([
            'title' => 'Купить amoCRM с бонусами',
            'slug' => 'kupit-licenzii',
            'short_label' => 'Купить amoCRM',
            'icon_name' => 'gift',
            'short_description' => 'Поможем подобрать тариф и получить бонусы',
            'full_content' => 'Помощь в выборе тарифа, оформлении лицензий amoCRM и получении бонусов при покупке через нас.',
            'status' => 'published',
            'sort_order' => 90,
        ]);

        // --- Кейсы (из статического HTML) ---

        CaseStudy::query()->create([
            'title' => 'Макромир Инвест — перезапуск продаж в amoCRM за 30 дней',
            'slug' => 'macromir-invest',
            'client_name' => 'Макромир Инвест',
            'niche' => 'Элитная недвижимость',
            'result_summary' => 'Убрали потери лидов, прозрачный контроль по этапам и конверсии',
            'problem_block' => 'Сделки зависали, лиды терялись, менеджеры тратили время на нецелевые заявки',
            'solution_block' => 'Пересобрали воронки, внедрили автоквалификацию и вернули интеграции',
            'result_block' => 'Убрали потери лидов, прозрачный контроль по этапам и конверсии',
            'short_description' => 'Высокий чек и уже внедренная amoCRM, но лиды терялись, менеджеры обрабатывали нецелевые обращения, а допродажи не работали.',
            'full_content' => 'Подробное описание проекта по перезапуску продаж в amoCRM для компании Макромир Инвест.',
            'status' => 'published',
            'sort_order' => 10,
        ]);

        CaseStudy::query()->create([
            'title' => 'Пересобрали CRM и навели порядок в продажах',
            'slug' => 'proizvodstvo-crm',
            'client_name' => 'Производственная компания',
            'niche' => 'Производство',
            'result_summary' => 'Убрали дубли, настроили воронки под реальные этапы, руководитель видит потери',
            'problem_block' => 'Дубли контактов, воронки не соответствовали реальным этапам продаж',
            'solution_block' => 'Пересобрали воронки, очистили базу, настроили контроль',
            'result_block' => 'Руководитель видит потери и конверсию по этапам',
            'short_description' => 'Убрали дубли, настроили воронки под реальные этапы, руководитель видит потери',
            'full_content' => 'Подробное описание проекта.',
            'status' => 'published',
            'sort_order' => 20,
        ]);

        CaseStudy::query()->create([
            'title' => 'Перевнедрили CRM для сети клиник',
            'slug' => 'medicina-crm',
            'client_name' => 'Сеть клиник',
            'niche' => 'Медицина',
            'result_summary' => 'Убрали лишнее, вернули дисциплину по задачам, контроль загрузки',
            'problem_block' => 'CRM была перегружена лишними полями и этапами',
            'solution_block' => 'Упростили воронки, настроили задачи и контроль загрузки',
            'result_block' => 'Вернули дисциплину по задачам, контроль загрузки менеджеров',
            'short_description' => 'Убрали лишнее, вернули дисциплину по задачам, контроль загрузки',
            'full_content' => 'Подробное описание проекта.',
            'status' => 'published',
            'sort_order' => 30,
        ]);

        CaseStudy::query()->create([
            'title' => 'Собрали аналитику продаж в DataLens',
            'slug' => 'b2b-analitika-datalens',
            'client_name' => 'B2B-компания',
            'niche' => 'B2B',
            'result_summary' => 'Воронка, конверсия по этапам, потери по каналам — видно каждый день',
            'problem_block' => 'Не было прозрачной аналитики по каналам и этапам продаж',
            'solution_block' => 'Собрали дашборды в DataLens с данными из amoCRM',
            'result_block' => 'Ежедневная аналитика: воронка, конверсия, потери по каналам',
            'short_description' => 'Воронка, конверсия по этапам, потери по каналам — видно каждый день',
            'full_content' => 'Подробное описание проекта.',
            'status' => 'published',
            'sort_order' => 40,
        ]);

        // --- Отзывы (из статического HTML) ---

        Testimonial::query()->create([
            'title' => 'Отзыв Александра Волкова',
            'slug' => 'volkov-review',
            'author_name' => 'Александр Волков',
            'company_name' => 'EduTech',
            'role' => 'Руководитель отдела продаж',
            'quote' => 'До этого CRM была внедрена формально. После проекта стало понятно, как реально вести сделки и где у нас терялись заявки.',
            'short_description' => 'Отзыв после внедрения CRM.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 10,
        ]);

        Testimonial::query()->create([
            'title' => 'Отзыв Киры Наумовой',
            'slug' => 'naumova-review',
            'author_name' => 'Кира Наумова',
            'company_name' => 'B2B-компания',
            'role' => 'Собственник',
            'quote' => 'Самое полезное было не в настройках, а в том, что наконец появилась понятная логика работы и контроль по менеджерам.',
            'short_description' => 'Отзыв собственника.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 20,
        ]);

        Testimonial::query()->create([
            'title' => 'Отзыв Игоря Михайлова',
            'slug' => 'mihaylov-review',
            'author_name' => 'Игорь Михайлов',
            'company_name' => 'Производство',
            'role' => 'Коммерческий директор',
            'quote' => 'В CRM был бардак, цифрам нельзя было доверять. После внедрения стало видно, что происходит в продажах и где проседает выручка.',
            'short_description' => 'Отзыв коммерческого директора.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 30,
        ]);

        // --- FAQ (из статического HTML) ---

        Faq::query()->create([
            'title' => 'С чего начать, если CRM уже есть',
            'slug' => 's-chego-nachat',
            'question' => 'С чего начать, если CRM уже есть, но толку от нее нет',
            'answer' => 'Начинаем с разбора текущей CRM и потерь. Сначала смотрим, где ломается логика, а потом решаем, нужна доработка, перевнедрение или точечная настройка.',
            'short_description' => 'Что делать если CRM не работает.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 10,
        ]);

        Faq::query()->create([
            'title' => 'Доработка или перевнедрение',
            'slug' => 'dorabotka-ili-perevnedrenie',
            'question' => 'Когда хватает доработки, а когда нужно перевнедрение',
            'answer' => 'Если проблема в отдельных функциях, хватает доработки. Если CRM не отражает реальную продажу и не дает контроля, обычно нужен перезапуск логики.',
            'short_description' => 'Разница между доработкой и перевнедрением.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 20,
        ]);

        Faq::query()->create([
            'title' => 'Работа без остановки отдела продаж',
            'slug' => 'bez-ostanovki-prodazh',
            'question' => 'Можно ли навести порядок без остановки отдела продаж',
            'answer' => 'Да. Обычно пересобираем систему поэтапно, чтобы команда продолжала работать, а изменения внедрялись без полной остановки отдела.',
            'short_description' => 'Внедрение без остановки работы.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 30,
        ]);

        Faq::query()->create([
            'title' => 'Что вы даете на старте',
            'slug' => 'chto-daete-na-starte',
            'question' => 'Что вы даете на старте',
            'answer' => 'Показываем, где теряются заявки и деньги, что в CRM лишнее, что сломано и какой план действий даст эффект быстрее всего.',
            'short_description' => 'Первые шаги сотрудничества.',
            'full_content' => '',
            'status' => 'published',
            'sort_order' => 40,
        ]);
    }
}
