<?php

class TorneioFiltro extends CFormModel {

    public $idconsole;
    public $idgame;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('idconsole, idgame', 'required',
                'message' => '\'{attribute}\' obrigatório'),
            array('idconsole, idgame', 'numerical',
                'integerOnly' => true,
                'min' => '1',
                'tooSmall' => 'Opção inválida'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {

        return array(
            'idconsole' => 'Console',
            'idgame' => 'Game',
        );
    }

}
