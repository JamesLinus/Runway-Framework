<?php

/**
 * ExtmSettingsObject
 *
 * @category Extensions
 * @package  Core extensions
 * @author    <>
 * @license
 * @link
 */
class ExtmSettingsObject extends Runway_Object {

	private $settings_object;

	public function __construct( $settings ) {

		$this->settings = $settings;

	}

	public function __call( $name, $arguments ) {

		if ( ! isset( $this->settings_object ) ) {
			include_once FRAMEWORK_DIR . 'framework/core/admin-object.php';
			include_once __DIR__ . '/settings-object.php';
			$this->settings_object = new Extm_Admin( $this->settings );
		}

		return call_user_func_array(
			array(
				$this->settings_object,
				$name
			),
			$arguments
		);

	}

	public function __get( $name ) {
		
		if ( ! isset( $this->settings_object ) ) {
			include_once FRAMEWORK_DIR . 'framework/core/admin-object.php';
			include_once __DIR__ . '/settings-object.php';
			$this->settings_object = new Extm_Admin( $this->settings );
		}

		return isset( $this->settings_object->$name ) ? $this->settings_object->$name : false;

	}

}
