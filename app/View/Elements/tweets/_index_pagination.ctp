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
			
			
<!-- Numbers ---------------------------------->			
<?php echo $this->element('tweets/_index_pagination_PageNumbers'); ?>
			
<!-- "Next" ---------------------------------->			
			<?php 
			
				if ($current_Page == $last_Page) {
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
			
				if ($current_Page == $last_Page) {
			?>
			
			|
			
			Last
			
			<?php	
				
				} else {
			?>
			
			<?php
				
					$page_num = $last_Page;
					
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

