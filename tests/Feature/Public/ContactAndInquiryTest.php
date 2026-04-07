<?php

namespace Tests\Feature\Public;

use App\Models\SiteInquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPublicContent;
use Tests\TestCase;

class ContactAndInquiryTest extends TestCase
{
    use CreatesPublicContent;
    use RefreshDatabase;

    public function test_contacts_page_opens(): void
    {
        $response = $this->get(route('site.contacts'));

        $response->assertOk();
        $response->assertSee('Контакты');
    }

    public function test_landing_inquiry_form_is_submitted_successfully(): void
    {
        $landing = $this->createLanding([
            'slug' => 'landing-form-test',
            'title' => 'Тест формы на лендинге',
        ]);

        $response = $this
            ->from(route('site.landings.show', $landing->slug))
            ->post(route('site.inquiries.store'), [
                'name' => 'Иван',
                'contact' => '+79990000000',
                'message' => 'Нужно перевнедрение CRM',
                'landing_slug' => $landing->slug,
                'landing_title' => $landing->displayTitle(),
                'offer_type' => 'Аудит CRM',
                'page_url' => route('site.landings.show', $landing->slug),
            ]);

        $response
            ->assertRedirect(route('site.landings.show', $landing->slug).'#landing-form')
            ->assertSessionHas('landing_form_success');

        $this->assertDatabaseHas(SiteInquiry::class, [
            'name' => 'Иван',
            'contact' => '+79990000000',
            'landing_slug' => $landing->slug,
            'offer_type' => 'Аудит CRM',
        ]);
    }

    public function test_landing_inquiry_form_validates_required_fields(): void
    {
        $landing = $this->createLanding([
            'slug' => 'landing-validation-test',
        ]);

        $response = $this
            ->from(route('site.landings.show', $landing->slug))
            ->post(route('site.inquiries.store'), [
                'name' => '',
                'contact' => '',
                'landing_slug' => 'missing-landing',
                'page_url' => 'not-a-url',
            ]);

        $response->assertSessionHasErrors(['name', 'contact', 'landing_slug', 'page_url']);
    }
}
