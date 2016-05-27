<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sửa thông tin</title>
	<style type="text/css">
		.error {
					color: #FF0000;
		}
	</style>
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
	
				if($_SESSION['level'] == 0 && $_SESSION['username'] != $row['username']) {
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
	
	
	$fullNameErr = "";
	$userNameErr = "";
	$emailErr = "";
	$phoneErr = "";
	$avatarErr = "";
	$desErr = "";
	$birthDayErr = "";

	$fullName = "";
	$userName = "";
	$email = "";
	$phone = "";
	$avatar = "";
	$pathAvatar = "";
	$des= "";
	$birthDay = "";
	$sex = 1;
	$level = 0;

	$sql = "select * from profile where username ='".$_GET['username']."'";
	$query = mysql_query($sql);
	$row = mysql_fetch_assoc($query);

	$fullName = $row['fullname'];
	$userName = $_GET['username'];
	$email = $row['email'];
	$phone = $row['phone'];
	if($row['description'] != NULL) {
		$des = $row['description'];
	}
	if($row['birthday'] != NULL) {
		$birthDay = $row['birthday'];
	}
	if($row['sex'] != NULL) {
		$sex = $row['sex'];
	}
	$pathAvatar = $row['avatar'];
	$level = $row['level'];
	//echo "<a href='../train06/profile.php?username=".$row['username']."' title='Xem trang cá nhân'><img src='".$row['avatar']."'></a>";
	if(isset($_POST['submit'])) {
		
		if(isset($_POST['fullName'])) {
			$fullName =  mysql_escape_string($_POST['fullName']);
			if($fullName == "") {
				$fullNameErr = "Không được để trống";
			}
		} 
		if(isset($_POST['userName'])) {
			if($_POST['userName'] == "") {
				$userNameErr = "Không được để trống";
				$userName = "";	
			} else {
				if($_POST['userName'] != $userName) {
					$userName =  mysql_escape_string($_POST['userName']);
					$sql = "select * from profile where username ='".$userName."'";
					$query = mysql_query($sql);
					if(mysql_num_rows($query) > 0) {
						$userNameErr = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác";
					} 
				} else {
					$userNameErr = "";
				}
			}
		} 
		if(isset($_POST['email'])) {
			if($_POST['email'] == "") {
				$emailErr = "Không được để trống";
				$email = "";
			} else {
				if($_POST['email'] != $email) {
					$email =  mysql_escape_string($_POST['email']);	
					$sql = "select * from profile where email ='".$email."'";
						$query = mysql_query($sql);
						if(mysql_num_rows($query) > 0) {
							$emailErr = "Email đã tồn tại. Vui lòng chọn email khác";
						}
						if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
							$emailErr = "Email không hợp lệ. Vui lòng nhập lại";
						}
				} else {
					$emailErr = "";
				}
			}			
		} 
		if(isset($_POST['phone'])) {
			if($_POST['phone'] == "") {
				$phoneErr = "Không được để trống";	
				$phone = "";
			} else {
				if($_POST['phone'] != $phone) {
					$phone =  mysql_escape_string($_POST['phone']);
					$sql = "select * from profile where phone ='".$phone."'";
						$query = mysql_query($sql);
						if(mysql_num_rows($query) > 0) {
							$phoneErr = "Số điện thoại đã tồn tại. Vui lòng chọn số điện thoại khác";
						}
						if (!eregi("^([0-9-])*$", $phone)) {
							$phoneErr = "Số điện thoại không hợp lệ. Vui lòng nhập lại";
						} 
				} else {
					$phoneErr = "";
				}
			}
		}

		if(isset($_POST['des'])) {
			$des=  mysql_escape_string($_POST['des']);
			if($des == ""){
				$desErr = "Không được để trống";
			}
		} 
			
		if(isset($_POST['birthDay'])) {
			$birthDay=  $_POST['birthDay'];
			if($birthDay == ""){
				$birthDayErr = "Không được để trống";
			}
			if(!preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $birthDay)) {
				$birthDayErr = "Ngày tháng không hợp lệ";
			}
		} 
		
		if(isset($_POST['sex'])) {
			$sex = (int)$_POST['sex'];
		}

		if(isset($_POST['level'])) {
			$level = (int)$_POST['level'];
		}
		////////////
		if($_FILES['avatar']['name'] != NULL) {
			 if( $_FILES['avatar']['type'] == "image/png" || 
			 	$_FILES['avatar']['type'] == "image/gif" ||
			 	$_FILES['avatar']['type'] == "image/jpg" ||
			 	$_FILES['avatar']['type'] == "image/jpeg") {
			 	
	            if($_FILES['avatar']['size'] > 1048576){
	                $avatarErr = "Vui lòng chọn file nhỏ hơn 1MB";
	            }	else {		
	           		}
        	}	else {
           
           				$avatarErr = "Vui lòng chọn file ảnh";
        		}
   		}
   		$unLinkFile = $pathAvatar;
   		if($fullNameErr==""&&$userNameErr==""&&$emailErr==""&&$phoneErr==""&&$avatarErr==""&&$desErr==""&&$birthDayErr=="") {
   			if($_FILES['avatar']['name'] != NULL) {
				$str = $_FILES['avatar']['type'];
		        $str= substr($str, 6);
			    $avatar = $userName.".".$str;
			    $pathAvatar = "../train06/images/avatar/".$avatar;
			} 

			$sql = "update profile set fullname ='".$fullName."', username ='".$userName."', email ='".$email."', phone = '".$phone."', avatar = '".$pathAvatar."', description = '".$des."', birthday ='".$birthDay."', sex ='".$sex."', level ='".$level."' where username ='".$_GET['username']."'";

			if(mysql_query($sql)) {
		    	if($_FILES['avatar']['name'] != NULL) {
		    		move_uploaded_file($_FILES['avatar']['tmp_name'], "images/avatar/".$avatar);
		    		//unlink($unLinkFile);
		    	}
		    	echo "Sửa thành công"."<br>";
		    	echo "<a href='../train06/index.php'>Quay về trang chủ</a>";
		    	die();
		    } else {
		    	echo "Đã có lỗi xảy ra";
		    	die();
		    }	

   		}

	}
?>
<div>
	<p><span class="error">* Thông tin bắt buộc</span></p>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?username=".$_GET['username']?>" enctype="multipart/form-data">
		Tên đầy đủ:
		<input type="text" name="fullName" value="<?php echo $fullName ?>"></input>
		<span class="error">* <?php echo $fullNameErr?></span>
		<br><br>
		Tên đăng nhập:
		<input type="text" name="userName" value="<?php echo $userName ?>"></input>
		<span class="error">* <?php echo $userNameErr?></span>
		<br><br>
		Email:
		<input type="text" name="email" value="<?php echo $email ?>"></input>
		<span class="error">* <?php echo $emailErr?></span>
		<br><br>
		Số điện thoại:
		<input type="text" name="phone" value="<?php echo $phone ?>"></input>
		<span class="error">* <?php echo $phoneErr?></span>
		<br><br>
		Giới thiệu:<br>
		<textarea name="des" cols="25" rows="10"><?php echo $des ?></textarea>
		<span class="error">* <?php echo $desErr?></span>
		<br><br>
		Ngày sinh:
		<input type="text" name="birthDay" value="<?php echo $birthDay ?>"></input>
		<span class="error">* <?php echo $birthDayErr?></span>
		<br><br>
		Giới tính:
		<select name="sex">
			<?php
				if($sex == 1) {
					echo "<option value='1'>Nam</option>";
					echo "<option value='0'>Nữ</option>";
				} else {
					echo "<option value='0'>Nữ</option>";
					echo "<option value='1'>Nam</option>";	
				}
			?>
		</select>
		<span class="error">*</span>
		<br><br>
		Tải ảnh đại diện
		<input type="file" name="avatar"></input>
		<span class="error"> <?php echo $avatarErr?></span>
		<br><br>
		<?php
			if($_SESSION['level'] == 2 && $_SESSION['username'] != $_GET['username']) {
				echo "Level:";
				echo "<select name = 'level'>";
				if($level == 0) {
					echo "<option value='0'>User</option>";
					echo "<option value='1'>Admod</option>";
				} else {
					echo "<option value='1'>Admod</option>";
					echo "<option value='0'>User</option>";
				}
				echo "</select><br><br>";
			}	
		?>
		<input type="submit" name="submit" value="Sửa"></input>
	</form>
</div>
</body>
</html>