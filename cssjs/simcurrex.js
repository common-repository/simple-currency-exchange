/**
 * Filename: 		simcurrex.js
 * Date: 			2011-03-14
 * Copyright: 		2011, Vjekoslav Nikolic
 * Author: 			Vjekoslav Nikolic (vjeko@web-stranice.net)
 * Description: 	AJAX code
 * License:			GPLv2
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
jQuery(document).ready(function(){
	jQuery('#SimCurrEx').ajaxForm({
		data: {
			action : 'myajax-submit'
		},
		dataType: 'json',
		timeout:   3000,
		url:       simcurrexAJAX.ajaxurl,
		beforeSubmit: function(formData, jqForm, options) {
			jQuery('#SimCurrEx').block({
				message: '<img src="' + simcurrexAJAX.loader_img + '" alt="' + simcurrexAJAX.loader_text + '" />',
				fadeIn: 500,
				css: {
					border: 'none',
					background: 'transparent'
				}
			});
		},
		success : function(responseText, statusText, xhr, $form) {
			jQuery('#SimCurrEx_convResult').val(' ');
			jQuery('#SimCurrEx').unblock();
			
			var _convamount = responseText == '0' ? '0.00': responseText;
			var _amount = parseFloat(_convamount);
			_amount = _amount.toFixed(2);
			jQuery('#SimCurrEx_convResult').addClass('SimCurrEx_result');
			jQuery('#SimCurrEx_convResult').val(_amount);
		}
	});
});