<?php

class GamesController extends AdminController {

    public function actionDeletar($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    public function actionIndex() {
        $model = new Game('search');
        $model->unsetAttributes();
        if (isset($_GET['Game']))
            $model->attributes = $_GET['Game'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCriar() {
        $model = new Game;

        if (isset($_POST['Game'])) {
            
            // Rotina de Upload Padronizada
            $entidade = "Game";
            $campo = "imagem";
            $dirUpload = "uploads/imagens/games/";
            $prefixoNome = preg_replace('/[^a-z0-9]/i', '', $_POST['Game']['nome']).'-';
            $out = false;
            
            if ($_FILES[$entidade]['name'][$campo] != "") {
                $arquivo = $_FILES[$entidade];
                
                $file['name'] = $arquivo['name'][$campo];
                $file['type'] = $arquivo['type'][$campo];
                $file['tmp_name'] = $arquivo['tmp_name'][$campo];
                $file['error'] = $arquivo['error'][$campo];
                $file['size'] = $arquivo['size'][$campo];

                $nomeArquivo = $this->uploadArquivo($file, $out, false, $prefixoNome, $dirUpload);

                if ($nomeArquivo !== false) {
                    $_POST[$entidade][$campo] = $nomeArquivo;
                }
            } 
            else {
                unset($_POST[$entidade][$campo]);
            }
            // FIM Rotina Upload

            $model->attributes = $_POST['Game'];
            if ($model->saveWithRelated('Consoles'))
                $this->redirect(array('index'));
        }

        $this->render('criar', array(
            'model' => $model,
        ));
    }

    public function actionEditar($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Game'])) {
            
            // Rotina de Upload Padronizada
            $entidade = "Game";
            $campo = "imagem";
            $dirUpload = "uploads/imagens/games/";
            $prefixoNome = preg_replace('/[^a-z0-9]/i', '', $_POST['Game']['nome']).'-';
            $out = ($_POST[$entidade][$campo] != "") ? $_POST[$entidade][$campo] : false;
            
            if ($_FILES[$entidade]['name'][$campo] != "") {
                $arquivo = $_FILES[$entidade];
                
                $file['name'] = $arquivo['name'][$campo];
                $file['type'] = $arquivo['type'][$campo];
                $file['tmp_name'] = $arquivo['tmp_name'][$campo];
                $file['error'] = $arquivo['error'][$campo];
                $file['size'] = $arquivo['size'][$campo];

                $nomeArquivo = $this->uploadArquivo($file, $out, false, $prefixoNome, $dirUpload);
                
                if ($nomeArquivo !== false) {
                    $_POST[$entidade][$campo] = $nomeArquivo;
                }
            } 
            else {
                unset($_POST[$entidade][$campo]);
            }
            // FIM Rotina Upload

            $model->attributes = $_POST['Game'];
            if ($model->saveWithRelated('Consoles'))
                $this->redirect(array('index'));
        }

        $this->render('editar', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Game::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'O objeto não existe.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
