<?php

include 'dbconnect.php';
if (isset($_POST['Task_title'])) {

    $task = $_POST;

    $qry = $con->prepare("INSERT INTO tasks 
                            (mentor_id, Student_id, Task_Title, Description, Task_PDF, Task_status, 
                            Due_Timestamp, Marks_possible, Comment )
                            
                        VALUES 
                            (?,?,?,?,?, 1, TIMESTAMP(?), ?,?)");

    $qry->bind_param(
        "iissssis",
        $task['mentor_id'],
        $task['Student_id'],
        $task['Task_title'],
        $task['Description'],
        $task['Task_pdf'],
        $task['Due_Timestamp'],
        $task['Marks_possible'],
        $task['Comment']
    );

    if ($con->error)
        echo $con->error;

    if ($qry->execute()) {
        echo "Task Added";
    } else {
        echo $con->error;
    }
} else {
    echo "NOT VIEWABLE";
}
