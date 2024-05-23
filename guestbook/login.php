<?php

session_start();

if (!empty($_SESSION['auth'])) {
    header('Location: /admin.php');
    die;
}

$infoMessage = '';


if (!empty($_POST['email']) && !empty($_POST['password'])) {


    $sUsers = file_get_contents("users.csv");
    $aJsonsUsers = explode("\n", $sUsers);

    $isAlreadyRegistered = false;

    foreach ($aJsonsUsers as $jsonUser) {
        $aUser = json_decode($jsonUser, true);
        if (!$aUser) break;

        foreach ($aUser as $email => $password) {
            if (($email == $_POST['email']) && ($password == $_POST['password'])) {
                $isAlreadyRegistered = true;

                $_SESSION['auth'] = true;
                // $_SESSION['email'] = $_POST['email'];

                header("Location: admin.php");
                die;
            }
        }
    }

    if (!$isAlreadyRegistered) {
        $infoMessage = "Такого пользователя не существует. Перейдите на страницу регистрации. ";
        $infoMessage .= "<a href='register.php'>Страница регистрации</a>";
    }

} elseif (!empty($_POST)) {
    $infoMessage = 'Заполните форму авторизации!';
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
            <div class="card-header bg-primary text-light">
                Login form
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
                        <input type="submit" class="btn btn-primary" name="form"/>
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

