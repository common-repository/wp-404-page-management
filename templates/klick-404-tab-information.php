<!-- First Tab content -->
<div id="klick_404_tab_first">
		<div class="klick-notice-message"></div>
		<div class="wp-list-table widefat fixed striped klick-404-list"> <!-- Klick tab specific notice starts -->
			<span id="message_lbl" class="info">
				<?php if (($options->is_configured_url_and_toggle() == false )) { 
					_e("404 page redirection is not active", "klick-404"); 
					} else { 
					_e("Your 404 page redirect is enabled and visitors will be sent to", "klick-404");
					} ?> 
			</span>
			
			<div id="klick_404_setting_list" style="display: none;">
				<div id="klick_404_table_url">
					<?php echo (($options -> get_option('url') != false) ? $options -> get_option('url') : '' ); ?>
				</div>
			</div>
		</div> <!-- Klick tab specific notice ends -->
	    <hr/>

	    <script type="text/javascript">
	        var klick_404_ajax_nonce='<?php echo wp_create_nonce('klick_404_ajax_nonce'); ?>';
	    </script>

	    <?php 
	    $url = $options -> get_option('url');
	    $url = (isset($url) ? $url : '' );
	    ?>
	
	    <div class="klick-404-form-wrapper"> <!-- Form wrapper starts -->
			<form>
	            <table class="form-table">
	                <tbody>
	                    <p id="klick_404_blank_error" class="klick-404-error"></p>
	                    <tr>
	                        <th>
	                            <label for="klick_404_url">Url : </label>
	                        </th>
	                        <td>
	                            <input class="regular-text" type="text" value="<?php echo $url; ?>" name="klick_404_url" id="klick_404_url" placeholder="Enter your redirect url">
	                            <span class="klick-404-error-text"></span>
	                        </td>
	                    </tr>
	                    <tr>
	                        <th>
	                            <label for="klick_404_url">On/Off : </label>
	                        </th>
	                        <td>
	                        	<?php $urltoggle = $options -> get_option('send-url'); ?>
	                            ON : <input type="radio" name="klick_404_url_toggle" value="<?php _e('ON','klick-404'); ?>" class="klick-404-send-url" <?php echo (!empty($urltoggle) ? 'checked = "checked"' : '' ); ?>> 
	                            OFF : <input type="radio" name="klick_404_url_toggle" value="<?php _e('OFF','klick-404'); ?>" class="klick-404-send-url" <?php echo (empty($urltoggle) ? 'checked = "checked"' : '' ); ?>>
	                            <span class="klick-404-error-text"></span>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </form>

	        <p class="submit">
	            <button id="klick_url_Save" name="klick_url_Save" class="klick_btn button button-primary" disabled="disabled"><?php _e('Save','klick-404'); ?></button>
	        </p>
	        
	    </div> <!-- Form wrapper ends -->
</div>

<script type="text/javascript">
	var klick_404_ajax_nonce ='<?php echo wp_create_nonce('klick_404_ajax_nonce'); ?>';
</script>
