<?php

class Wpmmp_Launch_Theme extends Wpmmp_Theme_Handler {

	protected $name = 'Product Launch';

	protected $description = 'Responsive beautiful pre launch product theme';

	protected $id = 'pre-launch';

	protected $path = '';

	protected $template_name = 'pre-launch';

	protected $use_styles = true;

	function init() {

		$this->path =  WPMMP_PLUGIN_VIEW_DIRECTORY . 'themes/pre-launch/template.php';
	
	}

	

}
