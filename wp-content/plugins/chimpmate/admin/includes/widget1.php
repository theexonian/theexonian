<style type="text/css">

#wpmchimpaw {
 width: 300px;
padding: 25px;
display: block;
left: 624px;
top: 95px;
background: {{data.theme.w1.widget_bg_c||'#fff'}};
position: relative;
}
#wpmchimpaw .wpmchimpa-leftpane{
width: 100%;
text-align: center;
display: {{data.theme.w1.widget_dissoc?'none':'inline-block'}};
}
#wpmchimpaw .widget_msg, #wpmchimpaw .widget_msg *{
font-size: {{data.theme.w1.widget_msg_fs}}px;
font-family: {{data.theme.w1.widget_msg_f | livepf}};
}
#wpmchimpaw .widget_tbox{
    margin: 10px 0;
    width: 90%;
    padding: 0 20px;
    outline:0;
    display: block;
   -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
color: {{data.theme.w1.widget_tbox_fc||'#353535'}};
font-size: {{data.theme.w1.widget_tbox_fs||'16'}}px;
font-weight: {{data.theme.w1.widget_tbox_fw||'bold'}};
font-family: {{data.theme.w1.widget_tbox_f | livepf}};
font-style: {{data.theme.w1.widget_tbox_fst}};
background-color: {{data.theme.w1.widget_tbox_bgc||'#f8fafa'}};
width: {{data.theme.w1.widget_tbox_w}}px;
height: {{data.theme.w1.widget_tbox_h||'45'}}px;
border: {{data.theme.w1.widget_tbox_bor||'1'}}px solid {{data.theme.w1.widget_tbox_borc||'#e4e9e9'}};
}
#wpmchimpaw .widget_tbox div{
top: 50%;
-webkit-transform: translatey(-50% );
-moz-transform: translatey(-50% );
-ms-transform: translatey(-50% );
-o-transform: translatey(-50% );
transform: translatey(-50% );
position: relative;
}
#wpmchimpaw .wpmchimpa-groups{
display: block;
}
#wpmchimpaw .wpmchimpa-item{
display:inline-block;
margin: 2px 15px;
}
#wpmchimpaw .widget_check {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 30px;
line-height: 25px;
min-width: 100px;
}
#wpmchimpaw .widget_check .cbox{
display: inline-block;
width: 22px;
height: 22px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
-webkit-box-shadow: 0 0 1px 1px {{data.theme.w1.widget_check_borc||'#ccc'}};
-moz-box-shadow: 0 0 1px 1px {{data.theme.w1.widget_check_borc||'#ccc'}};
-ms-box-shadow: 0 0 1px 1px {{data.theme.w1.widget_check_borc||'#ccc'}};
-o-box-shadow: 0 0 1px 1px {{data.theme.w1.widget_check_borc||'#ccc'}};
box-shadow: 0 0 1px 1px {{data.theme.w1.widget_check_borc||'#ccc'}};
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
-ms-transition: all 0.3s ease-in-out;
-moz-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
-webkit-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
}
#wpmchimpaw .widget_check .ctext{
color: {{data.theme.w1.widget_check_fc}};
font-size: {{data.theme.w1.widget_check_fs}}px;
font-weight: {{data.theme.w1.widget_check_fw}};
font-family: {{data.theme.w1.widget_check_f | livepf}};
font-style: {{data.theme.w1.widget_check_fst}};
}
#wpmchimpaw .widget_check .cbox.checked{
background-color: {{data.theme.w1.widget_check_c}};
}
#wpmchimpaw .widget_check .cbox.checked:after,#wpmchimpaw .widget_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.w1.widget_check_shade | chshade}};
margin-top: 1px;
display: block;
}
#wpmchimpaw .widget_check:hover .cbox:after{
opacity: 0.5;
}

#wpmchimpaw .widget_button{
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
color: {{data.theme.w1.widget_button_fc||'#fff'}};
font-size: {{data.theme.w1.widget_button_fs || "22"}}px;
font-weight: {{data.theme.w1.widget_button_fw||'bold'}};
font-family: {{data.theme.w1.widget_button_f | livepf}};
font-style: {{data.theme.w1.widget_button_fst}};
{{data.theme.w1.widget_button_bc? "background-color:"+data.theme.w1.widget_button_bc+";" : "background-color: #4d90fe;
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: linear-gradient(top,#4d90fe,#4787ed);"}}
width: {{data.theme.w1.widget_button_w}}px;
height: {{data.theme.w1.widget_button_h||'45'}}px;
border: {{data.theme.w1.widget_button_bor||'1'}}px solid {{data.theme.w1.widget_button_borc||'#3079ed'}};
}
#wpmchimpaw .widget_button:hover{
color: {{data.theme.w1.widget_button_fch}};
background-color: {{data.theme.w1.widget_button_bch}};
}

.widget_spinner {
height: 40px;
width: 40px;
display: inline-block;
margin-top: 15px;
left: -webkit-calc(50% - 20px);
left: -moz-calc(50% - 20px);
left: -o-calc(50% - 20px);
left: calc(50% - 20px);
position: relative;
border: 2px solid {{data.theme.w1.widget_spinner_c||'#000'}};
-webkit-border-radius: 50%; 
-moz-border-radius: 50%; 
-ms-border-radius: 50%; 
-o-border-radius: 50%; 
border-radius: 50%; 
}

.widget_status{
position: relative;
font-size: 18px;
margin-bottom: 15px;
}

#wpmchimpaw .wpmchimpa-social{
display: inline-block;
margin-bottom: 10px;
}
#wpmchimpaw .wpmchimpa-social::before{
content:"{{data.theme.w1.widget_soc_head||'Subscribe with'}}";
line-height: 30px;
display: block;
color: {{data.theme.w1.widget_soc_fc||'#b3b3b3'}};
font-size: {{data.theme.w1.widget_soc_fs||'20'}}px;
font-weight: {{data.theme.w1.widget_soc_fw}};
font-family: {{(data.theme.w1.widget_soc_f | livepf)}};
font-style: {{data.theme.w1.widget_soc_fst}};
}

#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc{
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
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 7px;
}

#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb {
background: #2d609b;
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
content: <?php echo $this->plugin->getIcon('fb',25,'#fff');?>
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp {
background: #eb4026;
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
content: <?php echo $this->plugin->getIcon('gp',25,'#fff');?>
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms {
background: #00BCF2;
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
content: <?php echo $this->plugin->getIcon('ms',25,'#fff');?>
}

#wpmchimpa .wpmchimpa-tag{
display: {{data.theme.w1.widget_tag_en? 'block':'none'}};
}
#wpmchimpa .wpmchimpa-tag,
#wpmchimpa .wpmchimpa-tag *{
pointer-events: none;
text-align: center;
color: {{data.theme.w1.widget_tag_fc||'#000'}};
font-size: {{data.theme.w1.widget_tag_fs||'10'}}px;
font-weight: {{data.theme.w1.widget_tag_fw||'500'}};
font-family:Arial;
font-family: {{data.theme.w1.widget_tag_f | livepf}};
font-style: {{data.theme.w1.widget_tag_fst}};
}
#wpmchimpa .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.w1.widget_tag_fs||10,data.theme.w1.widget_tag_fc||'#000')}};
margin: 5px;
top: 1px;
position: relative;
}
</style>

<div id="wpmchimpaw">
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="8" data-lhint="Go to Additional Theme Options" style="margin:-15px">7</div>
        <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
        <div class="wpmchimpa" id="wpmchimpa">
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="1" data-lhint="Go to Custom Message Settings">1</div>
            <div class="widget_msg"><p ng-bind-html="data.theme.w1.widget_msg | safe"></p></div>
            </div>
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="2" data-lhint="Go to Text Box Settings" style="right: -20px;">2</div>
              <div class="widget_tbox"><div class="in-name">Name</div></div>
              <div class="widget_tbox"><div class="in-mail">Email address</div></div>
            </div>
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Checkbox Settings">3</div>
              <div class="wpmchimpa-groups">
                <div class="widget_check_c"></div>
                <div class="wpmchimpa-item">
                    <div class="widget_check">
                      <div class="cbox"></div>
                      <div class="ctext">group1</div>
                    </div>
                </div>
                <div class="wpmchimpa-item">
                    <div class="widget_check">
                      <div class="cbox checked"></div>
                      <div class="ctext">group2</div>
                    </div>
                </div>
              </div>
            </div>
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Button Settings" style="right: -20px;">4</div>
              <div class="widget_button">{{data.theme.w1.widget_button}}</div>
            </div>          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Tag Settings">5</div>
          <div class="wpmchimpa-tag" ng-bind-html="data.theme.w1.widget_tag||'Secure and Spam free...' | safe"></div></div>
            <div>
              <div class="widget_spinner"><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Spinner Settings" style="margin:25%">6</div></div>
            </div>
            
          </div>
           
  </div>
</div>
