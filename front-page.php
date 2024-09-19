<?php
/**
 * Template Name: Homepage
 *
 * @package YourThemeName
 */

get_header(); ?>

<section id="lead-articles" class="lead-articles py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php get_template_part('template-parts/front-page/section-lead-left-wide'); ?>
            
            </div>
            <div class="col-md-3">
            <?php get_template_part('template-parts/front-page/section-lead-centre-narrow'); ?>
                
            
            </div>
            <div class="col-md-3">
            <?php get_template_part('template-parts/front-page/section-lead-right-narrow'); ?>
                
            
            </div>
        </div>
    </div>
</section>



<section id="latest-articles" class="latest-articles py-5 bg-light">
    <div class="container">
        <div class="lead-left">
            <?php //get_template_part('template-parts/front-page/section-lead-left-wide'); ?>
        </div>
    </div>
</section>



<section id="about" class="about py-5">
    
</section>

<?php get_footer(); ?>





