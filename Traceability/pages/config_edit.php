<?php
	require_once('api.php');
	
	form_security_validate( 'plugin_traceability_config_edit' );

	auth_reauthenticate( );
	access_ensure_global_level( plugin_config_get( 'manage_threshold' ) );

	$f_req_id_var = gpc_get_int( 'req_id_var_idx', PLUGIN_TRACEABILITY_VAR_IDX_NONE );
	$f_req_issue_status_threshold = gpc_get_int( 'req_issue_status_threshold', 
		PLUGIN_TRACEABILITY_ISSUE_STATUS_THRSHD_DEFAULT);
	$f_test_id_var = gpc_get_int( 'test_id_var_idx', PLUGIN_TRACEABILITY_VAR_IDX_NONE );
	$f_test_issue_status_threshold = gpc_get_int( 'test_issue_status_threshold', 
		PLUGIN_TRACEABILITY_ISSUE_STATUS_THRSHD_DEFAULT);
	$f_id_delimiter = gpc_get_string( 'id_delimiter' );		
	$f_manage_threshold = gpc_get_int( 'manage_threshold', ADMINISTRATOR );

	html_page_top( null, plugin_page( 'config', true ) );

	print_manage_menu();
	
	echo '<br /><div class="center">';

	if($f_req_id_var != $f_test_id_var && $f_id_delimiter != '') {
		if( plugin_config_get( 'req_id_var_idx' ) != $f_req_id_var ) {
			plugin_config_set( 'req_id_var_idx', $f_req_id_var );
		}
	
		if( plugin_config_get( 'req_issue_status_threshold' ) != $f_req_issue_status_threshold ) {
			plugin_config_set( 'req_issue_status_threshold', $f_req_issue_status_threshold );
		}
		
		if( plugin_config_get( 'test_id_var_idx' ) != $f_test_id_var ) {
			plugin_config_set( 'test_id_var_idx', $f_test_id_var );
		}

		if( plugin_config_get( 'test_issue_status_threshold' ) != $f_test_issue_status_threshold ) {
			plugin_config_set( 'test_issue_status_threshold', $f_test_issue_status_threshold );
		}
		
		if( plugin_config_get( 'id_delimiter' ) != $f_id_delimiter ) {
			plugin_config_set( 'id_delimiter', $f_id_delimiter );
		}

		if( plugin_config_get( 'manage_threshold' ) != $f_manage_threshold ) {
			plugin_config_set( 'manage_threshold', $f_manage_threshold );
		}		

		echo lang_get( 'operation_successful' ) . '<br />';
	}
	else {
		trigger_error( ERROR_CONFIG_OPT_INVALID, WARNING );		
	}
	
	print_bracket_link( plugin_page( 'config', true ), lang_get( 'proceed' ) );
	echo '</div>';
	html_page_bottom();			
?>