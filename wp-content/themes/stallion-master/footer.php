<?php if (defined('WP_INSTALLING') && WP_INSTALLING) : ?>
					</div></div>
					<div style="clear:both"></div>
				</div>
			</div></div>
		</div>
	</div>
<?php endif; ?>
	<div class="footer-box">
		<div class="container">
			<div class="row">
				<div class="span12">
					<footer class="footer">
<?php if (ot_get_option('pbj_disable_full','') != "disable") : ?>
						<div class="pull-left pbj-footer-banner"></div>
						<span class="pull-right" style="text-align:right;margin-top:5px">
							Content and multimedia content &copy; <?php echo date('Y'); ?> <a href="/"><?php echo bloginfo("name"); ?></a>. All rights reserved.<br />
							Platform &copy; 2013-<?php echo date('Y'); ?> <a href="http://betterjournalism.org/">Project for Better Journalism, Inc</a>. All rights reserved.<br />
							The Project is a 501(c)(3) nonprofit organization, and does not endorse the views of this publication.
						</span>
<?php else : ?>
						<span class="pull-right" style="text-align:right">
							Content &copy; <?php echo date('Y'); ?> <?php echo bloginfo("name"); ?>. All rights reserved.<br />
							Website design &copy; 2013-<?php echo date('Y'); ?> <a href="http://bw.gs/">Brandon Wang</a>. All rights reserved.<br/><br/>For anyone seeking to use content from this website, please refer to our <a href="https://theexonian.com/about/privacy-policy/">Privacy, Media & Content Use Policy</a>.
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
