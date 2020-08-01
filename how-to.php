<!-- Page Header -->
<div class="content-header">
	<div class="container-fluid">
	  <div class="row mb-2">
	    <div class="col-sm-6">
	      <h1 class="m-0 text-dark">HOW TO</h1>
	    </div>
	  </div>
	</div>
</div>

<style>
	.codeSnip{
		background:grey;
		color:white;
		font-size: 20px;
	}

	.secAjax{
		font-size: 20px;
	}
</style>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<!--Card Header-->
		            <div class="card-header">
		              <h3 class="card-title"><b>AJAX</b></h3>
					</div>
		            
		            <!--Card Body-->
		            <div class="card-body secAjax" style="overflow-x: auto;">
		            	<p>
		            		Trying to create dynamic search using ajax. Now you wish to send & receive data in <b>JSON</b> structure and at the backend you have <b>PHP</b>. <br>So the problem here is, you need to do certain <b>conversions</b> before sending JSON data and also after receiving but before using them in your DOM. <br>
		            		<br>
		            		<!-- JS -->
		            		In your <b>Front end</b> for e.g the ajax code is:
		            		<!-- AJAX CODE -->
		            		<pre class="codeSnip">
		            			<code>
let serData = { userid: '', ser_key: '', action: '' };
let xhr = new XMLHttpRequest();
xhr.open('POST', 'search-api.php', true);

xhr.onreadystatechange = function(){
	//console.log('state: '+this.readyState+' & status:'+this.status);
	if(this.readyState == 4 && this.status == 200){
		// console.log(this.responseText);
		<b>let result = JSON.parse(this.responseText);</b>
		console.log(result.dat);
		document.getElementById("load-record").innerHTML = result.dat;
	}
}
xhr.setRequestHeader("Content-Type", "application/json");
<b>xhr.send(JSON.stringify(serData));</b>
		            			</code>
		            		</pre>

		            		So here you can see we used <b>JSON.stringfy()</b> to convert the JSON object into string. <br>
		            		And <b>JSON.parse()</b> to convert string back to JSON object received from server. <br>
		            		<br>

		            		<!-- BACK-END -->
		            		Now, to read JSON data in <b>PHP Back-end</b> we do this:
		            		<pre class="codeSnip">
		            			<code>
<b>$myVar = json_decode(file_get_contents('php://input'));</b>
<span style="color:yellow;">//statements</span>
echo json_encode($dataArr, JSON_PRETTY_PRINT);
								</code>
		            		</pre>
		            		Here when this command is executed the variable is now an <b>object</b> of stdClass and <b>NOT</b> an array!! <br>
		            		So to access any of its property we do it the same way we access a property of any class.<br>
		            		For e.g to access <b>action</b> property: <br>
		            		<b>$action = $myVar->action;</b>
		            	</p>  
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