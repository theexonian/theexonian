<?php 
$theme = $wpmchimpa['theme']['s1'];
?>
<style type="text/css">

.wpmchimpas {
background: #333;
<?php
        if(isset($theme["slider_canvas_c"])){
            echo 'background:'.$theme["slider_canvas_c"].';';
        }?>
}
.wpmchimpas-inner {
text-align: center;
background: #fff;
-webkit-border-radius:10px;
-moz-border-radius:10px;
border-radius:10px;
<?php
        if(isset($theme["slider_bg_c"])){
            echo 'background:'.$theme["slider_bg_c"].';';
        }?>
}

.wpmchimpas .wpmchimpa-leftpane{
display: inline-block;
<?php 
if(isset($theme["slider_dissoc"])){
echo 'display:none;';
}?>
}
.wpmchimpas form{
display: inline-block;
width: 80%;
}
.wpmchimpas .wpmchimpa-cont{
margin-top: 20px;
}
.wpmchimpas h3{
line-height: 34px;
margin: 40px 0 20px;
color: #454545;
font-size: 34px;
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
.wpmchimpas .wpmchimpa_para,
.wpmchimpas .wpmchimpa_para *{
<?php if(isset($theme["slider_msg_f"])){
echo 'font-family:'.str_replace("|ng","",$theme["slider_msg_f"]).';';
}if(isset($theme["slider_msg_fs"])){
echo 'font-size:'.$theme["slider_msg_fs"].'px;';
}?>
}

.wpmchimpas  .wpmchimpa-field{
position: relative;
width:100%;
margin: 0 auto 10px auto;
text-align: left;
}
.wpmchimpas .inputicon{
display: none;
}
.wpmchimpas .wpmc-ficon .inputicon {
display: block;
width: 45px;
height: 45px;
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
.wpmchimpas .wpmchimpa-field.wpmc-ficon input[type="text"],
.wpmchimpas .wpmchimpa-field.wpmc-ficon .inputlabel{
  padding-left: 45px;
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
width: 100%;
height: 45px;
border-radius: 5px;
background: #f8fafa;
padding: 0 20px;
border: 1px solid #e4e9e9;
color: #353535;
font-size: 16px;
outline:0;
display: block;
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
width: 45px;
height: 45px;
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
line-height: 45px;
color: rgba(0,0,0,0.6);
font-size: 16px;
font-weight:500;
padding: 0 20px;
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
  line-height: 29px;
}

.wpmchimpas .wpmchimpa-item span:before,
.wpmchimpas .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 18px;
  height: 18px;
  left: 0;
  top: 5px;
  position: absolute;
}
.wpmchimpas .wpmchimpa-item span:before {
box-shadow: 0 0 1px 1px #ccc;
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
.wpmchimpas .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["slider_check_c"]))echo 'background: '.$theme["slider_check_c"].';';?>
}
.wpmchimpas .wpmchimpa-item input[type='checkbox'] + span:hover:after, .wpmchimpas input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['slider_check_shade']))$chs=$theme['slider_check_shade'];else $chs='1';
  echo 'background-image: '.$this->chshade($chs).';';?>
  left: -1px;
  bottom: -1px;
}
.wpmchimpas .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 16px;
height: 16px;
top: 5px;
}
.wpmchimpas input[type='radio']:checked + span:after {
background: <?php echo ($chs == 1)?'#7C7C7C':'#fafafa';?>;
width: 12px;
height: 12px;
top: 7px;
left: 2px;
border-radius: 50%;
}
.wpmchimpas .wpmcinfierr{
  display: block;
  text-align: left;
  height: 10px;
  line-height: 10px;
  margin-bottom: -10px;
  font-size: 10px;
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
echo 'background-color:'.$theme["slider_button_bc"].';';
}
else{ ?>
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
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
<?php if(isset($theme["slider_button_h"])){
echo 'line-height:'.$theme["slider_button_h"].'px;';
} ?>
}
.wpmchimpas .wpmchimpa-subs-button:hover{
<?php if(isset($theme["slider_button_fch"])){
echo 'color:'.$theme["slider_button_fch"].';';
}    
if(isset($theme["slider_button_bch"])){
echo 'background-color:'.$theme["slider_button_bch"].';';
} else{ ?>
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
<?php }?>
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
.wpmchimpas .wpmchimpa-social{
display: inline-block;
margin-bottom: 10px;
}
.wpmchimpas .wpmchimpa-social::before{
content: '<?php if(isset($theme['slider_soc_head'])) echo $theme['slider_soc_head'];else echo 'Subscribe with';?>';
font-size: 20px;
line-height: 30px;
display: block;
<?php
if(isset($theme["slider_soc_f"])){
echo 'font-family:'.str_replace("|ng","",$theme["slider_soc_f"]).';';
}
if(isset($theme["slider_soc_fs"])){
echo 'font-size:'.$theme["slider_soc_fs"].'px;';
}
if(isset($theme["slider_soc_fw"])){
echo 'font-weight:'.$theme["slider_soc_fw"].';';
}
if(isset($theme["slider_soc_fst"])){
echo 'font-style:'.$theme["slider_soc_fst"].';';
}
if(isset($theme["slider_soc_fc"])){
echo 'color:'.$theme["slider_soc_fc"].';';
}
?>
}

.wpmchimpas .wpmchimpa-social .wpmchimpa-soc{
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
.wpmchimpas .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 7px;
}

.wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb {
background: #2d609b;
<?php if(!isset($wpmchimpa["fb_api"])){
echo 'display:none;';
}?>
}
.wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
content:<?php echo $this->getIcon('fb',25,'#fff');?>
}
.wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp {
background: #eb4026;
<?php if(!isset($wpmchimpa["gp_api"])){
echo 'display:none;';
}?>
}
.wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
content: <?php echo $this->getIcon('gp',25,'#fff');?>
}
.wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms {
background: #00BCF2;
<?php if(!isset($wpmchimpa["ms_api"])){
echo 'display:none;';
}?>
}
.wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
content: <?php echo $this->getIcon('ms',25,'#fff');?>
}
.wpmchimpas .wpmchimpa-signalcont{
  height: 40px;
  width: 40px;
  display: inline-block;
}
.wpmchimpas .wpmchimpa-signal {
text-align: center;
display: none;
}
.wpmchimpas-inner.signalshow .wpmchimpa-signal {
  display: block;
}
.wpmchimpas .wpmchimpa-signalc {
-webkit-animation: animatew 1.5s linear infinite;
-moz-animation: animatew 1.5s linear infinite;
-ms-animation: animatew 1.5s linear infinite;
-o-animation: animatew 1.5s linear infinite;
animation: animatew 1.5s linear infinite;
clip: rect(0, 40px, 40px, 20px); 
height: 40px;
width: 40px;
position: absolute;
display: inline-block;
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
.wpmchimpas .wpmchimpa-signalc:after {
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
display: block;
} 
<?php  if(isset($theme["slider_spinner_c"]))$c=$theme["slider_spinner_c"];else $c="#000";?>
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

.wpmchimpas .wpmchimpa-tag *,
.wpmchimpas .wpmchimpa-tag{
color:#000;
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
        $tfc='#000';
        if(isset($theme["slider_tag_fc"])){$tfc=$theme["slider_tag_fc"];}
        echo $this->getIcon('lock1',$tfs,$tfc);?>;
   margin: 5px;
   top: 1px;
   position:relative;
}
.wpmchimpas .wpmchimpa-feedback{
top: -30px;
position: relative;
font-size: 16px;
height: 16px;
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
  top: 0
}
.wpmchimpas-trig{	
top:40%;
margin: 0 3px;
<?php
if(isset($theme["slider_trigger_top"])){
echo 'top:'.$theme["slider_trigger_top"].'%;';
}
?>
}
.wpmchimpas-trig .wpmchimpas-trigi{ 
background: #0066CB;
width:50px;
height:50px;
-webkit-border-radius:1px;
-moz-border-radius:1px;
border-radius:1px;
<?php
if(isset($theme["slider_trigger_bg"])){
echo 'background:'.$theme["slider_trigger_bg"].';';
}?>
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
.wpmchimpas-trig .wpmchimpas-trigi:hover{
-webkit-box-shadow: inset 3px 2px 21px 5px rgba(0,0,0,0.2);
-moz-box-shadow: inset 3px 2px 21px 5px rgba(0,0,0,0.2);
box-shadow: inset 3px 2px 21px 5px rgba(0,0,0,0.2);
}
.wpmchimpas-trig .wpmchimpas-trigi:before{	
<?php 
$ti='a04';
if(isset($theme["slider_trigger_i"])){
  if($theme["slider_trigger_i"] == 'inone')$ti='';
  else if($theme["slider_trigger_i"] == 'idef')$ti='a04';
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
    <div class="wpmchimpas-inner wpmchimpselector wpmchimpa-mainc">
<?php if(isset($theme['slider_heading'])) echo '<h3>'.$theme['slider_heading'].'</h3>';?>
          <?php if(isset($theme['slider_msg'])) echo '<div class="wpmchimpa_para">'.$theme['slider_msg'].'</div>';?>
  <div class="wpmchimpa-cont">
	    <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
	    <form action="" method="post" class="wpmchimpa-reset">
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
		    <div class="wpmchimpa-signalcont"><div class="wpmchimpa-signal"><div class="wpmchimpa-signalc"></div></div></div>
		</form>
    	<div class="wpmchimpa-feedback" wpmcerr="gen"></div>
    </div>
	</div>	</div></div></div></div>
<div class="wpmchimpas-bg"></div>
<div class="wpmchimpas-overlay"></div>
<div id="wpmchimpas-trig" class="chimpmatecss" <?php if(isset($wpmchimpa['slider_trigger_scroll'])) echo 'class="scrollhide"';?>>
  <div class="wpmchimpas-trigc">
    <div class="wpmchimpas-trigi"></div>
    <div class="wpmchimpas-trigh"></div>
  </div>
</div>