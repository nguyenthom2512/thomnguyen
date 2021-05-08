<?php 
session_start();
include_once "config/myConnect.php";
if (isset($_SESSION['email'])){
    $_SESSION['success'] = 'Bạn đã đăng nhập rồi';
    header('Location: index.php');
    exit();
}
?>
<?php
$error = '';
$error1 ='';
$error2 ='';
if (isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email)) {
    $error1 = "Please enter your email ";
  } elseif (empty($_POST['password'])) {
    $error2 = "Please enter your password";
  }
else{
      $sql = "select * from users where email = '$email' and password = '$password' ";
      $query = mysqli_query($conn,$sql);
      $num_rows = mysqli_num_rows($query);
      if ($num_rows==0) {
        $error = "Invalid username or password !";
      } else{
        //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
        $_SESSION['email'] = $email;
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                header('Location: index.php');
      }
    }
};
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/all.min.css">
</head>
<body> 
<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

  * {
  box-sizing: border-box;
  }

  body {
  background: #f6f5f7;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  font-family: 'Montserrat', sans-serif;
  height: 100vh;
  margin: -20px 0 50px;
  }

  h1 {
  font-weight: bold;
  margin: 0;
  }
  h1.signin {
    padding: 40px;
    margin-top: -20px;
  }
  p {
  font-size: 14px;
  font-weight: 100;
  line-height: 20px;
  letter-spacing: 0.5px;
  margin: 20px 0 30px;
  }
  input[type="submit"]{
  border-radius: 20px;
  border: 1px solid #FA9284;
  background-color: #FA9284;
  color: #FFFFFF;
  font-size: 12px;
  font-weight: bold;
  padding: 12px 45px;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: transform 80ms ease-in;
  }

  input[type="submit"]:active {
  transform: scale(0.95);
  }

  button:focus {
  outline: none;
  }

  button.ghost {
  background-color: transparent;
  border-color: #FFFFFF;
  }

  form {
  background-color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 50px;
  height: 100%;
  text-align: center;
  }

  input {
  background-color: #eee;
  border: none;
  padding: 12px 15px;
  margin: 8px 0;
  width: 100%;
  }

  .container {
  background-color: #fff;
  border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
      0 10px 10px rgba(0,0,0,0.22);
  position: relative;
  overflow: hidden;
  width: 768px;
  max-width: 100%;
  min-height: 480px;
  }

  .form-container {
  position: absolute;
  top: 0;
  height: 100%;
  transition: all 0.6s ease-in-out;
  }

  .sign-in-container {
  left: 0;
  width: 50%;
  z-index: 2;
  }

  .container.right-panel-active .sign-in-container {
  transform: translateX(100%);
  }

  .sign-up-container {
  left: 0;
  width: 50%;
  opacity: 0;
  z-index: 1;
  }

  .container.right-panel-active .sign-up-container {
  transform: translateX(100%);
  opacity: 1;
  z-index: 5;
  animation: show 0.6s;
  }

  @keyframes show {
  0%, 49.99% {
    opacity: 0;
    z-index: 1;
  }
  
  50%, 100% {
    opacity: 1;
    z-index: 5;
  }
  }

  .overlay-container {
  position: absolute;
  top: 0;
  left: 50%;
  width: 50%;
  height: 100%;
  overflow: hidden;
  transition: transform 0.6s ease-in-out;
  z-index: 100;
  }

  .container.right-panel-active .overlay-container{
  transform: translateX(-100%);
  }

  .overlay {
  background: #FF416C;
  background: -webkit-linear-gradient(to right, #FA9284, #D46C4E);
  background: linear-gradient(to right, #FA9284, #D46C4E);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 0 0;
  color: #FFFFFF;
  position: relative;
  left: -100%;
  height: 100%;
  width: 200%;
    transform: translateX(0);
  transition: transform 0.6s ease-in-out;
  }

  .container.right-panel-active .overlay {
    transform: translateX(50%);
  }

  .overlay-panel {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 40px;
  text-align: center;
  top: 0;
  height: 100%;
  width: 50%;
  transform: translateX(0);
  transition: transform 0.6s ease-in-out;
  }

  .overlay-left {
  transform: translateX(-20%);
  }

  .container.right-panel-active .overlay-left {
  transform: translateX(0);
  }

  .overlay-right {
  right: 0;
  transform: translateX(0);
  }

  .container.right-panel-active .overlay-right {
  transform: translateX(20%);
  }

  .social-container {
  margin: 20px 0;
  }

  .social-container a {
  border: 1px solid #DDDDDD;
  border-radius: 50%;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  margin: 0 5px;
  height: 40px;
  width: 40px;
  }
</style>
<div class="container" id="container">
  <div class="form-container sign-in-container">
    <form action="" method="POST">
      <h1 class="signin">Sign in</h1>
      <input type="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email']: ''?>" />
      <h3 style="color: red; font-size: 12px"><?php echo $error1; ?></h3>
      <input type="password" placeholder="Password" name="password" />
      <h3 style="color: red; font-size: 12px"><?php echo $error2; ?></h3>
      <h3 style="color: red; font-size: 12px"><?php echo $error; ?></h3>
      <input type="submit" name="submit" value="Sign In">
    </form>
  </div>
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <h1>Welcome Back!</h1>
        <p>To keep connected with us please login with your personal info</p>
        <button class="ghost" id="signIn">Sign In</button>
      </div>
      <div class="overlay-panel overlay-right">
        <h1>Hello, Friend!</h1>
        <p>Enter your personal details and start journey with us</p>
      </div>
    </div>
  </div>
</div>
</body>
</html>