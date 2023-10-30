<section class="sec-block overlay">
    <div class="bg-position right-position"></div>
    <div class="container">
        @if ($data['siteContactUs'])
            <div class="consulation-section">
                <div class="main-banner-text title-hd wow fadeInUp" data-wow-delay="300ms">
                    <span>{{ $data['siteContactUs']->small_title }}</span>
                    <h1>{{ $data['siteContactUs']->title }}<span></span></h1>
                    <p class="bdy">{{ $data['siteContactUs']->description }}</p>
                </div>

                <div class="contact-form wow fadeInUp" data-wow-delay="300ms">
                    <form method="post" action="#" id="contact-form">
                        <div class="response"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <input type="text" name="name" class="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-field">
                                    <input type="text" name="email" class="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-field">
                                    <textarea name="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-field m-0">
                                    <button type="button" class="btn-default" id="submit">Send message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</section>
