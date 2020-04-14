<?php

class TorneiosController extends JogadorController {

    public function actionIndex() {

        $this->breadcrumbs = array('Torneios');

        $torneioFiltro = new TorneioFiltro();

        $whereTorneio = "";
        if (isset($_POST['TorneioFiltro'])) {
            $idconsole = $_POST["TorneioFiltro"]['idconsole'];
            $idgame = $_POST["TorneioFiltro"]['idgame'];
            if ($idconsole > 0)
                $whereTorneio .= " AND idconsole =" . $idconsole;
            if ($idgame > 0)
                $whereTorneio .= " AND idgame =" . $idgame;
            $torneioFiltro->attributes = $_POST['TorneioFiltro'];
        }

        $torneios = Torneio::model()->findAll('status IN(\'aberto\',\'andamento\') ' . $whereTorneio);

        $this->render('index', array('torneioFiltro' => $torneioFiltro,
            'torneios' => $torneios));
    }

    public function actionSala() {

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $params = $this->getActionParams();
        if (!isset($params['sala'])) {
            $this->redirect(Yii::app()->baseUrl . '/torneios');
        }

        // Lançar Resultado
        $retornoPartida = false;
        if (isset($_POST['resultado_idpartida'])) {
            $idpartida = $_POST['resultado_idpartida'];
            $partida = Partida::model()->find('idpartida=' . $idpartida);

            if ($partida instanceof Partida) {
                $retornoPartida = ($partida->computaResultado($_POST)) ? $partida->status : false;
                // Movimentações Financeiras
                if($retornoPartida == "concluida"){
                    $partida->processaMovimentacoes();
                }
            }
        }
        // Moderação
        elseif (isset($params["moderacao"])) {
            $idpartida = $params["moderacao"];
            $partida = Partida::model()->with('Jogadores')->find('t.idpartida=' . $idpartida
                    . ' AND Jogadores.idjogador=' . $idjogador);

            if ($partida instanceof Partida) {
                $partida->status = 'moderacao';
                $retornoPartida = ($partida->save()) ? $partida->status : false;
            }
        }

        
        // Torneio
        $nomeUrl = str_replace("-", "%", $params['sala']);
        $sqlReplace = "REPLACE(REPLACE(nome, '  ', ' '), ' ', '') like '" . $nomeUrl . "'";
        $torneio = Torneio::model()->find($sqlReplace);

        if ($torneio instanceof Torneio) {
            $this->breadcrumbs = array('Sala do Torneio');

            $this->render('sala', array('torneio' => $torneio));
        } else {
            $this->redirect(Yii::app()->baseUrl . '/torneios');
        }
    }

    public function actionInscrever() {

        $params = $this->getActionParams();
        if (!isset($params['inscrever'])) {
            $this->redirect(Yii::app()->baseUrl . '/torneios');
        }

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $jogador = $this->jogadorLogado;

        $nomeUrl = str_replace("-", "%", $params['inscrever']);
        $sqlReplace = "REPLACE(REPLACE(nome, '  ', ' '), ' ', '') like '" . $nomeUrl . "'";
        $torneio = Torneio::model()->find('status=1 AND ' . $sqlReplace);
        
        if ($torneio instanceof Torneio) {
            $dataAgora = date('Y-m-d H:i:s');
            $saldoJogador = $jogador->getSaldoAtual(false);
            if ($saldoJogador >= $torneio->valor) {

                // Movimentacao (debita desafio aceito)
                $mov = new Jogmovimentacao();
                $mov->idjogador = $jogador->idjogador;
                $mov->idtorneio = $torneio->idtorneio;
                $mov->transacao = 'debito'; // DEBITO
                $mov->descricao = 'torneio';
                $mov->valor = $torneio->valor;
                $mov->saldoAntes = $saldoJogador;
                $mov->saldoDepois = $mov->saldoAntes - $torneio->valor; // SUBTRAI
                $mov->data = $dataAgora;
                $mov->status = 1;
                if ($mov->save(false)) {
                    $inscricao = new Torneioinscricao;
                    $inscricao->idtorneio = $torneio->idtorneio;
                    $inscricao->idjogador = $this->jogadorLogado->idjogador;
                    $inscricao->data = $dataAgora;
                    if($inscricao->save()){
                        
                        if($torneio->getNumInscritos() == $torneio->jogadores){
                            
                            $torneio->etapa = $torneio->jogadores;
                            $torneio->status = 'andamento';
                            if($torneio->gerarEtapa()){
                                $torneio->save(false);
                                $torneio->disparaEmails();
                            }
                            
                        }

                        $torneioUrl = $torneio->getNomeUrl();
                        $this->redirect(Yii::app()->baseUrl . '/torneios/' . $torneioUrl);
                        
                    }
                }
            }
        }

        $this->redirect(Yii::app()->baseUrl . '/torneios');
    }

    public function actionCancelar() {

        $jogador = $this->jogadorLogado;
        $idjogador = $jogador->idjogador;
        $params = $this->getActionParams();
        if (!isset($params['cancelar'])) {
            $this->redirect(Yii::app()->baseUrl . '/torneios');
        }

        $nomeUrl = str_replace("-", "%", $params['cancelar']);
        $sqlReplace = "REPLACE(REPLACE(t.nome, '  ', ' '), ' ', '') like '" . $nomeUrl . "'";
        $torneio = Torneio::model()->with('Inscricoes')
                ->find('t.status=1 AND Inscricoes.idjogador = ' . $idjogador
                . ' AND ' . $sqlReplace);

        if ($torneio instanceof Torneio) {

            $dataAgora = date('Y-m-d H:i:s');
            $saldoJogador = $jogador->getSaldoAtual(false);

            // Movimentacao (credita valor inscrição cancelada)
            $mov = new Jogmovimentacao();
            $mov->idjogador = $jogador->idjogador;
            $mov->idtorneio = $torneio->idtorneio;
            $mov->transacao = 'credito'; // CREDITO
            $mov->descricao = 'torneio';
            $mov->valor = $torneio->valor;
            $mov->saldoAntes = $saldoJogador;
            $mov->saldoDepois = $mov->saldoAntes + $torneio->valor; // SOMA
            $mov->data = $dataAgora;
            $mov->status = 1;
            if ($mov->save(false)) {
                $inscricao = $torneio->Inscricoes[0];
                $inscricao->delete();
            }
        }

        $this->redirect(Yii::app()->baseUrl . '/torneios');
    }

    public function actionListaGamesConsole() {

        $idconsole = $_POST['TorneioFiltro']['idconsole'];
        echo $this->listaGamesConsole($idconsole);
    }

}




