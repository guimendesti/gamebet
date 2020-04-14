<?php

class DefaultController extends JogadorController {

    public function actionIndex() {

        $this->breadcrumbs = array("Minha Conta");
        
        $this->render('index', array('model' => $this->jogadorLogado));
    }

    public function actionAlterarSenha() {

        $jogador = Yii::app()->jogador->jogador;
        $model = Jogador::model()->findByPk($jogador->ID);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Jogador'])) {
            if (strlen($_POST['novaSenha']) >= 4 && $_POST['novaSenha'] == $_POST['confirmeSenha']) {
                $_POST['Jogador']["senha"] = md5($_POST['novaSenha']);
                $model->attributes = $_POST['Jogador'];
                if ($model->save())
                    $this->redirect(array('/jogador'));
            }
        }

        $this->render('alterarSenha', array(
            'model' => $model,
        ));
    }

    public function actionLogin() {

        $this->layout = "//layouts/login";

        $loginModel = new JogadorLoginForm;

        if (isset($_POST['JogadorLoginForm'])) {
            $loginModel->attributes = $_POST['JogadorLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($loginModel->validate() && $loginModel->login()) {
                unset($loginModel->senha);
                Yii::app()->session["loginJogador"] = $loginModel;

                $this->redirect(Yii::app()->baseUrl.'/jogar');
            } else {
                $this->setPageState('erroLogin', true);
            }
        }

        $this->render('login', array('loginModel' => $loginModel,
                                       'cadModel' => Jogador::model())
        );
    }

    public function actionSair() {
        unset(Yii::app()->session["loginJogador"]);
        $this->redirect(array('/jogador/login'));
    }

}
