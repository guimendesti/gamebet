<?php

/**
 * This is the model class for table "torneioinscricao".
 *
 * The followings are the available columns in table 'torneioinscricao':
 * @property integer $idtorneioinscricao
 * @property integer $idtorneio
 * @property integer $idjogador
 * @property integer $vaga
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Torneio $idtorneio0
 * @property Jogador $idjogador0
 */
class Torneioinscricao extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'torneioinscricao';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idtorneio, idjogador', 'required'),
            array('idtorneio, idjogador, vaga', 'numerical', 'integerOnly' => true),
            array('data', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idtorneioinscricao, idtorneio, idjogador, vaga, data', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Torneio' => array(self::BELONGS_TO, 'Torneio', 'idtorneio'),
            'Jogador' => array(self::BELONGS_TO, 'Jogador', 'idjogador'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idtorneioinscricao' => 'ID',
            'idtorneio' => 'Torneio',
            'idjogador' => 'Jogador',
            'vaga' => 'Vaga',
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

        $criteria->compare('idtorneioinscricao', $this->idtorneioinscricao);
        $criteria->compare('idtorneio', $this->idtorneio);
        $criteria->compare('idjogador', $this->idjogador);
        $criteria->compare('vaga', $this->vaga);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Torneioinscricao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
