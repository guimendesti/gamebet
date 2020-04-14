<?php

/**
 * This is the model class for table "jogador".
 *
 * The followings are the available columns in table 'jogador':
 * @property integer $idjogador
 * @property string $idPsn
 * @property string $idXbox
 * @property string $idOrigin
 * @property string $avatar
 * @property string $nome
 * @property integer $cpf
 * @property string $email
 * @property string $usuario
 * @property string $senha
 * @property string $genero
 * @property string $nascimento
 * @property string $tel1
 * @property string $tel2
 * @property string $endereco
 * @property string $bairro
 * @property string $cidade
 * @property string $uf
 * @property string $cep
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Desafio[] $desafios
 * @property Desafio[] $desafios1
 * @property Jogavaliacao[] $jogavaliacaos
 * @property Jogavaliacao[] $jogavaliacaos1
 * @property Jogdisponivel[] $jogdisponivels
 * @property Jogmovimentacao[] $jogmovimentacaos
 * @property Partida[] $partidas
 */
class Jogador extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Jogador the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jogador';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, usuario, senha', 'required',
                'message' => '\'{attribute}\' obrigatório'),
            array('cpf, status', 'numerical', 'integerOnly' => true),
            array('idPsn, idXbox, idOrigin, bairro, cidade', 'length', 'max' => 50),
            array('nome, email, endereco', 'length', 'max' => 150),
            array('cpf', 'length', 'max' => 11),
            array('usuario', 'length', 'max' => 30),
            array('avatar, senha', 'length', 'max' => 250),
            array('genero', 'length', 'max' => 1),
            array('tel1, tel2', 'length', 'max' => 25),
            array('uf', 'length', 'max' => 2),
            array('cep', 'length', 'max' => 10),
            array('nascimento', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idjogador, idPsn, idXbox, idOrigin, avatar, nome, cpf, email, usuario, senha, genero, nascimento, tel1, tel2, endereco, bairro, cidade, uf, cep, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Desafiados' => array(self::HAS_MANY, 'Desafio', 'desafiado'),
            'Desafiantes' => array(self::HAS_MANY, 'Desafio', 'desafiante'),
            'Avaliados' => array(self::HAS_MANY, 'Jogavaliacao', 'avaliado'),
            'Avaliadores' => array(self::HAS_MANY, 'Jogavaliacao', 'avaliador'),
            'Disponiveis' => array(self::HAS_MANY, 'Jogdisponivel', 'idjogador'),
            'Movimentacoes' => array(self::HAS_MANY, 'Jogmovimentacao', 'idjogador'),
            'Partidas' => array(self::MANY_MANY, 'Partida', 'partidajogador(idjogador, idpartida)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idjogador' => 'ID',
            'idPsn' => 'ID Psn',
            'idXbox' => 'ID Xbox',
            'idOrigin' => 'ID Origin',
            'avatar' => 'Avatar',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'E-mail',
            'usuario' => 'Usuário',
            'senha' => 'Senha',
            'genero' => 'Genêro',
            'nascimento' => 'Nascimento',
            'tel1' => 'Telefone 1',
            'tel2' => 'Telefone 2',
            'endereco' => 'Endereço',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'uf' => 'UF',
            'cep' => 'CEP',
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

        $criteria->compare('idjogador', $this->idjogador);
        $criteria->compare('idPsn', $this->idPsn, true);
        $criteria->compare('idXbox', $this->idXbox, true);
        $criteria->compare('idOrigin', $this->idOrigin, true);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cpf', $this->cpf);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('usuario', $this->usuario, true);
        $criteria->compare('senha', $this->senha, true);
        $criteria->compare('genero', $this->genero, true);
        $criteria->compare('nascimento', $this->nascimento, true);
        $criteria->compare('tel1', $this->tel1, true);
        $criteria->compare('tel2', $this->tel2, true);
        $criteria->compare('endereco', $this->endereco, true);
        $criteria->compare('bairro', $this->bairro, true);
        $criteria->compare('cidade', $this->cidade, true);
        $criteria->compare('uf', $this->uf, true);
        $criteria->compare('cep', $this->cep, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getGenero() {
        return ($this->genero == 'f') ? 'Feminino' : ( ($this->genero == 'm') ? 'Masculino' : '' );
    }

    public function getNascimento() {
        return date("d/m/Y", strtotime($this->nascimento));
    }

    public function getSaldoAtual($formata = true) {
        $saldo = Jogmovimentacao::model()->findAll(array('order' => 'data DESC',
            'condition' => 'idjogador=' . $this->idjogador.' AND status=1',
            'limit' => '1'));

        if (isset($saldo[0])) {
            $saldoAtual = $saldo[0]->saldoDepois;
            return ($formata) ? number_format($saldoAtual, 2, ',', '.') : $saldoAtual;
        } else {
            return ($formata) ? "0,00" : 0;
        }
    }

    public function getAvaliacao($returnStars = true) {
        $avaliacao = Jogavaliacao::model()->findAll(array('select' => 'SUM(avaliacao) as avaliacao, COUNT(avaliador) as avaliador',
            'condition' => 'avaliado=' . $this->idjogador.' AND moderacao=0  AND status=1'));
        
        $avaValor = 0;
        $avaAvaliadores = 0;
        if (isset($avaliacao[0])) {
            $avaValor = (!is_null($avaliacao[0]->avaliacao)) 
                    ? number_format($avaliacao[0]->avaliacao,2,'.','') 
                    : 0;
            $avaAvaliadores = $avaliacao[0]->avaliador;
        }

        $avaliadorStr = ($avaAvaliadores > 1)
                    ? $avaAvaliadores." avaliadores" 
                    : $avaAvaliadores." avaliador";
        $avaTitle = $avaValor." (".$avaliadorStr.")";
        
        if ($returnStars) {
            
            // Tooltip: data-toggle='tooltip' data-placement='bottom' 
            $return = "<span class='avaliacaoStar' title='".$avaTitle."'>";
            
            // estrela cheia
            $stars = floor($avaValor);
            // meia estrela
            $decimos = 0;
            if(strpos($avaValor,".")!==false){
                $decimos = end(explode(".",$avaValor));
            }
            $hStars = ($decimos > 30 && $decimos < 90) ? 1 : 0;
            // estrela vazia
            $oStars = 5-($stars+$hStars);
            
            //monta estrelas
            if($stars > 0){
                for($s=0; $s<$stars; $s++){
                    $return .= '<i class="fa fa-star"></i>';
                }
            }
            if($hStars > 0){
                $return .= '<i class="fa fa-star-half-o"></i>';
            }
            if($oStars > 0){
                for($s=0; $s<$oStars; $s++){
                    $return .= '<i class="fa fa-star-o"></i>';
                }
            }
                                        
            $return .= "</span>";
            return $return;
            
        } else {
            return $avaTitle;
        }
    }

}
