<?php

session_start();

$results = $_SESSION['results'];

//var_dump($results);

$answer = $results['answer'];
$correct = $results['correct'];

require 'done-view.php';