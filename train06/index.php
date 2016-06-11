<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
	<style type="text/css">
		.header {
			padding-right: 30px;
			font-weight: bold;
		}
		div.avatar img {
			height: 80px;
			width: 80px;
		}
		a {
			text-decoration: none;
		}
		table {
			text-align: center;
		}
		.inline {
			display: inline-block;
			padding-bottom: 20px;
			padding-top: 20px;
			padding-right: 50px;
			width: 150px;
			text-align: center;
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
			echo "<a href='/login.php' title='Đăng nhập'>Đăng nhập</a>"." ";
			echo "<a href='/signup.php' title='Đăng ký''>Đăng kí</a>";
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
	} else {
		$page = 0;
	}

	$pageNumber = 0;
	$rowInPage = 5;
	$rowNumber = 0;

	if(isset($_POST['limit'])) {
		$rowInPage = $_POST['limit'];
		$_SESSION['limit'] = $_POST['limit'];
	} else {
		if(isset($_SESSION['limit'])) {
			$rowInPage = $_SESSION['limit'];
		}
	} 

	$conn = mysql_connect($SERVER,$USERNAME,$PASSWORD) or die("check your server connection");
	mysql_select_db("group");
	$sql = "select * from profile";
	$result = mysql_query($sql);
	$rowNumber = mysql_num_rows($result);
	$pageNumber = $rowNumber / $rowInPage;
	if(isset($_GET['sort']) && $_GET['sort'] != 0) {
		switch ($_GET['sort']) {
			case 1:
				$sql = "select * from profile order by fullname ASC limit ".$page*$rowInPage.",".$rowInPage;
				break;
			
			case 2:
				$sql = "select * from profile order by fullname DESC limit ".$page*$rowInPage.",".$rowInPage;
				break;
			case 3:
				$sql = "select * from profile order by joindate ASC limit ".$page*$rowInPage.",".$rowInPage;
				break;
			case 4:
				$sql = "select * from profile order by joindate DESC limit ".$page*$rowInPage.",".$rowInPage;
				break;	
		}
			
	}	else {
			$sql = "select * from profile limit ".$page*$rowInPage.",".$rowInPage;				
	}
	
	$result = mysql_query($sql);?>
	<div>
		<div class="header">
			<div class = 'inline'>Ảnh đại diện</div>

			<div class = 'inline'>Tên thành viên
			<a href='index.php?page=<?php echo $page?>&sort=1'><img src='public/images/icon/len.png' width='15px' height='15px'><a>
			<a href='index.php?page=<?php echo $page?>&sort=2'><img src='public/images/icon/xuong.png' width='15px' height='15px'><a>
			</div>

			<div class = 'inline'>Giới thiệu</div>

			<div class ='inline'>Ngày tham gia
			<a href='index.php?page=<?php echo $page?>&sort=3'><img src='public/images/icon/len.png' width='15px' height='15px'><a>
			<a href='index.php?page=<?php echo $page?>&sort=4'><img src='public/images/icon/xuong.png' width='15px' height='15px'><a>
			</div>

		</div>
	<?php
	while ($row = mysql_fetch_assoc($result)) {
		echo "<div>";
		echo "<div class='inline avatar'><a href='profile.php?username=".$row['username']."' title='Xem trang cá nhân'><img src='".$row['avatar']."'></a></div>";
		echo "<div class='inline'>".$row['fullname']."</div>";
		echo "<div class='inline'>".$row['description']."</div>";
		echo "<div class='inline'>".$row['joindate']."</div>";
		if(isset($_SESSION['username']) && isset($_SESSION['level'])) {
			if($_SESSION['level'] == 0 && $row['username'] == $_SESSION['username']) {
				echo "<div class='inline'><a href='edit.php?username=".$row['username']."'>Sửa</a></div>";
			}
			if($_SESSION['level'] == 1) {
				if($row['level'] == 0) {
					echo "<div class='inline'><a href='edit.php?username=".$row['username']."'>Sửa</a></div>";
					echo "<div class='inline'><a href='delete.php?username=".$row['username']."'>Xóa</a></div>";
				}
				if($row['username'] == $_SESSION['username']) {
					echo "<div class='inline'><a href='edit.php?username=".$row['username']."'>Sửa</a></div>";
					echo "<div class='inline'><a href='delete.php?username=".$row['username']."'>Xóa</a></div>";
				}
			}

			if($_SESSION['level'] == 2) {
				echo "<div class='inline'><a href='edit.php?username=".$row['username']."'>Sửa</a></div>";
				echo "<div class='inline'><a href='delete.php?username=".$row['username']."'>Xóa</a></div>";
			}

		}
		echo "</div>";
	}
	echo "</div>";
	mysql_close($conn);
	if(isset($_GET['sort'])) {
		$sort = $_GET['sort'];
	} else {
		$sort = 0;
	}
	for($i=0;$i<$pageNumber;$i++) {
		echo "<a href='index.php?page={$i}&sort={$sort}'>".$i."</a>"." ";
	}

?>
<div>
	<form action="" method="post">
		<select name="limit" onchange="this.form.submit()">
			<option value="5" <?php if(isset($_SESSION['limit']) && $_SESSION['limit'] == 5) echo 'selected'?>>5</option>
			<option value="10" <?php if(isset($_SESSION['limit']) && $_SESSION['limit'] == 10) echo 'selected'?>>10</option>
			<option value="20" <?php if(isset($_SESSION['limit']) && $_SESSION['limit'] == 20) echo 'selected'?>>20</option>
			<option value="50" <?php if(isset($_SESSION['limit']) && $_SESSION['limit'] == 50) echo 'selected'?>>50</option>
			<option value="100" <?php if(isset($_SESSION['limit']) && $_SESSION['limit'] == 100) echo 'selected'?>>100</option>
		</select>
	</form>
</div>
</body>
</html>