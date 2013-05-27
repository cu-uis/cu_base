<?php
/**
 * @file
 * template-settings.php
 */

/**
 * Prameter definitions for Bootstrap Barrio.
 */
function bootstrap_barrio_form_system_theme_settings_alter(&$form, $form_state, $form_id = NULL) {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  $form['front'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Print content on front page'),
    '#description'   => t('Let you decide to print or not the content in the front page. This avoid the message no front content has been created and let handle front page information thru Blocks or Boxes.'),
  );

  $form['front']['print_content'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Print content on front page.'),
    '#default_value' => theme_get_setting('print_content'),
    '#description'   => t('Decide if you wish to print content on front page. Usefull if you prefer to handle front page thru blocks or Boxes.'),
  );

  $form['responsive'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Theme responsive settings'),
    '#description'   => t('Activates the Twitter Bootstrap responsive functions.'),
  );

  $form['responsive']['toggle_responsive'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Make the site responsive'),
    '#default_value' => theme_get_setting('toggle_responsive'),
    '#description'   => t('Insert meta viewport to make site responsive'),
  );
  $form['responsive']['nav_style'] = array(
    '#type'          => 'select',
    '#title'         => t('Header behaivor'),
    '#default_value' => theme_get_setting('nav_style'),
    '#options' => array(
      0 => t('Scroll with page'),
      1 => t('Fixed on top'),
    ),
    '#description'   => t('Define the behaivor of the page header'),
  );
  $form['responsive']['collapse'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Collapse main menu'),
    '#default_value' => theme_get_setting('collapse'),
    '#description'   => t('When responsive, make the main menu collapse.'),
  );
  $form['responsive']['fluid'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Makes layout fluid or fixed'),
    '#default_value' => theme_get_setting('fluid'),
    '#description'   => t('The default state is fixed, if you check it will make fluid layout.'),
  );

  $form['span'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Column width settings'),
    '#description'   => t('Define the width of primary and secondary columns based on Twitter Bootstrap Span. The page is divided into 12 columns, main content width is automatically calculated.'),
  );
  $form['span']['sidebar_first_width'] = array(
    '#type'          => 'select',
    '#title'         => t('First column width'),
    '#default_value' => theme_get_setting('sidebar_first_width'),
    '#options' => array(
      2 => t('Span2'),
      3 => t('Span3'),
      4 => t('Span4'),
    ),
    '#description'   => t('Define the width of the first column based on Span grid system'),
  );
  $form['span']['sidebar_second_width'] = array(
    '#type'          => 'select',
    '#title'         => t('Second column width'),
    '#default_value' => theme_get_setting('sidebar_second_width'),
    '#options' => array(
      2 => t('Span2'),
      3 => t('Span3'),
      4 => t('Span4'),
    ),
    '#description'   => t('Define the width of the second column based on Span grid system'),
  );

}
