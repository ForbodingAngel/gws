</head>
<body>

	<!-- Primary Page Layout
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="contentcontainer">
		<div class="content">
			<div class="section group">
					<?php
						//echo $pagename;
						//echo '<br>';
						$filename = "./pages/" . $pagename . ".html";
						//echo $filename;
						$output = file_get_contents($filename);
						// $parsedown = new Parsedown;
						// $parsedown->setSafeMode(true); // Enable this line if you want to sanitize HTML input (HTML will not be rendered)
						// a$parsedown->setMarkupEscaped(true); // escape HTML in trusted input
						
						//echo $parsedown->text($output);
						echo from_markdown($output);
					?>
			</div>
		</div>
	</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->