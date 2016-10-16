<?php
$theme = $wpmchimpa['theme']['w1'];
$wpmcw_id = "wpmchimpaw-".rand(1,1000);
echo '<div class="widget-text wp_widget_plugin_box">';
if(isset($theme['widget_heading']))
	echo $before_title . $theme['widget_heading'] . $after_title;
 ?>
 <style type="text/css">

#<?php echo $wpmcw_id; ?> {
width: 100%;
background: #fff;
<?php  if(isset($theme["widget_bg_c"])){
    echo 'background-color:'.$theme["widget_bg_c"].';';
}?>
border-radius: 10px;
    padding: 0 4px;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-leftpane{
width: 100%;
display: inline-block;
text-align: center;
<?php 
        if(isset($theme["widget_dissoc"])){
          echo 'display:none;';
        }?>
}

#<?php echo $wpmcw_id; ?> .wpmchimpa_para ,
#<?php echo $wpmcw_id; ?> .wpmchimpa_para *{
<?php if(isset($theme["widget_msg_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["widget_msg_f"]).';';
}if(isset($theme["widget_msg_fs"])){
    echo 'font-size:'.$theme["widget_msg_fs"].'px;';
}?>
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
width: 45px;
height: 45px;
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
#<?php echo $wpmcw_id; ?> .wpmchimpa-field.wpmc-ficon input[type="text"],
#<?php echo $wpmcw_id; ?> .wpmchimpa-field.wpmc-ficon .inputlabel{
  padding-left: 45px;
  <?php 
if(isset($theme["widget_tbox_h"])){
  echo 'padding-left:'.$theme["widget_tbox_h"].'px;';
  }?>
}
<?php
$col = ((isset($theme["widget_tbox_fc"]))? $theme["widget_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  if($f['icon'] != 'idef' && $f['icon'] != 'inone')
    echo '#'.$wpmcw_id.' .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$plugin->getIcon($f['icon'],25,$col).' no-repeat center}';
}
?>
#<?php echo $wpmcw_id; ?> .wpmchimpa-field select,
#<?php echo $wpmcw_id; ?> input[type="text"]{
    width: 100%;
    height: 45px;
    background: #f8fafa;
    padding: 0 20px;
    border: 1px solid #e4e9e9;
    border-radius: 5px;
    color: #353535;
    font-size: 16px;
    outline:0;
    display: block;
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

#<?php echo $wpmcw_id; ?> .wpmchimpa-field.wpmchimpa-drop:before{
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
if(isset($theme["widget_tbox_h"])){
  echo 'width:'.$theme["widget_tbox_h"].'px;';
  echo 'height:'.$theme["widget_tbox_h"].'px;';
}
?>
}
#<?php echo $wpmcw_id; ?> input[type="text"] ~ .inputlabel{
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
padding: 0 20px;
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
#<?php echo $wpmcw_id; ?> input[type="text"]:valid + .inputlabel{
display: none;
}
#<?php echo $wpmcw_id; ?> select.wpmcerror,
#<?php echo $wpmcw_id; ?> input[type="text"].wpmcerror{
  border-color: red;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-check *,
#<?php echo $wpmcw_id; ?> .wpmchimpa-radio *{
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
  line-height: 29px;
  margin-right: 10px;
}

#<?php echo $wpmcw_id; ?> .wpmchimpa-item span:before,
#<?php echo $wpmcw_id; ?> .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 18px;
  height: 18px;
  left: 0;
  top: 5px;
  position: absolute;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item span:before {
box-shadow: 0 0 1px 1px #ccc;
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
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["widget_check_c"]))echo 'background: '.$theme["widget_check_c"].';';?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input[type='checkbox'] + span:hover:after, #<?php echo $wpmcw_id; ?> input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['widget_check_shade']))$chs=$theme['widget_check_shade'];else $chs='1';
  echo 'background-image: '.$plugin->chshade($chs).';';?>
  left: -1px;
  bottom: -1px;
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 16px;
height: 16px;
top: 5px;
}
#<?php echo $wpmcw_id; ?> input[type='radio']:checked + span:after {
background: <?php echo ($chs == 1)?'#7C7C7C':'#fafafa';?>;
width: 12px;
height: 12px;
top: 7px;
left: 2px;
border-radius: 50%;
}
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
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button{
    border-radius: 3px;
    width: 100%;
	padding: 0 22px;
    color: #fff;
    font-size: 22px;
    border: 1px solid #3079ed;
   background-color: #4d90fe;
   height: 45px;
line-height: 45px;
    text-align: center;
    cursor: pointer;
    margin-bottom: 10px;
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
            echo 'background-color:'.$theme["widget_button_bc"].';';
        }
        else{ ?>
  background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
  <?php }
        if(isset($theme["widget_button_br"])){
            echo 'border-radius:'.$theme["widget_button_br"].'px;';
        }
        if(isset($theme["widget_button_bor"]) && isset($theme["widget_button_borc"])){
            echo ' border:'.$theme["widget_button_bor"].'px solid '.$theme["widget_button_borc"].';';
        }
      ?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button::before{
content: '<?php if(isset($theme['widget_button'])) echo $theme['widget_button'];else echo 'Subscribe';?>';
<?php if(isset($theme["widget_button_h"])){
      echo 'line-height:'.$theme["widget_button_h"].'px;';
  } ?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-subs-button:hover{
<?php if(isset($theme["widget_button_fch"])){
        echo 'color:'.$theme["widget_button_fch"].';';
    }    
    if(isset($theme["widget_button_bch"])){
        echo 'background-color:'.$theme["widget_button_bch"].';';
    } else{ ?>
  background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
  <?php }?>
}

#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button.subsicon:before{
padding-left: 45px;
  <?php 
  if(isset($theme["widget_button_w"])){
      echo 'padding-left:'.$theme["widget_button_h"].'px;';
  }
  ?>
}
#<?php echo $wpmcw_id; ?> .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 45px;
width: 45px;
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
#<?php echo $wpmcw_id;?> .wpmchimpa-social{
display: inline-block;
margin-bottom: 10px;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social::before{
content: '<?php if(isset($theme['widget_soc_head'])) echo $theme['widget_soc_head'];else echo 'Subscribe with';?>';
font-size: 20px;
line-height: 30px;
display: block;
     <?php
        if(isset($theme["widget_soc_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["widget_soc_f"]).';';
        }
        if(isset($theme["widget_soc_fs"])){
            echo 'font-size:'.$theme["widget_soc_fs"].'px;';
        }
        if(isset($theme["widget_soc_fw"])){
            echo 'font-weight:'.$theme["widget_soc_fw"].';';
        }
        if(isset($theme["widget_soc_fst"])){
            echo 'font-style:'.$theme["widget_soc_fst"].';';
        }
        if(isset($theme["widget_soc_fc"])){
            echo 'color:'.$theme["widget_soc_fc"].';';
        }
      ?>
}

#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc{
    width:40px;
    height: 40px;
    -webkit-border-radius: 50%;
    -moz-box-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    float: left;
    margin: 5px;
    cursor: pointer;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 7px;
}

#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb {
    background: #2d609b;
    <?php if(!isset($wpmchimpa["fb_api"])){
	echo 'display:none;';
    }?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
   content:<?php echo $plugin->getIcon('fb',25,'#fff');?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp {
    background: #eb4026;
    <?php if(!isset($wpmchimpa["gp_api"])){
	echo 'display:none;';
    }?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
    content: <?php echo $plugin->getIcon('gp',25,'#fff');?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms {
    background: #00BCF2;
    <?php if(!isset($wpmchimpa["ms_api"])){
	echo 'display:none;';
    }?>
}
#<?php echo $wpmcw_id;?> .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
    content: <?php echo $plugin->getIcon('ms',25,'#fff');?>
}

#<?php echo $wpmcw_id;?> .wpmchimpa-signalc {
  position: relative;
  height: 40px;
}

#<?php echo $wpmcw_id; ?>.signalshow .wpmchimpa-signal {
  display: block;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-signal {
  -webkit-animation: animatew 1.5s linear infinite;
  -moz-animation: animatew 1.5s linear infinite;
  -ms-animation: animatew 1.5s linear infinite;
  -o-animation: animatew 1.5s linear infinite;
  animation: animatew 1.5s linear infinite;
  clip: rect(0, 40px, 40px, 20px); 
  height: 40px;
  width: 40px;
  position: absolute;
 display: none;
 left: calc(50% - 20px);
}
@-webkit-keyframes animatew {
  0% { 
    -webkit-transform: rotate(0deg)
  }
  100% { 
    -webkit-transform: rotate(220deg)
  }
}
@-moz-keyframes animatew {
  0% { 
    -moz-transform: rotate(0deg)
  }
  100% { 
    -moz-transform: rotate(220deg)
  }
}
@-ms-keyframes animatew {
  0% { 
    -ms-transform: rotate(0deg)
  }
  100% { 
    -ms-transform: rotate(220deg)
  }
}
@-o-keyframes animatew {
  0% { 
    -o-transform: rotate(0deg)
  }
  100% { 
    -o-transform: rotate(220deg)
  }
}
@keyframes animatew {
  0% { 
    transform: rotate(0deg)
  }
  100% { 
    transform: rotate(220deg)
  }
}
#<?php echo $wpmcw_id;?> .wpmchimpa-signal:after {
  -webkit-animation: animatew2 1.5s ease-in-out infinite;
  -moz-animation: animatew2 1.5s ease-in-out infinite;
  -ms-animation: animatew2 1.5s ease-in-out infinite;
  -o-animation: animatew2 1.5s ease-in-out infinite;
  animation: animatew2 1.5s ease-in-out infinite;
  
  clip: rect(0, 40px, 40px, 20px);
  content:'';
  -webkit-border-radius: 50%; 
  -moz-border-radius: 50%; 
  -ms-border-radius: 50%; 
  -o-border-radius: 50%; 
  border-radius: 50%; 
  height: 40px;
  width: 40px;
  position: absolute; 
} 
<?php  if(isset($theme["widget_spinner_c"]))$c=$theme["widget_spinner_c"];else $c="#000";?>
@-webkit-keyframes animatew2 {
  0% {
    -webkit-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -webkit-transform: rotate(-140deg);
  }
  50% {
    -webkit-box-shadow: inset <?php echo $c;?> 0 0 0 2px;
  }
  100% {
    -webkit-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -webkit-transform: rotate(140deg);
  }
} 
@-moz-keyframes animatew2 {
  0% {
    -moz-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -moz-transform: rotate(-140deg);
  }
  50% {
    -moz-box-shadow: inset <?php echo $c;?> 0 0 0 2px;
  }
  100% {
    -moz-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -moz-transform: rotate(140deg);
  }
} 
@-ms-keyframes animatew2 {
  0% {
    -ms-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -ms-transform: rotate(-140deg);
  }
  50% {
    -ms-box-shadow: inset <?php echo $c;?> 0 0 0 2px;
  }
  100% {
    -ms-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -ms-transform: rotate(140deg);
  }
} 
@-o-keyframes animatew2 {
  0% {
    -o-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -o-transform: rotate(-140deg);
  }
  50% {
    -o-box-shadow: inset <?php echo $c;?> 0 0 0 2px;
  }
  100% {
    -o-box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    -o-transform: rotate(140deg);
  }
} 
@keyframes animatew2 {
  0% {
    box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    transform: rotate(-140deg);
  }
  50% {
    box-shadow: inset <?php echo $c;?> 0 0 0 2px;
  }
  100% {
    box-shadow: inset <?php echo $c;?> 0 0 0 7px;
    transform: rotate(140deg);
  }
}

#<?php echo $wpmcw_id;?> .wpmchimpa-tag,
#<?php echo $wpmcw_id;?> .wpmchimpa-tag *{
color:#000;
font-size: 10px;
text-align: center;
position: relative;
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
#<?php echo $wpmcw_id;?> .wpmchimpa-tag:before{

   content:<?php
        $tfs=10;
        if(isset($theme["widget_tag_fs"])){$tfs=$theme["widget_tag_fs"];}
        $tfc='#000';
        if(isset($theme["widget_tag_fc"])){$tfc=$theme["widget_tag_fc"];}
        echo $plugin->getIcon('lock1',$tfs,$tfc);?>;
   margin: 5px;
   top: 1px;
   position:relative;
}
#<?php echo $wpmcw_id;?> .wpmchimpa-feedback{
top: -50px;
text-align: center;
position: relative;
font-size: 16px;
height: 16px;
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

#<?php echo $wpmcw_id;?> .wpmchimpa-feedback.wpmchimpa-done{
top: 0;
margin-top: 10px;
height: auto;
}

</style>

<div class="wpmchimpa-reset wpmchimpselector" id="<?php echo $wpmcw_id;?>">
	    <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
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
	</div>	
</div>