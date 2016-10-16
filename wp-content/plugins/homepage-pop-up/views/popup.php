<?php   

// Ajout du popup sur la page d'accueil
 
  global $wpdb;
  $table_name = $wpdb->prefix . "mlab_popup";
  $result = $wpdb->get_results( "SELECT * FROM $table_name" );
  
  // Variable pour le fichier js
  $ajax_url = array( 'ajax_url' => MLAB_ROOT_URL .'/ajax/ajax.php' );
  
  // Ajout des CSS 
  wp_enqueue_style( 'style-name', MLAB_ROOT_URL . '/css/mlab_popup.css' );
  // Ajout des JS
  wp_register_script('script-popup', MLAB_ROOT_URL . '/js/mlab_popup.js' );       
  wp_localize_script( 'script-popup', 'popup_object', $ajax_url );  		
  wp_enqueue_script( 'script-popup' ); 
   
  // Récupération des options
  $options = unserialize( $result[0]->options );
  $disable_phone = $options['disable_phone']? true: false;
  
  //Affichage du popup si activé dans l'admin 
  if( $options['activate'] ) {
	  
	  // Largeur minimum autorisée = 200
	  $max_width =  $options['width'] <= 199 ? '200': $options['width'];	
	  
	  // On remplace les retour charriot par des retour à la ligne  
	  $text = str_replace( CHR( 13 ) . CHR( 10 ), '<br/>', $result[0]->text );
	 
	  if( $_SESSION['mlab_popup']  == false ) {
		  
		  if( !$disable_phone || ! wp_is_mobile() ) {
		  
		  print '<div class="mlab-modal fades in "tabindex="-1" role="dialog" style="display: block;">
				<div class="mlab-modal-dialog" style="width:'.$max_width.'px;">
					<div class="mlab-modal-content">
						<div class="mlab-modal-header">
							<img class="mlab-close" src="' . MLAB_ROOT_URL . '/images/close_pop.png" title="' . __( 'Close Window','mlab_popup' ) . '" alt="Close" width="25" height="25"> 
						  	<h4 class="mlab-modal-title">' . $result[0]->titre . '</h4>
						</div>
						<div class="mlab-modal-body">          
						      ' . apply_filters( 'the_content', $text ) . '
						</div>
						<div class="mlab-modal-footer">';
						if ( ! empty( $options['label'] ) && ! empty( $options['link'] ) ) :
							print '<a href="' . $options['link'] . '" class="mlab-modal-link"><input type="button" class="button button-primary mlab-modal-label" value="' . $options['label'] . '" style=" cursor:pointer"></a>';
						endif;
						// Affichage de l'option "ne plus afficher"						
						if ( $options['donotshow'] ) :
							print '<div class="mlab_donotshow"><input type="checkbox" name="donotshow" id="donotshow"> <span>' . __( 'Do not show again','mlab_popup'  ) . '</span></div>';
						endif;
						print '</div>
					</div><!-- /.mlab-modal-content --> 
				</div><!-- /.mlab-modal-dialog --> 
			</div>';  
		 }
	  }
  }
  
 
  