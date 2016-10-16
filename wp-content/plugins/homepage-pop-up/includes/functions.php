<?php 
 
	$mlab_error = false;
  
	// Add plugin session
	function StartSession()
	{
		if(!session_id())
		{
			session_start();
		}
	}
	
	// Kill plugin session
	function KillSession()
	{
		if ( isset( $_SESSION['mavariable'] ) )
			unset( $_SESSION['mavariable'] );
	}
	
	// Mise à jour des données
	function mlab_update_data()
	{
		global $wpdb, $mlab_error; 
	  
	  	$wpdb->show_errors();
		$table_name	= $wpdb->prefix . MLAB_DB_TABLE;
		$titre		= $_POST['popup_titre'];
		$text		= get_magic_quotes_gpc() ? stripslashes($_POST['popup_content']) : $_POST['popup_content'];
		$activate	= isset( $_POST['activate'] )?	$_POST['activate']:		null;
		$width		= isset( $_POST['popup_width'] )?	$_POST['popup_width']:	'350';
		$label		= $_POST['popup_label'];
		$link		= $_POST['popup_link'];
		$button		= $_POST['donotshow'];
		$phone		= $_POST['disable_phone'];
		
		if( ! empty( $link ) && ! filter_var( $link, FILTER_VALIDATE_URL ) )
		{
			$mlab_error = true; return false;
		}
	  
		$options = serialize( array( "activate"	 => $activate,
									 "width"	 => $width ,
									 "label"	 => $label ,
									 "link"		 => $link,
									 "donotshow" => $button ,
									 "disable_phone" => $phone ,
									 
									)
							 );
						 
		$result = $wpdb->update( $table_name, 
									  array( 'titre'	=> $titre,
											 'text'		=> $text,										  
											 'options' 	=> $options 
											), 
									  array( 'ID' => 1 ), 
									  array( '%s', '%s', '%s' ), 
									  array( '%s' ) 
							  );
		return $result;
	}
  
  function display_message()
  {
	  global $statut, $mlab_error; 
	  switch( $statut )
	  {
		  case'success':
		  echo '<div id="message" class="updated"><p>' . __( 'Update  successful','mlab_popup' ) . '</p></div>';
		  break;
		  case'error':
		  echo '<div id="message" class="error"><p> ' . __( 'Unable to update','mlab_popup' ) . ' </p></div>'; 
		  break;
	  }
	  
	  if( $mlab_error )
	  	echo '<div id="message" class="error"><p> ' . __( 'Your URL ist not valide.<br />
 		  Please provide a valide link. (http://www.example.com)','mlab_popup' ) . ' </p></div>';	  
  }
  
  
  // Si le formulaire est posté
  $updateData = isset( $_POST['mlab_popup_submit'] )? $_POST['mlab_popup_submit']: ''; 
  if( $updateData )
  {
	  if( mlab_update_data() )
	  {
		  $statut = 'success';
		  add_action( 'admin_notices', 'display_message' );
	  } 
	  else 
	  {
		  $statut = 'error';
		  add_action( 'admin_notices', 'display_message' );
	  }  
  }
  
  
  // Interface admin  
  function mlab_create_settings_page()
  {
	  global $mlab_settings_page;
	  
	  if ( function_exists( 'add_options_page' ) )
	  {
		  $page_title 	= 'Homepage Pop-up';
		  $menu_title 	= 'Homepage Pop-up';
		  $capability 	= 'manage_options';
		  $menu_slug 	= MLAB_PLUGIN_SLUG;
		  $function		= array( 'mlab_popup','showOptionsPage' );
		  $mlab_settings_page =  add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function );
	  }	  
  }
 
	  
  // Ajout des CSS et JS
  function mlab_load_scripts( $hook )
  {
	  global $mlab_settings_page; 
	   
	  if( $hook != 'settings_page_mlab_popup' )
	  	return; 	  
	  wp_enqueue_style( 'style-name', MLAB_ROOT_URL . '/css/mlab_popup.css' );
	  wp_enqueue_script( 'custom-js', MLAB_ROOT_URL . '/js/mlab_popup.js' );	  
  }
  
  
  // Ajout de la page popup sur le front si activé
  function add_popup()
  {
	  // Seulement sur la page d'accueil
	  if ( is_home() || is_front_page() )
	  	include_once( MLAB_ROOT_PATH . '/views/popup.php' );		
  } 
  
  // Ajout de liens sur la liste des extensions
  function add_action_links ( $links )
  {
	  $mylinks = array( '<a href="' . admin_url( 'options-general.php?page=homepage-pop-up' ) . '">' . __( 'Settings', 'mlab_popup' ) . '</a>', );
	  return array_merge( $links, $mylinks );
  }
  
  
 


 