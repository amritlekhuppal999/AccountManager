<?php 
	if(!empty($_GET["msg"])){
		$msg = $_GET["msg"];
	}else{$msg = '';}

	//INSERT ACCOUNT
	if(isset($_POST["submit"])){
		$formData = array();
		if(!empty($_POST["account_name"])){
			$formData["account_name"] = $_POST["account_name"];
		}
		if(!empty($_POST["username"])){
			$formData["username"] = $_POST["username"];
		}
		if(!empty($_POST["linked_email"])){
			$formData["linked_email"] = $_POST["linked_email"];
		}
		if(!empty($_POST["linked_phone"])){
			$formData["linked_phone"] = $_POST["linked_phone"];
		}
		if(!empty($_POST["password"])){
			$formData["password"] = $_POST["password"];
		}
		if(!empty($_POST["otp_based"])){
			$formData["otp_based"] = $_POST["otp_based"];
		}
		if(!empty($_POST["status"])){
			$formData["status"] = $_POST["status"];
		}

		$formData["user_id"] =  $_POST["userid"];
		$formData["last_modified"] = date("Y:m:d h:i:s");
		$formData["cby"] = 1;
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d");

		$insert = new RowInsert('account_list', $formData);
		if($insert->id > 0){
			$msg = 'Record Inserted';
		}else{
			$msg = 'Error inserting record';
		}

		ReDirect(LOCAL_HOME_URL.'?add-accounts&msg='.$msg);
	}

	//UPDATE ACCOUNT
	if(isset($_POST["update"])){
		$formData = array();
		$id = $_POST["account_id"];
		if(!empty($_POST["account_name"])){
			$formData["account_name"] = $_POST["account_name"];
		}
		if(!empty($_POST["username"])){
			$formData["username"] = $_POST["username"];
		}
		if(!empty($_POST["linked_email"])){
			$formData["linked_email"] = $_POST["linked_email"];
		}
		if(!empty($_POST["linked_phone"])){
			$formData["linked_phone"] = $_POST["linked_phone"];
		}
		if(!empty($_POST["password"])){
			$formData["password"] = $_POST["password"];
		}
		if(isset($_POST["otp_based"])){
			$formData["otp_based"] = $_POST["otp_based"];
		}
		if(isset($_POST["status"])){
			$formData["status"] = $_POST["status"];
		}

		$formData["user_id"] =  $_POST["userid"];
		$formData["last_modified"] = date("Y:m:d h:i:s");
		$formData["cby"] = 1;
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d");

		$update = new RowUpdate('account_list', $formData, 'WHERE id='.$id);
		if($update->updated == true){
			$msg = 'Record Updated';
		}else{
			$msg = 'Error updating record';
		}
		//echo $msg;
		ReDirect(LOCAL_HOME_URL.'?add-accounts&msg='.$msg);
	}

	//FETCH ACCOUNT RECORD
	if(!empty($_GET["id"])){
		$id = $_GET["id"];
		$upacc = new RecordSet('SELECT * FROM `account_list` WHERE id='.$id);
		if($upacc->totalRows > 0){
			$rowData = $upacc->result->fetch_assoc();
			$account_name = $rowData["account_name"];
			$username = $rowData["username"];
			$linked_email = $rowData["linked_email"];
			$linked_phone = $rowData["linked_phone"];
			$password = $rowData["password"];
			$otp_based = $rowData["otp_based"];
			$accStatus = $rowData["status"];
		}
	}
	else{
		$account_name = ''; $username = ''; $linked_email = '';
		$linked_phone = 0; $password = ''; $otp_based = 0;
		$accStatus = 0;
	}
?>

<!-- Page Header -->
<div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
	    <div class="col-sm-6">
	      <h1 class="m-0 text-dark">Accounts</h1>
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

					<?php if(!empty($_REQUEST["id"])){ ?>
						<input type="hidden" name="account_id" value="<?php echo $_REQUEST["id"];?>">
					<?php }?>
					
					<!-- UserId -->
					<input type="hidden" name="userid" value="<?php echo $_SESSION["userid"];?>">

					<!-- Card Header -->
					<div class="card-header">
					<?php if(!empty($_GET["id"])){?>
						<div class="card-title"><b>Update Accounts</b></div>
					<?php }else{ ?>
						<div class="card-title"><b>Add Account</b></div>
					<?php }?>
					</div>

		<!--Card Body-->
		<div class="card-body">
			<div class="row">
				
				<!-- Account Name -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Account Name</label>
						<input type="text" name="account_name" id="account_name" class="form-control" placeholder="Account Name" value="<?php echo $account_name;?>">
					</div>
				</div>

				<!-- Account Username -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Account Username</label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Account Username" value="<?php echo $username;?>">
					</div>
				</div>

				<!-- Linked Email -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Linked Email</label>
						<input type="email" name="linked_email" id="linked_email" class="form-control" placeholder="Linked Email" value="<?php echo $linked_email;?>">
					</div>
				</div>

				<!-- Linked Phone -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Linked Phone</label>
						<input type="number" name="linked_phone" id="linked_phone" class="form-control" placeholder="23456" value="<?php echo $linked_phone;?>">
					</div>
				</div>

				<!-- Password  -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Password</label>
						<input type="text" name="password" id="password" class="form-control" placeholder="****" value="<?php echo $password;?>">
					</div>
				</div>

				<!-- OTP based -->
				<div class="col-md-4">
					<label>OTP based</label>
					<select class="form-control" id="otp_based" name="otp_based">
					<?php $otp = OtpOption();
						foreach($otp as $key => $val){ ?>
							<option value="<?php echo $key;?>" <?php if($otp_based == $key){echo "selected";}?> ><?php echo $val;?></option>
					<?php }?>
					</select>
				</div>
				
				<!-- Status -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="status">
					<?php $stat = Status();
						  foreach($stat as $key=> $val){ ?>
						  	<option value="<?php echo $key;?>" <?php if($accStatus == $key){echo "selected";}?> > <?php echo $val;?></option>
					<?php }?>
						</select>
					</div>
				</div>



			</div>
		</div>

						<!-- Card Footer -->
						<div class="card-footer">
						  <?php if(!empty($_GET["id"])){?>
						  <button name="update" class="btn btn-info">Update</button>
						  <?php }else{?>
						  	<button name="submit" class="btn btn-info">Add</button>
						  <?php }?>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>

<!-- View Accounts Table -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<!--Card Header-->
		            <div class="card-header">
		              <h3 class="card-title"><b>View Accounts</b> &nbsp;
		              	<a href="?add-accounts" class="badge badge-info">Add New</a>
		              </h3>

		              <!-- UserId -->
		              <input type="hidden" id="userid" value="<?php echo $_SESSION["userid"];?>">

		              <div class="card-tools">
		              	  <div class="input-group input-group-sm" style="width: 350px;">
		                    <input type="text" name="table_search" class="form-control float-left" placeholder="Search by Acccont Name" id="dy-search" onkeyup="dySearch()">

		                    <!-- <div class="input-group-append">
		                       	<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
		                    </div> -->
		                  </div>		
		              </div>
		            </div>
		            
		            <!--Card Body-->
		            <div class="card-body" style="overflow-x: auto;">
		              <!--Table-->
		              <table id="example1" class="table table-bordered table-striped text-center">
		                <thead>
			                <tr>
			                  <th>S.no</th>
			                  <th>Account Name</th>
			                  <th>Username</th>
			                  <th>Email</th>
			                  <th>Phone</th>
			                  <th>Password</th>
			                  <th>OTP</th>
			                  <th>Last Modified</th>
			                  <th>Status</th>
			                  <th>Action</th>
			                </tr>
		                </thead>
		                <tbody id="load-record">
			  <?php $acc = new RecordSet('SELECT * FROM `account_list` WHERE user_id='.$_SESSION["userid"]);
				    if($acc->totalRows){
				    	while($rowData = $acc->result->fetch_assoc()){ 
				    		$lastModified = date("d-M-Y h:i:s", strtotime($rowData["last_modified"]));?>
			    			<tr>
			                  <td><?php echo $rowData["id"];?></td>

			                  <td><span class="badge badge-primary">
			                  	<?php echo $rowData["account_name"];?>
			                  </span></td>

			                  <td><span class="badge badge-secondary">
			                  	<?php echo $rowData["username"];?>
			                  </span></td>

			                  <td><span class="badge badge-secondary">
			                  	<?php echo $rowData["linked_email"];?>
			                  </span></td>

			                  <td><span class="badge badge-secondary">
			                  	<?php echo $rowData["linked_phone"];?>
			                  </span></td>

			                  <td><span class="badge badge-secondary">
			                  	<?php echo $rowData["password"];?>
			                  </span></td>

							  <td><?php if($rowData["otp_based"]==1){
					            echo '<span class="badge badge-success">'.getOtpOption($rowData["otp_based"]).'</span>';
					        	}else{
					        		echo '<span class="badge badge-danger">'.getOtpOption($rowData["otp_based"]).'</span>';
					          }?></td>

			                  <td><span class="badge badge-secondary"><?php echo $lastModified;?></span></td>

			                  <td><?php if($rowData["status"]==1){
			                  	echo '<span class="badge badge-success">'.getStatus($rowData["status"]).'</span>';
			                  }else{
			                  	echo '<span class="badge badge-danger">'.getStatus($rowData["status"]).'</span>';
			                  }?></td>

			                  <td><a href="?add-accounts&id=<?php echo $rowData["id"];?>" class="badge badge-info">Modify</a></td>
			                </tr>
			  <?php 	}
					}else{ ?>
							<tr>
			                  <td colspan="10">No Records Added</td>
			                </tr>
			  <?php	}?>
		        		</tbody>
		              </table>
		            </div>

		            <!-- Card Footer -->
		            <div class="card-footer">
		            	<div class="row">
		            		<!-- PAGINATION -->
		            		<div class="col-md-10">
				              	<div id="load-pagn"></div>	
				            </div>
		            	</div>
		            </div>
		            
	            </div>
			</div>

		</div>
	</div>

	<!--Load Section (Unused)-->
	<!-- <div id="load-sect"></div> -->

	<!-- Button trigger modal IMP -->
	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	  Launch demo modal
	</button> -->
	
	<!-- Update Form (Modal) -->
	<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <!-- CLOSE BTN -->
	      <button style="display: none;" type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
	      <!-- BODY -->
	      <div class="modal-body" id="update-form">
	        ...
	      </div>
	    </div>
	  </div>
	</div>

</section>


<script>
	//Script for Add Accounts Form
	function validate(){
		let formData = {
			account_name: document.getElementById("account_name").value,
			linked_email: document.getElementById("linked_email").value,
			linked_phone: document.getElementById("linked_phone").value,
			password: document.getElementById("password").value,
			username: document.getElementById("username").value,
			otp_based: document.getElementById("otp_based").value,
			//status: document.getElementById("status").value,
		};
		//alert(formData.otp_based);
		if(formData.account_name.length <= 0){
			alert("enter account name");
			return false;
		}
		if(formData.account_name.length >= 40){
			alert("name too long");
			return false;
		}
		if(formData.username.length >= 50){
			alert("username too long");
			return false;
		}
		if(formData.linked_email.length <= 0 && formData.linked_phone.length <= 0){
			alert("enter linked email or phone-no");
			return false;
		}
		if(formData.linked_phone.length > 0){
			if(formData.linked_phone.length != 10){
				alert("phone no should be 10 digits long.");
				return false;
			}
		}
		if(formData.password.length > 20){
			alert("password too long, keep it short.");
			return false;
		}
		// alert(formData.account_name.length);
		// return false;
	}
	
	// Dynamic Search
	function dySearch(){
		let serData = {
			userid: document.getElementById("userid").value,
			ser_key: document.getElementById("dy-search").value,
			action: 'search-accounts'
		};
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', 'search-api.php', true);

		xhr.onreadystatechange = function(){
			//console.log('state: '+this.readyState+' & status:'+this.status);
			if(this.readyState == 4 && this.status == 200){
				// console.log(this.responseText);
				let result = JSON.parse(this.responseText);
				//console.log(result.dat);
				document.getElementById("load-record").innerHTML = result.dat;
			}
		}
		xhr.setRequestHeader("Content-Type", "application/json");
		xhr.send(JSON.stringify(serData));
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

