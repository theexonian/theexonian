<?php 
$theme = $wpmchimpa['theme']['a0'];
?>
<style type="text/css">
.wpmchimpat{
	position:fixed;z-index: 99999;
	display: block;
	width: 100%;
	height: 50px;
	background: #000;
top: 0;
left: 0;
  <?php 
        if(isset($theme["addon_bg_c"])){
            echo 'background:'.$theme["addon_bg_c"].';';
        }
    ?>

}
.wpmchimpat.wpmchimpat-close{
visibility: hidden;
}
.wpmchimpat .wpmchimpat-cont{
  display: block;
  margin:0 auto;
  width: 75%;
  padding: 10px;
  text-align: center;
}
.wpmchimpat h3{
  font-size: 18px;
  display: inline-block;
  line-height: 30px;
  color: #fff;
  <?php 
    if(isset($theme["addon_heading_f"])){
      echo 'font-family:'.str_replace("|ng","",$theme["addon_heading_f"]).';';
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


.wpmchimpat  .wpmchimpa-field{
position: relative;
width:<?php echo ((count($fields) > 1)? 21 : 30); ?>%;
margin: 0 10px 10px;
display: inline-block;
}

.wpmchimpat .inputicon{
display: none;
}
.wpmchimpat .wpmc-ficon .inputicon {
display: block;
width: 30px;
height: 30px;
position: absolute;
top: 0;
left: 0;
pointer-events: none;
}
.wpmchimpat .wpmc-ficon input[type="text"],
.wpmchimpat .wpmc-ficon .inputlabel{
  padding-left: 30px;
}
<?php
$col = ((isset($theme["addon_tbox_fc"]))? $theme["addon_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  if($f['icon'] != 'idef' && $f['icon'] != 'inone')
    echo '.wpmchimpat .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$this->getIcon($f['icon'],18,$col).' no-repeat center}';
}
?>

.wpmchimpat .wpmchimpa-field select,
.wpmchimpat input[type="text"]{
    display: inline-block;
    width:100%;
    background:#fff;
    height:30px;
    text-align: center;
    border:2px solid #fff;
    outline:0;
    margin-right: 10px;
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
        if(isset($theme["addon_tbox_bor"]) && isset($theme["addon_tbox_borc"])){
            echo ' border:'.$theme["addon_tbox_bor"].'px solid '.$theme["addon_tbox_borc"].';';
        }
    ?>
}

.wpmchimpat .wpmchimpa-field.wpmchimpa-drop:before{
content: '';
width: 30px;
height: 30px;
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
.wpmchimpat input[type="text"] ~ .inputlabel{
position: absolute;
top: 0;
left: 0;
right: 0;
pointer-events: none;
width: 100%;
line-height: 30px;
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
.wpmchimpat input[type="text"]:valid + .inputlabel{
display: none;
}
.wpmchimpat select.wpmcerror,
.wpmchimpat input[type="text"].wpmcerror{
  border-color: red;
}
.wpmchimpat .wpmcinfierr{
  display: block;
  height: 10px;
  line-height: 10px;
  margin-bottom: -10px;
  font-size: 10px;
  color: red;
  position: absolute;
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
.wpmchimpat .wpmchimpa-subs-button{
display:inline-block;
text-align: center;
width: <?php echo ((count($fields) > 1)? 23 : 33); ?>%;
height:30px;
line-height: 28px;
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
.wpmchimpat .wpmchimpa-subs-button::before{
  content: '<?php if(isset($theme['addon_button'])) echo $theme['addon_button'];else echo 'Subscribe';?>';
   display: block;
  position: relative;
  line-height: 30px;
  <?php if(isset($theme["addon_button_h"])){
      echo 'line-height:'.$theme["addon_button_h"].'px;';
  } ?>
}
.wpmchimpat .wpmchimpa-subs-button:hover{
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
.wpmchimpat .wpmchimpa-subs-button.subsicon:before{
padding-left: 30px;
  <?php 
  if(isset($theme["addon_button_w"])){
      echo 'padding-left:'.$theme["addon_button_h"].'px;';
  }
  ?>
}
.wpmchimpat .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 30px;
width: 30px;
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
     echo 'background: '.$this->getIcon($theme["addon_button_i"],18,$col).' no-repeat center;';
  }
  ?>
}
.wpmchimpat .wpmchimpa-feedback{
position: absolute;
bottom: 0;
color: #fff;
font-size: 10px;
text-align: center;
width: 100%;
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
        if(isset($theme["addon_status_fc"])){
            echo 'color:'.$theme["addon_status_fc"].';';
        }
      ?>
}
.wpmchimpat .wpmchimpa-feedback.wpmchimpa-done{
  line-height: 50px;
  font-size: 20px;
  top:0;
}
.wpmchimpat .wpmchimpat-close-button {
display: inline-block;
width: 2em;
height: 2em;
right: 10px;
top:10px;
position: absolute;
border: 0.1em solid #7e7e7e;
-webkit-border-radius: 50%;
-moz-border-radius: 50%;
-msborder-radius: 50%;
-o-border-radius: 50%;
border-radius: 50%;
cursor:pointer;
background-color: #7e7e7e;
-moz-transform: rotate(45deg); 
-o-transform: rotate(45deg);
-ms-transform: rotate(45deg);
-webkit-transform: rotate(45deg);
transform: rotate(45deg);
transition: all 0.5s ease;
}


.wpmchimpat .wpmchimpat-close-button::before {
    content: "";
    display: block;
    position: absolute;
    background-color: #000;
    width: 80%;
    height: 6%;;
    left: 10%;
    top: 47%;
  }

  .wpmchimpat .wpmchimpat-close-button::after {
    content: "";
    display: block;
    position: absolute;
    background-color: #000;
    width: 6%;
    height: 80%;
    left: 47%;
    top: 10%;
  }
  .wpmchimpat .wpmchimpat-close-button:hover {
    background-color: #fff; 
    -ms-transform: rotate(225deg);
    -webkit-transform: rotate(225deg);
    -moz-transform: rotate(225deg); 
    -o-transform: rotate(225deg); 
    transform: rotate(225deg); 
  } 

.wpmchimpat .wpmchimpat-close-button:hover::after {
      background-color: #7e7e7e;
    }
.wpmchimpat .wpmchimpat-close-button:hover::before {
      background-color: #7e7e7e;
    }
.wpmchimpat.signalshow .wpmchimpa-signal {
  display: block;
}
.wpmchimpat .wpmchimpa-signal {
display: none;
border:3px solid #fff;
-webkit-border-radius:30px;
-moz-border-radius:30px;
-ms-border-radius:30px;
-o-border-radius:30px;
border-radius:30px;
height:20px;
opacity:0;
position:absolute;
width:20px;
top:12px;
right:60px;
 <?php
        if(isset($theme["addon_spinner_c"])){
            echo 'border:3px solid '.$theme["addon_spinner_c"].';';
        }
      ?>
  -webkit-animation: pulsatet 1s ease-out infinite;
  -moz-animation: pulsatet 1s ease-out infinite;
  -ms-animation: pulsatet 1s ease-out infinite; 
  -o-animation: pulsatet 1s ease-out infinite;
  animation: pulsatet 1s ease-out infinite;
  
}
@-webkit-keyframes pulsatet {
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
@-moz-keyframes pulsatet {
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
@-ms-keyframes pulsatet {
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
@-o-keyframes pulsatet {
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
@keyframes pulsatet {
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
@media only screen and (max-width : 1024px) {
.wpmchimpat{
	display: none;
}
}
</style>

<div class="wpmchimpa-reset wpmchimpat wpmchimpselector">
	<form action="" method="post">
  <div class="wpmchimpat-cont">
  <?php if(isset($theme['addon_heading'])) echo '<h3>'.$theme['addon_heading'].'</h3>';?>
<input type="hidden" name="action" value="wpmchimpa_add_email_ajax"/>
<input type="hidden" name="wpmcform" value="<?php echo $form['id'];?>"/>
<?php $set = array(
  'icon' => false,
  'type' => 1
  );
$this->stfield($fields,$set); ?>

  <div class="wpmchimpa-subs-button<?php echo (isset($theme['addon_button_i']) && $theme['addon_button_i'] != 'inone' && $theme['addon_button_i'] != 'idef')? ' subsicon' : '';?>"></div>
    </div>
   <div class="wpmchimpa-signal"></div>
	</form>
	<div class="wpmchimpa-feedback" wpmcerr="gen"></div>
  <div class="wpmchimpat-close-button"></div>
</div>