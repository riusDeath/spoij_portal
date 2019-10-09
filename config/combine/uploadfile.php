<?php 

function uploadFile($path) {
	if (isset($_POST['btnUploadFile']))
	{
	    if (isset($_FILES['file']))
	    {
	        if ($_FILES['file']['error'] > 0)
	        {
	            return false;
	        }
	        else{
	            move_uploaded_file($_FILES['file']['tmp_name'], $path);
	            return true;
	        }
	    }
	
	    return false;
	}
}

?>
