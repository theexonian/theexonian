<?php
$theme = $wpmchimpa['theme']['w9'];
$wpmcw_id = "wpmchimpaw-".rand(1,1000);
 ?>
 <style type="text/css">

#<?php echo $wpmcw_id; ?> {
padding: 0 5px;
background: #27313B;
text-align: center;
width: 100%;
<?php  if(isset($theme["widget_bg_c"])){
    echo 'background-color:'.$theme["widget_bg_c"].';';
}?>
}

#<?php echo $wpmcw_id;?> div{
  position:relative;
}

#<?php echo $wpmcw_id;?> h3{
color: #F4233C;
line-height: 20px;
padding-top:18px;
font-size: 20px;
margin: 0;
<?php 
if(isset($theme["widget_heading_f"])){
echo 'font-family:'.$theme["widget_heading_f"].';';
}
if(isset($theme["widget_heading_fs"])){
echo 'font-size:'.$theme["widget_heading_fs"].'px;';
}
if(isset($theme["widget_heading_fw"])){
echo 'font-weight:'.$theme["widget_heading_fw"].';';
}
if(isset($theme["widget_heading_fst"])){
echo 'font-style:'.$theme["widget_heading_fst"].';';
}
if(isset($theme["widget_heading_fc"])){
echo 'color:'.$theme["widget_heading_fc"].';';
}
?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa_para {
  padding: 12px 0;
  line-height: 14px;
}
#<?php echo $wpmcw_id;?> .wpmchimpa_para ,
#<?php echo $wpmcw_id;?> .wpmchimpa_para *{
font-size: 12px;
color: #959595;
<?php if(isset($theme["widget_msg_f"])){
  echo 'font-family:'.$theme["widget_msg_f"].';';
}if(isset($theme["widget_msg_fs"])){
    echo 'font-size:'.$theme["widget_msg_fs"].'px;';
}?>
}
#<?php echo $wpmcw_id;?> > p{
}
#<?php echo $wpmcw_id;?> form{
margin: 20px auto;
}
#<?php echo $wpmcw_id;?> .formbox > div:first-of-type{
  width: 65%;
  float: left;
}
#<?php echo $wpmcw_id;?> .formbox > div:first-of-type + div{
  width: 35%;
  float: left;
  text-align: center;
}
#<?php echo $wpmcw_id;?> .formbox input[type="text"]{
border-radius: 3px 0 0 3px;
}

#<?php echo $wpmcw_id;?>  .wpmchimpa-field{
position: relative;
width:100%;
margin: 0 auto 10px auto;
text-align: left;
}
#<?php echo $wpmcw_id;?> .inputicon{
display: none;
}
#<?php echo $wpmcw_id;?> .wpmc-ficon .inputicon {
display: block;
width: 35px;
height: 35px;
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
#<?php echo $wpmcw_id;?> .wpmchimpa-field.wpmc-ficon input[type="text"],
#<?php echo $wpmcw_id;?> .wpmchimpa-field.wpmc-ficon .inputlabel{
  padding-left: 35px;
  <?php 
if(isset($theme["widget_tbox_h"])){
  echo 'padding-left:'.$theme["widget_tbox_h"].'px;';
  }?>
}
<?php
$col = ((isset($theme["widget_tbox_fc"]))? $theme["widget_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  $fi = false;
  if($f['icon'] == 'idef'){
    if($f['tag']=='email')
      $fi = 'a02';
    else if($f['tag']=='FNAME' || $f['tag']=='LNAME')
      $fi = 'c06';
  }
  else if( $f['icon'] != 'inone')
    $fi = $f['icon'];
  if($fi)
    echo '#'.$wpmcw_id.' .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$plugin->getIcon($fi,15,$col).' no-repeat center}';
}
?>
#<?php echo $wpmcw_id;?> .wpmchimpa-field select,
#<?php echo $wpmcw_id;?> input[type="text"]{
text-align: left;
width: 100%;
height: 35px;
background: #fff;
 padding: 0 10px;
border-radius: 3px;
color: #353535;
font-size:14px;
outline:0;
display: block;
border: 1px solid #efefef;
<?php 
    if(isset($theme["widget_tbox_f"])){
      echo 'font-family:'.$theme["widget_tbox_f"].';';
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
width: 35px;
height: 35px;
position: absolute;
right: 0;
top: 0;
pointer-events: none;
background: no-repeat center;
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
line-height: 35px;
color: rgba(0,0,0,0.6);
font-size: 16px;
font-weight:500;
padding: 0 10px;
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
#<?php echo $wpmcw_id;?> .wpmchimpa-check *,
#<?php echo $wpmcw_id;?> .wpmchimpa-radio *{
color: #fff;
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
#<?php echo $wpmcw_id;?> .wpmchimpa-item input {
  display: none;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-item span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-right: 10px;
  line-height: 26px;
}

#<?php echo $wpmcw_id;?> .wpmchimpa-item span:before,
#<?php echo $wpmcw_id;?> .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 16px;
  height: 16px;
  left: 0;
  top: 5px;
  position: absolute;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-item span:before {
background-color: #fff;
transition: all 0.3s ease-in-out;
<?php
  if(isset($theme["widget_check_borc"])){
      echo 'border: 1px solid'.$theme["widget_check_borc"].';';
  }
?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["widget_check_c"]))echo 'background: '.$theme["widget_check_c"].';';?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-item input[type='checkbox'] + span:hover:after, #<?php echo $wpmcw_id;?> input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['widget_check_shade']))$chs=$theme['widget_check_shade'];else $chs='1';
  echo 'background-image: '.$plugin->chshade($chs).';';?>
  left: -1px;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 16px;
height: 16px;
top: 4px;
}
#<?php echo $wpmcw_id;?> input[type='radio']:checked + span:after {
background: <?php echo ($chs == 1)?'#7C7C7C':'#fafafa';?>;
width: 12px;
height: 12px;
top: 6px;
left: 2px;
border-radius: 50%;
}
#<?php echo $wpmcw_id;?> .wpmcinfierr{
  display: block;
  height: 10px;
  text-align: left;
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

#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button{
border-radius: 0 3px 3px 0;
width: 100%;
color: #fff;
font-size: 17px;
border: 1px solid #FA0B38;
background-color: #FF1F43;
height: 35px;
line-height: 30px;
text-align: center;
cursor: pointer;
position: absolute;
top: 0;
transition: all 0.5s ease;
<?php
if(isset($theme["widget_button_f"])){
echo 'font-family:'.$theme["widget_button_f"].';';
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
echo 'line-height:'.$theme["widget_button_h"].'px;';
}
if(isset($theme["widget_button_bc"])){
echo 'background-color:'.$theme["widget_button_bc"].';';
}
if(isset($theme["widget_button_br"])){
echo '-webkit-border-radius:'.$theme["widget_button_br"].'px;';
echo '-moz-border-radius:'.$theme["widget_button_br"].'px;';
echo 'border-radius:'.$theme["widget_button_br"].'px;';
}
if(isset($theme["widget_button_bor"]) && isset($theme["widget_button_borc"])){
echo ' border:'.$theme["widget_button_bor"].'px solid '.$theme["widget_button_borc"].';';
}
?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button::before{
content: '<?php if(isset($theme['widget_button'])) echo $theme['widget_button'];else echo 'Subscribe';?>';
}
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button:hover{
background-color: #FA0B38;
<?php if(isset($theme["widget_button_fch"])){
echo 'color:'.$theme["widget_button_fch"].';';
}    
if(isset($theme["widget_button_bch"])){
echo 'background-color:'.$theme["widget_button_bch"].';';
}?>
}

#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button.subsicon ~ .wpmchimpa-signal,
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button.subsicon:before{
padding-left: 35px;
  <?php 
  if(isset($theme["widget_button_w"])){
      echo 'padding-left:'.$theme["widget_button_h"].'px;';
  }
  ?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 35px;
width: 35px;
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
     echo 'background: '.$plugin->getIcon($theme["widget_button_i"],25,$col).' no-repeat center;';
  }
  ?>
}
#<?php echo $wpmcw_id;?>.signalshow .wpmchimpa-subs-button::before{
  content:'';
}

#<?php echo $wpmcw_id;?> .wpmchimpa-signal {
display: none;
  z-index: 1;
    top: 4px;
-webkit-transform: scale(0.5);
-ms-transform: scale(0.5);
transform: scale(0.5);
}
#<?php echo $wpmcw_id;?>.signalshow .wpmchimpa-signal {
  display: inline-block;
}

<?php $color ="#000";
if(isset($theme["widget_spinner_c"])){
    $color = $theme["widget_spinner_c"];
}?>
#<?php echo $wpmcw_id;?> .sp8 {margin: 0 auto;width: 50px;height: 30px;}#<?php echo $wpmcw_id;?> .sp8 > div {background-color: <?php echo $color;?>;margin-left: 3px;height: 100%;width: 6px;display: inline-block;-webkit-animation: <?php echo $wpmcw_id;?>sp8 1.2s infinite ease-in-out;animation: <?php echo $wpmcw_id;?>sp8 1.2s infinite ease-in-out;}#<?php echo $wpmcw_id;?> .sp8 .sp82 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}#<?php echo $wpmcw_id;?> .sp8 .sp83 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}#<?php echo $wpmcw_id;?> .sp8 .sp84 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}#<?php echo $wpmcw_id;?> .sp8 .sp85 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes <?php echo $wpmcw_id;?>sp8 {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes <?php echo $wpmcw_id;?>sp8 {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}

#<?php echo $wpmcw_id;?> .wpmchimpa-tag{
margin: 5px auto;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-tag,
#<?php echo $wpmcw_id;?> .wpmchimpa-tag *{
color:#fff;
font-size: 10px;
<?php
  if(isset($theme["widget_tag_f"])){
    echo 'font-family:'.$theme["widget_tag_f"].';';
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
#<?php echo $wpmcw_id;?> .wpmchimpa-tag:before{
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
#<?php echo $wpmcw_id;?> .wpmchimpa-feedback{
text-align: center;
position: relative;
color: #ccc;
font-size: 10px;
height: 12px;
margin-top: -12px;
<?php
if(isset($theme["widget_status_f"])){
  echo 'font-family:'.$theme["widget_status_f"].';';
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
#<?php echo $wpmcw_id;?> .wpmchimpa-feedback.wpmchimpa-done{
font-size: 15px; margin: 10px;height: auto;padding: 10px;
}


</style>
<div class="widget-text wp_widget_plugin_box">
<?php if(isset($theme['widget_heading']))
  echo $before_title . $theme['widget_heading'] . $after_title;?>
<div class="wpmchimpa-reset wpmchimpselector wpmchimpa chimpmatecss" id="<?php echo $wpmcw_id;?>">
	   <?php if(isset($theme['widget_msg'])) echo '<div class="wpmchimpa_para">'.$theme['widget_msg'].'</div>';?>
    <form action="" method="post" >
              
<input type="hidden" name="action" value="wpmchimpa_add_email_ajax"/>
<input type="hidden" name="wpmcform" value="<?php echo $form['id'];?>"/>
<?php $set = array(
'icon' => true,
'bui' => (isset($theme['widget_button_i']) && $theme['widget_button_i'] != 'inone' && $theme['widget_button_i'] != 'idef')?true:false,
'type' => 2
);
$plugin->stfield($form['fields'],$set); ?>

              <?php if(isset($theme['widget_tag_en'])){
              if(isset($theme['widget_tag'])) $tagtxt= $theme['widget_tag'];
              else $tagtxt='Secure and Spam free...';
              echo '<div class="wpmchimpa-tag">'.$tagtxt.'</div>';
              }?>

    </form>
    	<div class="wpmchimpa-feedback" wpmcerr="gen"></div>
	</div>	
</div>