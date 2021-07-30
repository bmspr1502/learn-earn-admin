<?php

$con = new mysqli("remotemysql.com", "lO4zmJJqK1", "nXnAikIZGX", "lO4zmJJqK1");
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
  //echo "Connected successfully";