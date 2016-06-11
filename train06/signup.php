<?php
include "../train06/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng kí</title>
	<style type="text/css">
		.error {
					color: #FF0000;
		}
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
	session_start();
	if(isset($_SESSION['username'])) {
		header("location: index.php");
			exit();	
	}

	$fullNameErr = "";
	$userNameErr = "";
	$emailErr = "";
	$phoneErr = "";
	$avatarErr = "";
	$password1Err = "";
	$password2Err = "";
	$avatarErr = "";
	$introducerErr = "";

	$fullName = "";
	$userName = "";
	$email = "";
	$phone = "";
	$avatar = "";
	$pathAvatar = "";
	$password1 = "";
	$password2 = "";
	$introducer = "";

	if(isset($_POST['submit'])) {
		$conn = mysql_connect($SERVER,$USERNAME,$PASSWORD) or die("check your server connection");
		mysql_select_db("group");
		
		if(isset($_POST['fullName'])) {
			$fullName =  mysql_escape_string($_POST['fullName']);
			if($fullName == "") {
				$fullNameErr = "Không được để trống";
			}
		} 
		if(isset($_POST['userName'])) {
			$userName =  mysql_escape_string($_POST['userName']);
			if($userName == "") {
				$userNameErr = "Không được để trống";
			}
		
			$sql = "select * from profile where username ='".$userName."'";
			$query = mysql_query($sql);
			if(mysql_num_rows($query) > 0) {
				$userNameErr = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác";
			} 
		} 
		if(isset($_POST['email'])) {
			$email =  mysql_escape_string($_POST['email']);
			if($email == "") {
				$emailErr = "Không được để trống";
			} else {
						$sql = "select * from profile where email ='".$email."'";
						$query = mysql_query($sql);
						if(mysql_num_rows($query) > 0) {
							$emailErr = "Email đã tồn tại. Vui lòng chọn email khác";
						}
						if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
							$emailErr = "Email không hợp lệ. Vui lòng nhập lại";
						}
			}

			
		} 
		if(isset($_POST['phone'])) {
			$phone =  mysql_escape_string($_POST['phone']);
			if($phone == "") {
				$phoneErr = "Không được để trống";
			} else {
						$sql = "select * from profile where phone ='".$phone."'";
						$query = mysql_query($sql);
						if(mysql_num_rows($query) > 0) {
							$phoneErr = "Số điện thoại đã tồn tại. Vui lòng chọn số điện thoại khác";
						}
						if (!eregi("^([0-9-])*$", $phone)) {
							$phoneErr = "Số điện thoại không hợp lệ. Vui lòng nhập lại";
						} 
			}
		}
		if(isset($_POST['password1'])) {
			$password1= $_POST['password1'];
			if($password1== "") {
				$password1Err= "Không được để trống";
			}
			if($password1 == $userName) {
				$password1Err = "Mật khẩu không được trùng với tên đăng nhập. Vui lòng nhập lại";
			}
			
		} 
		if(isset($_POST['password2'])) {
			$password2= $_POST['password2'];
			if($password2== "") {
				$password2Err = "Không được để trống";
			}
			if($password1 != $password2) {
				$password2Err = "Mật khẩu không trùng nhau. Vui lòng nhập lại";
			}
		} 
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
   		if(isset($_POST['introducer'])) {
			$introducer =  mysql_escape_string($_POST['introducer']);
			if($introducer != "") {
				$sql = "select * from profile where username ='".$introducer."'";
				$query = mysql_query($sql);
				if(mysql_num_rows($query) == 0) {
					$introducerErr = "Người giới thiệu không tồn tại";
				} 
			}	
		} 

		if($fullNameErr==""&&$userNameErr==""&&$emailErr==""&&$phoneErr==""&&$avatarErr==""&&$password1Err==""&&$password2Err=="") {
			$password1 = md5($password1);
			$password2 = md5($password2);
			if($_FILES['avatar']['name'] != NULL) {
				$str = $_FILES['avatar']['type'];
		        $str= substr($str, 6);
			    $avatar = $userName.".".$str;
			    $pathAvatar = "/public/images/".$avatar;
			} else {
				 $pathAvatar = "/public/images/all.png";	
			}
		    $level = 0;
		    $joinDate = date("Y-m-d");
		    //move_uploaded_file($_FILES['avatar']['tmp_name'], "images/avatar/".$avatar);
		    $sql = "insert into profile(fullname, username, email, phone, avatar, password, joindate, level, introducer) values('$fullName','$userName','$email','$phone','$pathAvatar','$password1','$joinDate',$level,'$introducer')";
		    if(mysql_query($sql)) {
		    	if($_FILES['avatar']['name'] != NULL) {
		    		move_uploaded_file($_FILES['avatar']['tmp_name'], "public/images/".$avatar);
		    	}
		    	echo "Chúc mừng bạn đã đăng kí thành công"." ";
		    	echo "<a href='/index.php'>Quay về trang chủ</a>"."<br>";	
		    } else {
		    	echo "Đã có lỗi xảy ra";
		    	die();
		    }	
		}
	}
?>
<div>
	<p><span class="error">* Thông tin bắt buộc</span></p>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
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
		Mật khẩu:
		<input type="password" name="password1"></input>
		<span class="error">* <?php echo $password1Err?></span>
		<br><br>
		Nhập lại lần nữa
		<input type="password" name="password2"></input>
		<span class="error">* <?php echo $password2Err?></span>
		<br><br>
		Số điện thoại:
		<input type="text" name="phone" value="<?php echo $phone ?>"></input>
		<span class="error">* <?php echo $phoneErr?></span>
		<br><br>
		Tải ảnh đại diện
		<input type="file" name="avatar"></input>
		<span class="error"> <?php echo $avatarErr?></span>
		<br><br>
		Người giới thiệu
		<input type="text" name="introducer" value="<?php echo $introducer?>"></input>
		<span class="error"> <?php echo $introducerErr?></span>
		<br><br>
		<input type="submit" name="submit" value="Đăng kí"></input>
	</form>
</div>

</body>
</html>