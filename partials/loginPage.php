<?php

use registration\Login;

if ($method ?? null === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email) {
        $errors[] = 'Email is Required';
    }
    if (!$password) {
        $errors[] = 'Password is Required';
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div>$error</div>";
        }
    }

    if (isset($email) && isset($password)) {
        $login = new Login();
        $isLogin = $login->loginUser($email, $password);
        if ($isLogin) {
            $_SESSION['user'] = $login->getUser();
            header('Location: ./partials/homePage.php');
            exit();
        } else {
            $errors[] = 'Login failed';
        }
    }
}

?>


<?php echo require_once './loginPageHeader.php' ?>

<body>
    <div class="login-container">
        <?php $errors; ?>
        <h2>Login</h2>
        <form action="../index.php?login" method="POST">
            <?php if (!empty($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <div style="padding: 10px; border-radius:20px">
                        <p><?php echo $error ?></p>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-input">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-input">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <button type='button'>
            <a href="./registration.php">Not Registered yet? ➡️ Register</a>
        </button>
    </div>
</body>

</html>