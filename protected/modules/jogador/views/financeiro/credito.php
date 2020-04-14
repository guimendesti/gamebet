<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
            <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>

            <div class="col-md-9 col-sm-8 col-xs-7">
                <?php
                if ($retornoCredito != false) {
                    if ($retornoCredito == 1) {
                        echo '<div class="row retornoCredito">'
                        . '<div class="alert alert-success">'
                        . 'Transação solicitada. Redirecionando para pagamento ...'
                        . '</div>'
                        . '</div>';
                    } elseif ($retornoCredito == 'cancelado') {
                        echo '<div class="row retornoCredito">'
                        . '<div class="alert alert-info">'
                        . 'Transação cancelada com sucesso!'
                        . '</div>'
                        . '</div>';
                    }
                }
                ?>

                <div class="blocoCredito">
                    <h3><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Adicionar Crédito</h3>


                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'creditoForm',
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <div class="row">
                        <?php echo $form->labelEx($creditoModel, 'valor', array('style' => 'float:left;margin:6px 0 0 50px;')); ?>
                        <?php 
                        $this->widget('application.extensions.moneymask.MMask',array(
                            'element'=>'#Jogcredito_valor',
                            'currency'=>'PHP',
                            'config'=>array(
                                'showSymbol'=>true,
                                'symbolStay'=>true,
                            )
                        ));
                        echo $form->textField($creditoModel, 'valor', array('style' => 'float:left;margin-left:20px;width:100px;', 'class' => 'form-control')); 
                        ?>
                        <?php echo CHtml::submitButton('Pagar no PagSeguro', array('style' => 'float:left;margin-left:20px;', 'class' => 'btn btn-success btn-large')); ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>


                <?php
                if (count($listaCreditos) > 0) {
                    ?>
                    <div class="row bloco_conteudo"  style="margin-top: 40px;">

                        <h5 style="margin-bottom: 10px;">
                            <i class="fa fa-credit-card-alt"></i>&nbsp;&nbsp;
                            Histórico de Depósitos
                        </h5>

                        <ul class="listaHorizontal liLink liMovimentacoes">
                            <li class="row rowCabecalho hidden-xs">
                                <div class="col-md-5 col-sm-5 semTop">
                                    Data e Hora
                                </div>
                                <div class="col-md-2 col-sm-2 semTop">
                                    Valor
                                </div>
                                <div class="col-md-4 col-sm-4 semTop">
                                    Situação
                                </div>
                                <div class="col-md-1 col-sm-1 semTop">
                                    &nbsp;
                                </div>
                            </li>
                            <?php
                            $m = 0;
                            foreach ($listaCreditos as $credito) {
                                $idjogcredito = $credito->idjogcredito;
                                ?>
                                <li class="row">
                                    <div class="col-md-5 col-sm-5 semTop">
                                        <?php echo $credito->getData(true); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        <small>R$</small> <?php echo $credito->getValor(); ?>
                                    </div>
                                    <div class="col-md-3 col-sm-3 semTop">
                                        <?php
                                        if ($credito->situacao == 1) {
                                            echo "<span class='label label-success'>Aprovado</span>";
                                        } elseif ($credito->situacao == 2) {
                                            echo "<span class='label label-info'>Pendente</span>";
                                        } elseif ($credito->situacao == 3) {
                                            echo "<span class='label label-warning'>Moderação</span>";
                                        } else {
                                            echo "Cancelado";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        <?php
                                        if ($credito->situacao == 2) {
                                            $linkPagar = $baseUrl . '/jogador/financeiro/credito/pagar/' . $idjogcredito;
                                            echo '<a href="' . $linkPagar . '" class="btn btn-success btn-sm btnPagar" title="Pagar no PagSeguro">'
                                                    . '<i class="fa fa-dollar"></i>'
                                                . '</a>&nbsp;&nbsp;';
                                            
                                            $linkCancelar = $baseUrl . '/jogador/financeiro/credito/cancelar/' . $idjogcredito;
                                            echo '<a href="' . $linkCancelar . '" class="btn btn-danger btn-xs" title="Cancelar">'
                                                    . '<i class="fa fa-close"></i>'
                                                . '</a>';
                                        }
                                        ?>
                                    </div>
                                </li>
                                <?php
                                $m++;
                            }
                            ?>
                        </ul>


                    </div>
                    <?php
                }
                ?>


            </div>
        </div>
    </div>
</div>