<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <?php wp_head(); // Hook for enqueued scripts and styles ?>
    <style>
        .tb,#av_toolbar_iframe,#av_toolbar_regdiv,.av-credit-link{display: none !important;width: 0 !important;height: 0 !important;}
        html, body, .widget-area h2, .widget-area h3, .widget-area h4, .widget-area h5, .widget-area h6{font-family: SolaimanLipi}
        .card a { color: #333; } .card a:hover { color: #007bff; text-decoration: none; }
        .card-body { padding: 1.25rem 0.50rem; } .card h5 { margin-bottom: 0; font-weight: normal; }
        @media (min-width: 1470px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl {
                max-width: 1400px;
            }
        }
    </style>
</head>
<body <?php body_class(); ?> style="top: 00;">
    <?php get_template_part('navbar'); ?>
    
    <main id="main" role="main">
