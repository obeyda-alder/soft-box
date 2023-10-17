<div class="responsive-mobile-menu">
    <div class="responsive-logo">
        {{--  asset('assets/img/frontEnd/images/logo.png') --}}
        <img src="{{ $data['logo'] }}" alt="">
    </div>
    <ul>
        @foreach ($data['siteNavbarItem'] as $item)
            <li class="list-responsive"><a href="services.html" title="">{{ strtoupper($item->title) }}</a></li>
        @endforeach
    </ul>
</div>
