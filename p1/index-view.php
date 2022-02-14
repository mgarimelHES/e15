<!doctype html>
<html lang='en'>

<head>
    <title>Project1 - e15 Spring 2022</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method='GET' action='process.php'>
        <div id='landing'>
            <h1>String Processor - e15 Project 1</h1>
            <fieldset>
                <legend>INPUT:</legend>
                <p>Enter A String</p>
                <p>Hint: Your Choice!</p>

                <label for='input'>Your Input:</label>
                <input type='text' name='input' id='input' required value='<?php echo $inputString ?? "" ?>'>

                <button type='submit'>Process</button>
            </fieldset>
        </div>
    </form>

    <?php if (isset($inputString)) { ?>
    <div id='results'>
        <h2>Results</h2>
        <p>
            You Entered: <?php echo $inputString; ?>
        </p>

        <?php if ($isPalindrome) { ?>
        <a class='yesPalindrome'>Yes, the given input is Palindrome! <a href='index.php'>Do you want to play
                again...</a>
            <?php } else { ?>
            <a class='noPalindrome'>Sorry, it is not a Palindrome. <a href='index.php'>Please try again...</a>
                <?php } ?>
                <?php } ?>
                <?php if (isset($inputString)) { ?>
                <ul>
                    <fieldset>
                        <legend>OUTPUT</legend>

                        <p class='input'> Given Input String: </br>
                            <br><?php echo $inputString; ?>
                        </p>
                        <br>
                        <p class='palindrome'> Is Palindrome: </br>
                            <?php if ($isPalindrome) { ?>
                            Yes
                            <?php } else { ?>
                            No
                            <?php } ?></p>

                        <br>
                        <p class='vowel'>Vowel Count: </br>
                            <?php echo $countVowels; ?></p>
                        <br>
                        <p class='word'> Word Count: </br>
                            <?php echo $countWords; ?></p>
                        <br>
                        <p class='shift'>Letter Shift using the given string:</br>
                            <?php echo $shiftedString; ?></p>
                    </fieldset>
                </ul>
    </div>
    <?php } ?>
</body>

</html>