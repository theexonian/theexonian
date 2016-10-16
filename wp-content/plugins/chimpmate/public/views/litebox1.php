<?php 
$theme = $wpmchimpa['theme']['l1'];
?><style type="text/css">
.wpmchimpa-overlay-bg.wpmchimpselector {
    display: none;
    top: 0;
    left: 0;
    height:100%;
    width: 100%;
    cursor: pointer;
    z-index: 888889;
    background: #000;
    background: rgba(0,0,0,0.40);
    <?php  if(isset($theme["lite_bg_op"])){
          echo 'background:rgba(0,0,0,'.($theme["lite_bg_op"]/100).');';
        }?>
    cursor: default;
    position: fixed!important;
}
.wpmchimpa-overlay-bg #wpmchimpa-main *{
 -webkit-transition: all 0.5s ease;
 transition: all 0.5s ease;
}
.wpmchimpa-overlay-bg .wpmchimpa-mainc{
    height:100%;}
.wpmchimpa-overlay-bg #wpmchimpa-main {
    position: fixed;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
min-width: 700px;
min-height: 350px;
background: #fff;
<?php  if(isset($theme["lite_bg_c"])){
    echo 'background-color:'.$theme["lite_bg_c"].';';
}?>
border-radius: 10px;
}
#wpmchimpa-main .wpmchimpa-leftpane{
width:250px;
position: absolute;
height: 100%;
}
#wpmchimpa-main #wpmchimpa-newsletterform{
display: block;
padding: 0 50px 0 250px;
}
#wpmchimpa-main #wpmchimpa-newsletterform form{
display: inline-block;
}
#wpmchimpa-main #wpmchimpa{
  margin-top: 40px;
}
#wpmchimpa h3{
 -webkit-backface-visibility: hidden;
    line-height: 36px;
    margin-bottom: 20px;
    color: #454545;
    font-size: 36px;
    <?php 
        if(isset($theme["lite_heading_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["lite_heading_f"]).';';
        }
        if(isset($theme["lite_heading_fs"])){
            echo 'font-size:'.$theme["lite_heading_fs"].'px;';
            echo 'line-height:'.$theme["lite_heading_fs"].'px;';
        }
        if(isset($theme["lite_heading_fw"])){
            echo 'font-weight:'.$theme["lite_heading_fw"].';';
        }
        if(isset($theme["lite_heading_fst"])){
            echo 'font-style:'.$theme["lite_heading_fst"].';';
        }
        if(isset($theme["lite_heading_fc"])){
            echo 'color:'.$theme["lite_heading_fc"].';';
        }
    ?>
}
#wpmchimpa .wpmchimpa_para {
    margin-bottom: 10px;
}
#wpmchimpa .wpmchimpa_para ,
#wpmchimpa .wpmchimpa_para *{
 -webkit-backface-visibility: hidden;
<?php if(isset($theme["lite_msg_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["lite_msg_f"]).';';
}if(isset($theme["lite_msg_fs"])){
    echo 'font-size:'.$theme["lite_msg_fs"].'px;';
}?>
}

#wpmchimpa  .wpmchimpa-field{
position: relative;
width:100%;
margin: 0 auto 18px auto;
}
#wpmchimpa .inputicon{
display: none;
}
#wpmchimpa .wpmc-ficon .inputicon {
display: block;
width: 62px;
height: 62px;
position: absolute;
top: 0;
left: 0;
pointer-events: none;
<?php 
if(isset($theme["lite_tbox_h"])){
  echo 'width:'.$theme["lite_tbox_h"].'px;';
  echo 'height:'.$theme["lite_tbox_h"].'px;';
}
?>
}
#wpmchimpa .wpmchimpa-field.wpmc-ficon input[type="text"],
#wpmchimpa .wpmchimpa-field.wpmc-ficon .inputlabel{
  padding-left: 62px;
  <?php 
if(isset($theme["lite_tbox_h"])){
  echo 'padding-left:'.$theme["lite_tbox_h"].'px;';
  }?>
}
<?php
$col = ((isset($theme["lite_tbox_fc"]))? $theme["lite_tbox_fc"] : '#888');
foreach ($form['fields'] as $f) {
  if($f['icon'] != 'idef' && $f['icon'] != 'inone')
    echo '#wpmchimpa .wpmc-ficon [wpmcfield="'.$f['tag'].'"] ~ .inputicon {background: '.$this->getIcon($f['icon'],25,$col).' no-repeat center}';
}
?>
#wpmchimpa .wpmchimpa-field select,
#wpmchimpa input[type="text"]{
    width: 100%;
    height: 62px;
    background: #f8fafa;
    padding: 0 20px;
    border-radius: 5px;
    border: 1px solid #e4e9e9;
    color: #353535;
    font-size: 16px;
    outline:0;
    display: block;
    <?php 
        if(isset($theme["lite_tbox_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["lite_tbox_f"]).';';
        }
        if(isset($theme["lite_tbox_fs"])){
            echo 'font-size:'.$theme["lite_tbox_fs"].'px;';
        }
        if(isset($theme["lite_tbox_fw"])){
            echo 'font-weight:'.$theme["lite_tbox_fw"].';';
        }
        if(isset($theme["lite_tbox_fst"])){
            echo 'font-style:'.$theme["lite_tbox_fst"].';';
        }
        if(isset($theme["lite_tbox_fc"])){
            echo 'color:'.$theme["lite_tbox_fc"].';';
        }
        if(isset($theme["lite_tbox_bgc"])){
            echo 'background:'.$theme["lite_tbox_bgc"].';';
        }
        if(isset($theme["lite_tbox_w"])){
            echo 'width:'.$theme["lite_tbox_w"].'px;';
        }
        if(isset($theme["lite_tbox_h"])){
            echo 'height:'.$theme["lite_tbox_h"].'px;';
        }
        if(isset($theme["lite_tbox_bor"]) && isset($theme["lite_tbox_borc"])){
            echo ' border:'.$theme["lite_tbox_bor"].'px solid '.$theme["lite_tbox_borc"].';';
        }
    ?>
}

#wpmchimpa .wpmchimpa-field.wpmchimpa-drop:before{
content: '';
width: 62px;
height: 62px;
position: absolute;
right: 0;
top: 0;
pointer-events: none;
background: no-repeat center;
background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJ1BMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADdEvm1AAAADHRSTlMAEDBAYJC/wN/g7/BpIqb+AAAASUlEQVQI12NgYGBgDWCAAJ8jEJppzSkFMEPizJlGMKPmzJljIJr1DBCAlNuAGIcZsAG4FFwxSPtxsJzkmTMTIVbsOa2AainEGQDXCB+cPGdC9gAAAABJRU5ErkJggg==);
<?php 
if(isset($theme["lite_tbox_h"])){
  echo 'width:'.$theme["lite_tbox_h"].'px;';
  echo 'height:'.$theme["lite_tbox_h"].'px;';
}
?>
}
#wpmchimpa input[type="text"] ~ .inputlabel{
position: absolute;
top: 0;
left: 0;
right: 0;
pointer-events: none;
width: 100%;
line-height: 62px;
color: rgba(0,0,0,0.6);
font-size: 16px;
font-weight:500;
padding: 0 20px;
white-space: nowrap;
<?php 
if(isset($theme["lite_tbox_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["lite_tbox_f"]).';';
}
if(isset($theme["lite_tbox_fs"])){
    echo 'font-size:'.$theme["lite_tbox_fs"].'px;';
}
if(isset($theme["lite_tbox_fw"])){
    echo 'font-weight:'.$theme["lite_tbox_fw"].';';
}
if(isset($theme["lite_tbox_fst"])){
    echo 'font-style:'.$theme["lite_tbox_fst"].';';
}
if(isset($theme["lite_tbox_fc"])){
    echo 'color:'.$theme["lite_tbox_fc"].';';
}
?>
}
#wpmchimpa input[type="text"]:valid + .inputlabel{
display: none;
}
#wpmchimpa select.wpmcerror,
#wpmchimpa input[type="text"].wpmcerror{
  border-color: red;
}
#wpmchimpa .wpmchimpa-check *,
#wpmchimpa .wpmchimpa-radio *{
<?php
if(isset($theme["lite_check_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["lite_check_f"]).';';
}
if(isset($theme["lite_check_fs"])){
    echo 'font-size:'.$theme["lite_check_fs"].'px;';
}
if(isset($theme["lite_check_fw"])){
    echo 'font-weight:'.$theme["lite_check_fw"].';';
}
if(isset($theme["lite_check_fst"])){
    echo 'font-style:'.$theme["lite_check_fst"].';';
}
if(isset($theme["lite_check_fc"])){
    echo 'color:'.$theme["lite_check_fc"].';';
}
?>
}
#wpmchimpa .wpmchimpa-item input {
  display: none;
}
#wpmchimpa .wpmchimpa-item span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  padding-left: 35px;
  line-height: 29px;
  margin-right: 10px;
}

#wpmchimpa .wpmchimpa-item span:before,
#wpmchimpa .wpmchimpa-item span:after {
  content: '';
  display: inline-block;
  width: 18px;
  height: 18px;
  left: 0;
  top: 5px;
  position: absolute;
}
#wpmchimpa .wpmchimpa-item span:before {
box-shadow: 0 0 1px 1px #ccc;
background-color: #fafafa;
transition: all 0.3s ease-in-out;
border-radius: 3px;
<?php
  if(isset($theme["lite_check_borc"])){
      echo 'border: 1px solid'.$theme["lite_check_borc"].';';
  }
?>
}
#wpmchimpa .wpmchimpa-item input[type='checkbox'] + span:before {
border-radius: 3px;
}
#wpmchimpa .wpmchimpa-item input:checked + span:before{
  <?php if(isset($theme["lite_check_c"]))echo 'background: '.$theme["lite_check_c"].';';?>
}
#wpmchimpa .wpmchimpa-item input[type='checkbox'] + span:hover:after, #wpmchimpa input[type='checkbox']:checked + span:after {
  content:'';
  background: no-repeat center;
  <?php if(isset($theme['lite_check_shade']))$chs=$theme['lite_check_shade'];else $chs='1';
  echo 'background-image: '.$this->chshade($chs).';';?>
  left: -1px;
  bottom: -1px;
}
#wpmchimpa .wpmchimpa-item input[type='radio'] + span:before {
border-radius: 50%;
width: 16px;
height: 16px;
top: 5px;
}
#wpmchimpa input[type='radio']:checked + span:after {
background: <?php echo ($chs == 1)?'#7C7C7C':'#fafafa';?>;
width: 12px;
height: 12px;
top: 7px;
left: 2px;
border-radius: 50%;
}
#wpmchimpa .wpmcinfierr{
  display: block;
  height: 18px;
  line-height: 18px;
  margin-bottom: -18px;
  font-size: 11px;
  color: red;
  <?php
    if(isset($theme["lite_status_f"])){
      echo 'font-family:'.str_replace("|ng","",$theme["lite_status_f"]).';';
    }
    if(isset($theme["lite_status_fw"])){
        echo 'font-weight:'.$theme["lite_status_fw"].';';
    }
    if(isset($theme["lite_status_fst"])){
        echo 'font-style:'.$theme["lite_status_fst"].';';
    }
  ?>
}

#wpmchimpa .wpmchimpa-subs-button{
    border-radius: 3px;
    width: 380px;
    color: #fff;
    font-size: 28px;
    border: 1px solid #3079ed;
   background-color: #4d90fe;
   height: 56px;
line-height: 56px;
    text-align: center;
    cursor: pointer;
    margin-bottom: 20px;
     <?php
        if(isset($theme["lite_button_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["lite_button_f"]).';';
        }
        if(isset($theme["lite_button_fs"])){
            echo 'font-size:'.$theme["lite_button_fs"].'px;';
        }
        if(isset($theme["lite_button_fw"])){
            echo 'font-weight:'.$theme["lite_button_fw"].';';
        }
        if(isset($theme["lite_button_fst"])){
            echo 'font-style:'.$theme["lite_button_fst"].';';
        }
        if(isset($theme["lite_button_fc"])){
            echo 'color:'.$theme["lite_button_fc"].';';
        }
        if(isset($theme["lite_button_w"])){
            echo 'width:'.$theme["lite_button_w"].'px;';
        }
        if(isset($theme["lite_button_h"])){
            echo 'height:'.$theme["lite_button_h"].'px;';
        }
        if(isset($theme["lite_button_bc"])){
            echo 'background-color:'.$theme["lite_button_bc"].';';
        }
        else{ ?>
  background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
  <?php }
        if(isset($theme["lite_button_br"])){
            echo 'border-radius:'.$theme["lite_button_br"].'px;';
        }
        if(isset($theme["lite_button_bor"]) && isset($theme["lite_button_borc"])){
            echo ' border:'.$theme["lite_button_bor"].'px solid '.$theme["lite_button_borc"].';';
        }
      ?>
}
#wpmchimpa .wpmchimpa-subs-button::before{
content: '<?php if(isset($theme['lite_button'])) echo $theme['lite_button'];else echo 'Subscribe';?>';
<?php if(isset($theme["lite_button_h"])){
      echo 'line-height:'.$theme["lite_button_h"].'px;';
  } ?>
}
#wpmchimpa .wpmchimpa-subs-button:hover{
<?php if(isset($theme["lite_button_fch"])){
        echo 'color:'.$theme["lite_button_fch"].';';
    }    
    if(isset($theme["lite_button_bch"])){
        echo 'background-color:'.$theme["lite_button_bch"].';';
    } else{ ?>
  background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
  <?php }?>
}

#wpmchimpa .wpmchimpa-subs-button.subsicon:before{
padding-left: 56px;
  <?php 
  if(isset($theme["lite_button_w"])){
      echo 'padding-left:'.$theme["lite_button_h"].'px;';
  }
  ?>
}
#wpmchimpa .wpmchimpa-subs-button.subsicon::after{
content:'';
position: absolute;
height: 56px;
width: 56px;
top: 0;
left: 0;
pointer-events: none;
  <?php 
  if(isset($theme["lite_button_h"])){
      echo 'width:'.$theme["lite_button_h"].'px;';
      echo 'height:'.$theme["lite_button_h"].'px;';
  }
  if($theme["lite_button_i"] != 'inone' && $theme["lite_button_i"] != 'idef'){
    $col = ((isset($theme["lite_button_fc"]))? $theme["lite_button_fc"] : '#fff');
     echo 'background: '.$this->getIcon($theme["lite_button_i"],25,$col).' no-repeat center;';
  }
  ?>
}
#wpmchimpa-main .wpmchimpa-close-button{
    position: absolute;
   display: block;
top: 0;
right: 0;
margin: 10px 20px;
cursor: pointer;
}
#wpmchimpa-main .wpmchimpa-close-button::before{
    content: "\00D7";
    font-size: 30px;
    font-weight: 600;
    color: #959595;
    <?php if(isset($theme["lite_close_col"])){
            echo 'color:'.$theme["lite_close_col"].';';
        }
      ?>
}
#wpmchimpa-main .wpmchimpa-close-button:hover:before{
    color: #000;
}

#wpmchimpa-main .wpmchimpa-imgcont{
    -webkit-border-radius: 50%;
    -moz-box-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
background: #3079ed;
height: 230px;
width: 230px;
margin: -50px 0px 0 -50px;
border: 20px solid #fff;
display: block;
-webkit-box-sizing: content-box;
-moz-box-sizing: content-box;
box-sizing: content-box;
<?php  if(isset($theme["lite_head_col"])){
    echo 'background:'.$theme["lite_head_col"].';';
}
if(isset($theme["lite_head_col"]))$c= $theme["lite_hshad_col"];
else $c='#979797';
echo '-webkit-box-shadow: 0 3px 15px 2px '.$c.';
-moz-box-shadow: 0 3px 15px 2px '.$c.';
-ms-box-shadow: 0 3px 15px 2px '.$c.';
-o-box-shadow: 0 3px 15px 2px '.$c.';
box-shadow: 0 3px 15px 2px '.$c.';';
?>
}
#wpmchimpa-main .wpmchimpa-imgcont::before{
   content: "";
background: #4d90fe;
border: 15px solid #fff;
height: 170px;
width: 170px;
display: block;
-webkit-border-radius: 50%;
-moz-box-border-radius: 50%;
-ms-border-radius: 50%;
-o-border-radius: 50%;
border-radius: 50%;
top: 15px;
left: 15px;
position: relative;
-webkit-box-sizing: content-box;
-moz-box-sizing: content-box;
box-sizing: content-box;
background-image:<?php if(isset($theme['lite_img1']))echo 'url('.$theme['lite_img1'].');';else{?>
 url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSIxMjBweCIgaGVpZ2h0PSIxMjBweCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyMCAxMjAiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIG9wYWNpdHk9IjAuMiIgZmlsbD0iIzAyMDIwMiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMTkuNiw5Mi45YzAsNC40LTMuNiw3LjktOCw3LjloLTEwMWMtNC40LDAtOC0zLjUtOC03LjlWMjQuMmMwLTQuNCwzLjYtNy45LDgtNy45aDEwMWM0LjQsMCw4LDMuNSw4LDcuOVY5Mi45eiIvPjxwYXRoIGZpbGw9IiNDNjMyM0QiIGQ9Ik0xLjgsMjljLTAuMywwLjgtMC40LDEuOC0wLjQsMi43djU4LjljMCw1LjEsNC4xLDkuMiw5LjIsOS4yaDk5YzUuMSwwLDkuMi00LjEsOS4yLTkuMlYzMS43YzAtMC45LTAuMi0xLjgtMC40LTIuN0gxLjh6Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8xXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyNDIuMTYxNCIgeTE9Ii0yOTcuMDQyIiB4Mj0iMzU1LjE3MzgiIHkyPSItMjk3LjA0MiIgZ3JhZGllbnRUcmFuc2Zvcm09Im1hdHJpeCgxIDAgMCAtMSAtMjM3LjYgLTIzOC44NCkiPjxzdG9wICBvZmZzZXQ9IjAiIHN0eWxlPSJzdG9wLWNvbG9yOiNGRkZGRkY7c3RvcC1vcGFjaXR5OjAiLz48c3RvcCAgb2Zmc2V0PSIwLjE0MzQiIHN0eWxlPSJzdG9wLWNvbG9yOiNENEQ0RDQ7c3RvcC1vcGFjaXR5OjAuMTI5MSIvPjxzdG9wICBvZmZzZXQ9IjAuNDYiIHN0eWxlPSJzdG9wLWNvbG9yOiM3QTdBN0E7c3RvcC1vcGFjaXR5OjAuNDE0Ii8+PHN0b3AgIG9mZnNldD0iMC43MTgiIHN0eWxlPSJzdG9wLWNvbG9yOiMzODM4Mzg7c3RvcC1vcGFjaXR5OjAuNjQ2MiIvPjxzdG9wICBvZmZzZXQ9IjAuOTA0MiIgc3R5bGU9InN0b3AtY29sb3I6IzEwMTAxMDtzdG9wLW9wYWNpdHk6MC44MTM4Ii8+PHN0b3AgIG9mZnNldD0iMSIgc3R5bGU9InN0b3AtY29sb3I6IzAwMDAwMDtzdG9wLW9wYWNpdHk6MC45Ii8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBvcGFjaXR5PSI2LjAwMDAwMGUtMDAyIiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMTIuNiw5NC40TDkuNCwyMy40Yy0xLjktMS4zLTMuMy0yLjktNC4yLTQuOGMtMC40LDEuMS0wLjcsMi4zLTAuNywzLjV2NjYuNWMwLDUuMSw0LjEsOS4yLDkuMiw5LjJoOTljMS44LDAsMy40LTAuNSw0LjgtMS40QzExNS45LDk2LjEsMTE0LjEsOTUuNSwxMTIuNiw5NC40eiIvPjxwYXRoIGZpbGw9IiNENkQ2RDYiIGQ9Ik0xMC44LDk2LjNsMTAzLjItNzFjMS45LTEuMywzLjMtMi45LDQuMi00LjhjMC40LDEuMSwwLjcsMi4zLDAuNywzLjV2NjYuNWMwLDUuMS00LjEsOS4yLTkuMiw5LjJoLTk5Yy0xLjgsMC0zLjQtMC41LTQuOC0xLjRDNy41LDk4LjEsOS4zLDk3LjMsMTAuOCw5Ni4zeiIvPjxwYXRoIGZpbGw9IiNFRkVGRUYiIGQ9Ik0xMDguOSw5Ni43TDUuNywyNS43Yy0xLjktMS4zLTMuMy0yLjktNC4yLTQuOGMtMC40LDEuMS0wLjcsMi4zLTAuNywzLjV2NjYuNWMwLDUuMSw0LjEsOS4yLDkuMiw5LjJoOTljMS44LDAsMy40LTAuNSw0LjgtMS40QzExMi4xLDk4LjUsMTEwLjQsOTcuNywxMDguOSw5Ni43eiIvPjxwYXRoIG9wYWNpdHk9IjAuOCIgZmlsbD0iI0U1RTVFNSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMDguOSw5Ni43TDU5LjYsNjIuN0wxMC4zLDk2LjdjLTEuNSwxLjEtMy4zLDEuOC00LjksMi4xYzEuNCwwLjgsMywxLjQsNC44LDEuNGg0My43aDU1LjJjMS44LDAsMy40LTAuNSw0LjgtMS40QzExMi4xLDk4LjUsMTEwLjQsOTcuNywxMDguOSw5Ni43eiIvPjxwYXRoIG9wYWNpdHk9IjAuMSIgZmlsbD0iIzAyMDIwMiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMTguNywyNS4zYzAtMC42LTAuMS0xLjEtMC4yLTEuNmMwLjMtMC4xLDAuNy0wLjIsMS0wLjNjLTAuNC0wLjItMC44LTAuNC0xLjItMC43Yy0xLjEtMy44LTQuNi02LjUtOC43LTYuNUgxMS4yYy00LjMsMC03LjksMi45LTguOCw2LjljLTAuMiwwLjEtMC40LDAuMi0wLjYsMC4zYzAuMiwwLjEsMC4zLDAuMSwwLjQsMC4xYy0wLjEsMC42LTAuMiwxLjItMC4yLDEuN2MwLDAsMC4yLTAuNCwwLjctMS41YzAuOSwxLjgsMi4zLDMuNCw0LjEsNC42bDUzLjUsMzYuNGw1My41LTM2LjNjMS44LTEuMiwzLjItMi45LDQuMS00LjZoMC4xQzExOC41LDI0LjksMTE4LjcsMjUuMywxMTguNywyNS4zeiIvPjxwYXRoIGZpbGw9IiNFOEU4RTgiIGQ9Ik0xMDkuNiwxNC42SDEwLjNjLTUuMSwwLTkuMiw0LjEtOS4yLDkuMmMwLDAsMC4yLTAuNCwwLjctMS41QzIuNywyNC4xLDQuMSwyNS43LDYsMjdsNTMuOSwzNy4ybDU0LTM3LjFjMS45LTEuMywzLjMtMi45LDQuMi00LjhjMC40LDEuMSwwLjcsMS41LDAuNywxLjVDMTE4LjcsMTguOCwxMTQuNiwxNC42LDEwOS42LDE0LjZ6Ii8+PC9nPjwvc3ZnPg==);<?php } ?>
background-repeat: no-repeat;
background-position: center; 
<?php  if(isset($theme["lite_head_col"])){
    echo 'background-color:'.$theme["lite_head_col"].';';
}?>
}

#wpmchimpa-main .wpmchimpa-social{
display: block;
bottom: 0;
text-align: center;
position: absolute;
padding: 20px 50px;
}
#wpmchimpa-main .wpmchimpa-social::before{
content: '<?php if(isset($theme['lite_soc_head'])) echo $theme['lite_soc_head'];else echo 'Subscribe with';?>';
font-size: 20px;
line-height: 30px;
display: block;
     <?php
        if(isset($theme["lite_soc_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["lite_soc_f"]).';';
        }
        if(isset($theme["lite_soc_fs"])){
            echo 'font-size:'.$theme["lite_soc_fs"].'px;';
        }
        if(isset($theme["lite_soc_fw"])){
            echo 'font-weight:'.$theme["lite_soc_fw"].';';
        }
        if(isset($theme["lite_soc_fst"])){
            echo 'font-style:'.$theme["lite_soc_fst"].';';
        }
        if(isset($theme["lite_soc_fc"])){
            echo 'color:'.$theme["lite_soc_fc"].';';
        }
      ?>
}

#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc{
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
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 7px;
}

#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb {
    background: #2d609b;
    <?php if(!isset($wpmchimpa["fb_api"])){
	echo 'display:none;';
    }?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
   content:<?php echo $this->getIcon('fb',25,'#fff');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp {
    background: #eb4026;
    <?php if(!isset($wpmchimpa["gp_api"])){
	echo 'display:none;';
    }?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
    content: <?php echo $this->getIcon('gp',25,'#fff');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms {
    background: #00BCF2;
    <?php if(!isset($wpmchimpa["ms_api"])){
	echo 'display:none;';
    }?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
    content: <?php echo $this->getIcon('ms',25,'#fff');?>
}


#wpmchimpa-main.woleft{
  min-width: inherit;
}
#wpmchimpa-main.woleft .wpmchimpa-leftpane{
  display: none;
}
#wpmchimpa-main.woleft #wpmchimpa-newsletterform{
  padding-left: 50px;
}

#wpmchimpa-main.limgonly .wpmchimpa-social{
  display: none;
}

#wpmchimpa-main.lsoconly .wpmchimpa-imgcont{
  display: none;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social{
top: 50%;
-webkit-transform: translatey(-50% );
-moz-transform: translatey(-50% );
-ms-transform: translatey(-50% );
-o-transform: translatey(-50% );
transform: translatey(-50% );
text-align: left;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc {
width:140px;
height: 35px;
margin-bottom: 5px;
border-radius: 5px;
float: none;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc::before{
padding: 0px 5px;
display: inline-block;
border-right: 1px solid #cccccc;
height: 23px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc::after{
position: absolute;
line-height: 35px;
padding-left: 10px;
color: #fff;
font-size: 14px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::after {
    content:"Facebook";
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::after {
    content:"Google Plus";
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::after {
    content:"Outlook";
}
#wpmchimpa-main .wpmchimpa-signalc{
  height: 40px;
  width: 40px;
}
.wpmchimpa-overlay-bg.signalshow #wpmchimpa .wpmchimpa-signal {
  display: block;
}
#wpmchimpa-main .wpmchimpa-signal {
  -webkit-animation: animate 1.5s linear infinite;
  -moz-animation: animate 1.5s linear infinite;
  -ms-animation: animate 1.5s linear infinite;
  -o-animation: animate 1.5s linear infinite;
  animation: animate 1.5s linear infinite;
  clip: rect(0, 40px, 40px, 20px); 
  height: 40px;
  width: 40px;
  position: absolute;
 display: none;
left: calc(80px + 50%);
}
@-webkit-keyframes animate {
  0% { 
    -webkit-transform: rotate(0deg)
  }
  100% { 
    -webkit-transform: rotate(220deg)
  }
}
@-moz-keyframes animate {
  0% { 
    -moz-transform: rotate(0deg)
  }
  100% { 
    -moz-transform: rotate(220deg)
  }
}
@-ms-keyframes animate {
  0% { 
    -ms-transform: rotate(0deg)
  }
  100% { 
    -ms-transform: rotate(220deg)
  }
}
@-o-keyframes animate {
  0% { 
    -o-transform: rotate(0deg)
  }
  100% { 
    -o-transform: rotate(220deg)
  }
}
@keyframes animate {
  0% { 
    transform: rotate(0deg)
  }
  100% { 
    transform: rotate(220deg)
  }
}
#wpmchimpa-main .wpmchimpa-signal:after {
  -webkit-animation: animate2 1.5s ease-in-out infinite;
  -moz-animation: animate2 1.5s ease-in-out infinite;
  -ms-animation: animate2 1.5s ease-in-out infinite;
  -o-animation: animate2 1.5s ease-in-out infinite;
  animation: animate2 1.5s ease-in-out infinite;
  
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
<?php  if(isset($theme["lite_spinner_c"]))$c=$theme["lite_spinner_c"];else $c="#000";?>
@-webkit-keyframes animate2 {
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
@-moz-keyframes animate2 {
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
@-ms-keyframes animate2 {
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
@-o-keyframes animate2 {
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
@keyframes animate2 {
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

#wpmchimpa-main .wpmchimpa-feedback{
top: -30px;
text-align: center;
position: relative;
font-size: 18px;
height: 18px;
<?php
if(isset($theme["lite_status_f"])){
  echo 'font-family:'.str_replace("|ng","",$theme["lite_status_f"]).';';
}
if(isset($theme["lite_status_fs"])){
    echo 'font-size:'.$theme["lite_status_fs"].'px;';
    echo 'height:'.$theme["lite_status_fs"].'px;';
}
if(isset($theme["lite_status_fw"])){
    echo 'font-weight:'.$theme["lite_status_fw"].';';
}
if(isset($theme["lite_status_fst"])){
    echo 'font-style:'.$theme["lite_status_fst"].';';
}
if(isset($theme["lite_status_fc"])){
    echo 'color:'.$theme["lite_status_fc"].';';
}
?>
}

#wpmchimpa-main .wpmchimpa-feedback.wpmchimpa-done{
top: 20px;
}
.wpmchimpa-overlay-bg .wpmchimpa-tag,
.wpmchimpa-overlay-bg .wpmchimpa-tag *{
color:#000;
font-size: 10px;
top: -15px;
text-align: center;
position: relative;
<?php
        if(isset($theme["lite_tag_f"])){
          echo 'font-family:'.str_replace("|ng","",$theme["lite_tag_f"]).';';
        }
        if(isset($theme["lite_tag_fs"])){
            echo 'font-size:'.$theme["lite_tag_fs"].'px;';
        }
        if(isset($theme["lite_tag_fw"])){
            echo 'font-weight:'.$theme["lite_tag_fw"].';';
        }
        if(isset($theme["lite_tag_fst"])){
            echo 'font-style:'.$theme["lite_tag_fst"].';';
        }
        if(isset($theme["lite_tag_fc"])){
            echo 'color:'.$theme["lite_tag_fc"].';';
        }
      ?>
}
#wpmchimpa-main .wpmchimpa-tag:before{

   content:<?php
        $tfs=10;
        if(isset($theme["lite_tag_fs"])){$tfs=$theme["lite_tag_fs"];}
        $tfc='#000';
        if(isset($theme["lite_tag_fc"])){$tfc=$theme["lite_tag_fc"];}
        echo $this->getIcon('lock1',$tfs,$tfc);?>;
   margin: 5px;
   top: 1px;
   position:relative;
}
@media only screen 
and (max-width : 1024px) {
.wpmchimpa-overlay-bg #wpmchimpa-main{
  -webkit-transform:scale(0.8) translate(-50%, -50%);
  -moz-transform:scale(0.8) translate(-50%, -50%);
  -ms-transform:scale(0.8) translate(-50%, -50%);
  -o-transform:scale(0.8) translate(-50%, -50%);
  transform:scale(0.8) translate(-50%, -50%);
  -webkit-transform-origin:top left;
  -moz-transform-origin:top left;
  -ms-transform-origin:top left;
  -o-transform-origin:top left;
  transform-origin:top left;
  display: block;
}
}
@media only screen 
and (max-width : 768px)
and (orientation : portrait) {
.wpmchimpa-overlay-bg #wpmchimpa-main{
width: 100%;
min-width: inherit;
}
#wpmchimpa-main .wpmchimpa-leftpane{
position: relative;
text-align: center;
height: 320px;
width: 100%;
}
#wpmchimpa-main .wpmchimpa-imgcont{
margin: -80px auto;
-webkit-transform: scale(0.8);
-moz-transform: scale(0.8);
-ms-transform: scale(0.8);
-o-transform: scale(0.8);
transform: scale(0.8);
}
#wpmchimpa-main .wpmchimpa-imgcont:after{
position: absolute;
top: 0;
margin: 55px;
left: inherit;
}
#wpmchimpa-main #wpmchimpa-newsletterform{
padding: 20px;
}
#wpmchimpa-main #wpmchimpa-newsletterform form{
  width: 100%;
}
#wpmchimpa-main .wpmchimpa-social{
  position: relative;
  display: inline-block;
  padding: 0;
  margin-top: 75px;
}
#wpmchimpa h3{
  margin-top: 10px;
}
#wpmchimpa .wpmchimpa-subs-button{
width: 100%;
}
#wpmchimpa h3,#wpmchimpa p{
  text-align: center;
}
#wpmchimpa .wpmchimpa-groups{
  display: inline-block;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc{
width: 40px;
height: 40px;
border-radius: 50%;
float: left;
margin: 5px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc::before{
  padding: 0;
  border: 0;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::after,
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::after,
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::after {
    content:none;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social{
  top:0;
  -webkit-transform:none;
  -moz-transform:none;
  -ms-transform:none;
  -o-transform:none;
  transform:none;
  margin-top: 25px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-leftpane{
height: 100px;
}
#wpmchimpa-main.limgonly .wpmchimpa-leftpane{
height: 250px;
}
#wpmchimpa .wpmchimpa-item input[type='checkbox'] + label{
  text-align: left;
}
}
@media only screen 
and (max-width : 768px)
and (orientation : landscape) {
.wpmchimpa-overlay-bg #wpmchimpa-main{
  -webkit-transform:scale(0.5) translate(-50%, -50%);
  -moz-transform:scale(0.5) translate(-50%, -50%);
  -ms-transform:scale(0.5) translate(-50%, -50%);
  -o-transform:scale(0.5) translate(-50%, -50%);
  transform:scale(0.5) translate(-50%, -50%); 
  -webkit-transform-origin:top left;
  -moz-transform-origin:top left;
  -ms-transform-origin:top left;
  -o-transform-origin:top left;
  transform-origin:top left;
}
}
@media only screen 
only screen and (-webkit-min-device-pixel-ratio : 1.5),
only screen and (min-device-pixel-ratio : 1.5) {
.wpmchimpa-overlay-bg #wpmchimpa-main{
  -webkit-transform:scale(0.25) translate(-50%, -50%);
  -webkit-transform-origin:top left;
}
}
@media only screen 
and (max-width : 480px)
and (orientation : portrait) {
.wpmchimpa-overlay-bg #wpmchimpa-main{
  -webkit-transform:scale(0.5) translate(-50%, -50%);
  -moz-transform:scale(0.5) translate(-50%, -50%);
  -ms-transform:scale(0.5) translate(-50%, -50%);
  -o-transform:scale(0.5) translate(-50%, -50%);
  transform:scale(0.5) translate(-50%, -50%);
  width: 480px;
}
#wpmchimpa input[type="text"]{
  height: 54px;
}
#wpmchimpa h3{
  margin-bottom: 10px;
}
}
@media only screen 
and (max-device-width : 480px)
and (orientation : landscape) {
.wpmchimpa-overlay-bg #wpmchimpa-main{
  -webkit-transform:scale(0.25) translate(-50%, -50%);
  -moz-transform:scale(0.25) translate(-50%, -50%);
  -ms-transform:scale(0.25) translate(-50%, -50%);
  -o-transform:scale(0.25) translate(-50%, -50%);
  transform:scale(0.25) translate(-50%, -50%);
}
}
</style>

<div class="wpmchimpa-reset wpmchimpa-overlay-bg wpmchimpselector">
	<div class="wpmchimpa-mainc">
  <div id="wpmchimpa-main" class="
	<?php if(isset($theme['lite_dislogo']) && isset($theme['lite_dissoc']))echo 'woleft';
	else if(isset($theme['lite_dislogo'])) echo 'lsoconly';
	else if(isset($theme['lite_dissoc'])) echo 'limgonly';	?>">
        <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-imgcont"></div>
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
		<div id="wpmchimpa-newsletterform">
			<div class="wpmchimpa" id="wpmchimpa">
    			<?php if(isset($theme['lite_heading'])) echo '<h3>'.$theme['lite_heading'].'</h3>';?>
			    <?php if(isset($theme['lite_msg'])) echo '<div class="wpmchimpa_para">'.$theme['lite_msg'].'</div>';?>
    			<form action="" method="post"> 
<input type="hidden" name="action" value="wpmchimpa_add_email_ajax"/>
<input type="hidden" name="wpmcform" value="<?php echo $form['id'];?>"/>
<?php $set = array(
'icon' => false,
'type' => 1
);
$this->stfield($form['fields'],$set); ?>
        			<div class="wpmchimpa-subs-button<?php echo (isset($theme['lite_button_i']) && $theme['lite_button_i'] != 'inone' && $theme['lite_button_i'] != 'idef')? ' subsicon' : '';?>"></div>
                        <?php if(isset($theme['lite_tag_en'])){
                          if(isset($theme['lite_tag'])) $tagtxt= $theme['lite_tag'];
                          else $tagtxt='Secure and Spam free...';
                          echo '<div class="wpmchimpa-tag">'.$tagtxt.'</div>';
                          }?>
    				<div class="wpmchimpa-signalc"><div class="wpmchimpa-signal"></div></div>
        		</form>
    			<div class="wpmchimpa-feedback" wpmcerr="gen"></div>
			</div>
		</div>
        <div class="wpmchimpa-close-button"></div>
	</div>
  </div>
</div>
