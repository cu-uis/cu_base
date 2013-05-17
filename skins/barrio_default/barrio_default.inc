<?php

/**
 * @file orange.skinr.inc
 * Implementation of a Skinr plugin.
 */
 
/**
 * Implements hook_skinr_group_info().
 *
 * Optional. Defines group(s) that will contain skins. Groups are form element
 * containers used to organize skins categorically using vertical_tabs. If you
 * don't define a group, your skins will appear in Skinr's default group, which
 * is labeled "General."
 *
 * Group name(s):
 * Each group name must be unique. It is recommended to prefix the name of each
 * group with the name of the theme or module name implementing it, followed by
 * the name of the group. Note that you cannot define 2 groups with the same
 * the same name, even if they are in different plugins.
 *
 * Group properties:
 * - title (required): Brief title of the tab.
 * - description (optional): Description of the tab group.
 * - weight (discouraged): Weight of the tab group; NULL by default.
 *
 * The "hook" prefix is substituted with the name of the module or theme that
 * implements it, followed by the plugin name, e.g.
 * THEMENAME_PLUGINNAME_skinr_group_info(), or
 * MODULENAME_PLUGINNAME_skinr_group_info().
 */
function bootstrap_barrio_skinr_group_info() {
  $groups['bootstrap_barrio_links'] = array(
    'title' => t('Links'),
    'description' => t('Choose one or more styles to apply to links and menus.'),
  );
  return $groups;
}

/**
 * Implements hook_skinr_skin_info().
 *
 * Required. Define the skin(s) for this Skinr plugin. Each skin definition
 * consists of properties that define its form element and settings that are
 * needed to make it work, such as the class(es) Skinr should apply, which files
 * it should load, whether or not it should be disabled by default and which
 * theme hook(s) it was designed to work with.
 *
 * Skin name(s):
 * Each skin name must be unique. It is recommended to prefix the name of each
 * skin with the name of the theme or module name implementing it, followed by
 * the name of the skin. Note that you cannot define 2 skins with the same
 * the same name, even if they are in different plugins.
 *
 * Skin settings:
 * - title (required): Title of the skin form element.
 * - description (optional): Description of the skin form element.
 * - group (optional): The group the skin is attached to; defaults to a Skinr
 *   provided group labeled "General."
 * - type (optional): The type of form element. Allowed values:
 *   - checkboxes (default): Useful when single or multiple options can be
 *     chosen.
 *     Does not need to be set manually, as Skinr will apply this by default.
 *   - select: Useful when a single option can be chosen, but many exist.
 *   - radios: Useful when a single option can be chosen and only a few options
 *     exist.
 * - weight (discouraged): Sets the weight of the skin inside the group; NULL
 *   by default. weight should not be set on each individual skin. Instead 
 * - attached (optional): A array containing information about CSS and
 *   JavaScript files the skin requires. Each entry is an array keyed by type:
 *   - css (optional): Maps to the functionality of drupal_add_css() with one
 *     exception: paths are automatically assumed relative to the plugin
 *     directory, unless external. Examples:
 *     - Simple:
 *       'css' => array('css/skin-name.css')
 *     - Advanced:
 *       'css' => array(
 *         array('css/skin-name-ie.css', array(
 *           'media' => 'screen',
 *           'browsers' => array('IE' => 'lte IE 8'),
 *         ),
 *       )
 *   - js (optional): Maps to the functionality of drupal_add_js() with one
 *     exception: paths are automatically assumed as relative to the plugin
 *     directory, unless external. Examples:
 *     - Simple:
 *       'js' => array('js/skin-name.js')
 *     - Advanced:
 *       'js' => array(
 *         array(
 *           'js/skin-name-advanced.js',
 *           array(
 *             'scope' => 'footer',
 *             'group' => JS_THEME,
 *         ),
 *       )
 * - options (required): An array containing one or more options (also arrays)
 *   for the user to choose from when applying skins. Each option key should be
 *   a machine name describing the option. An option should including the
 *   following keys:
 *   - label (required): The option label.
 *   - class (required): An array containing one or more classes the skin
 *     should apply. All classes should be entered as an array: For example:
 *       'class' => array('class-b', 'class-b')
 *   - attached (optional): Same syntax as above, but applies to a specific
 *     option only.
 * - theme hooks (optional): An array containing certain allowed hooks, which
 *   allow you to limit where the skin can be used. Allowed options include:
 *   block, block__MODULE, comment, comment__NODETYPE, comment_wrapper,
 *   comment__wrapper_NODETYPE, node, node__NODETYPE, region,
 *   region__REGIONNAME, panels_display, panels_region, panels_pane, views_view,
 *   views_view__STYLENAME, views_view__DISPLAY_NAME, views_view__VIEWNAME, and
 *   views_view__VIEWNAME_DISPLAYNAME.
 * - default_status (optional): Skins are disabled by default to keep UI
 *   clutter to a minimum. In some cases, like contrib themes, it makes sense to
 *   enable skins which are required to make the theme work properly by default.
 *   Setting this property to 1, will cause it to be enabled it by default for
 *   all installed themes.
 *
 * The "hook" prefix is substituted with the name of the module or theme
 * implementing it, followed by the plugin name, e.g.
 * THEMENAME_PLUGINNAME_skinr_skin_info(), or
 * MODULENAME_PLUGINNAME_skinr_skin_info().
 * 
 */
function bootstrap_barrio_skinr_skin_barrio_default_info() {
  $skins = array();
  
  $skins['bootstrap_barrio_span'] = array(
    'title' => t('Bootstrap Column Span'),
    'description' => t('Define the SPAN value for Bootstrap Columns.'),
    'type' => 'select',
    'theme hooks' => array('block','region'),
    'group' => 'layout',
    'default status' => 1,
    'options' => array(
      'option_1' => array(
        'title' => t('Span 1'),
        'class' => array('span1'),
      ),
      'option_2' => array(
        'title' => t('Span 2'),
        'class' => array('span2'),
      ),
      'option_3' => array(
        'title' => t('Span 3'),
        'class' => array('span3'),
      ),
      'option_4' => array(
        'title' => t('Span 4'),
        'class' => array('span4'),
      ),
      'option_5' => array(
        'title' => t('Span 5'),
        'class' => array('span5'),
      ),
      'option_6' => array(
        'title' => t('Span 6'),
        'class' => array('span6'),
      ),
      'option_7' => array(
        'title' => t('Span 7'),
        'class' => array('span7'),
      ),
      'option_8' => array(
        'title' => t('Span 8'),
        'class' => array('span8'),
      ),
      'option_9' => array(
        'title' => t('Span 9'),
        'class' => array('span9'),
      ),
      'option_10' => array(
        'title' => t('Span 10'),
        'class' => array('span10'),
      ),
      'option_11' => array(
        'title' => t('Span 11'),
        'class' => array('span11'),
      ),
      'option_12' => array(
        'title' => t('Span 12'),
        'class' => array('span12'),
      ),
    ),
  );

  $skins['bootstrap_barrio_offset'] = array(
    'title' => t('Bootstrap Column Offset'),
    'description' => t('Define the OFFSET value for Bootstrap Columns.'),
    'type' => 'select',
    'theme hooks' => array('block','region'),
    'group' => 'layout',
    'default status' => 1,
    'options' => array(
      'option_1' => array(
        'title' => t('Offset 1'),
        'class' => array('offset1'),
      ),
      'option_2' => array(
        'title' => t('Offset 2'),
        'class' => array('offset2'),
      ),
      'option_3' => array(
        'title' => t('Offset 3'),
        'class' => array('offset3'),
      ),
      'option_4' => array(
        'title' => t('Offset 4'),
        'class' => array('offset4'),
      ),
      'option_5' => array(
        'title' => t('Offset 5'),
        'class' => array('offset5'),
      ),
      'option_6' => array(
        'title' => t('Offset 6'),
        'class' => array('offset6'),
      ),
      'option_7' => array(
        'title' => t('Offset 7'),
        'class' => array('offset'),
      ),
      'option_8' => array(
        'title' => t('Offset 8'),
        'class' => array('offset8'),
      ),
      'option_9' => array(
        'title' => t('Offset 9'),
        'class' => array('offset9'),
      ),
      'option_10' => array(
        'title' => t('Offset 10'),
        'class' => array('offset10'),
      ),
      'option_11' => array(
        'title' => t('Offset 11'),
        'class' => array('offset11'),
      ),
    ),
  );

  $skins['bootstrap_barrio_row'] = array(
    'title' => t('Bootstrap Row'),
    'type' => 'select',
    'description' => t('Define a DIV as row or row fluid.'),
    'theme hooks' => array('block', 'region'),
    'group' => 'layout',
    'default status' => 1,
    'options' => array(
      'option_1' => array(
        'title' => t('Row'),
        'class' => array('row'),
      ),
      'option_2' => array(
        'title' => t('Row Fluid'),
        'class' => array('row-fluid'),
      ),
    ),
  );
  
  $skins['bootstrap_barrio_container'] = array(
    'title' => t('Bootstrap Container'),
    'type' => 'select',
    'description' => t('Define a DIV as container or container fluid.'),
    'theme hooks' => array('block', 'region'),
    'group' => 'layout',
    'default status' => 1,
    'options' => array(
      'option_1' => array(
        'title' => t('Container'),
        'class' => array('container'),
      ),
      'option_2' => array(
        'title' => t('Container Fluid'),
        'class' => array('container-fluid'),
      ),
    ),
  );
  
  $skins['bootstrap_barrio_responsive_utility'] = array(
    'title' => t('Bootstrap Responsive Utility Classes'),
    'type' => 'select',
    'description' => t('Definitions for responsive classes to show hide blocks or regions.'),
    'theme hooks' => array('block', 'region', 'node'),
    'group' => 'layout',
    'default status' => 1,
    'options' => array(
      'option_1' => array(
        'title' => t('Visible Phone'),
        'class' => array('visible-phone'),
      ),
      'option_2' => array(
        'title' => t('Visible Tablet'),
        'class' => array('visible-tablet'),
      ),
      'option_3' => array(
        'title' => t('Visible Desktop'),
        'class' => array('visible-desktop'),
      ),
      'option_4' => array(
        'title' => t('Hidden Phone'),
        'class' => array('hidden-phone'),
      ),
      'option_5' => array(
        'title' => t('Hidden Tablet'),
        'class' => array('hidden-tablet'),
      ),
      'option_6' => array(
        'title' => t('Hidden Desktop'),
        'class' => array('hidden-desktop'),
      ),
    ),
  );
  
  $skins['bootstrap_barrio_modal'] = array(
    'title' => t('Modal Block'),
    'type' => 'checkboxes',
    'description' => t('Define a block as Modal. Requieres button to trigger.'),
    'theme hooks' => array('block'),
    'group' => 'box',
    'default status' => TRUE,
    'options' => array(
      'bootstrap_barrio_modal' => array(
        'title' => t('Set as modal.'),
        'class' => array('modal fade hide'),
      ),
    ),
  );
  
  $skins['bootstrap_barrio_navbar'] = array(
    'title' => t('Navigation Bar'),
    'type' => 'checkboxes',
    'description' => t('Define Navigation Bar characteristics.'),
    'theme hooks' => array('block_menu'),
    'group' => 'box',
    'default status' => TRUE,
    'options' => array(
      'option_1' => array(
        'title' => t('Visible Phone'),
        'class' => array('navbar-fixed-top'),
      ),
      'option_2' => array(
        'title' => t('Visible Tablet'),
        'class' => array('navbar-fixed-bottom'),
      ),
      'option_3' => array(
        'title' => t('Visible Desktop'),
        'class' => array('navbar-static-top'),
      ),
    ),
  );
  
  $skins['bootstrap_barrio_collapse'] = array(
    'title' => t('Collapsible responsive menu'),
    'type' => 'checkboxes',
    'description' => t('Define a menu as responsive collapsible. Needs to define navbar toggle button, .btn-navbar.'),
    'theme hooks' => array('block_menu'),
    'group' => 'box',
    'default status' => TRUE,
    'options' => array(
      'bootstrap_barrio_collapse_menu' => array(
        'title' => t('Set as collapsible.'),
        'class' => array('nav-collapse collapse'),
      ),
    ),
  );
  
  return $skins;
}
