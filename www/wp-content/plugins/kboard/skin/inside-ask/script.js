/**
 * @author https://www.cosmosfarm.com/
 */

function kboard_editor_execute(form){
	jQuery.fn.exists = function(){
		return this.length>0;
	};
	
	/*
	 * 잠시만 기다려주세요.
	 */
	if(jQuery(form).data('submitted')){
		alert(kboard_localize_strings.please_wait);
		return false;
	}
	
	var result = true;
	jQuery('.kboard-inside-message').hide();
	
	/*
	 * 폼 유효성 검사
	 */
	// 개인정보활용에 동의해야 합니다.
	if(jQuery('input[name=agree]', form).exists() && jQuery('input[name=agree]:checked', form).length <= 0){
		jQuery('input[name=agree]', form).addClass('error');
		kboard_message_show('privacy');
		result = false;
	}
	else{
		jQuery('input[name=agree]', form).removeClass('error');
		kboard_message_hide('privacy')
	}
	
	// 이메일 필드는 항상 필수로 입력합니다.
	if(jQuery('input[name=kboard_option_email]', form).exists() && !jQuery('input[name=kboard_option_email]', form).val()){
		jQuery('input[name=kboard_option_email]', form).addClass('error');
		kboard_message_show('email');
		result = false;
	}
	else{
		jQuery('input[name=kboard_option_email]', form).removeClass('error');
		kboard_message_hide('email')
	}
	
	// 비밀번호 필드가 있을 경우 필수로 입력합니다.
	if(jQuery('input[name=password]', form).exists() && !jQuery('input[name=password]', form).val()){
		jQuery('input[name=password]', form).addClass('error');
		kboard_message_show('password');
		result = false;
	}
	else{
		jQuery('input[name=password]', form).removeClass('error');
		kboard_message_hide('password');
	}
	if(jQuery('input[name=password2]', form).exists() && !jQuery('input[name=password2]', form).val()){
		jQuery('input[name=password2]', form).addClass('error');
		kboard_message_show('password');
		result = false;
	}
	else{
		jQuery('input[name=password2]', form).removeClass('error');
		kboard_message_hide('password');
	}
	
	if(jQuery('input[name=password]', form).exists() && jQuery('input[name=password]', form).val() && jQuery('input[name=password2]', form).exists() && jQuery('input[name=password2]', form).val()){
		if(jQuery('input[name=password]', form).val() != jQuery('input[name=password2]', form).val()){
			// 비밀번호는 서로 같아야 합니다.
			jQuery('input[name=password]', form).addClass('error');
			jQuery('input[name=password2]', form).addClass('error');
			kboard_message_show('password2');
			result = false;
		}
		else if(jQuery('input[name=password]', form).val().length<8 || jQuery('input[name=password]', form).val().length>16 || !jQuery('input[name=password]', form).val().match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/)){
			// 비밀번호는 8-16자 이내의 영문, 숫자, 특수문자의 조합으로 입력해주세요.
			jQuery('input[name=password]', form).addClass('error');
			jQuery('input[name=password2]', form).addClass('error');
			kboard_message_show('password3');
			result = false;
		}
		else{
			jQuery('input[name=password]', form).removeClass('error');
			jQuery('input[name=password2]', form).removeClass('error');
			kboard_message_hide('password2')
			kboard_message_hide('password3')
		}
	}
	
	// 이름 필드는 항상 필수로 입력합니다.
	if(jQuery('input[name=member_display]', form).eq(1).exists() && !jQuery('input[name=member_display]', form).eq(1).val()){
		jQuery('input[name=member_display]', form).eq(1).addClass('error');
		kboard_message_show('name');
		result = false;
	}
	else{
		jQuery('input[name=member_display]', form).eq(1).removeClass('error');
		kboard_message_hide('name');
	}
	
	// category1 필드는 항상 필수로 입력합니다.
	if(jQuery('select[name=category1]', form).exists() && !jQuery('select[name=category1]', form).val()){
		jQuery('select[name=category1]', form).addClass('error');
		kboard_message_show('category1');
		result = false;
	}
	else{
		jQuery('select[name=category1]', form).removeClass('error');
		kboard_message_hide('category1');
	}
	
	// 계층형 카테고리 필드는 항상 필수로 입력합니다.
	if(jQuery('input[name=kboard_option_tree_category_1]', form).last().exists() && !jQuery('input[name=kboard_option_tree_category_1]', form).last().val()){
		jQuery('#kboard-tree-category-1', form).addClass('error');
		kboard_message_show('tree_category');
		result = false;
	}
	else{
		jQuery('#kboard-tree-category-1', form).removeClass('error');
		kboard_message_hide('tree_category');
	}
	
	// 보안코드 필드가 있을 경우 필수로 입력합니다.
	if(jQuery('input[name=captcha]', form).exists() && !jQuery('input[name=captcha]', form).val()){
		jQuery('input[name=captcha]', form).addClass('error');
		kboard_message_show('captcha');
		result = false;
	}
	else{
		jQuery('input[name=captcha]', form).removeClass('error');
		kboard_message_hide('captcha');
	}
	
	// 문의내용 필드는 항상 필수로 입력합니다.
	if(typeof tinyMCE != 'undefined'){
		tinyMCE.triggerSave();
	}
	if(jQuery('textarea[name=kboard_content]', form).exists() && !jQuery('textarea[name=kboard_content]', form).val()){
		jQuery('textarea[name=kboard_content]', form).addClass('error');
		kboard_message_show('content');
		result = false;
	}
	else{
		jQuery('textarea[name=kboard_content]', form).removeClass('error');
		kboard_message_hide('content');
	}
	
	if(result){
		jQuery(form).data('submitted', 'submitted');
		jQuery('[type=submit]', form).text(kboard_localize_strings.please_wait);
		jQuery('[type=submit]', form).val(kboard_localize_strings.please_wait);
	}
	return result;
}

function kboard_toggle_password_field(checkbox){
	var form = jQuery(checkbox).parents('.kboard-form');
	if(jQuery(checkbox).prop('checked')){
		jQuery('.secret-password-row', form).show();
		setTimeout(function(){
			jQuery('.secret-password-row input[name=password]', form).focus();
		}, 0);
	}
	else{
		jQuery('.secret-password-row', form).hide();
		jQuery('.secret-password-row input[name=password]', form).val('');
	}
}

jQuery(window).bind('beforeunload',function(e){
	e = e || window.event;
	if(jQuery('.kboard-form').data('submitted') != 'submitted'){
		var dialogText = kboard_localize_strings.changes_you_made_may_not_be_saved;
		e.returnValue = dialogText;
		return dialogText;
	}
});

function kboard_message_show(message){
	var count = jQuery('.kboard-inside-message').data('count')?parseInt(jQuery('.kboard-inside-message').data('count')):0;
	count++;
	
	jQuery('.kboard-inside-message').data('count', count);
	jQuery('.kboard-inside-message').show();
	jQuery('.kboard-inside-message .message.'+message).show();
}

function kboard_message_hide(message){
	var count = jQuery('.kboard-inside-message').data('count')?parseInt(jQuery('.kboard-inside-message').data('count')):0;
	count--;
	if(count < 0) count = 0;
	
	jQuery('.kboard-inside-message').data('count', count);
	
	if(count == 0){
		//jQuery('.kboard-inside-message').hide();
	}
	
	jQuery('.kboard-inside-message .message.'+message).hide();
}