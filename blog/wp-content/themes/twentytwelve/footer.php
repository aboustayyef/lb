<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->

            <!-- Start of StatCounter Code for Default Guide -->
                <script type="text/javascript">
                var sc_project=8489889; 
                var sc_invisible=1; 
                var sc_security="6ec3dc93"; 
                var scJsHost = (("https:" == document.location.protocol) ?
                "https://secure." : "http://www.");
                document.write("<sc"+"ript type='text/javascript' src='" +
                scJsHost +
                "statcounter.com/counter/counter.js'></"+"script>");</script>
                <noscript><div class="statcounter"><a title="web counter"
                href="http://statcounter.com/" target="_blank"><img
                class="statcounter"
                src="https://c.statcounter.com/8489889/0/6ec3dc93/1/"
                alt="web counter"></a></div></noscript>
            <!-- End of StatCounter Code for Default Guide -->

		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>