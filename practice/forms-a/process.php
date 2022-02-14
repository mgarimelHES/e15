<?php
//var_dump($_GET);
$answer = $_GET['answer'];
//var_dump($answer);
$correct = $answer == 'pumpkin';

require 'process-view.php';