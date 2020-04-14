<?php

/**
 * This is the model class for table "game".
 *
 * The followings are the available columns in table 'game':
 * @property integer $idgame
 * @property string $nome
 * @property string $descricao
 * @property string $imagem
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Console[] $consoles
 * @property Jogdisponivel[] $jogdisponivels
 * @property Partida[] $partidas
 * @property Torneio[] $torneios
 */
class Game extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Game the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'game';
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
            array('Consoles', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idgame, nome, descricao, imagem, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Consoles' => array(self::MANY_MANY, 'Console', 'consolegame(idgame, idconsole)'),
            'Disponiveis' => array(self::HAS_MANY, 'Jogdisponivel', 'idgame'),
            'Partidas' => array(self::HAS_MANY, 'Partida', 'idgame'),
            'Torneios' => array(self::HAS_MANY, 'Torneio', 'idgame'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idgame' => 'ID',
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

        $criteria->compare('idgame', $this->idgame);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('status', $this->status);
        
        //$criteria->with = array('Consoles');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
 
    
    public function renderConsoles(){
        $consoles = "";
        if(count($this->Consoles) > 0){
            
            foreach($this->Consoles as $console){
                
                $consoles .= ($consoles != "") ? ", " : "";
                $consoles .= $console->nome;
                
            }
            
        }
        return $consoles;
    }
 
    
    public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior')
        );
    }

}
