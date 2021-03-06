<?php

	function update_app_page($appname){

	$appslist = get_option('mo_oauth_apps_list');
	$currentappname = $appname;
	$currentapp = null;
	foreach($appslist as $key => $app){
		if($appname == $key){
			$currentapp = $app;
			break;
		}
	}
	if(!$currentapp)
		return;
	$is_other_app = true;
		
	?>
		<div id="toggle2" class="mo_panel_toggle">
			<h3>Configure OAuth Provider</h3>
		</div>
		<div id="mo_oauth_update_app">
			
		<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings">
		<?php wp_nonce_field('mo_oauth_add_app_form','mo_oauth_add_app_form_field'); ?>
		<input type="hidden" name="option" value="mo_oauth_add_app" />
		<table class="mo_settings_table">
			<tr>
			<td><strong><font color="#FF0000">*</font>Application:</strong></td>
			<td>
				<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_app_name" value="<?php echo isset($currentapp['appId']) ? $currentapp['appId'] : "other";?>">
				<input class="mo_table_textbox" required="" type="hidden" id="mo_oauth_app_nameid" name="mo_oauth_app_nameid" value="<?php echo $currentappname;?>">
				<input class="mo_table_textbox" required="" type="hidden" name="mo_oauth_custom_app_name" value="<?php echo $currentappname;?>">
				<input type="hidden" name="mo_oauth_app_type" value="<?php echo $currentapp['apptype'];?>">
				<?php echo $currentappname;?><br><br>
			</td>
			</tr>
			<tr id="mo_oauth_display_app_name_div">
				<td><strong>Display App Name:</strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[STANDARD]</a></small></font></td>
				<td><input disabled class="mo_table_textbox" type="text"></td>
			</tr>
			<tr>
				<td><strong>SSO Protocol:</strong><br>&emsp;<font color="#FF0000"></font></td>
				<td><input disabled class="mo_table_textbox" type="text" id="mo_oauth_sso_protocol" name="mo_oauth_sso_protocol" value="<?php if(isset($currentapp['ssoprotocol'])) echo $currentapp['ssoprotocol']; else echo $currentapp['apptype'];?>"></td>
			</tr>
			<tr><td><strong>Redirect / Callback URL</strong></td>
			<td><input class="mo_table_textbox"  type="text" readonly="true" value='<?php echo $currentapp['redirecturi'];?>'></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client ID:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_id" value="<?php echo $currentapp['clientid'];?>"></td>
			</tr>
			<tr>
				<td><strong><font color="#FF0000">*</font>Client Secret:</strong></td>
				<td><input class="mo_table_textbox" required="" type="text" name="mo_oauth_client_secret" value="<?php echo $currentapp['clientsecret'];?>"></td>
			</tr>
			<tr>
				<td><strong>Scope:</strong></td>
				<td><input class="mo_table_textbox" type="text" name="mo_oauth_scope" value="<?php echo $currentapp['scope'];?>"></td>
			</tr>
			<?php if($is_other_app){ ?>
				<tr  id="mo_oauth_authorizeurl_div">
					<td><strong><font color="#FF0000">*</font>Authorize Endpoint:</strong></td>
					<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value="<?php echo $currentapp['authorizeurl'];?>"></td>
				</tr>
				<tr id="mo_oauth_accesstokenurl_div">
					<td><strong><font color="#FF0000">*</font>Access Token Endpoint:</strong></td>
					<td><input class="mo_table_textbox" required="" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value="<?php echo $currentapp['accesstokenurl'];?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><div style="padding:5px;"></div><input type="checkbox" class="mo_table_textbox" name="mo_oauth_authorization_header" <?php if(isset($currentapp['send_headers'])){if($currentapp['send_headers'] == 1){ echo 'checked';}}else {echo 'checked';}?> value="1">Set client credentials in Header<span style="padding:0px 0px 0px 8px;"></span><input type="checkbox" class="mo_table_textbox" name="mo_oauth_body"<?php if(isset($currentapp['send_body'])){if($currentapp['send_body'] == 1){ echo 'checked';}}else {echo 'checked';}?> value="1">Set client credentials in Body<div style="padding:5px;"></div></td>
				</tr>
				<?php if( isset($currentapp['apptype']) && $currentapp['apptype'] != 'openidconnect') { 
						$oidc = false;
					} else {
						$oidc = true;
					}
					?>
				<tr id="mo_oauth_resourceownerdetailsurl_div">
					<td><strong><?php if($oidc === false) { echo '<font color="#FF0000">*</font>'; } ?>Get User Info Endpoint:</strong></td>
					<td><input class="mo_table_textbox" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" <?php if($oidc === false) { echo 'required';} ?> value="<?php if(isset($currentapp['resourceownerdetailsurl'])) { echo $currentapp['resourceownerdetailsurl']; } ?>"></td>
				</tr>			
			<tr>
				<td><strong>Group User Info Endpoint:</strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[PREMIUM]</a></small></font></td>
				<td><input class="mo_table_textbox" type="text" value="" disabled></td>
			</tr>
			<tr>
				<td><strong>JWKS URL:</strong><br>&emsp;<font color="#FF0000"><small><a href="admin.php?page=mo_oauth_settings&tab=licensing" target="_blank" rel="noopener noreferrer">[PREMIUM]</a></small></font></td>
				<td><input class="mo_table_textbox" type="text" value="" disabled></td>
			</tr>
			<tr>
				<td><strong>Login Button:</strong></td>
				<td><div style="padding:5px;"></div><input type="checkbox" name="mo_oauth_show_on_login_page" value ="1" <?php if(isset($currentapp['show_on_login_page'])) { if($currentapp['show_on_login_page'] === 1 ) echo 'checked'; } ; ?>/>Show on login page</td>
			</tr>
			<tr>
				<td><br></td>
				<td><br></td>
			</tr>
            
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="submit" value="Save settings" class="button button-primary button-large" />
					<!-- <?php if($is_other_app){?> -->
						<input id="mo_oauth_test_configuration" type="button" name="button" value="Test Configuration" class="button button-primary button-large" onclick="testConfiguration()" />
					<!-- <?php } ?> -->
				</td>
			</tr>
			<tr>
				<td><strong>Note:</strong></td>
				<td colspan="2">
					<b>Please configure <a href='admin.php?page=mo_oauth_settings&tab=attributemapping'>Attribute Mapping</a> before trying Single Sign-On.</b>
				</td>
			</tr>
		</table>
		</form>
		</div>
		</div>
		<?php if($is_other_app){ ?>
		<script>
		function testConfiguration(){
			var mo_oauth_app_name = jQuery("#mo_oauth_app_nameid").val();
			var myWindow = window.open('<?php echo site_url(); ?>' + '/?option=testattrmappingconfig&app='+mo_oauth_app_name, "Test Attribute Configuration", "width=600, height=600");
			while(1) {
				if(myWindow.closed()) {
					$(document).trigger("config_tested");
					break;
				} else {continue;}
			}
		}
		</script>
		<?php }
		grant_type_settings();
}
