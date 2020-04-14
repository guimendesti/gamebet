<?php

class SaquesController extends AdminController {

    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Jogsaque('search');
        $model->unsetAttributes(); 
        if(isset($_GET['Jogsaque']))
            $model->attributes=$_GET['Jogsaque'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    public function actionCriar() {
        $model = new Jogsaque;

        if (isset($_POST['Jogsaque'])) {
            $model->attributes = $_POST['Jogsaque'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('criar', array(
            'model' => $model,
        ));
    }

    public function actionEditar($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['Jogsaque']))
        {
            $model->attributes=$_POST['Jogsaque'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar',array(
            'model'=>$model,
        ));
    }


    public function loadModel($id)
    {
        $model=Jogsaque::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'O objeto não existe.');
            
        return $model;
    }


    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='jogsaque-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
