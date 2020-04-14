<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends AdminController {

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
        $model = new <?php echo $this->modelClass; ?>('search');
        $model->unsetAttributes(); 
        if(isset($_GET['<?php echo $this->modelClass; ?>']))
            $model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }


    public function actionCriar()
    {
        $model=new <?php echo $this->modelClass; ?>;

        if(isset($_POST['<?php echo $this->modelClass; ?>']))
        {
            $model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
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

        if(isset($_POST['<?php echo $this->modelClass; ?>']))
        {
            $model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('editar',array(
            'model'=>$model,
        ));
    }


    public function loadModel($id)
    {
        $model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'O objeto não existe.');
            
        return $model;
    }


    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
