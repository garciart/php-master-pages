<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!-- Content placeholder for head content -->
        <?php echo $contentPlaceHolder1; ?>
    </head>
    <body>
		<header>
			<h1>Master Page Test Site</h1>
			<!-- Content placeholder for header element content -->
			<?php echo $contentPlaceHolder2; ?>
			<hr>
		</header>
        <main>
			<h2>Content from the Child Page:</h2>
			<!-- Content placeholder for main element content -->
			<?php echo $contentPlaceHolder3; ?>
			<hr>
		</main>
        <footer>
            <!-- Content placeholder for footer element content -->
			Copyright ©
			<?php printf(" %s ", (date("Y") == 2016 ? "2016" : "2016-" . date("Y"))); ?>
			My Master Page - All Rights Reserved
            <?php echo $contentPlaceHolder4; ?>
		</footer>
    </body>
</html>