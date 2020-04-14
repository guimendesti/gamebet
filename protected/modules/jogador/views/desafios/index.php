<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>

            <div class="col-md-9 col-sm-8">

                <div class="row bloco_conteudo">

                    <h5 style="margin-bottom: 10px;">
                        <i class="fa fa-crosshairs"></i>&nbsp;&nbsp;
                        Meus Desafios
                    </h5>

                    <ul class="listaHorizontal liLink liDesafioAberto">
                        <?php
                        if (count($listaDesafios) == 0) {
                            echo '<div class="alert alert-info">Nenhum Desafio Recebido ou Enviado</div>';
                        } else {
                            ?>
                                <li class="row rowCabecalho hidden-xs">
                                    <div class="col-md-2 col-sm-2 semTop">
                                        Data
                                    </div>
                                    <div class="col-md-3 col-sm-3 semTop">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                    <div class="col-md-3 col-sm-3 semTop">
                                        Plataforma
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        Valor
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        Situação
                                    </div>
                                </li>
                                <?php
                            foreach ($listaDesafios as $desafio) {
                                $iddesafio = $desafio->iddesafio;
                                $tipo = $desafio->tipo;
                                ?>
                                <li class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <?php echo $desafio->getData(false, true); ?>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <img src="<?php echo $baseUrl . '/uploads/imagens/jogadores/' . $desafio->Desafiante->avatar; ?>" 
                                             class="imgJog notFloat" width="50" height="50" 
                                             alt="<?php echo 'Avatar de ' . $desafio->Desafiante->usuario; ?>" />

                                        <?php
                                        if ($tipo == 'global') {
                                            echo '<div class="label label-primary tipo" title="Global"><i class="fa fa-users"></i></div>';
                                        } else {
                                            echo '<div class="label label-info tipo" title="Privado"><i class="fa fa-user"></i></div>';
                                        }
                                        ?>
                                        <?php 
                                        if ($desafio->desafiado) {
                                        ?>
                                        <img src="<?php echo $baseUrl . '/uploads/imagens/jogadores/' . $desafio->Desafiado->avatar; ?>" 
                                             class="imgJog notFloat" width="50" height="50" 
                                             alt="<?php echo 'Avatar de ' . $desafio->Desafiado->usuario; ?>" />
                                        <?php
                                            //echo $desafio->Desafiante->usuario; 
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <?php echo $desafio->Console->nome . " - " . $desafio->Game->nome; ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <small>R$</small> <?php echo $desafio->getValor(); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <?php
                                        if ($desafio->status == "espera") {
                                            if ($desafio->desafiante != $this->jogadorLogado->idjogador) {

                                                $linkAceitar = $baseUrl . '/'.$tipo.'/aceitar/' . $iddesafio;
                                                echo '<a href="' . $linkAceitar . '" class="btn btn-success btnDesafio" data-toggle="tooltip" data-placement="top" title="Aceitar">'
                                                . '<i class="fa fa-thumbs-up"></i>'
                                                . '</a>   ';
                                            } else {
                                                $linkCancelar = $baseUrl . '/'.$tipo.'/cancelar/' . $iddesafio;
                                                echo '<a href="' . $linkCancelar . '" class="btn btn-default btnDesafio">Cancelar</a>';
                                            }
                                        } elseif ($desafio->status == "aceito") {
                                            echo "<span class='label label-success'>Aceito</span>";
                                        } elseif ($desafio->status == "recusado") {
                                            echo "<span class='label label-danger'>Recusado</span>";
                                        } else {
                                            echo "Cancelado";
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