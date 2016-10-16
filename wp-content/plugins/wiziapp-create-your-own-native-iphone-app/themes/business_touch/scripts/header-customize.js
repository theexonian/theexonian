/**
 * WiziApp - Smooth Touch
 *
 * License: Distributed under the GPL
 * Copyright: Wiziapp Solutions Ltd, http://www.wiziapp.com
 */

(function($, w, d, undef) {
	var api = wp.customize;

	api.bind("ready", function() {
		var radiobuttons = $("#customize-control-wiziapp_theme_be_in_touch_settings_header_type input");
		radiobuttons.click(function() {
			check_shown_elements($(this).val());
		});
		check_shown_elements(radiobuttons.filter(":checked").val());

		function check_shown_elements(type_selected) {
			$("#customize-control-wiziapp_theme_be_in_touch_settings_header_title, #customize-control-wiziapp_theme_be_in_touch_settings_header_color, #customize-control-wiziapp_theme_be_in_touch_settings_header_background")
			.toggle(type_selected === "text");
			$("#customize-control-wiziapp_theme_be_in_touch_settings_header_image")
			.toggle(type_selected === "image");
		}

		$(".customize-control-wiziapp-multi-image").each(function() {
			var container = $(this);
			container.on( 'click keydown', '.upload-button', openFrame );

			var frame = null;
			var frame_state = null;
			var frame_title = $(".upload-button", container).attr("data-frame-title");
			var frame_button = $(".upload-button", container).attr("data-frame-button");

			var setting = api.when(container.attr("id").replace(/^customize-control-/, ""));

			function openFrame(event) {
				if ( api.utils.isKeydownButNotEnterEvent( event ) ) {
					return;
				}

				event.preventDefault();

				if ( ! frame ) {
					initFrame();
				}

				setting.done(function(val) {
					var ids = val.get().split(",");
					var ids_map = {};
					for (var i = 0; i < ids.length; i++)
					{
						ids_map[ids[i]|0] = true;
					}
					var filtered = new wp.media.model.Attachments([], {
						filters: [function(elem) {
							return ids_map[elem.id];
						}]
					});
					filtered.mirror(frame_state.get('library'));
					frame_state.get('selection').mirror(filtered);
					frame.open();
				});
			}

			function initFrame() {
				frame = wp.media({
					button: {
						text: frame_button
					},
					states: [
						frame_state = new wp.media.controller.Library({
							title:     frame_title,
							library:   wp.media.query({ type: "image" }),
							multiple:  true,
							date:      false
						})
					]
				});

				// When a file is selected, run a callback.
				frame.on( 'select', select );
			}

			function select() {
				var attachments = [];
				frame_state.get( 'selection' ).each(function(elem) {
					attachments.push(elem.id);
				});

				setting.done(function(val) {
					val.set(attachments.join(","));
				});
			}
		});
	});
})(jQuery, window, document);
