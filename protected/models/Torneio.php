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
 * @property integer $etapa
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
            array('idconsole, idgame, jogadores, etapa', 'numerical', 'integerOnly' => true),
            array('idconsole, idgame, jogadores', 'numerical', 
                        'min' => '1', 
                        'tooSmall' => 'Selecione uma opção válida'),
            array('valor', 'numerical'),
            array('nome', 'length', 'max' => 100),
            array('imagem', 'length', 'max' => 250),
            array('status', 'length', 'max' => 9),
            array('descricao', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idtorneio, idconsole, idgame, nome, descricao, jogadores, valor, imagem, etapa, status', 'safe', 'on' => 'search'),
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
            'etapa' => 'Etapa',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idtorneio', $this->idtorneio);
        $criteria->compare('idconsole', $this->idconsole);
        $criteria->compare('idgame', $this->idgame);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('jogadores', $this->jogadores);
        $criteria->compare('valor', $this->valor);
        $criteria->compare('imagem', $this->imagem, true);
        $criteria->compare('etapa', $this->etapa);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Torneio the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
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

    public function listaEtapas() {
        return array(2 => 'Final',
            4 => 'Semi',
            8 => 'Quartas',
            16 => 'Oitavas');
    }
    
    
    
    public function getValor() {
        return number_format($this->valor,2,',','.');
    }
    public function setValor($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("", ".", $valor);
        $this->valor=$valor;
    }

    public function getValorPremio($formatar = false) {
        $premio = $this->valor * $this->jogadores;// equipe: substituir "2" pelo numero de jogadores
        return ($formatar) ? number_format($premio, 2, ',', '.') : $premio;
    }
    public function getValorCredito($formatar = false) {
        $credito = $this->getValorPremio() * 0.8; // 80% para jogador (20% comissão)
        return ($formatar) ? number_format($credito, 2, ',', '.') : $credito;
    }
    public function getValorComissao($formatar = false) {
        $comissao = $this->getValorPremio() - $this->getValorCredito();
        return ($formatar) ? number_format($comissao, 2, ',', '.') : $comissao;
    }
    
    
    
    public function getNomeUrl(){
        $nome = str_replace(' ', '', trim($this->nome) );
        $nome = preg_replace('![\\/\\?\\!\\(\\):-]+!u', '-', $nome );
        return ($nome);
    }
    
    
    public function getNumInscritos(){
        return Torneioinscricao::model()->count('idtorneio=' . $this->idtorneio);
    }
    
    public function getPartidasEtapas($etapa = false){
        $etapa = (!$etapa) ? $this->etapa : $etapa;
        return Partida::model()->findAll('idtorneio=' . $this->idtorneio
                                    ." AND torneioEtapa='".$etapa."'");
    }
    
    public function gerarEtapa(){
        $etapa = $this->etapa;
        if($etapa < $this->jogadores){
            $etapaAnterior = $etapa*2;
            $partidaAberta = Partida::model()->count('idtorneio=' . $this->idtorneio
                                                    ." AND torneioEtapa='".$etapaAnterior."'"
                                                    ." AND (ganhador IS NULL"
                                                    ." OR status!='concluida')");
            
            print_r($partidaAberta);exit;
        }
        else{
            if($this->getNumInscritos() == $this->jogadores){
                $inscritos = $this->Inscricoes;
                shuffle($inscritos); // sorteio de vagas
                $vaga = 1;
                $inscAnterior = false;
                foreach($inscritos as $inscricao){
                    $inscricao->vaga = $vaga;
                    $inscricao->save();
                    if($vaga%2 == 0 && $inscAnterior>0){
                        $this->gerarPartidaEtapa($inscAnterior, $inscricao->idjogador);
                        $inscAnterior = false;
                    }
                    else{
                        $inscAnterior = $inscricao->idjogador;
                    }
                    $vaga++;
                }
                return true;
            }
        }
        return false;
    }
    
    private function gerarPartidaEtapa($jogador1, $jogador2){
        
        $dataAgora = date('Y-m-d H:i:s');
        
        $partida = new Partida;
        $partida->idconsole = $this->idconsole;
        $partida->idgame = $this->idgame;
        $partida->idtorneio = $this->idtorneio;
        $partida->torneioEtapa = $this->etapa;
        $partida->dataCriacao = $dataAgora;
        $partida->dataAgendada = $dataAgora;
        $partida->status = 'agendada';
        if($partida->save(false)){
            // Salva Jogadores                
            $pJogador1 = new Partidajogador;
            $pJogador1->idpartida = $partida->idpartida;
            $pJogador1->idjogador = $jogador1;
            $pJogador1->equipe = 'A';
            $pJogador1->save(false);

            $pJogador2 = new Partidajogador;
            $pJogador2->idpartida = $partida->idpartida;
            $pJogador2->idjogador = $jogador2;
            $pJogador2->equipe = 'B';
            $pJogador2->save(false);
            
            return true;
        }
        return false;
        
    }

}
