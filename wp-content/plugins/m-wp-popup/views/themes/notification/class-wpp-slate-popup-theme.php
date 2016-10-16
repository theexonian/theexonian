<?php

class Wpp_Slate_Popup_Theme extends Wpp_Popup_Theme {

	protected $id = 'wpp_theme_slate';

	protected $description = 'Simple theme with call to action and message';

	protected $name = 'Notification Popup with Call to action button';

	function save_settings( $popup_id ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		if ( ! isset( $_POST['theme_is_1'] ) )
			return FALSE;

		$content = $_POST['t1_content'];

		$header = $_POST['t1_header'];

		$cta_url = $_POST['t1_cta_url'];

		$btntxt = $_POST['t1_btntxt'];

		$settings = array(
				'header' => $header,
				'content' => $content,
				'cta_url' => $cta_url,
				'btntxt' => $btntxt,
				'style' => $_POST['t_style']
			);

		$this->save_settings_to_db( $popup_id, $settings );

	}

	function render_settings( $popup_id ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		$settings = $this->get_settings( $popup_id );

		$content = $settings['content'];

		include wpp_view_path( 'themes/notification/theme_admin_view.php' );

	}

	public function auto_popup_render( $popup_id ) {

		if ( ! $this->check_rules( $popup_id ) )
			return FALSE;

		$settings = $this->get_settings( $popup_id );

		$uniq_id = uniqid();

		$content = $this->filter_content( $settings['content'] );

		include wpp_view_path( 'themes/notification/theme_frontend_view.php' );


	}

	function link_popup_render( $popup_id, $shortcode_atts ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		$link_text = $shortcode_atts['link_text'];

		$settings = $this->get_settings( $popup_id );

		$uniq_id = uniqid();

		$content = $this->filter_content( $settings['content'] );

		include wpp_view_path( 'themes/notification/theme_frontend_link_view.php' );

	}

	function default_settings() {

		return $settings = array(
				'header' => 'Integer sit amet sem et orci dignissim consectetur',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus quam libero, nec pharetra augue aliquam in. Integer sit amet sem et orci dignissim vestibulum vitae id turpis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce laoreet, dolor sit amet vestibulum dictum.<p> </p><p class="wpp_mnp_p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus quam libero, nec</p>',
				'btntxt' => 'Call to Action',
				'cta_url' => '',
				'style' => array( 
					'heading_color' => '#000',
					'btntxt_color' => '#fff',
					'btn_color' => '#ff6600',
					'font' => 'default',
					'box_color' => '#ffffff'
				 )
			);

	}

	private function filter_content( $content ) {

		$content = do_shortcode( wpautop( $content ) );

		return $content;

	}

	function theme_style_view( $popup_id, $popup_theme ) {

		if ( ! $this->is_activated( $popup_id ) )
			return FALSE;

		$settings = $this->get_settings( $popup_id );

		include wpp_view_path( 'themes/notification/theme_style_admin_view.php' );

	}

}
