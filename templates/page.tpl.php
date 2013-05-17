<header id="navbar" class="<?php print $nav_style; ?>" role="banner">
  <div class="navbar-inner">
    <div class="<?php print $container; ?>">
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <?php if (!empty($secondary_nav)): ?>
      <div id="top">
         <div class="<?php print $container; ?>">
           <?php print render($secondary_nav); ?>
         </div>
      </div>
      <?php endif; ?>
      
      <div id="header">
        <div class="<?php print $container; ?>">
          <?php if (!empty($logo)): ?>
            <a class="logo pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
            </a>
          <?php endif; ?>

          <?php if (!empty($site_name)): ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="brand"><?php print $site_name; ?></a>
            </h1>
          <?php endif; ?>

          <?php if (!empty($primary_nav) || !empty($page['navigation'])): ?>
            <div id="main-nav" class="<?php print $collapse; ?>">
              <nav role="navigation">
                <?php if (!empty($primary_nav)): ?>
                  <?php print render($primary_nav); ?>
                <?php endif; ?>
                <?php if (!empty($page['navigation'])): ?>
                  <?php print render($page['navigation']); ?>
                <?php endif; ?>
              </nav>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>

<?php if (!empty($slider)): ?>
  <div id="slider">
    <?php print $slider; ?>
  </div>
<?php endif; ?>

<div class="main-container <?php print $container; ?>">

  <header role="banner" id="page-header">
    <?php if (!empty($site_slogan)): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#header -->

  <div class="<?php print $row; ?>">

    <?php if (!empty($page['preface'])): ?>
      <div id="preface" class="<?php print $row; ?>">
        <?php print render($page['preface']); ?>
      </div>  <!-- /#preface -->
    <?php endif; ?>  

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="<?php print $sidebar_first_width; ?>" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>  

    <section class="<?php print $content_width; ?>">  
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted hero-unit"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>
      
      <?php if (!empty($page['page_top'])): ?>
      <div id="page-top" class="<?php print $row; ?>">
        <?php print render($page['page_top']); ?>
      </div>  <!-- /#sidebar-second -->
      <?php endif; ?>
      
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <div class="well"><?php print render($page['help']); ?></div>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      
      <?php if ($print_content): ?>
        <div id="content-inner">
          <?php print render($page['content']); ?>
        </div>
      <?php endif; ?>
      
      <?php if (!empty($page['page_bottom'])): ?>
      <div id="page-bottom" class="<?php print $row; ?>">
        <?php print render($page['page_bottom']); ?>
      </div>  <!-- /#sidebar-second -->
      <?php endif; ?>
      
    </section>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="<?php print $sidebar_second_width; ?>" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

    <?php if (!empty($page['postcript_top'])): ?>
      <div id="postcript_top" class="<?php print $row; ?>">
        <?php print render($page['postcript_top']); ?>
      </div>  <!-- /#preface -->
    <?php endif; ?>  

    <?php if (!empty($page['postcript_bottom'])): ?>
      <div id="postcript_top" class="<?php print $row; ?>">
        <?php print render($page['postcript_bottom']); ?>
      </div>  <!-- /#preface -->
    <?php endif; ?>  

  </div>
  <footer class="footer <?php print $container; ?>">
    <?php print render($page['footer']); ?>
  </footer>
</div>
