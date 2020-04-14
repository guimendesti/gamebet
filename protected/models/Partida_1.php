<?php

/**
 * This is the model class for table "partida".
 *
 * The followings are the available columns in table 'partida':
 * @property integer $idpartida
 * @property integer $idconsole
 * @property integer $idgame
 * @property integer $idtorneio
 * @property double $valor
 * @property string $thisCriacao
 * @property string $thisAgendada
 * @property string $thisPartida
 * @property string $resultadoA
 * @property string $thisResultadoA
 * @property string $resultadoB
 * @property string $thisResultadoB
 * @property string $resultado
 * @property string $thisResultado
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Desafio[] $Desafios
 * @property Jogavaliacao[] $Avaliacoes
 * @property Jogmovimentacao[] $Movimentacoes
 * @property Console $Console
 * @property Game $Game
 * @property Torneio $Torneio
 * @property Jogador[] $Jogadores
 * @property Partidajogador $Jogs
 */
class Partida extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'partida';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idconsole, idgame', 'required',
                'message' => '\'{attribute}\' obrigatório'),
            array('idconsole, idgame, idtorneio, iddesafio', 'numerical', 'integerOnly' => true),
            array('idconsole, idgame, idtorneio, iddesafio', 'numerical',
                'min' => '1',
                'tooSmall' => 'Selecione uma opção válida'),
            array('valor', 'numerical'),
            array('resultadoA, resultadoB, resultado', 'length', 'max' => 30),
            array('status', 'length', 'max' => 9),
            array('dataCriacao, dataAgendada, dataPartida, dataResultadoA, dataResultadoB, dataResultado', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idpartida, idconsole, idgame, idtorneio, iddesafio, valor, dataCriacao, dataAgendada, dataPartida, resultadoA, dataResultadoA, resultadoB, dataResultadoB, resultado, dataResultado, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Desafios' => array(self::HAS_MANY, 'Desafio', 'idpartida'),
            'Avaliacoes' => array(self::HAS_MANY, 'Jogavaliacao', 'idpartida'),
            'Movimentacoes' => array(self::HAS_MANY, 'Jogmovimentacao', 'idpartida'),
            'Console' => array(self::BELONGS_TO, 'Console', 'idconsole'),
            'Game' => array(self::BELONGS_TO, 'Game', 'idgame'),
            'Torneio' => array(self::BELONGS_TO, 'Torneio', 'idtorneio'),
            'Desafio' => array(self::BELONGS_TO, 'Desafio', 'iddesafio'),
            'Jogadores' => array(self::MANY_MANY, 'Jogador', 'partidajogador(idpartida, idjogador)'),
            'Jogs' => array(self::HAS_MANY, 'Partidajogador', 'idpartida'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idpartida' => 'ID',
            'idconsole' => 'Console',
            'idgame' => 'Game',
            'idtorneio' => 'Torneio',
            'iddesafio' => 'Desafio',
            'valor' => 'Valor',
            'dataCriacao' => 'Data Criação',
            'dataAgendada' => 'Data Agendada',
            'dataPartida' => 'Data Partida',
            'resultadoA' => 'Resultado A',
            'dataResultadoA' => 'Data Resultado A',
            'resultadoB' => 'Resultado B',
            'dataResultadoB' => 'Data Resultado B',
            'resultado' => 'Resultado',
            'dataResultado' => 'Data Resultado',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idpartida', $this->idpartida);
        $criteria->compare('idconsole', $this->idconsole);
        $criteria->compare('idgame', $this->idgame);
        $criteria->compare('idtorneio', $this->idtorneio);
        $criteria->compare('iddesafio', $this->iddesafio);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('dataCriacao', $this->dataCriacao, true);
        $criteria->compare('dataAgendada', $this->dataAgendada, true);
        $criteria->compare('dataPartida', $this->dataPartida, true);
        $criteria->compare('resultadoA', $this->resultadoA, true);
        $criteria->compare('dataResultadoA', $this->dataResultadoA, true);
        $criteria->compare('resultadoB', $this->resultadoB, true);
        $criteria->compare('dataResultadoB', $this->dataResultadoB, true);
        $criteria->compare('resultado', $this->resultado, true);
        $criteria->compare('dataResultado', $this->dataResultado, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Partida the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getData($coluna, $hora = false) {
        $formato = ($hora) ? "d/m/Y \à\s H\hi\m" : "d/m/Y";
        return date($formato, strtotime($this->$coluna));
    }

    public function getResultados() {

        $resultados = "";
        if ($this->resultado != "") {
            $resultados .= ($resultados != "") ? "<br />" : "";
            $resultados .= "Resultado Final: " . $this->resultado . " (" . $this->getData('dataResultado') . ")";
        } else {
            if ($this->resultadoA != "") {
                $resultados .= "Lado A: " . $this->resultadoA . " (" . $this->getData('dataResultadoA') . ")";
            }
            if ($this->resultadoB != "") {
                $resultados .= ($resultados != "") ? "<br />" : "";
                $resultados .= "Lado B: " . $this->resultadoB . " (" . $this->getData('dataResultadoB') . ")";
            }
        }

        return $resultados;
    }

    public function getCalendario() {

        $calendario = "<b>Criação:</b> " . $this->getData('dataCriacao', true);
        if ($this->dataAgendada > 0) {
            $calendario .= "<br /><b>Agendada:</b> " . $this->getData('dataAgendada');
        }
        if ($this->dataPartida > 0) {
            $calendario .= "<br /><b>Partida:</b> " . $this->getData('dataPartida');
        }

        return $calendario;
    }

    public function listaStatus() {
        return array('agendada' => 'Agendada',
            'espera' => 'Espera',
            'concluida' => 'Concluída',
            'moderacao' => 'Moderação',
            'cancelada' => 'Cancelada');
    }

    public function getStatus() {

        $status = $this->status;
        if ($status == "agendada") {
            return "<span class='label label-info'>Agendada</span>";
        } elseif ($status == "espera") {
            return "<span class='label label-primary'>Espera</span>";
        } elseif ($status == "concluida") {
            return "<span class='label label-success'>Concluída</span>";
        } elseif ($status == "moderacao") {
            return "<span class='label label-danger'>Moderação</span>";
        } else {
            return "<small style='color:#999;'>Cancelada</small>";
        }
    }

    public function getValor() {
        return number_format($this->valor, 2, ',', '.');
    }

    public function setValor($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->valor = $valor;
    }

    public function getResultado($equipe = false, $tratar = false) {
        if ($equipe == "A") {
            $resultado = $this->resultadoA;
        } elseif ($equipe == "B") {
            $resultado = $this->resultadoB;
        } else {
            $resultado = $this->resultado;
        }
        
        if($tratar && strpos($resultado, "B") !== false){
            $rExp = explode('B', $resultado);
            $rA = substr($rExp[0], 1);
            $rB = $rExp[1];
            $resultado = array('A' => $rA, 'B' => $rB);
        }
        
        return $resultado;
    }

    public function setResultado($resultado, $equipe = false) {
        $data = date('Y-m-d H:i:s');
        if ($equipe == "A") {
            $this->resultadoA = $resultado;
            $this->dataResultadoA = $data;
        } elseif ($equipe == "B") {
            $this->resultadoB = $resultado;
            $this->dataResultadoB = $data;
        } else {
            $this->resultado = $resultado;
            $this->dataResultado = $data;
        }
    }

    public function processaMovimentacoes($cancelamento = false) {
        if (!$cancelamento) {
            if ($this->status != "concluida" || is_null($this->resultado)) {
                return "erroStatus";
            } else {
                $r = $this->getResultado(false, true);
                $equipeVitoria = ($r['A'] > $r['B']) ? "A" : ( ($r['B'] > $r['A']) ? "B" : false );
                $equipeDerrota = ($equipeVitoria == "A") ? "B" : "A";
                $dataAgora = date('Y-m-d H:i:s');

                if ($equipeVitoria !== false) {
                    $jogadores = $this->Jogs;
                    if (count($jogadores) > 0) {

                        // Organiza Jogadores
                        foreach ($jogadores as $partidaJog) {
                            $equipe = $partidaJog->equipe;
                            $jog = $partidaJog->Jogador;

                            $jogs[$equipe][] = $jog;
                        }

                        // Pega Saldo de Comissoes
                        $comissao = Comissao::model()->findAll(array('order' => 'data DESC', 'limit' => '1'));
                        $saldoComissao = (isset($comissao[0])) ? $comissao[0]->saldoDepois : 0;

                        // Configura Valores
                        $valorPremio = $this->valor * 2;
                        $valorCredito = ($valorPremio) * 0.9;
                        $valorComissao = $valorPremio - $valorCredito;
                        
                        // Depois Credita para ganhador(es)
                        foreach ($jogs[$equipeVitoria] as $jogador) {

                            // Movimentacao
                            $mov = new Jogmovimentacao();
                            $mov->idjogador = $jogador->idjogador;
                            $mov->idpartida = $this->idpartida;
                            $mov->transacao = 'credito'; // CREDITO
                            $mov->descricao = 'partida';
                            $mov->valor = $valorCredito;
                            $mov->saldoAntes = $jogador->getSaldoAtual(false);
                            $mov->saldoDepois = $mov->saldoAntes + $valorCredito; // SOMA
                            $mov->data = $dataAgora;
                            $mov->status = 1;
                            if ($mov->Save()) {

                                // Comissao
                                $comissao = new Comissao;
                                $comissao->idjogmovimentacao = $mov->idjogmovimentacao;
                                $comissao->transacao = 'credito'; // CREDITO
                                $comissao->valor = $valorComissao;
                                $comissao->saldoAntes = $saldoComissao;
                                $comissao->saldoDepois = $comissao->saldoAntes + $valorComissao;
                                $comissao->data = $dataAgora;
                                if ($comissao->Save()) {
                                    $saldoComissao = $comissao->saldoDepois;
                                }
                            }
                        }
                    }
                } else {
                    return true;
                }
            }
        } else {
            if ($this->status != "cancelada") {
                return "erroCancelar";
            } else {
                // Cancelamento
                $jogadores = $this->Jogs;
                if (count($jogadores) > 0) {

                    foreach ($jogadores as $jogador) {

                        // Movimentacao
                        $mov = new Jogmovimentacao();
                        $mov->idjogador = $jogador->idjogador;
                        $mov->idpartida = $this->idpartida;
                        $mov->transacao = 'credito'; // CREDITO
                        $mov->descricao = 'partida';
                        $mov->valor = $this->valor;
                        $mov->saldoAntes = $jogador->getSaldoAtual(false);
                        $mov->saldoDepois = $mov->saldoAntes + $valorCredito; // SOMA
                        $mov->data = date('Y-m-d H:i:s');
                        $mov->status = 1;
                        $mov->Save();
                        
                    }
                }
            }
        }
    }

    /**
     * @param int $idjogador ID do Jogador
     * @param int $idconsole ID do Console
     * @param int $idgame    ID do Game
     * @param array $estatisticas Vertor {vitoria,empate,torneio,campeao)
     */
    public function processaEstatisticas($idjogador, $idconsole, $idgame, $estatistitcas) {
        
    }

}
