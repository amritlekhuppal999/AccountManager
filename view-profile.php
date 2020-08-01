<?php 
	if(!empty($_GET["msg"])){
		$msg = $_GET["msg"];
	}else{$msg = '';}
	
	//UPDATE ACCOUNT
	if(isset($_POST["update"])){
		$formData = array();
		$id = $_POST["userid"];
		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}
		if(!empty($_POST["username"])){
			$chekUsr = new RecordSet('SELECT id FROM `user_list` WHERE username="'.$_POST["username"].'" AND id!='.$id);
			if($chekUsr->totalRows == 0){
				$formData["username"] = $_POST["username"];
			}
			else{ 
				$msg = 'Username already in use!'; 
				ReDirect(LOCAL_HOME_URL.'?view-profile&msg='.$msg);
				exit();
			}
			
		}
		if(!empty($_POST["password"])){
			$formData["password"] = md5($_POST["password"]);
		}

		$formData["cby"] = 1;
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d");

		$update = new RowUpdate('user_list', $formData, 'WHERE id='.$id);
		if($update->updated == true){
			$msg = 'User Updated';
		}else{
			$msg = 'Error updating user';
		}

		ReDirect(LOCAL_HOME_URL.'?view-profile&msg='.$msg);
	}

	//FETCH ACCOUNT RECORD
	if(!empty($_SESSION["userid"])){
		$id = $_SESSION["userid"];
		$upUsr = new RecordSet('SELECT * FROM `user_list` WHERE id='.$id);
		if($upUsr->totalRows > 0){
			$rowData = $upUsr->result->fetch_assoc();
			$name = $rowData["name"];
			$username = $rowData["username"];
			$accStatus = $rowData["status"];
		}
	}
	else{
		$name = ''; $username = ''; $accStatus = '';
	}
?>

<!-- Page Header -->
<div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
	    <div class="col-sm-6">
	      <h1 class="m-0 text-dark">PROFILE</h1>
	    </div>
	  </div>
	</div>
</div>



<!-- Add Accounts Form -->
<section class="content">
	<div class="container-fluid">
		
		<!-- Error Msg -->
		<span id="error-msg"><b><?php echo $msg;?></b></span>

		<div class="row">
			<div class="col-md-12">
				<div class="card card-default">
					
					<!--Form Start-->
					<form action="#" method="POST" enctype="multipart/form-data" onsubmit=" return validate()">

					<!-- UserId -->
					<input type="hidden" name="userid" value="<?php echo $_SESSION["userid"];?>">

					<!-- Card Header -->
					<div class="card-header">
						<div class="card-title"><b>Update Profile</b></div>
					</div>

		<!--Card Body-->
		<div class="card-body">
			<div class="row">
				
				<!-- Name -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $name;?>">
					</div>
				</div>

				<!-- Username -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $username;?>">
					</div>
				</div>

				<!-- Password  -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Password</label>
						<input type="text" name="password" id="password" class="form-control" placeholder="****">
					</div>
				</div>

				<!-- Status (Disable Account) -->
				<?php /* 
				<div class="col-md-4">
					<div class="form-group">
						<label>Disable Account</label>
						<select class="form-control" name="status">
					<?php $stat = Status();
						  foreach($stat as $key=> $val){ ?>
						  	<option value="<?php echo $key;?>" <?php if($accStatus == 1){echo "selected";}?> > <?php echo $val;?></option>
					<?php }?>
						</select>
					</div>
				</div>  */?>



			</div>
		</div>

						<!-- Card Footer -->
						<div class="card-footer">
						  	<button name="update" class="btn btn-info">Update</button>
						</div>
					</form>
					<!-- Form Ends -->

				</div>
			</div>

		</div>
	</div>
</section>


<script>
	function validate(){
		let formData = {
			nameVar: document.getElementById("name").value,
			username: document.getElementById("username").value,
			password: document.getElementById("password").value,
		};

		if(formData.nameVar.length <= 0 || formData.nameVar.length >= 40){
			alert("Enter a valid name.");
			return false;
		}
		if(formData.username.length <= 0 || formData.username.length >= 40){
			alert("Enter a valid username.");
			return false;
		}
		if(formData.password.length >= 0){
			if(formData.password.length >= 20){
				alert("password too long");
				return false;
			}
		}
	}
	
	
</script>


<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
		  theme: 'bootstrap4'
		})

	  //Datemask dd/mm/yyyy
	  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
	  //Datemask2 mm/dd/yyyy
	  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy'});

	  //Date mask & Money Euro
	  $('[data-mask]').inputmask()
	});
</script>

