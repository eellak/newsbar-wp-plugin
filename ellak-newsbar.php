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
<?php
		// load wordpress rss functions (SimplePIE)
		include_once( ABSPATH . WPINC . '/feed.php' );

		// Ellak Friendfeed url
		$ellak_feed = fetch_feed(
			'https://planet.ellak.gr/atom.xml' );

		if( ! is_wp_error( $ellak_feed ) ) {
			/* get the items and randomize their order */
			$rss_items = $ellak_feed->get_items();
			shuffle( $rss_items );
		}

		if( ! empty( $rss_items ) ) {
			// get the url & the title of the first object..
			foreach( $rss_items as $rss_item ) {
				$url = esc_url( $rss_item->get_permalink() );
				$title = $rss_item->get_title();

				// ..and stop the loop
				break;
			}

			// trim the title to 100 characters (with words only)
			if( strlen( $title ) > 100 ) {
				$title = preg_replace(
					"/^(.{1,100})(\s.*|$)/s",
					'\\1 &hellip;',
					$title );
			}

			echo "\n" . '<div id="ellak-planet"><a href="'
				. $url . '" target="_blank">' . $title
				. '</a></div>';
		}
?>

				<div id="ellak-sites">
					<a href="https://ellak.gr/" title="ΕΕΛ/ΛΑΚ">ΕΕΛ/ΛΑΚ</a>

					<select onchange="if(this.value) window.location.href=this.value">
						<option value="">Δικτυακοί τόποι</option>

						<option value="https://planet.ellak.gr">Πλανήτης ελλ.κοινότητας ΕΛ/ΛΑΚ</option>
						<option value="https://ellak.gr/wikis/%CF%87%CF%8E%CF%81%CE%BF%CF%82-%CF%83%CF%85%CE%BD%CE%B5%CF%81%CE%B3%CE%B1%CF%83%CE%AF%CE%B1%CF%82/%CE%BF%CE%BC%CE%AC%CE%B4%CE%B5%CF%82-%CE%B5%CF%81%CE%B3%CE%B1%CF%83%CE%AF%CE%B5%CF%82/">Blogs Ομάδων Εργασίας</option>
						<option value="http://repository.ellak.gr">Αποθετήριο ΕΛ/ΛΑΚ</option>
						<option value="https://ellak.gr/%CE%B7%CE%BC%CE%AD%CF%81%CE%B5%CF%82-%CF%83%CF%85%CE%BD%CE%B5%CF%81%CE%B3%CE%B1%CF%83%CE%AF%CE%B1%CF%82/">Ημέρες Συνεργασίας</option>
						<option value="https://advisory.ellak.gr/">Διαβουλεύσεις</option>
						<option value="https://conferences.ellak.gr/">Εκδηλώσεις</option>
						<option value="https://edu.ellak.gr">Εκπαίδευση</option>
						<option value="https://mathe.ellak.gr">mathe.ΕΛΛΑΚ</option>
						<option value="https://elearn.ellak.gr/">Εκπαιδευτικό Υλικό</option>
						<option value="http://openwifi.gr">OpenWifi</option>
						<option value="https://team.ellak.gr/">Διαχείριση έργων</option>
						<option value="https://ccradio.ellak.gr">CCRadio</option>
						<option value="https://github.com/eellak">Έργα στο GiHub</option>
						<option value="http://ebook.ellak.gr">ebook Reader</option>
						<option value="http://meetings.ellak.gr/">Πλατφόρμα τηλεδιασκέψεων</option>
					</select>
				</div><!-- #ellak-sites -->
			</div><!-- #ellak-newsbar -->
		</div><!-- #ellak-newsbar-cont -->
<?php
	}
}

?>
