
onmessage = function(e) {
    getResult(e);
}


function getResult(e) {
    console.log('Worker: Message received from main script');
    var request = new XMLHttpRequest();
    request.open("POST", "controller/result.php", true);
    console.log('jobid: '+e.data);
    request.onload = function() {
        if (request.status == 200) {
            postMessage(request.response);
        } else {
            postMessage('500 error');
        }
    };
    var formData = new FormData();
    formData.append('jobid', e.data);
    request.send(formData);
}
	

