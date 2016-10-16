<?php

add_action( 'admin_menu', 'tabs_menu');

function tabs_menu(){
	add_menu_page( 'Tabs', 'Tabs','administrator', 'tabs_option', 'tabs_settings_page', '', 17);
	add_action( 'admin_init', 'tabs_register_settings' );

}

function tabs_register_settings(){

  register_setting('mmp-settings-group','mmp_on_off');
  register_setting('mmp-settings-group','mmp_favicon');
  register_setting('mmp-settings-group','mmp_title');
  register_setting('mmp-settings-group','mmp_seo_meta');
  register_setting('mmp-settings-group','mmp_analytics');
  register_setting('mmp-settings-group','mmp_logo');
  register_setting('mmp-settings-group','mmp_headline');
  register_setting('mmp-settings-group','mmp_message');
  register_setting('mmp-settings-group','mmp_bgcolor');
  register_setting('mmp-settings-group','mmp_text_color');
  register_setting('mmp-settings-group','mmp_links_color');
  register_setting('mmp-settings-group','mmp_links_hover_color');
  register_setting('mmp-settings-group','mmp_background_image');
  register_setting('mmp-settings-group','mmp_res_bg');
  register_setting('mmp-settings-group','mmp_fft');
  register_setting('mmp-settings-group','mmp_ffht');
  register_setting('mmp-settings-group','mmp_custom_css');
  register_setting('mmp-settings-group','mmp_custom_header_script');
  register_setting('mmp-settings-group','mmp_custom_footrt_script');
  register_setting('mmp-settings-group','mmp_fb_page');
  register_setting('mmp-settings-group','mmp_tw_page');
  register_setting('mmp-settings-group','mmp_lkin_page');
  register_setting('mmp-settings-group','mmp_pin_page');
  register_setting('mmp-settings-group','mmp_insta_page');
  register_setting('mmp-settings-group','mmp_show_fb');
  register_setting('mmp-settings-group','mmp_show_tw');
  register_setting('mmp-settings-group','mmp_show_lk');
  register_setting('mmp-settings-group','mmp_show_pin');
  register_setting('mmp-settings-group','mmp_show_insta');
  register_setting('mmp-settings-group','mmp_on_off_countdown');
  register_setting('mmp-settings-group','mmp_on_off_progress');
  register_setting('mmp-settings-group','mmp_set_dateTime');
  register_setting('mmp-settings-group','mmp_set_progress');
  register_setting('mmp-settings-group','mmp_on_off_subscribe');
  register_setting('mmp-settings-group','mmp_http_503');
  register_setting('mmp-settings-group','mmp_feed_access');
  register_setting('mmp-settings-group','');
}



function mmp_default_settings(){

if(get_option( 'mmp_text_color') ) return;

  add_option('mmp_on_off' , 0);
  add_option('mmp_favicon', '');
  add_option('mmp_title', 'Site is Down');
  add_option('mmp_seo_meta', '');
  add_option('mmp_analytics', '');
  add_option('mmp_logo' , '');
  add_option('mmp_headline' , 'We are down for maintenance');
  add_option('mmp_message' , 'Ad your message here');
  add_option('mmp_bgcolor' , '#000');
  add_option('mmp_text_color', '#fff');
  add_option('mmp_links_color' ,'#efef');
  add_option('mmp_links_hover_color','#efef');
  add_option('mmp_background_image' , '');
  add_option('mmp_res_bg' , '0');
  add_option('mmp_fft' , ' ');
  add_option('mmp_ffht' , '');
  add_option('mmp_custom_css' , '');
  add_option('mmp_custom_header_script' , '');
  add_option('mmp_custom_footrt_script', '');
  add_option('mmp_fb_page' , '');
  add_option('mmp_tw_page' , '');
  add_option('mmp_lkin_page' , '');
  add_option('mmp_pin_page' ,'');
  add_option('mmp_insta_page', '');
  add_option('mmp_show_fb' , 0);
  add_option('mmp_show_tw' , 0);
  add_option('mmp_show_lk' , 0);
  add_option('mmp_show_pin' , 0);
  add_option('mmp_show_insta' , 0);
  add_option('mmp_on_off_countdown' , 0);
  add_option('mmp_on_off_progress' , 0);
  add_option('mmp_set_dateTime', '');
  add_option('mmp_set_progress' , '');
  add_option('mmp_on_off_subscribe' , 0);
  add_option('mmp_http_503' , 0);
  add_option('mmp_feed_access' , 0);

}


 
register_activation_hook( __FILE__, 'mmp_default_settings' );



add_action( 'admin_enqueue_scripts', 'wp_enqueue_js' );
function wp_enqueue_js( ) {
    wp_enqueue_script( 'wp-color-picker'  );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'thickbox' );
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_script( 'media-upload' ); 
   
    wp_enqueue_script( 'wp-color-picker-script', WP_PLUGIN_URL .'/tabs/wspcolorpicker.js', array( 'wp-color-picker' ), false, true );

}


function tabs_settings_page(){?>
<style type="text/css">


    .onoffswitch {
        position: relative; width: 90px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
   td .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        border: 2px solid #999999; border-radius: 20px;
    }
    .onoffswitch-inner {
        display: block; width: 200%; margin-left: -100%;
        transition: margin 0.1s ease-in 0s;
    }
    .onoffswitch-inner:before, .onoffswitch-inner:after {
        display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
        font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
        box-sizing: border-box;
    }
    .onoffswitch-inner:before {
        content: "Yes";
        padding-left: 10px;
        background-color: #34A7C1; color: #FFFFFF;
    }
    .onoffswitch-inner:after {
        content: "No";
        padding-right: 10px;
        background-color: #EEEEEE; color: #999999;
        text-align: right;
    }
    .onoffswitch-switch {
        display: block; width: 18px; margin: 6px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 56px;
        border: 2px solid #999999; border-radius: 20px;
        transition: all 0.1s ease-in 0s; 
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
        right: 0px; 

}
    @font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat-Regular'), url(http://fonts.gstatic.com/s/montserrat/v6/zhcz-_WihjSQC0oHJ9TCYPk_vArhqVIZ0nv9q090hN8.woff2) format('woff2'), url(http://fonts.gstatic.com/s/montserrat/v6/zhcz-_WihjSQC0oHJ9TCYBsxEYwM7FgeyaSgU71cLG0.woff) format('woff');
}

@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 400;
  src: local('Lato Regular'), local('Lato-Regular'), url(http://fonts.gstatic.com/s/lato/v11/1YwB1sO8YE1Lyjf12WNiUA.woff2) format('woff2'), url(http://fonts.gstatic.com/s/lato/v11/9k-RPmcnxYEPm8CNFsH2gg.woff) format('woff');
}
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 700;
  src: local('Lato Bold'), local('Lato-Bold'), url(http://fonts.gstatic.com/s/lato/v11/H2DMvhDLycM56KNuAtbJYA.woff2) format('woff2'), url(http://fonts.gstatic.com/s/lato/v11/wkfQbvfT_02e2IWO3yYueQ.woff) format('woff');
}
@font-face {
  font-family: 'Lato';
  font-style: italic;
  font-weight: 400;
  src: local('Lato Italic'), local('Lato-Italic'), url(http://fonts.gstatic.com/s/lato/v11/PLygLKRVCQnA5fhu3qk5fQ.woff2) format('woff2'), url(http://fonts.gstatic.com/s/lato/v11/oUan5VrEkpzIazlUe5ieaA.woff) format('woff');
}

* {
  -webkit-transition: all 0.4s ease-in-out;
-moz-transition: all 0.4s ease-in-out;
-ms-transition: all 0.4s ease-in-out;
-o-transition: all 0.4s ease-in-out;
transition: all 0.4s ease-in-out;
}

b, strong {
    color: #666;
    font-size: 18px;
    font-weight: 700;
}


.wrap {
    background-color: #fff;
    border-radius: 3px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
    font-family: Lato;
    margin: 4% auto;
    overflow: hidden;
    padding: 40px 6%;
    width: 80%;
}

.wrap p{
  font-size: 19px;
  color:#777;
}

.wrap h1 {
    background: #ffba00 none repeat scroll 0 0;
    color: #fff;
    font-family: 'Montserrat',sans-serif;
    font-size: 42px;
    font-weight: 400;
    margin: -40px -8% 40px;
    padding: 40px;
    text-align: center;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1);
}

.wrap h3 {
    color: #666;
    font-size: 20px;
    text-align: left;
}


.wrap #hed3 {
    background-color: #0074a2;
    height: auto;
    margin: 40px -8%;
    padding: 10px;
    text-align: center;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1);
}


#hed3 h3 {
    color: #fff;
    font-family: Montserrat,sans-serif;
    font-size: 32px;
    font-weight: 400;
    text-align: center;
}

 .wrap th
 {
  color :#666;
  font-size: 1.2em;
  padding-left: 15px;

 }


 .wrap td
 {
  padding-left: 40px;
 }
.wrap h3 a ,p a
{
  text-decoration: none;
}
.wrap td p
{
  color:#666;
  font-size:1.2em;
}
.wrap p.submit
{
  text-align: center;
}
.wrap input[type=checkbox] {
  /* All browsers except webkit*/
  transform: scale(1.2);

  /* Webkit browsers*/
  -webkit-transform: scale(1.2);


}
  /*
 This css and associated images borrow heavily from the fantastic 
 chosen select box plugin.
 
 Copyright (c) 2011 Harvest http://getharvest.com

 MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md
*/

td .font-select {
  font-size: 16px;
  width: 210px;
  position: relative;
  display: inline-block;
  zoom: 1;
  *display: inline;
}

td .font-select .fs-drop {
  background: #fff;
  border: 1px solid #aaa;
  border-top: 0;
  position: absolute;
  top: 29px;
  left: 0;
  -webkit-box-shadow: 0 4px 5px rgba(0,0,0,.15);
  -moz-box-shadow   : 0 4px 5px rgba(0,0,0,.15);
  -o-box-shadow     : 0 4px 5px rgba(0,0,0,.15);
  box-shadow        : 0 4px 5px rgba(0,0,0,.15);
  z-index: 999;
}

td .font-select > a {
  background-color: #fff;
  background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #eeeeee), color-stop(0.5, white));
  background-image: -webkit-linear-gradient(center bottom, #eeeeee 0%, white 50%);
  background-image: -moz-linear-gradient(center bottom, #eeeeee 0%, white 50%);
  background-image: -o-linear-gradient(top, #eeeeee 0%,#ffffff 50%);
  background-image: -ms-linear-gradient(top, #eeeeee 0%,#ffffff 50%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#ffffff',GradientType=0 );
  background-image: linear-gradient(top, #eeeeee 0%,#ffffff 50%);
  -webkit-border-radius: 4px;
  -moz-border-radius   : 4px;
  border-radius        : 4px;
  -moz-background-clip   : padding;
  -webkit-background-clip: padding-box;
  background-clip        : padding-box;
  border: 1px solid #aaa;
  display: block;
  overflow: hidden;
  white-space: nowrap;
  position: relative;
  height: 26px;
  line-height: 26px;
  padding: 0 0 0 8px;
  color: #444;
  text-decoration: none;
}

td .font-select > a span {
  margin-right: 26px;
  display: block;
  overflow: hidden;
  white-space: nowrap;
  line-height: 1.8;
  -o-text-overflow: ellipsis;
  -ms-text-overflow: ellipsis;
  text-overflow: ellipsis;
  cursor: pointer;
}

td .font-select > a div {
  -webkit-border-radius: 0 4px 4px 0;
  -moz-border-radius   : 0 4px 4px 0;
  border-radius        : 0 4px 4px 0;
  -moz-background-clip   : padding;
  -webkit-background-clip: padding-box;
  background-clip        : padding-box;
  background: #ccc;
  background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ccc), color-stop(0.6, #eee));
  background-image: -webkit-linear-gradient(center bottom, #ccc 0%, #eee 60%);
  background-image: -moz-linear-gradient(center bottom, #ccc 0%, #eee 60%);
  background-image: -o-linear-gradient(bottom, #ccc 0%, #eee 60%);
  background-image: -ms-linear-gradient(top, #cccccc 0%,#eeeeee 60%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cccccc', endColorstr='#eeeeee',GradientType=0 );
  background-image: linear-gradient(top, #cccccc 0%,#eeeeee 60%);
  border-left: 1px solid #aaa;
  position: absolute;
  right: 0;
  top: 0;
  display: block;
  height: 100%;
  width: 18px;
}

td .font-select > a div b {
  background: url('<?php echo get_template_directory_uri().'/admin/admin-zia/fs-sprite.png' ?>') no-repeat 0 1px;
  display: block;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

td .font-select .fs-drop {
  -webkit-border-radius: 0 0 4px 4px;
  -moz-border-radius   : 0 0 4px 4px;
  border-radius        : 0 0 4px 4px;
  -moz-background-clip   : padding;
  -webkit-background-clip: padding-box;
  background-clip        : padding-box;
}

td .font-select .fs-results {
  margin: 0 4px 4px 0;
  max-height: 190px;
  width: 200px;
  padding: 0 0 0 4px;
  position: relative;
  overflow-x: hidden;
  overflow-y: auto;
}

td .font-select .fs-results li {
  line-height: 80%;
  padding: 7px 7px 8px;
  margin: 0;
  list-style: none;
  font-size: 18px;
}

td .font-select .fs-results li.active {
  background: #3875d7;
  color: #fff;
  cursor: pointer;
}
td.font-select .fs-results li em {
  background: #feffde;
  font-style: normal;
}

td.font-select .fs-results li.active em {
  background: transparent;
}

td.font-select-active > a {
  -webkit-box-shadow: 0 0 5px rgba(0,0,0,.3);
  -moz-box-shadow   : 0 0 5px rgba(0,0,0,.3);
  -o-box-shadow     : 0 0 5px rgba(0,0,0,.3);
  box-shadow        : 0 0 5px rgba(0,0,0,.3);
  border: 1px solid #5897fb;
}

td.font-select-active > a {
  border: 1px solid #aaa;
  -webkit-box-shadow: 0 1px 0 #fff inset;
  -moz-box-shadow   : 0 1px 0 #fff inset;
  -o-box-shadow     : 0 1px 0 #fff inset;
  box-shadow        : 0 1px 0 #fff inset;
  background-color: #eee;
  background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, white), color-stop(0.5, #eeeeee));
  background-image: -webkit-linear-gradient(center bottom, white 0%, #eeeeee 50%);
  background-image: -moz-linear-gradient(center bottom, white 0%, #eeeeee 50%);
  background-image: -o-linear-gradient(bottom, white 0%, #eeeeee 50%);
  background-image: -ms-linear-gradient(top, #ffffff 0%,#eeeeee 50%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#eeeeee',GradientType=0 );
  background-image: linear-gradient(top, #ffffff 0%,#eeeeee 50%);
  -webkit-border-bottom-left-radius : 0;
  -webkit-border-bottom-right-radius: 0;
  -moz-border-radius-bottomleft : 0;
  -moz-border-radius-bottomright: 0;
  border-bottom-left-radius : 0;
  border-bottom-right-radius: 0;
}

td.font-select-active > a div {
  background: transparent;
  border-left: none;
}

td.font-select-active > a div b {
  background-position: -18px 1px;
}


td span#pal {
  top: 80px; 
}
    

    </style>

  <div class='wrap'> 
   
       <?php 
        if ( isset( $_POST['reset'] ) ){


           delete_option('mmp_on_off');
  delete_option('mmp_favicon');
  delete_option('mmp_title');
  delete_option('mmp_seo_meta');
  delete_option('mmp_analytics');
  delete_option('mmp_logo');
  delete_option('mmp_headline');
  delete_option('mmp_message');
  delete_option('mmp_bgcolor');
  delete_option('mmp_text_color');
  delete_option('mmp_links_color');
  delete_option('mmp_links_hover_color');
  delete_option('mmp_background_image');
  delete_option('mmp_res_bg');
  delete_option('mmp_fft');
  delete_option('mmp_ffht');
  delete_option('mmp_custom_css');
  delete_option('mmp_custom_header_script');
  delete_option('mmp_custom_footrt_script');
  delete_option('mmp_fb_page');
  delete_option('mmp_tw_page');
  delete_option('mmp_lkin_page');
  delete_option('mmp_pin_page');
  delete_option('mmp_insta_page');
  delete_option('mmp_show_fb');
  delete_option('mmp_show_tw');
  delete_option('mmp_show_lk');
  delete_option('mmp_show_pin');
  delete_option('mmp_show_insta');
  delete_option('mmp_on_off_countdown');
  delete_option('mmp_on_off_progress');
  delete_option('mmp_set_dateTime');
  delete_option('mmp_set_progress');
  delete_option('mmp_on_off_subscribe');
  delete_option('mmp_http_503');
  delete_option('mmp_feed_access');

        }
       ?>
       
       <?php settings_errors(); ?>

       <form method="post" action="options.php" >
           <?php settings_fields('mmp-settings-group');?>
             <table class="form-table">
             <h1><?php _e('Maintenance Mode Options Panel')?></h1>
          

           <br>
           <br>


           <div id="hed3"><h3><?php _e('General Settings')?></h3></div>
           <br>


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
           </td>
          </tr>



          <tr valign='top'>
            <th scope='row'><?php _e(' Enable Countdow Timer ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_on_off_countdown" class="onoffswitch-checkbox"  id="myonoffswitch7" value='1'<?php checked(1, get_option('mmp_on_off_countdown')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch7">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr> 


          <tr>
        <th scope='row'><?php _e('Set Date/Time');?></th>
        <td><label for='mmp_set_dateTime'>
          <input type='date' id='mmp_set_dateTime' name='mmp_set_dateTime'  value='<?php echo get_option('mmp_set_dateTime' ); ?>'/>
          <p class='description'><?php _e('Set Date time for countdown timer') ;?></p>
        </label>
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
            <th scope='row'><?php _e('Show Subscribe Form ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_on_off_subscribe" class="onoffswitch-checkbox"  id="myonoffswitch9" value='1'<?php checked(1, get_option('mmp_on_off_subscribe')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch9">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr> 
        

 </table>


 <table class="form-table">

            <div id="hed3"><h3><?php _e('Header')?></h3></div>



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
          <input type="text" id="mmp_title"  name="mmp_title" value="<?php echo get_option( 'mmp_title' ); ?>" />
          <p class="description"><?php _e( 'Enter Title here eg: abcd. '); ?></p>
          </label>
       </td>
        </tr>



        <tr valign="top">
             <th scope="row"><?php _e( 'SEO Meta Description') ?></th>
             <td><label for="mmp_seo_meta">
             <textarea cols="50" rows="2" id="mmp_seo_meta"  name="mmp_seo_meta"  ><?php echo get_option( 'mmp_seo_meta' ); ?> </textarea>
             <p class='description'> <?php _e('Add SEO Meta Description.' );?></p>
          </label>
        </td>
      </tr>



       <tr valign="top">
             <th scope="row"><?php _e( 'Analytics Code') ?></th>
             <td><label for="mmp_analytics">
             <textarea cols="50" rows="2" id="mmp_analytics"  name="mmp_analytics"  ><?php echo get_option( 'mmp_analytics' ); ?> </textarea>
             <p class='description'> <?php _e('Add Analytics code here' );?></p>
          </label>
        </td>
      </tr>


</table>


<table class="form-table">

            <div id="hed3"><h3><?php _e('Page Settings')?></h3></div>


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
          <input type="text" id="mmp_headline"  name="mmp_headline" value="<?php echo get_option( 'mmp_headline' ); ?>" />
          <p class="description"><?php _e( 'Enter Headline here '); ?></p>
          </label>
       </td>
        </tr>


        <tr valign="top">
        <th scope="row"><?php _e('Message'); ?></th>
        <td><label for="mmp_message">
          </label>
          <?php
            $settings = array('media_buttons' => true,'mmp_message');
            $content = get_option('mmp_message');
           wp_editor( $content, 'mmp_message', $settings ); ?>
       </td>
        </tr>

</table>      
      

        <table class="form-table">

            <div id="hed3"><h3><?php _e('Design')?></h3></div>
              

         <tr>
        <th scope='row'><?php _e('Background Color');?></th>
        <td><label for='mmp_bgcolor'>
          <input type='text' class='color_picker' id='mmp_bgcolor' name='mmp_bgcolor' value='<?php echo get_option('mmp_bgcolor' ); ; ?>'/>
          <p class='description'><?php _e('Change background color') ;?></p>
        </label>
        </td>
      </tr>



      <tr>
        <th scope='row'><?php _e('Text Color');?></th>
        <td><label for='mmp_text_color'>
          <input type='text' class='color_picker' id='mmp_text_color' name='mmp_text_color' value='<?php echo get_option('mmp_text_color' ); ; ?>'/>
          <p class='description'><?php _e('Change Header and sidebar color') ;?></p>
        </label>
        </td>
      </tr>


      <tr>
        <th scope='row'><?php _e('Links Color');?></th>
        <td><label for='mmp_links_color'>
          <input type='text' class='color_picker' id='mmp_links_color' name='mmp_links_color' value='<?php echo get_option('mmp_links_color' ); ; ?>'/>
          <p class='description'><?php _e('Change Links color') ;?></p>
        </label>
        </td>
      </tr>


      <tr>
        <th scope='row'><?php _e('Links Hover Color');?></th>
        <td><label for='mmp_links_hover_color'>
          <input type='text' class='color_picker' id='mmp_links_hover_color' name='mmp_links_hover_color' value='<?php echo get_option('mmp_links_hover_color' ); ; ?>'/>
          <p class='description'><?php _e('Change Links color') ;?></p>
        </label>
        </td>
      </tr>


      <tr valign="top">
        <th scope="row"><?php _e('Background Image'); ?></th>
        <td><label for="mmp_background_image">
          <input id="image_location" type="text" name="mmp_background_image" value="<?php echo get_option('mmp_background_image') ?>" size="50" />
                    <input class="onetarek-upload-button button" type="button" value="Upload Image" />
          <p class='description'><?php _e('Upload or Select Site Background Image') ;?></p>
         </lable>
       </td>
        </tr>


        <tr valign='top'>
            <th scope='row'><?php _e('Responsive Background ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_res_bg" class="onoffswitch-checkbox"  id="myonoffswitch1" value='1'<?php checked(1, get_option('mmp_res_bg')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch1">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr> 



          <th scope='row'><?php _e('Font Family For Text');?></th>
        <td><label for='mmp_fft'>
            <input id="font" type="text" name="mmp_fft" value="<?php echo get_option( 'mmp_fft' ); ?>" />
            
          </label>
        </td>
      </tr>



      <tr>
        <th scope='row'><?php _e('Font Family For Header Text');?></th>
        <td><label for='mmp_ffht'>
          <input id="font1" name="mmp_ffht" type="text" value="<?php echo get_option( 'mmp_ffht' ); ?>" />

        </label>
        </td>
      </tr>

</table>


 <table class="form-table">
            <div id="hed3"><h3><?php _e('Template') ?></h3></div> 
            <tr valign="top">
             <th scope="row"><?php _e( 'Custom Css') ?></th>
             <td><label for="mmp_custom_css">
             <textarea cols="80" rows="7" id="mmp_custom_css"  name="mmp_custom_css"  ><?php echo get_option( 'mmp_custom_css' ); ?> </textarea>
             <p class='description'> <?php _e('Add styling inside this text area.' );?></p>
          </label>
        </td>
      </tr>
    </table>
      
      

        <table class="form-table">

            <div id="hed3"><h3><?php _e('Scripts')?></h3></div>


          <tr valign="top">
             <th scope="row"><?php _e( 'Header Script') ?></th>
             <td><label for="mmp_custom_header_script">
             <textarea cols="50" rows="2" id="mmp_custom_header_script"  name="mmp_custom_header_script"  ><?php echo get_option( 'mmp_custom_header_script' ); ?> </textarea>
             <p class='description'> <?php _e('Add header script in this text area.' );?></p>
          </label>
        </td>
      </tr>


       <tr valign="top">
             <th scope="row"><?php _e( 'Footer Script') ?></th>
             <td><label for="mmp_custom_footrt_script">
             <textarea cols="50" rows="2" id="mmp_custom_footrt_script"  name="mmp_custom_footrt_script"  ><?php echo get_option( 'mmp_custom_footrt_script' ); ?> </textarea>
             <p class='description'> <?php _e('Add footer script in this text area.' );?></p>
          </label>
        </td>
      </tr>


      </table>


     <table class="form-table">

            <div id="hed3"><h3><?php _e('Social')?></h3></div>
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



    <table class="form-table">

            <div id="hed3"><h3><?php _e('Advanced Settings')?></h3></div>


             </tr><tr valign='top'>
            <th scope='row'><?php _e('HTTP 503 Header ');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_http_503" class="onoffswitch-checkbox"  id="myonoffswitch10" value='1'<?php checked(1, get_option('mmp_http_503')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch10">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr>


           </tr><tr valign='top'>
            <th scope='row'><?php _e('Feed Access');?></th>
            <td>
               <div class="onoffswitch">
                     <input type="checkbox" name="mmp_feed_access" class="onoffswitch-checkbox"  id="myonoffswitch11" value='1'<?php checked(1, get_option('mmp_feed_access')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch11">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
           </td>
          </tr>


    </table>

    

      <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
    </p>

 
</form>

<form method="post" action="">
 <p class="submit">
 <input name="reset" class="button button-secondary" type="submit" value="Reset to theme default settings" >
 <input type="hidden" value="reset" />
 </p>
</form>
      
</div> <!-- wraper-->


<?php }

?>