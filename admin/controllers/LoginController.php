<?php

namespace admin\controllers;

class LoginController extends BaseController {
    public function actionIndex() {
        $this->layout = 'login';
        return $this->render('index');
    }
}