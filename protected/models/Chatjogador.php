<?php

/**
 * This is the model class for table "chatjogador".
 *
 * The followings are the available columns in table 'chatjogador':
 * @property integer $idchatjogador
 * @property integer $idjogador
 * @property string $ultimoacesso
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Jogador $idjogador0
 */
class Chatjogador extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chatjogador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idjogador', 'required'),
			array('idjogador, status', 'numerical', 'integerOnly'=>true),
			array('ultimoacesso', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idchatjogador, idjogador, ultimoacesso, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idjogador0' => array(self::BELONGS_TO, 'Jogador', 'idjogador'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idchatjogador' => 'Idchatjogador',
			'idjogador' => 'Idjogador',
			'ultimoacesso' => 'Ultimoacesso',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idchatjogador',$this->idchatjogador);
		$criteria->compare('idjogador',$this->idjogador);
		$criteria->compare('ultimoacesso',$this->ultimoacesso,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Chatjogador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
