@if (config('services.recaptcha.enabled'))
    @if (filled(config('services.recaptcha.site_key')))
        @pushOnce('head')
            <script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script>
        @endPushOnce
        <div class="g-recaptcha full" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-size="compact"></div>
    @else
        <p class="notice error full" role="status">Verifikasi reCAPTCHA sedang tidak tersedia. Silakan coba lagi nanti.</p>
    @endif
@endif
