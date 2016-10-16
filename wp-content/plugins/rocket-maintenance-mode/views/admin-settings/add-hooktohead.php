<?php if ( get_option('mmp_fft') ): ?>
<link rel='stylesheet' id='textfont-css'  href='http://fonts.googleapis.com/css?family=<?php esc_attr_e(str_replace("+"," ",get_option("mmp_fft"))) ?>:400,300,700,900' type='text/css' media='all' />
<?php endif; ?>

<?php if ( get_option('mmp_ffht') ): ?>
<link rel='stylesheet' id='textfont-css'  href='http://fonts.googleapis.com/css?family=<?php esc_attr_e(str_replace("+","+",get_option("mmp_ffht"))) ?>:400,700,900' type='text/css' media='all' />
<?php endif; ?>


<?php if ( get_option('mmp_analytics') !== '' ): ?>
	<?php echo get_option('mmp_analytics') ?>
<?php endif; ?>

<?php if ( get_option('mmp_custom_header_script') !== '' ): ?>
	<?php echo get_option('mmp_custom_header_script') ?>
<?php endif; ?>