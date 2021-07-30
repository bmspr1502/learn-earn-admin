<?php
session_start();
include 'dbconnect.php';

if (isset($_POST['admin_id'])) {

	$aid = $con->real_escape_string($_POST['admin_id']);
	$apassword = $con->real_escape_string($_POST['password']);
	$query = $con->prepare("SELECT * from admin_login WHERE Admin_id=? AND Password=?");
	$query->bind_param('ss', $aid, $apassword);
	$query->execute();

	$result = $query->get_result();
	if ($result->num_rows > 0) {
		$_SESSION['admin_id'] = $aid;
		$_SESSION['user'] = 'admin';
		echo "<script>window.location.href='admin.php'</script>";
	} else {
		echo "Incorrect Password / Username";
		echo '<script type="text/javascript"> alert(" Professor Er! ' . $con->error . '")</script>';
	}
}
