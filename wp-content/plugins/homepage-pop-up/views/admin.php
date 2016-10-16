<?php

// Class mlab_popup pour l'admin

class mlab_popup {
	
	 
	public static function showOptionsPage( )
	{
		global $wpdb;	
		$table_name 	= $wpdb->prefix . MLAB_DB_TABLE;	 
		$result			= $wpdb->get_results( "SELECT * FROM $table_name" );
		$options 		= unserialize($result[0]->options);
		 
		// Ajout des CSS et JS
 		wp_enqueue_style( 'style-name', MLAB_ROOT_URL . '/css/mlab_popup.css' );
		wp_enqueue_script( 'script-name', MLAB_ROOT_URL . '/js/mlab_popup.js', array(), '1.0.0', true );     
		get_screen_icon( 'options-general' );  ?>

        <div class="wrap">
          <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2"> 
              <!-- /post-body-content -->
              <form method="post" action="" enctype="multipart/form-data">
                <div id="postbox-container-1" class="postbox-container">
                  <div id="side-sortables" class="meta-box-sortables ui-sortable">
                    <div id="postimagediv" class="postbox ">
                      <div class="handlediv"><br>
                      </div>
                      <h3 class="hndle"><span><?php _e( 'Action', 'mlab_popup'); ?></span></h3>
                      <div class="inside">
                        <div class="misc-pub-section misc-pub-post-status">
                          <label for="post_status"><?php _e( 'Stat', 'mlab_popup'); ?>&nbsp;:</label>
                          <span id="post-status-display"><?php $options['activate'] == '1'? _e( 'Active', 'mlab_popup'): _e( 'Inactive', 'mlab_popup'); ?></span>
                          <div id="post-status-select">
                            <select name="activate" id="activate">
                              <option <?php echo $options['activate'] == '1'? 'selected="selected"':'';?> value="1">
                              <?php   _e('Active','mlab_popup') ?>
                              </option>
                              <option <?php echo $options['activate'] == '0'? 'selected="selected"':'';?>value="0">
                              <?php _e( 'Inactive', 'mlab_popup'); ?>
                              </option>
                            </select>
                          </div>
                          <p class="submit">
                            <input type="submit" name="mlab_popup_submit" id="mlab_popup_submit" class="button button-primary" value="<?php _e('Save','mlab_popup')?>">
                            <input type="button" name="mlab_popup_preview" id="mlab_popup_preview" class="button button-primary" value="<?php _e('Preview','mlab_popup')?>">
                          </p>
                          <p id="preview_help" class="description">
                            <?php _e('Preview is only available in text mode','mlab_popup')?>
                            .</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="postbox-container-2" class="postbox-container">
                  <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div id="team_metabox" class="postbox ">
                      <div class="handlediv" title="Cliquer pour inverser."><br>
                      </div>
                      <h3 class="hndle"><span>Magneticlab Homepage Pop-up</span></h3>
                      <div class="inside">
                        <table class="form-table">
                          <tbody>
                            <tr valign="top">
                              <th scope="row"> <label for="popup_width">
                                  <?php   _e('Width','mlab_popup') ?>
                                </label></th>
                              <td><input name="popup_width" type="text" id="popup_width" size="10" value="<?php echo $options['width'];?>" >
                                px (min 200px) </td>
                            </tr>
                            <tr valign="top">
                              <th scope="row"><label for="popup_titre">
                                  <?php _e('Heading','mlab_popup')?>
                                </label></th>
                              <td><input name="popup_titre" type="text" id="popup_titre" value="<?php echo $result[0]->titre; ?>" class="regular-text"></td>
                            </tr>
                            <tr valign="top">
                              <th scope="row"><label for="popup_content">
                                  <?php _e('Content','mlab_popup')?>
                                </label></th>
                              <td><?php wp_editor( $result[0]->text, 'popup_content', $settings = array('tinymce' => true) ); ?></td>
                            </tr>
                            <tr valign="top">
                              <th scope="row"><label for="popup_content">
                                  <?php _e('Call to action','mlab_popup')?>
                                </label></th>
                              <td><input name="popup_label" type="text" id="popup_label" value="<?php echo $options['label']; ?>" class="regular-text" placeholder="<?php _e('Label','mlab_popup')?>"> &nbsp;                        
                                  <input name="popup_link" type="text" id="popup_link" value="<?php echo $options['link']; ?>" class="regular-text" placeholder="<?php _e('Link','mlab_popup')?> (http://www.example.com)"></td>
                            </tr>
                            <tr valign="top">
                              <th scope="row"><label for="popup_donotshow">
                                  <?php _e('Do not show again option','mlab_popup')?>
                                </label></th>
                               <td>  <input type="checkbox" value="1" id="popup_donotshow"  name="donotshow" <?php  echo $options['donotshow']? 'checked="checked"': ''; ?>  />                       
                                   </td> 
                            </tr>
                            <tr valign="top">
                              <th scope="row"><label for="disable_phone">
                                  <?php _e('Disable on smartphones','mlab_popup')?>
                                </label></th>
                               <td>  <input type="checkbox" value="1" id="disable_phone"  name="disable_phone" <?php  echo $options['disable_phone']? 'checked="checked"': ''; ?>  />                       
                                   </td> 
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /post-body --> 
            
            <br class="clear">
            <p><span>Version <?php echo get_option( "mlab_db_version" ) ?></span> <?php printf(__('by %1$s | %2$s', 'mlab_popup'), '<strong>Magneticlab Sàrl</strong>', '<strong><a href="http://www.magneticlab.ch" title="Web design lab">magneticlab.ch</a></strong>'); ?></p>
          </div>
        </div>
<?php		
// Preview
// Largeur minimum autorisée = 200
$max_width =  $options['width'] <= 199? '200': $options['width'];	 

print '<div class="mlab-modal fades in "tabindex="-1" role="dialog" style="display: none;">
    <div class="mlab-modal-dialog" style="width:'.$max_width.'px;">
      <div class="mlab-modal-content">
        <div class="mlab-modal-header">
         <img class="mlab-close" src="' . MLAB_ROOT_URL . '/images/close_pop.png" title="' . __('Close Window','mlab_popup') . '" alt="Close" width="25" height="25"> 
          <h4 class="mlab-modal-title">'.$result[0]->titre.'</h4>
        </div>
        <div class="mlab-modal-body">  
        </div>
        <div class="mlab-modal-footer" style="display:none">
			<a href="" class="mlab-modal-link"><input type="button" class="button button-primary mlab-modal-label" value=""></a>
			<div class="mlab-modal-donotshow"><input type="checkbox"> <span>' . __( 'Do not show again','mlab_popup' ) . '</span></div>
		</div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>';
	 }
	 
 }








