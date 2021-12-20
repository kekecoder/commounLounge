<?php

include "con.php";
include "student.php";

global $pdo;

$student = new Student($pdo);
// $student->insertStudent("Israel", 70);

$student->displayAll();
