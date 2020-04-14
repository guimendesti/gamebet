<?php

class JogadorLoginForm extends CFormModel {

    public $email;
    public $senha;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('email', 'required',
                'message' => 'E-mail não informado.'),
            array('senha', 'required',
                'message' => 'Senha não informada.'),
            // password needs to be authenticated
            array('senha', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        /*
          return array(
          'lembrar'=>'Lembrar de mim',
          );
         */
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new JogadorIdentity($this->email, $this->senha);
            if (!$this->_identity->authenticate())
                $this->addError('password', 'E-mail ou senha inválido.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new JogadorIdentity($this->email, $this->senha);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === JogadorIdentity::ERROR_NONE) {
            //$duration = $this->lembrar ? 3600*24*30 : 0; // 30 days
            Yii::app()->jogador->login($this->_identity); //,$duration);
            return true;
        } else
            return false;
    }

    public function getIdentity() {
        if ($this->_identity !== null) {
            return $this->_identity;
        }
    }

}
