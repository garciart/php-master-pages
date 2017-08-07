<h1>Master Pages in PHP</h1>
<h2>Replicating ASP.NET's Master Pages in PHP</h2>
<h3>Introduction:</h3>
One of the things I like about ASP.NET are <a title="ASP.NET Master Pages" href="https://msdn.microsoft.com/en-us/library/wtxbf3hh.aspx" target="_blank" rel="noopener noreferrer">Master Pages</a>. If you aren't familiar with the concept, it's simple; think of Master Pages as templates. Instead of having to include duplicate code in each page you write, such as meta tags, footers, etc., you can create a single Master Page that holds all that information. When you write your page, you only code the "meat" of your page, such as the privacy policy text or article. You then call on the Master Page, which takes the "meat" and places it in an appropriate content placeholder in the Master Page, but displays it as the calling page, i.e., default.aspx. The advantages are obvious:
<ul>
 	<li>All pages have a consistent layout</li>
 	<li>Changes to the Master Page apply to all pages that call it; no need to edit a dozen pages</li>
 	<li>Page code is much smaller and focused</li>
 	<li>Master Pages can be dynamic, e.g., you can change the page title in the code-behind, etc.</li>
</ul>
Unfortunately, PHP does not have a Master Page class. But don't fret; creating Master Pages in PHP is not difficult. The secret lies in working with PHP's <a title="PHP: Output Control - Manual" href="http://php.net/manual/en/book.outcontrol.php" target="_blank" rel="noopener noreferrer">Output Buffering Controls</a>. By using these controls, you can output what you wish to render to a buffer, assign it to a variable, and call it from an included or required page. Let's get started.
<h3>Step 1 - Create a Master Page:</h3>
Add a folder named "master-pages-in-php" in your xampp\htdocs directory and then create a file called "master.php". Input the following code into that file:
<pre>&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8" /&gt;
        &lt;!-- Content placeholder for head content --&gt;
        &lt;?php echo $contentPlaceHolder1; ?&gt;
    &lt;/head&gt;
    &lt;body&gt;
		&lt;header&gt;
			&lt;h1&gt;Master Page Test Site&lt;/h1&gt;
			&lt;!-- Content placeholder for header element content --&gt;
			&lt;?php echo $contentPlaceHolder2; ?&gt;
			&lt;hr&gt;
		&lt;/header&gt;
        &lt;main&gt;
			&lt;h2&gt;Content from the Child Page:&lt;/h2&gt;
			&lt;!-- Content placeholder for main element content --&gt;
			&lt;?php echo $contentPlaceHolder3; ?&gt;
			&lt;hr&gt;
		&lt;/main&gt;
        &lt;footer&gt;
            &lt;!-- Content placeholder for footer element content --&gt;
			Copyright ©
			&lt;?php printf(" %s ", (date("Y") == 2016 ? "2016" : "2016-" . date("Y"))); ?&gt;
			My Master Page - All Rights Reserved
            &lt;?php echo $contentPlaceHolder4; ?&gt;
		&lt;/footer&gt;
    &lt;/body&gt;
&lt;/html&gt;
</pre>
<h3>Step 2 - Create a Child Page:</h3>
Now create a file called "index.php" and input the following code into that file:
<pre>&lt;?php
    /* Start placing content into an output buffer */
    ob_start();
?&gt;
&lt;!-- Head Content Start --&gt;
	&lt;title&gt;Index Page Title&lt;/title&gt;
&lt;!-- Head Content End --&gt;
&lt;?php
	/* Store the content of the buffer for later use */ 
	$contentPlaceHolder1 = ob_get_contents();
	/* Clean out the buffer, but do not destroy the output buffer */
	ob_clean();
?&gt;
&lt;!-- Body Content Start --&gt;
	&lt;!-- Header Element Content --&gt;
		&lt;h3&gt;Just another Index Page&lt;/h3&gt;
		&lt;?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder2 = ob_get_contents();
			/* Clean out the buffer, but do not destroy the output buffer */
			ob_clean();
		?&gt;
	&lt;!-- Main Element Content --&gt;
		&lt;p&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed nonummy nibh euismod tincidunt ut laoreet dolore magna aliat volutpat. Ut wisi enim ad minim veniam, quis nostrud exercita ullamcorper suscipit lobortis nisl ut aliquip ex consequat.&lt;/p&gt;
		&lt;!-- Notice we can include code in the buffer as well --&gt;
		&lt;?php
		for ($x = 10; $x &gt;= 1; $x--) {
			echo "T-$x and counting...&lt;br&gt;";
		}
		echo "Lift-off!&lt;br&gt;"
		?&gt;
		&lt;?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder3 = ob_get_contents();
			/* Clean out the buffer once again, but do not destroy the output buffer */
			ob_clean();
		?&gt;
	&lt;!-- Footer Element Content --&gt;
		&lt;!-- Here's an inactive link. We'll add the page later --&gt;
		&lt;p&gt;&lt;a href="newpage.php" title="Link to Another Page..."&gt;Link to Another Page...&lt;/a&gt;&lt;/p&gt;
&lt;!-- Body Content End --&gt;
&lt;?php
    /* Store the content of the buffer for later use */
    $contentPlaceHolder4 = ob_get_contents();
    /* Clean out the buffer and turn off output buffering */
    ob_end_clean();
    /* Call the master page. It will echo the content of the placeholders in the designated locations */
    include("master.php");
?&gt;
</pre>
Did you notice we can store meta data, HTML code and PHP functions in the output buffer? Now, start Apache and visit your site in a browser (e.g., <a title="http://localhost:8080/master-pages-in-php/index.php" href="http://localhost:8080/master-pages-in-php/index.php" target="_blank" rel="noopener noreferrer">http://localhost:8080/master-pages-in-php/index.php</a>):

<img src="http://rgprogramming.com/wp-content/uploads/master-pages-in-php-img-01.png" alt="master-pages-in-php-img-01.png" />

Tada! Nothing fancy, but everything is in the right spot. By the way, do not click on "Link to Another Page"; you'll just end up with a 404 error right now. While you are here, look at HTML source code of the page; it appears seamless:

<img src="http://rgprogramming.com/wp-content/uploads/master-pages-in-php-img-02.png" alt="master-pages-in-php-img-02.png" />
<h3>Step 3 - Create Another Child Page:</h3>
Now, let's add the new page. Call it "newpage.php" and add the following code:
<pre>&lt;?php
    /* Start placing content into an output buffer */
    ob_start();
?&gt;
&lt;!-- Head Content Start --&gt;
	&lt;title&gt;New Page Title&lt;/title&gt;
&lt;!-- Head Content End --&gt;
&lt;?php
	/* Store the content of the buffer for later use */ 
	$contentPlaceHolder1 = ob_get_contents();
	/* Clean out the buffer, but do not destroy the output buffer */
	ob_clean();
?&gt;
&lt;!-- Body Content Start --&gt;
	&lt;!-- Header Element Content --&gt;
		&lt;h2&gt;This is a New Page!&lt;/h2&gt;
		&lt;?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder2 = ob_get_contents();
			/* Clean out the buffer, but do not destroy the output buffer */
			ob_clean();
		?&gt;
	&lt;!-- Main Element Content --&gt;
		&lt;p&gt;Congratulations! You have two pages that use the same Master Page!&lt;/p&gt;
		&lt;?php
			/* Store the content of the buffer for later use */ 
			$contentPlaceHolder3 = ob_get_contents();
			/* Clean out the buffer once again, but do not destroy the output buffer */
			ob_clean();
		?&gt;
	&lt;!-- Footer Element Content --&gt;
		&lt;p&gt;&lt;a href="index.php" title="Link Back to Index Page..."&gt;Link Back to Index Page...&lt;/a&gt;&lt;/p&gt;
&lt;!-- Body Content End --&gt;
&lt;?php
    /* Store the content of the buffer for later use */
    $contentPlaceHolder4 = ob_get_contents();
    /* Clean out the buffer and turn off output buffering */
    ob_end_clean();
    /* Call the master page. It will echo the content of the placeholders in the designated locations */
    include("master.php");
?&gt;
</pre>
Run the site again and click on "Link to Another Page":

<img src="http://rgprogramming.com/wp-content/uploads/master-pages-in-php-img-03.png" alt="master-pages-in-php-img-03.png" />
<h3>Conclusion:</h3>
There you go. Using a Master Page allows you to make changes that affect all pages, without having to update each page separately. This makes a site more secure since you reduce the chances of "orphan" pages with outdated code. Right now, our Master Page is pretty bare bones, but you can add styling and more. So go ahead, gussy up your site, and have fun!
