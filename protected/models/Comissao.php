<?php

/**
 * This is the model class for table "comissao".
 *
 * The followings are the available columns in table 'comissao':
 * @property integer $idcomissao
 * @property integer $idjogmovimentacao
 * @property double $valor
 * @property double $saldoAntes
 * @property double $saldoDepois
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Jogmovimentacao $idjogmovimentacao0
 */
class Comissao extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comissao';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idjogmovimentacao', 'required'),
            array('idjogmovimentacao', 'numerical', 'integerOnly' => true),
            array('valor, saldoAntes, saldoDepois', 'numerical'),
            array('data', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idcomissao, idjogmovimentacao, valor, saldoAntes, saldoDepois, data', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Movimentacao' => array(self::BELONGS_TO, 'Jogmovimentacao', 'idjogmovimentacao'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idcomissao' => 'ID',
            'idjogmovimentacao' => 'Movimentação',
            'valor' => 'Valor',
            'saldoAntes' => 'Saldo Antes',
            'saldoDepois' => 'Saldo Depois',
            'data' => 'Data',
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

        $criteria->compare('idcomissao', $this->idcomissao);
        $criteria->compare('idjogmovimentacao', $this->idjogmovimentacao);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('saldoAntes', $this->saldoAntes);
        $criteria->compare('saldoDepois', $this->saldoDepois);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comissao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getData($hora = false) {
        $formato = ($hora) ? "d/m/Y \à\s H\hi\m" : "d/m/Y";
        return date($formato, strtotime($this->data));
    }

    public function getValor($coluna) {
        return number_format($this->$coluna, 2, ',', '.');
    }

    public function setValor($coluna, $valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->$coluna = $valor;
    }

}
