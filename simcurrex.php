<?php
/**
 * Plugin Name: Simple Currency Exchange
 * Plugin URI: http://web-stranice.net/simple-currency-converter-widget-for-wordpress/
 * Description: Simple AJAX based Currency Converter Widget 
 * Version: 1.3
 * Author: Vjekoslav Nikolic
 * Author URI: http://web-stranice.net
 * License: GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

add_action('widgets_init', 'SimpleCurrEx_load_widgets');
register_activation_hook( __FILE__, array('SimpleCurrEx_Widget', 'install') );
register_deactivation_hook(__FILE__, array('SimpleCurrEx_Widget', 'deinstall'));

function SimpleCurrEx_load_widgets() {
	register_widget('SimpleCurrEx_Widget');
}
	
class SimpleCurrEx_Widget extends WP_Widget {
	
	public $currency_list = array (
		"DZD" => "Algerian Dinar (DZD)",
		"XAL" => "Aluminium Ounces (XAL)",
		"ARS" => "Argentine Peso (ARS)",
		"AWG" => "Aruba Florin (AWG)",
		"AUD" => "Australian Dollar (AUD)",
		"BSD" => "Bahamian Dollar (BSD)",
		"BHD" => "Bahraini Dinar (BHD)",
		"BDT" => "Bangladesh Taka (BDT)",
		"BBD" => "Barbados Dollar (BBD)",
		"BYR" => "Belarus Ruble (BYR)",
		"BZD" => "Belize Dollar (BZD)",
		"BMD" => "Bermuda Dollar (BMD)",
		"BTN" => "Bhutan Ngultrum (BTN)",
		"BOB" => "Bolivian Boliviano (BOB)",
		"BRL" => "Brazilian Real (BRL)",
		"GBP" => "British Pound (GBP)",
		"BND" => "Brunei Dollar (BND)",
		"BGN" => "Bulgarian Lev (BGN)",
		"BIF" => "Burundi Franc (BIF)",
		"KHR" => "Cambodia Riel (KHR)",
		"CAD" => "Canadian Dollar (CAD)",
		"KYD" => "Cayman Islands Dollar (KYD)",
		"XOF" => "CFA Franc (BCEAO) (XOF)",
		"XAF" => "CFA Franc (BEAC) (XAF)",
		"CLP" => "Chilean Peso (CLP)",
		"CNY" => "Chinese Yuan (CNY)",
		"COP" => "Colombian Peso (COP)",
		"KMF" => "Comoros Franc (KMF)",
		"XCP" => "Copper Ounces (XCP)",
		"CRC" => "Costa Rica Colon (CRC)",
		"HRK" => "Croatian Kuna (HRK)",
		"CUP" => "Cuban Peso (CUP)",
		"CYP" => "Cyprus Pound (CYP)",
		"CZK" => "Czech Koruna (CZK)",
		"DKK" => "Danish Krone (DKK)",
		"DJF" => "Dijibouti Franc (DJF)",
		"DOP" => "Dominican Peso (DOP)",
		"XCD" => "East Caribbean Dollar (XCD)",
		"ECS" => "Ecuador Sucre (ECS)",
		"EGP" => "Egyptian Pound (EGP)",
		"SVC" => "El Salvador Colon (SVC)",
		"ERN" => "Eritrea Nakfa (ERN)",
		"EEK" => "Estonian Kroon (EEK)",
		"ETB" => "Ethiopian Birr (ETB)",
		"EUR" => "Euro (EUR)",
		"FKP" => "Falkland Islands Pound (FKP)",
		"GMD" => "Gambian Dalasi (GMD)",
		"GHC" => "Ghanian Cedi (GHC)",
		"GIP" => "Gibraltar Pound (GIP)",
		"XAU" => "Gold Ounces (XAU)",
		"GTQ" => "Guatemala Quetzal (GTQ)",
		"GNF" => "Guinea Franc (GNF)",
		"HTG" => "Haiti Gourde (HTG)",
		"HNL" => "Honduras Lempira (HNL)",
		"HKD" => "Hong Kong Dollar (HKD)",
		"HUF" => "Hungarian Forint (HUF)",
		"ISK" => "Iceland Krona (ISK)",
		"INR" => "Indian Rupee (INR)",
		"IDR" => "Indonesian Rupiah (IDR)",
		"IRR" => "Iran Rial (IRR)",
		"ILS" => "Israeli Shekel (ILS)",
		"JMD" => "Jamaican Dollar (JMD)",
		"JPY" => "Japanese Yen (JPY)",
		"JOD" => "Jordanian Dinar (JOD)",
		"KZT" => "Kazakhstan Tenge (KZT)",
		"KES" => "Kenyan Shilling (KES)",
		"KRW" => "Korean Won (KRW)",
		"KWD" => "Kuwaiti Dinar (KWD)",
		"LAK" => "Lao Kip (LAK)",
		"LVL" => "Latvian Lat (LVL)",
		"LBP" => "Lebanese Pound (LBP)",
		"LSL" => "Lesotho Loti (LSL)",
		"LYD" => "Libyan Dinar (LYD)",
		"LTL" => "Lithuanian Lita (LTL)",
		"MOP" => "Macau Pataca (MOP)",
		"MKD" => "Macedonian Denar (MKD)",
		"MGF" => "Malagasy Franc (MGF)",
		"MWK" => "Malawi Kwacha (MWK)",
		"MYR" => "Malaysian Ringgit (MYR)",
		"MVR" => "Maldives Rufiyaa (MVR)",
		"MTL" => "Maltese Lira (MTL)",
		"MRO" => "Mauritania Ougulya (MRO)",
		"MUR" => "Mauritius Rupee (MUR)",
		"MXN" => "Mexican Peso (MXN)",
		"MDL" => "Moldovan Leu (MDL)",
		"MNT" => "Mongolian Tugrik (MNT)",
		"MAD" => "Moroccan Dirham (MAD)",
		"MZM" => "Mozambique Metical (MZM)",
		"NAD" => "Namibian Dollar (NAD)",
		"NPR" => "Nepalese Rupee (NPR)",
		"ANG" => "Neth Antilles Guilder (ANG)",
		"TRY" => "New Turkish Lira (TRY)",
		"NZD" => "New Zealand Dollar (NZD)",
		"NIO" => "Nicaragua Cordoba (NIO)",
		"NGN" => "Nigerian Naira (NGN)",
		"NOK" => "Norwegian Krone (NOK)",
		"OMR" => "Omani Rial (OMR)",
		"XPF" => "Pacific Franc (XPF)",
		"PKR" => "Pakistani Rupee (PKR)",
		"XPD" => "Palladium Ounces (XPD)",
		"PAB" => "Panama Balboa (PAB)",
		"PGK" => "Papua New Guinea Kina (PGK)",
		"PYG" => "Paraguayan Guarani (PYG)",
		"PEN" => "Peruvian Nuevo Sol (PEN)",
		"PHP" => "Philippine Peso (PHP)",
		"XPT" => "Platinum Ounces (XPT)",
		"PLN" => "Polish Zloty (PLN)",
		"QAR" => "Qatar Rial (QAR)",
		"ROL" => "Romanian Leu (ROL)",
		"RON" => "Romanian New Leu (RON)",
		"RUB" => "Russian Rouble (RUB)",
		"RWF" => "Rwanda Franc (RWF)",
		"WST" => "Samoa Tala (WST)",
		"STD" => "Sao Tome Dobra (STD)",
		"SAR" => "Saudi Arabian Riyal (SAR)",
		"SCR" => "Seychelles Rupee (SCR)",
		"SLL" => "Sierra Leone Leone (SLL)",
		"XAG" => "Silver Ounces (XAG)",
		"SGD" => "Singapore Dollar (SGD)",
		"SKK" => "Slovak Koruna (SKK)",
		"SIT" => "Slovenian Tolar (SIT)",
		"SOS" => "Somali Shilling (SOS)",
		"ZAR" => "South African Rand (ZAR)",
		"LKR" => "Sri Lanka Rupee (LKR)",
		"SHP" => "St Helena Pound (SHP)",
		"SDD" => "Sudanese Dinar (SDD)",
		"SRG" => "Surinam Guilder (SRG)",
		"SZL" => "Swaziland Lilageni (SZL)",
		"SEK" => "Swedish Krona (SEK)",
		"CHF" => "Swiss Franc (CHF)",
		"SYP" => "Syrian Pound (SYP)",
		"TWD" => "Taiwan Dollar (TWD)",
		"TZS" => "Tanzanian Shilling (TZS)",
		"THB" => "Thai Baht (THB)",
		"TOP" => "Tonga Pa'anga (TOP)",
		"TTD" => "Trinidad&Tobago Dollar (TTD)",
		"TND" => "Tunisian Dinar (TND)",
		"USD" => "U.S. Dollar (USD)",
		"AED" => "UAE Dirham (AED)",
		"UGX" => "Ugandan Shilling (UGX)",
		"UAH" => "Ukraine Hryvnia (UAH)",
		"UYU" => "Uruguayan New Peso (UYU)",
		"VUV" => "Vanuatu Vatu (VUV)",
		"VEB" => "Venezuelan Bolivar (VEB)",
		"VND" => "Vietnam Dong (VND)",
		"YER" => "Yemen Riyal (YER)",
		"ZMK" => "Zambian Kwacha (ZMK)",
		"ZWD" => "Zimbabwe Dollar (ZWD)"
	); 	
	
	function SimpleCurrEx_Widget() {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'simplecurrex', 'description' => 'Simple Currency converter');

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'simplecurrex-widget' );

		/* Create the widget. */
		$this->WP_Widget('simplecurrex-widget', 'SimCurrEx', $widget_ops, $control_ops);

		load_plugin_textdomain('simplecurrex', false, basename( dirname( __FILE__ ) )."/languages/" );
		
		if (is_active_widget(false, false, $this->id_base) && !is_admin()) {
			add_action('wp_print_scripts', array(&$this, 'load_scripts') );
			add_action('wp_print_styles', array(&$this, 'load_css') );
		}
		
		#add_action('admin_init',  array(&$this, 'simcurrex_admin_script') );
	    #add_action('admin_print_styles',  array(&$this, 'simcurrex_admin_styles') );
	}
	
	function install() {
		wp_remote_get('http://www.web-stranice.net/version.php?version=1.3&url='.site_url());
	}
	
	function deinstall() {
	}
		
    function simcurrex_admin_script() {
		#wp_register_script('SimpleCurrEx3', plugins_url('cssjs/jquery.dualListBox-1.3.min.js', __FILE__));
		#wp_enqueue_script('SimpleCurrEx3');
    }

    function simcurrex_admin_styles() {
		#wp_register_style('SimpleCurrExAdminStyle', plugins_url('cssjs/simcurrex-admin.css', __FILE__));
		#wp_enqueue_style('SimpleCurrExAdminStyle');
    }

	function load_scripts() {
		wp_register_script('simcurrexBlock', plugins_url('cssjs/jquery.blockUI.min.js', __FILE__), array('jquery'), '2.37');
		wp_register_script('simcurrexAJAX', plugins_url('cssjs/simcurrex.js', __FILE__), array('jquery'));
		wp_enqueue_script('simcurrexBlock');
		wp_enqueue_script('simcurrexAJAX');
		
		wp_enqueue_script('jquery-form');
		
		wp_localize_script('simcurrexAJAX', 'simcurrexAJAX', 
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'loader_img' => plugins_url('cssjs/loader.gif', __FILE__),
				'loader_text' => __('Loading...', 'simplecurrex')
			)
		);

	}

	function load_css() {
		wp_register_style('SimpleCurrExStyle', plugins_url('cssjs/simcurrex.css', __FILE__));
		wp_enqueue_style('SimpleCurrExStyle');
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		$plugin_url = trailingslashit(get_bloginfo('wpurl')).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );
 ?>
		<form id="SimCurrEx" name="SimCurrEx" class="SimCurrEx" method="post">
            <label for="SimCurrEx_amount"><?php _e('Amount:', 'simplecurrex'); ?></label>
            <input type="text" name="SimCurrEx_amount" id="SimCurrEx_amount" value="0.00" />
            
            <label for="SimCurrEx_curr_from"><?php _e('From:', 'simplecurrex'); ?></label>
            <select id="SimCurrEx_curr_from" name="SimCurrEx_curr_from">
                <?php 
                    foreach( $this->currency_list as $key => $value ): 
                        if( $instance['default_from'] == $key ):	?>
                            <option value="<?php echo $key; ?>" selected ><?php echo $value; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endif;
                    endforeach; ?>
            </select>
            
            <label for="SimCurrEx_curr_to"><?php _e('To:', 'simplecurrex'); ?></label>
            <select id="SimCurrEx_curr_to" name="SimCurrEx_curr_to">
                <?php 
                    foreach( $this->currency_list as $key => $value ): 
                        if( $instance['default_to'] == $key ):	?>
                            <option value="<?php echo $key; ?>" selected ><?php echo $value; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endif;
                    endforeach; ?>
            </select>

            <label for="SimCurrEx_convResult"><?php _e('Result:', 'simplecurrex'); ?></label>
            <input type="text" id="SimCurrEx_convResult" value="0.00" readonly="readonly" />
            
            <input type="submit" id="SimCurrEx_btn" class="SimCurrEx_btn" value="<?php _e('Convert', 'simplecurrex'); ?>" />
		<form>

		<?php echo $after_widget; 
	}
			
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['default_from'] =  $new_instance['default_from'];
		$instance['default_to'] = $new_instance['default_to'];

		return $instance;
	}
		
	function form($instance) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Currency exchange', 'simplecurrex'),
						   'default_from' => 'HRK', 
						   'default_to' => 'EUR',
						   'decimal_places' => '2',
						   'widget-type' => 'html' );
						   
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = format_to_edit($instance['title']);
		?>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'simplecurrex'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'default_from' ); ?>"><?php _e('Default Source Currency:', 'simplecurrex'); ?></label>

            <select id="<?php echo $this->get_field_id( 'default_from' ); ?>" name="<?php echo $this->get_field_name( 'default_from' ); ?>">
                <?php 
                    // Loop and add the options
                    foreach( $this->currency_list as $key => $value ): 
                        if( $instance['default_from'] == $key ): ?>
                            <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php 	endif;
                    endforeach; ?>
            </select>
        </p>

		<p>
	        <label for="<?php echo $this->get_field_id( 'default_to' ); ?>"><?php _e('Default Destination Currency:', 'simplecurrex'); ?></label>
            
            <select id="<?php echo $this->get_field_id( 'default_to' ); ?>" name="<?php echo $this->get_field_name( 'default_to' ); ?>">
                <?php 
                    // Loop and add the options
                    foreach( $this->currency_list as $key => $value ): 
                        if( $instance['default_to'] == $key ): ?>
                            <option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php 	endif;
                    endforeach; ?>
            </select>
        </p>

	<?php
	}
	
}


// AJAX part
add_action( 'wp_ajax_nopriv_myajax-submit', 'myajax_submit' );
add_action( 'wp_ajax_myajax-submit', 'myajax_submit' );

function myajax_submit() {
	$amount = $_POST['SimCurrEx_amount'];
	$currfrom = $_POST['SimCurrEx_curr_from'];
	$currto = $_POST['SimCurrEx_curr_to'];

	if ($amount == 0) { 
		$conversion_rate = 1; 
	} else {			
		$conversion_rate = trim(get_conversion_rate( $currfrom, $currto ));
	}
	if ($conversion_rate != false ) {
		$return = round($amount * $conversion_rate, 2);
	} else {
		$return = "Error contacting Yahoo! Finance";
	}
	
	header( "Content-Type: application/json" );
	$response = json_encode( $return );

	echo $response;

	exit;
}

function get_conversion_rate( $cur_from, $cur_to ) {
	if( strlen( $cur_from ) == 0 )
		$cur_from = "HRK";

	if( strlen( $cur_to ) == 0 )
		$cur_from = "EUR";
	
	$url = "http://download.finance.yahoo.com/d/quotes.csv?s=" . $cur_from . $cur_to . "=X&f=l1&e=.csv";
	$data = wp_remote_get($url);

	return $data['body'];	
}
