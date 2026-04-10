@extends('site.layouts.app')

@section('content')
<section class="site-section py-14 md:py-18">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm md:p-10">
            <h1 class="mb-4 text-2xl font-bold tracking-tight text-slate-900 md:text-3xl">
                Политика обработки персональных данных
            </h1>
            <p class="mb-8 text-sm text-slate-500 md:text-base">
                Редакция, размещенная ранее на <a class="text-orange-500 underline decoration-orange-300 underline-offset-2 hover:text-orange-600" href="https://clevercrm.pro.tilda.ws/policy" target="_blank" rel="noreferrer">clevercrm.pro.tilda.ws/policy</a>, перенесена на эту страницу
            </p>

            @php
                $policyPath = resource_path('texts/policy.txt');
                $policyText = file_exists($policyPath) ? trim((string) file_get_contents($policyPath)) : '';
            @endphp

            <article class="prose-lite prose max-w-none text-slate-700">
                {!! nl2br(e($policyText)) !!}
            </article>
        </div>
    </div>
</section>
@endsection
