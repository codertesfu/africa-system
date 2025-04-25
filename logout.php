<?php
session_start();

// Destroy session and redirect to login page
session_unset();
session_destroy();

header("Location: admin_login.php"); // Replace with your actual login page filename
exit();
