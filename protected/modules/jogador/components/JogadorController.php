<?php

/**
 * JogadorController is the customized base controller from Jogador Panel
 * 
 */
class JogadorController extends Controller {
    
    public $desafiosAbertos = false;
    public $partidasAgendadas = false;

    protected function beforeAction($event) {

        $control = Yii::app()->getController()->getId();
        $action = Yii::app()->getController()->getAction()->getId();
        
        if (!isset(Yii::app()->session['loginJogador'])) {
            if ($control != "default" || ($action != "login" && $action != "cadastrar" && $action != "esqueciSenha")) {
                $this->redirect(array("/jogador/login"));
            }
        }
        else{
            // Dados Jogador
            $idjogador = Yii::app()->session['loginJogador']->getIdentity()->getId();
            $this->jogadorLogado = Jogador::model()->findByPk($idjogador);
            
            // Status Chat
            $chat = Chatjogador::model()->find('idjogador='.$idjogador);
            if(!($chat instanceof Chatjogador)){
                $chat = new Chatjogador;
                $chat->idjogador = $idjogador;
                $chat->status = 1;
            }
            $chat->ultimoacesso = date('Y-m-d H:i:s');
            $chat->save();
            
            /*************************
             *  Menu Lateral
             *************************/
            // Desafios Abertos
            $whereDesafio = "( (tipo='global' AND desafiante=".$idjogador.") "
                            . "OR (tipo='privado' AND (desafiante=".$idjogador." OR desafiado=".$idjogador.") ) )";
            $whereDesafio .= " AND status='espera'";
            $desafiosAbertos = Desafio::model()->findAll($whereDesafio);
            $this->desafiosAbertos = $desafiosAbertos;
            
            // Partidas Agendadas
            $wherePartida  = "Jogadores.idjogador=".$idjogador;
            $wherePartida .= " AND (t.status='espera' OR t.status='agendada')";
            $partidasAgendadas= Partida::model()->with('Jogadores')->findAll($wherePartida);
            $this->partidasAgendadas = $partidasAgendadas;
            /*************************
             *  FIM Menu Lateral
             *************************/
            
        }
        
        return true;
    }
    

}
