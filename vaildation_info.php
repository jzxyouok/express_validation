<?php
	
	// SAE数据库连接参数
	$host = SAE_MYSQL_HOST_M;
	$port = SAE_MYSQL_PORT;
	$user = SAE_MYSQL_USER;
	$pwd = SAE_MYSQL_PASS;
	$dbname = SAE_MYSQL_DB;

	$name = $_POST['username'];
	$phone = $_POST['Tel'];
	$stu_id = $_POST['student_numb'];
	$card_id = $_POST['ID_card'];

	session_start();
	$_SESSION['username'] = $name;
	$_SESSION['phone'] = $phone;
	$_SESSION['stu_id'] = $stu_id;
	$_SESSION['card_id'] = $card_id;

	$open_id = $_SESSION['open_id'];

/*	// obtain the open_id
	session_start();
	$open_id = $_SESSION['open_id'];*/

	$conn = new mysqli($host, $user, $pwd, $dbname, $port);
	$conn -> query("set names utf8");

	if ($conn -> connect_error) {
		die("Falid to connect to MySQL!" . $conn -> connect_error);
	} else {
		$vaild = $conn -> query("SELECT * FROM juba_original WHERE name='$name' AND stu_id='$stu_id'");

		// 检查用户的信息是否被他人注册
		$vaild_repeat = $conn -> query("SELECT * FROM juba_user WHERE name = '$name'");



		if ($vaild -> num_rows > 0 && !$vaild_repeat -> num_rows > 0) { //有此信息，跳到下一步
			echo "<script>alert('验证成功，正在跳转至下一页面！');location.href='upload_pic.html';</script>";
		} else if (!$vaild -> num_rows >0){
			echo "<script>alert('您输入的姓名与学号不一致！');location.href='login.html';</script>";
		} else if ($vaild_repeat -> num_rows > 0) {
			echo "<script>alert('你的信息已被他人注册，请联系公众号解决！');location.href='login.php';</script>";
		}
	}

	$vaild -> free();
	$conn -> close();

?>