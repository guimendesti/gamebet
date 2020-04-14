<?php

/**
 * This is the model class for table "pagina".
 *
 * The followings are the available columns in table 'pagina':
 * @property integer $idpagina
 * @property string $nome
 * @property string $apelido
 * @property string $descricao
 * @property string $conteudo
 * @property integer $status
 */
class Pagina extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Pagina the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pagina';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, apelido', 'required'),
            array('status', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 50),
            array('apelido', 'length', 'max' => 30),
            array('descricao', 'length', 'max' => 250),
            array('conteudo', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idpagina, nome, apelido, descricao, conteudo, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idpagina' => 'ID',
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'descricao' => 'Descrição',
            'conteudo' => 'Conteúdo',
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

        $criteria->compare('idpagina', $this->idpagina);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('apelido', $this->apelido, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('conteudo', $this->conteudo, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
