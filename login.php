<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/delicious-layout.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Delicious|Login</title>
</head>
<?php
 require_once('./Logic/connect.php');
 $error = $username = $password="";
 if(isset($_POST['loginBtn'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $sql = "SELECT user_id, first_name, `password`, user_type from user where email = ?";
    $conn = new mysqli($server_name, $db_user, $db_password, $db_name);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    if(!$stmt->execute()){
        exit;
    }

    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $res = $result->fetch_assoc();
        $real_pass = $res['password'];
        $user_id = $res['user_id'];
        $user_type = $res['user_type'];
        $firstname = $res['first_name'];

        if(password_verify($password, $real_pass)){
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['cart'] = array();
            if($user_type == "admin"){
                header("Location: orders.php");
            }
            header("Location: index.php");
        }
        else{
            $error="wrong password";
        }
    }else{
        $error = "Wrong user name";
    }
 }
?>
<body 
    <div id="body-overlay">

    <header class="heading">
        <nav id="main-nav">
            <h1 class="logo" id="logo">Delicious</h1>
        </nav>
    </header>
    <section class="form-section">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="login-form" method="post">
        <p id="login-form-head">LOGIN</p>
        
        <div class="error"><?php echo $error; ?></div>
                
                <input type="text" name="username" id="username-input" placeholder="your email" value="<?php echo $username;?>">
               
               
                <input type="password" name="password" id="password-input" placeholder="your password" value="<?php echo $password; ?>">

                <p><a href="login.php" target="_blank">Forgot password</a></p>
            
    
            <button type="submit" id="login-btn" name="loginBtn">LOGIN</button>
        <p><a href="registration.php">Sign up</a></p>
    </form>
    </section>
    <footer class="footer">

    </footer>

    </div>
</body>
</html>