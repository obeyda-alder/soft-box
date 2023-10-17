<section class="main-banner">
    <div class="banner-slider">
        @if ($data['siteHeaders'])
            @foreach ($data['siteHeaders'] as $header)
                <div class="banner-slide">
                    <div class="container">
                        <div class="main-banner-text">
                            <span class="wow fadeInUp" data-wow-delay="300ms">{{ $header->small_title }}</span>
                            <h1 class="wow fadeInUp" data-wow-delay="450ms">{{ $header->title }}<span></span></h1>
                            <p class="wow fadeInUp" data-wow-delay="600ms">{{ $header->description }}</p>
                            <div class="play-video-div wow fadeInUp" data-wow-delay="800ms">
                                <div class="poly1">
                                    <div class="poly2">
                                        <a href="https://www.youtube.com/watch?v=FSGfN9rr78Q" title=""
                                            class="play-video html5lightbox">
                                            {{-- {{ $header->logo }}  --}}
                                            <img src="{{ asset('assets/img/frontEnd/images/icon1.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="pl-text">
                                    <h3>About Us</h3>
                                    <span>Promotion video</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
