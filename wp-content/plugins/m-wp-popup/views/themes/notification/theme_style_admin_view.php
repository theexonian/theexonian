<label><strong><?php _e( 'Font' ) ?></strong><p> 
<select name="t_style[font]" title="Font style: [font=Tahoma]text[/font]">
	  <option style='font-family: "Segoe UI", "arial";' value="default" <?php selected( 'default', $settings['style']['font'] ) ?>>Default</option>
	  <option style="font-family: Helvetica;" value="Helvetica" <?php selected( 'Helvetica', $settings['style']['font'] ) ?>>Helvetica</option>
      <option style="font-family: Tahoma;" value="Tahoma" <?php selected( 'Tahoma', $settings['style']['font'] ) ?>>Tahoma</option>
      <option style="font-family: Verdana;" value="Verdana" <?php selected( 'Verdana', $settings['style']['font'] ) ?>>Verdana</option>
      <option style="font-family: Arial Black;" value="Arial Black" <?php selected( 'Arial Black', $settings['style']['font'] ) ?>>Arial Black</option>
      <option style="font-family: Comic Sans MS;" value="Comic Sans MS" <?php selected( 'Comic Sans MS', $settings['style']['font'] ) ?>>Comic Sans MS</option>
      <option style="font-family: Lucida Console;" value="Lucida Console" <?php selected( 'Lucida Console', $settings['style']['font'] ) ?>>Lucida Console</option>
      <option style="font-family: Palatino Linotype;" value="Palatino Linotype" <?php selected( 'Palatino Linotype', $settings['style']['font'] ) ?>>Palatino Linotype</option>
      <option style="font-family: MS Sans Serif4;" value="MS Sans Serif4" <?php selected( 'MS Sans Serif4', $settings['style']['font'] ) ?>>MS Sans Serif4</option>
      <option style="font-family: System;" value="System" <?php selected( 'System', $settings['style']['font'] ) ?>>System</option>
      <option style="font-family: Georgia1;" value="Georgia1" <?php selected( 'Georgia1', $settings['style']['font'] ) ?>>Georgia1</option>
      <option style="font-family: Impact;" value="Impact" <?php selected( 'Impact', $settings['style']['font'] ) ?>>Impact</option>
      <option style="font-family: Courier;" value="Courier" <?php selected( 'Courier', $settings['style']['font'] ) ?>>Courier</option>
      <option style="font-family: Symbol;" value="Symbol" <?php selected( 'Symbol', $settings['style']['font'] ) ?>>Symbol</option>
   </select>
</p></label>

<label><strong><?php _e( 'Heading color' ) ?></strong><p> 
<input type="text" id="heading_color_field" value="<?php echo $settings['style']['heading_color'] ?>" name="t_style[heading_color]" placeholder="" />
</p></label>
<div id="heading_colorpicker" class="wpp_colorpicker"></div>

<label><strong><?php _e( 'Button text color' ) ?></strong><p> 
<input type="text" id="btntxt_color_field" value="<?php echo $settings['style']['btntxt_color'] ?>" name="t_style[btntxt_color]" placeholder="" />
</p></label>
<div id="btntxt_colorpicker" class="wpp_colorpicker"></div>

<label><strong><?php _e( 'Button color' ) ?></strong><p> 
<input type="text" id="btn_color_field" value="<?php echo $settings['style']['btn_color'] ?>" name="t_style[btn_color]" placeholder="" />
</p></label>
<div id="btn_colorpicker" class="wpp_colorpicker"></div>

<label><strong><?php _e( 'Background color' ) ?></strong><p> 
<input type="text" id="box_color_field" value="<?php echo $settings['style']['box_color'] ?>" name="t_style[box_color]" placeholder="" />
</p></label>
<div id="box_colorpicker" class="wpp_colorpicker"></div>

<script>
jQuery(function ($) {
      
      $('#heading_colorpicker').hide();
    $('#heading_colorpicker').farbtastic('#heading_color_field');
      $('#heading_color_field').click(function() {
        $('#heading_colorpicker').fadeIn();
      });

      $('#btntxt_colorpicker').hide();
    $('#btntxt_colorpicker').farbtastic('#btntxt_color_field');
    $('#btntxt_color_field').click(function() {
        $('#btntxt_colorpicker').fadeIn();
      });


      $('#btn_colorpicker').hide();
    $('#btn_colorpicker').farbtastic('#btn_color_field');
    $('#btn_color_field').click(function() {
        $('#btn_colorpicker').fadeIn();
      });

     $('#box_colorpicker').hide();
    $('#box_colorpicker').farbtastic('#box_color_field');
    $('#box_color_field').click(function() {
        $('#box_colorpicker').fadeIn();
      });



       $(document).mousedown(function() {
            $('.wpp_colorpicker').each(function() {
                var display = $(this).css('display');
                if ( display == 'block' )
                    $(this).fadeOut();
            });
    });

});

</script>