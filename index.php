<?php
    /* Start placing content into an output buffer */
    ob_start();
?>
<!-- Head Content Start -->
	<title>Index Page Title</title>
<!-- Head Content End -->
<?php
	/* Store the content of the buffer for later use */ 
	$contentPlaceHolder1 = ob_get_contents();
	/* Clean out the buffer, but do not destroy the output buffer */
	ob_clean();
?>
<!-- Body Content Start -->
	<!-- Header Element Content -->
		<h3>Just another Index Page</h3>
		<?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder2 = ob_get_contents();
			/* Clean out the buffer, but do not destroy the output buffer */
			ob_clean();
		?>
	<!-- Main Element Content -->
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed nonummy nibh euismod tincidunt ut laoreet dolore magna aliat volutpat. Ut wisi enim ad minim veniam, quis nostrud exercita ullamcorper suscipit lobortis nisl ut aliquip ex consequat.</p>
		<!-- Notice we can include code in the buffer as well -->
		<?php
		for ($x = 10; $x >= 1; $x--) {
			echo "T-$x and counting...<br>";
		}
		echo "Lift-off!<br>"
		?>
		<?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder3 = ob_get_contents();
			/* Clean out the buffer once again, but do not destroy the output buffer */
			ob_clean();
		?>
	<!-- Footer Element Content -->
		<!-- Here's an inactive link. We'll add the page later -->
		<p><a href="newpage.php" title="Link to Another Page...">Link to Another Page...</a></p>
<!-- Body Content End -->
<?php
    /* Store the content of the buffer for later use */
    $contentPlaceHolder4 = ob_get_contents();
    /* Clean out the buffer and turn off output buffering */
    ob_end_clean();
    /* Call the master page. It will echo the content of the placeholders in the designated locations */
    include("master.php");
?>
