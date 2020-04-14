<?php

class DefaultController extends AdminController {

    
    public function actionIndex() {
        
        $this->render('index');
    }

    public function actionAlterarSenha() {
        
        $admin = Yii::app()->admin->admin;
        $model = Admin::model()->findByPk($admin->idadmin);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Admin'])) {
            if (strlen($_POST['novaSenha']) >= 4 && $_POST['novaSenha'] == $_POST['confirmeSenha']) {
                $_POST['Admin']["senha"] = md5($_POST['novaSenha']);
                $model->attributes = $_POST['Admin'];
                if ($model->save())
                    $this->redirect(array('/admin'));
            }
        }

        $this->render('alterarSenha', array(
            'model' => $model,
        ));
    }

    public function actionLogin() {
        //$this->layout = 'clean';
        $model = new AdminLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'adminloginform') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                unset($model->senha);
                Yii::app()->session["loginAdmin"] = $model;
                $this->redirect(Yii::app()->admin->returnUrl);
            } else {
                $this->setPageState('erroLogin', true);
            }
        }
        
        $this->render('login', array('model' => $model));
    }

    public function actionSair() {
        Yii::app()->admin->logout();
        unset(Yii::app()->session["loginAdmin"]);
        $this->redirect(array('/admin/login'));
    }

}
