<?php

class PartidasController extends AdminController {

    public function actionVer($id) {
        $this->render('ver', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Partida('search');
        $model->unsetAttributes();
        if (isset($_GET['Partida']))
            $model->attributes = $_GET['Partida'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCriar() {
        $model = new Partida;

        if (isset($_POST['Partida'])) {
            $model->attributes = $_POST['Partida'];
            $mode->dataCriacao = date("Y-m-d H:i:s");
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('criar', array(
            'model' => $model,
        ));
    }

    public function actionEditar($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Partida'])) {
            $model->attributes = $_POST['Partida'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Partida::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'partida-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    

    public function actionListaGamesConsole() {
        
        $idconsole = $_POST['Partida']['idconsole'];
        echo $this->listaGamesConsole($idconsole);
        
    }

    public function actionListaTorneiosGame() {
        
        $idconsole = $_POST['Partida']['idconsole'];
        $idgame = $_POST['Partida']['idgame'];
        echo $this->listaTorneiosGame($idconsole, $idgame);
        
    }

}
