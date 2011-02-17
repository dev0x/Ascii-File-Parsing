<?php
/**
 *   ListDir PHP function
 *   
 */
 
 function ListDir($dir_handle,$path) {
	global $listing;
	echo "<ul>";
	while (false !== ($file = readdir($dir_handle))) {
		$dir =$path . $file;
		if(is_dir($dir) && $file != '.' && $file !='..' ) {
			$handle = @opendir($dir) or die("Unable to open file $file");
			echo "<li>".$dir;
			ListDir($handle, $dir);
			echo "</li>";
		} elseif($file != '.' && $file !='..' && $file !='.htaccess') {
			//echo '<li><a href="'. $dir .'">'.$file.'</a></li>';
			echo '<li><a href="view.php?filename='.$file.'">'.$file.'</a></li>';
		}
	}
	echo "</ul>";
	closedir($dir_handle);
}
