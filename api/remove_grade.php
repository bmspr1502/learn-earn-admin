<?php

include 'dbconnect.php';

if (isset($_POST['task_id'])) {
    $id = $con->real_escape_string($_POST['task_id']);
    $qry = "UPDATE tasks
            SET Task_Status = 2,
            Marks=0
            WHERE Task_id = $id;";

    if ($con->query($qry)) {
        echo "Removed";
    } else {
        echo $con->error;
    }
} else {
    echo "NOT VIEWABLE";
}
