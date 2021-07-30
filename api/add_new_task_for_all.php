<?php

include 'dbconnect.php';
if (isset($_POST['Task_title'])) {

    $task = $_POST;

    $idsql = "SELECT Student_id FROM admin_student_mapping WHERE Admin_id = " . $task['mentor_id'];

    if ($students = $con->query($idsql)) {
        $ids = $students->fetch_all(MYSQLI_ASSOC);
        $qry = $con->prepare("INSERT INTO tasks 
                                (mentor_id, Student_id, Task_Title, Description, Task_PDF, Task_status, 
                                Due_Timestamp, Marks_possible, Comment )
                                
                            VALUES 
                                (?,?,?,?,?, 1, TIMESTAMP(?), ?,?)");


        if ($con->error)
            die($con->error);

        foreach ($ids as $id) {

            $qry->bind_param(
                "iissssis",
                $task['mentor_id'],
                $id['Student_id'],
                $task['Task_title'],
                $task['Description'],
                $task['Task_PDF'],
                $task['Due_Timestamp'],
                $task['Marks_possible'],
                $task['Comment']
            );


            if ($qry->execute()) {
                echo "Task Added";
            } else {
                die($con->error);
            }
        }
    } else {
        die($con->error);
    }
} else {
    echo "NOT VIEWABLE";
}
