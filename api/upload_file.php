<?php
if (isset($_FILES)) {
    //print_r($_FILES);
    $file = $_FILES['file'];
    if (isset($file)) {
        $filename = $_FILES['file']['name'];
        $filetmp = $_FILES['file']['tmp_name'];
        $filesize = $_FILES['file']['size'];
        $fileerror = $_FILES['file']['error'];
        $filetype = $_FILES['file']['type'];

        $fileext = explode('.', $filename);
        $fileactualext = strtolower(end($fileext));


        if ($fileerror === 0) {
            $filenamenew = uniqid('', true) . "." . $fileactualext;
            $filedestination = '../uploads/task/' . $filenamenew;
            if (move_uploaded_file($filetmp, $filedestination)) {
                echo $filenamenew;
            } else {
                echo 'Not uploaded';
            }
        } else {
            echo $fileerror;
        }
    }
} else {
    echo "<script>";
    echo "alert('Access Denied');";
    echo "window.location.href = 'index.php';";
    echo "</script>";
}
