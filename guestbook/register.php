<?php

session_start();

if (!empty($_SESSION['auth'])) {
    header('Location: /admin.php');
    die;
}

$infoMessage = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $isAlreadyRegistered = false;
    $fileUsers = 'users.csv';

    if (file_exists($fileUsers)) {
        $sUsers = file_get_contents($fileUsers);
        $aJsonsUsers = explode("\n", $sUsers);

        foreach ($aJsonsUsers as $jsonUser) {
            $aUser = json_decode($jsonUser, true);
            if (!$aUser) break;

            foreach ($aUser as $email => $password) {
                if (($email == $_POST['email']) && ($password == $_POST['password'])) {
                    $isAlreadyRegistered = true;

                    $infoMessage = "Такой пользователь уже существует! Перейдите на страницу входа. ";
                    $infoMessage .= "<a href='/login.php'>Страница входа</a>";
                }
            }
        }
    }

    if (!$isAlreadyRegistered) {
        // 4. Create new user
        $aNewUser = [$_POST['email'] => $_POST['password']];
        file_put_contents("users.csv", json_encode($aNewUser) . "\n", FILE_APPEND);

        header('Location: /login.php');
        die;
    }

} elseif (!empty($_POST)) {
    $infoMessage = 'Заполните форму регистрации!';
}
?>


<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <?php require_once 'sectionNavbar.php' ?>

    <br>

    <div class="card card-primary">
        <div class="card-header bg-success text-light">
            Register form
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password"/>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="formRegister"/>
                </div>
            </form>

            <?php
                if ($infoMessage) {
                    echo '<hr/>';
                    echo "<span style='color:red'>$infoMessage</span>";
                }
            ?>

        </div>

    </div>
</div>

</body>
</html>