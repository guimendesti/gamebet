<?php

/**
 * This is the model class for table "jogsaque".
 *
 * The followings are the available columns in table 'jogsaque':
 * @property integer $idjogsaque
 * @property integer $idjogador
 * @property string $data
 * @property double $valor
 * @property integer $situacao
 *
 * The followings are the available model relations:
 * @property Jogador $idjogador0
 */
class Jogsaque extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jogsaque';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idjogador', 'required'),
            array('idjogador, situacao', 'numerical', 'integerOnly' => true),
            array('valor', 'numerical'),
            array('data', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idjogsaque, idjogador, data, valor, situacao', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Jogador' => array(self::BELONGS_TO, 'Jogador', 'idjogador'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idjogsaque' => 'ID',
            'idjogador' => 'Jogador',
            'data' => 'Data',
            'valor' => 'Valor',
            'situacao' => 'Situação',
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

        $criteria->compare('idjogsaque', $this->idjogsaque);
        $criteria->compare('idjogador', $this->idjogador);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('situacao', $this->situacao);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Jogsaque the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getData($hora = false) {
        $formato = ($hora) ? "d/m/Y \à\s H\hi\m" : "d/m/Y";
        return date($formato, strtotime($this->data));
    }

    public function getValor() {
        return number_format($this->valor, 2, ',', '.');
    }

    public function setValor($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->valor = $valor;
    }

    public function listaSituacao() {
        return array('0' => 'Cancelado',
            '1' => 'Pago',
            '2' => 'Pendente',
            '3' => 'Moderação',);
    }

    public function getSituacao() {
        $situacoes = $this->listaSituacao();
        $atual = ($this->situacao < 1 || $this->situacao > 3) ? 0 : $this->situacao;
        $situacao = $situacoes[$atual];
        return $situacao;
    }

}
