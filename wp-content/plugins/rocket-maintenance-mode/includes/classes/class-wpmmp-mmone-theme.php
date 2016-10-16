<?php

class Wpmmp_Mmone_Theme extends Wpmmp_Theme_Handler {

	protected $name = 'Maintenance Mode Theme';

	protected $description = 'Responsive beautiful Maintenance mode theme with subscriber box';

	protected $id = 'mm-one';

	protected $path = '';

	protected $template_name = 'mm-one';

	protected $use_styles = true;

	function init() {

		$this->path =  WPMMP_PLUGIN_VIEW_DIRECTORY . 'themes/mm-one/template.php';
	
	}

	

}
