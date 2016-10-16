<style type="text/css">
.wpmca_viewport * {
  box-sizing: border-box;
}

#wpmchimpab {
text-align: center;
min-height: 100px;
display: inline-block;
border-width: 1px 0;
width: 495px;
left: 50px;
top: 200px;
position: relative;
background: {{data.theme.a8.addon_bg_c||'#262E43'}};
border: {{data.theme.a8.addon_bor_w||0}}px solid {{data.theme.a8.addon_bor_c||'#000'}};
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
}
#wpmchimpab .addon_heading{
padding-top:20px;
color: {{data.theme.a8.addon_heading_fc||'#fff'}};
font-size: {{data.theme.a8.addon_heading_fs||'20'}}px;
font-weight: {{data.theme.a8.addon_heading_fw}};
font-family: {{data.theme.a8.addon_heading_f | livepf}};
font-style: {{data.theme.a8.addon_heading_fst}};
}
#wpmchimpab .addon_msg, #wpmchimpab .addon_msg *{
color: #ADBBE0;
font-size: {{data.theme.a8.addon_msg_fs||'12'}}px;
font-family: {{data.theme.a8.addon_msg_f | livepf}};
}
#wpmchimpab .addon_msg{
  margin: 15px 30px 0;
}
#wpmchimpab .wpmchimpa{
margin-top: 20px;
}
#wpmchimpab .wpmchimpa_formbox{
margin: 0 auto;
width: calc(100% - 50px);
}
#wpmchimpab .wpmchimpa_formbox > div{
position: relative;
}
#wpmchimpab .addon_tbox{
text-align: left;
margin-bottom: 10px;
width: 100%;
 padding: 0 10px;
border-radius: 3px;
outline:0;
display: block;
color: {{data.theme.a8.addon_tbox_fc||'#353535'}};
font-size: {{data.theme.a8.addon_tbox_fs||'17'}}px;
font-weight: {{data.theme.a8.addon_tbox_fw}};
font-family: {{data.theme.a8.addon_tbox_f | livepf}};
font-style: {{data.theme.a8.addon_tbox_fst}};
background-color: {{data.theme.a8.addon_tbox_bgc||'#fff'}};
width: {{data.theme.a8.addon_tbox_w}}px;
height: {{data.theme.a8.addon_tbox_h||'40'}}px;
line-height: {{data.theme.a8.addon_tbox_h||'40'}}px;
border: {{data.theme.a8.addon_tbox_bor||''}}px solid {{data.theme.a8.addon_tbox_borc||'#efefef'}};
}
#wpmchimpab .wpmchimpa-groups{
display: block;
  margin:12px auto 0;
}
#wpmchimpab .wpmchimpa-item{
display:inline-block;
  margin: 2px 15px;
}
#wpmchimpab .addon_check {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 30px;
line-height: 14px;
min-width: 100px;
}
#wpmchimpab .addon_check .cbox{
display: inline-block;
width: 12px;
height: 12px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
transition: all 0.3s ease-in-out;
background-color:#fff;
box-shadow: 0 0 1px 1px {{data.theme.a8.addon_check_borc||'#ccc'}};
}
#wpmchimpab .addon_check .ctext{
color: {{data.theme.a8.addon_check_fc||'#fff'}};
font-size: {{data.theme.a8.addon_check_fs}}px;
font-weight: {{data.theme.a8.addon_check_fw}};
font-family: {{data.theme.a8.addon_check_f | livepf}};
font-style: {{data.theme.a8.addon_check_fst}};
}
#wpmchimpab .addon_check .cbox.checked{
background-color: {{data.theme.a8.addon_check_c}};
}
#wpmchimpab .addon_check .cbox.checked:after,#wpmchimpab .addon_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.a8.addon_check_shade | chshade}};
margin: -4px;
display: block;
}
#wpmchimpab .addon_check:hover .cbox:after{
opacity: 0.5;
}
#wpmchimpab .addon_button{
border-radius: 3px;
width: 100%;
text-align: center;
cursor: pointer;
color: {{data.theme.a8.addon_button_fc||'#fff'}};
font-size: {{data.theme.a8.addon_button_fs || "17"}}px;
font-weight: {{data.theme.a8.addon_button_fw}};
font-family: {{data.theme.a8.addon_button_f | livepf}};
font-style: {{data.theme.a8.addon_button_fst}};
background-color:{{data.theme.a8.addon_button_bc||'#73C557'}};
width: {{data.theme.a8.addon_button_w}}px;
height: {{data.theme.a8.addon_button_h||'42'}}px;
line-height: {{data.theme.a8.addon_button_h||'42'}}px;
-webkit-border-radius: {{data.theme.a8.addon_button_br||'3'}}px;
-moz-border-radius: {{data.theme.a8.addon_button_br||'3'}}px;
border-radius: {{data.theme.a8.addon_button_br||'3'}}px;
border: {{data.theme.a8.addon_button_bor||'1'}}px solid {{data.theme.a8.addon_button_borc||'#50B059'}};
}
#wpmchimpab .addon_button:hover{
color: {{data.theme.a8.addon_button_fch}};
background-color: {{data.theme.a8.addon_button_bch||'#50B059'}};
}

#wpmchimpab .addon_button+div{
position: absolute;
top: 0;
right: 0;
}
.addon_spinner {
top: 0;
right: 0;
margin: 6px 5px;
-webkit-transform: scale(0.8);
-ms-transform: scale(0.8);
transform: scale(0.8);
}

#wpmchimpab .sp3 {width: 40px;height: 40px;position: relative;margin: -5px auto;}#wpmchimpab .sp3:before, #wpmchimpab .sp3:after {content: "";width: 100%;height: 100%;border-radius: 50%;background-color: {{data.theme.a8.addon_spinner_c||'#000'}};opacity: 0.6;position: absolute;top: 0;left: 0;-webkit-animation: wpmchimpabsp3 2.0s infinite ease-in-out;animation: wpmchimpabsp3 2.0s infinite ease-in-out;}#wpmchimpab .sp3:after {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}@-webkit-keyframes wpmchimpabsp3 {0%, 100% { -webkit-transform: scale(0) }50% { -webkit-transform: scale(1) }}@keyframes wpmchimpabsp3 {0%, 100% {transform: scale(0)}50% {transform: scale(1)}}

#wpmchimpab .wpmchimpa-socialc{
overflow: hidden;
}
#wpmchimpab .wpmchimpa-social{
display: inline-block;
margin: 12px auto 0;
height: 90px;
width: 100%;
background: rgba(75, 75, 75, 0.3);
box-shadow: 0px 1px 1px 1px rgba(116, 116, 116, 0.94);
}
#wpmchimpab .wpmchimpa-social::before{
content:"{{data.theme.a8.addon_soc_head||'Subscribe with'}}";
width: 100%;
display: block;
margin: 15px auto 5px;
color: {{data.theme.a8.addon_soc_fc||'#ADACB2'}};
font-size: {{data.theme.a8.addon_soc_fs||'13'}}px;
line-height: {{data.theme.a8.addon_soc_fs||'13'}}px;
font-weight: {{data.theme.a8.addon_soc_fw}};
font-family: {{(data.theme.a8.addon_soc_f | livepf)}};
font-style: {{data.theme.a8.addon_soc_fst}};
}

#wpmchimpab .wpmchimpa-social .wpmchimpa-soc{
display: inline-block;
width:40px;
height: 40px;
border-radius: 2px;
cursor: pointer;
border:1px solid {{data.theme.a8.addon_bg_c || '#262E43'}};
}
#wpmchimpab .wpmchimpa-social .wpmchimpa-soc::before{
content: '';
display: block;
width:40px;
height: 40px;
background: no-repeat center;
}

#wpmchimpab .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
background-image: <?php echo $this->plugin->getIcon('fb',20,'#fff');?>
}
#wpmchimpab .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb:hover:before {
background-image: <?php echo $this->plugin->getIcon('fb',20,'#2d609b');?>
}
#wpmchimpab .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
background-image: <?php echo $this->plugin->getIcon('gp',20,'#fff');?>;
}
#wpmchimpab .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp:hover:before {
background-image: <?php echo $this->plugin->getIcon('gp',20,'#eb4026');?>;
}
#wpmchimpab .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
background-image: <?php echo $this->plugin->getIcon('ms',20,'#fff');?>
}
#wpmchimpab .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms:hover:before {
background-image: <?php echo $this->plugin->getIcon('ms',20,'#00BCF2');?>
}

#wpmchimpab .wpmchimpa-tag{
margin: 5px auto;
display: {{data.theme.a8.addon_tag_en? 'block':'none'}};
}
#wpmchimpab .wpmchimpa-tag,
#wpmchimpab .wpmchimpa-tag *{
pointer-events: none;
color: {{data.theme.a8.addon_tag_fc||'#68728D'}};
font-size: {{data.theme.a8.addon_tag_fs||'10'}}px;
font-weight: {{data.theme.a8.addon_tag_fw}};
font-family:Arial;
font-family: {{data.theme.a8.addon_tag_f | livepf}};
font-style: {{data.theme.a8.addon_tag_fst}};
}
#wpmchimpab .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.a8.addon_tag_fs||10,data.theme.a8.addon_tag_fc||'#68728D')}};
margin: 5px;
top: 1px;
position: relative;
}
#wpmchimpab.wosoc .wpmchimpa-social {
display: none;
}
</style>

<div id="wpmchimpab" class="wpmchimpab"  ng-class="{'wosoc':data.theme.a8.addon_dissoc}">
  <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="10" data-lhint="Go to Additional Theme Options" style="margin:-30px">7</div>
        
          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Custom Message Settings">1</div>
            <div class="addon_heading">{{data.theme.a8.addon_heading}}</div>
            <div class="addon_msg"><p ng-bind-html="data.theme.a8.addon_msg | safe"></p></div>
            </div>
        <div class="wpmchimpa" id="wpmchimpa">  
              <div class="wpmchimpa_formbox">
          
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Text Box Settings" style="right: -50px;">2</div>
              <div class="addon_tbox">Name</div>
              <div class="addon_tbox">Email address</div>
            </div>
            <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="6" data-lhint="Go to Button Settings" style="right: -50px;">3</div>
              <div class="addon_button">{{data.theme.a8.addon_button}}</div>
              <div>
                <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Spinner Settings" style="right: -50px;top:25px">4</div>
                <div class="addon_spinner"><div class="sp3"></div></div>
              </div>
            </div>
            <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Checkbox Settings" style="left: 10px;">5</div>
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
          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Tag Settings">6</div>
          <div class="wpmchimpa-tag" ng-bind-html="data.theme.a8.addon_tag||'Secure and Spam free...' | safe"></div></div>
            </div>
            <div class="wpmchimpa-socialc">
              <div class="wpmchimpa-social">
                  <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                  <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                  <div class="wpmchimpa-soc wpmchimpa-ms"></div>
              </div>
            </div>
            
          </div>

     
           
  </div>
</div>
