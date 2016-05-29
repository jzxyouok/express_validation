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
	$open_id = $_SESSION['open_id'];  //用来限制在公众号打开此网页

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
		// 防止用户返回再写入数据
		$valid_open_id = $conn -> query("SELECT * FROM juba_user WHERE name='$name'");

		if ($valid_open_id -> num_rows > 0) {
			echo "<script>alert('请不要重复注册！');location.href='show_info.php';</script>";

		} else {

			$result = $conn -> query("INSERT INTO juba_user (id, open_id, stu_id, name, phone, card_id, pic) VALUES (NULL, '$open_id', '$stu_id', '$name', '$phone', '$card_id', '$img_data');");
			
			if ($result) {
				// echo "<script>alert('注册成功，正在跳转至下一页面！');location.href='show_info.php';</script>";
			} else {
				echo "注册失败！";
			}
			
		}

	}

	$result -> free();
	$conn -> close();
?>