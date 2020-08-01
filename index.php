<?php include('function/function.class.php'); 
	IndexCheckLogin();

	if(isset($_GET["view-profile"])){
		$inc_page = 'view-profile.php';
	}
	else if(isset($_GET["view-users"])){
		$inc_page = 'view-users.php';
		//to view users, set debug-admin in url.
	}
	else if(isset($_GET["update-user"])){
		$inc_page = 'update-user.php';
	}
	else if(isset($_GET["add-accounts"])){
		$inc_page = 'add-accounts.php';
	}
	else if(isset($_GET["update-account"])){
		$inc_page = 'update-account.php';
	}
	else if(isset($_GET["how-to"])){
		$inc_page = 'how-to.php';
	}
	else{
		$inc_page = 'view-accounts.php';
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
			color:red;
			font-size: 15px;
		}
  	</style>
</head>
<body> <!-- style="background-color: #323331;" #ededed-->

	<!-- Navbar -->
	<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="http://localhost/ALU/AccountManager/">Home</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">

	      <!-- View Account -->	
	      <li class="nav-item <?php if(isset($_GET["view-accounts"])){ echo 'active';}?>">
	        <a class="nav-link" href="?view-accounts">View Accounts</a>
	      </li>

	      <!-- Add Accounts -->
	      <li class="nav-item <?php if(isset($_GET["add-accounts"])){ echo 'active';}?>">
	        <a class="nav-link" href="?add-accounts">Add Accounts</a>
	      </li>

	      <!-- How to -->
	      <li class="nav-item <?php if(isset($_GET["how-to"])){ echo 'active';}?>">
	        <a class="nav-link" href="?how-to">How to</a>
	      </li>

	      <!-- User Profile -->
	      <li class="nav-item <?php if(isset($_GET["view-profile"])){ echo 'active';}?>">
	        <a class="nav-link" href="?view-profile"><?php echo $_SESSION["username"].'\'s';?> Profile</a>
	      </li>

	      <!-- Logout -->
	      <li class="nav-item">
	       	<a class="nav-link" href="logout.php">Logout</a>
	      </li>

	      <!-- <li class="nav-item">
	        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
	      </li> -->
	    </ul>
	    
	  </div>
	</nav>

	<!-- Include Page -->
	<div class="">
		<?php include($inc_page);?>
	</div>

	<!-- Footer -->
	<!-- <div class="footer"><p><b>FOOTER</b></p></div> -->

	<!-- Preload Scripts !! -->
	<div>
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

		<!-- Select2 -->
		<script src="plugins/select2/js/select2.full.min.js"></script>

		<!-- InputMask -->
		<script src="plugins/moment/moment.min.js"></script>
		<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

		<!-- Tempusdominus Bootstrap 4 JS-->
		<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->

		<!-- Bootstrap Switch -->
		<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
	</div>
	
</body>
</html>

