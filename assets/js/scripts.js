
jQuery(document).ready(function() {

    $('.page-container form').submit(function(){
        var username = $(this).find('.username').val();
        //var password = $(this).find('.password').val();
		//var affirmPW = $(this).find('.affirmPW').val();
		var Tel = $(this).find('.Tel').val();
		var student_numb = $(this).find('.student_numb').val();
		var ID_card = $(this).find('.ID_card').val();
		//var upload_file = $(this).find('.upload_file').val();
		<!--获并定义取div的value值-->
		var reg = /^[\u4e00-\u9fa5 ]{2,5}$/;
		//var reg2 = /^[0-9a-zA-Z_]{6,15}$/;
		var reg3 = /^1[3|4|5|8]\d{9}$/;
		var reg4 = /^201\d{9}$/;
		var reg5 = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
		<!--定义正则表达式-->
        if(!reg.test(username)) {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '27px');
            });
           $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false; 
        }
		
		if(!reg3.test(Tel)) {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '96px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.Tel').focus();
            });
            return false;
        }
		if(!reg4.test(student_numb)) {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '165px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.student_numb').focus();
            });
            return false;
        }
		if(!reg5.test(ID_card)) {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '234px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.ID_card').focus();
            });
            return false;
        }
    });
<!--判断输入框内容是否正确-->
    $('.page-container form .username,  .page-container form .Tel, .page-container form .student_numb, .page-container form .ID_card').keyup(function(){
        $(this).find('.error').fadeOut('fast');<!--某项错误就弹出错误层-->
    });
});