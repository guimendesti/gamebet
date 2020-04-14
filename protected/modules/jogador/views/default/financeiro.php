<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
                <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>
            
            <div class="col-md-9 col-sm-8 col-xs-7">

                <div class="row bloco_conteudo">

                    <h5 style="margin-bottom: 10px;">
                        <i class="fa fa-money"></i>&nbsp;&nbsp;
                        Balanço Financeiro
                    </h5>

                    <ul class="listaHorizontal liLink liDesafioAberto">
                        <?php
                        if (count($listaPartidas) == 0) {
                            echo '<div class="alert alert-info">Nenhum Desafio Global</div>';
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
                                ?>
                                <li class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <img src="<?php echo $baseUrl . '/uploads/imagens/games/' . $partida->Game->imagem; ?>" class="imgJog notFloat" width="60" height="60" alt="<?php echo 'Avatar do Game ' . $partida->Game->imagem; ?>" />
                                        <?php echo $partida->Console->nome . " - " . $partida->Game->nome; ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                       <?php echo Partidajogador::model()->count('idpartida=' . $partida->idpartida); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-1">
                                        <small>R$</small> <?php echo $partida->getValor(); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2" style="padding-top:4px;">
                                        <?php
                                        if ($partida->status == "agendada") {
                                            echo "<span class='label label-default'>Agendada</span>";
                                            echo "<br /><small>".$partida->getData('dataAgendada')."</small>";
                                        } elseif ($partida->status == "concluida") {
                                            echo "<span class='label label-success'>".$partida->resultado."</span>";
                                            echo "<br /><small>".$partida->getData('dataPartida')."</small>";
                                        } elseif ($partida->status == "moderacao") {
                                            echo "<span class='label label-warning'>Moderação</span>";
                                            echo "<br /><small>".$partida->getData('dataPartida')."</small>";
                                        } else {
                                            echo "Espera";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2" style="padding-top:0px;">
                                        <?php
                                        if ($partida->status == "agendada") {
                                            
                                            $linkResultado = $baseUrl . '/jogador/partidas/resultado/' . $idpartida;
                                            echo '<a href="' . $linkResultado . '" class="btn btn-success btn-xs" title="Lançar Resultado">'
                                                    . '<i class="fa fa-futbol-o fa-2x"></i>'
                                                . '</a>&nbsp;&nbsp;';
                                            
                                            /*
                                            $linkReagendar = $baseUrl . '/jogador/partidas/reagendar/' . $idpartida;
                                            echo '<a href="' . $linkReagendar . '" class="btn btn-default btn-xs" title="Reagendar">'
                                                    . '<i class="fa fa-clock-o fa-2x"></i>'
                                                . '</a>&nbsp;&nbsp;';
                                            */
                                            $linkCancelar = $baseUrl . '/jogador/partidas/cancelar/' . $idpartida;
                                            echo '<a href="' . $linkCancelar . '" class="btn btn-danger btn-xs" title="Cancelar">'
                                                    . '<i class="fa fa-close"></i>'
                                                . '</a>';
                                            
                                        } elseif ($partida->status == "concluida") {
                                            echo "<span class='label label-success'>".$partida->resultado."</span>";
                                        } elseif ($partida->status == "moderacao") {
                                            echo "Aguarde...";
                                        } else {
                                            $linkModeracao = $baseUrl . '/jogador/partidas/moderacao/' . $idpartida;
                                            echo '<a href="' . $linkModeracao . '" class="btn btn-warning" title="Solicitar Moderação">'
                                                    . '<i class="fa fa-balance-scale"></i>'
                                                . '</a>';
                                        }
                                        ?>
                                    </div>
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