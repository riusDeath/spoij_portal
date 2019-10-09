<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DEMO SPOJ</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		.loader {
			margin-left: 400px ;
			display: none;
			border: 16px solid #f3f3f3; /* Light grey */
			border-top: 16px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 120px;
			height: 120px;
			animation: spin 2s linear infinite;
		}

		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
	</style>
</head>
<body>
	<div class="container" style="margin-top: 100px; border: 1px solid black; padding: 100px">
		<label for="label-danger"></label>
		<div class="justify-content text-center">
			<div class="loader" ></div>
			<h2>Compile Code</h2>
		</div>
		<div class="alert alert-success result" role="alert">
		  
		</div>

		<div class="text-center" style="margin-top: 20px">
			<form action="controller/SubmitController.php" method="POST" enctype="multipart/form-data" id="form"> 
				<input type="hidden" name="contestid" value="1">
				<select  class="form-control" name="language">
					<option value="java">java</option>
					<option value="php">php</option>
					<option value="py">python</option>
					<option value="C++">C++</option>
				</select>
				<div class="form-group">
					<input type="file" name="file" id="file">
					<button class="btn btn-success btnUploadFile" type="submit" name="btnUploadFile">Submit</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
<script>
	$(document).ready(function(){
		$("#form").on('submit', function(e){
			e.preventDefault();
			var formData = new FormData(this);
			e.preventDefault();
			console.log("submit form");
		  	$('.loader').css("display","block");
		  	var promise = new Promise(function(resolve, reject) {
		  		var request = new XMLHttpRequest();
		  		request.open("POST", "controller/submitDemoQueue.php", true);
		  		request.onload = function() {
		  			if (request.status == 200) {
			        	resolve(request.response); 
				    } else {
				        reject(Error(request.statusText)); 
				    }
				};
			    request.onerror = function() {
			      reject(Error('Error fetching data.')); 
			    };
		  		request.send(formData);
		  	});
		  	console.log('Asynchronous request made.');

		  	promise.then(function(data) {
		  		$('.loader').css("display","none");
		    	alert(data);
		    	$.ajax({
					type: 'POST',
					url: 'controller/Worker.php',
		            // dataType: 'json',
		            contentType: false,
		            cache: false,
		            processData:false,
		            enctype: 'multipart/form-data',
		           	data: formData,
		            success: function(response){
		            	$('.loader').css("display","none");
		            	// console.log(response);
		            	// alert(response);
		            	$('.result').text(response);
		            },
		            error: function (xhr, ajaxOptions, thrownError) {
		            	console.log(thrownError);
		            }
		        }); 
		  	}, function(error) {
		  	  	console.log('Promise rejected.');
		  	});
		});
	});
</script>