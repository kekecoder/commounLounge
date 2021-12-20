<?php

class Student
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertStudent($name, $marks)
    {
        $stmt = $this->pdo->prepare("INSERT INTO student(name, marks) VALUES(:name, :marks)");

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":marks", $marks, PDO::PARAM_INT);

        $stmt->execute();

        echo "This statement has been executed! \n";
    }

    public function displayAll()
    {
        $stmt = $this->pdo->prepare("SELECT name, marks FROM student");
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($students as $student) {
            echo "<h3>" . $student->name . " " . $student->marks . "</h3>" . "\n";
        }
    }
}
