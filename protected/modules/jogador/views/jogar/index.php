<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>

<div class="middle_content">
    <div class="container">
        <div class="row">

            <?php
            $classCapa = "class='row' style='padding:30px 0 100px;'";
            if(Yii::app()->controller->getModule() instanceof JogadorModule){
                $classCapa = "class='col-md-9 col-sm-8'";
                $this->renderPartial('application.modules.jogador.views.default.colunaConta');
            }
            ?>
            
            <div <?php echo $classCapa; ?>>
                
                <div class="row areaJogar">
                    
                    <div class="col-md-6 col-sm-6 jogar global">
                        <a class="btn btn-primary" href="<?php echo $baseUrl."/global"; ?>">
                            Global<br />
                            <span class="btn btn-default">Desafios Públicos</span>
                        </a>
                    </div>
                    
                    <div class="hidden-lg hidden-md hidden-sm">
                        <br />
                    </div>
                    
                    <div class="col-md-6 col-sm-6 jogar privado">
                        <a class="btn btn-info" href="<?php echo $baseUrl."/privado"; ?>">
                            Privado<br />
                            <span class="btn btn-default">Desafios Diretos</span>
                        </a>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </div>
</div>