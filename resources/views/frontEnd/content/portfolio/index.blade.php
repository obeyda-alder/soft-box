<section class="sec-block">
    <div class="fixed-bg bg4"></div>
    <h2 class="page-number">06.</h2>
    <div class="container">
        @if ($data['sitePortfolio'] && $data['sitePortfolioImages'])
            <div class="section-head">
                <div class="main-banner-text title-hd wow fadeInUp" data-wow-delay="300ms">
                    <span>{{ $data['sitePortfolio']->small_title }}</span>
                    <h1>{{ $data['sitePortfolio']->title }} <span></span></h1>
                    <p class="bdy">{{ $data['sitePortfolio']->description }}</p>
                </div>
                <a href="cases.html" title="" class="btn-default2">view all cases <img
                        src="{{ asset('assets/img/frontEnd/images/icon4.svg') }}" alt=""></a>
                <div class="clearfix"></div>
            </div>

            <div class="pft-items">
                <div class="row">
                    @foreach ($data['sitePortfolioImages'] as $image)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="pft-item wow fadeInUp" data-wow-delay="300ms">
                                <img src="{{ $image->image }}" alt="">
                                <div class="figcaption">
                                    <h2><a href="case-work.html" title="">{{ $image->title }}</a></h2>
                                    <a href="case-work.html" title="">
                                        <img src="{{ asset('assets/img/frontEnd/images/icon9.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
