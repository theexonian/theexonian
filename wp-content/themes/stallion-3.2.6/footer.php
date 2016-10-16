	<div class="footer-box">
		<div class="container">
			<div class="row">
				<div class="span12">
					<footer class="footer">
<?php if (ot_get_option('pbj_disable_full','') != "disable") : ?>
						<div class="pull-left pbj-footer-banner"></div>
						<span class="pull-right" style="text-align:right;margin-top:5px">
							Content and multimedia content &copy; <?php echo date('Y'); ?> <?php echo bloginfo("name"); ?>. All rights reserved.<br />
							<em><?php echo bloginfo("name"); ?></em> is provided and supported by the <a href="http://betterjournalism.org/">Project for Better Journalism</a>.<br />
							The Project, as an independent entity, does not endorse the views of this publication.
						</span>
<?php else : ?>
						<span class="pull-right" style="text-align:right">
							Content &copy; <?php echo date('Y'); ?> <?php echo bloginfo("name"); ?>. All rights reserved.<br />
							Website design &copy; <?php echo date('Y'); ?> <a href="http://brwang.com/">Brandon Wang</a>. All rights reserved.<br />
						</span>
<?php endif; ?>
						<div style="clear:both"></div>
					</footer>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/resources/jquery.balancetext.js"></script>
<?php echo ot_get_option('tracking_code',''); ?>
<?php wp_footer(); ?>
</body>
</html>