<?php
// Create tokens
$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);

$url = sprintf('%sreset.php?%s', ABS_URL, http_build_query([
    'selector' => $selector,
    'validator' => bin2hex($token)
]));

// Token expiration
$expires = new DateTime('NOW');
$expires->add(new DateInterval('PT01H')); // 1 hour

// Delete any existing tokens for this user
$this->db->delete('password_reset', 'email', $user->email);

// Insert reset token into database
$insert = $this->db->insert('password_reset', 
    array(
        'email'     =>  $user->email,
        'selector'  =>  $selector, 
        'token'     =>  hash('sha256', $token),
        'expires'   =>  $expires->format('U'),
    )
);
?>

<html>
<head>
	<title>Forgot password</title>
</head>
<body>
	<form action="" method="post">
    <input type="text" class="text" name="email" placeholder="Enter your email address" required>
    <input type="submit" class="submit" value="Submit">
</form>
</body>
</html>