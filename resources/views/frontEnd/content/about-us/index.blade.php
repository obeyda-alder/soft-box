<section class="sec-block overlay">
    <h2 class="page-number bottom">02.</h2>
    <div class="bg-position left-position"></div>
    <div class="container">
        <div class="expt-text float-right">
            <div class="main-banner-text title-hd wow slideInRight" data-wow-delay="300ms">
                @if ($data['siteAboutUs'])
                    <span>{{ $data['siteAboutUs']->small_title }}</span>
                    <h1>{{ $data['siteAboutUs']->title }} <span></span></h1>
                    <p>{{ $data['siteAboutUs']->small_description }}</p>
                    <p class="bdy">{{ $data['siteAboutUs']->description }}</p>
                    <a href="about.html" title="" class="btn-default2">read more <img
                            src="{{ asset('assets/img/frontEnd/images/icon4.svg') }}" alt=""></a>
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
