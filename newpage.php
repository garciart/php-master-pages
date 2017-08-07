<?php
    /* Start placing content into an output buffer */
    ob_start();
?>
<!-- Head Content Start -->
	<title>New Page Title</title>
<!-- Head Content End -->
<?php
	/* Store the content of the buffer for later use */ 
	$contentPlaceHolder1 = ob_get_contents();
	/* Clean out the buffer, but do not destroy the output buffer */
	ob_clean();
?>
<!-- Body Content Start -->
	<!-- Header Element Content -->
		<h2>This is a New Page!</h2>
		<?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder2 = ob_get_contents();
			/* Clean out the buffer, but do not destroy the output buffer */
			ob_clean();
		?>
	<!-- Main Element Content -->
		<p>Congratulations! You have two pages that use the same Master Page!</p>
		<?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder3 = ob_get_contents();
			/* Clean out the buffer once again, but do not destroy the output buffer */
			ob_clean();
		?>
	<!-- Footer Element Content -->
		<p><a href="index.php" title="Link Back to Index Page...">Link Back to Index Page...</a></p>
<!-- Body Content End -->
<?php
    /* Store the content of the buffer for later use */
    $contentPlaceHolder4 = ob_get_contents();
    /* Clean out the buffer and turn off output buffering */
    ob_end_clean();
    /* Call the master page. It will echo the content of the placeholders in the designated locations */
    include("master.php");
?>
