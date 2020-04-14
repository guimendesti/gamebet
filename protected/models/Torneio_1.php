<?php

/**
 * This is the model class for table "torneio".
 *
 * The followings are the available columns in table 'torneio':
 * @property integer $idtorneio
 * @property integer $idconsole
 * @property integer $idgame
 * @property string $nome
 * @property string $descricao
 * @property integer $jogadores
 * @property double $valor
 * @property string $imagem
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Jogmovimentacao[] $jogmovimentacaos
 * @property Partida[] $partidas
 * @property Console $idconsole0
 * @property Game $idgame0
 * @property Torneioinscricao[] $torneioinscricaos
 */
class Torneio extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Torneio the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'torneio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idconsole, idgame, nome, jogadores', 'required', 
                    'message' => '\'{attribute}\' obrigatório'),
            array('idconsole, idgame, jogadores', 'numerical', 'integerOnly' => true),
            array('idconsole, idgame, jogadores', 'numerical', 
                        'min' => '1', 
                        'tooSmall' => 'Selecione uma opção válida'),
            array('valor', 'numerical'),
            array('nome', 'length', 'max' => 100),
            array('descricao', 'safe'),
            array('imagem', 'length', 'max' => 250),
            array('status', 'length', 'max' => 9),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idtorneio, idconsole, idgame, nome, descricao, jogadores, valor, imagem, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Movimentacoes' => array(self::HAS_MANY, 'Jogmovimentacao', 'idtorneio'),
            'Partidas' => array(self::HAS_MANY, 'Partida', 'idtorneio'),
            'Console' => array(self::BELONGS_TO, 'Console', 'idconsole'),
            'Game' => array(self::BELONGS_TO, 'Game', 'idgame'),
            'Inscricoes' => array(self::HAS_MANY, 'Torneioinscricao', 'idtorneio'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idtorneio' => 'ID',
            'idconsole' => 'Console',
            'idgame' => 'Game',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'jogadores' => 'Jogadores',
            'valor' => 'Valor',
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

        $criteria->compare('idtorneio', $this->idtorneio);
        $criteria->compare('idconsole', $this->idconsole);
        $criteria->compare('idgame', $this->idgame);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('jogadores', $this->jogadores);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    
    
    public function getStatus() {
        
        $status = $this->status;
        if($status == "aberto"){
            return "<span class='label label-info'>Aberto</span>";
        }
        elseif($status == "fechado"){
            return "<span class='label label-danger'>Fechado</span>";
        }
        elseif($status == "andamento"){
            return "<span class='label label-primary'>Andamento</span>";
        }
        elseif($status == "concluido"){
            return "<span class='label label-success'>Concluído</span>";
        }
        else{
            return "<small style='color:#999;'>Cancelado</small>";
        }
    }
    
    public function listaStatus(){
        return array('aberto' => 'Aberto',
                    'fechado' => 'Fechado', 
                    'andamento' => 'Andamento', 
                    'concluido' => 'Concluído', 
                    'cancelado' => 'Cancelado');
    }
    
    
    
    public function getValor() {
        return number_format($this->valor,2,',','.');
    }
    public function setValor($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->valor=$valor;
    }
    
    
    
    public function getNomeUrl(){
        $nome = str_replace(' ', '', trim($this->nome) );
        $nome = preg_replace('![\\/\\?\\!\\(\\):-]+!u', '-', $nome );
        return ($nome);
    }
    
    
    public function getNumInscritos(){
        return Torneioinscricao::model()->count('idtorneio=' . $this->idtorneio);
    }
    
    
    public function gerarEtapa(){
        return Torneioinscricao::model()->count('idtorneio=' . $this->idtorneio);
    }
}
