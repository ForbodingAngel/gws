<?php
	// Set the content-type to XML
	header("Content-Type: application/rss+xml; charset=UTF-8");

	function extractValueFromPattern($filename, $pattern) {
		$markdownContent = file_get_contents("pages/posts/" . $filename . ".html");
		if (preg_match($pattern, $markdownContent, $matches)) {
			return trim($matches[1]);
		}
		return null;
	}

	// Function to get MIME type from file extension
	function getMimeType($filename) {
		$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		$mimeTypes = [
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'png' => 'image/png',
			'gif' => 'image/gif',
			'webp' => 'image/webp',
			// Add more extensions and MIME types as needed
		];
		return $mimeTypes[$extension] ?? 'application/octet-stream';
	}

	// Define patterns for the metadata you want to extract
	$patterns = [
		'pagetitle' => '/<!--\s+pagetitle:(.*?)\s+-->/s',
		'pagedate' => '/<!--\s+pagedate:(.*?)\s+-->/s',
		'pageexcerpt' => '/<!--\s+pageexcerpt:(.*?)\s+-->/s',
		'pageimage' => '/<!--\s+pageimage:(.*?)\s+-->/s' // Image pattern
	];

	// Site information
	$siteTitle = $WebsiteTitle;
	$siteLink = $WebsiteURL;
	$siteDescription = $WebsiteDescription;
	$defaultImage = $WebsiteImage; // Default image URL

	// Initialize the RSS feed
	echo '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
	echo '<rss version="2.0">' . "\n";
	echo '<channel>' . "\n";
	echo '<title>' . htmlspecialchars($siteTitle) . '</title>' . "\n";
	echo '<link>' . htmlspecialchars($siteLink) . '</link>' . "\n";
	echo '<description>' . htmlspecialchars($siteDescription) . '</description>' . "\n";
	echo '<language>en-us</language>' . "\n";

	// Channel-wide image
	echo '<image>' . "\n";
	echo '<url>' . htmlspecialchars($WebsiteImage) . '</url>' . "\n";
	echo '<title>' . htmlspecialchars($siteTitle) . '</title>' . "\n";
	echo '<link>' . htmlspecialchars($siteLink) . '</link>' . "\n";
	echo '</image>' . "\n";

	// Loop through each html file in the posts directory
	$postsDir = __DIR__ . '/pages/posts';
	foreach (new DirectoryIterator($postsDir) as $fileInfo) {
		if ($fileInfo->isDot() || $fileInfo->getExtension() !== 'html') continue;

		$filename = $fileInfo->getBasename('.html');
		$pageData = [];

		// Extract metadata using the patterns
		foreach ($patterns as $variableName => $pattern) {
			$pageData[$variableName] = extractValueFromPattern($filename, $pattern);
		}

		if (empty($pageData['pagetitle']) || empty($pageData['pagedate'])) continue;

		$url = $siteLink . '/posts/' . $filename;
		$pubDate = date(DATE_RSS, strtotime($pageData['pagedate']));
		$imageUrl = !empty($pageData['pageimage']) ? $siteLink . '/' . $pageData['pageimage'] : $defaultImage;
		$mimeType = getMimeType($imageUrl);

		// Add the item to the RSS feed
		echo '<item>' . "\n";
		echo '<title>' . htmlspecialchars($pageData['pagetitle']) . '</title>' . "\n";
		echo '<link>' . htmlspecialchars($url) . '</link>' . "\n";
		echo '<description>' . htmlspecialchars($pageData['pageexcerpt']) . '</description>' . "\n";
		echo '<enclosure url="' . htmlspecialchars($imageUrl) . '" type="' . htmlspecialchars($mimeType) . '" />' . "\n";
		echo '<pubDate>' . $pubDate . '</pubDate>' . "\n";
		echo '</item>' . "\n";
	}

	echo '</channel>' . "\n";
	echo '</rss>' . "\n";
?>
