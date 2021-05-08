<?php 
session_start();
include_once "connect_sql/connect.php";
if (isset($_SESSION['submit'])){
    $_SESSION['success'] = 'Bạn đã đăng nhập rồi';
    header('Location: php/indextt.php');
    exit();
}
?>
<?php
$error = '';
$error1 ='';
$error2 ='';
if (isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  if (empty($username)) {
    $error1 = "Hãy nhập username ";
  } elseif (empty($_POST['password'])) {
    $error2 = "Hãy nhập password";
  }
else{
      $sql = "select * from users where username = '$username' and password = '$password' ";
      $query = mysqli_query($conn,$sql);
      $num_rows = mysqli_num_rows($query);
      if ($num_rows==0) {
        $error = "Invalid username or password !";
      } else{
        //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
        $_SESSION['email'] = $email;
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                header('Location: php/indextt.php');
      }
    }
};
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form action="" method="POST">
					<legend>Login</legend>
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" id="" placeholder="Input username">
                        <h3 style="color: red; font-size: 12px"><?php echo $error1; ?></h3>
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="password" class="form-control" id="" placeholder="Input password">
                        <h3 style="color: red; font-size: 12px"><?php echo $error2; ?></h3>
					</div>
					<input type="submit" name="submit" value="Log In">
				</form>
			</div>
		</div>
	</div>

</body>
</html>