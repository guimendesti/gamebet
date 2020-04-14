<?php

class MensagensController extends AdminController {

    public function checaAutorizacao() {
        if (!isset(Yii::app()->session['loginAdmin'])) {
            $this->redirect(array("/admin/login"));
        }
    }

    public function init() {
        $this->checaAutorizacao();
    }

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
        $model = new Chatmensagem('search');
        $model->unsetAttributes(); 
        if(isset($_GET['Chatmensagem']))
            $model->attributes=$_GET['Chatmensagem'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }


    public function actionCriar()
    {
        $model=new Chatmensagem;

        if(isset($_POST['Chatmensagem']))
        {
            $model->attributes=$_POST['Chatmensagem'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('criar',array(
            'model'=>$model,
        ));
    }


    public function actionEditar($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['Chatmensagem']))
        {
            $model->attributes=$_POST['Chatmensagem'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar',array(
            'model'=>$model,
        ));
    }


    public function loadModel($id)
    {
        $model=Chatmensagem::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'O objeto não existe.');
            
        return $model;
    }


    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='chatmensagem-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
