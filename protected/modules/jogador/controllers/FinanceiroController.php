<?php

class FinanceiroController extends JogadorController {

    public function actionIndex() {

        $this->breadcrumbs = array("Extrato Financeiro");

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();

        // Movimentacoes
        $whereMovimentacao = "idjogador=" . $idjogador;
        $listaMovimentacoes = Jogmovimentacao::model()->findAll($whereMovimentacao . " ORDER BY data DESC");

        $this->render('index', array('listaMovimentacoes' => $listaMovimentacoes));
    }

    public function actionCredito() {

        $this->breadcrumbs = array("Adicionar Crédito");

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $params = $this->getActionParams();

        // Novo Crédito
        $creditoModel = new Jogcredito;
        $retornoCredito = false;
        if (isset($_POST['Jogcredito'])) {
            $creditoModel->idjogador = $idjogador;
            $creditoModel->data = date('Y-m-d H:i:s');
            $creditoModel->valor = $_POST['Jogcredito']['valor'];
            $creditoModel->forma = 'pagseguro';
            $creditoModel->situacao = 2; //2=Pendente
            $retornoCredito = $creditoModel->save(false);
            unset($creditoModel);
            $creditoModel = new Jogcredito;
        }
        // Cancelar
        elseif(isset($params["cancelar"])){
            $idjogcredito = $params["cancelar"];
            $credito = Jogcredito::model()->find('idjogcredito='.$idjogcredito
                                                .' AND idjogador='.$idjogador);
            
            if($credito instanceof Jogcredito){
                $credito->situacao = 0; //0=Cancelado
                if($credito->save(false)){
                    $retornoCredito = "cancelado";
                }
            }
        }

        // Creditos
        $whereCredito = "idjogador=" . $idjogador;
        $listaCreditos = Jogcredito::model()->findAll($whereCredito . " ORDER BY data DESC");

        $this->render('credito', array('creditoModel' => $creditoModel,
                                    'retornoCredito' => $retornoCredito,
                                    'listaCreditos' => $listaCreditos));
    }

    public function actionSaque() {

        $this->breadcrumbs = array("Solicitar Saque");

        $idjogador = Yii::app()->session["loginJogador"]->getIdentity()->getId();
        $params = $this->getActionParams();

        // Novo Saques
        $saqueModel = new Jogsaque;
        $retornoSaque = false;
        if (isset($_POST['Jogsaque'])) {
            $saqueModel->idjogador = $idjogador;
            $saqueModel->data = date('Y-m-d H:i:s');
            $saqueModel->valor = $_POST['Jogsaque']['valor'];
            $saqueModel->situacao = 2; //2=Pendente
            $retornoSaque = $saqueModel->save(false);
            unset($saqueModel);
            $saqueModel = new Jogsaque;
        }
        // Cancelar
        elseif(isset($params["cancelar"])){
            $idjogsaque = $params["cancelar"];
            $saque = Jogsaque::model()->find('idjogsaque='.$idjogsaque
                                                .' AND idjogador='.$idjogador);
            
            if($saque instanceof Jogsaque){
                $saque->situacao = 0; //0=Cancelado
                if($saque->save(false)){
                    $retornoSaque = "cancelado";
                }
            }
        }

        // Saques
        $whereSaque = "idjogador=" . $idjogador;
        $listaSaques = Jogsaque::model()->findAll($whereSaque . " ORDER BY data DESC");

        $this->render('saque', array('saqueModel' => $saqueModel,
                                    'retornoSaque' => $retornoSaque,
                                    'listaSaques' => $listaSaques));
    }

}
