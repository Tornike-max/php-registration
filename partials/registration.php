<?php

use registration\Register;


if ($method ?? null === 'POST') {
    $register = new Register(
        $full_name,
        $email,
        $password,
        $repeatPassword
    );
    $register->registerUser();
}

?>

<?php echo require_once './registrationHeader.php' ?>

<body>
    <form action="../index.php" method="post">
        <h2>Registration Form</h2>
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="full_name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="password">Repeat Password</label>
        <input type="password" id="repeatPassword" name="repeatPassword" required>

        <input type="submit" value="Submit">
        <button type='button'>
            <a href="../partials/loginPage.php">Already Registered? ➡️ Login</a>
        </button>
    </form>
</body>

</html>