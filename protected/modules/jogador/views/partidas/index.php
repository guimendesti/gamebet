<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$idjogador = $this->jogadorLogado->idjogador;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>

            <div class="col-md-9 col-sm-8 col-xs-7">
                <?php
                if ($retornoPartida == "espera") {
                    echo '<div class="row retornoSaque">'
                    . '<div class="alert alert-success">'
                    . 'Resultado Salvo! Aguarde o lançamento do adversário.'
                    . '</div>'
                    . '</div>';
                } elseif ($retornoPartida == 'concluida') {
                    echo '<div class="row retornoSaque">'
                    . '<div class="alert alert-info">'
                    . 'Resultado Final Salvo!<br/><small>Partida encerrada e valores transferidos.</small>'
                    . '</div>'
                    . '</div>';
                } elseif ($retornoPartida == 'moderacao') {
                    echo '<div class="row retornoSaque">'
                    . '<div class="alert alert-danger">'
                    . 'Resultados Divergentes!<br/><small>Partida em moderação até definição.</small>'
                    . '</div>'
                    . '</div>';
                } elseif ($retornoPartida == 'cancelada') {
                    echo '<div class="row retornoSaque">'
                    . '<div class="alert alert-warning">'
                    . 'Partida Cancelada!'
                    . '</div>'
                    . '</div>';
                }
                ?>

                <div class="row bloco_conteudo alert-">

                    <h5 style="margin-bottom: 10px;">
                        <i class="fa fa-futbol-o"></i>&nbsp;&nbsp;
                        Minhas Partidas
                    </h5>

                    <ul class="listaHorizontal liLink liDesafioAberto">
                        <?php
                        if (count($listaPartidas) == 0) {
                            echo '<div class="alert alert-info">Nenhuma Partida Disputada</div>';
                        } else {
                            ?>
                            <li class="row rowCabecalho hidden-xs">
                                <div class="col-md-4 col-sm-4 semTop">
                                    Plataforma
                                </div>
                                <div class="col-md-2 col-sm-2 semTop">
                                    Jogadores
                                </div>
                                <div class="col-md-2 col-sm-2 semTop">
                                    Valor
                                </div>
                                <div class="col-md-2 col-sm-2 semTop">
                                    Situação
                                </div>
                                <div class="col-md-2 col-sm-2 semTop">
                                    Ações
                                </div>
                            </li>
                            <?php
                            foreach ($listaPartidas as $partida) {
                                $idpartida = $partida->idpartida;
                                $minhaEquipe = ($partida->Jogs[0]->idjogador == $idjogador) 
                                        ? $partida->Jogs[0]->equipe 
                                        : $partida->Jogs[1]->equipe;
                                
                                if($partida->status == "concluida"){
                                    $resEquipe = false;
                                }
                                else{
                                    $resEquipe = (is_null($partida->resultadoA)) ? 'B' : 'A';
                                }
                                $r = $partida->getResultado($resEquipe,true);
                                
                                if($partida->status == "espera" || $partida->status == "concluida"){
                                    $resultado = "";
                                    
                                    if($r['A'] <> $r['B']){
                                        $equipeVitoria = ($r['A'] > $r['B']) ? "A" : ( ($r['B'] > $r['A']) ? "B" : false );
                                        if($minhaEquipe==$equipeVitoria){
                                            $resultClass = 'vitoria';
                                        }
                                        else{
                                            $resultClass = 'derrota';
                                        }
                                        $resultado = '<span class="'.$resultClass.'">'
                                                    .$r['A']." x ".$r['B'].'</span>';
                                    }
                                    else{
                                        $resultado = $r['A']." x ".$r['B'];
                                    }
                                }
                                
                                $meuPlacar = false;
                                if(($minhaEquipe == "A" && !is_null($partida->resultadoA))
                                    || ($minhaEquipe == "B" && !is_null($partida->resultadoB))){

                                    $btnClass = "btn-warning";
                                    $btnTitle = "Alterar Resultado";
                                    $meuPlacar = true;
                                }
                                else{
                                    $btnClass = "btn-success";
                                    $btnTitle = "Lançar Resultado";
                                }
                                ?>
                                <li class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <img src="<?php echo $baseUrl . '/uploads/imagens/games/' . $partida->Game->imagem; ?>" class="imgJog notFloat" width="60" height="60" title="<?php echo $partida->Game->nome; ?>" />
                                        <?php
                                        if ($partida->idtorneio > 0) {
                                            $torneioNome = $partida->Torneio->nome;
                                            echo '<div class="label label-warning tipo" title="'.$torneioNome.'"'
                                                . ' style="margin-left:-40px;padding:12px 8px 5px;" data-toggle="tooltip" data-placement="top">'
                                                    . '<i class="fa fa-trophy" style="font-size:24px;"></i>'
                                                . '</div>';
                                        }
                                        echo $partida->Console->nome . " - " . $partida->Game->nome; 
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <?php 
                                        echo Partidajogador::model()->count('idpartida=' . $partida->idpartida); 
                                        if($partida->idtorneio > 0) {
                                            $e = $partida->torneioEtapa;
                                            $etapas = $partida->Torneio->listaEtapas();
                                            $etapa = (array_key_exists($e, $etapas)) ? $etapas[$e] : '<small>' . $r . "ª Rodada</small>";
                                            echo " (".$etapa.")"; 
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-1">
                                        <?php 
                                        if($partida->idtorneio > 0) {
                                            $premio = $partida->Torneio->getValorPremio(true);
                                            echo '<small>R$</small> '.$premio.'<br /><small>(Torneio)</small> ';
                                        }
                                        else{
                                            echo '<small>R$</small> '.$partida->getValor();
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <?php
                                        $recuo = " style='display:block;width:80px;margin:-6px auto 0;' ";
                                        if ($partida->status == "agendada") {
                                            echo "<span class='label label-primary' " . $recuo . ">Agendada</span>";
                                            echo "<small>" . $partida->getData('dataAgendada') . "</small>";
                                        } elseif ($partida->status == "espera") {
                                            echo "<span class='label label-default' " . $recuo . ">Espera</span>";
                                            echo "<small>" . $resultado . "</small>";
                                        } elseif ($partida->status == "concluida") {
                                            $resultLabel = ($resultClass == 'vitoria')
                                                            ?'success':
                                                            ($resultClass == 'derrota')?'danger':'default';
                                            echo "<span class='label label-".$resultLabel."' " . $recuo . ">" 
                                                    . $resultado . "</span>";
                                            echo "<small>" . $partida->getData('dataPartida') . "</small>";
                                        } elseif ($partida->status == "moderacao") {
                                            echo "<span class='label label-danger' " . $recuo . ">Moderação</span>";
                                            echo "<small>" . $partida->getData('dataPartida') . "</small>";
                                        } else {
                                            echo "Cancelada";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2" style="padding-top:10px;">
                                        <?php
                                        if ($partida->status == "agendada" || $partida->status == "espera") {
                                            
                                            echo '<a onclick="jQuery(\'#resultado' . $idpartida . '\').show();" class="btn '.$btnClass.' btn-sm" title="'.$btnTitle.'">'
                                            . '<i class="fa fa-futbol-o fa-2x"></i>'
                                            . '</a>&nbsp;&nbsp;';

                                            $linkCancelar = $baseUrl . '/jogador/partidas/cancelar/' . $idpartida;
                                            echo '<a href="' . $linkCancelar . '" class="btn btn-danger btn-xs" title="Cancelar" onclick="return confirm(\'Tem certeza que deseja Cancelar essa Partida?\');">'
                                            . '<i class="fa fa-close"></i>'
                                            . '</a>';
                                        } elseif ($partida->status == "concluida") {
                                            //echo "<span class='label label-success'>" . $partida->resultado . "</span>";
                                        } elseif ($partida->status == "moderacao") {
                                            
                                            echo '<a onclick="jQuery(\'#resultado' . $idpartida . '\').show();" class="btn '.$btnClass.' btn-sm" title="'.$btnTitle.'">'
                                            . '<i class="fa fa-futbol-o fa-2x"></i>'
                                            . '</a>&nbsp;&nbsp;';
                                            
                                            /*
                                            $linkModeracao = $baseUrl . '/jogador/partidas/moderacao/' . $idpartida;
                                            echo '<a href="' . $linkModeracao . '" class="btn btn-warning" title="Solicitar Moderação">'
                                            . '<i class="fa fa-balance-scale"></i>'
                                            . '</a>';*/
                                        }
                                        ?>
                                    </div>
                                </li>
                                <?php
                                if (in_array($partida->status, array("agendada", "espera", "moderacao")) && $partida->Jogs[0] instanceof Partidajogador && $partida->Jogs[1] instanceof Partidajogador) {
                                    if($partida->Jogs[0]->equipe=="A"){
                                        $e1 = 0;
                                        $e2 = 1;
                                    }
                                    else{
                                        $e1 = 1;
                                        $e2 = 0;
                                    }
                                    $jog0 = $partida->Jogs[$e1];
                                    $jog0equipe = $jog0->equipe;
                                    $jog0avatar = ($jog0->idjogador == $idjogador) ? ' meuAvatar' : '';
                                    $jog1 = $partida->Jogs[$e2];
                                    $jog1equipe = $jog1->equipe;
                                    $jog1avatar = ($jog1->idjogador == $idjogador) ? ' meuAvatar' : '';
                                    $dirImgJog = $baseUrl . '/uploads/imagens/jogadores/';

                                    $funcaoIntVal = "valor=jQuery(this).val();if(valor<1 || !parseInt(valor)){ jQuery(this).val('0'); }";
                                    ?>
                                    <div class='lancarResultado' id='resultado<?php echo $idpartida; ?>' style='display: none;'>
                                        <form method='post'>
                                            <div class='bloco '>
                                                <img src="<?php echo $dirImgJog . $jog0->Jogador->avatar; ?>"
                                                     class="imgJog notFloat <?php echo $jog0avatar; ?>" title="<?php echo $jog0->Jogador->usuario; ?>" />

                                                <input name='resultado<?php echo $jog0equipe; ?>' type="text" onblur="<?php echo $funcaoIntVal; ?>"
                                                       value="<?php echo ($meuPlacar)?$r[$jog0equipe]:""; ?>" />
                                                <i class='fa fa-close'></i>
                                                <input name='resultado<?php echo $jog1equipe; ?>' type="text" onblur="<?php echo $funcaoIntVal; ?>"
                                                       value="<?php echo ($meuPlacar)?$r[$jog1equipe]:""; ?>" />

                                                <img src="<?php echo $dirImgJog . $jog1->Jogador->avatar; ?>"
                                                     class="imgJog notFloat <?php echo $jog1avatar; ?>" title="<?php echo $jog1->Jogador->usuario; ?>" />

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
                                ?>
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