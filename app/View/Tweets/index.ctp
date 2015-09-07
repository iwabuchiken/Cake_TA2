<h1>
	Tweets  (<a href="#bottom">Bottom</a><a name="top"></a>)
</h1>

<?php echo __FILE__; ?>
<br>
<?php echo APP; ?>

<br>
<?php echo gethostname(); ?>

<br>
<?php echo $_SERVER['SERVER_NAME']; ?>

<br>
<br>

<?php 

	foreach($result as $row) {
		echo $row['text'];
		
		echo "<br>";
// 		echo "Id: " . $row['id'] . "\n";
	}

?>


<br>


(<a href="#top">Top</a><a name="bottom"></a>)

