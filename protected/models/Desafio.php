<?php

/**
 * This is the model class for table "desafio".
 *
 * The followings are the available columns in table 'desafio':
 * @property integer $iddesafio
 * @property integer $idconsole
 * @property integer $idgame
 * @property integer $desafiado
 * @property integer $desafiante
 * @property string $dataDesafio
 * @property string $mensagemDesafio
 * @property double $valor
 * @property string $dataResposta
 * @property string $mensagemResposta
 * @property integer $resposta
 * @property string $tipo
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Console $Console
 * @property Game $Game
 * @property Jogador $Desafiado
 * @property Jogador $Desafiante
 * @property Partida[] $Partidas
 */
class Desafio extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'desafio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idconsole, idgame, desafiante', 'required',
                'message' => '\'{attribute}\' obrigatório'),
            array('idconsole, idgame, desafiado, desafiante, resposta, status', 'numerical', 'integerOnly' => true),
            array('idconsole, idgame, desafiado, desafiante', 'numerical',
                    'min' => '1',
                'tooSmall' => 'Opção inválida'),
            array('valor', 'numerical',
                    'min' => '1',
                'tooSmall' => 'Valor Inválido'),
            array('valor', 'required',
                'message' => 'Valor Inválido'),
            array('mensagemDesafio, mensagemResposta', 'length', 'max' => 45),
            array('tipo, status', 'length', 'max' => 9),
            array('dataDesafio, dataResposta', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('iddesafio, idconsole, idgame, desafiado, desafiante, dataDesafio, mensagemDesafio, valor, dataResposta, mensagemResposta, resposta, tipo, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Console' => array(self::BELONGS_TO, 'Console', 'idconsole'),
            'Game' => array(self::BELONGS_TO, 'Game', 'idgame'),
            'Desafiado' => array(self::BELONGS_TO, 'Jogador', 'desafiado'),
            'Desafiante' => array(self::BELONGS_TO, 'Jogador', 'desafiante'),
            'Partidas' => array(self::HAS_MANY, 'Partida', 'iddesafio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'iddesafio' => 'ID',
            'idconsole' => 'Console',
            'idgame' => 'Game',
            'desafiado' => 'Desafiado',
            'desafiante' => 'Desafiante',
            'dataDesafio' => 'Data Desafio',
            'mensagemDesafio' => 'Desafio',
            'valor' => 'Valor',
            'dataResposta' => 'Data Resposta',
            'mensagemResposta' => 'Resposta',
            'resposta' => 'Resposta',
            'tipo' => 'Tipo',
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

        $criteria->compare('iddesafio', $this->iddesafio);
        $criteria->compare('idconsole', $this->idconsole);
        $criteria->compare('idgame', $this->idgame);
        $criteria->compare('desafiado', $this->desafiado);
        $criteria->compare('desafiante', $this->desafiante);
        $criteria->compare('dataDesafio', $this->dataDesafio, true);
        $criteria->compare('mensagemDesafio', $this->mensagemDesafio, true);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('dataResposta', $this->dataResposta, true);
        $criteria->compare('mensagemResposta', $this->mensagemResposta, true);
        $criteria->compare('resposta', $this->resposta);
        $criteria->compare('tipo', $this->tipo);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Desafio the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    
    
    public function getData($coluna = false, $hora = false) {
        if($coluna==false){
            if($this->status == "espera"){
                $coluna = 'dataDesafio';
            }
            else{
                $coluna = 'dataResposta';
            }
        }
        $formato = ($hora) ? "d/m/Y \à\s H\hi\m" : "d/m/Y";
        return date($formato, strtotime($this->$coluna));
    }
    
    
    public function getStatus() {
        if($this->status == "espera"){
            return "<span class='label label-primary'>Espera</span>";
        }
        elseif($this->status == "aceito"){
            return "<span class='label label-success'>Aceito</span>";
        }
        else{
            return "<span class='label label-danger'>Recusado</span>";
        }
    }
    
    public function listaStatus(){
        return array('espera' => 'Espera', 
                    'aceito' => 'Aceito', 
                    'recusado' => 'Recusado');
    }
    
    public function getDataAtualizacao() {
        if($this->status == "espera"){
            return $this->dataDesafio;
        }
        else{
            return $this->dataResposta;
        }
    }
    
    
    public function getValor() {
        return number_format($this->valor,2,',','.');
    }
    public function setValor($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->valor=$valor;
    }
    
    
    


}
