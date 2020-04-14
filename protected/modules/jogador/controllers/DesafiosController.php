<?php

class DesafiosController extends JogadorController {

    public function actionIndex() {

        $this->breadcrumbs = array('Meus Desafios');

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();


        // Desafios do Jogador
        $whereDesafio = "( (tipo='global' AND desafiante=" . $idjogador . ") "
                . "OR (tipo='privado' AND (desafiante=" . $idjogador . " OR desafiado=" . $idjogador . ") ) )";
        $listaDesafios = Desafio::model()->findAll($whereDesafio." ORDER BY dataDesafio DESC");


        $this->render('index', array('listaDesafios' => $listaDesafios));
    }

}
