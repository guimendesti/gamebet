<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    //public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    
    
    public $jogadorLogado = false;

    protected function beforeAction($event) {

        date_default_timezone_set('America/Sao_Paulo');

        if (isset(Yii::app()->session['loginJogador'])) {
            // Dados Jogador
            $idjogador = Yii::app()->session['loginJogador']->getIdentity()->getId();
            $this->jogadorLogado = Jogador::model()->findByPk($idjogador);
            
            // Status Chat
            $chat = Chatjogador::model()->find('idjogador='.$idjogador);
            if(!($chat instanceof Chatjogador)){
                $chat = new Chatjogador;
                $chat->idjogador = $idjogador;
                $chat->status = 1;
            }
            $chat->ultimoacesso = date('Y-m-d H:i:s');
            $chat->save();
            
        }
        
        return true;
    }

    
    

    /**
     * Gera Lista de CONSOLES
     * 
     * @return array
     */
    public function listaConsoles($ativos = false, $returnJson = false) {
        $colID = 'idconsole';
        $tabela = 'console';
        $where = ($ativos) ? 'status = 1' : '';

        $qryRegs = Yii::app()->db->createCommand()
                ->select($colID . ', nome')
                ->from($tabela)
                ->where($where)
                ->order('nome')
                ->queryAll();

        $cRegs = count($qryRegs);
        $i = 1;
        $regs = ($returnJson) ? "" : false;
        foreach ($qryRegs as $reg) {
            if ($returnJson) {
                $regs .= "{label: '" . $reg["nome"] . "', value: '" . $reg[$colID] . "'}";
                $regs .= ($i < $cRegs) ? ", " : "";
            } else {
                $regs[$reg[$colID]] = $reg["nome"];
            }
        }

        return $regs;
    }

    /**
     * Gera Lista de GAMES
     * 
     * @return array
     */
    public function listaGames($ativos = false, $returnJson = false) {
        $colID = 'idgame';
        $tabela = 'game';
        $where = ($ativos) ? 'status = 1' : '';

        $qryRegs = Yii::app()->db->createCommand()
                ->select($colID . ', nome')
                ->from($tabela)
                ->where($where)
                ->order('nome')
                ->queryAll();

        $cRegs = count($qryRegs);
        $i = 1;
        $regs = "";
        foreach ($qryRegs as $reg) {
            $regs .= "{label: '" . $reg["nome"] . "', value: '" . $reg[$colID] . "'}";
            $regs .= ($i < $cRegs) ? ", " : "";
        }

        return $regs;
    }

    /**
     * Gera Lista de GAMES por Console
     * 
     * @param int $idconsole De qual Console deseja listar os Games
     * @param bool $returnArr Retorna lista em Array?
     * 
     * @return string/array
     */
    public function listaGamesConsole($idconsole, $returnArr = false) {

        $options = "";
        if ($idconsole > 0) {
            $data = Consolegame::model()->findAll('idconsole=' . $idconsole);
            $data = CHtml::listData($data, 'idgame', 'idgame');
            if (count($data) > 0) {
                if ($returnArr) {
                    $options[0] = CHtml::encode('Selecione ...');
                } else {
                    $options .= CHtml::tag('option', array('value' => ''), CHtml::encode('Selecione ...'), true);
                }

                foreach ($data as $idgame) {
                    $game = Game::model()->findByPk($idgame);
                    if ($returnArr) {
                        $options[$game->idgame] = CHtml::encode($game->nome);
                    } else {
                        $options .= CHtml::tag('option', array('value' => $game->idgame), CHtml::encode($game->nome), true);
                    }
                }
            } else {
                if ($returnArr) {
                    $options[0] = CHtml::encode('Nenhum game encontrado');
                } else {
                    $options .= CHtml::tag('option', array('value' => ''), CHtml::encode('Nenhum game encontrado'), true);
                }
            }
        } else {
            if ($returnArr) {
                $options[0] = CHtml::encode('Selecione um console');
            } else {
                $options .= CHtml::tag('option', array('value' => ''), CHtml::encode('Selecione um console'), true);
            }
        }

        return $options;
    }

    /**
     * Gera Lista de TORNEIOS por Game
     * 
     * @param int $idconsole Console do torneio
     * @param int $idgame Game disputado
     * @param bool $returnArr Retorna lista em Array?
     * 
     * @return string/array
     */
    public function listaTorneiosGame($idconsole, $idgame, $returnArr = false) {

        $options = "";
        if ($idconsole > 0) {
            $data = Torneio::model()->findAll('idconsole=' . $idconsole . ' AND idgame=' . $idgame);
            $data = CHtml::listData($data, 'idtorneio', 'nome');
            if (count($data) > 0) {
                if ($returnArr) {
                    $options[0] = CHtml::encode('Selecione ...');
                } else {
                    $options .= CHtml::tag('option', array('value' => ''), CHtml::encode('Selecione ...'), true);
                }

                foreach ($data as $idtorneio => $nometorneio) {
                    if ($returnArr) {
                        $options[$idtorneio] = CHtml::encode($nometorneio);
                    } else {
                        $options .= CHtml::tag('option', array('value' => $idtorneio), CHtml::encode($nometorneio), true);
                    }
                }
            } else {
                if ($returnArr) {
                    $options[0] = CHtml::encode('Nenhum torneio encontrado');
                } else {
                    $options .= CHtml::tag('option', array('value' => ''), CHtml::encode('Nenhum torneio encontrado'), true);
                }
            }
        } else {
            if ($returnArr) {
                $options[0] = CHtml::encode('Selecione um game');
            } else {
                $options .= CHtml::tag('option', array('value' => ''), CHtml::encode('Selecione um game'), true);
            }
        }

        return $options;
    }

}
