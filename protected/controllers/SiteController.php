<?php

class SiteController extends Controller {

    public function actionIndex() {
        
        $this->render('jogador.views.jogar.index', array(
        ));
    }
    

    public function actionRegras() {

        $this->breadcrumbs = array('Regras');

        
        $this->render('regras', array(
        ));
    }
    

    public function actionComofunciona() {

        $this->breadcrumbs = array('Como Funciona');

        
        $this->render('comofunciona', array(
        ));
    }
    

    public function actionContato() {

        $this->breadcrumbs = array('Contato');

        
        $this->render('contato', array(
        ));
    }
    
    

    public function actionError() {
        $this->redirect(array('/'));
    }

}
