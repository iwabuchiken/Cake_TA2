<div class="pagination">

<!-- "First" ---------------------------------->
			<?php 
			
				if ($current_Page == 1) {
			?>
			
	First
	
			<?php	
				
				} else {
			?>
			
	<a href="<?php echo $uri."?page=1"; ?>">
	
		First
	
	</a>
			<?php
				
					$page_num = $current_Page - 1;
					
					echo "<a href=\"";
					echo $uri."?page=$page_num";
					echo "\">"; 
			?>
			
			<?php
				}//if ($current_Page == 1)
				
			?>

	<!-- <a href="<?php //echo $uri."?page=1"; ?>"> -->
	<!-- <a href="<?php //echo $_SERVER['HTTP_REFERER']."/index?page=1"; ?>"> -->
		
<!-- 		First -->
	
<!-- 	</a> -->

<!-- "Prev" ---------------------------------->	
			<?php 
			
				if ($current_Page == 1) {
			?>
			
			|
			
			Prev
			
			<?php	
				
				} else {
			?>
	|
			
			<?php
				
					$page_num = $current_Page - 1;
					
					echo "<a href=\"";
					echo $uri."?page=$page_num";
					echo "\">"; 
			?>
			
		Prev
	
	</a>
			<?php
				}//if ($current_Page == 1)
				
			?>
			
			
<!-- "Next" ---------------------------------->			
			<?php 
			
				if ($current_Page == $last_page) {
			?>
	|
	Next
			<?php	
				
				} else {
			?>
	|
			
			<?php
				
					$page_num = $current_Page + 1;
					
					echo "<a href=\"";
					echo $uri."?page=$page_num";
					echo "\">"; 
			?>
			
		Next
	
	</a>
	
			<?php
				}//if ($current_Page == 1)
				
			?>
			
<!-- "Last" ---------------------------------->	
			<?php 
			
				if ($current_Page == $last_page) {
			?>
			
			|
			
			Last
			
			<?php	
				
				} else {
			?>
			
			<?php
				
					$page_num = $last_page;
					
					echo "<a href=\"";
					echo $uri."?page=$page_num";
					echo "\">"; 
			?>
	|
			
		Last
	
	</a>
			<?php
				}//if ($current_Page == 1)
				
			?>
			
</div>

