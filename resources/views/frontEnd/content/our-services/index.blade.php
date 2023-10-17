<section class="sec-block">
    <div class="fixed-bg bg3"></div>
    <h2 class="page-number">03</h2>
    <div class="container">
        <div class="main-banner-text title-hd svs-header wow fadeInLeft" data-wow-delay="500ms">
            @if ($data['siteOurServices'])
                <span>{{ $data['siteOurServices']->small_title }}</span>
                <h1>{{ $data['siteOurServices']->title }}<span></span></h1>
                <p class="bdy">{{ $data['siteOurServices']->description }}</p>
            @endif
        </div>
    </div>

    <div class="services-section">
        <div class="container">
            <div class="row svs-carousel">
                @if ($data['siteOurServicesSliders'])
                    @foreach ($data['siteOurServicesSliders'] as $index => $slider)
                        <div class="col-lg-6">
                            <div class="service-col {{ $index < 4 ? 'wow fadeIn' : '' }}">
                                <div class="svs-icon">
                                    {{-- asset('assets/img/frontEnd/images/icon5.svg') --}}
                                    <img src="{{ $slider->logo }}" alt="">
                                </div>
                                <h3>{{ $slider->title }}</h3>
                                <a href="services.html" title="" class="btn-default2">read more</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
