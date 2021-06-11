<?php
/**
 * Part of Woo Mercado Pago Module
 * Author - Mercado Pago
 * Developer
 * Copyright - Copyright(c) MercadoPago [https://www.mercadopago.com]
 * License - https://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 *
 * @package MercadoPago
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WC WooMercadoPago Init class
 */
class WC_WooMercadoPago_Init {

	/**
	 * Load plugin text domain.
	 *
	 * Need to require here before test for PHP version.
	 *
	 * @since 3.0.1
	 */
	public static function woocommerce_mercadopago_load_plugin_textdomain() {
		$text_domain = 'woocommerce-mercadopago';
		$locale      = apply_filters( 'plugin_locale', get_locale(), $text_domain );

		$original_language_file = dirname( __FILE__ ) . '/../../i18n/languages/woocommerce-mercadopago-' . $locale . '.mo';

		// Unload the translation for the text domain of the plugin.
		unload_textdomain( $text_domain );
		// Load first the override file.
		load_textdomain( $text_domain, $original_language_file );
	}

	/**
	 * Notice about unsupported PHP version.
	 *
	 * @since 3.0.1
	 */
	public static function wc_mercado_pago_unsupported_php_version_notice() {
		$type    = 'error';
		$message = esc_html__( 'Mercado Pago payments for WooCommerce requires PHP version 5.6 or later. Please update your PHP version.', 'woocommerce-mercadopago' );
		// @todo using escaping function
		// @codingStandardsIgnoreLine
		echo WC_WooMercadoPago_Notices::get_alert_frame( $message, $type );
	}

	/**
	 * Curl validation
	 */
	public static function wc_mercado_pago_notify_curl_error() {
		$type    = 'error';
		$message = __( 'Mercado Pago Error: PHP Extension CURL is not installed.', 'woocommerce-mercadopago' );
		// @todo using escaping function
		// @codingStandardsIgnoreLine
		echo WC_WooMercadoPago_Notices::get_alert_frame( $message, $type );
	}

	/**
	 * Summary: Places a warning error to notify user that WooCommerce is missing.
	 * Description: Places a warning error to notify user that WooCommerce is missing.
	 */
	public static function notify_woocommerce_miss() {
		$type    = 'error';
		$message = sprintf(
			/* translators: %s link to WooCommerce */
			__( 'The Mercado Pago module needs an active version of %s in order to work!', 'woocommerce-mercadopago' ),
			' <a href="https://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a>'
		);
		WC_WooMercadoPago_Notices::get_alert_woocommerce_miss( $message, $type );
	}

	/**
	 * Add mp order meta box actions function
	 *
	 * @param array $actions actions.
	 * @return array
	 */
	public static function add_mp_order_meta_box_actions( $actions ) {
		$actions['cancel_order'] = __( 'Cancel order', 'woocommerce-mercadopago' );
		return $actions;
	}

	/**
	 * Mp show admin notices function
	 *
	 * @return void
	 */
	public static function mp_show_admin_notices() {
		// @todo needs processing form data without nonce verification.
		// @codingStandardsIgnoreLine
		if ( ! WC_WooMercadoPago_Module::is_wc_new_version() || ( isset( $_GET['page'] ) && 'wc-settings' === $_GET['page'] ) && is_plugin_active( 'woocommerce-admin/woocommerce-admin.php' ) ) {
			return;
		}

		$notices_array = WC_WooMercadoPago_Module::$notices;
		$notices       = array_unique( $notices_array, SORT_STRING );
		foreach ( $notices as $notice ) {
			// @todo All output should be run through an escaping function
		    // @codingStandardsIgnoreLine
			echo $notice;
		}
	}

	/**
	 * Activation plugin hook
	 */
	public static function mercadopago_plugin_activation() {
		$dismissed_review = (int) get_option( '_mp_dismiss_review' );
		if ( ! isset( $dismissed_review ) || 1 === $dismissed_review ) {
			update_option( '_mp_dismiss_review', 0, true );
		}
	}

	/**
	 * Update plugin version in db
	 */
	public static function update_plugin_version() {
		$old_version = get_option( '_mp_version', '0' );
		if ( version_compare( WC_WooMercadoPago_Constants::VERSION, $old_version, '>' ) ) {
			do_action( 'mercadopago_plugin_updated' );
			update_option( '_mp_version', WC_WooMercadoPago_Constants::VERSION, true );
		}
	}

	/**
	 * Init the plugin
	 */
	public static function woocommerce_mercadopago_init() {
		self::woocommerce_mercadopago_load_plugin_textdomain();
		require_once dirname( __FILE__ ) . '/config/class-wc-woomercadopago-constants.php';
		require_once dirname( __FILE__ ) . '../../admin/notices/class-wc-woomercadopago-notices.php';
		WC_WooMercadoPago_Notices::init_mercadopago_notice();

		// Check for PHP version and throw notice.
		if ( version_compare( PHP_VERSION, '5.6', '<=' ) ) {
			add_action( 'admin_notices', array( __CLASS__, 'wc_mercado_pago_unsupported_php_version_notice' ) );
			return;
		}

		if ( ! in_array( 'curl', get_loaded_extensions(), true ) ) {
			add_action( 'admin_notices', array( __CLASS__, 'wc_mercado_pago_notify_curl_error' ) );
			return;
		}

		// Load Mercado Pago SDK.
		require_once dirname( __FILE__ ) . '/sdk/lib/class-mp.php';

		// Checks with WooCommerce is installed.
		if ( class_exists( 'WC_Payment_Gateway' ) ) {
			require_once dirname( __FILE__ ) . '/class-wc-woomercadopago-exception.php';
			require_once dirname( __FILE__ ) . '/class-wc-woomercadopago-configs.php';
			require_once dirname( __FILE__ ) . '/log/class-wc-woomercadopago-log.php';
			require_once dirname( __FILE__ ) . '/class-wc-woomercadopago-module.php';
			require_once dirname( __FILE__ ) . '/class-wc-woomercadopago-credentials.php';
			require_once dirname( __FILE__ ) . '../../admin/notices/class-wc-woomercadopago-review-notice.php';

			WC_WooMercadoPago_Module::init_mercado_pago_class();
			WC_WooMercadoPago_Review_Notice::init_mercadopago_review_notice();
			self::update_plugin_version();

			add_action( 'woocommerce_order_actions', array( __CLASS__, 'add_mp_order_meta_box_actions' ) );
		} else {
			add_action( 'admin_notices', array( __CLASS__, 'notify_woocommerce_miss' ) );
		}
		add_action( 'woocommerce_settings_checkout', array( __CLASS__, 'mp_show_admin_notices' ) );
	}
}
