<section class="sec-block">
    <div class="fixed-bg bg5"></div>
    <h2 class="page-number">07.</h2>
    <div class="container">
        @if ($data['siteLatestInCrope'])
            <div class="row">
                <div class="col-lg-6 wow slideInLeft" data-wow-delay="300ms">
                    <div class="main-banner-text title-hd">
                        <span>{{ $data['siteLatestInCrope']->small_title }}</span>
                        <h1>{{ $data['siteLatestInCrope']->title }}<span></span></h1>
                        <p class="bdy">{{ $data['siteLatestInCrope']->description }}</p>
                    </div>

                    <div class="blog-posts">
                        @foreach ($data['siteBlogs'] as $blog)
                            <div class="blog_post">
                                <div class="blog-thumbnail">
                                    <img src="{{ $blog->logo }}" alt="">
                                </div>
                                <div class="blog_info">
                                    <ul class="meta">
                                        <li>
                                            <span class="category">{{ $blog->slug }}</span>
                                        </li>
                                        <li>
                                            <span>{{ $blog->published_at }}</span>
                                        </li>
                                    </ul>
                                    <h2 class="post-title">
                                        <a href="javascript:;" title="">{{ $blog->title }}</a>
                                    </h2>
                                    <a href="javascript:;" title="" class="btn-default2">read more</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 wow slideInRight" data-wow-delay="300ms">
                    <div class="blog_post main">
                        <div class="blog-thumbnail">
                            <img src="{{ $data['siteBlogs']->last()->logo }}" alt="">
                        </div>
                        <div class="blog_info">
                            <ul class="meta">
                                <li>
                                    <span class="category">{{ $data['siteBlogs']->last()->slug }}</span>
                                </li>
                                <li>
                                    <span>{{ $data['siteBlogs']->last()->published_at }}</span>
                                </li>
                            </ul>
                            <h2 class="post-title">
                                <a href="javascript:;" title="">{{ $data['siteBlogs']->last()->title }}</a>
                            </h2>
                            <a href="javascript:;" title="" class="btn-default2">read more</a>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
