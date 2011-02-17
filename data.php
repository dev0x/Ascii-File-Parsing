<?php

$filename = $_GET["filename"];

$file_handle = fopen("files/$filename", "r");

$line_count = 1;
while (!feof($file_handle)){
	$line_of_text = fgets($file_handle);
	//replace single space followed by dash with two spaces and dash
	$line_of_text_alt = preg_replace('/\s-/', '  -', $line_of_text); 
	$parts = preg_split('/\s\s/', $line_of_text_alt); //split the line by the two spaces 
		//regex for s.notation ^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$ keeping this here because I think its cool
	//grab stuff from the split array
	$label_and_sequence = $parts[3];
	$last_column = $parts[10];
	//data stored in scientific notation so we do some magic math
	$number = $last_column+0;
	//Strip the stupid sequence off 
	$label = preg_replace('/^[\d]+\s/', '', $label_and_sequence);
	//Now if we like the original line of text with the format where we know there is data to parse.. we flop that baby out
	if (preg_match("/\d\d\s/i", $line_of_text)){	
		echo"<tr><td class='colOne'>$label</td><td class='colTwo'>$number</td></tr>";
	}
	$line_count++;
}

fclose($file_handle);

?>
