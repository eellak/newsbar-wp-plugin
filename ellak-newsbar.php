<?php
/*
 * Plugin Name: Ellak newsbar
 * Plugin URI:  http://mtzanidakis.com/
 * Description: Re-write of legacy iframe newsbar to wordpress plugin.
 * Version:     0.1
 * Author:      Manolis Tzanidakis
 * Author URI:  http://mtzanidakis.com/
 * License:     ISC
 */

/* Plugin localization */
function ellak_newsbar_textdomain() {
        load_plugin_textdomain(
                'ellak-newsbar', false,
                dirname( plugin_basename( __FILE__ ) ) . '/languages/'
        );
}
add_action( 'plugins_loaded', 'ellak_newsbar_textdomain' );

/* register the style for this plugin */
function ellak_newsbar_style() {
        wp_register_style( 'ellak-newsbar-css', plugin_dir_url( __FILE__ )
                . '/css/style.css' );
	wp_enqueue_style( 'ellak-newsbar-css' );
}
add_action( 'wp_enqueue_scripts', 'ellak_newsbar_style' );


if( ! function_exists( 'ellak_newsbar' ) ) {
	function ellak_newsbar() {
?>
		<div id="ellak-newsbar-cont">
			<div id="ellak-newsbar">
		<div class="header-login">
				<a href="https://mathe.ellak.gr/" title="μάθε ΕΛ/ΛΑΚ" target="_blank">Τι είναι το ΕΛ/ΛΑΚ;</a>
				<?php if( is_user_logged_in() ): ?>
				<a href="<?php echo esc_url( 'https://ellak.gr/account' ); ?>"><?php _e( 'Ο λογαριασμός μου', 'gpchild-ellak' ); ?></a>
				<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>"><?php _e( 'Αποσύνδεση', 'gpchild-ellak' ); ?></a>

				<?php else:

					if( get_option( 'users_can_register' ) ): ?>
				<a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php _e( 'Εγγραφή', 'gpchild-ellak' ); ?></a>
				<?php	endif; // get_option ?>

				<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Συνδεση', 'gpchild-ellak' ); ?></a>

				<?php endif; // is_user_logged_in ?>
			</div>
				<div id="ellak-sites">
					<a href="https://ellak.gr/" title="ΕΕΛ/ΛΑΚ">ΕΕΛ/ΛΑΚ</a>
					<span class="sep"> | </span>
					<a href="http://creativecommons.gr/" title="creativecommons.gr">creativecommons.gr</a>
					<span class="sep"> | </span>
					<a href="https://mycontent.ellak.gr/" title="mycontent.ellak.gr">mycontent.ellak.gr</a>
					<span class="sep"> | </span>

					<select onchange="if(this.value) window.location.href=this.value">
            <option value="">Δικτυακοί τόποι</option>
						<option value="https://planet.ellak.gr">Πλανήτης ΕΛ/ΛΑΚ</option>
						<option value="https://edu.ellak.gr">Εκπαίδευση</option>
						<option value="https://mathe.ellak.gr">mathe.ΕΛΛΑΚ</option>
						<option value="https://ccradio.ellak.gr">CCRadio</option>
						<option value="https://github.com/eellak">Έργα στο GitHub</option>
						<option value="http://repository.ellak.gr">Αποθετήριο ΕΛ/ΛΑΚ</option>
            <option value="https://odi.ellak.gr/">Open Data Institute</option>
						<option value="https://obs.ellak.gr/">Ανοιχτοί Προϋπολογισμοί</option>
						<option value="https://eellak.gr">ΕΕΛ/ΛΑΚ</option>
            <option value="https://gfoss.eu">GFOSS</option>
						<option value="https://advisory.ellak.gr/">Διαβουλεύσεις</option>
						<option value="https://legal.ellak.gr/">Νομοθεσία και ανοιχτές τεχνολογίες</option>
						<option value="https://openwifi.gr">OpenWifi</option>
            <option value="https://smartcities.ellak.gr">Smartcities</option>
						<option value="">Ομάδες Εργασίας</option>
						<option value="https://opensource.ellak.gr">Ανοιχτό Λογισμικό</option>
						<option value="https://opendata.ellak.gr">Ανοιχτά Δεδομένα</option>
						<option value="https://opengov.ellak.gr">Ανοιχτή Διακυβέρνηση</option>
						<option value="https://openhardware.ellak.gr">Ανοιχτό Υλισμικό</option>
						<option value="https://openstandards.ellak.gr">Ανοιχτα Πρότυπα και Άδειες</option>
						<option value="https://privacy.ellak.gr">Ασφάλεια και Ιδιωτικότητα</option>
						<option value="https://oer.ellak.gr">Ανοιχτότητα στην Εκπαίδευση</option>
					</select>
				</div><!-- #ellak-sites -->
			</div><!-- #ellak-newsbar -->
		</div><!-- #ellak-newsbar-cont -->
<?php
	}
}
?>
