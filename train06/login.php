<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	<style type="text/css">
		input {
			margin-bottom: 15px;
		}
		.error {
			color: red;
		}
	</style>
</head>
<?php
	session_start();
	if(isset($_SESSION['username'])) {
		header("location: index.php");
			exit();	
	}
	$u = "";
	$p = "";
	$userNameErr = "";
	$passwordErr = "";
	if(isset($_POST['ok'])) {
		if($_POST['username'] == null) 
			$userNameErr = "Không được để trống";
		else 
			$u = $_POST['username'];

		if($_POST['password'] == null)
			$passwordErr = "Không được để trống";
		else
			$p = $_POST['password'];
	}

	if($u&&$p) {
		$conn = mysql_connect($SERVER,$USERNAME,$PASSWORD) or die("check your server connection");
		mysql_select_db("group", $conn);
		$sql= "select * from profile where username ='".$u."' and password = '".md5($p)."'";
		$query = mysql_query($sql);
		if(mysql_num_rows($query) == 0) {
			$sql2 = "select * from profile where email ='".$u."' and password = '".md5($p)."'";
			$query2 = mysql_query($sql2);
			if(mysql_num_rows($query2) == 0) {
				echo "Thông tin đăng nhập không chính xác. Yêu cầu nhập lại";
			} else {
				$row = mysql_fetch_assoc($query2);
				session_start();
				$_SESSION['username'] = $row['username'];
				$_SESSION['level'] = $row['level'];
				header("location: index.php");
				exit();	
			}
		} else {
			$row = mysql_fetch_assoc($query);
			session_start();
			$_SESSION['username'] = $row['username'];
			$_SESSION['level'] = $row['level'];
			header("location: index.php");
			exit();
		}
	}
?>

<body>

	<form method="post">
	Tên đăng nhập hoặc email: <input type="text" name="username" size="25"></input>
	<span class="error"><?php echo $userNameErr?></span><br>
	Mật khẩu: <input type="password" name="password" size="25"></input>
	<span class="error"><?php echo $passwordErr?></span><br>
	<input type="submit" name="ok" value="Login"></input>
	</form>
		
</body>
</html>
