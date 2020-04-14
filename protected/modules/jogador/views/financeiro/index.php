<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$saldoAtual = $this->jogadorLogado->getSaldoAtual();
?>

<div class="middle_content">
    <div class="container">
        <div class="row">
                <?php $this->renderPartial('application.modules.jogador.views.default.colunaConta'); ?>
            
            <div class="col-md-9 col-sm-8 col-xs-7">

                <div class="row bloco_conteudo bloco_mov">

                    <h5 style="margin-bottom: 10px;">
                        <i class="fa fa-money"></i>&nbsp;&nbsp;
                        Movimentações
                    </h5>
                    
                    <?php if($saldoAtual > 0){ ?>
                    <div class="row buttons">
                        <a href="<?php echo $baseUrl . '/jogador/financeiro/saque'; ?>" class="btn btn-primary btn-large">
                            <i class="fa fa-download"></i>&nbsp;&nbsp;Solicitar Saque
                        </a>
                    </div>
                    <?php } ?>

                    <ul class="listaHorizontal liLink liMovimentacoes">
                        <?php
                        if (count($listaMovimentacoes) == 0) {
                            echo '<div class="alert alert-info">Nenhuma Movimentação na Conta</div>';
                        } else {
                            ?>
                                <li class="row rowCabecalho hidden-xs">
                                    <div class="col-md-4 col-sm-4 semTop">
                                        Data e Hora
                                    </div>
                                    <div class="col-md-4 col-sm-4 semTop">
                                        Transação
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        Valor
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop">
                                        Saldo
                                    </div>
                                </li>
                                <?php
                                $m=0;
                            foreach ($listaMovimentacoes as $mov) {
                                $idjogmovimentacao = $mov->idjogmovimentacao;
                                
                                $valClass = "";
                                if($mov->transacao == 'credito'){
                                    $valClass .= ' movCredito ';
                                }
                                else{
                                    $valClass .= ' movDebito ';
                                }
                                
                                $transClass = "";                                
                                if($mov->descricao == 'partida'){
                                    $transClass .= ' movPartida ';
                                }
                                elseif($mov->descricao == 'torneio'){
                                    $transClass .= ' movTorneio ';
                                }
                                ?>
                                <li class="row">
                                    <div class="col-md-4 col-sm-4 semTop">
                                        <?php echo $mov->getData(true); ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 semTop <?php echo $transClass; ?>">
                                       <?php echo $mov->getTransacao(); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-1 semTop <?php echo $valClass; ?>">
                                        <small>R$</small> <?php echo $mov->getValor('valor'); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2 semTop <?php echo ($m == 0 )? 'saldoAtual' : "";?>">
                                        <small>R$</small> <?php echo $mov->getValor('saldoDepois'); ?>
                                    </div>
                                </li>
                                <?php
                                $m++;
                            }
                        }
                        ?>
                    </ul>
                </div>
                
                
            </div>
        </div>
    </div>
</div>