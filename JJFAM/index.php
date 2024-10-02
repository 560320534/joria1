<?php
declare(strict_types=1);
session_start();
if (!isset($_SESSION['user_id'])) {
header('Location: login.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
</head>
<body>
<h1>Welcome, you are logged in!</h1>
<p>This is a protected page.</p>
<a href="logout.php">Logout</a>
</body>
</html>
