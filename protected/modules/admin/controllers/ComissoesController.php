<?php

class ComissoesController extends AdminController {

    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Comissao('search');
        $model->unsetAttributes();
        if (isset($_GET['Comissao']))
            $model->attributes = $_GET['Comissao'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionEditar($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Comissao'])) {
            $model->attributes = $_POST['Comissao'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Comissao::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comissao-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
