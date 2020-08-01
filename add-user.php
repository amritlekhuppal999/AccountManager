
<!-- Page Header -->
<div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
	    <div class="col-sm-6">
	      <h1 class="m-0 text-dark">ADD USER</h1>
	    </div>
	  </div>
	</div>
</div>


<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-default">
					
					<!--Form Start-->
					<form enctype="multipart/form-data">

					<!-- Card Header -->
					<!-- <div class="card-header"></div> -->

		<!--Card Body-->
		<div class="card-body">
			<div class="row">
				
				<!-- User Name -->
				<div class="col-md-6">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Username">
					</div>
				</div>

				<!-- Display Picture -->
				<div class="col-md-6">
				  	<div class="form-group">
		              <label for="exampleInputFile">Display Picture</label>
		              <div class="input-group">
		                <div class="custom-file">
		                  <input type="file" name="dp" class="custom-file-input" id="dp">
		                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
		                </div>
		              </div>
		            </div>
				</div>

				<!-- Password  -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="****">
					</div>
				</div>

				<!-- Gender -->
				<div class="col-md-4">
					<label>Gender</label>
					<select class="form-control" id="gender">
						<!-- <option value="0">Select</option> -->
					<?php $gen = Gender();
					foreach($gen as $key => $val){?> 
						<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
					</select>
				</div>

				

				<!-- Status -->
				<div class="col-md-4">
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" id="status">
					<?php $stat = Status();
						  foreach($stat as $key=> $val){ ?>
						  	<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php }?>
						</select>
					</div>
				</div>

			</div>
		</div>

						<!-- Card Footer -->
						<div class="card-footer">
						  <a id="submit" class="btn btn-default">Add</a>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>




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