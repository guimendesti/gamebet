<?php

/**
 * This is the model class for table "jogmovimentacao".
 *
 * The followings are the available columns in table 'jogmovimentacao':
 * @property integer $idjogmovimentacao
 * @property integer $idjogador
 * @property integer $idpartida
 * @property integer $idtorneio
 * @property string $transacao
 * @property string $descricao
 * @property double $valor
 * @property double $saldoAntes
 * @property double $saldoDepois
 * @property string $data
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Comissao[] $comissaos
 * @property Jogador $idjogador0
 * @property Partida $idpartida0
 * @property Torneio $idtorneio0
 */
class Jogmovimentacao extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Jogmovimentacao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jogmovimentacao';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idjogador', 'required'),
            array('idjogador, idpartida, idtorneio, status', 'numerical', 'integerOnly' => true),
            array('valor, saldoAntes, saldoDepois', 'numerical'),
            array('transacao', 'length', 'max' => 7),
            array('descricao', 'length', 'max' => 250),
            array('data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idjogmovimentacao, idjogador, idpartida, idtorneio, transacao, descricao, valor, saldoAntes, saldoDepois, data, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Comissoes' => array(self::HAS_MANY, 'Comissao', 'idjogmovimentacao'),
            'Jogador' => array(self::BELONGS_TO, 'Jogador', 'idjogador'),
            'Partida' => array(self::BELONGS_TO, 'Partida', 'idpartida'),
            'Torneio' => array(self::BELONGS_TO, 'Torneio', 'idtorneio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idjogmovimentacao' => 'ID',
            'idjogador' => 'Jogador',
            'idpartida' => 'Partida',
            'idtorneio' => 'Torneio',
            'transacao' => 'Transação',
            'descricao' => 'Descrição',
            'valor' => 'Valor',
            'saldoAntes' => 'Saldo Antes',
            'saldoDepois' => 'Saldo Depois',
            'data' => 'Data',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idjogmovimentacao', $this->idjogmovimentacao);
        $criteria->compare('idjogador', $this->idjogador);
        $criteria->compare('idpartida', $this->idpartida);
        $criteria->compare('idtorneio', $this->idtorneio);
        $criteria->compare('transacao', $this->transacao, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('saldoAntes', $this->saldoAntes);
        $criteria->compare('saldoDepois', $this->saldoDepois);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('status', $this->status);
        
        $criteria->order = "data DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    
    public function getData($hora = false) {
        $formato = ($hora) ? "d/m/Y \à\s H\hi\m" : "d/m/Y";
        return date($formato, strtotime($this->data));
    }
    
    public function getTransacao() {
        $transacao = "";
        if($this->transacao=='credito'){
            $transacao .= "Crédito: ";
        }
        else{
            $transacao .= "Débito: ";
        }
        
        if($this->descricao=='deposito'){
            $transacao .= "Depósito";
        }
        else{
            $transacao .= ucwords($this->descricao);
        }
        return $transacao;
    }
    
    
    public function getValor($coluna) {
        return number_format($this->$coluna,2,',','.');
    }
    public function setValor($coluna, $valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->$coluna=$valor;
    }
}
