<?php

/**
 * This is the model class for table "jogestatistica".
 *
 * The followings are the available columns in table 'jogestatistica':
 * @property integer $idjog_estatistica
 * @property integer $idjogador
 * @property integer $idconsole
 * @property integer $idgame
 * @property integer $partidas
 * @property integer $vitorias
 * @property integer $empates
 * @property integer $torneios
 * @property integer $torneiosGanhos
 * @property integer $torneiosPartidas
 * @property integer $torneiosVitorias
 *
 * The followings are the available model relations:
 * @property Jogador $idjogador0
 * @property Console $idconsole0
 * @property Game $idgame0
 */
class Jogestatistica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jogestatistica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idjog_estatistica, idjogador, idconsole, idgame', 'required'),
			array('idjog_estatistica, idjogador, idconsole, idgame, partidas, vitorias, empates, torneios, torneiosGanhos, torneiosPartidas, torneiosVitorias', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idjog_estatistica, idjogador, idconsole, idgame, partidas, vitorias, empates, torneios, torneiosGanhos, torneiosPartidas, torneiosVitorias', 'safe', 'on'=>'search'),
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
			'idconsole0' => array(self::BELONGS_TO, 'Console', 'idconsole'),
			'idgame0' => array(self::BELONGS_TO, 'Game', 'idgame'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idjog_estatistica' => 'Idjog Estatistica',
			'idjogador' => 'Idjogador',
			'idconsole' => 'Idconsole',
			'idgame' => 'Idgame',
			'partidas' => 'Partidas',
			'vitorias' => 'Vitorias',
			'empates' => 'Empates',
			'torneios' => 'Torneios',
			'torneiosGanhos' => 'Torneios Ganhos',
			'torneiosPartidas' => 'Torneios Partidas',
			'torneiosVitorias' => 'Torneios Vitorias',
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

		$criteria->compare('idjog_estatistica',$this->idjog_estatistica);
		$criteria->compare('idjogador',$this->idjogador);
		$criteria->compare('idconsole',$this->idconsole);
		$criteria->compare('idgame',$this->idgame);
		$criteria->compare('partidas',$this->partidas);
		$criteria->compare('vitorias',$this->vitorias);
		$criteria->compare('empates',$this->empates);
		$criteria->compare('torneios',$this->torneios);
		$criteria->compare('torneiosGanhos',$this->torneiosGanhos);
		$criteria->compare('torneiosPartidas',$this->torneiosPartidas);
		$criteria->compare('torneiosVitorias',$this->torneiosVitorias);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jogestatistica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
