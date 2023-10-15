<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">
        <a href="{{ route('admin:dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo"></span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ config('variables.AppName') }}</span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach (app('menuData')['menu'] as $menu)
            @if (isset($menu['menuHeader']))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ $menu['menuHeader'] }}</span>
                </li>
            @else
                @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();

                    if ($currentRouteName === $menu['slug']) {
                        $activeClass = 'active';
                    } elseif (isset($menu['submenu'])) {
                        if (gettype($menu['slug']) === 'array') {
                            foreach ($menu['slug'] as $slug) {
                                if (str_contains($currentRouteName, $slug)) {
                                    $activeClass = 'active open';
                                }
                            }
                        } else {
                            if (str_contains($currentRouteName, $menu['slug'])) {
                                $activeClass = 'active open';
                            }
                        }
                    }
                @endphp

                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ isset($menu['url']) ? url($menu['url']) : 'javascript:;' }}"
                        class="{{ isset($menu['submenu']) ? 'menu-link menu-toggle' : 'menu-link' }}"
                        @if (isset($menu['target']) && !empty($menu['target'])) target="_blank" @endif>
                        @isset($menu['icon'])
                            <i class="{{ $menu['icon'] }}"></i>
                        @endisset
                        <div>{{ isset($menu['name']) ? __($menu['name']) : '' }}</div>
                    </a>

                    @isset($menu['submenu'])
                        @include('backEnd/layouts.sections.menu.submenu', ['menu' => $menu['submenu']])
                    @endisset
                </li>
            @endif
        @endforeach
    </ul>

</aside>
