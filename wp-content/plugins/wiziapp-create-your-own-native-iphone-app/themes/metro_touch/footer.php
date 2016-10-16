			</div>

			<!-- @todo This WP feature is not implemented yet -->
			<div data-role="popup" data-overlay-theme="a" data-position-to="window" data-tolerance="15,15">
				<?php dynamic_sidebar(-1); ?>
			</div>
<?php
	do_action('wiziapp_theme_customized_style');
?>
		</div>
<?php
	wp_footer();
?>
	</body>
</html>