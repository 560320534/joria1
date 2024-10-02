<?php
declare(strict_types=1);
require_once 'db.php';
function verifyReCaptcha(string $recaptchaResponse): bool {
$secret = getenv('RECAPTCHA_SECRET_KEY');
$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response   ='.$recaptchaResponse);
$responseData = json_decode($verifyResponse);
return $responseData->success;
}
function login(string $username, string $password): bool {
$pdo = getDbConnection();
$stmt = $pdo->prepare('SELECT id, password FROM users WHERE username =
:username');
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password'])) {
$_SESSION['user_id'] = $user['id'];
return true;
}
return false;
}
