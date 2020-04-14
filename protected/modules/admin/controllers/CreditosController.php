<?php

class CreditosController extends AdminController {

    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Jogcredito('search');
        $model->unsetAttributes();
        if (isset($_GET['Jogcredito']))
            $model->attributes = $_GET['Jogcredito'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCriar() {
        $model = new Jogcredito;

        if (isset($_POST['Jogcredito'])) {
            $model->attributes = $_POST['Jogcredito'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('criar', array(
            'model' => $model,
        ));
    }

    public function actionEditar($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Jogcredito'])) {
            $model->attributes = $_POST['Jogcredito'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Jogcredito::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'jogcredito-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
