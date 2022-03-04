<?php

# Leveragae Session to store the needed values for the application
session_start();
#
# Check if the 'result' array contains any values or not.
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];

    $inputString = $results['inputString'];
    $isPalindrome = $results['isPalindrome'];
    $countVowels = $results['countVowels'];
    $shiftedString = $results['shiftedString'];
    $countWords = $results['countWords'];

    $_SESSION['results'] = null;
}
require 'index-view.php';