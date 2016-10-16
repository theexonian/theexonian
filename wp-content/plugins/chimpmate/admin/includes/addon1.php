<style type="text/css">

#wpmchimpaw {
min-height: 100px;
display: inline-block;
border: solid #dadbdc;
border-width: 1px 0;
padding: 50px;
padding-bottom: 10px;
width: 495px;
left: 50px;
top: 200px;
position: relative;
background: {{data.theme.a1.addon_bg_c||'#fff'}};
}
#wpmchimpaw .wpmchimpa-leftpane{
display: {{data.theme.a1.addon_dissoc?'none':'inline-block'}};
padding: 0 20px;
float: left;
}
#wpmchimpaw .wpmchimpa{
position: relative;
display: inline-block;
width: 59%;
}
#wpmchimpaw .addon_heading{
line-height: 34px;
color: {{data.theme.a1.addon_heading_fc||'#454545'}};
font-size: {{data.theme.a1.addon_heading_fs||'18'}}px;
font-weight: {{data.theme.a1.addon_heading_fw||'bold'}};
font-family: {{data.theme.a1.addon_heading_f | livepf}};
font-style: {{data.theme.a1.addon_heading_fst}};
}
#wpmchimpaw .addon_msg, #wpmchimpaw .addon_msg *{
font-size: {{data.theme.a1.addon_msg_fs}}px;
font-family: {{data.theme.a1.addon_msg_f | livepf}};
}
#wpmchimpaw .addon_tbox{
    margin: 10px 0;
    width: 90%;
   -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
    padding: 0 20px;
    outline:0;
    display: block;
color: {{data.theme.a1.addon_tbox_fc||'#353535'}};
font-size: {{data.theme.a1.addon_tbox_fs||'16'}}px;
font-weight: {{data.theme.a1.addon_tbox_fw||'bold'}};
font-family: {{data.theme.a1.addon_tbox_f | livepf}};
font-style: {{data.theme.a1.addon_tbox_fst}};
background-color: {{data.theme.a1.addon_tbox_bgc||'#f8fafa'}};
width: {{data.theme.a1.addon_tbox_w}}px;
height: {{data.theme.a1.addon_tbox_h||'45'}}px;
border: {{data.theme.a1.addon_tbox_bor||'1'}}px solid {{data.theme.a1.addon_tbox_borc||'#e4e9e9'}};
}
#wpmchimpaw .addon_tbox div{
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
#wpmchimpaw .addon_check {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 30px;
line-height: 25px;
min-width: 100px;
}
#wpmchimpaw .addon_check .cbox{
display: inline-block;
width: 22px;
height: 22px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
-webkit-box-shadow: 0 0 1px 1px {{data.theme.a1.addon_check_borc||'#ccc'}};
-moz-box-shadow: 0 0 1px 1px {{data.theme.a1.addon_check_borc||'#ccc'}};
-ms-box-shadow: 0 0 1px 1px {{data.theme.a1.addon_check_borc||'#ccc'}};
-o-box-shadow: 0 0 1px 1px {{data.theme.a1.addon_check_borc||'#ccc'}};
box-shadow: 0 0 1px 1px {{data.theme.a1.addon_check_borc||'#ccc'}};
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
-ms-transition: all 0.3s ease-in-out;
-moz-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
-webkit-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
}
#wpmchimpaw .addon_check .ctext{
color: {{data.theme.a1.addon_check_fc}};
font-size: {{data.theme.a1.addon_check_fs}}px;
font-weight: {{data.theme.a1.addon_check_fw}};
font-family: {{data.theme.a1.addon_check_f | livepf}};
font-style: {{data.theme.a1.addon_check_fst}};
}
#wpmchimpaw .addon_check .cbox.checked{
background-color: {{data.theme.a1.addon_check_c}};
}
#wpmchimpaw .addon_check .cbox.checked:after,#wpmchimpaw .addon_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.a1.addon_check_shade | chshade}};
margin-top: 1px;
display: block;
}
#wpmchimpaw .addon_check:hover .cbox:after{
opacity: 0.5;
}

#wpmchimpaw .addon_button{
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
color: {{data.theme.a1.addon_button_fc||'#fff'}};
font-size: {{data.theme.a1.addon_button_fs || "22"}}px;
font-weight: {{data.theme.a1.addon_button_fw||'bold'}};
font-family: {{data.theme.a1.addon_button_f | livepf}};
font-style: {{data.theme.a1.addon_button_fst}};
{{data.theme.a1.addon_button_bc? "background-color:"+data.theme.a1.addon_button_bc+";" : "background-color: #4d90fe;
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: linear-gradient(top,#4d90fe,#4787ed);"}}
width: {{data.theme.a1.addon_button_w}}px;
height: {{data.theme.a1.addon_button_h||'45'}}px;
border: {{data.theme.a1.addon_button_bor||'1'}}px solid {{data.theme.a1.addon_button_borc||'#3079ed'}};
}
#wpmchimpaw .addon_button:hover{
color: {{data.theme.a1.addon_button_fch}};
background-color: {{data.theme.a1.addon_button_bch}};
}

.addon_spinner {
height: 40px;
width: 40px;
display: inline-block;
margin-top: 15px;
left: -webkit-calc(50% - 20px);
left: -moz-calc(50% - 20px);
left: -o-calc(50% - 20px);
left: calc(50% - 20px);
position: relative;
border: 2px solid {{data.theme.a1.addon_spinner_c||'#000'}};
-webkit-border-radius: 50%; 
-moz-border-radius: 50%; 
-ms-border-radius: 50%; 
-o-border-radius: 50%; 
border-radius: 50%; 
}

.addon_status{
position: relative;
font-size: 18px;
margin-bottom: 15px;
}

#wpmchimpaw .wpmchimpa-tag{
display: {{data.theme.a1.addon_tag_en? 'block':'none'}};
}
#wpmchimpaw .wpmchimpa-tag,
#wpmchimpaw .wpmchimpa-tag *{
pointer-events: none;
text-align: center;
color: {{data.theme.a1.addon_tag_fc||'#000'}};
font-size: {{data.theme.a1.addon_tag_fs||'10'}}px;
font-weight: {{data.theme.a1.addon_tag_fw||'500'}};
font-family:Arial;
font-family: {{data.theme.a1.addon_tag_f | livepf}};
font-style: {{data.theme.a1.addon_tag_fst}};
}
#wpmchimpaw .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.a1.addon_tag_fs||10,data.theme.a1.addon_tag_fc||'#000')}};
margin: 5px;
top: 1px;
position: relative;
}
#wpmchimpaw .wpmchimpa-social{
display: block;
}
#wpmchimpaw .wpmchimpa-social::before{
content:"{{data.theme.a1.addon_soc_head||'Subscribe with'}}";
line-height: 30px;
display: block;
color: {{data.theme.a1.addon_soc_fc||'#b3b3b3'}};
font-size: {{data.theme.a1.addon_soc_fs||'20'}}px;
font-weight: {{data.theme.a1.addon_soc_fw}};
font-family: {{(data.theme.a1.addon_soc_f | livepf)}};
font-style: {{data.theme.a1.addon_soc_fst}};
}

#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc{
margin: 5px;
cursor: pointer;
width:150px;
height: 35px;
margin-bottom: 5px;
border-radius: 5px;
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 4px 6px;
padding: 0px 5px;
display: inline-block;
border-right: 1px solid #cccccc;
height: 23px;
}

#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc::after{
position: absolute;
line-height: 35px;
padding-left: 10px;
color: #fff;
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

#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::after {
    content:"Facebook";
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::after {
    content:"Google Plus";
}
#wpmchimpaw .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::after {
    content:"Outlook";
}

</style>

<div id="wpmchimpaw">
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="10" data-lhint="Go to Additional Theme Options" style="margin:-30px">7</div>
        <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Custom Message Settings">1</div>
            <div class="addon_heading">{{data.theme.a1.addon_heading}}</div>
            <div class="addon_msg"><p ng-bind-html="data.theme.a1.addon_msg | safe"></p></div>
            </div>
        <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
        <div class="wpmchimpa" id="wpmchimpa">            
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Text Box Settings" style="right: -50px;">2</div>
              <div class="addon_tbox"><div class="in-name">Name</div></div>
              <div class="addon_tbox"><div class="in-mail">Email address</div></div>
            </div>
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Checkbox Settings" style="left: 10px;">3</div>
              <div class="wpmchimpa-groups">
                <div class="addon_check_c"></div>
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
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="6" data-lhint="Go to Button Settings" style="right: -50px;">4</div>
              <div class="addon_button">{{data.theme.a1.addon_button}}</div>
            </div>
          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="9" data-lhint="Go to Tag Settings">5</div>
          <div class="wpmchimpa-tag" ng-bind-html="data.theme.a1.addon_tag||'Secure and Spam free...' | safe"></div></div>
            <div>
              <div class="addon_spinner"><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Spinner Settings" style="margin:25%">6</div></div>
            </div>
            
          </div>

     
           
  </div>
</div>
