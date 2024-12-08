<?php
// Include your existing PHP code here (the code for fetching and displaying posts)

// For example:
global $user;
global $posts;

ob_start();

// Your existing PHP code for displaying posts goes here

$output = ob_get_clean();
echo $output;
?>
