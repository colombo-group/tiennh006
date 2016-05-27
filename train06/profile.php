<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trang cá nhân</title>
	<style type="text/css">
		a {
			text-decoration: none;
		}
		a:hover {
			color: red;
		}
	</style>
</head>
<body>
<?php
	$userName = "";
	if(isset($_GET['username'])) {
		$userName = $_GET['username'];
		$conn = mysql_connect($SERVER,$USERNAME,$PASSWORD) or die("check your server connection");
		mysql_select_db("group", $conn);
		$sql= "select * from profile where username ='".$userName."'";
		$query = mysql_query($sql);
		if(mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			echo "Trang cá nhân của ".$row['fullname']."<br>";
			echo "<img src='".$row['avatar']."'"."<br><br>";
			echo "Họ tên: ".$row['fullname']."<br>";
			if($row['birthday'] != NULL) {
				echo "Ngày sinh: ".$row['birthday']."<br>";
			}
			echo "Tên đăng nhập: ".$row['username']."<br>";
			echo "Email: ".$row['email']."<br>";
			echo "Số điện thoại: ".$row['phone']."<br>";
			if($row['description'] != NULL) {
				echo "Giới thiệu: ".$row['description']."<br>";	
			}
			if($row['sex'] != NULL) {
				if($row['sex'] == 1)
					echo "Giới tính: Nam<br>";
				else
					echo "Giới tính: Nữ<br>"; 
			}
			echo "Ngày tham gia: ".$row['joindate']."<br><br>";	
		} else {
			header("location: index.php");
		}
		
	} else {
		header("location: index.php");
	}
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['level'])) {
		if($_SESSION['level'] == 0 && $row['username'] == $_SESSION['username']) {
			echo "<a href='../train06/edit.php?username=".$row['username']."'>Sửa thông tin</a>";
		}
		if($_SESSION['level'] == 1) {
			if($row['level'] == 0) {
				echo "<a href='../train06/edit.php?username=".$row['username']."'>Sửa thông tin</a>";
			}
			if($row['username'] == $_SESSION['username']) {
				echo "<a href='../train06/edit.php?username=".$row['username']."'>Sửa thông tin</a>";
			}
		}

		if($_SESSION['level'] == 2) {
			echo "<a href='../train06/edit.php?username=".$row['username']."'>Sửa thông tin</a>";
		}

	}
?>
</body>
</html>