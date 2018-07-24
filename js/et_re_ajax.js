// JavaScript Document

function p_delete(text){
	jQuery('#et_re_loading').show();
	jQuery.ajax({
		type: "POST",
		dataType: 'json',
		url: ajaxurl,
		data: 'do=delete_property_type&delete_property_type='+text+'&action=update_et_options&etre_nonce='+etre_vars.etre_nonce,
		success: function(result){
			jQuery('#et_re_loading').hide();
			if(result['error']!=""){
				jQuery(".ajxrsp").html(result['error']).fadeIn().delay(1000).fadeOut();
			} else if(result['pass']!=""){
				jQuery(".ajxrsp").html(result['pass']).fadeIn().delay(1000).fadeOut();
			}
			if(result['ui']!=""){
				jQuery(".et_et_"+result['ui']).remove();
			}
		}
	});
}

jQuery(document).ready(function($){
	$("#form2").submit(function(){
		$('#et_re_loading2').show();
		$('#et_re_sv_search').attr('disabled', true);
		data = $("#form2").serialize()+'&do=customize_advanced_search&action=update_et_options&etre_nonce='+etre_vars.etre_nonce;
		
		$.post(ajaxurl, data, function (response) {
			//alert(response);
			$('#et_re_output_div_2').html(response).fadeIn().delay(1000).fadeOut();
			$('#et_re_loading2').hide();
			$('#et_re_sv_search').attr('disabled', false);
		});
		
		return false;
	});
	$("#form1").submit(function(){
		$('#et_re_loading').show();
		$('#et_re_submit').attr('disabled', true);
		data = $("#form1").serialize()+'&do=update_et_options&action=update_et_options&etre_nonce='+etre_vars.etre_nonce;
		
		$.post(ajaxurl, data, function (response) {
			//alert(response);
			$('#et_re_output_div').html(response).fadeIn().delay(1000).fadeOut();
			$('#et_re_loading').hide();
			$('#et_re_submit').attr('disabled', false);
		});

		return false;
	});
	
	jQuery("#add_property_type_submit").click(function(){
		if( jQuery("#property_type_text").val()==""){
			jQuery(".ajxrsp").html('Enter Property Type.').fadeIn();
		} else {
			jQuery('#et_re_loading').show();
			jQuery.ajax({
				type: "POST",
				dataType: 'json',
				url: ajaxurl,
				data: 'do=update_property_type&property_type_text='+jQuery("#property_type_text").val()+'&action=update_et_options&etre_nonce='+etre_vars.etre_nonce,
				success: function(result){
					jQuery('#et_re_loading').hide();
					if(result['error']!=""){
						jQuery(".ajxrsp").html(result['error']).fadeIn().delay(1000).fadeOut();
					} else if(result['pass']!=""){
						jQuery(".ajxrsp").html(result['pass']).fadeIn().delay(1000).fadeOut();
					}
					if(result['ui']!=""){
						jQuery(".tbl_property_type").prepend(result['ui']);
					}
				}
			});
		}
		return false;
	});
});