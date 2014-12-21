<?php
// Set proper timezone for Amsterdam
INI_SET('date.timezone', 'Europe/Amsterdam');
// Include the DanceDepartmentArchive class
require_once ('DanceDepartmentArchive.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dance Department Archive for Winamp | Welcome</title>

<!-- Bootstrap -->
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"
	rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container">

		<div class="page-header">
			<h1 class="text-center">Dance Department Archive | Welcome</h1>
		</div>

				<div class="page-content">
			<div class="text-left"><br /><br />
				Welcome to this unofficial Dance Department archive page. Below
				you will find a list of links to the 2 most recent episodes of the
				Dance Department radio show that broadcasts live every Saturday night
				between 20:00 and 00:00 CET (GMT+1:00) on the Dutch station Radio 538. <br />The
				links are in a standard playlist format (.M3U), suitable for playing
				in various popular media players. <br /><br />The purpose of this page is
				to allow you to listen to the archived Dance Department episodes
				with your favourite media player, instead of having to use the
				official Radio 538 Flash Player that is available on the radio 538's
				website. <br /><br />
				<div class="alert alert-warning" role="alert">Note that the content
					linked on this page is provided by Radio 538 as is, and I am not
					hosting, distributing, selling or otherwise providing that content
					except in the way specified above.</div>
				<br />If you have any questions, comments or suggestions, don't
				hezitate to contact me by clicking <a
					href="http://www.zhivankin.com/contact/" target="_blank">here
					(opens in a new window or tab)</a>
			</div>
		</div>
		<br />
		<article>
		<h2 class="text-center">Recent Episodes</h2>
		<div class="row">
			<div class="col-sm-4">
				<ul class="list-group">
                    <?php
                    // Instantiate the DanceDepartmentArchive class and create a $danceDepartmentArchive object
                    $danceDepartmentArchive = new Zhivankin\DanceDepartmentArchive\DanceDepartmentArchive();
                    // Generate URLs for the playlists
                    $urls = $danceDepartmentArchive->generatePlaylistURLs();
                    // Go through the dates and generate playlist files for each date, using all URLs for that date
                    foreach ($urls as $date => $urls) {
                        // Generate a playlist file for the given date
                        $playlist = $danceDepartmentArchive->generatePlaylist($urls);
                        ?>
    <li class="list-group-item"><a
						href="DanceDepartmentDownload.php?name=<?php echo urlencode('dancedepartment'.date('Ymd', $date).'.m3u'); ?>&results=<?php echo urlencode($playlist); ?>">Dance Department <?php echo date('l, d M Y', $date); ?></a></li>
    <?php } ?>
    </ul>
			</div>
					</div>
					</article>
					
		<div class="page-footer">
		<aside>
			<h3 class="text-center">Related Links</h3>
			<div class="row">
				<div class="col-sm-4">
					<ul class="list-group">
						<li class="list-group-item"><a
							href="http://www.538.nl/programma/45/dance-department-1"
							target="_blank">Dance Department official website</a></li>
						<li class="list-group-item"><a href="http://www.radio538.nl/"
							target="_blank">Radio 538 website</a></li>
					</ul>
				</div>
			</div>
			</aside>
			<br/>
			<div class="text-right">Copyright &copy; <?php echo date('Y'); ?>, <a href="http://www.zhivankin.com/" target="_blank">Georgi Zhivankin</a>. All rights reserved.</div>
		</div>

	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script
		src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>