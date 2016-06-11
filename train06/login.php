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
		$sql= "select * from login where username ='".$u."' or email ='".$u."'";
		$query = mysql_query($sql);
		$flag = 1;
		if(mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			if($row['count'] == 3) {
				$time = $row['time'];
				$date = date("Y-m-d h:i:s");
				$date = new DateTime($date);
				$date = $date->getTimestamp();
				$timeBlock = $date-$row['time'];
				if($timeBlock < 7200) {
					$timeBlock = (int)((7200-$timeBlock)/60);
					echo "Tài khoản của bạn đang bị khóa. Vui lòng quay lại sau ".$timeBlock." phút";
					$flag = 0;
				} 
			}
		}

		if($flag) {
			$sql= "select * from profile where (username ='".$u."' or email ='".$u."') and password ='".md5($p)."'";
			$query = mysql_query($sql);
			if(mysql_num_rows($query) > 0) {
				$row = mysql_fetch_assoc($query);
				//neu dang nhap thanh cong
				
				$sql = "select * from login where username ='".$u."' or email ='".$u."'";
				$query = mysql_query($sql);
				if(mysql_num_rows($query) > 0) {
					$sql = "delete from login where username ='".$u."' or email ='".$u."'";
					mysql_query($sql);
				}
				
				session_start();
				$_SESSION['username'] = $row['username'];
				$_SESSION['level'] = $row['level'];
				header("location: index.php");
				exit();

			} else {
				echo "Đăng nhập thất bại. Đăng nhập sai 3 lần sẽ bị khóa tài khoản 180 phút";
				$sql= "select * from login where username ='".$u."' or email ='".$u."'";
				$query = mysql_query($sql);
				if(mysql_num_rows($query) > 0) {
					$row = mysql_fetch_assoc($query);
					$time = $row['time'];
					$date = date("Y-m-d h:i:s");
					$date = new DateTime($date);
					$date = $date->getTimestamp();
					$timeBlock = $date-$row['time'];
					if($timeBlock < 10800) {
						$count = $row['count'] + 1;
					} else {
						$count = 1;
					}	
					$sql = "update login set count ='".$count."', time ='".$date."' where username ='".$u."' or email ='".$u."' ";
					mysql_query($sql);
				} else {
					$count = 1;
					$date = date("Y-m-d h:i:s");
					$date = new DateTime($date);
					$date = $date->getTimestamp();
					$sql = "insert into login(username, count, time) values('$u', $count, $date)";
					mysql_query($sql);
				}
			}
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
