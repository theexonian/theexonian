<?php

class Wpmmp_Cs_Simple_Theme extends Wpmmp_Theme_Handler {

	protected $name = 'Coming Soon Theme';

	protected $description = 'Responsive beautiful coming soon theme with subscriber box';

	protected $id = 'cs-simple';

	protected $path = '';

	protected $template_name = 'cs-simple';

	protected $use_styles = true;

	function init() {

		$this->path =  WPMMP_PLUGIN_VIEW_DIRECTORY . 'themes/cs-simple/template.php';
	
	}

	function hooks() {

		add_action( 'wpmmp_head', array( $this, 'hook_to_head' ) );

		
		add_action( 'wpmmp_footer', array( $this, 'add_styles' ) );

	}

}
