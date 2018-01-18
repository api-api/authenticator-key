<?php
/**
 * Authenticator loader.
 *
 * @package APIAPI\Authenticator_Key
 * @since 1.0.0
 */

if ( ! function_exists( 'apiapi_register_authenticator_key' ) ) {

	/**
	 * Registers the authenticator for passing a plain and simple API key.
	 *
	 * It is stored in a global if the API-API has not yet been loaded.
	 *
	 * @since 1.0.0
	 */
	function apiapi_register_authenticator_key() {
		if ( function_exists( 'apiapi_manager' ) ) {
			apiapi_manager()->authenticators()->register( 'key', 'APIAPI\Authenticator_Key\Authenticator_Key' );
		} else {
			if ( ! isset( $GLOBALS['_apiapi_authenticators_loader'] ) ) {
				$GLOBALS['_apiapi_authenticators_loader'] = array();
			}

			$GLOBALS['_apiapi_authenticators_loader']['key'] = 'APIAPI\Authenticator_Key\Authenticator_Key';
		}
	}

	apiapi_register_authenticator_key();

}
