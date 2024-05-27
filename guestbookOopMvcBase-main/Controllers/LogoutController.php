<?php

namespace guestbook\Controllers;

class LogoutController {

    public function execute() {
        // $_SESSION['auth'] = false;
        session_destroy();
        header('Location: /');
        die;
    }

    public function renderView($arguments = []) {

    }
}