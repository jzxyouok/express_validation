<?php
	$appid = '公众号id'; 
	$appsecret = '公众号appsecret';
	$uri = "服务器地址/show_info.php";
	
	$redirect_uri = urlencode($uri);
    $authorization_url = "https://open.weixin.qq.com/connect/oauth2/authorize?".
		    "appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&".
		    "scope=snsapi_base&state=10101#wechat_redirect";
		    
    header("Location: {$authorization_url}");
?>