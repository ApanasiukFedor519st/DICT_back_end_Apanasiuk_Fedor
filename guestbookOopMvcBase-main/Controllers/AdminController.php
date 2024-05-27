<?php

namespace guestbook\Controllers;

class AdminController {

    public function execute()
    {
        if (empty($_SESSION['auth'])) {
            header('Location: /');
            die;
        }

        $arguments = [];

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
                    <div class="card-header bg-warning text-light">
                        Admin
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>

            </body>
            </html>

        <?php
    }
}