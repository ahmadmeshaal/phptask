<?php
$loginMessage = null;
$messageType = '';

if (($_GET['login'] ?? '') === 'success') {
    $loginMessage = 'You are signed in. Your account is ready.';
    $messageType = 'success';
} elseif (($_GET['error'] ?? '') === 'invalid') {
    $loginMessage = 'Email or password is incorrect, or the account is inactive.';
    $messageType = 'error';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | Barber &amp; Co.</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <main class="auth-card">
        <aside class="brand-panel">
            <div class="brand-mark">BARBER &amp; CO.</div>
            <div class="brand-copy">
                <p class="eyebrow">The classic chair</p>
                <h1>Good cuts.<br>Good company.</h1>
                <p>A considered cut, a clean finish, and a little time for yourself.</p>
            </div>
            <div class="brand-footer">Est. 2026 · Your neighborhood barbers</div>
        </aside>

        <section class="form-panel" aria-labelledby="form-title">
            <div class="form-heading">
                <p class="eyebrow">Welcome back</p>
                <h2 id="form-title">Log in to your account</h2>
                <p>Pick up where you left off and manage your reservations.</p>
            </div>

            <?php if ($loginMessage !== null): ?>
                <p class="form-message <?= htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8') ?>" role="status"><?= htmlspecialchars($loginMessage, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <form class="auth-form" action="../includes/login.php" method="post">
                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" autocomplete="current-password" placeholder="Your password" required>
                </div>
                <button class="submit-button" type="submit" name="submit">Log in</button>
            </form>

            <p class="form-switch">New to the shop? <a href="register.php">Create an account</a></p>
        </section>
    </main>
</body>
</html>
