<h1>
	Tweets  (<a href="#bottom">Bottom</a><a name="top"></a>)
	|
	(<?php echo sprintf("current = %d / total = %d", $current_Page, $last_Page)?>)
</h1>

<?php //echo __FILE__; ?>
<!-- <br> -->
<?php //echo APP; ?>

<!-- <br> -->
<?php //echo gethostname(); ?>

<!-- <br> -->
<?php //echo $_SERVER['SERVER_NAME']; ?>

<!-- <br> -->

<?php echo $this->element('tweets/_index_pagination'); ?>

<br>

<table>

	<?php echo $this->element('tweets/index/index_t_headers'); ?>

	<?php echo $this->element('tweets/index/index_t_entries'); ?>
		
</table>


<br>

<?php echo $this->element('tweets/_index_pagination'); ?>

<?php 

// 	foreach($result as $row) {
// 		echo $row['text'];
		
// 		echo "<br>";
// // 		echo "Id: " . $row['id'] . "\n";
// 	}

?>


<br>


(<a href="#top">Top</a><a name="bottom"></a>)

