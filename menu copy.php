<?php


return [
  "menu" =>  [
    [
      "url"  => route('admin:dashboard'),
      "name" => __('menu.dashboard'),
      "icon" => "menu-icon tf-icons bx bx-home-circle",
      "slug" => 'admin:dashboard'
    ],
    [
      "name" => __('menu.users.title'),
      "icon" => "menu-icon tf-icons bx bx-user",
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
      "menuHeader" => "Pages"
    ],
    [
      "name" => "Account Settings",
      "icon" => "menu-icon tf-icons bx bx bx-dock-top",
      "slug" => "pages-account-settings",
      "submenu" => [
        [
          "url" => "/pages/account-settings-account",
          "name" => "Account",
          "slug" => "pages-account-settings-account"
        ],
        [
          "url" => "/pages/account-settings-notifications",
          "name" => "Notifications",
          "slug" => "pages-account-settings-notifications"
        ],
        [
          "url" => "/pages/account-settings-connections",
          "name" => "Connections",
          "slug" => "pages-account-settings-connections"
        ]
      ]
    ],
    [
      "name" => "Authentications",
      "icon" => "menu-icon tf-icons bx bx-lock-open-alt",
      "slug" => "auth",
      "submenu" => [
        [
          "url" => "/auth/login-basic",
          "name" => "Login",
          "slug" => "auth-login-basic",
          "target" => "_blank"
        ],
        [
          "url" => "/auth/register-basic",
          "name" => "Register",
          "slug" => "auth-register-basic",
          "target" => "_blank"
        ],
        [
          "url" => "/auth/forgot-password-basic",
          "name" => "Forgot Password",
          "slug" => "auth-forgot-password-basic",
          "target" => "_blank"
        ]
      ]
    ],
    [
      "name" => "Misc",
      "icon" => "menu-icon tf-icons bx bx-cube-alt",
      "slug" => "pages-misc",
      "submenu" => [
        [
          "url" => "/pages/misc-error",
          "name" => "Error",
          "slug" => "pages-misc-error",
          "target" => "_blank"
        ],
        [
          "url" => "/pages/misc-under-maintenance",
          "name" => "Under Maintenance",
          "slug" => "pages-misc-under-maintenance",
          "target" => "_blank"
        ]
      ]
    ],
    [
      "menuHeader" => "Components"
    ],
    [
      "name" => "Cards",
      "icon" => "menu-icon tf-icons bx bx-collection",
      "slug" => "cards-basic",
      "url" => "/cards/basic"
    ],
    [
      "name" => "User interface",
      "icon" => "menu-icon tf-icons bx bx-box",
      "slug" => "ui",
      "submenu" => [
        [
          "url" => "ui/accordion",
          "name" => "Accordion",
          "slug" => "ui-accordion"
        ],
        [
          "url" => "ui/alerts",
          "name" => "Alerts",
          "slug" => "ui-alerts"
        ],
        [
          "url" => "ui/badges",
          "name" => "Badges",
          "slug" => "ui-badges"
        ],
        [
          "url" => "ui/buttons",
          "name" => "Buttons",
          "slug" => "ui-buttons"
        ],
        [
          "url" => "ui/carousel",
          "name" => "Carousel",
          "slug" => "ui-carousel"
        ],
        [
          "url" => "ui/collapse",
          "name" => "Collapse",
          "slug" => "ui-collapse"
        ],
        [
          "url" => "ui/dropdowns",
          "name" => "Dropdowns",
          "slug" => "ui-dropdowns"
        ],
        [
          "url" => "ui/footer",
          "name" => "Footer",
          "slug" => "ui-footer"
        ],
        [
          "url" => "ui/list-groups",
          "name" => "List groups",
          "slug" => "ui-list-groups"
        ],
        [
          "url" => "ui/modals",
          "name" => "Modals",
          "slug" => "ui-modals"
        ],
        [
          "url" => "ui/navbar",
          "name" => "Navbar",
          "slug" => "ui-navbar"
        ],
        [
          "url" => "ui/offcanvas",
          "name" => "Offcanvas",
          "slug" => "ui-offcanvas"
        ],
        [
          "url" => "ui/pagination-breadcrumbs",
          "name" => "Pagination & Breadcrumbs",
          "slug" => "ui-pagination-breadcrumbs"
        ],
        [
          "url" => "ui/progress",
          "name" => "Progress",
          "slug" => "ui-progress"
        ],
        [
          "url" => "ui/spinners",
          "name" => "Spinners",
          "slug" => "ui-spinners"
        ],
        [
          "url" => "ui/tabs-pills",
          "name" => "Tabs & Pills",
          "slug" => "ui-tabs-pills"
        ],
        [
          "url" => "ui/toasts",
          "name" => "Toasts",
          "slug" => "ui-toasts"
        ],
        [
          "url" => "ui/tooltips-popovers",
          "name" => "Tooltips & popovers",
          "slug" => "ui-tooltips-popovers"
        ],
        [
          "url" => "ui/typography",
          "name" => "Typography",
          "slug" => "ui-typography"
        ]
      ]
    ],
    [
      "name" => "Extended UI",
      "icon" => "menu-icon tf-icons bx bx-copy",
      "slug" => "extended",
      "submenu" => [
        [
          "url" => "extended/ui-perfect-scrollbar",
          "name" => "Perfect scrollbar",
          "slug" => "extended-ui-perfect-scrollbar"
        ],
        [
          "url" => "extended/ui-text-divider",
          "name" => "Text Divider",
          "slug" => "extended-ui-text-divider"
        ]
      ]
    ],
    [
      "url" => "icons/boxicons",
      "icon" => "menu-icon tf-icons bx bx-crown",
      "name" => "Boxicons",
      "slug" => "icons-boxicons"
    ],
    [
      "menuHeader" => "Forms & Tables"
    ],
    [
      "name" => "Form Elements",
      "icon" => "menu-icon tf-icons bx bx-detail",
      "slug" => "forms",
      "submenu" => [
        [
          "url" => "forms/basic-inputs",
          "name" => "Basic Inputs",
          "slug" => "forms-basic-inputs"
        ],
        [
          "url" => "forms/input-groups",
          "name" => "Input groups",
          "slug" => "forms-input-groups"
        ]
      ]
    ],
    [
      "name" => "Form Layouts",
      "icon" => "menu-icon tf-icons bx bx-detail",
      "slug" => "form-layouts",
      "submenu" => [
        [
          "url" => "form/layouts-vertical",
          "name" => "Vertical Form",
          "slug" => "form-layouts-vertical"
        ],
        [
          "url" => "form/layouts-horizontal",
          "name" => "Horizontal Form",
          "slug" => "form-layouts-horizontal"
        ]
      ]
    ],
    [
      "url" => "tables/basic",
      "icon" => "menu-icon tf-icons bx bx-table",
      "name" => "Tables",
      "slug" => "tables-basic"
    ]
  ],
];
