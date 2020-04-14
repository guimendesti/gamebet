<?php

/**
 * This is the model class for table "jogdisponivel".
 *
 * The followings are the available columns in table 'jogdisponivel':
 * @property integer $idjog_disponivel
 * @property integer $idjogador
 * @property integer $idconsole
 * @property integer $idgame
 * @property string $dataCriacao
 * @property string $dataValidade
 *
 * The followings are the available model relations:
 * @property Jogador $idjogador0
 * @property Console $idconsole0
 * @property Game $idgame0
 */
class Jogdisponivel extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Jogdisponivel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jogdisponivel';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idjogador, idconsole, idgame', 'required'),
            array('idjogador, idconsole, idgame', 'numerical', 'integerOnly' => true),
            array('dataCriacao, dataValidade', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idjog_disponivel, idjogador, idconsole, idgame, dataCriacao, dataValidade', 'safe', 'on' => 'search'),
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
            'Console' => array(self::BELONGS_TO, 'Console', 'idconsole'),
            'Game' => array(self::BELONGS_TO, 'Game', 'idgame'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idjog_disponivel' => 'ID',
            'idjogador' => 'Jogador',
            'idconsole' => 'Console',
            'idgame' => 'Game',
            'dataCriacao' => 'Data Criação',
            'dataValidade' => 'Data Validade',
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

        $criteria->compare('idjog_disponivel', $this->idjog_disponivel);
        $criteria->compare('idjogador', $this->idjogador);
        $criteria->compare('idconsole', $this->idconsole);
        $criteria->compare('idgame', $this->idgame);
        $criteria->compare('dataCriacao', $this->dataCriacao, true);
        $criteria->compare('dataValidade', $this->dataValidade, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
