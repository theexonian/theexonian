<style type="text/css">

#wpmchimpas {
width: 500px;
height: 718px;
display: block;
background: {{data.theme.s1.slider_canvas_c||'#333'}};
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
background:  {{data.theme.s1.slider_bg_c||'#fff'}};
-webkit-border-radius:10px;
-moz-border-radius:10px;
border-radius:10px;
}
#wpmchimpas .wpmchimpa-leftpane{
width: 100%;
text-align: center;
display: {{data.theme.s1.slider_dissoc?'none':'inline-block'}};
}
#wpmchimpas h3{
color: {{data.theme.s1.slider_heading_fc}};
font-size: {{data.theme.s1.slider_heading_fs||'18'}}px;
font-weight: {{data.theme.s1.slider_heading_fw}};
font-family: {{data.theme.s1.slider_heading_f | livepf}};
font-style: {{data.theme.s1.slider_heading_fst}};
}
#wpmchimpas .slider_msg, #wpmchimpas .slider_msg *{
font-size: {{data.theme.s1.slider_msg_fs}}px;
font-family: {{data.theme.s1.slider_msg_f | livepf}};
}
#wpmchimpas .slider_tbox{
    margin: 10px 0;
    width: 90%;
    padding: 0 20px;
   -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
    outline:0;
    display: block;
color: {{data.theme.s1.slider_tbox_fc||'#353535'}};
font-size: {{data.theme.s1.slider_tbox_fs||'16'}}px;
font-weight: {{data.theme.s1.slider_tbox_fw||'bold'}};
font-family: {{data.theme.s1.slider_tbox_f | livepf}};
font-style: {{data.theme.s1.slider_tbox_fst}};
background-color: {{data.theme.s1.slider_tbox_bgc||'#f8fafa'}};
width: {{data.theme.s1.slider_tbox_w}}px;
height: {{data.theme.s1.slider_tbox_h||'45'}}px;
border: {{data.theme.s1.slider_tbox_bor||'1'}}px solid {{data.theme.s1.slider_tbox_borc||'#e4e9e9'}};
}
#wpmchimpas .slider_tbox div{
top: 50%;
-webkit-transform: translatey(-50% );
-moz-transform: translatey(-50% );
-ms-transform: translatey(-50% );
-o-transform: translatey(-50% );
transform: translatey(-50% );
position: relative;
}
#wpmchimpas .wpmchimpa-groups{
display: block;
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
line-height: 25px;
min-width: 100px;
}
#wpmchimpas .slider_check .cbox{
display: inline-block;
width: 22px;
height: 22px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
-webkit-box-shadow: 0 0 1px 1px {{data.theme.s1.slider_check_borc||'#ccc'}};
-moz-box-shadow: 0 0 1px 1px {{data.theme.s1.slider_check_borc||'#ccc'}};
-ms-box-shadow: 0 0 1px 1px {{data.theme.s1.slider_check_borc||'#ccc'}};
-o-box-shadow: 0 0 1px 1px {{data.theme.s1.slider_check_borc||'#ccc'}};
box-shadow: 0 0 1px 1px {{data.theme.s1.slider_check_borc||'#ccc'}};
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
-ms-transition: all 0.3s ease-in-out;
-moz-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
-webkit-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
}
#wpmchimpas .slider_check .ctext{
color: {{data.theme.s1.slider_check_fc}};
font-size: {{data.theme.s1.slider_check_fs}}px;
font-weight: {{data.theme.s1.slider_check_fw}};
font-family: {{data.theme.s1.slider_check_f | livepf}};
font-style: {{data.theme.s1.slider_check_fst}};
}
#wpmchimpas .slider_check .cbox.checked{
background-color: {{data.theme.s1.slider_check_c}};
}
#wpmchimpas .slider_check .cbox.checked:after,#wpmchimpas .slider_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.s1.slider_check_shade | chshade}};
margin-top: 1px;
margin-left: -4px;
display: block;
}
#wpmchimpas .slider_check:hover .cbox:after{
opacity: 0.5;
}

#wpmchimpas .slider_button{
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
-ms-border-radius: 3px;
-o-border-radius: 3px;
color: #fff;
line-height: 45px;
text-align: center;
cursor: pointer;
margin-top: 15px;
text-align: center;
width:100%;
color: {{data.theme.s1.slider_button_fc||'#fff'}};
font-size: {{data.theme.s1.slider_button_fs || "22"}}px;
font-weight: {{data.theme.s1.slider_button_fw||'bold'}};
font-family: {{data.theme.s1.slider_button_f | livepf}};
font-style: {{data.theme.s1.slider_button_fst}};
{{data.theme.s1.slider_button_bc? "background-color:"+data.theme.s1.slider_button_bc+";" : "background-color: #4d90fe;
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: linear-gradient(top,#4d90fe,#4787ed);"}}
width: {{data.theme.s1.slider_button_w}}px;
height: {{data.theme.s1.slider_button_h||'45'}}px;
border: {{data.theme.s1.slider_button_bor||'1'}}px solid {{data.theme.s1.slider_button_borc||'#3079ed'}};
}
#wpmchimpas .slider_button:hover{
color: {{data.theme.s1.slider_button_fch}};
background-color: {{data.theme.s1.slider_button_bch}};
}

.slider_spinner {
height: 40px;
width: 40px;
display: inline-block;
margin-top: 15px;
position: relative;
border: 2px solid {{data.theme.s1.slider_spinner_c||'#000'}};
border-radius: 50%; 
}

.slider_status{
position: relative;
font-size: 18px;
margin-bottom: 15px;
}

#wpmchimpas .wpmchimpa-social{
display: inline-block;
margin-bottom: 10px;
}
#wpmchimpas .wpmchimpa-social::before{
content:"{{data.theme.s1.slider_soc_head||'Subscribe with'}}";
line-height: 30px;
display: block;
color: {{data.theme.s1.slider_soc_fc||'#b3b3b3'}};
font-size: {{data.theme.s1.slider_soc_fs||'20'}}px;
font-weight: {{data.theme.s1.slider_soc_fw}};
font-family: {{(data.theme.s1.slider_soc_f | livepf)}};
font-style: {{data.theme.s1.slider_soc_fst}};
}

#wpmchimpas .wpmchimpa-social .wpmchimpa-soc{
width:40px;
height: 40px;
-webkit-border-radius: 50%;
-moz-box-border-radius: 50%;
-ms-border-radius: 50%;
-o-border-radius: 50%;
border-radius: 50%;
float: left;
margin: 5px;
}
#wpmchimpas .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 7px;
}

#wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb {
background: #2d609b;
}
#wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
content: <?php echo $this->plugin->getIcon('fb',25,'#fff');?>
}
#wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp {
background: #eb4026;
}
#wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
content: <?php echo $this->plugin->getIcon('gp',25,'#fff');?>
}
#wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms {
background: #00BCF2;
}
#wpmchimpas .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
content: <?php echo $this->plugin->getIcon('ms',25,'#fff');?>
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
margin: 0 3px;
position: absolute;
display: block;
left: 500px;
-webkit-border-radius:1px;
-moz-border-radius:1px;
border-radius:1px;
top:{{data.theme.s1.slider_trigger_top ||'50'}}%;
background: {{data.theme.s1.slider_trigger_bg || '#0066CB'}};
}
#wpmchimpas-trig:before{
content:{{getIcon((data.theme.s1.slider_trigger_i)? (data.theme.s1.slider_trigger_i == 'idef')?'m2':(data.theme.s1.slider_trigger_i == 'inone')?'':data.theme.s1.slider_trigger_i:'m2',32,data.theme.s1.slider_trigger_c||'#fff')}};
height: 32px;
width: 32px;
display: block;
margin: 8px;
}
#wpmchimpas .wpmchimpa-tag{
display: {{data.theme.s1.slider_tag_en? 'block':'none'}};
}
#wpmchimpas .wpmchimpa-tag,
#wpmchimpas .wpmchimpa-tag *{
pointer-events: none;
color: {{data.theme.s1.slider_tag_fc||'#000'}};
font-size: {{data.theme.s1.slider_tag_fs||'10'}}px;
font-weight: {{data.theme.s1.slider_tag_fw||'500'}};
font-family:Arial;
font-family: {{data.theme.s1.slider_tag_f | livepf}};
font-style: {{data.theme.s1.slider_tag_fst}};
}
#wpmchimpas .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.s1.slider_tag_fs||10,data.theme.s1.slider_tag_fc||'#000')}};
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
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="8" data-lhint="Go to Additional Theme Options" style="margin:-15px">6</div>
        <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="1" data-lhint="Go to Custom Message Settings">1</div>
            <h3>{{data.theme.s1.slider_heading}}</h3>
            <div class="slider_msg"><p ng-bind-html="data.theme.s1.slider_msg | safe"></p></div>
        </div>
        <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
        <div class="wpmchimpa" id="wpmchimpa">
        
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="2" data-lhint="Go to Text Box Settings" style="right: -20px;">2</div>
              <div class="slider_tbox"><div class="in-name">Name</div></div>
              <div class="slider_tbox"><div class="in-mail">Email address</div></div>
            </div>
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Checkbox Settings">3</div>
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
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Button Settings" style="right: -20px;">4</div>
              <div class="slider_button">{{data.theme.s1.slider_button}}</div>
            </div>
              <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="8" data-lhint="Go to Tag Settings">7</div>
  <div class="wpmchimpa-tag" ng-bind-html="data.theme.s1.slider_tag||'Secure and Spam free...' | safe"></div></div>
            <div>
              <div class="slider_spinner"><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Spinner Settings" style="margin:25%">5</div></div>
            </div>
          
          </div>
          
  </div>
</div>
</div>