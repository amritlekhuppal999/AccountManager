
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