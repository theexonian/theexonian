<style type="text/css">
.wpmca_viewport * {
  box-sizing: border-box;
}

#wpmchimpas {
width: 500px;
height: 718px;
display: block;
background-color: {{data.theme.s9.slider_canvas_c||'#333'}};
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
text-align: center;
margin:0 50px;
padding:0 20px;
  width: calc(100% - 100px);
background:  {{data.theme.s9.slider_bg_c||'#27313B'}} no-repeat;
background-size: contain;
-webkit-border-radius:1px;
-moz-border-radius:1px;
border-radius:1px;
}
#wpmchimpas h3{
padding-top:20px;
margin: 0;
color: {{data.theme.s9.slider_heading_fc||'#F4233C'}};
font-size: {{data.theme.s9.slider_heading_fs||'24'}}px;
line-height: {{data.theme.s9.slider_heading_fs||'24'}}px;
font-weight: {{data.theme.s9.slider_heading_fw}};
font-family: {{data.theme.s9.slider_heading_f | livepf}};
font-style: {{data.theme.s9.slider_heading_fst}};
}
#wpmchimpas .slider_msg, #wpmchimpas .slider_msg *{
color: #959595;
font-size: {{data.theme.s9.slider_msg_fs||'15'}}px;
font-family: {{data.theme.s9.slider_msg_f | livepf}};
}
#wpmchimpas .slider_msg{
  margin-top: 15px;
}
#wpmchimpas .wpmchimpas{
margin-top: 20px;
}

.wpmchimpas .wpmchimpa_formbox > div,
#wpmchimpas .wpmchimpas > div{
position: relative;
}
#wpmchimpas .wpmchimpa_formbox > div:first-of-type{
  width: 65%;
  float: left;
}
#wpmchimpas .wpmchimpa_formbox > div:first-of-type + div{
  width: 35%;
  float: left;
}
#wpmchimpas .wpmchimpa_formbox .slider_tbox{
border-radius: 3px 0 0 3px;
}
#wpmchimpas .slider_tbox{
text-align: left;
margin-bottom: 10px;
width: 100%;
border-radius: 3px;
outline:0;
display: block;
 padding: 0 10px 0 40px;
color: {{data.theme.s9.slider_tbox_fc||'#353535'}};
font-size: {{data.theme.s9.slider_tbox_fs||'17'}}px;
font-weight: {{data.theme.s9.slider_tbox_fw}};
font-family: {{data.theme.s9.slider_tbox_f | livepf}};
font-style: {{data.theme.s9.slider_tbox_fst}};
background-color: {{data.theme.s9.slider_tbox_bgc||'#fff'}};
width: {{data.theme.s9.slider_tbox_w}}px;
height: {{data.theme.s9.slider_tbox_h||'40'}}px;
line-height: {{data.theme.s9.slider_tbox_h||'40'}}px;
border: {{data.theme.s9.slider_tbox_bor||'1'}}px solid {{data.theme.s9.slider_tbox_borc||'#efefef'}};
}
#wpmchimpas .slider_tbox .in-text{
top: 50%;
-webkit-transform: translatey(-50% );
-moz-transform: translatey(-50% );
-ms-transform: translatey(-50% );
-o-transform: translatey(-50% );
transform: translatey(-50% );
position: relative;
}
.slider_tbox.mailicon:before,
.slider_tbox.pericon:before{
content:'';
display: block;
width: 40px;
height: {{data.theme.s9.slider_tbox_h||'40'}}px;
position: absolute;
top: 0;
left: 0;
}
.slider_tbox.mailicon:before{
background: {{getIcon('m6',15,data.theme.s9.slider_tbox_fc||'#000',345.779)}} no-repeat center;
}
.slider_tbox.pericon:before{
background: {{getIcon('m5',15,data.theme.s9.slider_tbox_fc||'#000',612)}} no-repeat center;
}
#wpmchimpas .wpmchimpa-groups{
display: block;
  margin:5px auto;
}
#wpmchimpas .wpmchimpa-item{
display:inline-block;
margin: 2px 15px;
}

#wpmchimpas .slider_check {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 30px;
line-height: 14px;
min-width: 100px;
}
#wpmchimpas .slider_check .cbox{
display: inline-block;
width: 12px;
height: 12px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
transition: all 0.3s ease-in-out;
background-color:#fff;
box-shadow: 0 0 1px 1px {{data.theme.s9.slider_check_borc||'#ccc'}};
}
#wpmchimpas .slider_check .ctext{
color: {{data.theme.s9.slider_check_fc||'#fff'}};
font-size: {{data.theme.s9.slider_check_fs}}px;
font-weight: {{data.theme.s9.slider_check_fw}};
font-family: {{data.theme.s9.slider_check_f | livepf}};
font-style: {{data.theme.s9.slider_check_fst}};
}
#wpmchimpas .slider_check .cbox.checked{
background-color: {{data.theme.s9.slider_check_c}};
}
#wpmchimpas .slider_check .cbox.checked:after,#wpmchimpas .slider_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.s9.slider_check_shade | chshade}};
margin: -4px;
display: block;
}
#wpmchimpas .slider_check:hover .cbox:after{
opacity: 0.5;
}
#wpmchimpas .slider_button{
width: 100%;
text-align: center;
cursor: pointer;
border-radius: 0 3px 3px 0;
color: {{data.theme.s9.slider_button_fc||'#fff'}};
font-size: {{data.theme.s9.slider_button_fs || "17"}}px;
font-weight: {{data.theme.s9.slider_button_fw}};
font-family: {{data.theme.s9.slider_button_f | livepf}};
font-style: {{data.theme.s9.slider_button_fst}};
background-color:{{data.theme.s9.slider_button_bc||'#FF1F43'}};
width: {{data.theme.s9.slider_button_w}}px;
height: {{data.theme.s9.slider_button_h||'40'}}px;
line-height: {{data.theme.s9.slider_button_h||'40'}}px;
border-radius: {{data.theme.s9.slider_button_br}}px;
border: {{data.theme.s9.slider_button_bor||'1'}}px solid {{data.theme.s9.slider_button_borc||'#FA0B38'}};
}
#wpmchimpas .slider_button:hover{
color: {{data.theme.s9.slider_button_fch}};
background-color: {{data.theme.s9.slider_button_bch||'#FA0B38'}};
}
#wpmchimpas .in-mail+div{
position: absolute;
top: 0;
right: 0;
}
.slider_spinner {
top: 0;
right: 0;
margin: 6px 5px;
-webkit-transform: scale(0.8);
-ms-transform: scale(0.8);
transform: scale(0.8);
}
#slider_tag{
text-align: center;
margin: 5px auto;
display: {{data.theme.s9.slider_tag_en? 'block':'none'}};
}
#slider_tag,
#slider_tag *{
pointer-events: none;
color: {{data.theme.s9.slider_tag_fc||'#fff'}};
font-size: {{data.theme.s9.slider_tag_fs||'10'}}px;
font-weight: {{data.theme.s9.slider_tag_fw}};
font-family:Arial;
font-family: {{data.theme.s9.slider_tag_f | livepf}};
font-style: {{data.theme.s9.slider_tag_fst}};
}
#slider_tag:before{
content:{{getIcon('lock1',data.theme.s9.slider_tag_fs||10,data.theme.s9.slider_tag_fc||'#fff')}};
margin: 5px;
top: 1px;
position: relative;
}
#wpmchimpas-trig{
width: 50px;
height: 50px;
position: absolute;
display: block;
left: 500px;
margin: 0 3px;
top:{{data.theme.s9.slider_trigger_top ||'50'}}%;
background: {{data.theme.s9.slider_trigger_bg || '#27313B'}};
}
#wpmchimpas-trig:before{ 
content:{{getIcon((data.theme.s9.slider_trigger_i)? (data.theme.s9.slider_trigger_i == 'idef')?'m4':(data.theme.s9.slider_trigger_i == 'inone')?'':data.theme.s9.slider_trigger_i:'m4',32,data.theme.s9.slider_trigger_c||'#fff',334.5)}};
height: 32px;
width: 32px;
display: block;
margin: 8px;
}
#wpmchimpas-over{
background: rgba(0, 0, 0, 0.4);
height: 100%;
width: 100%;
position: absolute;
display: block;
}

#wpmchimpas .sp8 {margin: 0 auto;width: 50px;height: 30px;}#wpmchimpas .sp8 > div {background-color: {{data.theme.s9.slider_spinner_c||'#000'}};margin-left: 3px;height: 100%;width: 6px;display: inline-block;-webkit-animation: wpmchimpassp8 1.2s infinite ease-in-out;animation: wpmchimpassp8 1.2s infinite ease-in-out;}#wpmchimpas .sp8 .sp82 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}#wpmchimpas .sp8 .sp83 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}#wpmchimpas .sp8 .sp84 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}#wpmchimpas .sp8 .sp85 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes wpmchimpassp8 {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes wpmchimpassp8 {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}

</style>
<div id="wpmchimpas-over"></div>
<div id="wpmchimpas-trig">
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="6" data-lhint="Go to Trigger Options" style="top:0;right:0;margin:-10px">7</div>
</div>
<div id="wpmchimpas">
<div class="wpmchimpas-inner">
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="9" data-lhint="Go to Additional Theme Options" style="margin:-15px">8</div>
        <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="1" data-lhint="Go to Custom Message Settings">1</div>
            <h3>{{data.theme.s9.slider_heading}}</h3>
            <div class="slider_msg"><p ng-bind-html="data.theme.s9.slider_msg | safe"></p></div>
        </div>
        <div class="wpmchimpas">
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="2" data-lhint="Go to Text Box Settings" style="right: -20px;  top: 10px;">2</div>
              <div class="slider_tbox pericon"><div class="in-text in-name">Name</div></div>
            </div>
          <div class="wpmchimpa_formbox">  
            <div class="slider_tbox mailicon"><div class="in-text in-mail">Email address</div>
              <div>
                  <div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Spinner Settings" style="left: 15px;top:25px;">5</div>
                  <div class="slider_spinner"><div class="sp8"><div class="sp81"></div><div class="sp82"></div><div class="sp83"></div><div class="sp84"></div><div class="sp85"></div></div></div>
              </div>
            </div>
            <div><div class="wpmc-live-sc righthov righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Button Settings" style="right: -20px;">4</div>
              <div class="slider_button">{{data.theme.s9.slider_button}}</div>
            </div>
            <div style="clear:both"></div>
          </div>
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Checkbox Settings" style="left:20px;">3</div>
              <div class="wpmchimpa-groups">
                <div class="slider_check_c"></div>
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
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="8" data-lhint="Go to Tag Settings" style="left:20px;">6</div>
          <div id="slider_tag" ng-bind-html="data.theme.s9.slider_tag||'Secure and Spam free...' | safe"></div></div>
          
           
  </div>
</div>
</div>