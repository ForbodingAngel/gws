</head>
<body>

	<!-- Primary Page Layout
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="contentcontainer">
		<div class="pagetitle">
		<?php if ($pagename != "home" || $showhomepagetitle == true) { ?>
			<?php if (isset($pagetitle)) { ?>
				<h1><?php echo $pagetitle; ?></h1>
					<?php if ($pagetype == "article") { ?>
					
						<?php echo "<p class=\"pagedate\">" . formatDate($pagedate, 'pretty') . "</p>"; ?>
						<?php echo "<p class=\"pageauthor\">" . $pageauthor . "</p>"; ?>
					<?php } ?>
			<?php } else { ?>	
					<h1><?php echo ucwords($pagename); ?></h1>
			<?php } ?>
		<?php } ?>
		</div>
		<div class="content">
			<div class="section group">
					<?php
						$filename = "./pages/" . $pagename . ".html";
						include $filename;
					?>
			</div>
		</div>
	</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->