<?php

namespace Drupal\Tests\cu_theme_base\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the CU Base theme.
 *
 * @group claro
 */
class CuBaseTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * Install the shortcut module so that bootstrap_bario.settings has its schema
   * checked. There's currently no way for CU Base to provide a default
   * and have valid configuration as themes cannot react to a module install.
   *
   * @var string[]
   */
  protected static $modules = ['shortcut'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'cu_theme_base';


  /**
   * Test CU Base's configuration schema.
   */
  public function testConfigSchema() {
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('admin/appearance/settings/' . $this->defaultTheme);
    $this->submitForm([], 'Save configuration');
    $this->assertSession()->statusCodeEquals(200);
  }

}
