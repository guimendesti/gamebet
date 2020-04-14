<?php

class AdminIdentity extends CUserIdentity
{
    private $_idadmin;
    private $_nome;
    
    public function authenticate()
    {
        $record=Admin::model()->findByAttributes(array('usuario'=>$this->username));
        
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->senha!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            unset($record->senha);
            
            Yii::app()->session["loginAdmin"] = $record->attributes;
            Yii::app()->session["loginAdminID"] = $record->idadmin;
            
            $this->_idadmin=$record->idadmin;
            $this->_nome=$record->nome;
            $this->setState('returnUrl',array('/admin'));
            $this->setState('admin', $record);
            
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_idadmin;
    }
 
    public function getNome()
    {
        return $this->_nome;
    }
}