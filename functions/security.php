<?php

/*
 *	Make the REST API private
 */
function logged_in_only_rest_api( $result ) {
	if (!empty($result)) {
		return $result;
	}

	if (!is_user_logged_in()) {
		return new WP_Error('rest_not_logged_in', 'API Requests are only supported for authenticated requests.', array( 'status' => 401 ));
	}

	return $result;
}
add_filter('rest_authentication_errors', 'logged_in_only_rest_api');

/*
 * Remove Pingback XMLRPC
 */ 
function sar_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
add_filter('xmlrpc_methods', 'sar_block_xmlrpc_attacks');

function sar_remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}
add_filter('wp_headers', 'sar_remove_x_pingback_header');