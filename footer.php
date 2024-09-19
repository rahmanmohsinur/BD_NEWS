
</main><!-- /#main -->

<footer id="footer" class="footer bg-light py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <?php
                // Display the site title or description
                bloginfo( 'name' );
                ?>
            </div>
            <div class="col-md-6 text-md-right">
                <?php
                // Display the footer menu if it's assigned
                wp_nav_menu( array(
                    'theme_location' => 'footer', // Location of the menu in your theme
                    'container'      => false,
                    'menu_class'     => 'footer-menu list-unstyled',
                ) );
                ?>
            </div>
        </div>
    </div>
</footer><!-- #footer -->

<?php wp_footer(); // Hook for enqueued scripts and footer content ?>
</body>
</html>
