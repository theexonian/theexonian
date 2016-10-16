<style type="text/css">
	
.wpmchimpab {
  min-height: 100px;
  display: block;
  border: solid #dadbdc;
  border-width: 1px 0;
  padding: 50px;
width: 495px;
left: 50px;
top: 200px;
position: relative;
 background: {{data.theme.a0.addon_bg_c||'#f1f1f1'}};
}
.wpmchimpab h3{
color: {{data.theme.a0.addon_tbox_fc}};
font-size: {{data.theme.a0.addon_tbox_fs||'18'}}px;
font-weight: {{data.theme.a0.addon_tbox_fw}};
font-family: {{data.theme.a0.addon_tbox_f | livepf}};
font-family:Arial;
font-style: {{data.theme.a0.addon_tbox_fst}};
}
.wpmchimpab p{
  margin-bottom: 10px;
  line-height: 20px;  
font-size: {{data.theme.a0.addon_msg_fs||'14'}}px;
font-family: {{data.theme.a0.addon_msg_f | livepf}};
}

.wpmchimpab .wpmchimpa-groups{
  display: block;
}
.wpmchimpab .wpmchimpa-item{
  float:left;
  margin: 2px 15px;
}
.wpmchimpab .addon_check .ctext {
  cursor: pointer;
  display: inline-block;
  position: relative;
  padding-left: 10px;
  top: -5px;
  margin-right: 10px;
  color: {{data.theme.a0.addon_check_fc}};
font-size: {{data.theme.a0.addon_check_fs}}px;
font-weight: {{data.theme.a0.addon_check_fw}};
font-family: {{data.theme.a0.addon_check_f | livepf}};
font-style: {{data.theme.a0.addon_check_fst}};
}

.wpmchimpab .addon_check .cbox{
  display: inline-block;
  width: 18px;
  height: 18px;
  background-color: #ACACAC;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: 0 0 1px 1px {{data.theme.a0.addon_check_borc}};
-moz-box-shadow: 0 0 1px 1px {{data.theme.a0.addon_check_borc}};
-ms-box-shadow: 0 0 1px 1px {{data.theme.a0.addon_check_borc}};
-o-box-shadow: 0 0 1px 1px {{data.theme.a0.addon_check_borc}};
box-shadow: 0 0 1px 1px {{data.theme.a0.addon_check_borc}};
}


.wpmchimpab .addon_check .cbox.checked {
background-color: {{data.theme.a0.addon_check_c||'#158EC6'}};
}
.wpmchimpab .addon_check .cbox.checked:after,.wpmchimpab .addon_check:hover .cbox:after{
overflow: hidden;
display: block;
position: absolute;
margin: -1px -3px;
}
.wpmchimpab .addon_check .cbox.checked:after,.wpmchimpab .addon_check:hover .cbox:after{
content: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAABmJLR0QAAAAAAAD5Q7t/AAAACXBIWXMAAC4jAAAuIwF4pT92AAAAvElEQVQ4T63RwQsBQRzF8U0kycVBScp/wU3yB8jVXS6uFAcHe1JykIu7/3O8qackO2/2t3P4HHZ7892mzZxzWWpyYCEHFnJgIQeR+tBMGR3DHeapolN4wer7vToUsoQn7KFWNdqADYPbfxsV+NWGA4M7fqBU9AELqPO5BzmDJ2gVnQ1FZwwcYQI3PvtwJ3BOXn/N0McFuuKMjPornhm8wkAFY6LekMFRxDY66hX+lCrRUuTAQg4s5MBCDizeX/c4P/MwE9UAAAAASUVORK5CYII=);
content: {{data.theme.a0.addon_check_shade | chshade}};
}
.wpmchimpab .addon_check:hover .cbox:after{
opacity: 0.5;
}
.wpmchimpab .addon_tbox {
    display: inline-block;
    width:100%;
    background:#fff;
    text-align: center;
    margin-bottom:12px;
    outline:0;
    border-radius: 1px;
    -webkit-border-radius: 1px;
    -moz-border-radius: 1px;
    -ms-border-radius: 1px;
    -o-border-radius: 1px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
color: {{data.theme.a0.addon_tbox_fc}};
font-size: {{data.theme.a0.addon_tbox_fs||'14'}}px;
font-weight: {{data.theme.a0.addon_tbox_fw}};
font-family: {{data.theme.a0.addon_tbox_f | livepf}};
font-family:Arial;
font-style: {{data.theme.a0.addon_tbox_fst}};
background-color: {{data.theme.a0.addon_tbox_bgc||'#fff'}};
width: {{data.theme.a0.addon_tbox_w}}px;
height: {{data.theme.a0.addon_tbox_h||'45'}}px;
line-height: {{data.theme.a0.addon_tbox_h||'45'}}px;
border: {{data.theme.a0.addon_tbox_bor||'1'}}px solid {{data.theme.a0.addon_tbox_borc||'#dddddd'}};
}

.wpmchimpab .wpmchimpa-subs-button{
display:inline-block;
vertical-align: initial;
text-align: center;
background: #62bc33;
cursor:pointer;
-webkit-box-shadow:none;
-moz-box-shadow:none;
-ms-box-shadow:none;
-o-box-shadow:none;
box-shadow:none;
clear:both;
text-shadow:none;
border-radius: 1px;
width:100%;
-webkit-border-radius: 1px;
-moz-border-radius: 1px;
-ms-border-radius: 1px;
-o-border-radius: 1px;
color: {{data.theme.a0.addon_button_fc||'#fff'}};
font-size: {{data.theme.a0.addon_button_fs||'18'}}px;
font-weight: {{data.theme.a0.addon_button_fw}};
font-family:Open Sans;
font-family: {{data.theme.a0.addon_button_f | livepf}};
font-style: {{data.theme.a0.addon_button_fst}};
{{data.theme.a0.addon_button_bc? "background-color:"+data.theme.a0.addon_button_bc+";" : "background: -moz-linear-gradient(left, #62bc33 0%, #8bd331 100%);
      background: -webkit-gradient(linear, left top, right top, color-stop(0%,#62bc33), color-stop(100%,#8bd331));
      background: -webkit-linear-gradient(left, #62bc33 0%,#8bd331 100%);
      background: -o-linear-gradient(left, #62bc33 0%,#8bd331 100%);
      background: -ms-linear-gradient(left, #62bc33 0%,#8bd331 100%);
      background: linear-gradient(to right, #62bc33 0%,#8bd331 100%);"}}
width: {{data.theme.a0.addon_button_w}}px;
height: {{data.theme.a0.addon_button_h||'45'}}px;
line-height: {{data.theme.a0.addon_button_h||'45'}}px;
border: {{data.theme.a0.addon_button_bor||'0'}}px solid {{data.theme.a0.addon_button_borc}};
}
.wpmchimpab .wpmchimpa-subs-button:hover{
    background:#8BD331;
color: {{data.theme.a0.addon_button_fch||'#fff'}};
background-color: {{data.theme.a0.addon_button_bch}};
{{data.theme.a0.addon_button_bch? "background-color:"+data.theme.a0.addon_button_bch+";" : "background: -moz-linear-gradient(left, #8BD331 0%, #8bd331 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,#8BD331), color-stop(100%,#8bd331));
background: -webkit-linear-gradient(left, #8BD331 0%,#8bd331 100%);
background: -o-linear-gradient(left, #8BD331 0%,#8bd331 100%);
background: -ms-linear-gradient(left, #8BD331 0%,#8bd331 100%);
background: linear-gradient(to right, #8BD331 0%,#8bd331 100%);"}}
border: {{data.theme.a0.addon_button_bor||'0'}}px solid {{data.theme.a0.addon_button_borc}};
}
.wpmchimpab .wpmchimpa-signal {   
border:3px solid {{data.theme.a0.addon_spinner_c||'#fff'}};
-webkit-border-radius:30px;
-moz-border-radius:30px;
border-radius:30px;
height:30px;
left:50%;
margin: 10px -15px;
position: relative;
width:30px;
}
.wpmchimpab .wpmchimpa-tag{
display: {{data.theme.a0.addon_tag_en? 'block':'none'}};
}
.wpmchimpab .wpmchimpa-tag,
.wpmchimpab .wpmchimpa-tag *{
pointer-events: none;
text-align: center;
color: {{data.theme.a0.addon_tag_fc||'#000'}};
font-size: {{data.theme.a0.addon_tag_fs||'10'}}px;
font-weight: {{data.theme.a0.addon_tag_fw||'500'}};
font-family:Arial;
font-family: {{data.theme.a0.addon_tag_f | livepf}};
font-style: {{data.theme.a0.addon_tag_fst}};
}
.wpmchimpab .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.a0.addon_tag_fs||10,data.theme.a0.addon_tag_fc||'#000')}};
margin: 5px;
top: 1px;
position: relative;
}
</style>
<div class="wpmchimpab">
<div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="10" data-lhint="Go to Additional Theme Options" style="margin:-30px">7</div>
	<div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Custom Message Settings" style="left:30px;">1</div>
    <h3>{{data.theme.a0.addon_heading}}</h3>
    <div class="addon_msg"><p ng-bind-html="data.theme.a0.addon_msg | safe"></p></div>
  </div>

  <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Text Box Settings" style="right:0;">2</div>
    <div class="addon_tbox"><div class="in-name">Name</div></div>
    <div class="addon_tbox"><div class="in-mail">Email address</div></div>
  </div>

	<div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="6" data-lhint="Go to Button Settings" style="left:30px;">3</div>
    <div class="wpmchimpa-subs-button">{{data.theme.a0.addon_button}}</div>
  </div>
          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="9" data-lhint="Go to Tag Settings">6</div>
          <div class="wpmchimpa-tag" ng-bind-html="data.theme.a0.addon_tag||'Secure and Spam free...' | safe"></div></div>
    <div>
    <div class="wpmchimpa-signal"><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Spinner Settings" style="margin:18%">5</div></div>
  </div>

	<div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Checkbox Settings" style="right:0;">4</div>
    <div class="wpmchimpa-groups">
     <div class="wpmchimpa-item">
        <div class="addon_check">
          <div class="cbox"></div>
          <div class="ctext">group1</div>
        </div>
      </div>
      <div class="wpmchimpa-item">
        <div class="addon_check">
          <div class="cbox checked"></div>
          <div class="ctext">group2</div>
        </div>
      </div>
    </div>
  </div>	
</div>