<?php
$errorMessages = [
    'emptyinput' => 'Please complete every field.',
    'email' => 'Please enter a valid email address.',
    'pwderror' => 'The passwords do not match.',
    'emailtaken' => 'An account already exists for this email.',
];
$errorMessage = $errorMessages[$_GET['error'] ?? ''] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account | Barber &amp; Co.</title>
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
                <p class="eyebrow">Join the shop</p>
                <h2 id="form-title">Create your account</h2>
                <p>Save your details and manage your reservations in one place.</p>
            </div>

            <?php if ($errorMessage !== null): ?>
                <p class="form-message error" role="alert"><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <form class="auth-form" method="post" action="../includes/regester.php">
                <div class="field">
                    <label for="name">Full name</label>
                    <input type="text" id="name" name="name" maxlength="30" autocomplete="name" placeholder="Your name" required>
                </div>
                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" autocomplete="email" placeholder="you@example.com" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="8" autocomplete="new-password" placeholder="At least 8 characters" required>
                </div>
                <div class="field">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" id="confirm_password" name="confirm_password" minlength="8" autocomplete="new-password" placeholder="Enter your password again" required>
                </div>
                <button class="submit-button" type="submit" name="submit">Create account</button>
            </form>

            <p class="form-switch">Already have an account? <a href="login.php">Log in</a></p>
        </section>
    </main>
</body>
</html>
