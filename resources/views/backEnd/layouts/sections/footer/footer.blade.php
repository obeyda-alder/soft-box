<footer class="shadow-detached footer-detached">
    <div
        class="{{ !empty($containerNav) ? $containerNav : 'container' }} d-flex flex-wrap justify-content-start py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            © {{ date('Y') }}
            , made with ❤️ by <a
                href="{{ !empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '' }}" target="_blank"
                class="footer-link fw-bolder">{{ !empty(config('variables.creatorName')) ? config('variables.creatorName') : '' }}</a>
        </div>
    </div>
</footer>
