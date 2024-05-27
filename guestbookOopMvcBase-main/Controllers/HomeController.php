<?php

namespace guestbook\Controllers;

class HomeController {

    public function execute() {

        $this->renderView();
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
                    Home page
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

