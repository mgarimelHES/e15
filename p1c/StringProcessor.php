<?php

class StringProcessor
{

# Properties
    public $inputString;

    #Methods
#
    #   Constructor Method
    public function __construct($inputString)
    {
        $this->inputString = $inputString;
    }
#
    #Vowel count - user function to get the number of vowels in a given string
#
    public function vowelCount()
    {
        preg_match_all('/[aeiou]/i', $this->inputString, $matches);
        return count($matches[0]);
    }
#
    # Check if the given string is Palindrome or not using user defined function
#
    public function checkPalindrome($string)
    {
        //
        $str = preg_replace('/[\W]/', '', $string);
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
    public function shiftLeft($string)
    {
        $shift = 1;
        $shiftedString = "";

        for ($i = 0; $i < strlen($string); $i++) {
            $ascii = ord($string[$i]);
            //   $shiftedChar = chr($ascii + $shift);
            //   $shiftedSring .= $shiftedChar;

            if (ctype_alpha($ascii)) {
                #echo "yeah\n";
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
    public function wordCount($string)
    {
        //  echo str_word_count($string);
        return str_word_count($string);
    }
#
}