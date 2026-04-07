<?php

namespace App\Services;

use App\Models\SiteInquiry;
use Illuminate\Support\Facades\Http;

class TelegramNotifier
{
    public function sendSiteInquiry(SiteInquiry $inquiry): void
    {
        $token = (string) config('services.telegram.bot_token');
        $chatId = (string) config('services.telegram.chat_id');

        if ($token === '' || $chatId === '') {
            return;
        }

        $payload = [
            'chat_id' => $chatId,
            'text' => $this->buildSiteInquiryMessage($inquiry),
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];

        $threadId = config('services.telegram.message_thread_id');

        if (! empty($threadId)) {
            $payload['message_thread_id'] = $threadId;
        }

        Http::asForm()
            ->timeout(10)
            ->post(sprintf('https://api.telegram.org/bot%s/sendMessage', $token), $payload)
            ->throw();
    }

    private function buildSiteInquiryMessage(SiteInquiry $inquiry): string
    {
        $lines = [
            '📥 <b>Новая заявка с сайта</b>',
            '',
            '👤 <b>Имя:</b> '.$this->escape($inquiry->name),
            '📞 <b>Контакт:</b> '.$this->escape($inquiry->contact),
        ];

        if (! empty($inquiry->offer_type)) {
            $lines[] = '🎯 <b>Оффер:</b> '.$this->escape($inquiry->offer_type);
        }

        if (! empty($inquiry->landing_title)) {
            $lines[] = '📍 <b>Страница:</b> '.$this->escape($inquiry->landing_title);
        } elseif (! empty($inquiry->landing_slug)) {
            $lines[] = '📍 <b>Slug:</b> '.$this->escape($inquiry->landing_slug);
        }

        if (! empty($inquiry->page_url)) {
            $lines[] = '🔗 <b>URL:</b> '.$this->escape($inquiry->page_url);
        }

        if (! empty($inquiry->message)) {
            $lines[] = '';
            $lines[] = '📝 <b>Задача:</b>';
            $lines[] = $this->escape($inquiry->message);
        }

        if (! empty($inquiry->ip_address)) {
            $lines[] = '';
            $lines[] = '🌐 <b>IP:</b> '.$this->escape($inquiry->ip_address);
        }

        return implode("\n", $lines);
    }

    private function escape(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
