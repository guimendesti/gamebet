<?php

class AdministradoresController extends Controller {
    
    public function actionDeletar($id) {
        
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }
    
    public function actionIndex() {

        $model = new Admin('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Admin']))
            $model->attributes = $_GET['Admin'];

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    public function actionCriar() {
        
        $model = new Admin;

        if (isset($_POST['Admin'])) {
            $_POST['Admin']['senha'] = md5($_POST['Admin']['senha']);
            $model->attributes = $_POST['Admin'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('criar', array(
            'model' => $model,
        ));
    }
    
    public function actionEditar($id) {
        
        $model = $this->loadModel($id);

        if (isset($_POST['Admin'])) {
            $_POST['Admin']['senha'] = ($_POST['novaSenha'] != "") ? md5($_POST['novaSenha']) : $_POST['Admin']['senha'];
            $model->attributes = $_POST['Admin'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }
    
    public function loadModel($id) {
        $model = Admin::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');
        return $model;
    }
    
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
