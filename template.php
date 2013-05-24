<?php
/**
 * Override or insert variables into the page template for HTML output.
 * For taxonomy page, insert vocabulary id class.
 * Define the variable to activate responsive behaivor.
 */
function bootstrap_barrio_preprocess_html(&$variables) {
  if (arg(0) == 'taxonomy') {
    $tid = arg(2);
    $taxonomy = taxonomy_term_load($tid);
    $variables['classes_array'][] = 'vid-' . $taxonomy->vid;
  }
  if (theme_get_setting('toggle_responsive')) {
    $variables['mobile_friendly'] = TRUE;
  } 
  else {
    $variables['mobile_friendly'] = FALSE;
  }
}

/**
 * Override or insert variables into the page template for page output.
 * Sets the widths of the main columns of the page.
 */
function bootstrap_barrio_preprocess_page(&$variables) {
  $variables['content_width'] = 'span' . _bootstrap_barrio_content_width();
  $variables['sidebar_first_width'] = 'span' . theme_get_setting('sidebar_first_width');
  $variables['sidebar_second_width'] = 'span' . theme_get_setting('sidebar_second_width');
  $variables['nav_style'] = _bootstrap_barrio_nav_style(theme_get_setting('nav_style'));
  if (!theme_get_setting('print_content') && drupal_is_front_page()) {
    $variables['print_content'] = FALSE;
  } 
  else {
    $variables['print_content'] = TRUE;
  }
  if (theme_get_setting('collapse')) {
    $variables['collapse'] = 'nav-collapse collapse';
  } else {
    $variables['collapse'] = 'not-collapse';
  }
  if (theme_get_setting('fluid') || (arg(0) == 'admin')) {
    $variables['container'] = 'container-fluid';
    $variables['row'] = 'row-fluid';
  } 
  else {
    $variables['container'] = 'container';
    $variables['row'] = 'row';
  }
}

/**
 * Returns with of content region.
 * Calculates content width based on first and second column width parameters.
 */
function _bootstrap_barrio_content_width() {
  $sidebar_first_width = (_bootstrap_barrio_block_list('sidebar_first')) ? theme_get_setting('sidebar_first_width') : 0;
  $sidebar_second_width = (_bootstrap_barrio_block_list('sidebar_second')) ? theme_get_setting('sidebar_second_width') : 0;
  $content_width = 12 - $sidebar_first_width - $sidebar_second_width;
  return $content_width;
}

/**
 * Returns a list of blocks.
 * Uses Drupal block interface and appends any blocks assigned by the Context module.
 * Taken from Fusion Core.
 */
function _bootstrap_barrio_block_list($region) {
  $drupal_list = array();
  if (module_exists('block')) {
    $drupal_list = block_list($region);
  }
  if (module_exists('context') && $context = context_get_plugin('reaction', 'block')) {
    $context_list = $context->block_list($region);
    $drupal_list = array_merge($context_list, $drupal_list);
  }
  return $drupal_list;
}

/**
 * Returns style for main navigation bar.
 */
function _bootstrap_barrio_nav_style($theme_nav_style) {
  switch ($theme_nav_style) {
    case 0:
      $nav_style = 'navbar navbar-static-top';
      break; 
    case 1:
      $nav_style = 'navbar navbar-fixed-top';
      break; 
    case 2:
      $nav_style = 'nav-collapse collapse';
      break; 
    default:
      $nav_style = 'navbar navbar-static-top';
      break;
  }
  return $nav_style;
}
