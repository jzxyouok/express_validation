<?php
    // 获取open_id，并存到session
    session_start();

/*	$_SESSION['open_id'] = $res -> openid;
	$open_id = $res -> openid;*/

	if (!$_SESSION['open_id']) {

		$appid = '公众号id'; 
		$appsecret = '公众号appsecret';

	    $url_get = "https://api.weixin.qq.com/sns/oauth2/access_token?".
	    "appid=".$appid."&secret=".$appsecret."&code=".$_GET["code"].
	    "&grant_type=authorization_code";
	    
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url_get);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $result=curl_exec($ch);
	    curl_close($ch);
	     // 读取access_token的json数据
	    $res = json_decode($result);


		$_SESSION['open_id'] = $res -> openid;
		$open_id = $res -> openid;
	} else {
		$open_id = $_SESSION['open_id'];
	}

	// SAE数据库连接参数
	$host = SAE_MYSQL_HOST_M;
	$port = SAE_MYSQL_PORT;
	$user = SAE_MYSQL_USER;
	$pwd = SAE_MYSQL_PASS;
	$dbname = SAE_MYSQL_DB;


	$conn = new mysqli($host, $user, $pwd, $dbname, $port);
	$conn -> query("set names utf8");

	if ($conn -> connect_error) {
		die("Falid to connect to MySQL!" . $conn -> connect_error);
	}

	$result = $conn -> query("SELECT * FROM juba_user WHERE open_id = '$open_id'");
	if ($result -> num_rows > 0) {
		$rows = $result -> fetch_assoc(); // Fetch a result row as an associative array
		$name = $rows['name'];
		$stu_id = $rows['stu_id'];
		$phone = $rows['phone'];
		$card_id = $rows['card_id'];
		$img_data = $rows['pic'];
	} else {
		echo "<script>alert('您还没有注册！');location.href='login.html';</script>";
	}

	$result -> free();
	$conn -> close();
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>个人信息</title>

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="page-container">
        <h1 id="date"></h1> <br />
        <h1><?php echo '姓名：'.$name .'</br></br>学号: ' .$stu_id .'</br></br>手机号码: ' .$phone .'</br></br>身份证：'.$card_id;?> </h1> 
        <br />
		<?php echo '<img src="' . $rows['pic'] . '" />'; ?><br />
        <button type="button" class="btn btn-danger" onclick="window.location.href='/change_text_info.html'">修改文本信息</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='/change_pic.html'">修改图片证明</button>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.3.min.js"></script>
        <script src="assets	/js/supersized.3.2.7.min.js"></script>
        <script src="assets/js/supersized-init.js"></script>
        <script src="assets/js/scripts.js"></script>

	<!-- 实时显示时间 -->
	<script>
		function getDateTime(){
	        var a = new Date();
	        var year = a.getFullYear();
	        var mon = a.getMonth() + 1;
	        var day = a.getDate();
	        var hour = a.getHours();
	        var minute = a.getMinutes();
	        var second = a.getSeconds();
	        var week = a.getDay();
	        var arr = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
	        document.getElementById("date").innerHTML= year+'-'+mon+'-'+day+' '+hour+':'+minute+':'+second+'<br/>'+arr[week];
	        }
	 
	        setInterval("getDateTime()",1000);
	</script>

    </body>

</html>