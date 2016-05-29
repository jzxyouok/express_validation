<?php
	define("TOKEN", "vaildation");

	function checkSignature() {
		// 从GET参数中读取三个字段的值
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		// 读取预定义的TOKEN
		$token = TOKEN;

		// 将三个参数进行字典序排序
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		// 将三个参数字符串拼接成一个字符串进行sha1加密
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		// 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}

	if (checkSignature()) {
		echo $_GET["echostr"];
	} else {
		echo "Falid";
	}
?>