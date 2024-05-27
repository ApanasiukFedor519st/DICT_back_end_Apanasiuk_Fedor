<?php

namespace Controllers;

class GuestbookController {
    public function execute() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $aConfig = require_once 'config.php';
        var_dump($aConfig);
        dump($aConfig);

        $infoMessage = '';

        if (!empty($_POST['name']) && !empty($_POST['email']) &&!empty($_POST['text'])) {

            $aComment = $_POST;

            $db = mysqli_connect($aConfig['host'], $aConfig['user'], $aConfig['pass'], $aConfig['name']);
            $query = "INSERT INTO comments(email, name, text, date) VALUES( '".$aComment ['email']."', '".$aComment ['name']."', '".$aComment ['text']."', '\"NOW()\"' )";
            mysqli_query($db, $query);
            mysqli_close($db);

        } elseif (!empty($_POST)) {
            $infoMessage = 'Заполните поля формы!';
        }
        $arguments = [
            'infoMessage' => $infoMessage
        ];
        $arguments = $arguments + $aConfig;
        $this->renderView($arguments);
    }


    public function renderView($arguments = []) {
        ?>
        <!DOCTYPE html>
        <html>

        <?php require_once 'ViewSections/sectionHead.php' ?>

        <body>

        <div class="container">


            <?php require_once 'ViewSections/sectionNavbar.php' ?>
            <br>


            <div class="card card-primary">
                <div class="card-header bg-primary text-light">
                    Guestbook form
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">

                            <form method="post" name="form" class="fw-bold">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputText">Text</label>
                                    <textarea name="text" class="form-control" id="exampleInputText" placeholder="Enter text" required></textarea>
                                </div><br>
                                <div class="form-group">
                                    <input type="submit" style="background-color: rgba(27,190,73,0.63); border-radius: 12%; border-color: darkgreen" value="Send">
                                </div>
                            </form>
                            <br>
                        </div>

                        <?php
                        if ($arguments['infoMessage']) {
                            echo "<span style='color:red'>{$arguments['infoMessage']}</span>";
                        }
                        ?>

                    </div>
                </div>
            </div>

            <br>

            <div class="card card-primary">
                <div class="card-header bg-body-secondary text-dark">
                    Сomments
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">

                            <?php

                            $db = mysqli_connect($arguments['host'], $arguments['user'], $arguments['pass'], $arguments['name']);
                            $query = 'SELECT * FROM comments';
                            $dbResponse = mysqli_query($db, $query);
                            $aComments = mysqli_fetch_all($dbResponse, MYSQLI_ASSOC);
                            mysqli_close($db);

                            foreach($aComments as $comment) {
                                echo "<p>"."<span style='color: darkgreen'>".$comment['name']."</span>"." залишив відгук:"."<br>".$comment['text']."</p>";
                                echo '<hr>';
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </body>
        </html>

        <?php
    }
}