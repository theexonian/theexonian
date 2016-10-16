<style type="text/css">

#wpmchimpas {
width: 500px;
height: 718px;
display: block;
background: {{data.theme.s0.slider_bg_c||'#333'}};
color:#fff;
position: relative;
}
#wpmchimpas .wpmchimpas-inner{
  top: 50%;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
position: absolute;
padding: 15px;
margin: 25px;
text-align: center;
}
#wpmchimpas h3{
color: {{data.theme.s0.slider_tbox_fc||'#fff'}};
font-size: {{data.theme.s0.slider_tbox_fs||'18'}}px;
font-weight: {{data.theme.s0.slider_tbox_fw}};
font-family: {{data.theme.s0.slider_tbox_f | livepf}};
font-style: {{data.theme.s0.slider_tbox_fst}};
}
#wpmchimpas p{
margin-bottom: 15px;
line-height: 20px;
font-size: {{data.theme.s0.slider_msg_fs||'14'}}px;
font-family:Arial;
font-family: {{data.theme.s0.slider_msg_f | livepf}};
}
#wpmchimpas .wpmchimpa-groups{
display: inline-block;
overflow:auto; 
}
#wpmchimpas .wpmchimpa-item{
float:left;
margin: 2px 2px;
}

#wpmchimpas .slider_check .ctext {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 10px;
top: -5px;
margin-right: 10px;
color: {{data.theme.s0.slider_check_fc||'#686868'}};
font-size: {{data.theme.s0.slider_check_fs}}px;
font-weight: {{data.theme.s0.slider_check_fw}};
font-family: {{data.theme.s0.slider_check_f | livepf}};
font-style: {{data.theme.s0.slider_check_fst}};
}

#wpmchimpas .slider_check .cbox{
display: inline-block;
width: 18px;
height: 18px;
background-color: #ACACAC;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
{{data.theme.s0.slider_check_borc? '-webkit-box-shadow: 0 0 1px 1px '+data.theme.s0.slider_check_borc+';-moz-box-shadow: 0 0 1px 1px '+data.theme.s0.slider_check_borc+';-ms-box-shadow: 0 0 1px 1px '+data.theme.s0.slider_check_borc+';-o-box-shadow: 0 0 1px 1px '+data.theme.s0.slider_check_borc+';box-shadow: 0 0 1px 1px '+data.theme.s0.slider_check_borc+';' :''}}
}


#wpmchimpas .slider_check .cbox.checked {
background-color: {{data.theme.s0.slider_check_c||'#158EC6'}};
}
#wpmchimpas .slider_check .cbox.checked:after,#wpmchimpas .slider_check:hover .cbox:after{
overflow: hidden;
display: block;
position: absolute;
margin: -1px -3px;
}
#wpmchimpas .slider_check .cbox.checked:after,#wpmchimpas .slider_check:hover .cbox:after{
content: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAC4jAAAuIwF4pT92AAAAvElEQVQ4T63RwQsBQRzF8U0kycVBScp/wU3yB8jVXS6uFAcHe1JykIu7/3O8qackO2/2t3P4HHZ7892mzZxzWWpyYCEHFnJgIQeR+tBMGR3DHeapolN4wer7vToUsoQn7KFWNdqADYPbfxsV+NWGA4M7fqBU9AELqPO5BzmDJ2gVnQ1FZwwcYQI3PvtwJ3BOXn/N0McFuuKMjPornhm8wkAFY6LekMFRxDY66hX+lCrRUuTAQg4s5MBCDizeX/c4P/MwE9UAAAAASUVORK5CYII=);
content: {{data.theme.s0.slider_check_shade | chshade}};
}
#wpmchimpas .slider_check:hover .cbox:after{
opacity: 0.5;
}

#wpmchimpas .slider_tbox {
text-align: center;
outline:0;
border-radius: 1px;
-webkit-border-radius: 1px;
-moz-border-radius: 1px;
-ms-border-radius: 1px;
-o-border-radius: 1px;
width: 100%;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
margin-bottom:10px;
display: block;
color: #000;
line-height: {{data.theme.s0.slider_tbox_h||'40'}}px;
color: {{data.theme.s0.slider_tbox_fc}};
font-size: {{data.theme.s0.slider_tbox_fs||'14'}}px;
font-weight: {{data.theme.s0.slider_tbox_fw}};
font-family: {{data.theme.s0.slider_tbox_f | livepf}};
font-family:Arial;
font-style: {{data.theme.s0.slider_tbox_fst}};
background-color: {{data.theme.s0.slider_tbox_bgc||'#fff'}};
width: {{data.theme.s0.slider_tbox_w}}px;
height: {{data.theme.s0.slider_tbox_h||'40'}}px;
border: {{data.theme.s0.slider_tbox_bor||'1'}}px solid {{data.theme.s0.slider_tbox_borc||'#dddddd'}};
}

#wpmchimpas .wpmchimpa-subs-button{
margin: 12px 0;
width: 100%;
text-align: center;
background: #62bc33;
cursor:pointer;
-webkit-box-shadow:none;
-moz-box-shadow:none;
-ms-box-shadow:none;
-o-box-shadow:none;
box-shadow:none;
clear:both;
text-decoration:none;
text-shadow:none;
border-radius: 1px;
-webkit-border-radius: 1px;
-moz-border-radius: 1px;
-ms-border-radius: 1px;
-o-border-radius: 1px;
background: -moz-linear-gradient(left, #62bc33 0%, #8bd331 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#62bc33), color-stop(100%,#8bd331));
background: -webkit-linear-gradient(left, #62bc33 0%,#8bd331 100%);
background: -o-linear-gradient(left, #62bc33 0%,#8bd331 100%);
background: -ms-linear-gradient(left, #62bc33 0%,#8bd331 100%);
background: linear-gradient(to right, #62bc33 0%,#8bd331 100%);

color: {{data.theme.s0.slider_button_fc||'#fff'}};
font-size: {{data.theme.s0.slider_button_fs||'16'}}px;
font-weight: {{data.theme.s0.slider_button_fw}};
font-family:Open Sans;
font-family: {{data.theme.s0.slider_button_f | livepf}};
font-style: {{data.theme.s0.slider_button_fst}};
{{data.theme.s0.slider_button_bc? "background-color:"+data.theme.s0.slider_button_bc+";" : "background: -moz-linear-gradient(left, #62bc33 0%, #8bd331 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#62bc33), color-stop(100%,#8bd331));
background: -webkit-linear-gradient(left, #62bc33 0%,#8bd331 100%);
background: -o-linear-gradient(left, #62bc33 0%,#8bd331 100%);
background: -ms-linear-gradient(left, #62bc33 0%,#8bd331 100%);
background: linear-gradient(to right, #62bc33 0%,#8bd331 100%);"}}
width: {{data.theme.s0.slider_button_w}}px;
height: {{data.theme.s0.slider_button_h||'40'}}px;
line-height: {{data.theme.s0.slider_button_h||'40'}}px;
border: {{data.theme.s0.slider_button_bor||'0'}}px solid {{data.theme.s0.slider_button_borc}};
}
#wpmchimpas .wpmchimpa-subs-button:hover{
background:#8BD331;
color: {{data.theme.s0.slider_button_fch||'#fff'}};
background-color: {{data.theme.s0.slider_button_bch}};
{{data.theme.s0.slider_button_bch? "background-color:"+data.theme.s0.slider_button_bch+";" : "background: -moz-linear-gradient(left, #8BD331 0%, #8bd331 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#8BD331), color-stop(100%,#8bd331));
background: -webkit-linear-gradient(left, #8BD331 0%,#8bd331 100%);
background: -o-linear-gradient(left, #8BD331 0%,#8bd331 100%);
background: -ms-linear-gradient(left, #8BD331 0%,#8bd331 100%);
background: linear-gradient(to right, #8BD331 0%,#8bd331 100%);"}}
border: {{data.theme.s0.slider_button_bor||'0'}}px solid {{data.theme.s0.slider_button_borc}};
}
#wpmchimpas .wpmchimpa-signal {
border: 3px solid {{data.theme.s0.slider_spinner_c||'#fff'}};
border-radius: 30px;
-webkit-border-radius: 30px;
-moz-border-radius: 30px;
-ms-border-radius: 30px;
-o-border-radius: 30px;
height: 30px;
width: 30px;
margin:10px auto;
position: relative;
vertical-align: middle;
}
#wpmchimpas-over{
background: rgba(0, 0, 0, 0.4);
height: 100%;
width: 100%;
position: absolute;
display: block;
}
#wpmchimpas-trig{
width: 50px;
height: 50px;
position: absolute;
display: block;
left: 500px;
top:{{data.theme.s0.slider_trigger_top ||'50'}}%;
background: {{data.theme.s0.slider_trigger_bg || '#000'}};
}
#wpmchimpas-trig:before{
content:{{getIcon((data.theme.s0.slider_trigger_i)? (data.theme.s0.slider_trigger_i == 'idef')?'m1':(data.theme.s0.slider_trigger_i == 'inone')?'':data.theme.s0.slider_trigger_i:'m1',32,data.theme.s0.slider_trigger_c||'#fff')}};
height: 32px;
width: 32px;
display: block;
margin: 8px;
}
#wpmchimpas .wpmchimpa-tag{
display: {{data.theme.s0.slider_tag_en? 'block':'none'}};
}
#wpmchimpas .wpmchimpa-tag,
#wpmchimpas .wpmchimpa-tag *{
pointer-events: none;
color: {{data.theme.s0.slider_tag_fc||'#fff'}};
font-size: {{data.theme.s0.slider_tag_fs||'10'}}px;
font-weight: {{data.theme.s0.slider_tag_fw||'500'}};
font-family:Arial;
font-family: {{data.theme.s0.slider_tag_f | livepf}};
font-style: {{data.theme.s0.slider_tag_fst}};
}
#wpmchimpas .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.s0.slider_tag_fs||10,data.theme.s0.slider_tag_fc||'#fff')}};
margin: 5px;
top: 1px;
position: relative;
}
</style>
<div id="wpmchimpas-over"></div>
<div id="wpmchimpas-trig">
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="6" data-lhint="Go to Trigger Options" style="top:0;right:0;margin:-10px">7</div>
</div>
<div id="wpmchimpas">
<div class="wpmchimpas-inner">
<div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="9" data-lhint="Go to Additional Theme Options" style="top:0">7</div>
	<div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="1" data-lhint="Go to Custom Message Settings" style="left:30px;">1</div>
    <h3>{{data.theme.s0.slider_heading}}</h3>
    <div class="slider_msg"><p ng-bind-html="data.theme.s0.slider_msg | safe"></p></div>
  </div>
  <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="2" data-lhint="Go to Text Box Settings" style="right:0;">2</div>
    <div class="slider_tbox"><div class="in-name">Name</div></div>
    <div class="slider_tbox"><div class="in-mail">Email address</div></div>
  </div>
  <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Checkbox Settings" style="left:30px;">3</div>
    <div class="wpmchimpa-groups">
     <div class="wpmchimpa-item">
        <div class="slider_check">
          <div class="cbox"></div>
          <div class="ctext">group1</div>
        </div>
      </div>
      <div class="wpmchimpa-item">
        <div class="slider_check">
          <div class="cbox checked"></div>
          <div class="ctext">group2</div>
        </div>
      </div>
    </div>
  </div>
  <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Button Settings" style="right:0;">4</div>
    <div class="wpmchimpa-subs-button">{{data.theme.s0.slider_button}}</div>
  </div>

  <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="8" data-lhint="Go to Tag Settings">7</div>
  <div class="wpmchimpa-tag" ng-bind-html="data.theme.s0.slider_tag||'Secure and Spam free...' | safe"></div></div>
  <div>
    <div class="wpmchimpa-signal"><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Spinner Settings" style="margin:18%">5</div></div>
  </div>
</div>
</div>