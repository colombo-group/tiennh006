<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
	<style type="text/css">
		table, th, td {
			border: 1px solid #cdcdcd;
			border-collapse: collapse;
		}

		td {
			text-align: center;
		}

		a {
			text-decoration: none;
		}

		a:hover {
			color: red;
		}

		img {
			height: 80px;
			width: 80px;
		}
	</style>
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['username'])) {
		echo "<div>";
		echo "Xin chào ".$_SESSION['username']." ";
		echo "<a href='?logout' title='Đăng xuất'>Đăng xuất</a>";
		echo "</div>";
	} 	else {
			echo "<div>";
			echo "<a href='../train06/login.php' title='Đăng nhập'>Đăng nhập</a>"." ";
			echo "<a href='../train06/signup.php' title='Đăng ký''>Đăng kí</a>";
			echo "</div>";
		}
	if(isset($_GET['logout'])) {
		session_destroy();
		header("location: index.php");
		exit();
	}
	$page = 0;
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} 
	$pageNumber = 0;
	$rowInPage = 10;
	$rowNumber = 0;

	$conn = mysql_connect($SERVER,$USERNAME,$PASSWORD) or die("check your server connection");
	mysql_select_db("group");
	$sql = "select * from profile";
	$result = mysql_query($sql);
	$rowNumber = mysql_num_rows($result);
	$pageNumber = $rowNumber / $rowInPage;

	$sql = "select * from profile limit ".$page*$rowInPage.",".$rowInPage;
	$result = mysql_query($sql);
	echo "<table>";
	echo "<tr>";
	echo "<th>Ảnh đại diện</th>";
	echo "<th>Tên thành viên</th>";
	echo "<th>Giới thiệu</th>";
	echo "<th>Ngày tham gia</th>";
	echo "</tr>";
	while ($row = mysql_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td><a href='../train06/profile.php?username=".$row['username']."' title='Xem trang cá nhân'><img src='".$row['avatar']."'></a></td>";
		echo "<td>".$row['fullname']."</td>";
		echo "<td>".$row['description']."</td>";
		echo "<td>".$row['joindate']."</td>";
		if(isset($_SESSION['username']) && isset($_SESSION['level'])) {
			if($_SESSION['level'] == 0 && $row['username'] == $_SESSION['username']) {
				echo "<td><a href='../train06/edit.php?username=".$row['username']."'>Sửa</a></td>";
			}
			if($_SESSION['level'] == 1) {
				if($row['level'] == 0) {
					echo "<td><a href='../train06/edit.php?username=".$row['username']."'>Sửa</a></td>";
					echo "<td><a href='../train06/delete.php?username=".$row['username']."'>Xóa</a></td>";
				}
				if($row['username'] == $_SESSION['username']) {
					echo "<td><a href='../train06/edit.php?username=".$row['username']."'>Sửa</a></td>";
					echo "<td><a href='../train06/delete.php?username=".$row['username']."'>Xóa</a></td>";
				}
			}

			if($_SESSION['level'] == 2) {
				echo "<td><a href='../train06/edit.php?username=".$row['username']."'>Sửa</a></td>";
				echo "<td><a href='../train06/delete.php?username=".$row['username']."'>Xóa</a></td>";
			}

		}
		echo "</tr>";
	}
	echo "</table>";
	mysql_close($conn);
	for($page=0;$page<$pageNumber;$page++) {
		echo "<a href='index.php?page=$page'>".$page."</a>"." ";
	}
?>
</body>
</html>