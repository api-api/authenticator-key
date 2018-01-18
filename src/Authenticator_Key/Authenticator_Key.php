<?php
/**
 * Authenticator_Key class
 *
 * @package APIAPI\Authenticator_Key
 * @since 1.0.0
 */

namespace APIAPI\Authenticator_Key;

use APIAPI\Core\Authenticators\Authenticator;
use APIAPI\Core\Request\Route_Request;
use APIAPI\Core\Exception\Request_Authentication_Exception;

if ( ! class_exists( 'APIAPI\Authenticator_Key\Authenticator_Key' ) ) {

	/**
	 * Authenticator implementation for passing a plain and simple API key.
	 *
	 * @since 1.0.0
	 */
	class Authenticator_Key extends Authenticator {
		/**
		 * Authenticates a request.
		 *
		 * This method does not yet actually authenticate the request with the server. It only sets
		 * the required values on the request object.
		 *
		 * @since 1.0.0
		 *
		 * @param Route_Request $request The request to send.
		 *
		 * @throws Request_Authentication_Exception Thrown when the request cannot be authenticated.
		 */
		public function authenticate_request( Route_Request $request ) {
			$data = $this->parse_authentication_data( $request );

			if ( empty( $data['key'] ) ) {
				throw new Request_Authentication_Exception( sprintf( 'The request to %s could not be authenticated as a key has not been passed.', $request->get_uri() ) );
			}

			$request->set_param( $data['parameter_name'], $data['key'] );
		}

		/**
		 * Checks whether a request is authenticated.
		 *
		 * This method does not check whether the request was actually authenticated with the server.
		 * It only checks whether authentication data has been properly set on it.
		 *
		 * @since 1.0.0
		 *
		 * @param Route_Request $request The request to check.
		 * @return bool True if the request is authenticated, otherwise false.
		 */
		public function is_authenticated( Route_Request $request ) {
			$data = $this->parse_authentication_data( $request );

			$key = $request->get_param( $data['parameter_name'] );

			return null !== $key;
		}

		/**
		 * Sets the default authentication arguments.
		 *
		 * @since 1.0.0
		 */
		protected function set_default_args() {
			$this->default_args = array(
				'parameter_name' => 'key',
				'key'            => '',
			);
		}
	}

}
