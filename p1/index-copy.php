<?php
#
# Define a string variable to store the input
#
$inputString = 'Race car';
#
# 1. Check if the given string is 'Palindrome' or not
//checkPalindrome($inputString);
$isPalindrome = checkPalindrome($inputString);
#
# 2. Get the vowels count in the given string using the user defined function
#
$countVowels = vowelCount($inputString);
#echo $countVowels;
#
# 3. Shift the given string for each letter by 1
$shiftString = shiftLeft($inputString);
#echo $shiftString;
#
# 4. Get the words count in the given string using the user defined function
#
$countWords = wordCount($inputString);
#echo $countWords;
#
#Vowel count - user function to get the number of vowels in a given string
#
function vowelCount($string)
{
    preg_match_all('/[aeiou]/i', $string, $matches);
    return count($matches[0]);
}
#
# Check if the given string is Palindrome or not using user defined function
#
function checkPalindrome($string)
{
    //
    $str = preg_replace('/[\W]/', '', $string);
    echo($str);
    //
    //$revString = strrev($string);
    $revString = strrev($str);
    $isPalindrome = false;
    #
    //  if (strcasecmp($string, $revString) == 0) {
    if (strcasecmp($str, $revString) == 0) {
        #    echo $string." is a Palindrome string.\n";
        $isPalindrome = true;
    } else {
        #   echo $string." is not a Palindrome string.\n";
        $isPalindrome = false;
    }
    return $isPalindrome;
}
#
#
# Letter Shift the given string using user defined function
#
function shiftLeft($string)
{
    $shift = 1;
    $shiftedString = "";

    for ($i = 0; $i < strlen($string); $i++) {
        $ascii = ord($string[$i]);
        //   $shiftedChar = chr($ascii + $shift);
        //   $shiftedSring .= $shiftedChar;
//
        if (ctype_alpha($ascii)) {
            # echo "yeah\n";
            if ($string[$i] == 'z') {
                $shiftedChar = 'a';
            } else {
                $shiftedChar = chr($ascii + $shift);
            }
        } else {
            #echo "Nah\n";
            $shiftedChar = chr($ascii);
        }
        $shiftedString .= $shiftedChar;
        //
    }
#
    #echo $shiftedString;
#
    return $shiftedString;
}
#
#
#4 Word count - user function to get the number of words in a given string
#
function wordCount($string)
{
    //  echo str_word_count($string);
    return str_word_count($string);
}
#
#
require 'index-view1.php';