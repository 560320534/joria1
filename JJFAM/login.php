<?php
declare(strict_types=1);
require_once 'config.php';
require_once 'functions.php';
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
if (verifyReCaptcha($recaptchaResponse)) {
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
if (login($username, $password)) {
('Location: index.php');
exit;
} else {
$error = "Invalid username or password";
}
}  else {
$error = "reCAPTCHA verification failed";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<h2>Login</h2>
<?php if ($error): ?>
<p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form method="post">
<div>
<label for="username">Username:</label>
<input type="text" id="username" name="username" required>
</div>
<div>
<label for="password">Password:</label>
<input type="password" id="password" name="password" required>
</div>
<div class="g-recaptcha" data-sitekey="6LcCXFUqAAAAAHw4KI3zlTfiHAEF1SdFOkuhuAkD"></div>
<div>
<button type="submit">Login</button>
</div>
</form>
</body>
</html>