<?php

/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for CU Base-based themes.
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function cu_theme_base_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {

  // General "alters" use a form id. Settings should not be set here. The only
  // thing useful about this is if you need to alter the form for the running
  // theme and *not* the theme setting.
  // @see http://drupal.org/node/943212
  if (isset($form_id)) {
    return;
  }

  // Change collapsible fieldsets (now details) to default #open => FALSE.
  $form['theme_settings']['#open'] = FALSE;
  $form['logo']['#open'] = FALSE;
  $form['favicon']['#open'] = FALSE;

  // Library settings.
  if (\Drupal::moduleHandler()->moduleExists('bootstrap_library')) {
    $form['cu_theme_base_library'] = [
      '#type' => 'select',
      '#title' => t('Load library'),
      '#default_value' => theme_get_setting('cu_theme_base_library'),
      '#options' => [
        'cdn' => t('CDN'),
        'development' => t('Local non-minimized (development)'),
        'production' => t('Local minimized (production)'),
      ],
      '#empty_option' => t('None'),
      '#description' => t('If none is selected, you should load the library via Bootstrap Library or manually. If CDN is selected, the library version must be configured in the @bootstrap_library_link.',
      ['@bootstrap_library_link' => Link::fromTextAndUrl('Bootstrap Library Settings', Url::fromRoute('bootstrap_library.admin'))->toString()]),
    ];
  }
  else {
    $form['cu_theme_base_source'] = [
      '#type' => 'select',
      '#title' => t('Load library'),
      '#default_value' => theme_get_setting('cu_theme_base_source'),
      '#options' => [
        'cu_theme_base/bootstrap' => t('Local'),
        'cu_theme_base/bootstrap_cdn' => t('CDN'),
        'cu_theme_base/bootswatch_cu' => t('Bootswatch CU'),
        #'cu_theme_base/bootswatch_cerulean' => t('Bootswatch Cerulean'),
        #'cu_theme_base/bootswatch_cosmo' => t('Bootswatch Cosmo'),
        #'cu_theme_base/bootswatch_cyborg' => t('Bootswatch Cyborg'),
        #'cu_theme_base/bootswatch_darkly' => t('Bootswatch Darkly'),
        #'cu_theme_base/bootswatch_flatly' => t('Bootswatch Flatly'),
        #'cu_theme_base/bootswatch_journal' => t('Bootswatch Journal'),
        #'cu_theme_base/bootswatch_litera' => t('Bootswatch Litera'),
        #'cu_theme_base/bootswatch_lumen' => t('Bootswatch Lumen'),
        #'cu_theme_base/bootswatch_lux' => t('Bootswatch Lux'),
        #'cu_theme_base/bootswatch_materia' => t('Bootswatch Materia'),
        #'cu_theme_base/bootswatch_minty' => t('Bootswatch Minty'),
        #'cu_theme_base/bootswatch_pulse' => t('Bootswatch Pulse'),
        #'cu_theme_base/bootswatch_sandstone' => t('Bootswatch Sandstone'),
        #'cu_theme_base/bootswatch_simplex' => t('Bootswatch Simplex'),
        #'cu_theme_base/bootswatch_sketchy' => t('Bootswatch Sketchy'),
        #'cu_theme_base/bootswatch_slate' => t('Bootswatch Slate'),
        #'cu_theme_base/bootswatch_solar' => t('Bootswatch Solar'),
        #'cu_theme_base/bootswatch_spacelab' => t('Bootswatch Spacelab'),
        #'cu_theme_base/bootswatch_superhero' => t('Bootswatch Superhero'),
        #'cu_theme_base/bootswatch_united' => t('Bootswatch United'),
        #'cu_theme_base/bootswatch_yeti' => t('Bootswatch Yeti'),
      ],
      '#empty_option' => t('None'),
      '#empty_value' => false,
    ];
  }

  // Vertical tabs.
  $form['bootstrap'] = [
    '#type' => 'vertical_tabs',
    '#prefix' => '<h2><small>' . t('Bootstrap settings') . '</small></h2>',
    '#weight' => -10,
  ];

  // Layout.
  $form['layout'] = [
    '#type' => 'details',
    '#title' => t('Layout'),
    '#group' => 'bootstrap',
  ];

  // Container.
  $form['layout']['container'] = [
    '#type' => 'details',
    '#title' => t('Container'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['layout']['container']['cu_theme_base_fluid_container'] = [
    '#type' => 'checkbox',
    '#title' => t('Fluid container'),
    '#default_value' => theme_get_setting('cu_theme_base_fluid_container'),
    '#description' => t('Use <code>.container-fluid</code> class. See @bootstrap_fluid_containers_link.', [
      '@bootstrap_fluid_containers_link' => Link::fromTextAndUrl('Containers in the Bootstrap 4 documentation', Url::fromUri('https://getbootstrap.com/docs/4.3/layout/overview/', ['absolute' => TRUE, 'fragment' => 'containers']))->toString(),
    ]),
  ];

  // List of regions.
  $theme = \Drupal::theme()->getActiveTheme()->getName();
  $region_list = system_region_list($theme);

  // Only for initial setup if not defined on install.
  $nowrap = [
    'breadcrumb',
    'hero',
    'highlighted',
    'content',
    'sidebar_first',
    'sidebar_second',
  ];

  // Region.
  $form['layout']['region'] = [
    '#type' => 'details',
    '#title' => t('Region'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  foreach ($region_list as $name => $description) {
    if (theme_get_setting('cu_theme_base_region_clean_' . $name) !== NULL) {
      $region_clean = theme_get_setting('cu_theme_base_region_clean_' . $name);
    }
    else {
      $region_clean = in_array($name, $nowrap);
    }
    if (theme_get_setting('cu_theme_base_region_class_' . $name) !== NULL) {
      $region_class = theme_get_setting('cu_theme_base_region_class_' . $name);
    }
    else {
      $region_class = $region_clean ? NULL : 'row';
    }

    $form['layout']['region'][$name] = [
      '#type' => 'details',
      '#title' => $description,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['layout']['region'][$name]['cu_theme_base_region_clean_' . $name] = [
      '#type' => 'checkbox',
      '#title' => t('Clean wrapper for @description region', ['@description' => $description]),
      '#default_value' => $region_clean,
    ];
    $form['layout']['region'][$name]['cu_theme_base_region_class_' . $name] = [
      '#type' => 'textfield',
      '#title' => t('Classes for @description region', ['@description' => $description]),
      '#default_value' => $region_class,
      '#size' => 40,
      '#maxlength' => 40,
    ];
  }

  // Sidebar Position.
  $form['layout']['sidebar_position'] = [
    '#type' => 'details',
    '#title' => t('Sidebar position'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['layout']['sidebar_position']['cu_theme_base_sidebar_position'] = [
    '#type' => 'select',
    '#title' => t('Sidebars position'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_position'),
    '#options' => [
      'left' => t('Left'),
      'both' => t('Both sides'),
      'right' => t('Right'),
    ],
  ];
  $form['layout']['sidebar_position']['cu_theme_base_content_offset'] = [
    '#type' => 'select',
    '#title' => t('Content offset'),
    '#default_value' => theme_get_setting('cu_theme_base_content_offset'),
    '#options' => [
      0 => t('None'),
      1 => t('1 cols'),
      2 => t('2 cols'),
    ],
  ];

  // Sidebar first layout.
  $form['layout']['sidebar_first'] = [
    '#type' => 'details',
    '#title' => t('Sidebar First Layout'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['layout']['sidebar_first']['cu_theme_base_sidebar_collapse'] = [
    '#type' => 'checkbox',
    '#title' => t('Sidebar collapse'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_collapse'),
  ];
  $form['layout']['sidebar_first']['cu_theme_base_sidebar_first_width'] = [
    '#type' => 'select',
    '#title' => t('Sidebar first width'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_first_width'),
    '#options' => [
      2 => t('2 cols'),
      3 => t('3 cols'),
      4 => t('4 cols'),
    ],
  ];
  $form['layout']['sidebar_first']['cu_theme_base_sidebar_first_offset'] = [
    '#type' => 'select',
    '#title' => t('Sidebar first offset'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_first_offset'),
    '#options' => [
      0 => t('None'),
      1 => t('1 cols'),
      2 => t('2 cols'),
    ],
  ];

  // Sidebar second layout.
  $form['layout']['sidebar_second'] = [
    '#type' => 'details',
    '#title' => t('Sidebar second layout'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['layout']['sidebar_second']['cu_theme_base_sidebar_second_width'] = [
    '#type' => 'select',
    '#title' => t('Sidebar second width'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_second_width'),
    '#options' => [
      2 => t('2 cols'),
      3 => t('3 cols'),
      4 => t('4 cols'),
    ],
  ];
  $form['layout']['sidebar_second']['cu_theme_base_sidebar_second_offset'] = [
    '#type' => 'select',
    '#title' => t('Sidebar second offset'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_second_offset'),
    '#options' => [
      0 => t('None'),
      1 => t('1 cols'),
      2 => t('2 cols'),
    ],
  ];

  // Components.
  $form['components'] = [
    '#type' => 'details',
    '#title' => t('Components'),
    '#group' => 'bootstrap',
  ];

  // Buttons.
  $form['components']['node'] = [
    '#type' => 'details',
    '#title' => t('Node'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['components']['node']['cu_theme_base_hide_node_label'] = [
    '#type' => 'checkbox',
    '#title' => t('Hide node label'),
    '#default_value' => theme_get_setting('cu_theme_base_hide_node_label'),
    '#description' => t('Hide node label for all display. Usefull when using f.e. Layout Builder and you want full control of your output'),
  ];

  // Buttons.
  $form['components']['buttons'] = [
    '#type' => 'details',
    '#title' => t('Buttons'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['components']['buttons']['cu_theme_base_button'] = [
    '#type' => 'checkbox',
    '#title' => t('Convert input submit to button element'),
    '#default_value' => theme_get_setting('cu_theme_base_button'),
    '#description' => t('There is a known issue where Ajax exposed filters do not if this setting is enabled.'),
  ];
  $form['components']['buttons']['cu_theme_base_button_size'] = [
    '#type' => 'select',
    '#title' => t('Default button size'),
    '#default_value' => theme_get_setting('cu_theme_base_button_size'),
    '#empty_option' => t('Normal'),
    '#options' => [
      'btn-sm' => t('Small'),
      'btn-lg' => t('Large'),
    ],
  ];
  $form['components']['buttons']['cu_theme_base_button_outline'] = [
    '#type' => 'checkbox',
    '#title' => t('Button with outline format'),
    '#default_value' => theme_get_setting('cu_theme_base_button_outline'),
    '#description' => t('Use <code>.btn-default-outline</code> class. See @bootstrap_outline_buttons_link.', [
      '@bootstrap_outline_buttons_link' => Link::fromTextAndUrl('Outline buttons in the Bootstrap 4 documentation', Url::fromUri('https://getbootstrap.com/docs/4.3/components/buttons/', ['absolute' => TRUE, 'fragment' => 'outline-buttons']))->toString(),
    ]),
  ];

  // Images.
  $form['components']['images'] = [
    '#type' => 'details',
    '#title' => t('Images'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['components']['images']['cu_theme_base_image_fluid'] = [
    '#type' => 'checkbox',
    '#title' => t('Apply img-fluid style to all content images'),
    '#default_value' => theme_get_setting('cu_theme_base_image_fluid'),
    '#description' => t('Adds a img-fluid style to all ".content img" elements'),
  ];

  // Navbar.
  $form['components']['navbar'] = [
    '#type' => 'details',
    '#title' => t('Navbar structure'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['components']['navbar']['cu_theme_base_navbar_container'] = [
    '#type' => 'checkbox',
    '#title' => t('Navbar width container'),
    '#description' => t('Check if navbar width will be inside container or fluid width.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_container'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_toggle'] = [
    '#type' => 'select',
    '#title' => t('Navbar toggle size'),
    '#description' => t('Select size for navbar to collapse.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_toggle'),
    '#options' => [
      'navbar-toggleable-xl' => t('Extra Large'),
      'navbar-toggleable-lg' => t('Large'),
      'navbar-toggleable-md' => t('Medium'),
      'navbar-toggleable-sm' => t('Small'),
      'navbar-toggleable-xs' => t('Extra small'),
      'navbar-toggleable-all' => t('All screens'),
    ],
  ];
  $form['components']['navbar']['cu_theme_base_navbar_top_navbar'] = [
    '#type' => 'checkbox',
    '#title' => t('Navbar top is navbar'),
    '#description' => t('Check if navbar top .navbar class should be added.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_top_navbar'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_top_position'] = [
    '#type' => 'select',
    '#title' => t('Navbar top position'),
    '#description' => t('Select your navbar top position.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_top_position'),
    '#options' => [
      'fixed-top' => t('Fixed top'),
      'fixed-bottom' => t('Fixed bottom'),
      'sticky-top' => t('Sticky top'),
    ],
    '#empty_option' => t('Normal'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_top_color'] = [
    '#type' => 'select',
    '#title' => t('Navbar top link color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_top_color'),
    '#options' => [
      'navbar-white' => t('White'),
      'navbar-light' => t('Light'),
      'navbar-dark' => t('Dark'),
      'navbar-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_top_background'] = [
    '#type' => 'select',
    '#title' => t('Navbar top background color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_top_background'),
    '#options' => [
      'bg-primary' => t('Primary'),
      'bg-white' => t('White'),
      'bg-light' => t('Light'),
      'bg-dark' => t('Dark'),
      'bg-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_mid_navbar'] = [
    '#type' => 'checkbox',
    '#title' => t('Navbar mid is navbar'),
    '#description' => t('Check if navbar mid .navbar class should be added.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_navbar'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_mid_position'] = [
    '#type' => 'select',
    '#title' => t('Navbar mid position'),
    '#description' => t('Select your navbar mid position.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_position'),
    '#options' => [
      'fixed-top' => t('Fixed top'),
      'fixed-bottom' => t('Fixed bottom'),
      'sticky-top' => t('Sticky top'),
    ],
    '#empty_option' => t('Normal'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_mid_color'] = [
    '#type' => 'select',
    '#title' => t('Navbar mid link color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_color'),
    '#options' => [
      'navbar-white' => t('White'),
      'navbar-light' => t('Light'),
      'navbar-dark' => t('Dark'),
      'navbar-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_mid_background'] = [
    '#type' => 'select',
    '#title' => t('Navbar mid background color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_background'),
    '#options' => [
      'bg-primary' => t('Primary'),
      'bg-white' => t('White'),
      'bg-light' => t('Light'),
      'bg-dark' => t('Dark'),
      'bg-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_position'] = [
    '#type' => 'select',
    '#title' => t('Navbar position'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_position'),
    '#options' => [
      'fixed-top' => t('Fixed top'),
      'fixed-bottom' => t('Fixed bottom'),
      'sticky-top' => t('Sticky top'),
    ],
    '#empty_option' => t('Normal'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_color'] = [
    '#type' => 'select',
    '#title' => t('Navbar link color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_color'),
    '#options' => [
      'navbar-white' => t('White'),
      'navbar-light' => t('Light'),
      'navbar-dark' => t('Dark'),
      'navbar-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_background'] = [
    '#type' => 'select',
    '#title' => t('Navbar background color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_background'),
    '#options' => [
      'bg-primary' => t('Primary'),
      'bg-white' => t('White'),
      'bg-light' => t('Light'),
      'bg-dark' => t('Dark'),
      'bg-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_footer_navbar'] = [
    '#type' => 'checkbox',
    '#title' => t('Navbar footer is navbar'),
    '#description' => t('Check if navbar footer .navbar class should be added.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_footer_navbar'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_footer_position'] = [
    '#type' => 'select',
    '#title' => t('Navbar footer position'),
    '#description' => t('Select your navbar footer position.'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_footer_position'),
    '#options' => [
      'fixed-top' => t('Fixed top'),
      'fixed-bottom' => t('Fixed bottom'),
      'sticky-top' => t('Sticky top'),
    ],
    '#empty_option' => t('Normal'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_footer_color'] = [
    '#type' => 'select',
    '#title' => t('Navbar footer link color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_footer_color'),
    '#options' => [
      'navbar-white' => t('White'),
      'navbar-light' => t('Light'),
      'navbar-dark' => t('Dark'),
      'navbar-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar']['cu_theme_base_navbar_footer_background'] = [
    '#type' => 'select',
    '#title' => t('Navbar footer background color'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_footer_background'),
    '#options' => [
      'bg-primary' => t('Primary'),
      'bg-white' => t('White'),
      'bg-light' => t('Light'),
      'bg-dark' => t('Dark'),
      'bg-black' => t('Black'),
    ],
    '#empty_option' => t('Default'),
  ];
// Allow custom classes on Navbars.
  $form['components']['navbar']['cu_theme_base_navbar_top_class'] = [
    '#type' => 'textfield',
    '#title' => t('Custom classes for Navbar Top'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_top_class'),
    '#size' => 40,
    '#maxlength' => 40,
  ];
  $form['components']['navbar']['cu_theme_base_navbar_mid_class'] = [
    '#type' => 'textfield',
    '#title' => t('Custom classes for Navbar Mid'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_class'),
    '#size' => 40,
    '#maxlength' => 40,
  ];
  $form['components']['navbar']['cu_theme_base_navbar_class'] = [
    '#type' => 'textfield',
    '#title' => t('Custom classes for Navbar'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_class'),
    '#size' => 40,
    '#maxlength' => 40,
  ];
  $form['components']['navbar']['cu_theme_base_navbar_footer_class'] = [
    '#type' => 'textfield',
    '#title' => t('Custom classes for Navbar Footer'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_footer_class'),
    '#size' => 40,
    '#maxlength' => 40,
  ];

  // Navbar behaviour.
  $form['components']['navbar_behaviour'] = [
    '#type' => 'details',
    '#title' => t('Navbar behaviour'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['components']['navbar_behaviour']['cu_theme_base_navbar_offcanvas'] = [
    '#type' => 'select',
    '#title' => t('Default/Bootstrap Offcanvas Collapse'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_offcanvas'),
    '#options' => [
      'offcanvas-collapse' => t('Offcanvas'),
    ],
    '#empty_option' => t('Default'),
  ];
  $form['components']['navbar_behaviour']['cu_theme_base_navbar_flyout'] = [
    '#type' => 'checkbox',
    '#title' => t('Flyout style main menu'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_flyout'),
  ];
  $form['components']['navbar_behaviour']['cu_theme_base_navbar_slide'] = [
    '#type' => 'checkbox',
    '#title' => t('Sliding navbar'),
    '#description' => t('Collapsed navbar will slide left to right'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_slide'),
    '#description' => t('DO NOT USE IN NEW SITES. Removed in favor of Bootstrap Offcanvas.'),
  ];

  // Tabs.
  $form['components']['tabs'] = [
    '#type' => 'details',
    '#title' => t('Tabs (local tasks)'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];

  $form['components']['tabs']['cu_theme_base_tabs_style'] = [
    '#type' => 'select',
    '#title' => t('Tabs style'),
    '#default_value' => theme_get_setting('cu_theme_base_tabs_style'),
    '#options' => [
      'full' => t('Full width blocks'),
      'pills' => t('Pills'),
    ],
    '#empty_option' => t('Default'),
  ];

  // Messages.
  $form['components']['alerts'] = [
    '#type' => 'details',
    '#title' => t('Messages'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['components']['alerts']['cu_theme_base_messages_widget'] = [
    '#type' => 'select',
    '#title' => t('Messages widget'),
    '#default_value' => theme_get_setting('cu_theme_base_messages_widget'),
    '#options' => [
      'default' => t('Alerts classic'),
      'alerts' => t('Alerts bottom'),
      'toasts' => t('Toasts'),
    ],
  ];

  // Affix.
  $form['affix'] = [
    '#type' => 'details',
    '#title' => t('Affix'),
    '#group' => 'bootstrap',
  ];
  $form['affix']['navbar_top'] = [
    '#type' => 'details',
    '#title' => t('Affix navbar top'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['affix']['navbar_top']['cu_theme_base_navbar_top_affix'] = [
    '#type' => 'checkbox',
    '#title' => t('Affix navbar top'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_top_affix'),
  ];
  /*
  $form['affix']['navbar_top']['cu_theme_base_navbar_top_affix_top'] = [
  '#type' => 'textfield',
  '#title' => t('Affix top'),
  '#default_value' => theme_get_setting('cu_theme_base_navbar_top_affix_top'
  ),
  '#prefix' => '<div id="navbar-top-affix">',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_navbar_top_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
  $form['affix']['navbar_top']['cu_theme_base_navbar_top_affix_bottom'] = [
  '#type' => 'textfield',
  '#title' => t('Affix bottom'),
  '#default_value' => theme_get_setting(
  'cu_theme_base_navbar_top_affix_bottom'),
  '#suffix' => '</div>',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_navbar_top_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
   */
  $form['affix']['navbar_mid'] = [
    '#type' => 'details',
    '#title' => t('Affix navbar mid'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['affix']['navbar_mid']['cu_theme_base_navbar_mid_affix'] = [
    '#type' => 'checkbox',
    '#title' => t('Affix navbar mid'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_affix'),
  ];
  /*
  $form['affix']['navbar_mid']['cu_theme_base_navbar_mid_affix_top'] = [
  '#type' => 'textfield',
  '#title' => t('Affix top'),
  '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_affix_top'),
  '#prefix' => '<div id="navbar-mid-affix">',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_navbar_mid_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
  $form['affix']['navbar_mid']['cu_theme_base_navbar_mid_affix_bottom'] = [
  '#type' => 'textfield',
  '#title' => t('Affix bottom'),
  '#default_value' => theme_get_setting('cu_theme_base_navbar_mid_affix_bottom'),
  '#suffix' => '</div>',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_navbar_mid_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
   */
  $form['affix']['navbar'] = [
    '#type' => 'details',
    '#title' => t('Affix navbar'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['affix']['navbar']['cu_theme_base_navbar_affix'] = [
    '#type' => 'checkbox',
    '#title' => t('Affix navbar'),
    '#default_value' => theme_get_setting('cu_theme_base_navbar_affix'),
  ];
  /*
  $form['affix']['navbar']['cu_theme_base_navbar_affix_top'] = [
  '#type' => 'textfield',
  '#title' => t('Affix top'),
  '#default_value' => theme_get_setting('cu_theme_base_navbar_affix_top'),
  '#prefix' => '<div id="navbar-affix">',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_navbar_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
  $form['affix']['navbar']['cu_theme_base_navbar_affix_bottom'] = [
  '#type' => 'textfield',
  '#title' => t('Affix bottom'),
  '#default_value' => theme_get_setting('cu_theme_base_navbar_affix_bottom'),
  '#suffix' => '</div>',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_navbar_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
   */
  $form['affix']['sidebar_first'] = [
    '#type' => 'details',
    '#title' => t('Affix sidebar first'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['affix']['sidebar_first']['cu_theme_base_sidebar_first_affix'] = [
    '#type' => 'checkbox',
    '#title' => t('Affix sidebar first'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_first_affix'),
  ];
  /*
  $form['affix']['sidebar_first'][
  'cu_theme_base_sidebar_first_affix_top'] = array(
  '#type' => 'textfield',
  '#title' => t('Affix top'),
  '#default_value' => theme_get_setting(
  'cu_theme_base_sidebar_first_affix_top'),
  '#prefix' => '<div id="sidebar-first-affix">',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_sidebar_first_affix"]' => ['checked' => FALSE],
  ],
  ],
  );
  $form['affix']['sidebar_first'][
  'cu_theme_base_sidebar_first_affix_bottom'] = array(
  '#type' => 'textfield',
  '#title' => t('Affix bottom'),
  '#default_value' => theme_get_setting(
  'cu_theme_base_sidebar_first_affix_bottom'),
  '#suffix' => '</div>',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_sidebar_first_affix"]' => ['checked' => FALSE],
  ],
  ],
  ); */
  $form['affix']['sidebar_second'] = [
    '#type' => 'details',
    '#title' => t('Affix sidebar second'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['affix']['sidebar_second']['cu_theme_base_sidebar_second_affix'] = [
    '#type' => 'checkbox',
    '#title' => t('Affix sidebar second'),
    '#default_value' => theme_get_setting('cu_theme_base_sidebar_second_affix'),
  ];
  /*
  $form['affix']['sidebar_second'][
  'cu_theme_base_sidebar_second_affix_top'] = [
  '#type' => 'textfield',
  '#title' => t('Affix top'),
  '#default_value' => theme_get_setting(
  'cu_theme_base_sidebar_second_affix_top'),
  '#prefix' => '<div id="sidebar-second-affix">',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_sidebar_second_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
  $form['affix']['sidebar_second'][
  'cu_theme_base_sidebar_second_affix_bottom'] = [
  '#type' => 'textfield',
  '#title' => t('Affix bottom'),
  '#default_value' => theme_get_setting(
  'cu_theme_base_sidebar_second_affix_bottom'),
  '#suffix' => '</div>',
  '#size' => 6,
  '#maxlength' => 3,
  '#states' => [
  'invisible' => [
  'input[name="cu_theme_base_sidebar_second_affix"]' => ['checked' => FALSE],
  ],
  ],
  ];
   */
  // Scroll Spy.
  $form['scroll_spy'] = [
    '#type' => 'details',
    '#title' => t('Scroll Spy'),
    '#group' => 'bootstrap',
  ];
  $form['scroll_spy']['cu_theme_base_scroll_spy'] = [
    '#type' => 'textfield',
    '#title' => t('Scrollspy element ID'),
    '#description' => t('Specify a valid jQuery ID for the element containing a .nav that will behave with scrollspy.'),
    '#default_value' => theme_get_setting('cu_theme_base_scroll_spy'),
    '#size' => 40,
    '#maxlength' => 40,
  ];

  // Fonts.
  $form['fonts'] = [
    '#type' => 'details',
    '#title' => t('Fonts & icons'),
    '#group' => 'bootstrap',
  ];
  $form['fonts']['fonts'] = [
    '#type' => 'details',
    '#title' => t('Fonts'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];
  $form['fonts']['fonts']['cu_theme_base_google_fonts'] = [
    '#type' => 'select',
    '#title' => t('Google Fonts combination'),
    '#default_value' => theme_get_setting('cu_theme_base_google_fonts'),
    '#empty_option' => t('None'),
    '#options' => [
      'roboto' => t('Roboto Condensed, Roboto'),
      #'monserrat_lato' => t('Monserrat, Lato'),
      #'alegreya_roboto' => t('Alegreya, Roboto Condensed, Roboto'),
      #'dancing_garamond' => t('Dancing Script, EB Garamond'),
      #'amatic_josefin' => t('Amatic SC, Josefin Sans'),
      #'oswald_droid' => t('Oswald, Droid Serif'),
      #'playfair_alice' => t('Playfair Display, Alice'),
      #'dosis_opensans' => t('Dosis, Open Sans'),
      #'lato_hotel' => t('Lato, Grand Hotel'),
      #'medula_abel' => t('Medula One, Abel'),
      #'fjalla_cantarell' => t('Fjalla One, Cantarell'),
      #'coustard_leckerli' => t('Coustard Ultra, Leckerli One'),
      #'philosopher_muli' => t('Philosopher, Muli'),
      #'vollkorn_exo' => t('Vollkorn, Exo'),
    ],
  ];
  $form['fonts']['bootstrap_icons'] = [
    '#type' => 'details',
    '#title' => t('Bootstrap icons'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];
  $form['fonts']['bootstrap_icons']['cu_theme_base_bootstrap_icons'] = [
    '#type' => 'checkbox',
    '#title' => t('Use Bootstrap icons'),
    '#default_value' => theme_get_setting('cu_theme_base_bootstrap_icons'),
  ];
  $form['fonts']['icons'] = [
    '#type' => 'details',
    '#title' => t('Icons'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];
  $form['fonts']['icons']['cu_theme_base_icons'] = [
    '#type' => 'select',
    '#title' => t('Icon set'),
    '#default_value' => theme_get_setting('cu_theme_base_icons'),
    '#empty_option' => t('None'),
    '#options' => [
      'material_design_icons' => t('Material Design Icons'),
      'fontawesome' => t('Font Awesome'),
    ],
  ];

  // Colors.
  $form['colors'] = [
    '#type' => 'details',
    '#title' => t('Colors'),
    '#group' => 'bootstrap',
  ];

  // System messages.
  $form['colors']['alerts'] = [
    '#type' => 'details',
    '#title' => t('System messages'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];
  $form['colors']['alerts']['cu_theme_base_system_messages'] = [
    '#type' => 'select',
    '#title' => t('System messages color scheme'),
    '#default_value' => theme_get_setting('cu_theme_base_system_messages'),
    '#empty_option' => t('Default'),
    '#options' => [
      'messages_white' => t('White'),
      'messages_gray' => t('Gray'),
      'messages_light' => t('Light color'),
      'messages_dark' => t('Dark color'),
    ],
    '#description' => t('Replace the standard color scheme for system messages with a Google Material Design color scheme.'),
  ];
  $form['colors']['tables'] = [
    '#type' => 'details',
    '#title' => t('Tables'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  ];
  $form['colors']['tables']['cu_theme_base_table_style'] = [
    '#type' => 'select',
    '#title' => t('Table cell style'),
    '#default_value' => theme_get_setting('cu_theme_base_table_style'),
    '#empty_option' => t('Default'),
    '#options' => [
      'table-striped' => t('Striped'),
      'table-bordered' => t('Bordered'),
    ],
  ];
  $form['colors']['tables']['cu_theme_base_table_hover'] = [
    '#type' => 'checkbox',
    '#title' => t('Hover effect over table cells'),
    '#default_value' => theme_get_setting('cu_theme_base_table_hover'),
  ];
  $form['colors']['tables']['cu_theme_base_table_head'] = [
    '#type' => 'select',
    '#title' => t('Table header color scheme'),
    '#default_value' => theme_get_setting('cu_theme_base_table_head'),
    '#empty_option' => t('Default'),
    '#options' => [
      'thead-light' => t('Light'),
      'thead-dark' => t('Dark'),
    ],
  ];
}
