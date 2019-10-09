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
				<input class="jobid"  type="hidden" name="jobid" value="-1">
				<select  class="form-control" name="language">
					<option value="java">java</option>
					<option value="php">php</option>
					<option value="py">python</option>
					<!-- <option value="C++">C++</option> -->
				</select>
				<div class="form-group">
					<input type="file" name="file" id="file">
					<button class="btn btn-success btnUploadFile"  type="submit" name="btnUploadFile">Submit</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
<script>
	var w ;
	var limit = 0;
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
		  		if (data != -1) {
		    		alert('submit code successfull');
		  			document.querySelector('.jobid').value = data;
		  			document.querySelector('.jobid').onchange();
		  		} else {
		  			alert('500 server');
		  		}	
				
		  	}, function(error) {
		  	  	console.log('Promise rejected.');
		  	});
		});


		if (window.Worker) {
			const jobid = document.querySelector('.jobid');

			const result = document.querySelector('.result');
			console.log('Message received from worker');
			if(typeof(w) == "undefined") {
		      w = new Worker("worker.js");
		    }

		    jobid.onchange = function() {
			  w.postMessage(jobid.value);
			  console.log('Message posted to worker');
			}

			w.onmessage = function(e) {
				var grade = JSON.parse(e.data);
				if (grade.length!=0) {
					result.textContent = "result combine: "+grade[0].grade+"%";
					result.append(" time combine:" +grade[0].time_combine);
					console.log('Message received from worker successfull!');
				} else {
					if (limit < 1000000) {
						document.querySelector('.jobid').onchange();
						limit++;
					} else {
						result.textContent = "Fail";
					}
				}
			}
		} else {
			console.log('Your browser doesn\'t support web workers.')
			document.querySelector('.jobid').onchange() = function(e) {
				getResult(e);
			}
		}
		
		function getResult(e) {
		    console.log('Worker: Message received from main script');
		    var request = new XMLHttpRequest();
		    request.open("POST", "controller/result.php", true);
		    console.log('jobid: '+e.data);
		    request.onload = function() {
		        if (request.status == 200) {
		        	var grade = JSON.parse(request.response);
		           	if (grade.length!=0) {
						console.log(grade.length);
						result.textContent = "result combine: "+grade[0].grade+"%";
						console.log('Message received from worker successfull!');
					} else {
						document.querySelector('.jobid').onchange();
					}
		        } else {
		            result.textContent = "Fail";
		        }
		    };
		    var formData = new FormData();
		    formData.append('jobid', e.data);
		    request.send(formData);
		}
	});
</script>