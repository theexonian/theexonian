<?php
$theme = $wpmchimpa['theme']['w0'];
$wpmcw_id = "wpmchimpaw-".rand(1,1000);
echo '<div class="widget-text wp_widget_plugin_box">';
if(isset($theme['widget_heading']))
	echo $before_title . $theme['widget_heading'] . $after_title;
 ?>
 <style type="text/css">

#<?php echo $wpmcw_id; ?> {
  width: 100%;
  display: block;
  padding-bottom: 10px;
  <?php 
  if(isset($theme["widget_bg_c"])){
    echo 'background-color:'.$theme['widget_bg_c'].';';
  }?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa_para ,
#<?php echo $wpmcw_id; ?> .wpmchimpa_para *{
margin-bottom: 15px;
line-height: 20px;
<?php 
  if(isset($theme["widget_msg_f"])){
    echo 'font-family:'.str_replace("|ng","",$theme["widget_msg_f"]).';';
  }
  if(isset($theme["widget_msg_fs"])){
      echo 'font-size:'.$theme["widget_msg_fs"].'px;';
  }
    ?>
}

#<?php echo $wpmcw_id; ?>  .wpmchimpa-field{
position: relative;
width:100%;
margin: 0 auto 10px auto;
}

#<?php echo $wpmcw_id; ?> .inputicon{
display: none;
}
#<?php echo $wpmcw_id; ?> .wpmc-ficon .inputicon {
display: block;
width: 40px;
height: 40px;
position: absolute;
top: 0;
left: 0;
pointer-events: none;
<?php 
if(isset($theme["widget_tbox_h"])){
  echo 'width:'.$theme["widget_tbox_h"].'px;';
  echo 'height:'.$theme["widget_tbox_h"].'px;';
}
?>
}
#<?php echo $wpmcw_id; ?> .wpmc-ficon input[type="text"],
#<?php echo $wpmcw_id; ?> .wpmc-ficon .inputlabel{
  padding-left: 40px;
  <?php 
if(isset($theme["widget_tbox_h"])){
  echo 'padding-left:'.$theme["widget_tbox_h"].'px;';
  }?>
}
<?php
$col = ((isset($theme["widget_tbox_fc"]))? $theme["widget_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  if($f['icon'] != 'idef' && $f['icon'] != 'inone')
    echo '#'.$wpmcw_id.' .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$plugin->getIcon($f['icon'],20,$col).' no-repeat center}';
}
?>

#<?php echo $wpmcw_id; ?> .wpmchimpa-field select,
#<?php echo $wpmcw_id; ?> input[type="text"]{
  text-align: center;
  outline:0;
  border-radius: 1px;
  width: 100%;
   height: 40px;
  box-sizing: border-box;
  border:0;
  <?php 
        if(isset($theme["widget_tbox_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["widget_tbox_f"]).';';
        }
        if(isset($theme["widget_tbox_fs"])){
            echo 'font-size:'.$theme["widget_tbox_fs"].'px;';
        }
        if(isset($theme["widget_tbox_fw"])){
            echo 'font-weight:'.$theme["widget_tbox_fw"].';';
        }
        if(isset($theme["widget_tbox_fst"])){
            echo 'font-style:'.$theme["widget_tbox_fst"].';';
        }
        if(isset($theme["widget_tbox_fc"])){
            echo 'color:'.$theme["widget_tbox_fc"].';';
        }
        if(isset($theme["widget_tbox_bgc"])){
            echo 'background:'.$theme["widget_tbox_bgc"].';';
        }
        if(isset($theme["widget_tbox_w"])){
            echo 'width:'.$theme["widget_tbox_w"].'px;';
        }
        if(isset($theme["widget_tbox_h"])){
            echo 'height:'.$theme["widget_tbox_h"].'px;';
        }
        if(isset($theme["widget_tbox_bor"]) && isset($theme["widget_tbox_borc"])){
            echo ' border:'.$theme["widget_tbox_bor"].'px solid '.$theme["widget_tbox_borc"].';';
        }
    ?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-field.wpmchimpa-drop:before{
content: '';
width: 40px;
height: 40px;
position: absolute;
right: 0;
top: 0;
pointer-events: none;
background: no-repeat center;
background-size: 15px;
background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJ1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADdEvm1AAAADHRSTlMAEDBAYJC/wN/g7/BpIqb+AAAASUlEQVQI12NgYGBgDWCAAJ8jEJppzSkFMEPizJlGMKPmzJljIJr1DBCAlNuAGIcZsAG4FFwxSPtxsJzkmTMTIVbsOa2AainEGQDXCB+cPGdC9gAAAABJRU5ErkJggg==);
<?php 
if(isset($theme["widget_tbox_h"])){
  echo 'width:'.$theme["widget_tbox_h"].'px;';
  echo 'height:'.$theme["widget_tbox_h"].'px;';
}
?>
}

#<?php echo $wpmcw_id;?> input[type="text"] ~ .inputlabel{
position: absolute;
top: 0;
left: 0;
right: 0;
pointer-events: none;
width: 100%;
line-height: 40px;
color: rgba(0,0,0,0.6);
font-size: 16px;
font-weight:500;
text-align: center;
white-space: nowrap;
<?php 
if(isset($theme["widget_tbox_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["widget_tbox_f"]).';';
}
if(isset($theme["widget_tbox_fs"])){
    echo 'font-size:'.$theme["widget_tbox_fs"].'px;';
}
if(isset($theme["widget_tbox_fw"])){
    echo 'font-weight:'.$theme["widget_tbox_fw"].';';
}
if(isset($theme["widget_tbox_fst"])){
    echo 'font-style:'.$theme["widget_tbox_fst"].';';
}
if(isset($theme["widget_tbox_fc"])){
    echo 'color:'.$theme["widget_tbox_fc"].';';
}
?>
}
#<?php echo $wpmcw_id;?> input[type="text"]:valid + .inputlabel{
display: none;
}
#<?php echo $wpmcw_id;?> select.wpmcerror,
#<?php echo $wpmcw_id;?> input[type="text"].wpmcerror{
  border-color: red;
}


#<?php echo $wpmcw_id; ?> .wpmchimpa-check *,
#<?php echo $wpmcw_id; ?> .wpmchimpa-radio *{
font-size: 16px;
color: #fff;
text-align: left;
<?php
if(isset($theme["widget_check_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["widget_check_f"]).';';
}
if(isset($theme["widget_check_fs"])){
    echo 'font-size:'.$theme["widget_check_fs"].'px;';
}
if(isset($theme["widget_check_fw"])){
    echo 'font-weight:'.$theme["widget_check_fw"].';';
}
if(isset($theme["widget_check_fst"])){
    echo 'font-style:'.$theme["widget_check_fst"].';';
}
if(isset($theme["widget_check_fc"])){
    echo 'color:'.$theme["widget_check_fc"].';';
}
?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input {
  display: none;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-right: 10px;
  line-height: 26px;
}

#<?php echo $wpmcw_id; ?> .wpmchimpa-item span:before,
#<?php echo $wpmcw_id; ?> .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 18px;
  height: 18px;
  left: 0;
  top: 4px;
  position: absolute;
}

#<?php echo $wpmcw_id; ?> .wpmchimpa-item span:before {
background-color: #fafafa;
transition: all 0.3s ease-in-out;
border-radius: 3px;
<?php
  if(isset($theme["widget_check_borc"])){
      echo 'border: 1px solid'.$theme["widget_check_borc"].';';
  }
?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input[type='checkbox'] + span:before {
border-radius: 3px;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 12px;
height: 12px;
top: 7px;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["widget_check_c"])) $color = $theme["widget_check_c"]; else $color = '#158EC6';
  print_r('box-shadow: inset 0 0 0 10px '.$color.';');?>
}

#<?php echo $wpmcw_id; ?> .wpmchimpa-item input[type='checkbox'] + span:hover:after, #<?php echo $wpmcw_id; ?> input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['widget_check_shade']))$chs=$theme['widget_check_shade'];else $chs='2';
  echo 'background-image: '.$plugin->chshade($chs).';';?>
  left: -1px;
  bottom: -1px;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input[type='checkbox']:not(:checked) + span:hover:after {
<?php echo 'background-image: '.$plugin->chshade('2').';';?>
 opacity: 0.5;
}


#<?php echo $wpmcw_id; ?> form{overflow: hidden}

#<?php echo $wpmcw_id;?> .wpmcinfierr{
  display: block;
  height: 10px;
  line-height: 10px;
  margin-bottom: -10px;
  font-size: 10px;
  color: red;
  <?php
    if(isset($theme["widget_status_f"])){
      echo 'font-family:'.str_replace("|ng","",$theme["widget_status_f"]).';';
    }
    if(isset($theme["widget_status_fw"])){
        echo 'font-weight:'.$theme["widget_status_fw"].';';
    }
    if(isset($theme["widget_status_fst"])){
        echo 'font-style:'.$theme["widget_status_fst"].';';
    }
  ?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button{
  margin: 12px 0;
  width: 100%;
  height: 40px;
text-align: center;
    background: #62bc33;
    cursor:pointer;
  color:#fff;
    box-shadow:none;
    clear:both;
    text-decoration:none;
    text-shadow:none;
    border: 0;
    border-radius: 1px;
    position: relative;
  <?php
        if(isset($theme["widget_button_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["widget_button_f"]).';';
        }
        if(isset($theme["widget_button_fs"])){
            echo 'font-size:'.$theme["widget_button_fs"].'px;';
        }
        if(isset($theme["widget_button_fw"])){
            echo 'font-weight:'.$theme["widget_button_fw"].';';
        }
        if(isset($theme["widget_button_fst"])){
            echo 'font-style:'.$theme["widget_button_fst"].';';
        }
        if(isset($theme["widget_button_fc"])){
            echo 'color:'.$theme["widget_button_fc"].';';
        }
        if(isset($theme["widget_button_w"])){
            echo 'width:'.$theme["widget_button_w"].'px;';
        }
        if(isset($theme["widget_button_h"])){
            echo 'height:'.$theme["widget_button_h"].'px;';
        }
        if(isset($theme["widget_button_bc"])){
            echo 'background:'.$theme["widget_button_bc"].';';
        }
        else { ?>
        background: -moz-linear-gradient(left, #62bc33 0%, #8bd331 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%,#62bc33), color-stop(100%,#8bd331));
        background: -webkit-linear-gradient(left, #62bc33 0%,#8bd331 100%);
        background: -o-linear-gradient(left, #62bc33 0%,#8bd331 100%);
        background: -ms-linear-gradient(left, #62bc33 0%,#8bd331 100%);
        background: linear-gradient(to right, #62bc33 0%,#8bd331 100%);
          <?php }
        if(isset($theme["widget_button_br"])){
            echo 'border-radius:'.$theme["widget_button_br"].'px;';
        }
        if(isset($theme["widget_button_bor"]) && isset($theme["widget_button_borc"])){
            echo ' border:'.$theme["widget_button_bor"].'px solid '.$theme["widget_button_borc"].';';
        }
      ?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button::before{
content: '<?php if(isset($theme['widget_button'])) echo $theme['widget_button'];else echo 'Subscribe';?>';
  display: block;
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button:hover{
  
    background:#8BD331;
   
  color:#fff;
  <?php 
        if(isset($theme["widget_button_bch"])){
            echo 'background:'.$theme["widget_button_bch"].';';
        }
        else{ ?>
           background: -moz-linear-gradient(left, #8BD331 0%, #8bd331 100%);
          background: -webkit-gradient(linear, left top, right top, color-stop(0%,#8BD331), color-stop(100%,#8bd331));
          background: -webkit-linear-gradient(left, #8BD331 0%,#8bd331 100%);
          background: -o-linear-gradient(left, #8BD331 0%,#8bd331 100%);
          background: -ms-linear-gradient(left, #8BD331 0%,#8bd331 100%);
          background: linear-gradient(to right, #8BD331 0%,#8bd331 100%);
          <?php }
        if(isset($theme["widget_button_fch"])){
            echo 'color:'.$theme["widget_button_fch"].';';
        }
        if(isset($theme["widget_button_bor"]) && isset($theme["widget_button_borc"])){
            echo ' border:'.$theme["widget_button_bor"].'px solid '.$theme["widget_button_borc"].';';
        }
      ?>
}

#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button.subsicon:before{
padding-left: 40px;
  <?php 
  if(isset($theme["widget_button_w"])){
      echo 'padding-left:'.$theme["widget_button_h"].'px;';
  }
  ?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 40px;
width: 40px;
top: 0;
left: 0;
pointer-events: none;
  <?php 
  if(isset($theme["widget_button_h"])){
      echo 'width:'.$theme["widget_button_h"].'px;';
      echo 'height:'.$theme["widget_button_h"].'px;';
  }
  if($theme["widget_button_i"] != 'inone' && $theme["widget_button_i"] != 'idef'){
    $col = ((isset($theme["widget_button_fc"]))? $theme["widget_button_fc"] : '#fff');
     echo 'background: '.$plugin->getIcon($theme["widget_button_i"],20,$col).' no-repeat center;';
  }
  ?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-feedback {
  height: 14px;
  margin-top: -20px;
<?php
        if(isset($theme["widget_status_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["widget_status_f"]).';';
        }
        if(isset($theme["widget_status_fs"])){
            echo 'font-size:'.$theme["widget_status_fs"].'px;';
        }
        if(isset($theme["widget_status_fw"])){
            echo 'font-weight:'.$theme["widget_status_fw"].';';
        }
        if(isset($theme["widget_status_fst"])){
            echo 'font-style:'.$theme["widget_status_fst"].';';
        }
        if(isset($theme["widget_status_fc"])){
            echo 'color:'.$theme["widget_status_fc"].';';
        }
      ?>


}
#<?php echo $wpmcw_id; ?> .wpmchimpa-feedback.wpmchimpa-done{
margin-top: 14px;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-tag,
#<?php echo $wpmcw_id; ?> .wpmchimpa-tag *{
color:#fff;
font-size: 10px;
text-align: center;
<?php
        if(isset($theme["widget_tag_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["widget_tag_f"]).';';
        }
        if(isset($theme["widget_tag_fs"])){
            echo 'font-size:'.$theme["widget_tag_fs"].'px;';
        }
        if(isset($theme["widget_tag_fw"])){
            echo 'font-weight:'.$theme["widget_tag_fw"].';';
        }
        if(isset($theme["widget_tag_fst"])){
            echo 'font-style:'.$theme["widget_tag_fst"].';';
        }
        if(isset($theme["widget_tag_fc"])){
            echo 'color:'.$theme["widget_tag_fc"].';';
        }
      ?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-tag:before{

   content:<?php
        $tfs=10;
        if(isset($theme["widget_tag_fs"])){$tfs=$theme["widget_tag_fs"];}
        $tfc='#fff';
        if(isset($theme["widget_tag_fc"])){$tfc=$theme["widget_tag_fc"];}
        echo $plugin->getIcon('lock1',$tfs,$tfc);?>;
   margin: 5px;
   top: 1px;
   position:relative;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-signalc {
height: 40px;
margin-top: 10px;
}
#<?php echo $wpmcw_id; ?>.signalshow .wpmchimpa-signal {
  display: block;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-signal {
    display: none;
    border: 3px solid #000;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    -o-border-radius: 30px;
    height: 30px;
    opacity: 0;
    margin:0 auto;
    position: relative;
    width: 30px;
    vertical-align: middle;
 <?php
        if(isset($theme["widget_spinner_c"])){
            echo 'border:3px solid '.$theme["widget_spinner_c"].';';
        }
      ?>
  -webkit-animation: pulsatew 1s ease-out infinite;
  -moz-animation: pulsatew 1s ease-out infinite;
  -ms-animation: pulsatew 1s ease-out infinite; 
  -o-animation: pulsatew 1s ease-out infinite;
  animation: pulsatew 1s ease-out infinite;
  
}
@-webkit-keyframes pulsatew {
    0% {
       -webkit-transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
       -webkit-transform:scale(1.2);
      opacity:0;
    }
}
@-moz-keyframes pulsatew {
    0% {
       -moz-transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
       -moz-transform:scale(1.2);
      opacity:0;
    }
}
@-ms-keyframes pulsatew {
    0% {
       -ms-transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
       -ms-transform:scale(1.2);
      opacity:0;
    }
}
@-o-keyframes pulsatew {
    0% {
       -o-transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
       -o-transform:scale(1.2);
      opacity:0;
    }
}
@keyframes pulsatew {
    0% {
       transform:scale(.1);
      opacity: 0.0;
    }
    50% {
      opacity:1;
    }
    100% {
       transform:scale(1.2);
      opacity:0;
    }
}

 </style>
<div class="wpmchimpa-reset wpmchimpselector" id="<?php echo $wpmcw_id; ?>">
	<?php if(isset($theme['widget_msg'])) echo '<div class="wpmchimpa_para">'.$theme['widget_msg'].'</div>';?>
	<form action="" method="post">
<input type="hidden" name="action" value="wpmchimpa_add_email_ajax"/>
<input type="hidden" name="wpmcform" value="<?php echo $form['id'];?>"/>
<?php $set = array(
  'icon' => false,
  'type' => 1
  );
$plugin->stfield($form['fields'],$set); ?>
      <div class="wpmchimpa-subs-button<?php echo (isset($theme['widget_button_i']) && $theme['widget_button_i'] != 'inone' && $theme['widget_button_i'] != 'idef')? ' subsicon' : '';?>"></div>
<?php if(isset($theme['widget_tag_en'])){
                          if(isset($theme['widget_tag'])) $tagtxt= $theme['widget_tag'];
                          else $tagtxt='Secure and Spam free...';
                          echo '<div class="wpmchimpa-tag">'.$tagtxt.'</div>';
                          }?>
	<div class="wpmchimpa-signalc"><div class="wpmchimpa-signal"></div></div>
	</form>
	<div class="wpmchimpa-feedback" wpmcerr="gen"></div>
</div> </div>