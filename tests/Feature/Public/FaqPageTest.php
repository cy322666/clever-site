<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_faq_page_opens(): void
    {
        $response = $this->get(route('site.faq'));

        $response->assertOk();
        $response->assertSee('Частые вопросы о');
        $response->assertSee('внедрении amoCRM');
        $response->assertDontSee('FAQ для клиента');
        $response->assertSee('Сколько стоит внедрение amoCRM?');
        $response->assertSee('Что если в процессе появятся новые задачи?');
        $response->assertSee('Обсудим задачу и подскажем следующий шаг');
        $response->assertSee('<title>FAQ по внедрению amoCRM | Clever</title>', false);
        $response->assertSee(
            '<meta name="description" content="Ответы на частые вопросы о стоимости, сроках, аудите, формате оплаты и работе над внедрением amoCRM.">',
            false,
        );
    }
}
