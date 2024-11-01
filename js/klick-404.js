/**
 * Send an action via admin-ajax.php
 * 
 * @param {string} action - the action to send
 * @param * data - data to send
 * @param Callback [callback] - will be called with the results
 * @param {boolean} [json_parse=true] - JSON parse the results
 */
var klick_404_send_command = function (action, data, callback, json_parse) {
	json_parse = ('undefined' === typeof json_parse) ? true : json_parse;
	var ajax_data = {
		action: 'klick_404_ajax',
		subaction: action,
		nonce: klick_404_ajax_nonce,
		data: data
	};
	jQuery.post(ajaxurl, ajax_data, function (response) {
		
		if (json_parse) {
			try {
				var resp = JSON.parse(response);
			} catch (e) {
				console.log(e);
				console.log(response);
				return;
			}
		} else {
			var resp = response;
		}
		
		if ('undefined' !== typeof callback) callback(resp);
	});
}

/**
 * When DOM ready
 * 
 */
jQuery(document).ready(function ($) {
	klick_404 = klick_404(klick_404_send_command);
});

/**
 * Function for sending communications
 * 
 * @callable sendcommandCallable
 * @param {string} action - the action to send
 * @param * data - data to send
 * @param Callback [callback] - will be called with the results
 * @param {boolean} [json_parse=true] - JSON parse the results
 */
/**
 * Main klick_404
 * 
 * @param {sendcommandCallable} send_command
 */
var klick_404 = function (klick_404_send_command) {
	var $ = jQuery;

	// initialize DOM in tabs area
	var init_tabs = function(){
		if (($(".klick-404-send-url:checked").val() !== "OFF")) {
			$("#klick_404_setting_list").css('display','block');
			// alert("There is off");
		}
	}

	init_tabs();
	
	// Disable/enable save when url change
	$("#klick_404_url").keyup(function(){
		var redirect_url = $(this).val();
			if( isValidUrlAddress(redirect_url)) { 
				$("#klick_url_Save").css('opacity',1);
				$("#klick_url_Save").prop('disabled','');
			} else{
				$("#klick_url_Save").css('opacity',0.5);
				$("#klick_url_Save").prop('disabled','disabled');
			}
	});

	// Test for valid url address
	function isValidUrlAddress(redirect_url) {
	   return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(redirect_url);
	}

	// Url toggle change handler
	$(".klick-404-send-url").change(function(){
		var urladdress = $("#klick_404_url").val();
			if( isValidUrlAddress(urladdress)) { 
				$("#klick_url_Save").prop('disabled','');
			} else{
				$("#klick_url_Save").prop('disabled','disabled');
			}
	});

	/**
	 * Gathers the details from form
	 * 
	 * @returns (string) - serialized row data
	 */
	function gather_row(){
		var form_data = $(".klick-404-form-wrapper form").serialize();
		return form_data;	
	}

	// Send 'klick_404_save_settings' command, Response handler
	$("#klick_url_Save").click(function() {
		$which_button = $(this).text();
		if($which_button == "Save") {
			$(this).prop('disabled','disabled');
			var form_data = gather_row();
			klick_404_send_command('klick_404_save_settings', form_data, function (resp) {
				if (resp.status['status'] == "1") {
					if (($(".klick-404-send-url:checked").val() == "ON")) {
						$(".klick-404-list").slideUp(200,function(){
							$("#message_lbl").html("<i> your 404 page redirect is enabled and visitors will be sent to </i>");
							$("#klick_404_table_url").html(resp.status['data']['url']);
							$("#klick_404_setting_list").css("display","block");
							$(this).slideDown();
						});
					} else {
						$(".klick-404-list").slideUp(200,function(){
							$("#message_lbl").html("<i> 404 page redirection is not active </i>");
							$("#klick_404_setting_list").css("display","none");
							$(this).slideDown();
						});
					}
				}

				$('.klick-notice-message').html(resp.status['messages']);
				$('.fade').delay(2000).slideUp(200, function(){
					$("#klick_btn_Save").prop('disabled','disabled');
				});
			
			});
		}
	});
	
	/**
	 * Proceses the tab click handler
	 *
	 * @return void
	 */
	$('#klick_404_nav_tab_wrapper .nav-tab').click(function (e) {
		e.preventDefault();
		
		var clicked_tab_id = $(this).attr('id');
	
		if (!clicked_tab_id) { return; }
		if ('klick_404_nav_tab_' != clicked_tab_id.substring(0, 18)) { return; }
		
		var clicked_tab_id = clicked_tab_id.substring(18);

		$('#klick_404_nav_tab_wrapper .nav-tab:not(#klick_404_nav_tab_' + clicked_tab_id + ')').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');

		$('.klick-404-nav-tab-contents:not(#klick_404_nav_tab_contents_' + clicked_tab_id + ')').hide();
		$('#klick_404_nav_tab_contents_' + clicked_tab_id).show();
	});
}
