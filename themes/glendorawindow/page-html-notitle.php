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
						include $filename;
					?>
			</div>
		</div>
	</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->