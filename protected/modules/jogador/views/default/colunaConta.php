<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;

$idjogador = $this->jogadorLogado->idjogador;
$avatar = $this->jogadorLogado->avatar;
$saldoAtual = $this->jogadorLogado->getSaldoAtual();
?>

<div class="col-md-3 col-sm-4 col-xs-5 colSidebar">
    <div class="avatarJogador">
        <img id="image" src="<?php echo $baseUrl . '/uploads/imagens/jogadores/' . $avatar; ?>" alt="">
        <a href="<?php echo $baseUrl . '/jogador'; ?>" class="btn btn-default editarConta"  data-toggle="tooltip" data-placement="top" title="Editar Perfil">
            <i class="fa fa-pencil"></i>
        </a>
    </div>

    <div class="side_bar">
        <br />
        <h5>Resumo Financeiro</h5>
        <ul class="side_bar_list">
            <li class="saldo">
                Saldo Atual: <small>R$</small>
                <?php
                echo $saldoAtual;
                ?>
            </li>
            <li>
                <?php
                /*
                Hoje: 
                // Trata datas para consultar últimas 24 horas
                $teste = '2016-05-05 20:00:00';
                $hoje = new DateTime($teste);
                $ontem = new DateTime($teste);
                $intervalo = new DateInterval('P1D');
                $intervalo->invert = 1;
                $horasdia = $ontem->add($intervalo);
                $wDateMax = $hoje->format('Y-m-d H:i:s');
                $wDateMin = $ontem->format('Y-m-d H:i:s');

                $condition = 'idjogador=' . $idjogador
                        . ' AND transacao=\'%transacao%\''
                        . ' AND descricao NOT IN(\'deposito\',\'saque\')'
                        . ' AND data BETWEEN \'' . $wDateMin . '\' and \'' . $wDateMax . '\'';

                $creditos = Jogmovimentacao::model()->findAll(array('select' => 'SUM(valor) as valor',
                    'condition' => str_replace("%transacao%", 'credito', $condition)));
                $credito = $creditos[0]->valor;

                $debitos = Jogmovimentacao::model()->findAll(array('select' => 'SUM(valor) as valor',
                    'condition' => str_replace("%transacao%", 'debito', $condition)));
                $debito = $debitos[0]->valor;
                $saldoHoje = $credito - $debito;

                if ($saldoHoje > 0) {
                    $saldoDeHoje = number_format($saldoHoje, 2, ',', '.');
                    echo '<span style="color:#090;">+ <small>R$</small>' . $saldoDeHoje . '</span>';
                } elseif ($saldoHoje < 0) {
                    $saldoDeHoje = number_format($saldoHoje * (-1), 2, ',', '.');
                    echo '<span style="color:#c00;">- <small>R$</small>' . $saldoDeHoje . '</span>';
                } else {
                    echo '<span style="color:#999;">+ <small>R$</small> 0,00</span>';
                }*/
                ?>
            </li>
            <li>
                <a href="<?php echo $baseUrl . '/jogador/financeiro/credito'; ?>" class="btn btn-success addCredito">
                    <i class="fa fa-credit-card"></i>
                    Adicionar Crédito
                </a>
            </li>
            <li class="verMais">
                <a href="<?php echo $baseUrl . '/jogador/financeiro'; ?>">
                    Ver Extrato Financeiro&nbsp;
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </li>
        </ul>
        <?php if (count($this->desafiosAbertos) > 0) { ?>
            <h5 style="margin-bottom: 10px;">Desafios Abertos</h5>
            <ul class="side_bar_list liLink liDesafioAberto">
                <?php
                foreach ($this->desafiosAbertos as $desafio) {
                    $iddesafio = $desafio->iddesafio;
                    $tipo = $desafio->tipo;
                    
                    $classAvatar = ($desafio->desafiante == $idjogador) ? " meuAvatar " : "";
                    ?>
                    <li>
                        <a href="#">
                            <img src="<?php echo $baseUrl . '/uploads/imagens/jogadores/' . $desafio->Desafiante->avatar; ?>" 
                                 class="imgJog <?php echo $classAvatar; ?>" width="60" height="60" alt="<?php echo 'Avatar de ' . $desafio->Desafiante->usuario; ?>" />
                            <?php echo $desafio->Desafiante->usuario; ?><br />
                            <small><?php echo $desafio->Console->nome . " - " . $desafio->Game->nome; ?></small><br />

                            <?php
                            if ($tipo == 'global') {
                                echo '<div class="label label-primary tipo" title="Global"><i class="fa fa-users"></i></div>';
                            } else {
                                echo '<div class="label label-info tipo" title="Privado"><i class="fa fa-user"></i></div>';
                            }
                            ?>
                            <span class="valor">
                                <small>R$</small> <?php echo $desafio->getValor(); ?>
                            </span>
                            <?php
                            if ($desafio->desafiante != $idjogador) {
                                if ($tipo == 'privado') {
                                    $linkRecusar = $baseUrl . '/' . $tipo . '/recusar/' . $iddesafio;
                                    echo '<a href="' . $linkRecusar . '" class="btn btn-danger btn-xs btnDesafio" data-toggle="tooltip" data-placement="top" title="Recusar">'
                                    . '<i class="fa fa-thumbs-down"></i>'
                                    . '</a>';
                                }
                                $linkAceitar = $baseUrl . '/' . $tipo . '/aceitar/' . $iddesafio;
                                echo '<a href="' . $linkAceitar . '" class="btn btn-success btn-xs btnDesafio" data-toggle="tooltip" data-placement="top" title="Aceitar">'
                                . '<i class="fa fa-thumbs-up"></i>'
                                . '</a>   ';
                            } else {
                                $linkCancelar = $baseUrl . '/' . $tipo . '/cancelar/' . $iddesafio;
                                echo '<a href="' . $linkCancelar . '" class="btn btn-default btn-xs btnDesafio">Cancelar</a>';
                            }
                            ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>

        <?php if (count($this->partidasAgendadas) > 0) { ?>
            <h5 style="margin-bottom: 10px;">Partidas Agendadas</h5>
            <ul class="side_bar_list liLink liDesafioAberto">
                <?php foreach ($this->partidasAgendadas as $partida) { ?>
                    <li>
                        <a href="#">
                            <img src="<?php echo $baseUrl . '/uploads/imagens/games/' . $partida->Game->imagem; ?>" class="imgJog" 
                                 width="60" height="60" alt="<?php echo 'Imagem do Game ' . $partida->Game->nome; ?>" />

                            <?php
                            if ($partida->idtorneio > 0) {
                                $torneioNome = $partida->Torneio->nome;
                                echo '<div class="label label-warning tipo" title="Torneio '.$torneioNome.'">'
                                        . '<i class="fa fa-trophy"></i>'
                                    . '</div>';
                            }
                            ?>
                            <?php echo $partida->Console->nome . " - " . $partida->Game->nome; ?><br />
                            <small>
                                <?php echo date('d/m/Y \à\s H:i', strtotime($partida->dataAgendada)); ?><br />
                                <?php echo Partidajogador::model()->count('idpartida=' . $partida->idpartida) . " jogadores"; ?>
                            </small>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>