<style type="text/css">
.wpmca_viewport * {
  box-sizing: border-box;
}
.wpmchimpa-overlay-bg {
background: rgba(0,0,0,{{data.theme.l8.lite_bg_op/100 ||'0.4'}});
height: 778px;
width: 1024px;
}

.wpmchimpa-overlay-bg #wpmchimpa-main {
width:350px;
background: {{data.theme.l8.lite_bg_c || '#262E43'}};
display: inline-block;
position: relative;
left: 50%;
margin: 100px auto;
border-radius: 2px;
text-align: center;
-webkit-transform: translatex(-50% );
-moz-transform: translatex(-50% );
-ms-transform: translatex(-50% );
-o-transform: translatex(-50% );
transform: translatex(-50% );
}

#wpmchimpa .lite_heading{
margin-top:20px;
color: {{data.theme.l8.lite_heading_fc||'#fff'}};
font-size: {{data.theme.l8.lite_heading_fs||'20'}}px;
line-height: {{data.theme.l8.lite_heading_fs||'20'}}px;
font-weight: {{data.theme.l8.lite_heading_fw}};
font-family: {{data.theme.l8.lite_heading_f | livepf}};
font-style: {{data.theme.l8.lite_heading_fst}};
}
#wpmchimpa .lite_msg,#wpmchimpa .lite_msg *{
color: #ADBBE0;
font-size: {{data.theme.l8.lite_msg_fs||'12'}}px;
font-family: {{data.theme.l8.lite_msg_f | livepf}};
}
#wpmchimpa .lite_msg{
	margin: 15px 30px 0;
}
#wpmchimpa .wpmchimpa_form{
margin-top: 20px;
}

#wpmchimpa .wpmchimpa_formbox{
margin: 0 auto;
width: calc(100% - 50px);
}
#wpmchimpa .wpmchimpa_formbox > div{
position: relative;
}
#wpmchimpa .lite_tbox{
text-align: left;
margin-bottom: 10px;
width: 100%;
 padding: 0 10px;
border-radius: 3px;
outline:0;
display: block;
color: {{data.theme.l8.lite_tbox_fc||'#353535'}};
font-size: {{data.theme.l8.lite_tbox_fs||'17'}}px;
font-weight: {{data.theme.l8.lite_tbox_fw}};
font-family:Arial;
font-family: {{data.theme.l8.lite_tbox_f | livepf}};
font-style: {{data.theme.l8.lite_tbox_fst}};
background-color: {{data.theme.l8.lite_tbox_bgc||'#fff'}};
width: {{data.theme.l8.lite_tbox_w}}px;
height: {{data.theme.l8.lite_tbox_h||'40'}}px;
line-height: {{data.theme.l8.lite_tbox_h||'40'}}px;
border: {{data.theme.l8.lite_tbox_bor||'1'}}px solid {{data.theme.l8.lite_tbox_borc||'#efefef'}};
}
#wpmchimpa .lite_tbox div{
top: 50%;
-webkit-transform: translatey(-50% );
-moz-transform: translatey(-50% );
-ms-transform: translatey(-50% );
-o-transform: translatey(-50% );
transform: translatey(-50% );
position: relative;
}
#wpmchimpa .wpmchimpa-groups{
display: block;
margin:15px auto;
}
#wpmchimpa .wpmchimpa-item{
display:inline-block;
margin: 2px 15px;
}
#wpmchimpa .lite_check {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 30px;
line-height: 14px;
min-width: 100px;
}
#wpmchimpa .lite_check .cbox{
display: inline-block;
width: 12px;
height: 12px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
transition: all 0.3s ease-in-out;
background-color:#fff;
box-shadow: 0 0 1px 1px {{data.theme.l8.lite_check_borc||'#ccc'}};
}
#wpmchimpa .lite_check .ctext{
color: {{data.theme.l8.lite_check_fc||'#fff'}};
font-size: {{data.theme.l8.lite_check_fs}}px;
font-weight: {{data.theme.l8.lite_check_fw}};
font-family: {{data.theme.l8.lite_check_f | livepf}};
font-style: {{data.theme.l8.lite_check_fst}};
}
#wpmchimpa .lite_check .cbox.checked{
background-color: {{data.theme.l8.lite_check_c}};
}
#wpmchimpa .lite_check .cbox.checked:after,#wpmchimpa .lite_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.l8.lite_check_shade | chshade}};
margin: -4px;
display: block;
}
#wpmchimpa .lite_check:hover .cbox:after{
opacity: 0.5;
}

#wpmchimpa .lite_button{
width: 100%;
text-align: center;
cursor: pointer;
color: {{data.theme.l8.lite_button_fc||'#fff'}};
font-size: {{data.theme.l8.lite_button_fs || "17"}}px;
font-weight: {{data.theme.l8.lite_button_fw}};
font-family: {{data.theme.l8.lite_button_f | livepf}};
font-style: {{data.theme.l8.lite_button_fst}};
background-color:{{data.theme.l8.lite_button_bc||'#73C557'}};
width: {{data.theme.l8.lite_button_w}}px;
height: {{data.theme.l8.lite_button_h||'42'}}px;
line-height: {{data.theme.l8.lite_button_h||'42'}}px;
-webkit-border-radius: {{data.theme.l8.lite_button_br||'3'}}px;
-moz-border-radius: {{data.theme.l8.lite_button_br||'3'}}px;
border-radius: {{data.theme.l8.lite_button_br||'3'}}px;
border: {{data.theme.l8.lite_button_bor||'1'}}px solid {{data.theme.l8.lite_button_borc||'#50B059'}};
}
#wpmchimpa .lite_button:hover{
color: {{data.theme.l8.lite_button_fch}};
background-color: {{data.theme.l8.lite_button_bch||'#50B059'}};
}
#wpmchimpa .lite_button+div{
position: absolute;
top: 0;
right: 0;
}
#wpmchimpa-main .wpmchimpa-close-button{
position: absolute;
display: block;
top: 0;
right: 0;
width: 25px;
text-align: center;
cursor: pointer;
}
#wpmchimpa-main .wpmchimpa-close-button::before{
content: "\00D7";
font-size: 25px;
line-height: 25px;
font-weight: 100;
color: {{data.theme.l8.lite_close_col||'#999'}};
opacity: 0.4;
}
#wpmchimpa-main .wpmchimpa-close-button:hover:before{
opacity: 1;
}

.lite_spinner {
top: 0;
right: 0;
margin: 6px 5px;
-webkit-transform: scale(0.8);
-ms-transform: scale(0.8);
transform: scale(0.8);
}

#wpmchimpa-main .sp3 {width: 40px;height: 40px;position: relative;margin: -5px auto;}#wpmchimpa-main .sp3:before, #wpmchimpa-main .sp3:after {content: "";width: 100%;height: 100%;border-radius: 50%;background-color: {{data.theme.l8.lite_spinner_c||'#000'}};opacity: 0.6;position: absolute;top: 0;left: 0;-webkit-animation: wpmchimpa-mainsp3 2.0s infinite ease-in-out;animation: wpmchimpa-mainsp3 2.0s infinite ease-in-out;}#wpmchimpa-main .sp3:after {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}@-webkit-keyframes wpmchimpa-mainsp3 {0%, 100% { -webkit-transform: scale(0) }50% { -webkit-transform: scale(1) }}@keyframes wpmchimpa-mainsp3 {0%, 100% {transform: scale(0)}50% {transform: scale(1)}}

#wpmchimpa-main .wpmchimpa-socialc{
overflow: hidden;
}
#wpmchimpa-main .wpmchimpa-social{
display: inline-block;
margin: 12px auto 0;
height: 90px;
width: 100%;
background: rgba(75, 75, 75, 0.3);
box-shadow: 0px 1px 1px 1px rgba(116, 116, 116, 0.94);
}
#wpmchimpa-main .wpmchimpa-social::before{
content:"{{data.theme.l8.lite_soc_head||'Subscribe with'}}";
width: 100%;
display: block;
margin: 15px auto 5px;
color: {{data.theme.l8.lite_soc_fc||'#ADACB2'}};
font-size: {{data.theme.l8.lite_soc_fs||'13'}}px;
line-height: {{data.theme.l8.lite_soc_fs||'13'}}px;
font-weight: {{data.theme.l8.lite_soc_fw}};
font-family: {{(data.theme.l8.lite_soc_f | livepf)}};
font-style: {{data.theme.l8.lite_soc_fst}};
}

#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc{
display: inline-block;
width:40px;
height: 40px;
border-radius: 2px;
cursor: pointer;
border:1px solid {{data.theme.l8.lite_bg_c || '#262E43'}};
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc::before{
content: '';
display: block;
width:40px;
height: 40px;
background: no-repeat center;
}

#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
background-image: <?php echo $this->plugin->getIcon('fb',20,'#fff');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb:hover:before {
background-image: <?php echo $this->plugin->getIcon('fb',20,'#2d609b');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
background-image: <?php echo $this->plugin->getIcon('gp',20,'#fff');?>;
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp:hover:before {
background-image: <?php echo $this->plugin->getIcon('gp',20,'#eb4026');?>;
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
background-image: <?php echo $this->plugin->getIcon('ms',20,'#fff');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms:hover:before {
background-image: <?php echo $this->plugin->getIcon('ms',20,'#00BCF2');?>
}

#wpmchimpa .wpmchimpa-tag{
margin: 5px auto;
display: {{data.theme.l8.lite_tag_en? 'block':'none'}};
}
#wpmchimpa .wpmchimpa-tag,
#wpmchimpa .wpmchimpa-tag *{
pointer-events: none;
color: {{data.theme.l8.lite_tag_fc||'#68728D'}};
font-size: {{data.theme.l8.lite_tag_fs||'10'}}px;
font-weight: {{data.theme.l8.lite_tag_fw}};
font-family:Arial;
font-family: {{data.theme.l8.lite_tag_f | livepf}};
font-style: {{data.theme.l8.lite_tag_fst}};
}
#wpmchimpa .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.l8.lite_tag_fs||10,data.theme.l8.lite_tag_fc||'#68728D')}};
margin: 5px;
top: 1px;
position: relative;
}
#wpmchimpa-main.wosoc .wpmchimpa-social {
display: none;
}
</style>

<div class="wpmchimpa-overlay-bg wpmchimpa-wrapper" id="lightbox1">
	<div id="wpmchimpa-main" ng-class="{'wosoc':data.theme.l8.lite_dissoc}">
        <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="8" data-lhint="Go to Additional Theme Options" style="margin:15px;top:0">7</div>
		<div id="wpmchimpa-newsletterform">
			<div class="wpmchimpa" id="wpmchimpa">
    			<div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="1" data-lhint="Go to Custom Message Settings">1</div>
            <div class="lite_heading">{{data.theme.l8.lite_heading}}</div>
      			<div class="lite_msg"><p ng-bind-html="data.theme.l8.lite_msg | safe"></p></div>
          </div>
          <div class="wpmchimpa_form">
          <div class="wpmchimpa_formbox">
          <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="2" data-lhint="Go to Text Box Settings" style="right: -20px;">2</div>
            <div class="lite_tbox">Name</div>
      			<div class="lite_tbox">Email address</div>
          </div>
          <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Button Settings" style="right: -20px;">4</div>
    		<div class="lite_button">{{data.theme.l8.lite_button}}</div>
    		<div>
	          	<div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Spinner Settings" style="right: -20px;top: 25px;">5</div>
	          	<div class="lite_spinner"><div class="sp3"></div></div>
	        </div>
          </div>

          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Checkbox Settings">3</div>
         		<div class="wpmchimpa-groups">
              <div class="lite_check_c"></div>
              <div class="wpmchimpa-item">
                  <div class="lite_check">
                    <div class="cbox"></div>
                    <div class="ctext">group1</div>
                  </div>
              </div>
              <div class="wpmchimpa-item">
                  <div class="lite_check">
                    <div class="cbox checked"></div>
                    <div class="ctext">group2</div>
                  </div>
              </div>
            </div>
          </div>
			<div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Tag Settings">6</div>
	    		<div class="wpmchimpa-tag" ng-bind-html="data.theme.l8.lite_tag||'Secure and Spam free...' | safe"></div></div>
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
      <div class="wpmchimpa-close-button"></div>
	</div>        
</div>