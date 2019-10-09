var t;
function onmessage(e){
	postMessage('response');
	// $.ajax({
	// 		type: 'POST',
	// 		url: 'controller/result.php',
 //            // dataType: 'json',
 //            contentType: false,
 //            cache: false,
 //            processData:false,
 //            enctype: 'multipart/form-data',
 //           	data: formData,
 //            success: function(response){
 //            	$('.loader').css("display","none");
 //            	$('.result').text(response);
 //            	postMessage(response);
 //            	clearTimeout(t);
 //            },
 //            error: function (xhr, ajaxOptions, thrownError) {
 //            	t = setTimeout("result()",10000);
 //            	console.log(thrownError);
 //            }
 //        }); 
}

