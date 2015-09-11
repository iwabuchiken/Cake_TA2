|

<?php 

	$disp_Pages = 20;	// number of page numbers to display
// 	$disp_Pages = 10;	// number of page numbers to display
	
	$disp_Half = floor($disp_Pages / 2);	// half value
	
	$odd = ($disp_Pages % 2) == 1 ? true : false;	// odd number?

// 	debug(sprintf("disp_Half = %s / \$disp_Pages % 2 = ", $disp_Half, ($disp_Pages % 2)));
	
	/*******************************
		determine: left-side numbers
	*******************************/
	if ($odd === true) {
// 	if ($odd = true) {
	
		debug("odd");
	
	} else {
	
		$num_Start = ($current_Page - ($disp_Half - 1)) < 1 ? 1 : ($current_Page - ($disp_Half - 1));

// 		debug("\$num_Start => ".$num_Start);
		
	}//if ($odd = true)
	
	/*******************************
		determine: right-side numbers
	*******************************/
	if ($odd === true) {
		// 	if ($odd = true) {
	
		debug("right-side: odd");
	
	} else {
	
		$num_End = ($current_Page + $disp_Half) > $last_Page 
							? $last_Page : ($current_Page + $disp_Half);
	
// 		debug("\$num_End => ".$num_End);
	
	}//if ($odd = true)
	
	/*******************************
	 determine: right-side numbers: adjust
	*******************************/
// 	debug(sprintf("\$current_Page <= (\$disp_Pages / 2) => %s", $current_Page <= ($disp_Pages / 2)));
	if ($current_Page <= ($disp_Pages / 2)) {
		
// 		$num_End = $current_Page + ($disp_Pages / 2);
// 		$num_End = $current_Page + $disp_Pages;
		$num_End = $disp_Pages;
		
		
// 		debug("\$num_End => ".$num_End);
		
	}//$current_Page <= ($last_Page)
	
	
?>

<?php 

	for ($i = $num_Start; $i <= $num_End; $i++) {
// 	for ($i = $num_Start; $i < $num_End; $i++) {
		
?>		

	|
	<?php 
		
		if ($i == $current_Page) {
		
			echo $i;
		
		} else {
		
			echo "<a href=\"";
			echo $uri."?page=$i";
	// 		echo $uri."?page=$page_num";
			echo "\">";
			echo $i;
			
			echo "</a>";
			
		}//if ($i == $current_Page)
		
		
	
	?>

<?php 

	}//for ($i = $num_Start; $i < $num_End; $i++)
	
?>

<!-- Numbers -->
