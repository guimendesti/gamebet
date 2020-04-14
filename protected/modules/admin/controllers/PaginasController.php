<?php

class PaginasController extends AdminController {
/*
    public function actionVer($id) {
        $this->render('ver', array(
            'model' => $this->loadModel($id),
        ));
    }
*/
    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Pagina('search');
        $model->unsetAttributes();
        if (isset($_GET['Pagina']))
            $model->attributes = $_GET['Pagina'];

        $this->render('index', array(
            'model' => $model,
        ));
    }
/*
    public function actionCriar() {
        $model = new Pagina;

        if (isset($_POST['Pagina'])) {
            $model->attributes = $_POST['Pagina'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('criar', array(
            'model' => $model,
        ));
    }
*/
    public function actionEditar($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Pagina'])) {
            $model->attributes = $_POST['Pagina'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Pagina::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pagina-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
