<section class="sec-block why-choose-us">
    <div class="fixed-bg bg6"></div>
    <h2 class="page-number">05</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="counter-section">
                    <div class="row">
                        @foreach (collect($data['siteWhyUsItems'])->where('type', 'BOX') as $box)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="counter-div gradient-bg1 wow fadeInUp" data-wow-delay="300ms">
                                    <h2>{{ $box->box_number }} <sup>+</sup></h2>
                                    <span>{{ $box->title }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="why-we-sec">
                    <div class="main-banner-text title-hd wow fadeInUp" data-wow-delay="300ms">
                        <span>{{ $data['siteWhyUs']->small_title }}</span>
                        <h1>{{ $data['siteWhyUs']->title }} <span></span></h1>
                        <p>{{ $data['siteWhyUs']->description }}</p>
                    </div>

                    <ul class="our-features-list wow fadeInDown" data-wow-delay="600ms">
                        @foreach (collect($data['siteWhyUsItems'])->where('type', 'ITEM') as $item)
                            <li>
                                <h3>{{ $item->title }}</h3>
                                <p>{{ $item->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
