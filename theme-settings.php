<?php
/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for Bootstrap Barrio based themes when admin theme is not.
 *
 * @see ./includes/settings.inc
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function bootstrap_barrio_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {

  // General "alters" use a form id. Settings should not be set here. The only
  // thing useful about this is if you need to alter the form for the running
  // theme and *not* the theme setting.
  // @see http://drupal.org/node/943212
  if (isset($form_id)) {
    return;
  }

  //Change collapsible fieldsets (now details) to default #open => FALSE.
  $form['theme_settings']['#open'] = FALSE;
  $form['logo']['#open'] = FALSE;
  $form['favicon']['#open'] = FALSE;

  // Library settings
  if (\Drupal::moduleHandler()->moduleExists('bootstrap_library')) {
    $form['bootstrap_barrio_library'] = array(
      '#type' => 'select',
      '#title' => t('Load library'),
      '#description' => t('Select how to load the Bootstrap Library.'),
      '#default_value' => theme_get_setting('bootstrap_barrio_library'),
      '#options' => array(
        'cdn' => t('CDN'),
        'development' => t('Local non minimized (development)'),
        'production' => t('Local minimized (production)'),
      ),
      '#empty_option' => t('None'),
      '#description' => t('If none is selected you should load the library via Bootstrap Library or manually. If CDN is selected, the library version must be configured on !boostrap_library_link',  array('!bootstrap_library_link' => Drupal::l('Bootstrap Library Settings' , Url::fromRoute('bootstrap_library.admin')))),
    );
  }

  // Vertical tabs
  $form['bootstrap'] = array(
    '#type' => 'vertical_tabs',
    '#prefix' => '<h2><small>' . t('Bootstrap Settings') . '</small></h2>',
    '#weight' => -10,
  );

  // Layout.
  $form['layout'] = array(
    '#type' => 'details',
    '#title' => t('Layout'),
    '#group' => 'bootstrap',
  );

  //Container
  $form['layout']['container'] = array(
    '#type' => 'details',
    '#title' => t('Container'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['layout']['container']['bootstrap_barrio_fluid_container'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fluid container'),
    '#default_value' => theme_get_setting('bootstrap_barrio_fluid_container'),
    '#description' => t('Use <code>.container-fluid</code> class. See : !bootstrap_barrio_link', array(
      '!bootstrap_barrio_link' => Drupal::l('Fluid container' , Url::fromUri('http://getbootstrap.com/css/' , ['absolute' => TRUE , 'fragment' => 'grid-example-fluid'])),
    )),
  );

  // Sidebar Position
  $form['layout']['sidebar_position'] = array(
    '#type' => 'details',
    '#title' => t('Sidebar Position'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['layout']['sidebar_position']['bootstrap_barrio_sidebar_position'] = array(
    '#type' => 'select',
    '#title' => t('Sidebars Position'),
    '#default_value' => theme_get_setting('bootstrap_barrio_sidebar_position'),
    '#options' => array(
      'left' => t('Left'),
      'both' => t('Both sides'),
      'right' => t('Right'),
    ),
  );
  $form['layout']['sidebar_position']['bootstrap_barrio_content_offset'] = array(
    '#type' => 'select',
    '#title' => t('Content Offset'),
    '#default_value' => theme_get_setting('bootstrap_barrio_content_offset'),
    '#options' => array(
      0 => t('None'),
      1 => t('1 Cols'),
      2 => t('2 Cols'),
    ),
  );


  // Sidebar First
  $form['layout']['sidebar_first'] = array(
    '#type' => 'details',
    '#title' => t('Sidebar First Layout'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['layout']['sidebar_first']['bootstrap_barrio_sidebar_first_width'] = array(
    '#type' => 'select',
    '#title' => t('Sidebar First Width'),
    '#default_value' => theme_get_setting('bootstrap_barrio_sidebar_first_width'),
    '#options' => array(
      2 => t('2 Cols'),
      3 => t('3 Cols'),
      4 => t('4 Cols'),
    ),
  );
  $form['layout']['sidebar_first']['bootstrap_barrio_sidebar_first_offset'] = array(
    '#type' => 'select',
    '#title' => t('Sidebar First Offset'),
    '#default_value' => theme_get_setting('bootstrap_barrio_sidebar_first_offset'),
    '#options' => array(
      0 => t('None'),
      1 => t('1 Cols'),
      2 => t('2 Cols'),
    ),
  );

  // Sidebar Second
  $form['layout']['sidebar_second'] = array(
    '#type' => 'details',
    '#title' => t('Sidebar Second Layout'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['layout']['sidebar_second']['bootstrap_barrio_sidebar_second_width'] = array(
    '#type' => 'select',
    '#title' => t('Sidebar Second Width'),
    '#default_value' => theme_get_setting('bootstrap_barrio_sidebar_second_width'),
    '#options' => array(
      2 => t('2 Cols'),
      3 => t('3 Cols'),
      4 => t('4 Cols'),
    ),
  );
  $form['layout']['sidebar_second']['bootstrap_barrio_sidebar_second_offset'] = array(
    '#type' => 'select',
    '#title' => t('Sidebar Second Offset'),
    '#default_value' => theme_get_setting('bootstrap_barrio_sidebar_second_offset'),
    '#options' => array(
      0 => t('None'),
      1 => t('1 Cols'),
      2 => t('2 Cols'),
    ),
  );

  // General.
  $form['components'] = array(
    '#type' => 'details',
    '#title' => t('Components'),
    '#group' => 'bootstrap',
  );

  // Buttons.
  $form['components']['buttons'] = array(
    '#type' => 'details',
    '#title' => t('Buttons'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['buttons']['bootstrap_barrio_button_size'] = array(
    '#type' => 'select',
    '#title' => t('Default button size'),
    '#default_value' => theme_get_setting('bootstrap_barrio_button_size'),
    '#empty_option' => t('Normal'),
    '#options' => array(
      'btn-sm' => t('Small'),
      'btn-lg' => t('Large'),
    ),
  $form['components']['buttons']['bootstrap_barrio_button_outline'] = array(
    '#type' => 'checkbox',
    '#title' => t('Buttonn with outline format'),
    '#default_value' => theme_get_setting('bootstrap_barrio_button_outline'),
    '#description' => t('Use <code>.btn-default-outline</code> class. See : !bootstrap_barrio_link', array(
      '!bootstrap_barrio_link' => Drupal::l('Outline Buttons' , Url::fromUri('http://getbootstrap.com/css/' , ['absolute' => TRUE , 'fragment' => 'grid-example-fluid'])),
    )),)
  );

  // Navbar.
  $form['components']['navbar'] = array(
    '#type' => 'details',
    '#title' => t('Navbar'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_top_position'] = array(
    '#type' => 'select',
    '#title' => t('Navbar top position'),
    '#description' => t('Select your navbar top position.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_navbar_top_position'),
    '#options' => array(
      'fixed-top' => t('Fixed Top'),
//      'scroll-fixed-top' => t('Scroll Fixed Top'),
      'fixed-bottom' => t('Fixed Bottom'),
    ),
    '#empty_option' => t('Normal'),
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_top_color'] = array(
    '#type' => 'select',
    '#title' => t('Navbar top color'),
    '#description' => t('Select a color for links in navbar top.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_navbar_top_color'),
    '#options' => array(
      'light' => t('Light'),
      'dark' => t('Dark'),
    ),
    '#empty_option' => t('Default'),
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_top_background'] = array(
    '#type' => 'select',
    '#title' => t('Navbar top background'),
    '#description' => t('Select a color for background in navbar top.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_navbar_top_background'),
    '#options' => array(
      'primary' => t('Primary'),
      'faded' => t('Faded'),
      'inverse' => t('Inverse'),
    ),
    '#empty_option' => t('Default'),
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_position'] = array(
    '#type' => 'select',
    '#title' => t('Navbar Position'),
    '#description' => t('Select your Navbar position.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_navbar_position'),
    '#options' => array(
      'fixed-top' => t('Fixed Top'),
//      'scroll-fixed-top' => t('Scroll Fixed Top'),
      'fixed-bottom' => t('Fixed Bottom'),
    ),
    '#empty_option' => t('Normal'),
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_color'] = array(
    '#type' => 'select',
    '#title' => t('Navbar link color'),
    '#description' => t('Select a color for links in navbar style.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_navbar_color'),
    '#options' => array(
      'light' => t('Light'),
      'dark' => t('Dark'),
    ),
    '#empty_option' => t('Default'),
  );
  $form['components']['navbar']['bootstrap_barrio_navbar_background'] = array(
    '#type' => 'select',
    '#title' => t('Backgroun navbar'),
    '#description' => t('Select a color for background in navbar.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_navbar_background'),
    '#options' => array(
      'primary' => t('Primary'),
      'faded' => t('Faded'),
      'inverse' => t('Inverse'),
    ),
    '#empty_option' => t('Default'),
  );

}
