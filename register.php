<?php include('function/function.class.php'); 
    CheckLogin();

    //MSG
    if(!empty($_GET["msg"])){
      $msg = $_GET["msg"];
    }else{$msg = '';}

    //REGISTER
    if(isset($_POST["register"])){
      $formData = array();
      if(!empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["password"])){
        $formData["name"] = $_POST["name"];
        $formData["username"] = $_POST["username"];
        $formData["password"] = md5($_POST["password"]);

        $formData["cby"] = 1;
        $formData["cip"] = "";
        $formData["status"] = 1;
        $formData["cdate"] = date("Y:m:d");

        $insert = new RowInsert('user_list', $formData);
        if($insert->id > 0){
          $_SESSION["userid"] = $insert->id;
          $_SESSION["username"] = $formData["username"];
          $loc = LOCAL_HOME_URL;
        }
        else{
          $msg = 'Unable to add user.';
          $loc = LOCAL_HOME_URL.'register.php?msg='.$msg;
        }
      }
      // else{
      //   $msg = 'Sab khali hai??';
      // }

      ReDirect($loc);  
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Account Manager</title>
  <!-- <link rel="shortcut icon" type="image/png" href="../images/in_design/Mario.png"> -->

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Tempusdominus Bbootstrap 4 -->
    <!-- <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->  

    <style>
      .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #1f2d3d;
        color: white;
        text-align: center;
      }

      #error-msg{
        color: red;
        font-size: 15px;
      }
    </style>
</head>
<body class="hold-transition login-page">

  <!-- Login Box -->
  <div class="login-box">
    <div class="login-logo">
      <!-- <a href="#"><b>Account</b>Manager</a> -->
      <a href="#"><b>Register</b></a>
    </div>
    
    <!-- Card -->
    <div class="card">

      <!-- Card Body -->
      <div class="card-body login-card-body">
        <!-- <p class="login-box-msg">Register</p> -->
        <p id="error-msg"><?php echo $msg;?></p>
        <!-- Login/Register Form -->
        <form action="#" method="post" onsubmit="return validate()">
          <!-- Name -->
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <!-- Username -->
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <!-- Password -->
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="conf-password" name="conf-password" placeholder="****" onkeyup="matchPasswd()">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <!-- <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label> -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button name="register" id="register" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <p class="mb-1">
          <a href="forgot-password.html">Forgot password?</a>
        </p> -->
        <p class="mb-0">
          <a href="login.php" class="text-center">Existing user?</a>
        </p>
      </div>
      
    </div>
  </div>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<script>
  function validate(){
    let formData = {
      nameVar: document.getElementById("name").value,
      username: document.getElementById("username").value,
      password: document.getElementById("password").value
    }

    if(formData.nameVar.length <= 0){
      alert("Enter name.");
      return false;
    }
    if(formData.username.length <= 0){
      alert("Enter your username");
      return false;
    }
    if(formData.password.length <= 0){
      alert("Enter your password");
      return false;
    }

    if(formData.nameVar.length >= 50){
      alert("Please keep name short.");
      return false;
    }
    if(formData.username.length > 50){
      alert("Invalid username");
      return false;
    }
    if(formData.password.length > 20){
      alert("Invalid password");
      return false;
    }
  }

  function matchPasswd(){
    let formData = {
      c_passwd: document.getElementById("conf-password").value,
      password: document.getElementById("password").value
    };

    //alert(c_passwd); return false;
    if(formData.password !== formData.c_passwd){
      document.getElementById("register").disabled = true;
      document.getElementById("error-msg").innerHTML = "Passwords do not match";
    }
    else{
      document.getElementById("register").disabled = false;
      document.getElementById("error-msg").innerHTML = "";
    }
  }
</script>
