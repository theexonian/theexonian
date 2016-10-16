<?php 
$theme = $wpmchimpa['theme']['a0'];
?>

<style type="text/css">
	
.wpmchimpab {
  min-height: 100px;
  border: solid #dadbdc;
  border-width: 1px 0;
  padding: 50px;
  display: none;
  <?php 
        if(isset($theme["addon_bg_c"])){
            echo 'background:'.$theme["addon_bg_c"].';';
        }
    ?>
}
.wpmchimpab h3{
  font-size: 18px;
  <?php 
        if(isset($theme["addon_heading_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["addon_heading_f"]).';';
        }
        if(isset($theme["addon_heading_fs"])){
            echo 'font-size:'.$theme["addon_heading_fs"].'px;';
        }
        if(isset($theme["addon_heading_fw"])){
            echo 'font-weight:'.$theme["addon_heading_fw"].';';
        }
        if(isset($theme["addon_heading_fst"])){
            echo 'font-style:'.$theme["addon_heading_fst"].';';
        }
        if(isset($theme["addon_heading_fc"])){
            echo 'color:'.$theme["addon_heading_fc"].';';
        }
    ?>
}
.wpmchimpab .wpmchimpa_para {
  margin-bottom: 10px;
}
.wpmchimpab .wpmchimpa_para ,
.wpmchimpab .wpmchimpa_para *{
  font-size: 14px;
  line-height: 20px;
    <?php 
        if(isset($theme["addon_msg_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["addon_msg_f"]).';';
        }
        if(isset($theme["addon_msg_fs"])){
            echo 'font-size:'.$theme["addon_msg_fs"].'px;';
        }
    ?>
}

.wpmchimpab  .wpmchimpa-field{
position: relative;
width:100%;
margin: 0 auto 12px auto;
}

.wpmchimpab .inputicon{
display: none;
}
.wpmchimpab .wpmc-ficon .inputicon {
display: block;
width: 45px;
height: 45px;
position: absolute;
top: 0;
left: 0;
pointer-events: none;
<?php 
if(isset($theme["addon_tbox_h"])){
  echo 'width:'.$theme["addon_tbox_h"].'px;';
  echo 'height:'.$theme["addon_tbox_h"].'px;';
}
?>
}
.wpmchimpab .wpmc-ficon input[type="text"],
.wpmchimpab .wpmc-ficon .inputlabel{
  padding-left: 45px;
  <?php 
if(isset($theme["addon_tbox_h"])){
  echo 'padding-left:'.$theme["addon_tbox_h"].'px;';
  }?>
}
<?php
$col = ((isset($theme["addon_tbox_fc"]))? $theme["addon_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  if($f['icon'] != 'idef' && $f['icon'] != 'inone')
    echo '.wpmchimpab .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$this->getIcon($f['icon'],25,$col).' no-repeat center}';
}
?>

.wpmchimpab .wpmchimpa-field select,
.wpmchimpab input[type="text"]{
    display: inline-block;
    width:100%;
    background:#fff;
    height:45px;
    text-align: center;
    border:2px solid #fff;
    outline:0;
    border-radius: 1px;
    box-sizing: border-box;
    <?php 
        if(isset($theme["addon_tbox_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["addon_tbox_f"]).';';
        }
        if(isset($theme["addon_tbox_fs"])){
            echo 'font-size:'.$theme["addon_tbox_fs"].'px;';
        }
        if(isset($theme["addon_tbox_fw"])){
            echo 'font-weight:'.$theme["addon_tbox_fw"].';';
        }
        if(isset($theme["addon_tbox_fst"])){
            echo 'font-style:'.$theme["addon_tbox_fst"].';';
        }
        if(isset($theme["addon_tbox_fc"])){
            echo 'color:'.$theme["addon_tbox_fc"].';';
        }
        if(isset($theme["addon_tbox_bgc"])){
            echo 'background:'.$theme["addon_tbox_bgc"].';';
        }
        if(isset($theme["addon_tbox_w"])){
            echo 'width:'.$theme["addon_tbox_w"].'px;';
        }
        if(isset($theme["addon_tbox_h"])){
            echo 'height:'.$theme["addon_tbox_h"].'px;';
        }
        if(isset($theme["addon_tbox_bor"]) && isset($theme["addon_tbox_borc"])){
            echo ' border:'.$theme["addon_tbox_bor"].'px solid '.$theme["addon_tbox_borc"].';';
        }
    ?>
}

.wpmchimpab .wpmchimpa-field.wpmchimpa-drop:before{
content: '';
width: 45px;
height: 45px;
position: absolute;
right: 0;
top: 0;
pointer-events: none;
background: no-repeat center;
background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJ1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADdEvm1AAAADHRSTlMAEDBAYJC/wN/g7/BpIqb+AAAASUlEQVQI12NgYGBgDWCAAJ8jEJppzSkFMEPizJlGMKPmzJljIJr1DBCAlNuAGIcZsAG4FFwxSPtxsJzkmTMTIVbsOa2AainEGQDXCB+cPGdC9gAAAABJRU5ErkJggg==);
<?php 
if(isset($theme["addon_tbox_h"])){
  echo 'width:'.$theme["addon_tbox_h"].'px;';
  echo 'height:'.$theme["addon_tbox_h"].'px;';
}
?>
}
.wpmchimpab input[type="text"] ~ .inputlabel{
position: absolute;
top: 0;
left: 0;
right: 0;
pointer-events: none;
width: 100%;
line-height: 45px;
color: rgba(0,0,0,0.6);
font-size: 16px;
font-weight:500;
text-align: center;
white-space: nowrap;
<?php 
if(isset($theme["addon_tbox_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["addon_tbox_f"]).';';
}
if(isset($theme["addon_tbox_fs"])){
    echo 'font-size:'.$theme["addon_tbox_fs"].'px;';
}
if(isset($theme["addon_tbox_fw"])){
    echo 'font-weight:'.$theme["addon_tbox_fw"].';';
}
if(isset($theme["addon_tbox_fst"])){
    echo 'font-style:'.$theme["addon_tbox_fst"].';';
}
if(isset($theme["addon_tbox_fc"])){
    echo 'color:'.$theme["addon_tbox_fc"].';';
}
?>
}
.wpmchimpab input[type="text"]:valid + .inputlabel{
display: none;
}
.wpmchimpab select.wpmcerror,
.wpmchimpab input[type="text"].wpmcerror{
  border-color: red;
}
.wpmchimpab .wpmcinfierr{
  display: block;
  height: 12px;
  line-height: 12px;
  margin-bottom: -12px;
  font-size: 10px;
  color: red;
  <?php
    if(isset($theme["addon_status_f"])){
      echo 'font-family:'.str_replace("|ng","",$theme["addon_status_f"]).';';
    }
    if(isset($theme["addon_status_fw"])){
        echo 'font-weight:'.$theme["addon_status_fw"].';';
    }
    if(isset($theme["addon_status_fst"])){
        echo 'font-style:'.$theme["addon_status_fst"].';';
    }
  ?>
}

.wpmchimpab .wpmchimpa-check *,
.wpmchimpab .wpmchimpa-radio *{
font-size: 16px;
color: #888;
text-align: left;
<?php
if(isset($theme["addon_check_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["addon_check_f"]).';';
}
if(isset($theme["addon_check_fs"])){
    echo 'font-size:'.$theme["addon_check_fs"].'px;';
}
if(isset($theme["addon_check_fw"])){
    echo 'font-weight:'.$theme["addon_check_fw"].';';
}
if(isset($theme["addon_check_fst"])){
    echo 'font-style:'.$theme["addon_check_fst"].';';
}
if(isset($theme["addon_check_fc"])){
    echo 'color:'.$theme["addon_check_fc"].';';
}
?>
}
.wpmchimpab .wpmchimpa-item input {
  display: none;
}
.wpmchimpab .wpmchimpa-item span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-right: 10px;
  line-height: 26px;
}

.wpmchimpab .wpmchimpa-item span:before,
.wpmchimpab .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 18px;
  height: 18px;
  left: 0;
  top: 4px;
  position: absolute;
}

.wpmchimpab .wpmchimpa-item span:before {
background-color: #888;
transition: all 0.3s ease-in-out;
border-radius: 3px;
<?php
  if(isset($theme["addon_check_borc"])){
      echo 'border: 1px solid'.$theme["addon_check_borc"].';';
  }
?>
}
.wpmchimpab .wpmchimpa-item input[type='checkbox'] + span:before {
border-radius: 3px;
}
.wpmchimpab .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 12px;
height: 12px;
top: 7px;
}
.wpmchimpab .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["addon_check_c"])) $color = $theme["addon_check_c"]; else $color = '#158EC6';
  print_r('box-shadow: inset 0 0 0 10px '.$color.';');?>
}

.wpmchimpab .wpmchimpa-item input[type='checkbox'] + span:hover:after, .wpmchimpab input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['addon_check_shade']))$chs=$theme['addon_check_shade'];else $chs='2';
  echo 'background-image: '.$this->chshade($chs).';';?>
  left: -1px;
  bottom: -1px;
}
.wpmchimpab .wpmchimpa-item input[type='checkbox']:not(:checked) + span:hover:after {
<?php echo 'background-image: '.$this->chshade('2').';';?>
 opacity: 0.5;
}

.wpmchimpab .wpmchimpa-subs-button{
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
        if(isset($theme["addon_button_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["addon_button_f"]).';';
        }
        if(isset($theme["addon_button_fs"])){
            echo 'font-size:'.$theme["addon_button_fs"].'px;';
        }
        if(isset($theme["addon_button_fw"])){
            echo 'font-weight:'.$theme["addon_button_fw"].';';
        }
        if(isset($theme["addon_button_fst"])){
            echo 'font-style:'.$theme["addon_button_fst"].';';
        }
        if(isset($theme["addon_button_fc"])){
            echo 'color:'.$theme["addon_button_fc"].';';
        }
        if(isset($theme["addon_button_w"])){
            echo 'width:'.$theme["addon_button_w"].'px;';
        }
        if(isset($theme["addon_button_h"])){
            echo 'height:'.$theme["addon_button_h"].'px;';
        }
        if(isset($theme["addon_button_bc"])){
            echo 'background:'.$theme["addon_button_bc"].';';
        }
        else{ ?>
          background: -moz-linear-gradient(left, #62bc33 0%, #8bd331 100%);
          background: -webkit-gradient(linear, left top, right top, color-stop(0%,#62bc33), color-stop(100%,#8bd331));
          background: -webkit-linear-gradient(left, #62bc33 0%,#8bd331 100%);
          background: -o-linear-gradient(left, #62bc33 0%,#8bd331 100%);
          background: -ms-linear-gradient(left, #62bc33 0%,#8bd331 100%);
          background: linear-gradient(to right, #62bc33 0%,#8bd331 100%);
        <?php }
        if(isset($theme["addon_button_br"])){
            echo 'border-radius:'.$theme["addon_button_br"].'px;';
        }
        if(isset($theme["addon_button_bor"]) && isset($theme["addon_button_borc"])){
            echo ' border:'.$theme["addon_button_bor"].'px solid '.$theme["addon_button_borc"].';';
        }
      ?>
}
.wpmchimpab .wpmchimpa-subs-button::before{
  content: '<?php if(isset($theme['addon_button'])) echo $theme['addon_button'];else echo 'Subscribe';?>';
  display: block;
  position: relative;
  line-height: 45px;
  <?php if(isset($theme["addon_button_h"])){
      echo 'line-height:'.$theme["addon_button_h"].'px;';
  } ?>
}
.wpmchimpab .wpmchimpa-subs-button:hover{

    background:#8BD331;
   
  color:#fff;
	<?php 
        if(isset($theme["addon_button_bch"])){
            echo 'background:'.$theme["addon_button_bch"].';';
        }
        else{ ?> 
          background: -moz-linear-gradient(left, #8BD331 0%, #8bd331 100%);
        background: -webkit-gradient(linear, left top, right top, color-stop(0%,#8BD331), color-stop(100%,#8bd331));
        background: -webkit-linear-gradient(left, #8BD331 0%,#8bd331 100%);
        background: -o-linear-gradient(left, #8BD331 0%,#8bd331 100%);
        background: -ms-linear-gradient(left, #8BD331 0%,#8bd331 100%);
        background: linear-gradient(to right, #8BD331 0%,#8bd331 100%);
          <?php }
        if(isset($theme["addon_button_fch"])){
            echo 'color:'.$theme["addon_button_fch"].';';
        }
        if(isset($theme["addon_button_bor"]) && isset($theme["addon_button_borc"])){
            echo ' border:'.$theme["addon_button_bor"].'px solid '.$theme["addon_button_borc"].';';
        }
      ?>
}

.wpmchimpab .wpmchimpa-subs-button.subsicon:before{
padding-left: 45px;
  <?php 
  if(isset($theme["addon_button_w"])){
      echo 'padding-left:'.$theme["addon_button_h"].'px;';
  }
  ?>
}
.wpmchimpab .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 45px;
width: 45px;
top: 0;
left: 0;
pointer-events: none;
  <?php 
  if(isset($theme["addon_button_h"])){
      echo 'width:'.$theme["addon_button_h"].'px;';
      echo 'height:'.$theme["addon_button_h"].'px;';
  }
  if($theme["addon_button_i"] != 'inone' && $theme["addon_button_i"] != 'idef'){
    $col = ((isset($theme["addon_button_fc"]))? $theme["addon_button_fc"] : '#fff');
     echo 'background: '.$this->getIcon($theme["addon_button_i"],25,$col).' no-repeat center;';
  }
  ?>
}
.wpmchimpab .wpmchimpa-signal-cont{
  display: inline-block;
    vertical-align: middle;
    width: 100%;
    margin-bottom: 20px;
}
.wpmchimpab.signalshow .wpmchimpa-signal {
  display: block;
}
.wpmchimpab .wpmchimpa-signal {
    display: none;
    border: 3px solid #000;
    margin: 0 auto;
left: 0;
top: 4px;
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
        if(isset($theme["addon_spinner_c"])){
            echo 'border:3px solid '.$theme["addon_spinner_c"].';';
        }
      ?>
  -webkit-animation: pulsatea 1s ease-out infinite;
  -moz-animation: pulsatea 1s ease-out infinite;
  -ms-animation: pulsatea 1s ease-out infinite; 
  -o-animation: pulsatea 1s ease-out infinite;
  animation: pulsatea 1s ease-out infinite;
  
}
.wpmchimpab .wpmchimpa-feedback{
  clear:both;
  margin-top: 16px;
position: relative;
  <?php
        if(isset($theme["addon_status_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["addon_status_f"]).';';
        }
        if(isset($theme["addon_status_fs"])){
            echo 'font-size:'.$theme["addon_status_fs"].'px;';
        }
        if(isset($theme["addon_status_fw"])){
            echo 'font-weight:'.$theme["addon_status_fw"].';';
        }
        if(isset($theme["addon_status_fst"])){
            echo 'font-style:'.$theme["addon_status_fst"].';';
        }
        if(isset($theme["addon_status_fc"])){
            echo 'color:'.$theme["addon_status_fc"].';';
        }
      ?>
}
.wpmchimpab .wpmchimpa-tag,
.wpmchimpab .wpmchimpa-tag *{
color:#000;
text-align: center;
font-size: 10px;
<?php
        if(isset($theme["addon_tag_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["addon_tag_f"]).';';
        }
        if(isset($theme["addon_tag_fs"])){
            echo 'font-size:'.$theme["addon_tag_fs"].'px;';
        }
        if(isset($theme["addon_tag_fw"])){
            echo 'font-weight:'.$theme["addon_tag_fw"].';';
        }
        if(isset($theme["addon_tag_fst"])){
            echo 'font-style:'.$theme["addon_tag_fst"].';';
        }
        if(isset($theme["addon_tag_fc"])){
            echo 'color:'.$theme["addon_tag_fc"].';';
        }
      ?>
}
.wpmchimpab .wpmchimpa-tag:before{

   content:<?php
        $tfs=10;
        if(isset($theme["addon_tag_fs"])){$tfs=$theme["addon_tag_fs"];}
        $tfc='#000';
        if(isset($theme["addon_tag_fc"])){$tfc=$theme["addon_tag_fc"];}
        echo ChimpMate_WPMC_Assistant::getIcon('lock1',$tfs,$tfc);?>;
   margin: 5px;
   top: 1px;
   position:relative;
}
@media only screen and (max-width:1024px) {
  .wpmchimpab{
    padding: 10px;
  }

}

@-webkit-keyframes pulsatea {
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
@-moz-keyframes pulsatea {
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
@-ms-keyframes pulsatea {
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
@-o-keyframes pulsatea {
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
@keyframes pulsatea {
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
<div class="wpmchimpa-reset wpmchimpab wpmchimpselector">
  <?php if(isset($theme['addon_heading'])) echo '<h3>'.$theme['addon_heading'].'</h3>';?>
  <?php if(isset($theme['addon_msg'])) echo '<div class="wpmchimpa_para">'.$theme['addon_msg'].'</div>';?>
	<form action="" method="post">
<input type="hidden" name="action" value="wpmchimpa_add_email_ajax"/>
<input type="hidden" name="wpmcform" value="<?php echo $form['id'];?>"/>
<?php $set = array(
  'icon' => false,
  'type' => 1
  );
$this->stfield($form['fields'],$set); ?>

      <div class="wpmchimpa-subs-button<?php echo (isset($theme['addon_button_i']) && $theme['addon_button_i'] != 'inone' && $theme['addon_button_i'] != 'idef')? ' subsicon' : '';?>"></div>
    <?php if(isset($theme['addon_tag_en'])){
      if(isset($theme['addon_tag'])) $tagtxt= $theme['addon_tag'];
      else $tagtxt='Secure and Spam free...';
      echo '<div class="wpmchimpa-tag">'.$tagtxt.'</div>';
      }?>
    <div class="wpmchimpa-signal-cont"><div class="wpmchimpa-signal"></div></div>

	</form>
	<div class="wpmchimpa-feedback" wpmcerr="gen"></div>
</div>