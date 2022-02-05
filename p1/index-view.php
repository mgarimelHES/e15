<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Project P1 App for e15</title>
    <meta charset="utf-8">
    <link href=data: , rel=icon>
</head>

<body>
    <h1> Project P1 Application e-15 Spring2022</h1>
    <img src='images/hes-logo.png'>
    <p> the count is <?php print_r(vowelCount('sampleInput')); ?> </p>
    <ul>
        <li> Given Input String: <?php echo $inputString; ?></li>
        <li> Word Count: <?php echo $countWords; ?></li>
        <li> Vowel Count: <?php echo $countVowels; ?></li>
        <li> Is PolinDrom: <?php echo $isPalindrome; ?></li>
        <li> Is Palindrome: <?php if($isPalindrome) { ?>
            Yes
            <?php } else { ?>
            No
            <?php } ?>
        </li>
        <li> Shift Left the given string: <?php echo $shiftString; ?></li>
    </ul>
</body>

</html>