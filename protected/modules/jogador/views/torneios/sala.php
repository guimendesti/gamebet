<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$idjogador = $this->jogadorLogado->idjogador;
$idtorneio = $torneio->idtorneio;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>

            <div class='col-md-9 col-sm-8 col-xs-7'>

                <div class="blocoDesafiar dadosTorneio">

                    <div class="row bloco_conteudo">

                        <h5 style="margin-bottom: 10px;">
                            <i class="fa fa-trophy"></i>&nbsp;&nbsp;Resumo do Torneio
                        </h5>

                        <ul class="listaHorizontal liLink">
                            <li class="row">
                                <div class="col-md-2 col-sm-2">
                                    <img src="<?php echo $baseUrl . '/uploads/imagens/torneios/' . $torneio->imagem; ?>" class="imgTorneio" 
                                         width="100" height="100" alt="<?php echo 'Torneio ' . $torneio->nome; ?>" />
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <h4><?php echo $torneio->nome; ?></h4>
                                    <?php echo $torneio->Console->nome . " - " . $torneio->Game->nome; ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <small style="color:#888;">Jogadores:</small><br/>
                                    <span style="font-size:16px;"><?php echo $torneio->getNumInscritos(); ?></span>
                                    <small>(<?php echo $torneio->jogadores; ?>)</small>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <small style="color:#888;">Entrada:</small><br/>
                                    <small>R$</small> <?php echo $torneio->getValor(); ?>
                                </div>
                                <div class="col-md-2 col-sm-2 acaoTorneio">
                                    <?php
                                    if ($torneio->status == "aberto") {
                                        $contaInscricao = Torneioinscricao::model()->count('idtorneio=' . $idtorneio
                                                . ' AND idjogador=' . $idjogador);

                                        if ($contaInscricao) {
                                            $linkSair = $baseUrl . '/torneios/cancelar/' . $torneio->getNomeUrl();
                                            echo '<a href="' . $linkSair . '" class="btn btn-default btn-xs btnCancelar">Cancelar Inscrição</a>';
                                        } else {
                                            $linkInscrever = $baseUrl . '/torneios/inscrever/' . $torneio->getNomeUrl();
                                            echo '<a href="' . $linkInscrever . '" class="btn btn-success btnInscrever">Inscrever</a>';
                                        }
                                    } else {
                                        echo $torneio->getStatus();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>

                    </div>

                </div>


                <div class="row bloco_conteudo rodadasPartidas">
                    <div class="col-md-8 col-sm-7">
                        <h5 style="margin: 40px 0 10px;">
                            <i class="fa fa-futbol-o"></i>&nbsp;&nbsp;
                            Rodada de Partidas
                        </h5>
                        <?php
                        if ($torneio->status == "aberto") {
                            echo '<div class="alert alert-info">Torneio não iniciado</div>';
                        } else {
                            $numJogs = $torneio->jogadores;
                            //$numJogs = 64; // teste - retirar
                            $etapas = $torneio->listaEtapas();
                            $r = 1;
                            echo '<ul class="nav nav-tabs">';
                            for ($e = $numJogs; $e >= 2; $e/=2) {
                                $active = ($e == $torneio->etapa) ? ' class="active" ' : '';
                                $etapa = (array_key_exists($e, $etapas)) ? $etapas[$e] : '<small>' . $r . "ª Rodada</small>";
                                if ($e > 32)
                                    $r++;
                                echo '<li role="presentation" ' . $active . '>'
                                . '<a href="#">' . $etapa . '</a>'
                                . '</li>';
                            }
                            echo '</ul>';

                            $partidas = $torneio->getPartidasEtapas();
                            if (count($partidas) > 0) {
                                ?>
                                <ul class="listaHorizontal liLink liDesafioAberto">
                                    <li class="row rowCabecalho hidden-xs">
                                        <div class="col-md-6 col-sm-4 semTop">
                                            Jogadores
                                        </div>
                                        <div class="col-md-3 col-sm-4 semTop">
                                            Situação
                                        </div>
                                        <div class="col-md-3 col-sm-4 semTop">
                                            Resultado
                                        </div>
                                    </li>
                                    <?php
                                    $dirImgJog = $baseUrl . '/uploads/imagens/jogadores/';
                                    foreach ($partidas as $partida) {
                                        $idpartida = $partida->idpartida;
                                        $minhaEquipe = ($partida->Jogs[0]->idjogador == $idjogador) ? $partida->Jogs[0]->equipe : $partida->Jogs[1]->equipe;

                                        if ($partida->status == "espera" || $partida->status == "concluida") {
                                            if ($partida->status == "concluida") {
                                                $resEquipe = false;
                                            } else {
                                                $resEquipe = (is_null($partida->resultadoA)) ? 'B' : 'A';
                                            }
                                            $resultado = "";
                                            $r = $partida->getResultado($resEquipe, true);

                                            if ($r['A'] <> $r['B']) {
                                                $equipeVitoria = ($r['A'] > $r['B']) ? "A" : ( ($r['B'] > $r['A']) ? "B" : false );
                                                if ($minhaEquipe == $equipeVitoria) {
                                                    $resultClass = 'vitoria';
                                                } else {
                                                    $resultClass = 'derrota';
                                                }
                                                $resultado = '<span class="' . $resultClass . '">'
                                                        . $r['A'] . " x " . $r['B'] . '</span>';
                                            } else {
                                                $resultado = $r['A'] . " x " . $r['B'];
                                            }
                                        }

                                        $meuPlacar = false;
                                        if (($minhaEquipe == "A" && !is_null($partida->resultadoA)) || ($minhaEquipe == "B" && !is_null($partida->resultadoB))) {

                                            $btnClass = "btn-warning";
                                            $btnTitle = "Alterar Resultado";
                                            $meuPlacar = true;
                                        } else {
                                            $btnClass = "btn-success";
                                            $btnTitle = "Lançar Resultado";
                                        }

                                        $exibeJogadores = false;
                                        if ($partida->Jogs[0]->equipe == "A") {
                                            $e1 = 0;
                                            $e2 = 1;
                                        } else {
                                            $e1 = 1;
                                            $e2 = 0;
                                        }
                                        $jog0 = $partida->Jogs[$e1];
                                        $jog0equipe = $jog0->equipe;
                                        $jog0avatar = ($jog0->idjogador == $idjogador) ? ' meuAvatar' : '';
                                        $jog1 = $partida->Jogs[$e2];
                                        $jog1equipe = $jog1->equipe;
                                        $jog1avatar = ($jog1->idjogador == $idjogador) ? ' meuAvatar' : '';
                                        ?>
                                        <li class="row">
                                            <div class="col-md-6 col-sm-4">
                                                <img src="<?php echo $dirImgJog . $jog0->Jogador->avatar; ?>"
                                                     class="imgJog notFloat <?php echo $jog0avatar; ?>" title="<?php echo $jog0->Jogador->usuario; ?>" />

                                                <i class='fa fa-close'></i>

                                                <img src="<?php echo $dirImgJog . $jog1->Jogador->avatar; ?>"
                                                     class="imgJog notFloat <?php echo $jog1avatar; ?>" title="<?php echo $jog1->Jogador->usuario; ?>" />

                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <?php
                                                if ($jog0->idjogador == $idjogador || $jog1->idjogador == $idjogador) {
                                                    $recuo = " style='display:block;width:80px;margin:8px auto 0;' ";
                                                    if ($partida->status == "agendada") {
                                                        echo "<span class='label label-primary' " . $recuo . ">Agendada</span>";
                                                    } elseif ($partida->status == "espera") {
                                                        echo "<span class='label label-default' " . $recuo . ">Espera</span>";
                                                        echo "<small>" . $resultado . "</small>";
                                                    } elseif ($partida->status == "concluida") {
                                                        $resultLabel = ($resultClass == 'vitoria') ? 'success' :
                                                                ($resultClass == 'derrota') ? 'danger' : 'default';
                                                        echo "<span class='label label-" . $resultLabel . "' " . $recuo . ">"
                                                        . $resultado . "</span>";
                                                        echo "<small>" . $partida->getData('dataPartida') . "</small>";
                                                    } elseif ($partida->status == "moderacao") {
                                                        echo "<span class='label label-danger' " . $recuo . ">Moderação</span>";
                                                        echo "<small>" . $partida->getData('dataPartida') . "</small>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-3 col-sm-4" style="padding-top:10px;">
                                                <?php
                                                if ($partida->status == "agendada" || $partida->status == "espera") {

                                                    echo '<a onclick="jQuery(\'#resultado' . $idpartida . '\').show();" class="btn ' . $btnClass . ' btn-sm" title="' . $btnTitle . '">'
                                                    . '<i class="fa fa-futbol-o fa-2x"></i>'
                                                    . '</a>&nbsp;&nbsp;';
                                                } elseif ($partida->status == "concluida") {
                                                    //echo "<span class='label label-success'>" . $partida->resultado . "</span>";
                                                } elseif ($partida->status == "moderacao") {
                                                    $linkModeracao = $baseUrl . '/jogador/partidas/moderacao/' . $idpartida;
                                                    echo '<a href="' . $linkModeracao . '" class="btn btn-warning" title="Solicitar Moderação">'
                                                    . '<i class="fa fa-balance-scale"></i>'
                                                    . '</a>';
                                                }
                                                ?>
                                            </div>
                                        </li>
                                        <?php
                                        if ($jog0->idjogador == $idjogador || $jog1->idjogador == $idjogador) {
                                            if (in_array($partida->status, array("agendada", "espera", "moderacao")) && $partida->Jogs[0] instanceof Partidajogador && $partida->Jogs[1] instanceof Partidajogador) {
                                                $funcaoIntVal = "valor=jQuery(this).val();if(valor<1 || !parseInt(valor)){ jQuery(this).val('0'); }";
                                                ?>
                                                <div class='lancarResultado' id='resultado<?php echo $idpartida; ?>' style='display: none;'>
                                                    <form method='post'>
                                                        <div class='bloco '>
                                                            <div class="jogadores">
                                                                <img src="<?php echo $dirImgJog . $jog0->Jogador->avatar; ?>"
                                                                     class="imgJog notFloat <?php echo $jog0avatar; ?>" title="<?php echo $jog0->Jogador->usuario; ?>" />

                                                                <input name='resultado<?php echo $jog0equipe; ?>' type="text" onblur="<?php echo $funcaoIntVal; ?>"
                                                                       value="<?php echo ($meuPlacar) ? $r[$jog0equipe] : ""; ?>" />
                                                                <i class='fa fa-close'></i>
                                                                <input name='resultado<?php echo $jog1equipe; ?>' type="text" onblur="<?php echo $funcaoIntVal; ?>"
                                                                       value="<?php echo ($meuPlacar) ? $r[$jog1equipe] : ""; ?>" />

                                                                <img src="<?php echo $dirImgJog . $jog1->Jogador->avatar; ?>"
                                                                     class="imgJog notFloat <?php echo $jog1avatar; ?>" title="<?php echo $jog1->Jogador->usuario; ?>" />
                                                            </div>
                                                            <button type="submit" class='btn <?php echo $btnClass; ?> btn-sm' title="<?php echo $btnTitle; ?>">
                                                                <i class='fa fa-save'></i>
                                                            </button>

                                                            <a class='btn btn-default btn-xs' title="Cancelar" onclick='jQuery("#resultado<?php echo $idpartida; ?>").hide();'>
                                                                <i class='fa fa-arrow-right'></i>
                                                            </a>
                                                        </div>
                                                        <input type="hidden" name="resultado_idpartida" value="<?php echo $idpartida; ?>" />
                                                    </form>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <h5 style="margin: 40px 0 10px;">
                            <i class="fa fa-users"></i>&nbsp;&nbsp;
                            Jogadores Inscritos
                        </h5>

                        <ul class="listaHorizontal liLink" style="border-left:1px solid #ddd;">

                            <?php
                            if (count($torneio->Inscricoes) == 0) {
                                echo '<div class="alert alert-info">Nenhum Jogador Inscrito</div>';
                            } else {
                                foreach ($torneio->Inscricoes as $inscricao) {
                                    $jogador = $inscricao->Jogador;
                                    $classAvatar = ($inscricao->idjogador == $idjogador) ? " meuAvatar " : "";
                                    ?>
                                    <li class="row">
                                        <img src="<?php echo $baseUrl . '/uploads/imagens/jogadores/' . $jogador->avatar; ?>" class="imgJog <?php echo $classAvatar; ?>" 
                                             width="60" height="60" alt="<?php echo 'Avatar de ' . $jogador->usuario; ?>" />

                                        <h4><?php echo $jogador->usuario; ?></h4>
                                    <?php echo $jogador->getAvaliacao(); ?>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>