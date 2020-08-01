<?php 
	if(!isset($_REQUEST["debug-admin"])){
		ReDirect(LOCAL_HOME_URL);
	}
?>
<!-- Page Header -->
<div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
	    <div class="col-sm-6">
	      <h1 class="m-0 text-dark">User List</h1>
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
		              <!-- <h3 class="card-title"><b>View Admin</b></h3> -->
		              <div class="card-tools">
		              	  <div class="input-group input-group-sm" style="width: 350px;">
		                    <input type="text" name="table_search" class="form-control float-left" placeholder="Search by Name" id="dy-search">

		                    <!-- <div class="input-group-append">
		                       	<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
		                    </div> -->
		                  </div>		
		              </div>
		            </div>
		            
		            <!--Card Body-->
		            <div class="card-body">
		              <!--Table-->
		              <table id="example1" class="table table-bordered table-striped text-center">
		                <thead>
			                <tr>
			                  <th>ID</th>
			                  <th>DP</th>
			                  <th>Username</th>
			                  <th>Status</th>
			                  <th>Action</th>
			                </tr>
		                </thead>
		                <tbody>
			  <?php $user = new RecordSet('SELECT * FROM `user_list`');
				    if($user->totalRows){
				    	while($rowData = $user->result->fetch_assoc()){ ?>
			    			<tr>
			                  <td><?php echo $rowData["id"];?></td>
			                  <td><?php echo $rowData["name"];?></td>
			                  <td><?php echo $rowData["username"];?></td>
			                  <td><?php echo getStatus($rowData["status"]);?></td>
			                  <td>Action</td>
			                </tr>
			  <?php 	}
					}else{ ?>
							<tr>
			                  <td colspan="8">No Records Found</td>
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