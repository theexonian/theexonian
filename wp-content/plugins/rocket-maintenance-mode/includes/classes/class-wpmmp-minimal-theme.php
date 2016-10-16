<?php

class Wpmmp_Minimal_Theme extends Wpmmp_Theme_Handler {

	protected $name = 'Coming Soon Theme';

	protected $description = 'Minimalist maintenance mode and coming soon theme.';

	protected $id = 'minimal';

	protected $path = '';

	protected $template_name = 'minimal';

	protected $use_styles = true;

	function init() {

		$this->path =  WPMMP_PLUGIN_VIEW_DIRECTORY . 'themes/minimal/template.php';
	
	}

}
