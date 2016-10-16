<?php 
session_start();
if( isset( $_POST['tag'] ) )
{
	if( $_POST['tag'] == 'true' )
		 $_SESSION['mlab_popup'] = true ;
		
	if( $_POST['tag'] == 'false' )
		 $_SESSION['mlab_popup'] = false ;
}
 