<?php

class JogarController extends JogadorController {

    public function actionIndex() {

        $this->breadcrumbs = array('Jogar Agora');

        $this->render('index');
    }

    public function actionGlobal() {

        $this->breadcrumbs = array('Global - Desafios Públicos');

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $jogador = $this->jogadorLogado;
        $params = $this->getActionParams();

        // Novo Desafio
        $desafiarModel = new Desafio;
        $desafiarModel->tipo = "global";
        $retornoDesafiar = false;
        if (isset($_POST['Desafio'])) {
            $desafiarModel->attributes = $_POST['Desafio'];
            $desafiarModel->desafiante = $idjogador;
            $desafiarModel->dataDesafio = date('Y-m-d H:i:s');

            $saldoJogador = $jogador->getSaldoAtual(false);
            if ($saldoJogador >= $desafiarModel->valor) {

                if ($desafiarModel->save(false)) {

                    // Movimentacao (debita desafio)
                    $mov = new Jogmovimentacao();
                    $mov->idjogador = $jogador->idjogador;
                    $mov->transacao = 'debito'; // DEBITO
                    $mov->descricao = "desafio".$desafiarModel->iddesafio;
                    $mov->valor = $desafiarModel->valor;
                    $mov->saldoAntes = $saldoJogador;
                    $mov->saldoDepois = $mov->saldoAntes - $desafiarModel->valor; // SUBTRAI
                    $mov->data = date('Y-m-d H:i:s');
                    $mov->status = 1;
                    if (!$mov->save(false)) {
                        $desafiarModel->status = 'cancelado';
                        $desafiarModel->save(false);
                        $retornoDesafiar = false;
                    }
                    
                    $retornoDesafiar = true;
                }
            }
        }
        // Aceitar
        elseif (isset($params["aceitar"])) {
            $iddesafio = $params["aceitar"];
            $this->aceitarDesafio($iddesafio, 'global');
            $this->redirect(Yii::app()->baseUrl . '/global');
        }
        // Cancelar
        elseif (isset($params["cancelar"])) {
            $iddesafio = $params["cancelar"];
            $this->cancelarDesafio($iddesafio, 'global');
            $this->redirect(Yii::app()->baseUrl . '/global');
        }

        // Listar Desafios GLOBAL Abertos
        $whereDesafio = "tipo='global'";
        $whereDesafio .= " AND status='espera'";
        $listaDesafios = Desafio::model()->findAll($whereDesafio);

        $this->render('global', array('desafiarModel' => $desafiarModel,
            'retornoDesafiar' => $retornoDesafiar,
            'listaDesafios' => $listaDesafios));
    }

    public function actionPrivado() {

        $this->breadcrumbs = array('Privado - Desafios Diretos');

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $jogador = $this->jogadorLogado;
        $params = $this->getActionParams();

        // Novo Desafio Privado
        $desafiarModel = new Desafio;
        $desafiarModel->tipo = "privado";
        $retornoDesafiar = isset($params['desafiado']);
        if (isset($_POST['Desafio'])) {
            $desafiarModel->attributes = $_POST['Desafio'];
            $desafiarModel->desafiante = $idjogador;
            $desafiarModel->dataDesafio = date('Y-m-d H:i:s');

            $saldoJogador = $jogador->getSaldoAtual(false);
            if ($saldoJogador >= $desafiarModel->valor) {

                if ($desafiarModel->save(false)) {

                    // Movimentacao (debita desafio)
                    $mov = new Jogmovimentacao();
                    $mov->idjogador = $jogador->idjogador;
                    $mov->transacao = 'debito'; // DEBITO
                    $mov->descricao = "desafio".$desafiarModel->iddesafio;
                    $mov->valor = $desafiarModel->valor;
                    $mov->saldoAntes = $saldoJogador;
                    $mov->saldoDepois = $mov->saldoAntes - $desafiarModel->valor; // SUBTRAI
                    $mov->data = date('Y-m-d H:i:s');
                    $mov->status = 1;
                    if (!$mov->save(false)) {
                        $desafiarModel->status = 'cancelado';
                        $desafiarModel->save(false);
                    }
                    $this->redirect(Yii::app()->baseUrl . '/privado/desafiado');
                }
            }
        }
        // Aceitar
        elseif (isset($params["aceitar"])) {
            $iddesafio = $params["aceitar"];
            $this->aceitarDesafio($iddesafio, 'privado');
            $this->redirect(Yii::app()->baseUrl . '/privado');
        }
        // Recusar
        elseif (isset($params["recusar"])) {
            $iddesafio = $params["recusar"];
            $desafio = Desafio::model()->find('iddesafio=' . $iddesafio
                    . ' AND desafiado=' . $idjogador);

            if ($desafio instanceof Desafio) {
                $desafio->dataResposta = date('Y-m-d H:i:s');
                $desafio->resposta = 0;
                $desafio->status = 'recusado';
                $desafio->save(false);
            }
            $this->redirect(Yii::app()->baseUrl . '/privado');
        }
        // Cancelar
        elseif (isset($params["cancelar"])) {
            $iddesafio = $params["cancelar"];
            $this->cancelarDesafio($iddesafio, 'privado');
            $this->redirect(Yii::app()->baseUrl . '/privado');
        }

        // Listar Jogadores para Desafio PRIVADO
        $whereJogador = "t.status=1";
        $whereJogador .= " AND t.idjogador!=" . $idjogador;

        // filtro Jogador
        $filtroModel = new Jogdisponivel;
        if (isset($_POST['Jogdisponivel'])) {
            $filtroModel->attributes = $_POST['Jogdisponivel'];

            $filtro = $_POST['Jogdisponivel'];
            if ($filtro['idconsole'] > 0) {
                $whereJogador .= " AND Disponiveis.idconsole=" . $filtro['idconsole'];
            }
            if ($filtro['idgame'] > 0) {
                $whereJogador .= " AND Disponiveis.idgame=" . $filtro['idgame'];
            }
        }

        $listaJogadores = Jogador::model()->with('Disponiveis')->findAll($whereJogador);

        $this->render('privado', array('desafiarModel' => $desafiarModel,
            'filtroModel' => $filtroModel,
            'retornoDesafiar' => $retornoDesafiar,
            'listaJogadores' => $listaJogadores));
    }

    public function actionListaGamesConsole() {

        if (isset($_POST['Desafio'])) {
            $idconsole = $_POST['Desafio']['idconsole'];
        } elseif (isset($_POST['Jogdisponivel'])) {
            $idconsole = $_POST['Jogdisponivel']['idconsole'];
        } else {
            echo "Opção Inválida";
            exit;
        }
        echo $this->listaGamesConsole($idconsole);
    }

    private function aceitarDesafio($iddesafio, $tipo) {

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $jogador = $this->jogadorLogado;

        $whereDesafio = 'iddesafio=' . $iddesafio;
        if ($tipo == 'global') {
            $whereDesafio .= ' AND tipo="global"';
        } else {
            $whereDesafio .= ' AND desafiado=' . $idjogador;
            $whereDesafio .= ' AND tipo="privado"';
        }
        $desafio = Desafio::model()->find($whereDesafio);

        if ($desafio instanceof Desafio) {
            $saldoJogador = $jogador->getSaldoAtual(false);
            if ($saldoJogador >= $desafio->valor) {

                // Movimentacao (debita desafio aceito)
                $mov = new Jogmovimentacao();
                $mov->idjogador = $jogador->idjogador;
                $mov->transacao = 'debito'; // DEBITO
                $mov->descricao = "desafio".$desafio->iddesafio;
                $mov->valor = $desafio->valor;
                $mov->saldoAntes = $saldoJogador;
                $mov->saldoDepois = $mov->saldoAntes - $desafio->valor; // SUBTRAI
                $mov->data = date('Y-m-d H:i:s');
                $mov->status = 1;
                if ($mov->save(false)) {

                    $desafio->dataResposta = date('Y-m-d H:i:s');
                    $desafio->resposta = 1;
                    $desafio->status = 'aceito';
                    if ($desafio->save(false)) {
                        // Gera Partida
                        $partida = new Partida;
                        $partida->idconsole = $desafio->idconsole;
                        $partida->idgame = $desafio->idgame;
                        $partida->iddesafio = $desafio->iddesafio;
                        $partida->valor = $desafio->valor;
                        $partida->dataCriacao = date('Y-m-d H:i:s');
                        $partida->dataAgendada = date('Y-m-d H:i:s');
                        $partida->status = 'agendada';
                        if ($partida->save(false)) {

                            // Salva Jogadores                
                            $pDesafiante = new Partidajogador;
                            $pDesafiante->idpartida = $partida->idpartida;
                            $pDesafiante->idjogador = $desafio->desafiante;
                            $pDesafiante->equipe = 'A';
                            $pDesafiante->save(false);

                            $pDesafiado = new Partidajogador;
                            $pDesafiado->idpartida = $partida->idpartida;
                            $pDesafiado->idjogador = $idjogador;
                            $pDesafiado->equipe = 'B';
                            $pDesafiado->save(false);
                        }
                        
                        $this->redirect(Yii::app()->baseUrl . '/jogador/partidas');
                    } 
                } 
            }
            
        }
        
        $this->redirect(Yii::app()->baseUrl.'/'.$tipo);
    }

    private function cancelarDesafio($iddesafio, $tipo) {

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $jogador = $this->jogadorLogado;
        $saldoJogador = $jogador->getSaldoAtual(false);
        
        $whereDesafio = 'iddesafio=' . $iddesafio;
        if ($tipo == 'global') {
            $whereDesafio .= ' AND tipo="global"';
        } else {
            $whereDesafio .= ' AND desafiante=' . $idjogador;
            $whereDesafio .= ' AND tipo="privado"';
        }
        $desafio = Desafio::model()->find($whereDesafio);
        if($desafio instanceof Desafio){
            $desafio->dataResposta = date('Y-m-d H:i:s');
            $desafio->status = 'cancelado';
            
            // Movimentacao (debita desafio aceito)
            $mov = new Jogmovimentacao();
            $mov->idjogador = $jogador->idjogador;
            $mov->transacao = 'credito'; // CREDITO (devolucao cancelamento)
            $mov->descricao = "desafio".$desafio->iddesafio;
            $mov->valor = $desafio->valor;
            $mov->saldoAntes = $saldoJogador;
            $mov->saldoDepois = $mov->saldoAntes + $desafio->valor; // SOMA
            $mov->data = date('Y-m-d H:i:s');
            $mov->status = 1;
            
            if($mov->save(false) && $desafio->save(false)){
                $this->redirect(Yii::app()->baseUrl.'/jogador/desafios');
            }
        }
    }

}
