<?php

/**
 * This is the model class for table "console".
 *
 * The followings are the available columns in table 'console':
 * @property integer $idconsole
 * @property string $nome
 * @property string $descricao
 * @property string $imagem
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Game[] $games
 * @property Jogdisponivel[] $jogdisponivels
 * @property Partida[] $partidas
 * @property Torneio[] $torneios
 */
class Console extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Console the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'console';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome', 'required', 'message' => '\'{attribute}\' obrigatório'),
            array('status', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 50),
            array('imagem, descricao', 'length', 'max' => 250),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idconsole, nome, descricao, imagem, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Games' => array(self::MANY_MANY, 'Game', 'consolegame(idconsole, idgame)'),
            'Disponiveis' => array(self::HAS_MANY, 'Jogdisponivel', 'idconsole'),
            'Partidas' => array(self::HAS_MANY, 'Partida', 'idconsole'),
            'Torneios' => array(self::HAS_MANY, 'Torneio', 'idconsole'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idconsole' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'imagem' => 'Imagem',
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

        $criteria->compare('idconsole', $this->idconsole);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
