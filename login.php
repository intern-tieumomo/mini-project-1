<?php
	session_start();
	require_once 'connect.php';
	if(isset($_SESSION['email'])){
		header("Location: index.php");
	}

	if(isset($_COOKIE['cookie_id'])){
		$cookie_id = $_COOKIE['cookie_id'];
		$sql = "select email from tb_account where cookie_id = '$cookie_id'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['email'] = $row['email'];
			header("Location: index.php");
		}
	}

	if(!empty($_GET['login'])){
		$isAuth = false;

		$email = $_GET['email'];
		$password = $_GET['password'];

		$sql = "select * from tb_account where email = '".$email."' and password = '".md5($password)."'";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			$isAuth = true;
		}

		if($isAuth){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['email'] = $email;

			if(!empty($_GET['remember-me'])){
				setcookie("email", $email, time() + 60*60*24*30);//30 days
				setcookie("cookie_id", $row['cookie_id'], time() + 60*60*24*30);
			} else {
				if (isset($_COOKIE["email"])) {
          setcookie("email", "");
        }
        if (isset($_COOKIE["cookie_id"])) {
          setcookie("cookie_id", "");
        }
			}
			header("Location: index.php");
		} else {
			$error = "Email or password is incorrect";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="shortcut icon" href="https://img.icons8.com/pastel-glyph/64/000000/login-rounded-right.png">
	<!------------------------------------------------Bootstrap------------------------------------------------------>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="form-box">
		<form class="form-container" method="get">
			<div class="form-title">Login</div>
			<div class="form-group">
				<label for="exampleInputError1" style="color: red;"><?php if(isset($error)) echo $error; ?></label>
			</div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required placeholder="Email" value="<?php if(isset($error)){ echo $email; } elseif (isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>">
		    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" name="password" id="exampleInputPassword1" required placeholder="Password">
		  </div>
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember-me"
		    <?php
		    	if(isset($_COOKIE['email'])){
	    			echo "checked";
	    		}
		    ?>
		    >
		    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
		  </div>
		  <button type="submit" class="btn btn-primary btn-block" name="login" value="login">LOGIN</button>
		</form>
	</div>

	<!------------------------------------------------Bootstrap------------------------------------------------->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>