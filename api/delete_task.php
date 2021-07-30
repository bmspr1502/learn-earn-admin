<?php

include 'dbconnect.php';

if (isset($_POST['task_id'])) {

    $qry = $con->prepare("DELETE FROM tasks
            WHERE task_id = ?");
    $qry->bind_param("i", $_POST['task_id']);

    if ($qry->execute()) {
        echo "Task Deleted";
    } else {
        echo $con->error;
    }
} else {
    echo "NOT VIEWABLE";
}
