<?php
// Initialize arrays to store footer content and section titles
$footerContents = [];
$sectionTitles = [];

// Iterate through the range of footer columns
for ($i = 1; $i <= $numberFooterColumns; $i++) {
    // Generate the file path based on the current iteration
    $footerFile = "pages/footer/footer{$i}.html";

    // Check if the file exists
    if (file_exists($footerFile)) {
        // Read the contents of the file
        $footerContent = file_get_contents($footerFile);

        // Define the pattern to extract the section title from the content
        $pattern = '/<!-- sectiontitle:(.*?) -->/';

        // Attempt to match the pattern in the content
        if (preg_match($pattern, $footerContent, $matches)) {
            // If a match is found, extract and store the section title
            $sectionTitles[] = trim($matches[1]);
        }

        // Store the entire content in the array for later use
        $footerContents[] = $footerContent;
    } else {
        // If the file does not exist, you can handle it here (e.g., display an error message)
        // For now, let's assume an empty content and title
		$sectionTitles[] = "Section {$i}"; // Default title if not found
        $footerContents[] = "pages/footer/footer{$i}.html could not be found";
    }
}

// Output each footer column
echo '<div class="row">';
foreach ($footerContents as $index => $footerContent) {
    // Start a column container with appropriate width class
    echo '<div class="column flex-basis-300">';
    echo '<span class="sectiontitle">' . $sectionTitles[$index] . '</span>';
    echo $footerContent; // Output the footer content from the array
    echo '</div>';
}
echo '</div>';
// If you want to call a section title elsewhere:
// Use $sectionTitles[index] where index is the position of the title.
// For example, to access the second section title, you can use $sectionTitles[1].
?>
