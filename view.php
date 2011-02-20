<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Data from file</title>
    <link href="_assets/css/Style.css" rel="stylesheet" type="text/css" />
    <script src="_assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="_assets/js/ZeroClipboard.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function() {
            $("#fileTable tbody tr:odd").addClass("altrow");
            $("#fileTable tbody tr:even").addClass("row");

	    $("#fileTable thead th").each(function() {
		//We store the column value +1 because nth-child() count starts at 1
		var column = $(this).parent().children().index($(this))+1; 
		var columnLabel = $(this).text()
		//Create a new clipboard client
		var clip = new ZeroClipboard.Client();
		
		var firstCol = $(this);
		//Glue the clipboard client to the first th 
		clip.glue(firstCol[0]);
			
		var txt = "";
		$("#fileTable tbody tr > td:nth-child("+column+")").each(function (){
			txt+=$(this).text()+"\r\n";
		});
		clip.setText(txt);

		//Add a complete event to let the user know the text was copied
		clip.addEventListener('complete', function(client, text) {
			alert("Copied Column Data from Column: "+columnLabel+" to Clipboard\n");
		});
	});
	    $('td').click(function(){
		var col = $(this).parent().children().index($(this));
		var row = $(this).parent().parent().children().index($(this).parent());
		alert('Row: ' + row + ', Column: ' + col);
	    });
	    $('.buttonShow').click(function(){
		    $(".validation").show();
 	    });
	    $('.buttonHide').click(function(){
		$(".validation").hide();
	    });
        });                               
    </script>

</head>
<body>
<form>
<ul>
	<li>Click the icon on the column of data that you want to copy it to the clipboard</li>
	<li>Paste the contents of the clipboard to spreadsheet</li>
	<li><input type="button" value="Show Validation Data" class="buttonShow"/></li>
	<li><input type="button" value="Hide Validation Data" class="buttonHide"/></li>
</ul>
<div class="demo">
<table id="fileTable" class="yui-grid">
<thead>
	<tr>
		<th>sample label<img src="_assets/img/page_white_copy.png" alt="copy to clipboard" title="Copy to Clipboard" /></th>
		<th class="validation" style="display:none">SA</th>
		<th class="validation" style="display:none">ST</th>
		<th class="validation" style="display:none">SA 2[V]</th>
		<th class="validation" style="display:none">ST 2[V]</th>
		<th class="validation" style="display:none">SA 3[V]</th>
		<th class="validation" style="display:none">ST 3[V]</th>
		<th>last column <img src="_assets/img/page_white_copy.png" alt="copy to clipboard" title="Copy to Clipboard" /></th>
	</tr>

</thead>
<tbody>

<?php
include ("data.php");
?>

</tbody>
</table>
</div>
    </form>
</body>
</html>



