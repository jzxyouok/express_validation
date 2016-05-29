<?
	// SAE数据库连接参数
	$host = SAE_MYSQL_HOST_M;
	$port = SAE_MYSQL_PORT;
	$user = SAE_MYSQL_USER;
	$pwd = SAE_MYSQL_PASS;
	$dbname = SAE_MYSQL_DB;

	session_start();
	$name = $_SESSION['username'];
	$phone = $_SESSION['phone'];
	$stu_id = $_SESSION['stu_id'];
	$card_id = $_SESSION['card_id'];
	$open_id = $_SESSION['open_id'];  

	// 获取base64图片
	$img_data = file_get_contents("php://input");

	$conn = new mysqli($host, $user, $pwd, $dbname, $port);
	$conn -> query("set names utf8");

	if ($conn -> connect_error) {
		echo "Falid to connect to MySQL!" . $conn -> connect_error;
		exit;
	} 
	
	//用来限制在公众号打开此网页
	if ($open_id != null) {
		// 防止用户返回写入数据
		$modify = $conn -> query("UPDATE juba_user SET pic='$img_data' WHERE open_id='$open_id'");

		if ($modify) {
			echo "<script>alert('成功修改！');location.href='show_info.php';</script>";
		}

	}

	$result -> free();
	$conn -> close();
?>