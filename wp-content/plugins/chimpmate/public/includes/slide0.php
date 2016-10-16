<?php 
$theme = $wpmchimpa['theme']['s0'];
?>
<style type="text/css">
	
.wpmchimpas {
background: #333;
color: #fff;
<?php
        if(isset($theme["slider_bg_c"])){
            echo 'background:'.$theme["slider_bg_c"].';';
        }?>
}
.wpmchimpas-inner {
text-align: center;
}
.wpmchimpas h3{
  font-size: 18px;
  line-height: 18px;
  margin: 40px 0 20px;
  <?php 
        if(isset($theme["slider_heading_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["slider_heading_f"]).';';
        }
        if(isset($theme["slider_heading_fs"])){
            echo 'font-size:'.$theme["slider_heading_fs"].'px;';
        }
        if(isset($theme["slider_heading_fw"])){
            echo 'font-weight:'.$theme["slider_heading_fw"].';';
        }
        if(isset($theme["slider_heading_fst"])){
            echo 'font-style:'.$theme["slider_heading_fst"].';';
        }
        if(isset($theme["slider_heading_fc"])){
            echo 'color:'.$theme["slider_heading_fc"].';';
        }
    ?>
}
.wpmchimpas .wpmchimpa_para {
  margin-bottom: 10px;
}
.wpmchimpas .wpmchimpa_para ,
.wpmchimpas .wpmchimpa_para *{
  font-size: 14px;
  line-height: 20px;
  text-align: center;
    <?php 
        if(isset($theme["slider_msg_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["slider_msg_f"]).';';
        }
        if(isset($theme["slider_msg_fs"])){
            echo 'font-size:'.$theme["slider_msg_fs"].'px;';
        }
    ?>
}

.wpmchimpas  .wpmchimpa-field{
position: relative;
width:100%;
margin: 0 auto 12px auto;
}

.wpmchimpas .inputicon{
display: none;
}
.wpmchimpas .wpmc-ficon .inputicon {
display: block;
width: 50px;
height: 50px;
position: absolute;
top: 0;
left: 0;
pointer-events: none;
<?php 
if(isset($theme["slider_tbox_h"])){
  echo 'width:'.$theme["slider_tbox_h"].'px;';
  echo 'height:'.$theme["slider_tbox_h"].'px;';
}
?>
}
.wpmchimpas .wpmc-ficon input[type="text"],
.wpmchimpas .wpmc-ficon .inputlabel{
  padding-left: 50px;
  <?php 
if(isset($theme["slider_tbox_h"])){
  echo 'padding-left:'.$theme["slider_tbox_h"].'px;';
  }?>
}
<?php
$col = ((isset($theme["slider_tbox_fc"]))? $theme["slider_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  if($f['icon'] != 'idef' && $f['icon'] != 'inone')
    echo '.wpmchimpas .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$this->getIcon($f['icon'],25,$col).' no-repeat center}';
}
?>

.wpmchimpas .wpmchimpa-field select,
.wpmchimpas input[type="text"]{
font-size: 16px;
font-weight:500;
display: block;
background:#fff;
color:#888;
width: 100%;
height: 50px;
text-align: center;
border:2px solid #fff;
outline:0;
border-radius: 1px;
box-sizing: border-box;
transition: all 0.5s ease;
    <?php 
        if(isset($wpmchimpa['namebox'])){
          echo 'width:100%;';
        }
        else echo 'float: left;';
        if(isset($theme["slider_tbox_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["slider_tbox_f"]).';';
        }
        if(isset($theme["slider_tbox_fs"])){
            echo 'font-size:'.$theme["slider_tbox_fs"].'px;';
        }
        if(isset($theme["slider_tbox_fw"])){
            echo 'font-weight:'.$theme["slider_tbox_fw"].';';
        }
        if(isset($theme["slider_tbox_fst"])){
            echo 'font-style:'.$theme["slider_tbox_fst"].';';
        }
        if(isset($theme["slider_tbox_fc"])){
            echo 'color:'.$theme["slider_tbox_fc"].';';
        }
        if(isset($theme["slider_tbox_bgc"])){
            echo 'background:'.$theme["slider_tbox_bgc"].';';
        }
        if(isset($theme["slider_tbox_w"])){
            echo 'width:'.$theme["slider_tbox_w"].'px;';
        }
        if(isset($theme["slider_tbox_h"])){
            echo 'height:'.$theme["slider_tbox_h"].'px;';
        }
        if(isset($theme["slider_tbox_bor"]) && isset($theme["slider_tbox_borc"])){
            echo ' border:'.$theme["slider_tbox_bor"].'px solid '.$theme["slider_tbox_borc"].';';
        }
    ?>
}
.wpmchimpas .wpmchimpa-field.wpmchimpa-drop:before{
content: '';
width: 50px;
height: 50px;
position: absolute;
right: 0;
top: 0;
pointer-events: none;
background: no-repeat center;
background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJ1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADdEvm1AAAADHRSTlMAEDBAYJC/wN/g7/BpIqb+AAAASUlEQVQI12NgYGBgDWCAAJ8jEJppzSkFMEPizJlGMKPmzJljIJr1DBCAlNuAGIcZsAG4FFwxSPtxsJzkmTMTIVbsOa2AainEGQDXCB+cPGdC9gAAAABJRU5ErkJggg==);
<?php 
if(isset($theme["slider_tbox_h"])){
  echo 'width:'.$theme["slider_tbox_h"].'px;';
  echo 'height:'.$theme["slider_tbox_h"].'px;';
}
?>
}
.wpmchimpas input[type="text"] ~ .inputlabel{
position: absolute;
top: 0;
left: 0;
right: 0;
pointer-events: none;
width: 100%;
line-height: 50px;
color: rgba(0,0,0,0.6);
font-size: 16px;
font-weight:500;
white-space: nowrap;
<?php 
if(isset($theme["slider_tbox_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["slider_tbox_f"]).';';
}
if(isset($theme["slider_tbox_fs"])){
    echo 'font-size:'.$theme["slider_tbox_fs"].'px;';
}
if(isset($theme["slider_tbox_fw"])){
    echo 'font-weight:'.$theme["slider_tbox_fw"].';';
}
if(isset($theme["slider_tbox_fst"])){
    echo 'font-style:'.$theme["slider_tbox_fst"].';';
}
if(isset($theme["slider_tbox_fc"])){
    echo 'color:'.$theme["slider_tbox_fc"].';';
}
?>
}
.wpmchimpas input[type="text"]:valid + .inputlabel{
display: none;
}
.wpmchimpas select.wpmcerror,
.wpmchimpas input[type="text"].wpmcerror{
  border-color: red;
}

.wpmchimpas .wpmchimpa-check *,
.wpmchimpas .wpmchimpa-radio *{
font-size: 16px;
color: #fff;
text-align: left;
<?php
if(isset($theme["slider_check_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["slider_check_f"]).';';
}
if(isset($theme["slider_check_fs"])){
    echo 'font-size:'.$theme["slider_check_fs"].'px;';
}
if(isset($theme["slider_check_fw"])){
    echo 'font-weight:'.$theme["slider_check_fw"].';';
}
if(isset($theme["slider_check_fst"])){
    echo 'font-style:'.$theme["slider_check_fst"].';';
}
if(isset($theme["slider_check_fc"])){
    echo 'color:'.$theme["slider_check_fc"].';';
}
?>
}
.wpmchimpas .wpmchimpa-item input {
  display: none;
}
.wpmchimpas .wpmchimpa-item span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-right: 10px;
  line-height: 26px;
}

.wpmchimpas .wpmchimpa-item span:before,
.wpmchimpas .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 18px;
  height: 18px;
  left: 0;
  top: 4px;
  position: absolute;
}

.wpmchimpas .wpmchimpa-item span:before {
background-color: #fafafa;
transition: all 0.3s ease-in-out;
border-radius: 3px;
<?php
  if(isset($theme["slider_check_borc"])){
      echo 'border: 1px solid'.$theme["slider_check_borc"].';';
  }
?>
}
.wpmchimpas .wpmchimpa-item input[type='checkbox'] + span:before {
border-radius: 3px;
}
.wpmchimpas .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 12px;
height: 12px;
top: 7px;
}
.wpmchimpas .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["slider_check_c"])) $color = $theme["slider_check_c"]; else $color = '#158EC6';
  print_r('box-shadow: inset 0 0 0 10px '.$color.';');?>
}

.wpmchimpas .wpmchimpa-item input[type='checkbox'] + span:hover:after, .wpmchimpas input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['slider_check_shade']))$chs=$theme['slider_check_shade'];else $chs='2';
  echo 'background-image: '.$this->chshade($chs).';';?>
  left: -1px;
  bottom: -1px;
}
.wpmchimpas .wpmchimpa-item input[type='checkbox']:not(:checked) + span:hover:after {
<?php echo 'background-image: '.$this->chshade('2').';';?>
 opacity: 0.5;
}

.wpmchimpas .wpmcinfierr{
  display: block;
  height: 12px;
  line-height: 12px;
  margin-bottom: -12px;
  font-size: 11px;
  color: red;
  <?php
    if(isset($theme["slider_status_f"])){
      echo 'font-family:'.str_replace("|ng","",$theme["slider_status_f"]).';';
    }
    if(isset($theme["slider_status_fw"])){
        echo 'font-weight:'.$theme["slider_status_fw"].';';
    }
    if(isset($theme["slider_status_fst"])){
        echo 'font-style:'.$theme["slider_status_fst"].';';
    }
  ?>
}

.wpmchimpas .wpmchimpa-subs-button{
  display:inline-block;
  vertical-align: initial;
  text-align: center;
  width: 100%;
    height:45px;
    background: #62bc33;
  color:#fff;
    cursor:pointer;
    box-shadow:none;
    clear:both;
    text-shadow:none;
    border: 0;
    border-radius: 1px;
    position: relative;
  <?php
        if(isset($wpmchimpa['namebox'])){
          echo 'width:100%;';
        }
        if(isset($theme["slider_button_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["slider_button_f"]).';';
        }
        if(isset($theme["slider_button_fs"])){
            echo 'font-size:'.$theme["slider_button_fs"].'px;';
        }
        if(isset($theme["slider_button_fw"])){
            echo 'font-weight:'.$theme["slider_button_fw"].';';
        }
        if(isset($theme["slider_button_fst"])){
            echo 'font-style:'.$theme["slider_button_fst"].';';
        }
        if(isset($theme["slider_button_fc"])){
            echo 'color:'.$theme["slider_button_fc"].';';
        }
        if(isset($theme["slider_button_w"])){
            echo 'width:'.$theme["slider_button_w"].'px;';
        }
        if(isset($theme["slider_button_h"])){
            echo 'height:'.$theme["slider_button_h"].'px;';
        }
        if(isset($theme["slider_button_bc"])){
            echo 'background:'.$theme["slider_button_bc"].';';
        }
        else{ ?>
          background: -moz-linear-gradient(left, #62bc33 0%, #8bd331 100%);
          background: -webkit-gradient(linear, left top, right top, color-stop(0%,#62bc33), color-stop(100%,#8bd331));
          background: -webkit-linear-gradient(left, #62bc33 0%,#8bd331 100%);
          background: -o-linear-gradient(left, #62bc33 0%,#8bd331 100%);
          background: -ms-linear-gradient(left, #62bc33 0%,#8bd331 100%);
          background: linear-gradient(to right, #62bc33 0%,#8bd331 100%);
        <?php }
        if(isset($theme["slider_button_br"])){
            echo 'border-radius:'.$theme["slider_button_br"].'px;';
        }
        if(isset($theme["slider_button_bor"]) && isset($theme["slider_button_borc"])){
            echo ' border:'.$theme["slider_button_bor"].'px solid '.$theme["slider_button_borc"].';';
        }
      ?>
}
.wpmchimpas .wpmchimpa-subs-button::before{
  content: '<?php if(isset($theme['slider_button'])) echo $theme['slider_button'];else echo 'Subscribe';?>';
  display: block;
  position: relative;
  line-height: 45px;
  <?php if(isset($theme["slider_button_h"])){
      echo 'line-height:'.$theme["slider_button_h"].'px;';
  } ?>
}
.wpmchimpas .wpmchimpa-subs-button:hover{
    background:#8BD331;
  color:#fff;
	<?php 
        if(isset($theme["slider_button_bch"])){
            echo 'background:'.$theme["slider_button_bch"].';';
        }
        else{ ?> 
          background: -moz-linear-gradient(left, #8BD331 0%, #8bd331 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%,#8BD331), color-stop(100%,#8bd331));
        background: -webkit-linear-gradient(left, #8BD331 0%,#8bd331 100%);
        background: -o-linear-gradient(left, #8BD331 0%,#8bd331 100%);
        background: -ms-linear-gradient(left, #8BD331 0%,#8bd331 100%);
        background: linear-gradient(to right, #8BD331 0%,#8bd331 100%);
          <?php }
        if(isset($theme["slider_button_fch"])){
            echo 'color:'.$theme["slider_button_fch"].';';
        }
        if(isset($theme["slider_button_bor"]) && isset($theme["slider_button_borc"])){
            echo ' border:'.$theme["slider_button_bor"].'px solid '.$theme["slider_button_borc"].';';
        }
      ?>
}

.wpmchimpas .wpmchimpa-subs-button.subsicon:before{
padding-left: 45px;
  <?php 
  if(isset($theme["slider_button_w"])){
      echo 'padding-left:'.$theme["slider_button_h"].'px;';
  }
  ?>
}
.wpmchimpas .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 45px;
width: 45px;
top: 0;
left: 0;
pointer-events: none;
  <?php 
  if(isset($theme["slider_button_h"])){
      echo 'width:'.$theme["slider_button_h"].'px;';
      echo 'height:'.$theme["slider_button_h"].'px;';
  }
  if($theme["slider_button_i"] != 'inone' && $theme["slider_button_i"] != 'idef'){
    $col = ((isset($theme["slider_button_fc"]))? $theme["slider_button_fc"] : '#fff');
     echo 'background: '.$this->getIcon($theme["slider_button_i"],25,$col).' no-repeat center;';
  }
  ?>
}
.wpmchimpas .wpmchimpa-signalc {
height: 40px;
top: 4px;
margin-top: 10px;
}
.wpmchimpas .wpmchimpas-inner.signalshow .wpmchimpa-signal {
  display: block;
}
.wpmchimpas .wpmchimpa-signal {
    display: none;
    border: 3px solid #fff;
    margin: 0 auto;
left: 0;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    -o-border-radius: 30px;
    height: 30px;
    opacity: 0;
    position: relative;
    width: 30px;
 <?php
        if(isset($theme["slider_spinner_c"])){
            echo 'border:3px solid '.$theme["slider_spinner_c"].';';
        }
      ?>
  -webkit-animation: pulsates 1s ease-out infinite;
  -moz-animation: pulsates 1s ease-out infinite;
  -ms-animation: pulsates 1s ease-out infinite; 
  -o-animation: pulsates 1s ease-out infinite;
  animation: pulsates 1s ease-out infinite;
  
}
.wpmchimpas .wpmchimpa-feedback{
  clear:both;
  margin-top:-14px;
  height: 14px; 
position: relative;
  <?php
        if(isset($theme["slider_status_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["slider_status_f"]).';';
        }
        if(isset($theme["slider_status_fs"])){
            echo 'font-size:'.$theme["slider_status_fs"].'px;';
        }
        if(isset($theme["slider_status_fw"])){
            echo 'font-weight:'.$theme["slider_status_fw"].';';
        }
        if(isset($theme["slider_status_fst"])){
            echo 'font-style:'.$theme["slider_status_fst"].';';
        }
        if(isset($theme["slider_status_fc"])){
            echo 'color:'.$theme["slider_status_fc"].';';
        }
      ?>
}
.wpmchimpas .wpmchimpa-feedback.wpmchimpa-done{
margin-top: 14px;
}  
@-webkit-keyframes pulsates {
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
@-moz-keyframes pulsates {
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
@-ms-keyframes pulsates {
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
@-o-keyframes pulsates {
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
@keyframes pulsates {
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

.wpmchimpas .wpmchimpa-tag{
margin-top: 5px;
}
.wpmchimpas .wpmchimpa-tag,
.wpmchimpas .wpmchimpa-tag *{
  color:#fff;
font-size: 10px;
<?php
        if(isset($theme["slider_tag_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["slider_tag_f"]).';';
        }
        if(isset($theme["slider_tag_fs"])){
            echo 'font-size:'.$theme["slider_tag_fs"].'px;';
        }
        if(isset($theme["slider_tag_fw"])){
            echo 'font-weight:'.$theme["slider_tag_fw"].';';
        }
        if(isset($theme["slider_tag_fst"])){
            echo 'font-style:'.$theme["slider_tag_fst"].';';
        }
        if(isset($theme["slider_tag_fc"])){
            echo 'color:'.$theme["slider_tag_fc"].';';
        }
      ?>
}
.wpmchimpas .wpmchimpa-tag:before{

   content:<?php
        $tfs=10;
        if(isset($theme["slider_tag_fs"])){$tfs=$theme["slider_tag_fs"];}
        $tfc='#fff';
        if(isset($theme["slider_tag_fc"])){$tfc=$theme["slider_tag_fc"];}
        echo $this->getIcon('lock1',$tfs,$tfc);?>;
   margin: 5px;
   top: 1px;
   position:relative;
}
.wpmchimpas-trig{	
top:40%;
<?php
    if(isset($theme["slider_trigger_top"])){
        echo 'top:'.$theme["slider_trigger_top"].'%;';
    }
  ?>
}
.wpmchimpas-trig .wpmchimpas-trigi{ 
background: #000;
width:50px;
height:50px;
<?php
  if(isset($theme["slider_trigger_bg"])){
      echo 'background:'.$theme["slider_trigger_bg"].';';
  }
?>
}
.wpmchimpas-trig .wpmchimpas-trigi:hover{
opacity:0.7;
}
.wpmchimpas-trig.scrollhide{
-webkit-transform: translateX(-50px);
-moz-transform: translateX(-50px);
-ms-transform: translateX(-50px);
-o-transform: translateX(-50px);
transform: translateX(-50px);
}
.wpmchimpas-trig.right.scrollhide{
-webkit-transform: translateX(50px);
-moz-transform: translateX(50px);
-ms-transform: translateX(50px);
-o-transform: translateX(50px);
transform: translateX(50px);
}
.wpmchimpas-trig .wpmchimpas-trigi:before{
<?php 
$ti='a01';
if(isset($theme["slider_trigger_i"])){
  if($theme["slider_trigger_i"] == 'inone')$ti='';
  else if($theme["slider_trigger_i"] == 'idef')$ti='a01';
  else $ti=$theme["slider_trigger_i"];
}
 ?>
content:<?php echo $this->getIcon($ti,32,(isset($theme["slider_trigger_c"]))?$theme["slider_trigger_c"]:'#fff');?>;
height: 32px;
width: 32px;
display: block;
margin: 8px;
position: absolute;
}
#wpmchimpas-trig .wpmchimpas-trigh{
<?php
  if(isset($theme["slider_trigger_hider"]))
    echo 'display:block;';
?>
}
#wpmchimpas-trig .wpmchimpas-trigh:before{
<?php
  if(isset($theme["slider_trigger_hc"])){
    echo 'border-right-color: '.$theme["slider_trigger_hc"].';';
    echo 'border-left-color: '.$theme["slider_trigger_hc"].';';
  }
?>
}
</style>



<div id="wpmchimpas">
  <div class="wpmchimpas-cont">
  <div class="wpmchimpas-scroller">
    <div class="wpmchimpas-resp">
    <div class="wpmchimpas-inner wpmchimpselector">
<?php if(isset($theme['slider_heading'])) echo '<h3>'.$theme['slider_heading'].'</h3>';?>
<?php if(isset($theme['slider_msg'])) echo '<div class="wpmchimpa_para">'.$theme['slider_msg'].'</div>';?>
 	<form action="" method="post" class="wpmchimpa-reset wpmchimpa-mainc">
<input type="hidden" name="action" value="wpmchimpa_add_email_ajax"/>
<input type="hidden" name="wpmcform" value="<?php echo $form['id'];?>"/>
<?php $set = array(
  'icon' => false,
  'type' => 1
  );
$this->stfield($form['fields'],$set); ?>
    <div class="wpmchimpa-subs-button<?php echo (isset($theme['slider_button_i']) && $theme['slider_button_i'] != 'inone' && $theme['slider_button_i'] != 'idef')? ' subsicon' : '';?>"></div>
    <?php if(isset($theme['slider_tag_en'])){
        if(isset($theme['slider_tag'])) $tagtxt= $theme['slider_tag'];
        else $tagtxt='Secure and Spam free...';
        echo '<div class="wpmchimpa-tag">'.$tagtxt.'</div>';
        }?>
    <div class="wpmchimpa-signalc"><div class="wpmchimpa-signal"></div></div>
	</form>
	<div class="wpmchimpa-feedback" wpmcerr="gen"></div>

    </div>
  </div>
</div>
</div>
</div><div class="wpmchimpas-bg"></div>
<div class="wpmchimpas-overlay"></div>
<div id="wpmchimpas-trig" class="chimpmatecss" <?php if(isset($wpmchimpa['slider_trigger_scroll'])) echo 'class="scrollhide"';?>>
  <div class="wpmchimpas-trigc">
    <div class="wpmchimpas-trigi"></div>
    <div class="wpmchimpas-trigh"></div>
  </div>
</div>