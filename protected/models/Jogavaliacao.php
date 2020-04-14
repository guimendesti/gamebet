<?php

/**
 * This is the model class for table "jogavaliacao".
 *
 * The followings are the available columns in table 'jogavaliacao':
 * @property integer $idjog_avaliacao
 * @property integer $idpartida
 * @property integer $avaliado
 * @property integer $avaliador
 * @property double $avaliacao
 * @property string $observacao
 * @property integer $moderacao
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Partida $idpartida0
 * @property Jogador $avaliado0
 * @property Jogador $avaliador0
 */
class Jogavaliacao extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Jogavaliacao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jogavaliacao';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idjog_avaliacao, idpartida, avaliado, avaliador, avaliacao', 'required'),
            array('idjog_avaliacao, idpartida, avaliado, avaliador, moderacao, status', 'numerical', 'integerOnly' => true),
            array('avaliacao', 'numerical'),
            array('observacao', 'length', 'max' => 250),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idjog_avaliacao, idpartida, avaliado, avaliador, avaliacao, observacao, moderacao, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'partida' => array(self::BELONGS_TO, 'Partida', 'idpartida'),
            'avaliado' => array(self::BELONGS_TO, 'Jogador', 'avaliado'),
            'avaliador' => array(self::BELONGS_TO, 'Jogador', 'avaliador'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idjog_avaliacao' => 'ID',
            'idpartida' => 'Partida',
            'avaliado' => 'Avaliado',
            'avaliador' => 'Avaliador',
            'avaliacao' => 'Avaliação',
            'observacao' => 'Observação',
            'moderacao' => 'Moderação',
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

        $criteria->compare('idjog_avaliacao', $this->idjog_avaliacao);
        $criteria->compare('idpartida', $this->idpartida);
        $criteria->compare('avaliado', $this->avaliado);
        $criteria->compare('avaliador', $this->avaliador);
        $criteria->compare('avaliacao', $this->avaliacao);
        $criteria->compare('observacao', $this->observacao, true);
        $criteria->compare('moderacao', $this->moderacao);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
