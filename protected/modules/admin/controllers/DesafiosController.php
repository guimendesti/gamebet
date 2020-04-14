<?php

class DesafiosController extends AdminController {

    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Desafio('search');
        $model->unsetAttributes(); 
        if(isset($_GET['Desafio']))
            $model->attributes=$_GET['Desafio'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }


    public function actionCriar()
    {
        $model=new Desafio;

        if(isset($_POST['Desafio']))
        {
            $model->attributes=$_POST['Desafio'];
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

        if(isset($_POST['Desafio']))
        {
            $model->attributes=$_POST['Desafio'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar',array(
            'model'=>$model,
        ));
    }


    public function loadModel($id)
    {
        $model=Desafio::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'O objeto não existe.');
            
        return $model;
    }


    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='desafio-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    
    

    public function actionListaGamesConsole() {
        
        $idconsole = $_POST['Desafio']['idconsole'];
        echo $this->listaGamesConsole($idconsole);
        
    }
    
}
