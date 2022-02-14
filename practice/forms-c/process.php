<?php
//var_dump($_GET);
session_start();

$answer = $_GET['answer'];
//var_dump($answer);
$correct = $answer == 'pumpkin';

$_SESSION['results'] = [
    'answer' => $answer,
    'correct' => $correct
];

#Redirect
header('Location: index.php');