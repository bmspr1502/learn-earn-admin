<?php

include 'dbconnect.php';

if (isset($_POST['Task_id'])) {
    $output = $_POST;
    $status = $_POST['status'];
    if ($status == 2 && $output['Marks'] != 0)
        $status = 3;

    $qry = $con->prepare("UPDATE tasks 
                            SET Task_title=?,
                            Description = ?,
                            Task_status=?,
                            Due_Timestamp=TIMESTAMP(?),
                            Marks = ?,
                            Marks_possible=?,
                            Comment=?
                            
                            WHERE 
                            Task_id = ?");
    $qry->bind_param(
        "ssisiisi",
        $output['Task_title'],
        $output['Description'],
        $status,
        $output['Due_Timestamp'],
        $output['Marks'],
        $output['Marks_possible'],
        $output['Comment'],
        $output['Task_id']
    );

    if ($qry->execute()) {
        echo "Updated";
    } else {
        echo $con->error;
    }
} else {
    echo "boo";
}
