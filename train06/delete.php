<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Xóa tài khoản</title>
</head>
<body>
<?php
	session_start();
	$conn = mysql_connect($SERVER,$USERNAME,$PASSWORD) or die("check your server connection");
	mysql_select_db("group", $conn);
	
	if(isset($_GET['username'])) {
		if(isset($_SESSION['username'])&&isset($_SESSION['level'])) {
			$sql = "select * from profile where username = '".$_GET['username']."'";
			$query = mysql_query($sql);
			if(mysql_num_rows($query) > 0) {
				$row = mysql_fetch_assoc($query);
				if($_SESSION['level'] == 1) {			
					if($row['level'] == 2) {
						header("location: index.php");
					}
					if($row['level'] == 1 && $_SESSION['username'] != $row['username']) {
						header("location: index.php");
					} 
				}
	
				if($_SESSION['level'] == 0) {
					header("location: index.php");
				}

			} else {
				header("location: index.php");
			}
		} else {
			header("location: index.php");
		}	
	} else {
		header("location: index.php");
	}

	$confirmErr = "";
	if(isset($_POST['submit'])) {
		if(isset($_POST['confirm'])) {
			if($_POST['confirm'] != 'YES') {
				$confirmErr = "Yêu cầu nhập lại";
			} else {
				$sql = "delete from profile where username = '".$_GET['username']."'";
				if(mysql_query($sql)) {
					$confirmErr = "Đã xóa thành công";	
				}
			}
		}
	}
?>
<div>
	<form method="post">
		Nhập YES để xóa<input type="text" name="confirm"></input><br><br>
		<input type = "submit" name="submit" value="Xóa"></input>
		<?php echo $confirmErr?>
		<a href="/index.php">Quay về trang chủ</a>
</div>
</body>
</html>