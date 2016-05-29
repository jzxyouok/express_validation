<?php 
	
	// SAE数据库连接参数
	$host = SAE_MYSQL_HOST_M;
	$port = SAE_MYSQL_PORT;
	$user = SAE_MYSQL_USER;
	$pwd = SAE_MYSQL_PASS;
	$dbname = SAE_MYSQL_DB;


	$phone = $_POST['Tel'];
	$card_id = $_POST['ID_card'];

	session_start();

	$_SESSION['phone'] = $phone;
	$_SESSION['card_id'] = $card_id;


	$open_id = $_SESSION['open_id'];  //用来限制在公众号打开此网页

	$conn = new mysqli($host, $user, $pwd, $dbname, $port);
	$conn -> query("set names utf8");

	if ($conn -> connect_error) {
		echo "Falid to connect to MySQL!" . $conn -> connect_error;
		exit;
	} 
	
	//用来限制在公众号打开此网页,并以此作为修改信息凭据！
	if ($open_id != null) {

		$sql = "UPDATE juba_user SET phone='$phone', "
				."card_id='$card_id' "
				."WHERE open_id='$open_id'";
		
		$result = $conn -> query($sql);
		if ($result) {
			echo "<script>alert('成功修改,正在跳转到个人页面！');location.href='show_info.php'</script>";
		} else {
			echo "<script>alert('修改失败，正在返回修改页面！');location.href='change_text_info.html';</script>";
			echo $sql;
		}

	}

	$conn -> close();

 ?>