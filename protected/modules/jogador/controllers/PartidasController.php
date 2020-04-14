
<?php

class PartidasController extends JogadorController {

    public function actionIndex() {
        
        $this->breadcrumbs = array('Minhas Partidas');

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $params = $this->getActionParams();

        // Lançar Resultado
        $retornoPartida = false;
        if (isset($_POST['resultado_idpartida'])) {
            $idpartida = $_POST['resultado_idpartida'];
            $partida = Partida::model()->find('idpartida=' . $idpartida);

            if ($partida instanceof Partida) {
                $retornoPartida = ($partida->computaResultado($_POST,$idjogador)) ? $partida->status : false;
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
        // Cancelar
        elseif (isset($params["cancelar"])) {
            $idpartida = $params["cancelar"];
            $partida = Partida::model()->with('Jogadores')->find('t.idpartida=' . $idpartida
                    . ' AND Jogadores.idjogador=' . $idjogador);

            if ($partida instanceof Partida) {
                $partida->dataResultado = date('Y-m-d H:i:s');
                $partida->status = 'cancelada';
                $retornoPartida = ($partida->save()) ? $partida->status : false;
            }

            // Movimentações Financeiras
            if($retornoPartida == "cancelada"){

                $cancelamento = true;
                $partida->processaMovimentacoes($cancelamento);

            }
        }

        // Partidas do Jogador
        $wherePartida = "Jogadores.idjogador=" . $idjogador;
        $listaPartidas = Partida::model()->with('Jogadores')->findAll($wherePartida);

        $this->render('index', array('listaPartidas' => $listaPartidas,
            'retornoPartida' => $retornoPartida));
    }

}
