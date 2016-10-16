
  <div class='wrap'> 
       
       <?php settings_errors(); ?>

       <form method="post" action="options.php" >
           <?php settings_fields('mmp-settings-group');?>
             
             <h1><?php _e('Maintenance Mode Options Panel')?></h1>
          
          <span>
            To Get Premium Support 24/7 E-mail us: <a href="mailto:umar2bajwa@gmail.com">umar2bajwa@gmail.com</a>
          <br />
          <br>
            If you want to do any feature request or you want us to style your maintenance/coming soon landing page E-mail us: <a href="mailto:umar2bajwa@gmail.com">umar2bajwa@gmail.com</a> 
          
           
           <br>
           </span>

           <br />
            
            <?php $this->admin_tabs(); ?>

<div id="accordion-1" class="accordion active tab-general-settings">
           <div id="hed3"><h3><?php _e('General Settings')?></h3>
           <span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>
           <br>

<table class="form-table">
         <tr valign='top'>
            <th scope='row'><?php _e('Preview Link ');?></th>
            <td>
               <a disabled class="button button-secondary"  target="_blank">Click to Open</a>
               <p class="description">Test Page without Enabling Maintenance Mode.</p>
               <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>

           </td>
          </tr>


         <tr valign='top'>
            <th scope='row'><?php _e('Enable Maintenance Mode ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_on_off" class="onoffswitch-checkbox"  id="myonoffswitch" value='1'<?php checked(1, get_option('mmp_on_off')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
                    <small>Admin users will not get maintenance mode page. Please logout or use your browser private tab for testing. Clear your WordPress cache if any cache plugins are installed.</small>
           </td>
          </tr>



          




       <tr valign='top'>
            <th scope='row'><?php _e(' Enable Progress Bar ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_on_off_progress" class="onoffswitch-checkbox"  id="myonoffswitch8" value='1'<?php checked(1, get_option('mmp_on_off_progress')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch8">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr> 



          

          <tr>
        <th scope='row'><?php _e('Set Progress bar %');?></th>
        <td><label for='mmp_set_progress'>
          <input type='range'  id='mmp_set_progress' name='mmp_set_progress' min='0'  max='100' value='<?php echo get_option('mmp_set_progress') ?>' oninput="this.form.amountInputH.value=this.value" /> <input style="width:60px;" type="number"  name="amountInputH" min="0" max="100" value='<?php echo get_option('mmp_set_progress') ?>' size='2' oninput="this.form.mmp_set_progress.value=this.value"  />
          <p class='description'><?php _e('Set Progress bar percentage') ;?></p>
        </label>
        </td>
      </tr>

      <tr valign='top'>
            <th scope='row'><?php _e(' Enable Countdown Timer ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_on_off_countdown" class="onoffswitch-checkbox"  id="myonoffswitch7" value='1'<?php checked(1, get_option('mmp_on_off_countdown')); ?>  disabled/>
                     <label class="onoffswitch-label" for="myonoffswitch7">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
                    <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
           </td>
          </tr> 


          <tr>
        <th scope='row'><?php _e('Set Date/Time For Counter');?></th>
        <td><label for='mmp_set_dateTime'>
          <input type='date' id='mmp_set_dateTime' name='mmp_set_dateTime'  value='<?php echo get_option('mmp_set_dateTime' ); ?>' disabled/>
          <p class='description'><?php _e('Set Date & time for countdown timer')  ?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </label>
        </td>
      </tr>

      <tr valign='top'>
            <th scope='row'><?php _e('Show Subscribe Form ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_on_off_subscribe" class="onoffswitch-checkbox"  id="myonoffswitch9" value='1'<?php checked(1, get_option('mmp_on_off_subscribe')); ?> disabled/>
                     <label class="onoffswitch-label" for="myonoffswitch9">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
                    <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>

           </td>
          </tr> 
      
 </table>

</div>

<div id="accordion-2" class="accordion tab-theme-settings">

 <table class="form-table">

            <div id="hed3"><h3><?php _e('Themes')?></h3>
            <span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span>
            </div>
            <div>   
            <tr valign='top'>
            <th scope='row'><?php _e('Select Theme');?></th>
            <td>




              <ul id="wpmmp-themes">


              <li>
              <p class="pp"style='padding-left:2px;'>Default Theme <input type="radio" name="mmp_themes" id="mmp_theme2" value="default" <?php  checked('default',get_option('mmp_themes')); true ?>  /> </p>
              
              <label for="mmp_theme2"><img style='' src="<?php echo wpmmp_image_url('default-4.jpg')?>"> </label>
            </li>

             <li>
              <p class="pp"style='padding-left:2px;'>Coming Soon <input type="radio" name="mmp_themes" id="mmp_theme3" value="cs-simple" <?php  checked('cs-simple',get_option('mmp_themes')); true ?> disabled/></p>
                


              <label for="mmp_theme3"><img style='' src="<?php echo wpmmp_image_url('simple-temp.png') ?> "> </label>
              <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
              </li>

              <li>
              <p class="pp"style='padding:0px 0px 0px 2px ;'>Minimal <input type="radio" name="mmp_themes" id="pal1" value="minimal" <?php  checked('minimal', get_option('mmp_themes')); true ?> disabled /></p>
              
 
              
              <label for="mmp_theme1"><img style=' '  src="<?php echo wpmmp_image_url('minimal-temp.png')?> "></label>
              <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p> 
              </li>


              <li>
              <p class="pp"style='padding-left:2px;'>Alissa <input type="radio" name="mmp_themes" id="mmp_theme4" value="alissa" <?php  checked('alissa',get_option('mmp_themes')); true ?> disabled/></p>
              


              <label for="mmp_theme4"><img style='' src="<?php echo wpmmp_image_url('alissa-1.png') ?> "> </label>
              <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
              </li>


              <li>
              <p class="pp" style='padding-left:2px;'>Maintenance Mode Guru <input type="radio" name="mmp_themes" id="mmp_theme5" value="mm-one" <?php  checked('mm-one',get_option('mmp_themes')); true ?> disabled/></p>
             


              <label for="mmp_theme5"><img style='' src="<?php echo wpmmp_image_url('maintenance-one.png') ?> "> </label>
              <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
              </li>

              <li>
              <p class="pp" style='padding-left:2px;'>Pre-Launch <input type="radio" name="mmp_themes" id="mmp_theme6" value="pre-launch" <?php  checked('pre-launch',get_option('mmp_themes')); true ?> disabled/></p>
             


              <label for="mmp_theme6"><img style='' src="<?php echo wpmmp_image_url('pre-launch.png') ?> "> </label>
              <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
              </li>



              

              </ul>

              
            </td>
            </tr>

         <div>
         </div>
            </table>

</div>

<div id="accordion-3" class="accordion tab-header-settings">
 <table class="form-table">

            <div id="hed3"><h3><?php _e('Header')?></h3><span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>



            <tr valign="top">
        <th scope="row"><?php _e('Favicon'); ?></th>
        <td><label for="mmp_favicon">
          <input id="image_location" type="text" name="mmp_favicon" value="<?php echo get_option('mmp_favicon') ?>" size="50" />
                    <input class="onetarek-upload-button button" type="button" value="Upload Image" />
          <p class='description'><?php _e('Upload or Select Favicon Image, Image must be 16px X 16px.') ;?></p>
         </lable>
       </td>
        </tr>

             <tr valign="top">
        <th scope="row"><?php _e('SEO Title'); ?></th>
        <td><label for="mmp_title">
          <input type="text" id="mmp_title"  name="mmp_title" value="<?php echo get_option( 'mmp_title' ); ?>" size="50" />
          <p class="description"><?php _e( 'Enter Title here eg: abcd. '); ?></p>
          </label>
       </td>
        </tr>



        <tr valign="top">
             <th scope="row"><?php _e( 'SEO Meta Description') ?></th>
             <td><label for="mmp_seo_meta">
             <textarea disabled cols="50" rows="2" id="mmp_seo_meta"  name="mmp_seo_meta"  ><?php echo get_option( 'mmp_seo_meta' ); ?> </textarea>
             <p class='description'> <?php _e('Add SEO Meta Description.' );?></p>
             <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>

          </label>
        </td>
      </tr>



       <tr valign="top">
             <th scope="row"><?php _e( 'Analytics Code') ?></th>
             <td><label for="mmp_analytics">
             <textarea disabled cols="50" rows="2" id="mmp_analytics"  name="mmp_analytics"  ><?php echo get_option( 'mmp_analytics' ); ?></textarea>
             <p class='description'> <?php _e('Add Analytics code here' );?></p>
             <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
          </label>
        </td>
      </tr>


</table>
</div>


<div id="accordion-4" class="accordion tab-email-settings">
 <table class="form-table">

         <div id="hed3"><h3><?php _e('Email Form ')?></h3><span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>
      <tr>
        <th scope='row'><?php _e('MailChimp API');?></th>
        <td><label for='mmp_fb_page'>
          <input  size="50" type='text' id='mmp_mc_api' name='mmp_mc_api' value='<?php echo get_option('mmp_mc_api' ); ?>' disabled/>
          <p class='description'><?php _e('Enter MailChimp API : <a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">here</a>') ;?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </label>
        </td>
      </tr>



      <tr>
        <th scope='row'><?php _e('MailChimp List Id');?></th>
        <td><label for='mmp_mc_listid'>
          <input size="50" type='text' id='mmp_mc_listid' name='mmp_mc_listid' value='<?php echo get_option('mmp_mc_listid' ); ?>' disabled/>
          <p class='description'><?php _e('Find your list id : <a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">here</a>') ;?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </label>
        </td>
      </tr>


      <tr valign='top'>
            <th scope='row'><?php _e('Double Opt-In');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_mc_optin" class="onoffswitch-checkbox"  id="myonoffswitch9" checked value='1'<?php checked(1, get_option('mmp_mc_optin'));?> disabled/>
                     <label class="onoffswitch-label" for="myonoffswitch9">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
                    <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
           </td>
          </tr>


          <tr valign="top">
        <th scope="row"><?php _e('Subscribe Button Text'); ?></th>
        <td><label for="mmp_mc_sbt">
          <input type="text" id="mmp_mc_sbt"  name="mmp_mc_sbt" value="<?php echo get_option( 'mmp_mc_sbt' ); ?>" size="50" disabled />
          <p class="description"><?php _e( 'Enter subscribe button text here eg: abcd. '); ?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
          </label>
       </td>
        </tr>


        <tr valign="top">
        <th scope="row"><?php _e('Placeholder Text'); ?></th>
        <td><label for="mmp_mc_pt">
          <input type="text" id="mmp_mc_pt"  name="mmp_mc_pt" value="<?php echo get_option( 'mmp_mc_pt' ); ?>" size="50"  disabled/>
          <p class="description"><?php _e( 'Enter text here for placeholder '); ?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
          </label>
       </td>
        </tr>

    </table>
</div>

<div id="accordion-5" class="accordion tab-page-settings">
<table class="form-table">

            <div id="hed3"><h3><?php _e('Page Settings')?></h3><span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>


             <tr valign="top">
        <th scope="row"><?php _e('Logo'); ?></th>
        <td><label for="mmp_logo">
          <input id="image_location" type="text" name="mmp_logo" value="<?php echo get_option('mmp_logo') ?>" size="50" />
                    <input class="onetarek-upload-button button" type="button" value="Upload Image" />
          <p class='description'><?php _e('Upload or Select Logo Image 184px X 50px') ;?></p>
         </lable>
       </td>
        </tr>



        <tr valign="top">
        <th scope="row"><?php _e('Headline'); ?></th>
        <td><label for="mmp_headline">
          <input type="text" id="mmp_headline"  name="mmp_headline" value="<?php echo get_option( 'mmp_headline' ); ?>" size="50" />
          <p class="description"><?php _e( 'Enter Headline here '); ?></p>
          </label>
       </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php _e('Tagline'); ?></th>
        <td><label for="mmp_subheading">
          <input type="text" id="mmp_subheading"  name="mmp_subheading" value="<?php echo get_option( 'mmp_subheading' ); ?>" size="50" />
          <p class="description"><?php _e( 'Enter Tagline here '); ?></p>
          </label>
       </td>
        </tr>


        <tr valign="top">
        <th scope="row"><?php _e('Message'); ?></th>
        <td><label for="mmp_message">
          </label>
          <?php
           
           $settings = array( 'media_buttons' => false, 'mmp_message', 'teeny' => true, 'quicktags' => false );
           
            $content = get_option('mmp_message');
           
            wp_editor( $content, 'mmp_message', $settings );

          ?>
       </td>
        </tr>

</table>      
</div>     

<div id="accordion-6" class="accordion tab-design-settings">
        <table class="form-table">

            <div id="hed3"><h3><?php _e('Design')?></h3><span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>
              

         <tr>
        <th scope='row'><?php _e('Background Color');?></th>
        <td><label for='mmp_bgcolor'>
          <input type='text' class='color_picker' id='mmp_bgcolor' name='mmp_bgcolor' value='<?php echo get_option('mmp_bgcolor' ); ; ?>'/>
          <p class='description'><?php _e('Change background color') ;?></p>
        </label>
        </td>
      </tr>


      <tr>
        <th scope='row'><?php _e('Headline Color');?></th>
        <td><label for='mmp_headline_color'>
          <input type='text' class='color_picker' id='mmp_headline_color' name='mmp_headingcolor' value='<?php echo get_option('mmp_headingcolor' ); ; ?>'/>
          <p class='description'><?php _e('Change Headline color') ;?></p>
        </label>
        </td>
      </tr>


      <tr>
        <th scope='row'><?php _e('Text Color');?></th>
        <td><label for='mmp_text_color'>
          <input type='color'  id='mmp_text_color' name='mmp_text_color' value='<?php echo get_option('mmp_text_color' ); ; ?>' disabled/>
          <p class='description'><?php _e('Change Text color') ;?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </label>
        </td>
      </tr>


      <tr>
        <th scope='row'><?php _e('Links Color');?></th>
        <td><label for='mmp_links_color'>
          <input type='color'  id='mmp_links_color' name='mmp_links_color' value='<?php echo get_option('mmp_links_color' ); ; ?>' disabled/>
          <p class='description'><?php _e('Change Links color') ;?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </label>
        </td>
      </tr>


      <tr>
        <th scope='row'><?php _e('Links Hover Color');?></th>
        <td><label for='mmp_links_hover_color'>
          <input type='color' id='mmp_links_hover_color' name='mmp_links_hover_color' value='<?php echo get_option('mmp_links_hover_color' ); ; ?>' disabled/>
          <p class='description'><?php _e('Change Links hover color') ;?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </label>
        </td>
      </tr>


      <tr valign="top">
        <th scope="row"><?php _e('Background Image'); ?></th>
        <td><label for="mmp_background_image">
          <input id="image_location" type="text" name="mmp_background_image" value="<?php echo get_option('mmp_background_image') ?>" size="50" disabled />
                    <input class="onetarek-upload-button button" type="button" value="Upload Image" disabled />
          <p class='description'><?php _e('Upload or Select Site Background Image') ;?></p>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
         </lable>
       </td>
        </tr>


        <tr valign='top'>
            <th scope='row'><?php _e('Responsive Background ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_res_bg" class="onoffswitch-checkbox"  id="myonoffswitch1" value='1'<?php checked(1, get_option('mmp_res_bg')); ?> disabled />
                     <label class="onoffswitch-label" for="myonoffswitch1">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
                    <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>

           </td>
          </tr> 



          <th scope='row'><?php _e('Font Family For Text');?></th>
        <td><label for='mmp_fft'>
            <input id="font" type="text" name="" value="<?php echo get_option( 'mmp_fft' ); ?>" disabled />
            
          </label>
          <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </td>
      </tr>



      <tr>
        <th scope='row'><?php _e('Font Family For Header Text');?></th>
        <td><label for='mmp_ffht'>
          <input id="font1" name="" type="text" value="<?php echo get_option( 'mmp_ffht' ); ?>" disabled/>

        </label>
        <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
        </td>
      </tr>

      <tr valign="top">
             <th scope="row"><?php _e( 'Custom CSS') ?></th>
             <td><label for="mmp_custom_css">
             <textarea cols="80" rows="7" id="mmp_custom_css"  name="mmp_custom_css"  disabled ><?php echo get_option( 'mmp_custom_css' ); ?></textarea>
             <p class='description'> <?php _e('Add styling inside this text area.' );?></p>
             <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
          </label>
        </td>
      </tr>

</table>
</div>
      
      
<div id="accordion-7" class="accordion tab-script-settings">
        <table class="form-table">

            <div id="hed3"><h3><?php _e('Scripts')?></h3><span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>


          <tr valign="top">
             <th scope="row"><?php _e( 'Header Script') ?></th>
             <td><label for="mmp_custom_header_script">
             <textarea disabled cols="50" rows="2" id="mmp_custom_header_script"  name="mmp_custom_header_script"  ><?php echo get_option( 'mmp_custom_header_script' ); ?></textarea>
             <p class='description'> <?php _e('Add header script in this text area.' );?></p>
             <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
          </label>
        </td>
      </tr>


       <tr valign="top">
             <th scope="row"><?php _e( 'Footer Script') ?></th>
             <td><label for="mmp_custom_footrt_script">
             <textarea disabled cols="50" rows="2" id="mmp_custom_footrt_script"  name="mmp_custom_footrt_script"  ><?php echo get_option( 'mmp_custom_footrt_script' ); ?></textarea>
             <p class='description'> <?php _e('Add footer script in this text area.' );?></p>
             <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
          </label>
        </td>
      </tr>


      </table>
</div>

<div id="accordion-8" class="accordion tab-social-settings">
     <table class="form-table">

            <div id="hed3"><h3><?php _e('Social')?></h3><span class="heading_save_btn">
          <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
          </span></div>
      <tr>
        <th scope='row'><?php _e('Facebook Page Link');?></th>
        <td><label for='mmp_fb_page'>
          <input type='text' id='mmp_fb_page' name='mmp_fb_page' value='<?php echo get_option('mmp_fb_page' ); ?>'/>
          <p class='description'><?php _e('Enter Facebook Link') ;?></p>
        </label>
        </td>
      </tr>

       <tr>
        <th scope='row'><?php _e('Twitter Page Link');?></th>
        <td><label for='mmp_tw_page'>
          <input type='text' id='mmp_tw_page' name='mmp_tw_page' value='<?php echo get_option('mmp_tw_page' ); ?>'/>
          <p class='description'><?php _e('Enter Twitter Link') ;?></p>
        </label>
        </td>
      </tr>

       <tr>
        <th scope='row'><?php _e('LinkedIn Page Link');?></th>
        <td><label for='mmp_lkin_page'>
          <input type='text' id='mmp_lkin_page' name='mmp_lkin_page' value='<?php echo get_option('mmp_lkin_page' ); ?>'/>
          <p class='description'><?php _e('Enter LinkedIn Link') ;?></p>
        </label>
        </td>
      </tr>



      <tr>
        <th scope='row'><?php _e('Pinterest Page Link');?></th>
        <td><label for='mmp_pin_page'>
          <input type='text' id='mmp_pin_page' name='mmp_pin_page' value='<?php echo get_option('mmp_pin_page' ); ?>'/>
          <p class='description'><?php _e('Enter Pinterest Link') ;?></p>
        </label>
        </td>
      </tr>


       <tr>
        <th scope='row'><?php _e('Instagram Page Link');?></th>
        <td><label for='mmp_insta_page'>
          <input type='text' id='mmp_insta_page' name='mmp_insta_page' value='<?php echo get_option('mmp_insta_page' ); ?>'/>
          <p class='description'><?php _e('Enter Instagram Link') ;?></p>
        </label>
        </td>
      </tr>



      <tr valign='top'>
            <th scope='row'><?php _e('Show Facebook Icon ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_show_fb" class="onoffswitch-checkbox"  id="myonoffswitch2" value='1'<?php checked(1, get_option('mmp_show_fb')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch2">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>

          </tr><tr valign='top'>
            <th scope='row'><?php _e('Show Twitter Icon ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_show_tw" class="onoffswitch-checkbox"  id="myonoffswitch3" value='1'<?php checked(1, get_option('mmp_show_tw')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch3">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>

          </tr><tr valign='top'>
            <th scope='row'><?php _e('Show LinkedIn Icon ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_show_lk" class="onoffswitch-checkbox"  id="myonoffswitch4" value='1'<?php checked(1, get_option('mmp_show_lk')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch4">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr>


          </tr><tr valign='top'>
            <th scope='row'><?php _e('Show Pinterest Icon ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_show_pin" class="onoffswitch-checkbox"  id="myonoffswitch5" value='1'<?php checked(1, get_option('mmp_show_pin')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch5">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr>



          </tr><tr valign='top'>
            <th scope='row'><?php _e('Show Instagram Icon ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_show_insta" class="onoffswitch-checkbox"  id="myonoffswitch6" value='1'<?php checked(1, get_option('mmp_show_insta')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch6">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr>

    </table>
</div>

<div id="accordion-9" class="accordion tab-advanced-settings">
    <table class="form-table">

            <div id="hed3"><h3><?php _e('Advanced Settings')?></h3></div>


             </tr><tr valign='top'>
            <th scope='row'><?php _e('HTTP 503 Header ');?></th>
            <td>
               <div class="onoffswitch">
                     <input disabled type="checkbox"  class="onoffswitch-checkbox"  id="myonoffswitch10" value='1'<?php checked(1, get_option('mmp_http_503')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch10">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
                    <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
           </td>
          </tr>


           </tr><tr valign='top'>
            <th scope='row'><?php _e('Disable Feed Access');?></th>
            <td>
               <div class="onoffswitch">
                     <input disabled type="checkbox"  class="onoffswitch-checkbox"  id="myonoffswitch11" value='1'<?php checked(1, get_option('mmp_feed_access')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch11">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                </div>
                <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
           </td>
          </tr>
          
          <tr valign='top'>

            <th scope='row'>Disable Maintenance Mode for User Roles</th>

            <td>

              <?php

              $activeroles = get_option('mmp_userroles' );

              if ( ! is_array( $activeroles )  )
                $activeroles = array('administrator');
              

              global $wp_roles;

              if ( ! isset( $wp_roles ) )
                $wp_roles = new WP_Roles();
                $roles = $wp_roles->get_names();

                foreach ($roles as $role_value => $role_name) {

                    if ( in_array( $role_value, $activeroles) )
                      echo '<p><input disabled checked  type="checkbox" value="' . $role_value . '">'.$role_name.'</p>';
                    else
                      echo '<p><input disabled  type="checkbox" value="' . $role_value . '">'.$role_name.'</p>';
                    

                  }
                  
              ?>
              <p class="description"><?php _e( '<a href="http://web-settler.com/maintenance-mode/" target="__blank"> Premium Version-Buy Here </a>'); ?></p>
            </td>

          </tr>



    </table>
</div>
    

      <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
      </p>

 
</form>

<form id="reset" method="post" action="">
 <p class="submit">
 <input name="reset" class="button button-secondary" type="submit" value="Reset to default settings" >
 <input type="hidden" value="reset" />
 </p>
</form>
      
</div> <!-- wraper-->