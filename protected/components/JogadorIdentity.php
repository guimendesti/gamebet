<?php

class JogadorIdentity extends CUserIdentity
{
    private $idjogador;
    private $nome;
    
    public function authenticate()
    {
        $record=Jogador::model()->findByAttributes(array('email'=>$this->username));
        
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->senha!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            unset($record->senha);
            
            Yii::app()->session["loginJogador"] = $record->attributes;
            Yii::app()->session["loginJogadorID"] = $record->idjogador;
            
            $this->idjogador=$record->idjogador;
            $this->nome=$record->nome;
            $this->setState('returnUrl',array('/jogador'));
            $this->setState('jogador', $record);
            
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->idjogador;
    }
 
    public function getNome()
    {
        return $this->nome;
    }
}