<?php

class MovimentacoesController extends AdminController {

    public function actionDeletar($id) {
        //$this->loadModel($id)->delete();
        //if (!isset($_GET['ajax']))
        $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Jogmovimentacao('search');
        $model->unsetAttributes();
        if (isset($_GET['Jogmovimentacao']))
            $model->attributes = $_GET['Jogmovimentacao'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionEditar($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Jogmovimentacao'])) {
            $model->attributes = $_POST['Jogmovimentacao'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Jogmovimentacao::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'jogmovimentacao-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
