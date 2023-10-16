<?php


return [
  "menu" =>  [
    [
      "url"  => route('admin:dashboard'),
      "name" => __('menu.dashboard'),
      "icon" => "menu-icon tf-icons bx bxs-dashboard",
      "slug" => 'admin:dashboard'
    ],
    [
      "menuHeader" => __('menu.users.title')
    ],
    [
      "name" => __('menu.users.title'),
      "icon" => "menu-icon tf-icons bx bxs-user",
      "slug" => "users",
      "submenu" => [
        [
          "url" => route('admin:users'),
          "name" => __('menu.users.all_users'),
          "slug" => 'admin:users'
        ],
        [
          "url" => route('admin:users', ['type' => 'admin']),
          "name" => __('menu.users.admin'),
          "slug" => 'admin:users?type=admin'
        ],
        [
          "url" => route('admin:users', ['type' => 'customer']),
          "name" => __('menu.users.customer'),
          "slug" => 'admin:users?type=customer'
        ]
      ]
    ],
    [
      "menuHeader" => __('menu.site.title')
    ],
    [
      "url" => route('admin:navbar'),
      "name" => __('menu.navbar.title'),
      "icon" => "menu-icon tf-icons bx bxs-widget",
      "slug" => "admin:navbar",
    ],
    [
      "url" => route('admin:header'),
      "name" => __('menu.header.title'),
      "icon" => "menu-icon tf-icons bx bx-heading",
      "slug" => "admin:header",
    ],
    [
      "url" => route('admin:about-us'),
      "name" => __('menu.about_us.title'),
      "icon" => "menu-icon tf-icons bx bxs-detail",
      "slug" => "admin:about-us",
    ],
    [
      "url" => route('admin:our-services'),
      "name" => __('menu.our_services.title'),
      "icon" => "menu-icon tf-icons bx bxs-hourglass-bottom",
      "slug" => "admin:our-services",
    ],
    [
      "url" => route('admin:why-us'),
      "name" => __('menu.why_us.title'),
      "icon" => "menu-icon tf-icons bx bxs-bowling-ball",
      "slug" => "admin:why-us",
    ],
    [
      "url" => route('admin:portfolio'),
      "name" => __('menu.portfolio.title'),
      "icon" => "menu-icon tf-icons bx bxs-washer",
      "slug" => "admin:portfolio",
    ],
    [
      "url" => route('admin:latest-in-crope'),
      "name" => __('menu.latest_in_crope.title'),
      "icon" => "menu-icon tf-icons bx bxs-layer-minus",
      "slug" => "admin:latest-in-crope",
    ],
    [
      "url" => route('admin:news-letter'),
      "name" => __('menu.news_letter.title'),
      "icon" => "menu-icon tf-icons bx bxs-news",
      "slug" => "admin:news-letter",
    ],
    [
      "url" => route('admin:footer'),
      "name" => __('menu.footer.title'),
      "icon" => "menu-icon tf-icons bx bxl-flickr",
      "slug" => "admin:footer",
    ],
    [
      "url" => route('admin:config'),
      "name" => __('menu.config.title'),
      "icon" => "menu-icon tf-icons bx bxs-wrench",
      "slug" => "admin:config",
    ],
    [
      "url" => route('admin:config:languages'),
      "name" => __('menu.languages.title'),
      "icon" => "menu-icon tf-icons bx bxs-key",
      "slug" => "admin:config:languages",
    ],
  ],
];
