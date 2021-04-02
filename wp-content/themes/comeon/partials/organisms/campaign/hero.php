<section class="campaign-hero d-flex justify-content-center align-items-center"
         style="background-image: url('<?php the_field('hero_background_image'); ?>');">
  <div class="container hero-content-wrap">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-9 col-12 hero-content">
        <h1><?php the_title(); ?></h1>
        <div class="hero-description">
            <?php the_field('campaign_description'); ?>
        </div>
        <div class="cta-wrap">
          <a href="<?php echo getLinkDependingOnUserRole(); ?>" class="cta-link" target="_blank">
              <?php the_field('cta_button_text'); ?>
          </a>
        </div>
      </div>
    </div>

  </div>
</section>