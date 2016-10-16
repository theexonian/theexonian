<style type="text/css">
html {
    height: 0;
    position: relative;
    <?php if(is_admin_bar_showing())echo 'top: -32px;'?>
}
body {
min-height: 100%;
height: auto !important;
overflow-x: hidden !important;
z-index: -1;
<?php if(is_admin_bar_showing())echo 'padding-top: 32px;';
if (!(isset($_SERVER['HTTP_USER_AGENT']) && ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false))))
    echo 'position:relative;';?>
}body:before {display: none;}
#wpmchimpas {
visibility: hidden;
position: fixed;
-webkit-backface-visibility: hidden;
top: 0;
z-index: -1;
height: 100%;
width: 500px;
-webkit-box-shadow: inset 0 0 5px 5px #222;
-moz-box-shadow: inset 0 0 5px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            5px #222;
box-shadow: inset 0 0 5px 5px #222;
overflow-x: hidden;
overflow-y: hidden;
-webkit-transition-property: -webkit-transform;
-moz-transition-property: -moz-transform;
-ms-transition-property: -ms-transform;
-o-transition-property: -o-transform;
transition-property: transform;
}
.wpmchimpas-bg{
position: absolute;
z-index: -1;
top: 0;
left: 0;
right: 0;
bottom: 0;
min-width: 100%;
min-height: 100%;
overflow: hidden;
}
.wpmchimpas-cont{
width:560px;
position: relative;
overflow-y:scroll;
overflow-x: hidden;
height: 100%;
}
#wpmchimpas-trig,
#wpmchimpas-trig.wpmchimpas-trig.scrollhide,
#wpmchimpas-trig.wpmchimpas-trig.condhide,
body.body-wpmchimpas-open #wpmchimpas-trig .wpmchimpas-trigh{
display: none;
}
.body-wpmchimpas-open #wpmchimpas-trig.wpmchimpas-trig.condhide,
body.body-wpmchimpas-open #wpmchimpas-trig.wpmchimpas-trig.scrollhide{
display: block;
}
#wpmchimpas-trig.wpmchimpas-trig{
display: block;
z-index: 888888;
position:fixed;
}
#wpmchimpas-trig.wpmchimpas-trig .wpmchimpas-trigi,#wpmchimpas-trig.wpmchimpas-trig .wpmchimpas-trigh:before {
cursor:pointer;
}
.wpmchimpas-trig.right,.wpmchimpas.right,.wpmchimpas.right .wpmchimpas-cont,.wpmchimpas-trig.left .wpmchimpas-trigh:before{
left: auto;
right: 0px;
}
.wpmchimpas-trig.left,.wpmchimpas.left,.wpmchimpas.left .wpmchimpas-cont,.wpmchimpas-trig.right .wpmchimpas-trigh:before {
left: 0px;
right: auto;
}
.wpmchimpas-trig .wpmchimpas-trigh{
display: none;
}
.wpmchimpas-trig .wpmchimpas-trigh:before{
content:'';
width: 0;
height: 0;
position: absolute;
margin-top: 2px;
border-top: 6px solid transparent;
border-bottom: 6px solid transparent;
}
.wpmchimpas-trig.left .wpmchimpas-trigh:before{
border-right: 9px solid #000;
}
.wpmchimpas-trig.right .wpmchimpas-trigh:before{
border-left: 9px solid #000;
}
.wpmchimpas-trig.left.wpmchimpas-trigdis .wpmchimpas-trigi{
-webkit-transform: translate(-43px,0);
-moz-transform: translate(-43px,0);
-ms-transform: translate(-43px,0);
-o-transform: translate(-43px,0);
transform: translate(-43px,0);
}
.wpmchimpas-trig.right.wpmchimpas-trigdis .wpmchimpas-trigi{
-webkit-transform: translate(43px,0);
-moz-transform: translate(43px,0);
-ms-transform: translate(43px,0);
-o-transform: translate(43px,0);
transform: translate(43px,0);
}
.wpmchimpas-trig.wpmchimpas-trigdis .wpmchimpas-trigi:hover,
body.body-wpmchimpas-open #wpmchimpas-trig .wpmchimpas-trigi{
-webkit-transform: translate(0,0);
-moz-transform: translate(0,0);
-ms-transform: translate(0,0);
-o-transform: translate(0,0);
transform: translate(0,0);
}
#wpmchimpas-trig.wpmchimpas-trig.wpmchimpas-trigdis .wpmchimpas-trigh{
	display: none;
}
.wpmchimpas-overlay{
height: 100%;
width: 100%;
position: absolute;
display: block;
background: #000;
opacity:0;
z-index: 888888;
top: 0;
left: 0;
visibility:hidden;
}
.wpmchimpas-overlay.showo{
opacity:0.4;
visibility:visible;
}
body > *,.wpmchimpas-trigc,.wpmchimpas-trigi{
-webkit-transition-property: -webkit-transform, opacity, visibility;
-moz-transition-property: -moz-transform, opacity, visibility;
-ms-transition-property: -ms-transform, opacity, visibility;
-o-transition-property: -o-transform, opacity, visibility;
transition-property: transform, opacity, visibility;
-webkit-transition: 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
-moz-transition: 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
-ms-transition: 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
-o-transition: 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
transition: 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.wpmchimpas-scroller {
position: relative;
width:500px;
}
.wpmchimpas-scroller.wpmchimpas-vertcent{
top: 50%;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
}
.wpmchimpas-inner {
padding: 15px;
margin: 25px;
-webkit-transform:scale(0.8);
-moz-transform:scale(0.8);
-ms-transform:scale(0.8);
-o-transform:scale(0.8);
transform:scale(0.8);
-webkit-transition: -webkit-transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
-moz-transition: -moz-transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
-ms-transition: -ms-transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
-o-transition: -o-transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
transition: transform 0.4s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.body-wpmchimpas-open #wpmchimpas{
visibility: visible;
}
.wpmchimpas-open .wpmchimpas-inner{
-webkit-transform:scale(1);
-moz-transform:scale(1);
-ms-transform:scale(1);
-o-transform:scale(1);
transform:scale(1);
}
.wpmchimpas-resp{
-webkit-transform-origin: left;
-moz-transform-origin: left;
-ms-transform-origin: left;
-o-transform-origin: left;
transform-origin: left;
}
.wpmchimpas.right .wpmchimpas-resp{
-webkit-transform-origin: right;
-moz-transform-origin: right;
-ms-transform-origin: right;
-o-transform-origin: right;
transform-origin: right;
}
@media only screen and (max-width:1024px) {
.wpmchimpas-trig .wpmchimpas-trigh{
width: 50px;
height: 50px;
position: absolute;
}
}
@media only screen and (max-width:700px) {
.wpmchimpas-trig.wpmchimpas-trigdis .wpmchimpas-trigi{
-webkit-transform: translate(-35px,0);
-moz-transform: translate(-35px,0);
-ms-transform: translate(-35px,0);
-o-transform: translate(-35px,0);
transform: translate(-35px,0);
}
}
@media only screen and (max-width:420px) {
.body-wpmchimpas-open {-webkit-overflow-scrolling:touch;overflow-y:hidden;}
.wpmchimpas-trigc{-webkit-transform-origin: left;
-moz-transform-origin: left;
-ms-transform-origin: left;
-o-transform-origin: left;
transform-origin: left;
-webkit-transform:scale(0.8);
-moz-transform:scale(0.8);
-ms-transform:scale(0.8);
-o-transform:scale(0.8);
transform:scale(0.8);}
.wpmchimpas-trig.right .wpmchimpas-trigc{-webkit-transform-origin: right;
-moz-transform-origin: right;
-ms-transform-origin: right;
-o-transform-origin: right;
transform-origin: right;
}
}
</style>
<?php 
$wpmchimpa = $this->wpmchimpa;
$form = $this->getformbyid($wpmchimpa['slider_form']);
include_once( 'slide'.$wpmchimpa['slider_theme'].'.php' );
?>
