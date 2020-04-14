<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Rabbitbet',
    'theme' => 'rabbitbet042016',
    'layout' => 'site',
    'sourceLanguage' => 'pt-br',
    'language' => 'pt-br',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        'admin',
        'jogador',
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'pass',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'admin' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => 1,
            'class' => 'CWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => 'admin/login',
        ),
        'jogador' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => 1,
            'class' => 'CWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => 'jogador/login',
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'showScriptName'=>false,
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */
        'session' => array(
            'autoStart' => true,
        // other stuff...
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                
                'regras' => 'site/regras',
                'comofunciona' => 'site/comofunciona',
                'contato' => 'site/contato',
                
                'jogar' => 'jogador/jogar/index',
                
                'global' => 'jogador/jogar/global',
                'global/cancelar/<cancelar>' => 'jogador/jogar/global',
                'global/aceitar/<aceitar>' => 'jogador/jogar/global',
                'global/recusar/<recusar>' => 'jogador/jogar/global',
                
                'privado' => 'jogador/jogar/privado',
                'privado/desafiado' => 'jogador/jogar/privado/desafiado/1',
                'privado/cancelar/<cancelar>' => 'jogador/jogar/privado',
                'privado/aceitar/<aceitar>' => 'jogador/jogar/privado',
                'privado/recusar/<recusar>' => 'jogador/jogar/privado',
                
                'torneios' => 'jogador/torneios',
                'torneios/inscrever/<inscrever>' => 'jogador/torneios/inscrever',
                'torneios/cancelar/<cancelar>' => 'jogador/torneios/cancelar',
                'torneios/<sala>' => 'jogador/torneios/sala',
                
                'jogador/login' => 'jogador/default/login',
                'jogador/sair' => 'jogador/default/sair',
                
                'jogador/partidas/cancelar/<cancelar>' => 'jogador/partidas/index',
                
                'admin/login' => 'admin/default/login',
                'admin/sair' => 'admin/default/sair',
                'admin/alterarSenha' => 'admin/default/alterarSenha',
                 
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=rabbitbet',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '', 
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            /* array(
                 'class'=>'CProfileLogRoute',
                 'levels'=>'profile',
                 'enabled'=>true,
             ),*/
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
