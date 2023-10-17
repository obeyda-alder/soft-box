<footer>
    <div class="container">
        @include('frontEnd/content/news-letter/index')

        <div class="bottom-footer">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="widget widget-about wow fadeInUp" data-wow-delay="300ms">
                        <img src="{{ asset('assets/img/frontEnd/images/logo.png') }}" alt="">
                        <p>{{ $data['siteFooter']->copy_right }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="widget widget-para wow fadeInDown" data-wow-delay="600ms">
                        <h3 class="widget-title">Working hours:</h3>
                        <p>{{ $data['siteFooter']->working_hours }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="widget widget-para wow fadeInUp" data-wow-delay="900ms">
                        <h3 class="widget-title">Address:</h3>
                        <p>{{ $data['siteFooter']->address }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="widget widget-para wow fadeInDown" data-wow-delay="1200ms">
                        <h3 class="widget-title">Hit us up:</h3>
                        <span>{{ $data['siteFooter']->phone_number }}</span>
                        <p>{{ $data['siteFooter']->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
