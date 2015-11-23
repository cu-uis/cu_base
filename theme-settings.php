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

  // Footer Layout
  $form['layout']['footer'] = array(
    '#type' => 'details',
    '#title' => t('Footer Layout'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['layout']['footer']['bootstrap_barrio_footer_layout'] = array(
    '#type' => 'select',
    '#title' => t('Footer Regions Position'),
    '#default_value' => theme_get_setting('bootstrap_barrio_footer_layout'),
    '#options' => array(
      '1-1-1-1-1-1' => '1-1-1-1-1-1',
      '4-1' => '4-1',
      '3-2' => '3-2',
    ),
  );

  // General.
  $form['general'] = array(
    '#type' => 'details',
    '#title' => t('General'),
    '#group' => 'bootstrap',
  );

  // Buttons.
  $form['general']['buttons'] = array(
    '#type' => 'details',
    '#title' => t('Buttons'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['buttons']['bootstrap_barrio_button_size'] = array(
    '#type' => 'select',
    '#title' => t('Default button size'),
    '#default_value' => theme_get_setting('bootstrap_barrio_button_size'),
    '#empty_option' => t('Normal'),
    '#options' => array(
      'btn-sm' => t('Small'),
      'btn-lg' => t('Large'),
    ),
  $form['general']['buttons']['bootstrap_barrio_button_outline'] = array(
    '#type' => 'checkbox',
    '#title' => t('Buttonn with outline format'),
    '#default_value' => theme_get_setting('bootstrap_barrio_button_outline'),
    '#description' => t('Use <code>.btn-default-outline</code> class. See : !bootstrap_barrio_link', array(
      '!bootstrap_barrio_link' => Drupal::l('Outline Buttons' , Url::fromUri('http://getbootstrap.com/css/' , ['absolute' => TRUE , 'fragment' => 'grid-example-fluid'])),
    )),)
  );

  // Forms.
  $form['general']['forms'] = array(
    '#type' => 'details',
    '#title' => t('Forms'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['forms']['bootstrap_barrio_forms_required_has_error'] = array(
    '#type' => 'checkbox',
    '#title' => t('Make required elements display as an error'),
    '#default_value' => theme_get_setting('bootstrap_barrio_forms_required_has_error'),
    '#description' => t('If an element in a form is required, enabling this will always display the element with a <code>.has-error</code> class. This turns the element red and helps in usability for determining which form elements are required to submit the form.  This feature compliments the "JavaScript > Forms > Automatically remove error classes when values have been entered" feature.'),
  );
  $form['general']['forms']['bootstrap_barrio_forms_smart_descriptions'] = array(
    '#type' => 'checkbox',
    '#title' => t('Smart form descriptions (via Tooltips)'),
    '#description' => t('Convert descriptions into tooltips (must be enabled) automatically based on certain criteria. This helps reduce the, sometimes unnecessary, amount of noise on a page full of form elements.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_forms_smart_descriptions'),
  );
  $form['general']['forms']['bootstrap_barrio_forms_smart_descriptions_limit'] = array(
    '#type' => 'textfield',
    '#title' => t('"Smart form descriptions" maximum character limit'),
    '#description' => t('Prevents descriptions from becoming tooltips by checking the character length of the description (HTML is not counted towards this limit). To disable this filtering criteria, leave an empty value.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_forms_smart_descriptions_limit'),
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_barrio_forms_smart_descriptions"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['general']['forms']['bootstrap_barrio_forms_smart_descriptions_allowed_tags'] = array(
    '#type' => 'textfield',
    '#title' => t('"Smart form descriptions" allowed (HTML) tags'),
    '#description' => t('Prevents descriptions from becoming tooltips by checking for HTML not in the list above (i.e. links). Separate by commas. To disable this filtering criteria, leave an empty value.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_forms_smart_descriptions_allowed_tags'),
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_barrio_forms_smart_descriptions"]' => array('checked' => TRUE),
      ),
    ),
  );

  // JavaScript settings.
  $form['components'] = array(
    '#type' => 'details',
    '#title' => t('Components'),
    '#group' => 'bootstrap',
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

  // JavaScript settings.
  $form['javascript'] = array(
    '#type' => 'details',
    '#title' => t('JavaScript'),
    '#group' => 'bootstrap',
  );

  // Anchors.
  $form['javascript']['anchors'] = array(
    '#type' => 'details',
    '#title' => t('Anchors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['anchors']['bootstrap_barrio_anchors_fix'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fix anchor positions'),
    '#default_value' => theme_get_setting('bootstrap_barrio_anchors_fix'),
    '#description' => t('Ensures anchors are correctly positioned only when there is margin or padding detected on the BODY element. This is useful when fixed navbar or administration menus are used.'),
  );
  $form['javascript']['anchors']['bootstrap_barrio_anchors_smooth_scrolling'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable smooth scrolling'),
    '#default_value' => theme_get_setting('bootstrap_barrio_anchors_smooth_scrolling'),
    '#description' => t('Animates page by scrolling to an anchor link target smoothly when clicked.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="bootstrap_barrio_anchors_fix"]' => array('checked' => FALSE),
      ),
    ),
  );

  // Popovers.
  $form['javascript']['popovers'] = array(
    '#type' => 'details',
    '#title' => t('Popovers'),
    '#description' => t('Add small overlays of content, like those on the iPad, to any element for housing secondary information.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['popovers']['bootstrap_barrio_popover_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable popovers.'),
    '#description' => t('Elements that have the !code attribute set will automatically initialize the popover upon page load. !warning', array(
      '!code' => '<code>data-toggle="popover"</code>',
      '!warning' => '<strong class="error text-error">WARNING: This feature can sometimes impact performance. Disable if pages appear to "hang" after initial load.</strong>',
    )),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_enabled'),
  );
  $form['javascript']['popovers']['options'] = array(
    '#type' => 'details',
    '#title' => t('Options'),
    '#description' => t('These are global options. Each popover can independently override desired settings by appending the option name to !data. Example: !data-animation.', array(
      '!data' => '<code>data-</code>',
      '!data-animation' => '<code>data-animation="false"</code>',
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_barrio_popover_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_animation'] = array(
    '#type' => 'checkbox',
    '#title' => t('animate'),
    '#description' => t('Apply a CSS fade transition to the popover.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_animation'),
  );
  $form['javascript']['popovers']['options']['popover_html'] = array(
    '#type' => 'checkbox',
    '#title' => t('HTML'),
    '#description' => t("Insert HTML into the popover. If false, jQuery's text method will be used to insert content into the DOM. Use text if you're worried about XSS attacks."),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_html'),
  );
  $options = array(
    'top',
    'bottom',
    'left',
    'right',
    'auto',
    'auto top',
    'auto bottom',
    'auto left',
    'auto right',
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_placement'] = array(
    '#type' => 'select',
    '#title' => t('placement'),
    '#description' => t('Where to position the popover. When "auto" is specified, it will dynamically reorient the popover. For example, if placement is "auto left", the popover will display to the left when possible, otherwise it will display right.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_placement'),
    '#options' => array_combine($options, $options),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_selector'] = array(
    '#type' => 'textfield',
    '#title' => t('selector'),
    '#description' => t('If a selector is provided, tooltip objects will be delegated to the specified targets. In practice, this is used to enable dynamic HTML content to have popovers added. See !this and !example.', array(
      '!this' => \Drupal::l(t('this'), Url::fromUri('https://github.com/twbs/bootstrap/issues/4215')),
      '!example' => \Drupal::l(t('an informative example'), Url::fromUri('http://jsfiddle.net/fScua/')),
    )),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_selector'),
  );
  $options = array(
    'click',
    'hover',
    'focus',
    'manual',
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_trigger'] = array(
    '#type' => 'checkboxes',
    '#title' => t('trigger'),
    '#description' => t('How a popover is triggered.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_trigger'),
    '#options' => array_combine($options, $options),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_trigger_autoclose'] = array(
    '#type' => 'checkbox',
    '#title' => t('Auto-close on document click'),
    '#description' => t('Will automatically close the current popover if a click occurs anywhere else other than the popover element.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_trigger_autoclose'),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_title'] = array(
    '#type' => 'textfield',
    '#title' => t('title'),
    '#description' => t("Default title value if \"title\" attribute isn't present."),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_title'),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_content'] = array(
    '#type' => 'textfield',
    '#title' => t('content'),
    '#description' => t('Default content value if "data-content" or "data-target" attributes are not present.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_content'),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('delay'),
    '#description' => t('The amount of time to delay showing and hiding the popover (in milliseconds). Does not apply to manual trigger type.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_delay'),
  );
  $form['javascript']['popovers']['options']['bootstrap_barrio_popover_container'] = array(
    '#type' => 'textfield',
    '#title' => t('container'),
    '#description' => t('Appends the popover to a specific element. Example: "body". This option is particularly useful in that it allows you to position the popover in the flow of the document near the triggering element - which will prevent the popover from floating away from the triggering element during a window resize.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_popover_container'),
  );

  // Tooltips.
  $form['javascript']['tooltips'] = array(
    '#type' => 'details',
    '#title' => t('Tooltips'),
    '#description' => t("Inspired by the excellent jQuery.tipsy plugin written by Jason Frame; Tooltips are an updated version, which don't rely on images, use CSS3 for animations, and data-attributes for local title storage. See !link for more documentation.", array(
      '!link' => \Drupal::l(t('Bootstrap tooltips'), Url::fromUri('http://getbootstrap.com/javascript/#tooltips')),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['tooltips']['bootstrap_barrio_tooltip_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable tooltips'),
    '#description' => t('Elements that have the !code attribute set will automatically initialize the tooltip upon page load. !warning', array(
      '!code' => '<code>data-toggle="tooltip"</code>',
      '!warning' => '<strong class="error text-error">WARNING: This feature can sometimes impact performance. Disable if pages appear to "hang" after initial load.</strong>',
    )),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_enabled'),
  );
  $form['javascript']['tooltips']['options'] = array(
    '#type' => 'details',
    '#title' => t('Options'),
    '#description' => t('These are global options. Each tooltip can independently override desired settings by appending the option name to !data. Example: !data-animation.', array(
      '!data' => '<code>data-</code>',
      '!data-animation' => '<code>data-animation="false"</code>',
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_barrio_tooltip_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_animation'] = array(
    '#type' => 'checkbox',
    '#title' => t('animate'),
    '#description' => t('Apply a CSS fade transition to the tooltip.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_animation'),
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_html'] = array(
    '#type' => 'checkbox',
    '#title' => t('HTML'),
    '#description' => t("Insert HTML into the tooltip. If false, jQuery's text method will be used to insert content into the DOM. Use text if you're worried about XSS attacks."),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_html'),
  );
  $options = array(
    'top',
    'bottom',
    'left',
    'right',
    'auto',
    'auto top',
    'auto bottom',
    'auto left',
    'auto right',
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_placement'] = array(
    '#type' => 'select',
    '#title' => t('placement'),
    '#description' => t('Where to position the tooltip. When "auto" is specified, it will dynamically reorient the tooltip. For example, if placement is "auto left", the tooltip will display to the left when possible, otherwise it will display right.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_placement'),
    '#options' => array_combine($options, $options),
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_selector'] = array(
    '#type' => 'textfield',
    '#title' => t('selector'),
    '#description' => t('If a selector is provided, tooltip objects will be delegated to the specified targets.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_selector'),
  );
  $options = array(
    'click',
    'hover',
    'focus',
    'manual',
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_trigger'] = array(
    '#type' => 'checkboxes',
    '#title' => t('trigger'),
    '#description' => t('How a tooltip is triggered.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_trigger'),
    '#options' => array_combine($options, $options),
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('delay'),
    '#description' => t('The amount of time to delay showing and hiding the tooltip (in milliseconds). Does not apply to manual trigger type.'),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_delay'),
  );
  $form['javascript']['tooltips']['options']['bootstrap_barrio_tooltip_container'] = array(
    '#type' => 'textfield',
    '#title' => t('container'),
    '#description' => t('Appends the tooltip to a specific element. Example: "body"'),
    '#default_value' => theme_get_setting('bootstrap_barrio_tooltip_container'),
  );

}
