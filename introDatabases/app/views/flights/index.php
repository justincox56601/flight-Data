<?php
get_header();
?>
<form action="<?php echo URL_ROOT?>" method="post">
	<input type="hidden" name="data" id="data" value='checked'>
	<input type="submit" value="Get Data">
</form>
<pre>
	<?php print_r($data);?>
</pre>
<?php
get_footer();
?>

	
