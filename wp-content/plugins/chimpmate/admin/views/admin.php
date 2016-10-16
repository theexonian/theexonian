<div class="wrap wpmca_home" ng-app="chimpmate" ng-controller="chimpmateController">
	<div class="wpmca_header">
		<div class="h_left">
			<div class="h_container l h_left">
				<div class="wpmca_logo"></div>
			</div>
			<div class="h_container h_right">
				<div class="button_cont">
					<button class="wpmca_button button_header blue material-design" id="sup_button">support</button>
					<button class="wpmca_button button_header blue material-design" id="faq_button">faq</button>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" id="donate_form" style="display:inline-block">
						<input type="hidden" name="cmd" value="_donations">
						<input type="hidden" name="business" value="jpolachan@gmail.com">
						<input type="hidden" name="lc" value="US">
						<input type="hidden" name="item_name" value="Voltroid ChimpMate - WordPress MailChimp Assistant">
						<input type="hidden" name="no_note" value="0">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
						<button class="wpmca_button button_header green material-design" ng-click="wpmchimpa_donate()">donate</button>
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" style="display:none">
					</form>
				</div>
			</div>
		</div>
		<div class="h_right">
			<div class="h_left wpmc_social">
				<div class="wpmc_soc_cont fb">
					<a href="https://www.facebook.com/Voltroid"><div class="wpmc_socioicon"></div></a>
			 <!--   <div class="wp_likebox">
						<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=174296672696220&version=v2.0"; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-like" data-href="https://www.facebook.com/Voltroid" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>-->
				</div>
				<div class="wpmc_soc_cont tt">
					<a href="https://twitter.com/Voltroid"><div class="wpmc_socioicon"></div></a>
			 <!--   <div class="wp_likebox" style="margin-left: -7px;">
						<a href="https://twitter.com/Voltroid" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false" data-dnt="true"></a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>-->
				</div>
				<div class="wpmc_soc_cont gp">
					<a href="https://plus.google.com/+VoltroidInc"><div class="wpmc_socioicon"></div></a>
			 <!--   <div class="wp_likebox" style="margin-left: -15px;">
						<script src="https://apis.google.com/js/platform.js" async defer></script>
						<div class="g-follow" data-annotation="none" data-height="20" data-width="60" data-href="https://plus.google.com/+VoltroidInc" data-rel="publisher"></div></div>
		-->    </div>
			</div> 
			<div class="header_voltriod h_right">
					<span class="voltroid"></span>
					<span class="apanel"></span>
					<div class="vlogo">
					</div>
			 </div>
		</div>
	</div> 
	<div class="wpmca_toolbar">
		<div class="wpmca_tabs">
			<ul>
				<li class="tabitem active material-design"><a href="#general" data-title="general">GENERAL</a></li>
				<li class="tabitem material-design"><a href="#lightbox" data-title="lightbox">LIGHTBOX</a></li>
				<li class="tabitem material-design"><a href="#slider" data-title="slider">SLIDER</a></li>
				<li class="tabitem material-design"><a href="#widget" data-title="widget">WIDGET</a></li>
				<li class="tabitem material-design"><a href="#addon" data-title="addon">ADD-ON</a></li>
				<li class="tabitem material-design"><a href="#advanced" data-title="advanced">ADVANCED</a></li>
			</ul>
		</div>
		<button class="wpmca_button red material-design" ng-click="update_options()">Update Options</button>
		<div class="wpcmaloading_container">
			<div class="wpmcaspinner">
				<svg class="circular">
					<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/>
				</svg>
			</div>
			<div class="wpmca_status">
			</div>                
		</div>
	</div>  
	<div class="wpmca_content">
		<div class="divloader"><div class="divload"><div class="divload1"></div><div class="divload2"></div><div class="divload3"></div><div class="divload4"></div><div class="divload5"></div></div></div>

		<div id="general" class="wpmca_box show materialcard">

		</div>
		<div id="lightbox" class="wpmca_box materialcard">

		</div>
		<div id="slider" class="wpmca_box materialcard">

		</div>
		<div id="widget" class="wpmca_box materialcard">

		</div>
		<div id="addon" class="wpmca_box materialcard">

		</div>
		<div id="advanced" class="wpmca_box materialcard">

		</div>
	</div> 
</div>