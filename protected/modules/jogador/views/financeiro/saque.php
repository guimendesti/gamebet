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
                if ($retornoSaque != false) {
                    if ($retornoSaque == 1) {
                        echo '<div class="row retornoSaque">'
                        . '<div class="alert alert-success">'
                        . 'Saque solicitado com sucesso! Entraremos em contato.'
                        . '</div>'
                        . '</div>';
                    } elseif ($retornoSaque == 'cancelado') {
                        echo '<div class="row retornoSaque">'
                        . '<div class="alert alert-info">'
                        . 'Saque cancelado com sucesso!'
                        . '</div>'
                        . '</div>';
                    }
                }
                ?>

                <div class="blocoSaque">
                    <h3><i class="fa fa-download"></i>&nbsp;&nbsp;Solicitar Saque</h3>


                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'saqueForm',
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <div class="row">
                        <?php echo $form->labelEx($saqueModel, 'valor', array('style' => 'float:left;margin:6px 0 0 50px;')); ?>
                        <?php 
                        $this->widget('application.extensions.moneymask.MMask',array(
                            'element'=>'#Jogsaque_valor',
                            'currency'=>'PHP',
                            'config'=>array(
                                'showSymbol'=>true,
                                'symbolStay'=>true,
                            )
                        ));
                        echo $form->textField($saqueModel, 'valor', array('style' => 'float:left;margin-left:20px;width:100px;', 'class' => 'form-control')); 
                        ?>
                        <?php echo CHtml::submitButton('Solicitar Saque', array('style' => 'float:left;margin-left:20px;', 'class' => 'btn btn-primary btn-large')); ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>


                <?php
                if (count($listaSaques) > 0) {
                    ?>
                    <div class="row bloco_conteudo"  style="margin-top: 40px;">

                        <h5 style="margin-bottom: 10px;">
                            <i class="fa fa-cloud-download"></i>&nbsp;&nbsp;
                            Histórico de Saques
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
                            foreach ($listaSaques as $saque) {
                                $idjogsaque = $saque->idjogsaque;
                                ?>
                                <li class="row">
                                    <div class="col-md-5 col-sm-5 semTop">
                                        <?php echo $saque->getData(true); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        <small>R$</small> <?php echo $saque->getValor(); ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 semTop">
                                        <?php
                                        if ($saque->situacao == 1) {
                                            echo "<span class='label label-success'>Aprovado</span>";
                                        } elseif ($saque->situacao == 2) {
                                            echo "<span class='label label-info'>Pendente</span>";
                                        } elseif ($saque->situacao == 3) {
                                            echo "<span class='label label-warning'>Moderação</span>";
                                        } else {
                                            echo "Cancelado";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-1 col-sm-1 semTop">
                                        <?php
                                        if ($saque->situacao == 2) {
                                            $linkCancelar = $baseUrl . '/jogador/financeiro/saque/cancelar/' . $idjogsaque;
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