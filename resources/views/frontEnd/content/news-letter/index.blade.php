<div class="top-footer">
    <div class="row">
        @if ($data['siteNewsLetter'])
            <div class="col-lg-6">
                <div class="tp-contact wow fadeInUp" data-wow-delay="300ms">
                    <div class="main-banner-text title-hd">
                        <span>{{ $data['siteNewsLetter']->small_title }}</span>
                        <h1>{{ $data['siteNewsLetter']->title }}<span></span></h1>
                        <p class="bdy">{{ $data['siteNewsLetter']->description }}</p>
                    </div>
                    <form class="newsletter-form">
                        <input type="email" name="email" placeholder="Email">
                        <button type="submit"><img src="{{ asset('assets/img/frontEnd/images/send.svg') }}"
                                alt=""></button>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-sec wow fadeInDown" data-wow-delay="300ms">
                    <div class="testi-head">
                        <div class="testi-thumb"
                            style="background-image: url({{ $data['siteNewsLetter']->manager_logo }});background-size: cover">
                            {{-- <img src="{{ $data['siteNewsLetter']->manager_logo }}" alt=""> --}}
                        </div>
                        <div class="testi-info">
                            <h3>{{ $data['siteNewsLetter']->manager_name }}</h3>
                            <span>{{ $data['siteNewsLetter']->info_manage }}</span>
                        </div>
                    </div>
                    <p>{{ $data['siteNewsLetter']->description_of_the_manager }}</p>
                    <img src="{{ asset('assets/img/frontEnd/images/sing.png') }}" alt="">
                </div>
                <div class="clearfix"></div>
            </div>
        @endif
    </div>
</div>
