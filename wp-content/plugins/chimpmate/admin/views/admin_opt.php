<?php
switch($tab){
	case 'general':
?>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Connection Settings</h2>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" id="api_key" required ng-model="data.api_key">
		<span class="wpmcahint" data-hint="Enter your API Key"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>API Key</label>
	</div>
	<div class="wpmca_group">
			<div class="wpmcapara hinted">Click <a href="https://admin.mailchimp.com/account/api/" target="_blank" class="wpmclink">here</a> to get API key or Sign up <a href="http://eepurl.com/4lavL" class="wpmclink">here</a></div>
		</div>
	<div class="wpmca_group">
			<button class="wpmca_button green material-design" ng-click="api_verify()">Get Lists</button>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Custom Forms</h2>
	</div>
	<div class="wpmca_group wpmca_table_cont">
		<div class="wpmca_table">
			<div class="wpmca_tablehg">
				<div class="wpmca_tabler">
					<div>No</div>
					<div style="width: 100px;">Form</div>
					<div>List</div>
					<div>Options</div>
				</div>
			</div>
			<div class="wpmca_tablerg">
				<div class="wpmca_tabler" ng-repeat="cform in data.cforms track by $index">
					<div>{{$index + 1}}</div>
					<div>
						<input type="text" class="wpmc_tabtext" required ng-model="cform.name">
						<div class="bar"></div>
					</div>
					<div>
						<div class="wpmc_drop">
							<div class="wpmc_drop_head"><div>{{cform.list.name || (data.lists.length?'Select List':'No Lists')}}</div>
								<div class="bar"></div>
							</div>
							<div class="wpmc_drop_body">
								<div ng-repeat="list in data.lists" ng-click="drop_sel('list',$parent.$index,$index)" ng-class="{'drop-sel': list.id==cform.list.id }">{{list.name}}</div>
							</div>
						</div>
					</div>
					<div>
						<!--<div class="mul_ico mul_del" ng-click="del_form(0,$index)"></div>-->
						<div class="mul_ico mul_edit" ng-click="edit_form(0,$index)" ng-show="cform.list"></div>
					</div>
				</div>
			</div>
		</div>
		<!--<div class="wpmca_table_foot">
			<div class="wpmca_conbox blue add" ng-click="del_form(3)"></div>
			<div style="clear:both"></div>
		</div>-->
	</div>
	<div class="wpmca_group selcon" ng-show="formselcon>-1">
		<div class="selconmsg">Are you sure you want to delete {{cforms[formselcon].name}}?</div>
		<div class="wpmca_conbox confirm" ng-click="del_form(1)"></div>
		<div class="wpmca_conbox decline" ng-click="del_form(2)"></div>
		<div style="clear:both"></div>
	</div>
	<div class="wpmca_group wpmca_table_cont wpmcatxts wpmcacm" ng-show="formedit>-1">
		<div class="wpmca_table">
			<div class="wpmca_tablehg">
				<div class="wpmca_tabler">
					<div></div>
					<div>Icon</div>
					<div>Label</div>
					<div>Field</div>
					<div>Required</div>
					<div></div>
				</div>
			</div>
			<div class="wpmca_tablerg" as-sortable="sortableOptions" ng-model="cform.fields">
				<div class="wpmca_tabler" ng-repeat="cfield in cform.fields" as-sortable-item class="as-sortable-item mulfieldr">
					<div as-sortable-item-handle class="as-sortable-item-handle"></div>
					<div class="ico_sel">
						<div class="wpmc_drop" ng-hide="cfield.cat == 'group' || ['checkboxes','radio','dropdown','address'].indexOf(cfield.type) != -1">
							<div class="wpmc_drop_head"><div ng-class="cfield.icon"></div>
								<div class="bar"></div>
							</div>
							<div class="wpmc_drop_body">
								<div class="longcell inone" ng-click="cfield.icon='inone'" ng-class="{'drop-sel': cfield.icon=='inone' }"></div>
								<div class="longcell idef" ng-click="cfield.icon='idef'" ng-class="{'drop-sel': cfield.icon=='idef' }"></div>
								<div ng-repeat="(k, v) in icons" ng-click="cfield.icon=k" class="{{k}}" ng-class="{'drop-sel': k == cfield.icon }"></div>
							</div>
						</div>
					</div>
					<div>
						<input type="text" class="wpmc_tabtext" required ng-model="cfield.label">
						<div class="bar"></div>
					</div>
					<div>
						<div class="wpmc_drop wpmc_dropf">
							<div class="wpmc_drop_head"><div>{{cfield.name || (cfields.length?'Select Field':'No Field')}}</div>
								<div class="bar"></div>
							</div>
							<div class="wpmc_drop_body">
								<div ng-repeat="field in cfields" ng-click="drop_sel('field',$parent.$index,$index,$event)" ng-class="{ 'drop-group': fieldisgroup(field), 'drop-dis': fieldisused(field), 'drop-sel': field.id?field.id==cfield.id:field.tag==cfield.tag }">{{field.name}}({{field.type}})</div>
							</div>
						</div>
					</div>
					<div>
						<label ng-hide="cfield.req" class="mcheckbox">
							<input type="checkbox" ng-model="cfield.foreq" ng-true-value="true">
							<div></div>
						</label>
					</div>
					<div><div class="mul_ico mul_del" ng-click="del_field(0,$index)" ng-hide="cfield.req"></div><div class="mul_ico mul_req" ng-show="cfield.req"></div></div>
				</div>
			</div>
		</div>
		<div class="wpmca_table_foot">
			<div class="wpmca_conbox blue add" ng-click="del_field(3)"></div>
				<div class="wpmca_conbox ok" ng-click="edit_form(1)"></div>
				<div class="wpmca_conbox cancel" ng-click="edit_form(2)"></div>
				<div style="clear:both"></div>
			</div>
		</div>
	<div class="wpmca_group selcon" ng-show="fieldselcon>-1">
		<div class="selconmsg">Are you sure you want to delete {{cform.fields[fieldselcon].name}}?</div>
		<div class="wpmca_conbox confirm" ng-click="del_field(1)"></div>
		<div class="wpmca_conbox decline" ng-click="del_field(2)"></div>
		<div style="clear:both"></div>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Other Options</h2>
	</div>
	<div class="wpmca_group">
		<div class="paper-toggle">
			<input type="checkbox" class="wpmcatoggle" id="opt-in" ng-model="data.opt_in" ng-true-value="'1'"/>
			<label for="opt-in">Double Opt-in Process</label>
		</div>
		<span class="wpmcahint" data-hint="Email Confirmation Message"></span>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Error Messages</h2>
		<span class="wpmcahint headhint" data-hint="Set Respective Error Messages"></span>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.errorrf">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Required Field</label>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.errorfe">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Invalid Entry</label>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.erroras">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Already subscribed</label>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.errorue">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Unknown error</label>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Social API Keys</h2>
		<span class="wpmcahint headhint" data-hint="Set Social API Keys for Subscribe with Social Logins(wherever applicable)"></span>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.fb_api">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Facebook App ID</label>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.gp_api">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Google App Client ID for Web</label>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.ms_api">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Microsoft App Client ID</label>
		Please provide the Redirect URI while creating a Microsoft App as :<br>
		<?php echo plugins_url( 'assets/ms-oauth.php', dirname(dirname(__FILE__)) );?>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>User Status</h2>
		<span class="wpmcahint headhint" data-hint="Show Subscription form if the user is?"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.loggedin">
		<div class="mcheckbox"></div>Logged-In</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.notloggedin">
		<div class="mcheckbox"></div>Not Logged-In</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.commented">
		<div class="mcheckbox"></div>Commented</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.notcommented">
		<div class="mcheckbox"></div>Not Commented</label>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Referrer</h2>
		<span class="wpmcahint headhint" data-hint="Only a visitor from those selected website categories, can view the Lightbox/Slider"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.searchengine">
		<div class="mcheckbox"></div>Search Engine</label>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>On Successful Subscription</h2>
		<span class="wpmcahint headhint" data-hint="What do on Successful Subscription?"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<input type="radio" value="suc_msg" ng-model="data.suc_sub">
	</div>
	<div class="wpmca_group p2 wpmcatxt suc_txt">
		<input type="text" class="wpmchimp_text" required ng-model="data.suc_msg"><span class="wpmcahint" data-hint="Enter a Message to Show Up"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Success Message</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<input type="radio" value="suc_url" ng-model="data.suc_sub">
	</div>
	<div class="wpmca_group p2 wpmcatxt suc_txt">
		<input type="text" class="wpmchimp_text" required ng-model="data.suc_url"><span class="wpmcahint" data-hint="Enter a URL to redirect"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Redirect to URL</label>
	</div>
	<div class="wpmca_group wpmcacb p3">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.suc_url_tab">
		<div class="mcheckbox"></div>Open in new tab</label>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>User Sync</h2>
		<span class="wpmcahint headhint" data-hint="Sync users from Website"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.usyn_com">
		<div class="mcheckbox"></div>Comment based Sync</label>
	</div>
	<div class="wpmca_group wpmc_dropc p2">
		<label>MailChimp List</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{data.usyn_coml.name || (data.lists.length?'Select List':'No Lists')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="list in data.lists" ng-click="data.usyn_coml = list">{{list.name}}</div>
			</div>
		</div>
	</div>
	<div class="wpmca_group wpmcacb p2" ng-show="data.usyn_com == 1">
		<label><input type="radio" value="1" ng-model="data.usyn_comp">
				With User's permission</label>
		<span class="wpmcahint" data-hint="Insert Checkbox near the Comment box"></span>
	</div>
	<div class="wpmca_group p3 wpmcatxt" ng-show="data.usyn_com == 1">
		<input type="text" class="wpmchimp_text" required ng-model="data.usyn_compt">
		<span class="wpmcahint" data-hint="Text for Checkbox"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Permission Text</label>
	</div>
	<div class="wpmca_group wpmcacb p2" ng-show="data.usyn_com == 1">
		<label><input type="radio" value="0" ng-model="data.usyn_comp">
				Without User's permission</label>
		<span class="wpmcahint" data-hint="Add to list directly"></span>
	</div>
	<div class="wpmca_group">
			<button class="wpmca_button green material-design wpmc_usync" ng-click="wpmc_usync('wpmchimpa_syncom',data.usyn_coml.id)">Sync Existing</button>
		<span class="wpmcahint" data-hint="Sync currently commented users to list"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.usyn_reg">
		<div class="mcheckbox"></div>Registration based Sync</label>
	</div>
	<div class="wpmca_group wpmc_dropc p2">
		<label>MailChimp List</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{data.usyn_regl.name || (data.lists.length?'Select List':'No Lists')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="list in data.lists" ng-click="data.usyn_regl = list">{{list.name}}</div>
			</div>
		</div>
	</div>
	<div class="wpmca_group wpmcacb p2" ng-show="data.usyn_reg == 1">
		<label><input type="radio" value="1" ng-model="data.usyn_regp">
				With User's permission</label>
		<span class="wpmcahint" data-hint="Insert Checkbox near the Sign-up box"></span>
	</div>
	<div class="wpmca_group p3 wpmcatxt" ng-show="data.usyn_reg == 1">
		<input type="text" class="wpmchimp_text" required ng-model="data.usyn_regpt">
		<span class="wpmcahint" data-hint="Text for Checkbox"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Permission Text</label>
	</div>
	<div class="wpmca_group wpmcacb p2" ng-show="data.usyn_reg == 1">
		<label><input type="radio" value="0" ng-model="data.usyn_regp">
				Without User's permission</label>
		<span class="wpmcahint" data-hint="Add to list directly"></span>
	</div>
	<div class="wpmca_group p2">
		<select id="usync_role" ng-model="data.usync_role" ng-multi-select multiple="multiple" ng-multi-select-placeholder="User roles" ng-multi-select-filter="false" ng-multi-select-width="300px">
<?php
global $wp_roles;
$all_roles = $wp_roles->roles;
foreach ($all_roles as $key => $value) {
echo '<option value="'.$key.'">'.$value['name'].'</option>';
} ?>
	</select>
	</div>
	<div class="wpmca_group">
			<button class="wpmca_button green material-design wpmc_usync"ng-click="wpmc_usync('wpmchimpa_synreg',data.usyn_regl.id,data.usync_role)">Sync Existing</button>
		<span class="wpmcahint" data-hint="Sync currently registered users to list"></span>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>News and Updates</h2>
		<span class="wpmcahint headhint" data-hint="Get Product Update &amp; News. It's secure and spam free..."></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.get_email_update">
		<div class="mcheckbox"></div>Get Email Updates</label>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" required ng-model="data.email_update">
		<span class="bar"></span>
		<label>Email Address</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.share_text">
		<div class="mcheckbox"></div>Keep Share Text Link enabled to make us happy :) </label>
		<span class="wpmcahint" data-hint="You can disable it if you wish :("></span>
	</div>
</div>
<?php
	break;
	case 'lightbox':
?>

<div class="wpmca_item">
	<div class="itemhead">
		<h2>Subscribe box in Lightbox</h2>
	</div>
	<div class="wpmca_group">
		<div class="paper-toggle">
			<input type="checkbox" id="litebox_en" ng-model="data.litebox" ng-true-value="'1'" class="wpmcatoggle"/>
			<label for="litebox_en">Enable</label>
		</div>
		<span class="wpmcahint" data-hint="Enable Lightbox"></span>
	</div>
	<div class="wpmca_group wpmc_dropc">
		<label>Custom Form</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getformbyid(data.lite_form).name || (data.cforms.length?'Select Form':'No Forms')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="form in data.cforms" ng-click="data.lite_form = form.id">{{form.name}}</div>
			</div>
		</div>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Select Theme</h2>
		<span class="wpmcahint headhint" data-hint="Select a theme for Lightbox"></span>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel themeswitcher" ng-change="themeswitcher('lightbox')" style="width: 260px;" ng-model="data.litebox_theme">
		<option value="0">Basic</option>
		<option value="1">Epsilon</option>
		<option value="8">Nova</option>
		<option value="9">Leo</option>
		<option disabled>Material - BUY PRO</option>
		<option disabled>Material Lite - BUY PRO</option>
		<option disabled>Onamy - BUY PRO</option>
		<option disabled>Smash - BUY PRO</option>
		<option disabled>Glow - BUY PRO</option>
		<option disabled>Unidesign - BUY PRO</option>
		</select>
	</div>
	<div class="wpmca_group">
		<button class="wpmca_button orange material-design" ng-click="vupre($event,data.litebox_theme)">Live Editor</button>
	</div>
</div>
<div class="wpmca_prev livelightbox">
<div class="wpmca_topbar">
<div class="wpmca_round" style="background:#f67a00"></div><div class="wpmca_round" style="background:#ebc71f"></div><div class="wpmca_round" style="background:#31bb37"></div><div class="wpmca_left"></div><div class="wpmca_right"></div><div class="wpmca_long"></div><div class="wpmca_search"></div><div class="wpmca_opts"></div>
</div>
<div class="wpmca_viewportbck">
<div class="wpmca_lineimg"></div>
<div class="wpmca_divide" style="left:33%"></div>
<div class="wpmca_divide" style="left:66%"></div>
<div ng-repeat="i in fontsiz.slice(0, 2)" class="wpmca_linecont">
	<div ng-repeat="i in fontsiz.slice(0, 10)" class="wpmca_line"></div></div>
</div>
<div class="wpmca_viewport"></div>
</div>
<div class="roundbutton bak2toprev hiderb material-design" ng-click="bak2toprev($event)"></div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Custom Message</h2>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" ng-model="data.theme['l'+data.litebox_theme].lite_heading" required>
		<span class="wpmcahint" data-hint="Heading for the Lightbox"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Heading</label>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_heading_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_heading_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_heading_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_heading_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
		<label>Font Color</label>
		<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_heading_fc"/>
	</div>
	<div class="wpmca_group"> 
		<div class="wpmcapara">Message
			<span class="wpmcahint" data-hint="Message for the Lightbox"></span>
		</div>
		<ng-quill-editor ng-model="data.theme['l'+data.litebox_theme].lite_msg" toolbar="true" link-tooltip="true" image-tooltip="true" toolbar-entries="bold list bullet italic underline strike align color background link image"></ng-quill-editor>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_msg_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_msg_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Text Box</h2>
	</div>
	<div class="wpmca_group">
	<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_fc"/>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Background Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_bgc"/>
	</div>
	<div class="wpmca_group wpmcatxts">	<label>Width</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_w">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
	<label>Height</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_h">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
	<label>Border Width</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_bor">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Border Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_tbox_borc"/>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Checkbox</h2>
	</div>
	<div class="wpmca_group wpmcacb">
	<label class="wpmcapara">Checkbox Theme</label>
	<div class="wpmca_compac p1">
		<input id="lc1" type="radio" value="1" ng-model="data.theme['l'+data.litebox_theme].lite_check_shade">
		<label for="lc1">Light <div class="checkbdemo litet"></div></label>
	</div>
	<div class="wpmca_compac">
		<input id="lc2" type="radio" value="2" ng-model="data.theme['l'+data.litebox_theme].lite_check_shade">
		<label for="lc2">Dark <div class="checkbdemo darkt"></div></label> 
	</div>
	<div style="clear:both"></div>
 </div>
	<div class="wpmca_group wpmcacolor">
	 <label>Theme Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_check_c"/>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Border Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_check_borc"/>
	</div>
	<div class="wpmca_group">
	<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_check_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_check_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_check_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_check_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_check_fc"/>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Button</h2>
	</div>
	<div class="wpmca_group wpmcatxt"> 
	<input type="text" class="wpmchimp_text" spellcheck="false" required	ng-model="data.theme['l'+data.litebox_theme].lite_button">
	<span class="highlighter"></span>
	<span class="bar"></span>
	<label>Button Text</label>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_button_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_button_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_button_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_button_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_button_fc"/>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Hover Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_button_fch"/>
	</div>
	<div class="wpmca_group wpmc_dropc ico_sel">
		<label>Icon</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div ng-class="data.theme['l'+data.litebox_theme].lite_button_i"></div>
				<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
				<div class="longcell inone" ng-click="data.theme['l'+data.litebox_theme].lite_button_i='inone'" ng-class="{'drop-sel': data.theme['l'+data.litebox_theme].lite_button_i=='inone' }"></div>
				<div class="longcell idef" ng-click="data.theme['l'+data.litebox_theme].lite_button_i='idef'" ng-class="{'drop-sel': data.theme['l'+data.litebox_theme].lite_button_i=='idef' }"></div>
				<div ng-repeat="(k, v) in icons" ng-click="data.theme['l'+data.litebox_theme].lite_button_i=k" class="{{k}}" ng-class="{'drop-sel': k == data.theme['l'+data.litebox_theme].lite_button_i }"></div>
			</div>
		</div>
	</div>
	<div class="wpmca_group wpmcatxts">	<label>Width</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_button_w">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
	<label>Height</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_button_h">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Background Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_button_bc"/>
	</div>
	<div class="wpmca_group wpmcacolor">
	<label>Hover Background Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_button_bch"/>
	</div>
	<div class="wpmca_group wpmcatxts"> 
	<label>Border Radius</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_button_br">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
	<label>Border Width</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.theme['l'+data.litebox_theme].lite_button_bor">
	<span>px</span>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Border Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_button_borc"/>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Spinner</h2>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Theme Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_spinner_c"/>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Status Message</h2>
		<span class="wpmcahint headhint" data-hint="Customize your Success or Error Message"></span>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_status_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_status_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_status_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_status_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_status_fc"/>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Tag</h2>
		<span class="wpmcahint headhint" data-hint="Customize your Tag"></span>
	</div>

	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['l'+data.litebox_theme].lite_tag_en" >
		<div class="mcheckbox"></div>Enable</label>
	</div>	<div class="wpmca_group wpmcatxt"> 
	<input type="text" class="wpmchimp_text" spellcheck="false" required	ng-model="data.theme['l'+data.litebox_theme].lite_tag">
	<span class="highlighter"></span>
	<span class="bar"></span>
	<label>Tag Text</label>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_tag_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_tag_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_tag_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_tag_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_tag_fc"/>
	</div>
</div>


<div class="wpmca_item extra_opts">
<div class="itemhead">
<h2>Additional Theme Options</h2>
</div>
<div class="wpmca_group wpmcacolor" ng-show="['8','1','9'].indexOf(data.litebox_theme) != -1">
<label>Close Button Color</label>
<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_close_col"/>
</div>	
<div class="wpmca_group wpmcarange">
<label>Background Opacity</label>
<input type="range" min="0" max="100" class="wpmchimp-range-sel" ng-model="data.theme['l'+data.litebox_theme].lite_bg_op"/>
</div>
<div class="wpmca_group wpmcacb" ng-show="['1'].indexOf(data.litebox_theme) != -1">
<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['l'+data.litebox_theme].lite_dislogo">
<div class="mcheckbox"></div>Disable Logo Head</label>
</div>
<div class="wpmca_group wpmcacb" ng-show="['1','8'].indexOf(data.litebox_theme) != -1">
<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['l'+data.litebox_theme].lite_dissoc">
<div class="mcheckbox"></div>Disable Social Buttons</label>
</div>
<div class="wpmca_group wpmcatxt" ng-show="['1'].indexOf(data.litebox_theme) != -1">
<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['l'+data.litebox_theme].lite_img1">
<button class="wpmca_button green material-design wpmc_media_uploader">Select Image</button>
<span class="wpmcahint" data-hint="Upload Image or Enter base64 of image with dimension 170x170(px)"></span>
<span class="highlighter"></span>
<span class="bar"></span>
<label>Featured Image URL</label>
</div>
<div class="wpmca_group wpmcacolor" ng-show="['1'].indexOf(data.litebox_theme) != -1">
<label>Head Color</label>
<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_head_col"/>
</div>
<div class="wpmca_group wpmcacolor" ng-show="['1'].indexOf(data.litebox_theme) != -1">
<label>Head Shadow Color</label>
<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_hshad_col"/>
</div>
<div class="wpmca_group wpmcacolor" ng-show="['1','8','9'].indexOf(data.litebox_theme) != -1">
<label>Popup Background</label>
<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_bg_c"/>
</div>
<div class="wpmca_group wpmcatxt" ng-show="['1','8'].indexOf(data.litebox_theme) != -1">
<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['l'+data.litebox_theme].lite_soc_head">
<span class="highlighter"></span>
<span class="bar"></span>
<label>Social Buttons Header</label>
</div>
<div class="wpmca_group" ng-show="['1','8'].indexOf(data.litebox_theme) != -1">
<select class="wpmca_sel google_fonts" ng-model="data.theme['l'+data.litebox_theme].lite_soc_f" ng-options="f for f in fonts track by f">
<option value="">Font</option>
</select>
<select class="wpmca_sel google_fonts_size" ng-model="data.theme['l'+data.litebox_theme].lite_soc_fs" ng-options="f for f in fontsiz track by f">
<option value="">Size</option>
</select>
<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['l'+data.litebox_theme].lite_soc_fw">
<option value="">Weight</option>
<option value="normal">Normal</option>
<option value="bold">Bold</option>
<option value="lighter">Lighter</option>
<option value="bolder">Bolder</option>
<option value="100">100</option>
<option value="200">200</option>
<option value="300">300</option>
<option value="400">400</option>
<option value="500">500</option>
<option value="600">600</option>
<option value="700">700</option>
<option value="800">800</option>
<option value="900">900</option>
</select>
<select class="wpmca_sel google_fonts_style" ng-model="data.theme['l'+data.litebox_theme].lite_soc_fst">
<option value="">Style</option>
<option value="normal">Normal</option>
<option value="italic">Italic</option>
<option value="oblique">oblique</option>
</select>
</div>
<div class="wpmca_group wpmcacolor" ng-show="['1','8'].indexOf(data.litebox_theme) != -1">
<label>Social Buttons Header Color</label>
<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['l'+data.litebox_theme].lite_soc_fc"/>
</div>
</div>


<div class="wpmca_item">
	<div class="itemhead">
		<h2>Filter by Device</h2>
		<span class="wpmcahint headhint" data-hint="Show Subscription form if the user visits from?"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_desktop" ng-true-value="'1'">
		<div class="mcheckbox"></div>Desktop</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_tablet" ng-true-value="'1'">
		<div class="mcheckbox"></div>Tablet</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_mobile" ng-true-value="'1'">
		<div class="mcheckbox"></div>Mobile</label>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Filter by Page type</h2>
		<span class="wpmcahint headhint" data-hint="Show Subscription form if the user visits?"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_homepage" ng-true-value="'1'">
		<div class="mcheckbox"></div>Home Page</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_blog" ng-true-value="'1'">
		<div class="mcheckbox"></div>Blog Page</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_page" ng-true-value="'1'">
		<div class="mcheckbox"></div>Pages</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_post" ng-true-value="'1'">
		<div class="mcheckbox"></div>Posts</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_category" ng-true-value="'1'">
		<div class="mcheckbox"></div>Categories/Archives</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_search" ng-true-value="'1'">
		<div class="mcheckbox"></div>Search</label>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-model="data.lite_404error" ng-true-value="'1'">
		<div class="mcheckbox"></div>404 Error</label>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
		<h2>Behaviour</h2>
		<span class="wpmcahint headhint" data-hint="Adjust the behaviour"></span>
	</div>
	<div class="wpmca_group wpmcatxts wpmcacb"> 
	<label>Appear after</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.lite_behave_time">
	<span>seconds</span>
	<label><input type="checkbox" style="margin-left: 10px;" ng-model="data.lite_behave_time_inac" ng-true-value="'1'">
	<div class="mcheckbox"></div>of Inactivity</label>
	</div>
	<div class="wpmca_group wpmcatxts wpmcacb"> 
	<label><input type="checkbox" ng-model="data.lite_behave_scroll" ng-true-value="'1'">
	<div class="mcheckbox"></div>Appear after</label>
	<input type="text" class="wpmchimp_texts premium" readonly value="50">
	<span>% of the page scrolled</span>
	</div>
	<div class="wpmca_group wpmcatxts wpmcacb"> 
	<label><input type="checkbox" ng-model="data.lite_behave_cookie" ng-true-value="'1'">
	<div class="mcheckbox"></div>Reappear after</label>
	<input type="text" class="wpmchimp_texts premium" value="1" readonly>
	<span>day using Cookie</span>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Close action</h2>
		<span class="wpmcahint headhint" data-hint="When to close the litebox"></span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
	<label>Disapear after</label>
	<input type="text" class="wpmchimp_texts" ng-model="data.lite_close_time">
	<span>seconds of inactivity</span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.lite_close_bck">
		<div class="mcheckbox"></div>Close when Litebox background is clicked</label>
		<span class="wpmcahint" data-hint="If not selected, visitors need to click close button to exit the lightbox"></span>
	</div>
</div>
<?php
	break;
	case 'slider':
?>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Subscribe box in Slider</h2>
	</div>
	<div class="wpmca_group">
			<div class="paper-toggle">
				<input type="checkbox" id="slider_en" ng-true-value="'1'" class="wpmcatoggle" ng-model="data.slider"/>
				<label for="slider_en">Enable</label>
			</div>
			<span class="wpmcahint" data-hint="Enable Slider"></span>
	</div>
	<div class="wpmca_group wpmc_dropc">
		<label>Custom Form</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getformbyid(data.slider_form).name || (data.cforms.length?'Select Form':'No Forms')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="form in data.cforms" ng-click="data.slider_form = form.id">{{form.name}}</div>
			</div>
		</div>
	</div>
</div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Select Theme</h2>
				<span class="wpmcahint headhint" data-hint="Select a theme for Slider"></span>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel themeswitcher" ng-change="themeswitcher('slider')" style="width: 260px;" ng-model="data.slider_theme">
					<option value="0">Basic</option>
					<option value="1">Epsilon</option>
					<option value="8">Nova</option>
					<option value="9">Leo</option>
					<option disabled>Material - BUY PRO</option>
					<option disabled>Material Lite - BUY PRO</option>
					<option disabled>Onamy - BUY PRO</option>
					<option disabled>Smash - BUY PRO</option>
					<option disabled>Glow - BUY PRO</option>
					<option disabled>Unidesign - BUY PRO</option>
				</select>
			</div>
			<div class="wpmca_group">
				<button class="wpmca_button orange material-design" ng-click="vupre($event,data.slider_theme)">Live Editor</button>
		</div>
 </div>
 <div class="wpmca_prev liveslider">
<div class="wpmca_topbar">
<div class="wpmca_round" style="background:#f67a00"></div><div class="wpmca_round" style="background:#ebc71f"></div><div class="wpmca_round" style="background:#31bb37"></div><div class="wpmca_left"></div><div class="wpmca_right"></div><div class="wpmca_long"></div><div class="wpmca_search"></div><div class="wpmca_opts"></div>
</div>
<div class="wpmca_viewportbck">
<div class="wpmca_lineimg"></div>
<div class="wpmca_divide" style="left:33%"></div>
<div class="wpmca_divide" style="left:66%"></div>
<div ng-repeat="i in fontsiz.slice(0, 2)" class="wpmca_linecont">
	<div ng-repeat="i in fontsiz.slice(0, 10)" class="wpmca_line"></div></div>
</div>
<div class="wpmca_viewport"></div>
</div>
<div class="roundbutton bak2toprev hiderb material-design" ng-click="bak2toprev($event)"></div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Custom Message</h2>
		</div>
	
		<div class="wpmca_group wpmcatxt"> 
			<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['s'+data.slider_theme].slider_heading">
			<span class="wpmcahint" data-hint="Heading for the Slider"></span>
			<span class="highlighter"></span>
			<span class="bar"></span>
			<label>Heading</label>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_heading_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_heading_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_heading_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_heading_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
				<label>Font Color</label>
				<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_heading_fc"/>
		</div>
		<div class="wpmca_group"> 
				<div class="wpmcapara">Message
						 <span class="wpmcahint" data-hint="Message for the Slider"></span>
				</div>
		<ng-quill-editor ng-model="data.theme['s'+data.slider_theme].slider_msg" toolbar="true" link-tooltip="true" image-tooltip="true" toolbar-entries="bold list bullet italic underline strike align color background link image"></ng-quill-editor>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_msg_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_msg_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
		</div>
</div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Text Box</h2>
		</div>
		<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_tbox_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_tbox_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_tbox_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_tbox_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_tbox_fc"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Background Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_tbox_bgc"/>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_tbox_w">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Height</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_tbox_h">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Border Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_tbox_bor">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Border Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_tbox_borc"/> </div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Checkbox</h2>
		</div>
		<div class="wpmca_group wpmcacb">
			<label class="wpmcapara">Checkbox Theme</label>
			<div class="wpmca_compac p1">
				<input id="lc1" type="radio" value="1" ng-model="data.theme['s'+data.slider_theme].slider_check_shade">
				<label for="lc1">Light <div class="checkbdemo litet"></div></label>
			</div>
			<div class="wpmca_compac">
				<input id="lc2" type="radio" value="2" ng-model="data.theme['s'+data.slider_theme].slider_check_shade">
				<label for="lc2">Dark <div class="checkbdemo darkt"></div></label> 
			</div>
			<div style="clear:both"></div>
	 </div>
		<div class="wpmca_group wpmcacolor">
			 <label>Theme Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_check_c"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Border Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_check_borc"/>
		</div>
		<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_check_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_check_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_check_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_check_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_check_fc"/>
		</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Button</h2>
		</div>
		<div class="wpmca_group wpmcatxt"> 
			<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['s'+data.slider_theme].slider_button">
			<span class="highlighter"></span>
			<span class="bar"></span>
			<label>Button Text</label>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_button_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_button_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_button_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_button_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_button_fc"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Hover Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_button_fch"/>
		</div>
		<div class="wpmca_group wpmc_dropc ico_sel">
			<label>Icon</label>
			<div class="wpmc_drop">
				<div class="wpmc_drop_head"><div ng-class="data.theme['s'+data.slider_theme].slider_button_i"></div>
					<div class="bar"></div>
				</div>
				<div class="wpmc_drop_body">
					<div class="longcell inone" ng-click="data.theme['s'+data.slider_theme].slider_button_i='inone'" ng-class="{'drop-sel': data.theme['s'+data.slider_theme].slider_button_i=='inone' }"></div>
					<div class="longcell idef" ng-click="data.theme['s'+data.slider_theme].slider_button_i='idef'" ng-class="{'drop-sel': data.theme['s'+data.slider_theme].slider_button_i=='idef' }"></div>
					<div ng-repeat="(k, v) in icons" ng-click="data.theme['s'+data.slider_theme].slider_button_i=k" class="{{k}}" ng-class="{'drop-sel': k == data.theme['s'+data.slider_theme].slider_button_i }"></div>
				</div>
			</div>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_button_w">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Height</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_button_h">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Background Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_button_bc"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			<label>Hover Background Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_button_bch"/>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Border Radius</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_button_br">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Border Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['s'+data.slider_theme].slider_button_bor">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Border Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_button_borc"/>
		</div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Spinner</h2>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Theme Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_spinner_c"/>
		</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Personalize your Trigger</h2>
	</div>
	<div class="wpmca_group wpmc_dropc ico_sel">
		<label>Icon</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div ng-class="data.theme['s'+data.slider_theme].slider_trigger_i"></div>
				<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
				<div class="longcell inone" ng-click="data.theme['s'+data.slider_theme].slider_trigger_i='inone'" ng-class="{'drop-sel': data.theme['s'+data.slider_theme].slider_trigger_i=='inone' }"></div>
				<div class="longcell idef" ng-click="data.theme['s'+data.slider_theme].slider_trigger_i='idef'" ng-class="{'drop-sel': data.theme['s'+data.slider_theme].slider_trigger_i=='idef' }"></div>
				<div ng-repeat="(k, v) in icons" ng-click="data.theme['s'+data.slider_theme].slider_trigger_i=k" class="{{k}}" ng-class="{'drop-sel': k == data.theme['s'+data.slider_theme].slider_trigger_i }"></div>
			</div>
		</div>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Icon Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_trigger_c"/>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Background Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_trigger_bg"/>
	</div>
	<div class="wpmca_group wpmcarange">
		 <label>Position from top(%)</label>
		 <input type="range" min="0" max="100" class="wpmchimp-range-sel" ng-model="data.theme['s'+data.slider_theme].slider_trigger_top"/>
	</div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['s'+data.slider_theme].slider_trigger_hider"> 
				<div class="mcheckbox"></div>Distraction-free Mode</label>
				<span class="wpmcahint" data-hint="A small button to hide trigger"></span>
		 </div> 
		<div class="wpmca_group wpmcacolor">
			 <label>Hide-icon Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_trigger_hc"/>
		</div>
	<div class="wpmca_group wpmcatxts wpmcacb"> 
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_trigger_scroll">
		<div class="mcheckbox"></div>Appear after</label>
		<input type="text" class="wpmchimp_texts premium" readonly value="50">
		<span>% of the page scrolled</span>
	</div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Status Message</h2>
				<span class="wpmcahint headhint" data-hint="Customize your Success or Error Message"></span>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_status_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_status_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_status_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_status_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_status_fc"/>
		</div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Tag</h2>
				<span class="wpmcahint headhint" data-hint="Customize your Tag"></span>
		</div>

		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['s'+data.slider_theme].slider_tag_en"> 
				<div class="mcheckbox"></div>Enable</label>
		 </div> 
		<div class="wpmca_group wpmcatxt"> 
			<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['s'+data.slider_theme].slider_tag">
			<span class="highlighter"></span>
			<span class="bar"></span>
			<label>Tag Text</label>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_tag_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_tag_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_tag_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_tag_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_tag_fc"/>
		</div>
</div>


<div class="wpmca_item extra_opts">
	<div class="itemhead">
		<h2>Additional Theme Options</h2>
	</div>
	<div class="wpmca_group wpmcacb" ng-show="['1','8'].indexOf(data.slider_theme) != -1">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['s'+data.slider_theme].slider_dissoc"> 
		<div class="mcheckbox"></div>Disable Social Buttons</label>
	</div>
	<div class="wpmca_group wpmcacolor" ng-show="['1','8','9'].indexOf(data.slider_theme) != -1">
		<label>Canvas Color</label>
		<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_canvas_c"/>
	</div>
	<div class="wpmca_group wpmcacolor">
		<label>Background Color</label>
		<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_bg_c"/>
	</div>
	<div class="wpmca_group wpmcatxt" ng-show="['1','8'].indexOf(data.slider_theme) != -1">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['s'+data.slider_theme].slider_soc_head">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Social Buttons Header</label>
	</div>
	<div class="wpmca_group" ng-show="['1','8'].indexOf(data.slider_theme) != -1">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['s'+data.slider_theme].slider_soc_f" ng-options="f for f in fonts track by f">
			<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['s'+data.slider_theme].slider_soc_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['s'+data.slider_theme].slider_soc_fw">
			<option value="">Weight</option>
			<option value="normal">Normal</option>
			<option value="bold">Bold</option>
			<option value="lighter">Lighter</option>
			<option value="bolder">Bolder</option>
			<option value="100">100</option>
			<option value="200">200</option>
			<option value="300">300</option>
			<option value="400">400</option>
			<option value="500">500</option>
			<option value="600">600</option>
			<option value="700">700</option>
			<option value="800">800</option>
			<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['s'+data.slider_theme].slider_soc_fst">
			<option value="">Style</option>
			<option value="normal">Normal</option>
			<option value="italic">Italic</option>
			<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor slider_soc_fc" ng-show="['1','8'].indexOf(data.slider_theme) != -1">
		<label>Social Buttons Header Color</label>
		<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['s'+data.slider_theme].slider_soc_fc"/>
	</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Filter by Device</h2>
				<span class="wpmcahint headhint" data-hint="Show Subscription form if the user visits from?"></span>
		</div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_desktop"> 
				<div class="mcheckbox"></div>Desktop</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_tablet">
				<div class="mcheckbox"></div>Tablet</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_mobile">
				<div class="mcheckbox"></div>Mobile</label>
		 </div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Filter by Page type</h2>
				<span class="wpmcahint headhint" data-hint="Show Subscription form if the user visits?"></span>
		</div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_homepage">
				<div class="mcheckbox"></div>Home Page</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_blog">
				<div class="mcheckbox"></div>Blog Page</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_page">
				<div class="mcheckbox"></div>Pages</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_post">
				<div class="mcheckbox"></div>Posts</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_category">
				<div class="mcheckbox"></div>Categories/Archives</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_search">
				<div class="mcheckbox"></div>Search</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_404error">
				<div class="mcheckbox"></div>404 Error</label>
		 </div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Behaviour</h2>
			<span class="wpmcahint headhint" data-hint="Behaviour of the Slider"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label class="wpmcapara">Orientation</label>
		<div class="wpmca_compac p1">
			<input id="so1" type="radio" value="left" ng-model="data.slider_orient">
			<label for="so1">Left <div class="orientdemo lefto"></div></label>
		</div>
		<div class="wpmca_compac">
			<input id="so2" type="radio" value="right" ng-model="data.slider_orient">
			<label for="so2">Right <div class="orientdemo righto"></div></label> 
		</div>
		<div style="clear:both"></div>
 </div>
	<div class="wpmca_group wpmcatxts wpmcacb">
		<label>Appear after</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.slider_behave_time">
		<span>seconds</span>
		<label><input type="checkbox" style="margin-left: 10px;" ng-true-value="'1'" ng-model="data.slider_behave_time_inac">
		<div class="mcheckbox"></div>of Inactivity</label>
	</div>
	 <div class="wpmca_group wpmcacb">
			<label><input type="checkbox" ng-true-value="'1'" ng-model="data.slider_close_bck">
			<div class="mcheckbox"></div>Close when Slider background is clicked</label>
			<span class="wpmcahint" data-hint="If not selected, visitors need to click close button to exit the slider"></span>
	 </div>
</div>
<?php
	break;
	case 'widget':
?>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Subscribe box in Widget</h2>
		</div>
		<div class="wpmca_group">
				<div class="paper-toggle">
						<input type="checkbox" id="widget_en" ng-true-value="'1'" class="wpmcatoggle" ng-model="data.widget"/>
						<label for="widget_en">Enable</label>
				</div>
				<span class="wpmcahint" data-hint="Enable Widget"></span>
		</div>
	<div class="wpmca_group wpmc_dropc">
		<label>Custom Form</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getformbyid(data.widget_form).name || (data.cforms.length?'Select Form':'No Forms')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="form in data.cforms" ng-click="data.widget_form = form.id">{{form.name}}</div>
			</div>
		</div>
	</div>
</div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Select Theme</h2>
				<span class="wpmcahint headhint" data-hint="Select a theme for widget"></span>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel themeswitcher" ng-change="themeswitcher('widget')" style="width: 260px;" ng-model="data.widget_theme">
					<option value="0">Basic</option>
					<option value="1">Epsilon</option>
					<option value="8">Nova</option>
					<option value="9">Leo</option>
					<option disabled>Material - BUY PRO</option>
					<option disabled>Material Lite - BUY PRO</option>
					<option disabled>Onamy - BUY PRO</option>
					<option disabled>Smash - BUY PRO</option>
					<option disabled>Glow - BUY PRO</option>
					<option disabled>Unidesign - BUY PRO</option>
				</select>
		</div>
			<div class="wpmca_group">
				<button class="wpmca_button orange material-design" ng-click="vupre($event,data.widget_theme)">Live Editor</button>
		</div>
 </div>
 <div class="wpmca_prev livewidget">
<div class="wpmca_topbar">
<div class="wpmca_round" style="background:#f67a00"></div><div class="wpmca_round" style="background:#ebc71f"></div><div class="wpmca_round" style="background:#31bb37"></div><div class="wpmca_left"></div><div class="wpmca_right"></div><div class="wpmca_long"></div><div class="wpmca_search"></div><div class="wpmca_opts"></div>
</div>
<div class="wpmca_viewportbck">
<div class="wpmca_lineimg"></div>
<div class="wpmca_divide" style="left:33%"></div>
<div class="wpmca_divide" style="left:66%"></div>
<div ng-repeat="i in fontsiz.slice(0, 2)" class="wpmca_linecont">
	<div ng-repeat="i in fontsiz.slice(0, 10)" class="wpmca_line"></div></div>
</div>
<div class="wpmca_viewport"></div>
</div>
<div class="roundbutton bak2toprev hiderb material-design" ng-click="bak2toprev($event)"></div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Custom Message</h2>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['w'+data.widget_theme].widget_heading">
		<span class="wpmcahint" data-hint="Heading for the Widget"></span>
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Heading</label>
	</div>

	<div class="wpmca_group">
		<div class="wpmcapara">Message
				 <span class="wpmcahint" data-hint="Message for the Widget"></span>
		</div>
		<ng-quill-editor ng-model="data.theme['w'+data.widget_theme].widget_msg" toolbar="true" link-tooltip="true" image-tooltip="true" toolbar-entries="bold list bullet italic underline strike align color background link image"></ng-quill-editor>
	</div>
	<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_msg_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_msg_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Personalize your Text Box</h2>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_tbox_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_tbox_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
			<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['w'+data.widget_theme].widget_tbox_fw">
				<option value="">Weight</option>
				<option value="normal">Normal</option>
				<option value="bold">Bold</option>
				<option value="lighter">Lighter</option>
				<option value="bolder">Bolder</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
			</select>
			<select class="wpmca_sel google_fonts_style" ng-model="data.theme['w'+data.widget_theme].widget_tbox_fst">
				<option value="">Style</option>
				<option value="normal">Normal</option>
				<option value="italic">Italic</option>
				<option value="oblique">oblique</option>
			</select>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Font Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_tbox_fc"/>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Background Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_tbox_bgc"/>
	</div>
	<div class="wpmca_group wpmcatxts">
		<label>Width</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_tbox_w">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
		<label>Height</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_tbox_h">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
		<label>Border Width</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_tbox_bor">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Border Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_tbox_borc"/>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
			<h2>Personalize your Checkbox</h2>
	</div>
	<div class="wpmca_group wpmcacb">
		<label class="wpmcapara">Checkbox Theme</label>
		<div class="wpmca_compac p1">
			<input id="wc1" type="radio" value="1" ng-model="data.theme['w'+data.widget_theme].widget_check_shade">
			<label for="wc1">Light <div class="checkbdemo litet"></div></label>
		</div>
		<div class="wpmca_compac">
			<input id="wc2" type="radio" value="2" ng-model="data.theme['w'+data.widget_theme].widget_check_shade">
			<label for="wc2">Dark <div class="checkbdemo darkt"></div></label> 
		</div>
		<div style="clear:both"></div>
 </div>
	<div class="wpmca_group wpmcacolor">
		 <label>Theme Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_check_c"/>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Border Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_check_borc"/>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_check_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_check_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
			<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['w'+data.widget_theme].widget_check_fw">
				<option value="">Weight</option>
				<option value="normal">Normal</option>
				<option value="bold">Bold</option>
				<option value="lighter">Lighter</option>
				<option value="bolder">Bolder</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
			</select>
			<select class="wpmca_sel google_fonts_style" ng-model="data.theme['w'+data.widget_theme].widget_check_fst">
				<option value="">Style</option>
				<option value="normal">Normal</option>
				<option value="italic">Italic</option>
				<option value="oblique">oblique</option>
			</select>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Font Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_check_fc"/>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Personalize your Button</h2>
	</div>
	<div class="wpmca_group wpmcatxt">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['w'+data.widget_theme].widget_button">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Button Text</label>
	</div>
	<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_button_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_button_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
			<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['w'+data.widget_theme].widget_button_fw">
				<option value="">Weight</option>
				<option value="normal">Normal</option>
				<option value="bold">Bold</option>
				<option value="lighter">Lighter</option>
				<option value="bolder">Bolder</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
			</select>
			<select class="wpmca_sel google_fonts_style" ng-model="data.theme['w'+data.widget_theme].widget_button_fst">
				<option value="">Style</option>
				<option value="normal">Normal</option>
				<option value="italic">Italic</option>
				<option value="oblique">oblique</option>
			</select>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Font Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_button_fc"/>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Hover Font Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_button_fch"/>
	</div>
	<div class="wpmca_group wpmc_dropc ico_sel">
		<label>Icon</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div ng-class="data.theme['w'+data.widget_theme].widget_button_i"></div>
				<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
				<div class="longcell inone" ng-click="data.theme['w'+data.widget_theme].widget_button_i='inone'" ng-class="{'drop-sel': data.theme['w'+data.widget_theme].widget_button_i=='inone' }"></div>
				<div class="longcell idef" ng-click="data.theme['w'+data.widget_theme].widget_button_i='idef'" ng-class="{'drop-sel': data.theme['w'+data.widget_theme].widget_button_i=='idef' }"></div>
				<div ng-repeat="(k, v) in icons" ng-click="data.theme['w'+data.widget_theme].widget_button_i=k" class="{{k}}" ng-class="{'drop-sel': k == data.theme['w'+data.widget_theme].widget_button_i }"></div>
			</div>
		</div>
	</div>
	<div class="wpmca_group wpmcatxts">
		<label>Width</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_button_w">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
		<label>Height</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_button_h">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Background Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_button_bc"/>
	</div>
	<div class="wpmca_group wpmcacolor">
		<label>Hover Background Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_button_bch"/>
	</div>
	<div class="wpmca_group wpmcatxts"> 
		<label>Border Radius</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_button_br">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcatxts"> 
		<label>Border Width</label>
		<input type="text" class="wpmchimp_texts" ng-model="data.theme['w'+data.widget_theme].widget_button_bor">
		<span>px</span>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Border Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_button_borc"/>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
			<h2>Personalize your Spinner</h2>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Theme Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_spinner_c"/>
	</div>
</div>

<div class="wpmca_item">
	<div class="itemhead">
			<h2>Personalize your Status Message</h2>
			<span class="wpmcahint headhint" data-hint="Customize your Success or Error Message"></span>
	</div>
	<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_status_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_status_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
			<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['w'+data.widget_theme].widget_status_fw">
				<option value="">Weight</option>
				<option value="normal">Normal</option>
				<option value="bold">Bold</option>
				<option value="lighter">Lighter</option>
				<option value="bolder">Bolder</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
			</select>
			<select class="wpmca_sel google_fonts_style" ng-model="data.theme['w'+data.widget_theme].widget_status_fst">
				<option value="">Style</option>
				<option value="normal">Normal</option>
				<option value="italic">Italic</option>
				<option value="oblique">oblique</option>
			</select>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Font Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_status_fc"/>
	</div>

</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Tag</h2>
		<span class="wpmcahint headhint" data-hint="Customize your Tag"></span>
	</div>

	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['w'+data.widget_theme].widget_tag_en" >
		<div class="mcheckbox"></div>Enable</label>
	</div>	<div class="wpmca_group wpmcatxt"> 
	<input type="text" class="wpmchimp_text" spellcheck="false" required	ng-model="data.theme['w'+data.widget_theme].widget_tag">
	<span class="highlighter"></span>
	<span class="bar"></span>
	<label>Tag Text</label>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_tag_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_tag_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['w'+data.widget_theme].widget_tag_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['w'+data.widget_theme].widget_tag_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_tag_fc"/>
	</div>
</div>

<div class="wpmca_item extra_opts">
	<div class="itemhead">
			<h2>Additional Theme Options</h2>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Widget Background</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_bg_c"/>
	</div>
	<div class="wpmca_group wpmcacb" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
			<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['w'+data.widget_theme].widget_dissoc">
			<div class="mcheckbox"></div>Disable Social Buttons</label>
	 </div>
	<div class="wpmca_group wpmcatxt" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['w'+data.widget_theme].widget_soc_head">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Social Buttons Header</label>
	</div>
	<div class="wpmca_group" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['w'+data.widget_theme].widget_soc_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['w'+data.widget_theme].widget_soc_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
			<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['w'+data.widget_theme].widget_soc_fw">
				<option value="">Weight</option>
				<option value="normal">Normal</option>
				<option value="bold">Bold</option>
				<option value="lighter">Lighter</option>
				<option value="bolder">Bolder</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
			</select>
			<select class="wpmca_sel google_fonts_style" ng-model="data.theme['w'+data.widget_theme].widget_soc_fst">
				<option value="">Style</option>
				<option value="normal">Normal</option>
				<option value="italic">Italic</option>
				<option value="oblique">oblique</option>
			</select>
	</div>
	<div class="wpmca_group wpmcacolor" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
		 <label>Social Buttons Header Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['w'+data.widget_theme].widget_soc_fc"/>
	</div>
</div>
<?php
	break;
	case 'addon':
?>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Subscribe box in Post Page</h2>
	</div>
	<div class="wpmca_group">
		<div class="paper-toggle">
			<input type="checkbox" id="addon_en" ng-model="data.addon" ng-true-value="'1'" class="wpmcatoggle"/>
			<label for="addon_en">Enable</label>
		</div>
		<span class="wpmcahint" data-hint="Enable Add-on"></span>
	</div>
	<div class="wpmca_group wpmc_dropc">
		<label>Custom Form</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getformbyid(data.addon_form).name || (data.cforms.length?'Select Form':'No Forms')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="form in data.cforms" ng-click="data.addon_form = form.id">{{form.name}}</div>
			</div>
		</div>
	</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Topbar Subscription Box</h2>
	</div>
	<div class="wpmca_group">
			<div class="paper-toggle">
				<input type="checkbox" id="topbar_en" ng-model="data.topbar" ng-true-value="'1'" class="wpmcatoggle"/>
				<label for="topbar_en">Enable</label>
			</div>
			<span class="wpmcahint" data-hint="Enable Topbar"></span>
	</div>
	<div class="wpmca_group wpmc_dropc">
		<label>Custom Form</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getformbyid(data.topbar_form).name || (data.cforms.length?'Select Form':'No Forms')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="form in data.cforms" ng-click="data.topbar_form = form.id">{{form.name}}</div>
			</div>
		</div>
	</div>
	<div class="wpmca_group wpmc_dropc" ng-show="data.topbar_form">
		<label>Custom Field</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getfieldbyid(data.topbar_field).name || (data.cforms.length?'None':'No Fields')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-click="data.topbar_field = ''">None</div>
			<div ng-repeat="field in gettopfield()" ng-click="data.topbar_field = field.uid">{{field.name}}</div>
			</div>
		</div>
		<span class="wpmcahint" data-hint="Select a field which will be shown along with email field"></span>
	</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Flipbox Subscription Box</h2>
		</div>
		<div class="wpmca_group">
				<div class="paper-toggle">
						<input type="checkbox" id="flipbox_en" ng-model="data.flipbox" ng-true-value="'1'" class="wpmcatoggle"/>
						<label for="flipbox_en">Enable</label>
				</div>
				<span class="wpmcahint" data-hint="Enable Flipbox"></span>
		</div>
	<div class="wpmca_group wpmc_dropc">
		<label>Custom Form</label>
		<div class="wpmc_drop">
			<div class="wpmc_drop_head"><div>{{getformbyid(data.flipbox_form).name || (data.cforms.length?'Select Form':'No Forms')}}</div>
			<div class="bar"></div>
			</div>
			<div class="wpmc_drop_body">
			<div ng-repeat="form in data.cforms" ng-click="data.flipbox_form = form.id">{{form.name}}</div>
			</div>
		</div>
	</div>
</div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Select Theme</h2>
				<span class="wpmcahint headhint" data-hint="Select a theme for addon"></span>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel themeswitcher" ng-change="themeswitcher('addon')" style="width: 260px;" ng-model="data.addon_theme">
					<option value="0">Basic</option>
					<option value="1">Epsilon</option>
					<option value="8">Nova</option>
					<option value="9">Leo</option>
					<option disabled>Material - BUY PRO</option>
					<option disabled>Material Lite - BUY PRO</option>
					<option disabled>Onamy - BUY PRO</option>
					<option disabled>Smash - BUY PRO</option>
					<option disabled>Glow - BUY PRO</option>
					<option disabled>Unidesign - BUY PRO</option>
				</select>
		</div>
			<div class="wpmca_group">
				<button class="wpmca_button orange material-design" ng-click="vupre($event,data.addon_theme)">Live Editor</button>
		</div>
 </div>
 <div class="wpmca_prev liveaddon">
<div class="wpmca_topbar">
<div class="wpmca_round" style="background:#f67a00"></div><div class="wpmca_round" style="background:#ebc71f"></div><div class="wpmca_round" style="background:#31bb37"></div><div class="wpmca_left"></div><div class="wpmca_right"></div><div class="wpmca_long"></div><div class="wpmca_search"></div><div class="wpmca_opts"></div>
</div>
<div class="wpmca_viewportbck">
<div class="wpmca_lineimg"></div>
<div class="wpmca_divide" style="left:33%"></div>
<div class="wpmca_divide" style="left:66%"></div>
<div ng-repeat="i in fontsiz.slice(0, 2)" class="wpmca_linecont">
	<div ng-repeat="i in fontsiz.slice(0, 10)" class="wpmca_line"></div></div>
</div>
<div class="wpmca_viewport"></div>
</div>
<div class="roundbutton bak2toprev hiderb material-design" ng-click="bak2toprev($event)"></div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Custom Message</h2>
		</div>
	
		<div class="wpmca_group wpmcatxt">
			<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['a'+data.addon_theme].addon_heading">
			<span class="wpmcahint" data-hint="Heading for the Post Page"></span>
			<span class="highlighter"></span>
			<span class="bar"></span>
			<label>Heading</label>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_heading_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_heading_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_heading_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_heading_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
				<label>Font Color</label>
				<input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_heading_fc"/>
		</div>
		<div class="wpmca_group">
				<div class="wpmcapara">Message
						 <span class="wpmcahint" data-hint="Message for the Lightbox"></span>
				</div>
				<ng-quill-editor ng-model="data.theme['a'+data.addon_theme].addon_msg" toolbar="true" link-tooltip="true" image-tooltip="true" toolbar-entries="bold list bullet italic underline strike align color background link image"></ng-quill-editor>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_msg_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_msg_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
		</div>
</div>
 <div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Text Box</h2>
		</div>
		<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_tbox_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_tbox_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_tbox_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_tbox_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_tbox_fc"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Background Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_tbox_bgc"/>
		</div>
		<div class="wpmca_group wpmcatxts">
			<label>Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_tbox_w">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Height</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_tbox_h">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Border Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_tbox_bor">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Border Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_tbox_borc"/>
		</div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Checkbox</h2>
		</div>
		<div class="wpmca_group wpmcacb">
			<label class="wpmcapara">Checkbox Theme</label>
			<div class="wpmca_compac p1">
				<input id="ac1" type="radio" value="1" ng-model="data.theme['a'+data.addon_theme].addon_check_shade">
				<label for="ac1">Light <div class="checkbdemo litet"></div></label>
			</div>
			<div class="wpmca_compac">
				<input id="ac2" type="radio" value="2" ng-model="data.theme['a'+data.addon_theme].addon_check_shade">
				<label for="ac2">Dark <div class="checkbdemo darkt"></div></label> 
			</div>
			<div style="clear:both"></div>
	 </div>
		<div class="wpmca_group wpmcacolor">
			 <label>Theme Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_check_c"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Border Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_check_borc"/>
		</div>
		<div class="wpmca_group">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_check_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_check_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_check_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_check_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_check_fc"/>
		</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Button</h2>
		</div>
		<div class="wpmca_group wpmcatxt">
			<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['a'+data.addon_theme].addon_button">
			<span class="highlighter"></span>
			<span class="bar"></span>
			<label>Button Text</label>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_button_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_button_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_button_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_button_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_button_fc"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Hover Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_button_fch"/>
		</div>
		<div class="wpmca_group wpmc_dropc ico_sel">
			<label>Icon</label>
			<div class="wpmc_drop">
				<div class="wpmc_drop_head"><div ng-class="data.theme['a'+data.addon_theme].addon_button_i"></div>
					<div class="bar"></div>
				</div>
				<div class="wpmc_drop_body">
					<div class="longcell inone" ng-click="data.theme['a'+data.addon_theme].addon_button_i='inone'" ng-class="{'drop-sel': data.theme['a'+data.addon_theme].addon_button_i=='inone' }"></div>
					<div class="longcell idef" ng-click="data.theme['a'+data.addon_theme].addon_button_i='idef'" ng-class="{'drop-sel': data.theme['a'+data.addon_theme].addon_button_i=='idef' }"></div>
					<div ng-repeat="(k, v) in icons" ng-click="data.theme['a'+data.addon_theme].addon_button_i=k" class="{{k}}" ng-class="{'drop-sel': k == data.theme['a'+data.addon_theme].addon_button_i }"></div>
				</div>
			</div>
		</div>
		<div class="wpmca_group wpmcatxts">
			<label>Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_button_w">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Height</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_button_h">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Background Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_button_bc"/>
		</div>
		<div class="wpmca_group wpmcacolor">
			<label>Hover Background Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_button_bch"/>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Border Radius</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_button_br">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcatxts"> 
			<label>Border Width</label>
			<input type="text" class="wpmchimp_texts" ng-model="data.theme['a'+data.addon_theme].addon_button_bor">
			<span>px</span>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Border Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_button_borc"/>
		</div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Spinner</h2>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Theme Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_spinner_c"/>
		</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Personalize your Status Message</h2>
				<span class="wpmcahint headhint" data-hint="Customize your Success or Error Message"></span>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_status_f" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
				</select>
				<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_status_fs" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_status_fw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_status_fst">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
		<div class="wpmca_group wpmcacolor">
			 <label>Font Color</label>
			 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_status_fc"/>
		</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>Personalize your Tag</h2>
		<span class="wpmcahint headhint" data-hint="Customize your Tag"></span>
	</div>

	<div class="wpmca_group wpmcacb">
		<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['a'+data.addon_theme].addon_tag_en" >
		<div class="mcheckbox"></div>Enable</label>
	</div>	<div class="wpmca_group wpmcatxt"> 
	<input type="text" class="wpmchimp_text" spellcheck="false" required	ng-model="data.theme['a'+data.addon_theme].addon_tag">
	<span class="highlighter"></span>
	<span class="bar"></span>
	<label>Tag Text</label>
	</div>
	<div class="wpmca_group">
		<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_tag_f" ng-options="f for f in fonts track by f">
		<option value="">Font</option>
		</select>
		<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_tag_fs" ng-options="f for f in fontsiz track by f">
			<option value="">Size</option>
		</select>
		<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_tag_fw">
		<option value="">Weight</option>
		<option value="normal">Normal</option>
		<option value="bold">Bold</option>
		<option value="lighter">Lighter</option>
		<option value="bolder">Bolder</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="400">400</option>
		<option value="500">500</option>
		<option value="600">600</option>
		<option value="700">700</option>
		<option value="800">800</option>
		<option value="900">900</option>
		</select>
		<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_tag_fst">
		<option value="">Style</option>
		<option value="normal">Normal</option>
		<option value="italic">Italic</option>
		<option value="oblique">oblique</option>
		</select>
	</div>
	<div class="wpmca_group wpmcacolor">
	 <label>Font Color</label>
	 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_tag_fc"/>
	</div>
</div>
<div class="wpmca_item extra_opts">
	<div class="itemhead">
			<h2>Additional Theme Options</h2>
	</div>
	<div class="wpmca_group wpmcacolor">
		 <label>Addon Background</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_bg_c"/>
	</div>
	<div class="wpmca_group wpmcacb" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
			<label><input type="checkbox" ng-true-value="'1'" ng-model="data.theme['a'+data.addon_theme].addon_dissoc">
			<div class="mcheckbox"></div>Disable Social Buttons</label>
	 </div>
	<div class="wpmca_group wpmcatxt" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
		<input type="text" class="wpmchimp_text" spellcheck="false" required ng-model="data.theme['a'+data.addon_theme].addon_soc_head">
		<span class="highlighter"></span>
		<span class="bar"></span>
		<label>Social Buttons Header</label>
	</div>
	<div class="wpmca_group" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
			<select class="wpmca_sel google_fonts" ng-model="data.theme['a'+data.addon_theme].addon_soc_f" ng-options="f for f in fonts track by f">
				<option value="">Font</option>
			</select>
			<select class="wpmca_sel google_fonts_size" ng-model="data.theme['a'+data.addon_theme].addon_soc_fs" ng-options="f for f in fontsiz track by f">
					<option value="">Size</option>
			</select>
			<select class="wpmca_sel google_fonts_weight" ng-model="data.theme['a'+data.addon_theme].addon_soc_fw">
				<option value="">Weight</option>
				<option value="normal">Normal</option>
				<option value="bold">Bold</option>
				<option value="lighter">Lighter</option>
				<option value="bolder">Bolder</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
			</select>
			<select class="wpmca_sel google_fonts_style" ng-model="data.theme['a'+data.addon_theme].addon_soc_fst">
				<option value="">Style</option>
				<option value="normal">Normal</option>
				<option value="italic">Italic</option>
				<option value="oblique">oblique</option>
			</select>
	</div>
	<div class="wpmca_group wpmcacolor" ng-show="['1','8'].indexOf(data.widget_theme) != -1">
		 <label>Social Buttons Header Color</label>
		 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="data.theme['a'+data.addon_theme].addon_soc_fc"/>
	</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Filter by Device</h2>
				<span class="wpmcahint headhint" data-hint="Show Subscription form if the user visits from?"></span>
		</div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.addon_desktop" ng-true-value="'1'">
				<div class="mcheckbox"></div>Desktop</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.addon_tablet" ng-true-value="'1'">
				<div class="mcheckbox"></div>Tablet</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.addon_mobile" ng-true-value="'1'">
				<div class="mcheckbox"></div>Mobile</label>
		 </div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Filter by Page type</h2>
				<span class="wpmcahint headhint" data-hint="Show Subscription form if the user visits?"></span>
		</div>
		 <h3>Subscribe Box</h3>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.addon_page" ng-true-value="'1'">
				<div class="mcheckbox"></div>Pages</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.addon_post" ng-true-value="'1'">
				<div class="mcheckbox"></div>Posts</label>
		 </div>
		 <h3>Topbar</h3>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_homepage" ng-true-value="'1'">
				<div class="mcheckbox"></div>Home Page</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_blog" ng-true-value="'1'">
				<div class="mcheckbox"></div>Blog Page</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_page" ng-true-value="'1'">
				<div class="mcheckbox"></div>Pages</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_post" ng-true-value="'1'">
				<div class="mcheckbox"></div>Posts</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_category" ng-true-value="'1'">
				<div class="mcheckbox"></div>Categories/Archives</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_search" ng-true-value="'1'">
				<div class="mcheckbox"></div>Search</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.topbar_404error" ng-true-value="'1'">
				<div class="mcheckbox"></div>404 Error</label>
		 </div>
		 <h3>Flipbox</h3>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.flipbox_blog" ng-true-value="'1'">
				<div class="mcheckbox"></div>Blog Page</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.flipbox_page" ng-true-value="'1'">
				<div class="mcheckbox"></div>Pages</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.flipbox_post" ng-true-value="'1'">
				<div class="mcheckbox"></div>Posts</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.flipbox_category" ng-true-value="'1'">
				<div class="mcheckbox"></div>Categories/Archives</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.flipbox_search" ng-true-value="'1'">
				<div class="mcheckbox"></div>Search</label>
		 </div>
		 <div class="wpmca_group wpmcacb">
				<label><input type="checkbox" ng-model="data.flipbox_404error" ng-true-value="'1'">
				<div class="mcheckbox"></div>404 Error</label>
		 </div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Behaviour</h2>
			<span class="wpmcahint headhint" data-hint="Behaviour of the Addon"></span>
	</div>
	<div class="wpmca_group wpmcacb">
		<label class="wpmcapara">Orientation</label>
		<div class="wpmca_compac p1">
			<input id="ao1" type="radio" ng-model="data.addon_orient" value="top">
			<label for="ao1">Top <div class="orientvdemo topo"></div></label>
		</div>
		<div class="wpmca_compac">
			<input id="ao2" type="radio" ng-model="data.addon_orient" value="mid">
			<label for="ao2">Mid <div class="orientvdemo mido"></div></label> 
		</div>
		<div class="wpmca_compac">
			<input id="ao3" type="radio" ng-model="data.addon_orient" value="bot">
			<label for="ao3">Bottom <div class="orientvdemo boto"></div></label> 
		</div>
		<div style="clear:both"></div>
 </div>
	 <div class="wpmca_group wpmcacb">
			<label><input type="checkbox" ng-true-value="'1'" ng-model="data.addon_scode">
			<div class="mcheckbox"></div>Enable ShortCode [chimpmate]</label>
			<span class="wpmcahint" data-hint="Enable Short Code"></span>
	 </div>
</div>
<?php
	break;
	case 'advanced':
?>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Follow Us to get Instant Updates! <span class="show_love"></span></h2>
	</div>
	 <div class="wpmca_group">
		<div class="wpmc_social" style="margin-left:120px;">
			<div class="wpmc_soc_cont fb">
				<a href="https://www.facebook.com/Voltroid"><div class="wpmc_socioicon"></div></a>
				<div class="wp_likebox">
					<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=174296672696220&version=v2.0"; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-like" data-href="https://www.facebook.com/Voltroid" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
				</div>
			</div>
			<div class="wpmc_soc_cont tt">
				<a href="https://twitter.com/Voltroid"><div class="wpmc_socioicon"></div></a>
				<div class="wp_likebox" style="margin-left: -7px;">
					<a href="https://twitter.com/Voltroid" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false" data-dnt="true"></a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
			</div>
			<div class="wpmc_soc_cont gp">
				<a href="https://plus.google.com/+VoltroidInc"><div class="wpmc_socioicon"></div></a>
				<div class="wp_likebox" style="margin-left: -8px;">
					<script src="https://apis.google.com/js/platform.js" async defer></script>
					<div class="g-follow" data-annotation="none" data-height="20" data-href="https://plus.google.com/+VoltroidInc" data-rel="publisher"></div></div>
			</div>
		</div>
	 </div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Typography Live Preview</h2>
		</div>
		<div class="wpmca_group">
			<style type="text/css">
				#wpmca_preview p{
					color:{{democolor}};
					font-family:{{demofont | livepf}};
					font-size:{{demofonts}}px;
					font-weight:{{demofontw}};
					font-style:{{demofontfs}}
				}
			</style>
			<span id="wpmca_preview">
			<p>THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG</p>
			<p>the quick brown fox jumps over the lazy dog</p>
			</span>
		</div>
		<div class="wpmca_group">
				<select class="wpmca_sel google_fonts" ng-model="demofont" ng-options="f for f in fonts track by f">
					<option value="">Font</option>
					
				</select>
				<select class="wpmca_sel google_fonts_size" value="20" ng-model="demofonts" ng-options="f for f in fontsiz track by f">
						<option value="">Size</option>
				</select>
				<select class="wpmca_sel google_fonts_weight" ng-model="demofontw">
					<option value="">Weight</option>
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
					<option value="lighter">Lighter</option>
					<option value="bolder">Bolder</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="300">300</option>
					<option value="400">400</option>
					<option value="500">500</option>
					<option value="600">600</option>
					<option value="700">700</option>
					<option value="800">800</option>
					<option value="900">900</option>
				</select>
				<select class="wpmca_sel google_fonts_style" ng-model="demofontfs">
					<option value="">Style</option>
					<option value="normal">Normal</option>
					<option value="italic">Italic</option>
					<option value="oblique">oblique</option>
				</select>
		</div>
			<div class="wpmca_group wpmcacolor">
				 <input minicolors type="text" class="wpmchimp-color-sel" ng-model="democolor"/>
			</div>
</div>
<div class="wpmca_item">
		<div class="itemhead">
				<h2>Plugin Resources</h2>
		</div>
		<div class="wpmca_group wpmcapara">
			Want more awesome plugins? Encourage us by donating :)
		</div>
		<div class="wpmca_group">
				<input type="image" ng-click="wpmchimpa_donate()" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		</div>
		<div class="wpmca_group wpmcapara">
			ChimpMate is a MailChimp based email marketing plugin for wordpress. Mailchimp is one of the most powerful email marketing tool with more than 7 million users. Beginners can start using the service with free* account. Mailchimp also let the users to send mail to unlimited number of recipients. It is also ensures greater deliverability. Being inspired by mailchimp service we created this newsletter plugin for wordpress.org customers. It is a fully customizable plugin with professional design. The plugin offers easy installation of lightbox and widget. Hope you will like the plugin. Your feedback is appreciated.
		</div>
		<div class="wpmca_group wpmcapara">
		<h2>Credits</h2>
			<a href="http://voltroid.com/">Voltroid</a><br>
			<a href="http://mailchimp.com/">MailChimp</a><br>
			<a href="https://developers.google.com/fonts/docs/webfont_loader">Google Web Font Loader</a><br>
			<a href="https://developers.google.com/chart/">Google Chart</a><br>
		</div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
			<h2>Back up and Restore</h2>
	</div>
	 <div class="wpmca_group">
		<div class="wpmcapara">One click backup and restore 
			<span class="wpmcahint" data-hint="You can save your settings and restore it later"></span>
		</div>
	</div>
	<div class="wpmca_group">
		 <button class="wpmca_button green material-design" ng-click="wpmca_backup()">Backup</button>
		 <button class="wpmca_button green material-design" ng-click="wpmca_restore()">Restore</button>
		 <input type="file" id="file_sel" accept=".json" style="display:none;"/>
	</div>
</div>

<div class="wpmca_item">
		<div class="itemhead">
			<h2>Reset Plugin</h2>
		</div>
		 <div class="wpmca_group">
				<div class="wpmcapara">One click plugin reset 
					<span class="wpmcahint" data-hint="Reset your plugin to default values"></span>
				</div>
		</div>
		<div class="wpmca_group">
		 <button class="wpmca_button green material-design" ng-click="wpmca_reset()">Reset</button>
		 </div>
</div>
<div class="wpmca_item">
	<div class="itemhead">
		<h2>ChimpMate Pro</h2>
	</div>
	<div class="wpmca_group feat_list">
		<div class="fl_row">
			<div class="feat"><span>FEATURES</span></div>
			<div class="featbox_h grey"><span>FREE</span></div>
			<div class="featbox_h blue"><span style="color:#fff">PRO</span></div>
		</div>
		<div class="fl_row">
			<div class="feat">Lightbox, Slider, Widget, Add-on, Topbar, Flipbox</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Built-in Editor</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Custom Fields</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">650+ Google fonts</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Automatic List and Group Fetching</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Fully Customizable Typography </div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Typography Live Preview</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Button Customization</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Live Editor</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Search Engine Target</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">User Status Based Filter</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Reappear Delay(Cookie)</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Scroll Toggle Detection </div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Fully Responsible</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Multi-Device Filter</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Filter By Page Type</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Lightbox Open Delay </div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Inactivity based events</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">One Click Bakup and Restore</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Easy to Configuration (No coding required!)</div>
			<div class="featbox avail grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Premium Themes</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Multiple Forms</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Multiple Lists</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">A/B Testing</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Open-on-Click</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Instant Analytics</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Depart Intent Tecnolagy</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Reappear Delay Customization</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Scroll Toggle % Custamization</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Advanced Addon Behaviour Customizations</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Post/Page Level Targeting</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Targeting Social Networking vistors</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Targeting URL Shoretners</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Targeting Specific URLs</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Custom CSS editor</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row">
			<div class="feat">Premium Support 24x7</div>
			<div class="featbox pro grey"></div>
			<div class="featbox avail blue"></div>
		</div>
		<div class="fl_row last">
			<div class="featbox_h feat_buypro" ng-click="feat_buypro()"></div>
		</div>
	</div>
</div>
<?php
	break;
}
?>