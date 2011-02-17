<?php
//folder where the files are stored at 
//you may need to chmod this folder to 775 or 777 for it to work 
$src_folder = 'files/'; 
 
 //file that includes the function to list all files in ul 
 include("inc/file_list.php"); 
  
  //if javascript is disabled, the ftp will still work 
  if (isset($_FILES["file"])) { 
	if ($_FILES["file"]["error"] > 0) {
		$error = 'Error Uploading!'; 
	} else { 
		$count = '1'; 
		$file_loc = $path . $_FILES["file"]["name"]; 
		$base = $_FILES["file"]["name"]; 
		while ( file_exists($file_loc) ) { 
			$file_loc = $path . $count.'-'. $_FILES["file"]["name"]; 
			$base = $count.'-'. $_FILES["file"]["name"]; 
			$count++; 
	    	}	 
		move_uploaded_file($_FILES["file"]["tmp_name"], $file_loc); 
	}
  }	
?>                                                                    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Upload File Application</title>
<link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="_assets/js/jquery.min.js"></script>
<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#file_upload').uploadify({
		'uploader'  : 'uploadify/uploadify.swf',
		'script'    : 'uploadify/uploadify.php',
//		'buttonImg' : '_assets/img/browse.png',
		'cancelImg' : 'uploadify/cancel.png',
		'folder'    : 'files',
		'auto'      : true,
		onProgress: function() {
			$('#loader').show();
		},
		onAllComplete: function() {
			$('#loader').hide();
			$('#allfiles').load(location.href+" #allfiles>*","");
			//location.reload(); //uncomment this line if youw ant to refresh the whole page instead of just the #allfiles div
		}
	});
});
</script>
</head>
<body>
<div id="body">
	<h2><span id="loader"><img src="_assets/img/loading.gif" alt="Loading..." /></span> </h2>
	<div id="sidebar">
		<!-- form -->
		<form id="file_upload" action="upload.php" method="POST" enctype="multipart/form-data">
		<p><input id="file_upload_in" name="file_upload" type="file" /></p>
		<p><input type="submit" name="submit" value="yarrr!" /></p>
		</form>
	</div>
	<!-- whole div to be refreshed once uploadify is finished --> 
	<div id="allfiles" > 
    	<?php 
        	//list all files via function file included up top 
		$handle = @opendir($src_folder) or die("Unable to open $src_folder"); 
		ListDir($handle,$src_folder); 
    	?> 
	</div>
	<div class="clear"></div>
	<p>Upload the ascii data files and then click the link of the file to view parsed out data </p>
</div>
</body>
</html>
