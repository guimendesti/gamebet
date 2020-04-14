<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>
<div class="auth_container" style="background-image: url(<?php echo $baseUrl . '/uploads/imagens/bgCabecalhoPagina.jpg'; ?>); ">
    <div class="container">
        <div class="row">
            <div class="hidden-sm col-sm-6 col-md-7">
                <div class="auth_descr hidden-xs" style="text-shadow: 0px 0px 8px #666, 2px 2px 1px #000;">
                    <h2>
                        <strong>Área Restrita</strong>
                        <span style="color:#f7c031;">:</span>
                    </h2>
                    <p>
                        Esta área é reservada aos jogadores cadastrados na <span style='color:#f7c031;'>Rabbitbet</span>. Se já tem cadastro, faça seu login ao lado.
                    </p>
                    <p>
                        Ainda não é cadastrado?<br />
                        Não perca tempo, <a href="#" class='auth_menu' style="color:#0c0;">Cadastre-se gratuitamente!</a>
                    </p>
                    
                    <br />
                    <br />
                    <a href='<?php echo $baseUrl; ?>' class='btn btn-default' style="text-shadow:none;">
                        <i class="fa fa-reply"></i>&nbsp;&nbsp;
                        Voltar para o site
                    </a>
                </div>
            </div>
            <div class="col-md-5">
                <div class="reg_image_container">
                    <div class="reg_block">
                        <div class="btn-hack">
                            <div class="btn-back">
                                <div class="authorization register_p">
                                    <div class="authorization_head clearfix">
                                        <p class="auth_p pull-left">
                                            <span class="edited" id="edited_reg1">Cadastro Rápido</span>
                                        </p>
                                        <a href="#" class="reg_close" id="reg_close">
                                            <i class="fa fa-times fa-2x pull-right"></i>
                                        </a>
                                    </div>
                                    
                                    
                                    <?php
                                    $formCad = $this->beginWidget('CActiveForm', array(
                                        'htmlOptions' => array('class' => 'cadastro-form'),
                                        'enableClientValidation' => true,
                                        'clientOptions' => array(
                                            'validateOnSubmit' => true,
                                            'errorMessage' => "{attribute} obrigatório",
                                        ),
                                    ));
                                    ?>
                                    <div class="authorization_form">
                                        
                                        <div class="auth_input clearfix">
                                            <div class="icon">
                                                <i class="fa fa-user fa-2x"></i>
                                            </div>
                                            <?php echo $formCad->textField($cadModel, 'usuario', array("id" => "cadUsuario", 'class' => 'form-control e-mail_in', "autocomplete" => "off", "placeholder" => "Usuário")); ?>
                                        </div>
                                        
                                        <div class="auth_input clearfix">
                                            <div class="icon">
                                                <i class="fa fa-envelope fa-2x"></i>
                                            </div>
                                            <?php echo $formCad->textField($cadModel, 'email', array("id" => "cadEmail", 'class' => 'form-control e-mail_in', "autocomplete" => "off", "placeholder" => "E-mail")); ?>
                                        </div>

                                        <div class="auth_input clearfix">
                                            <div class="icon">
                                                <i class="fa fa-key fa-2x"></i>
                                            </div>
                                            <?php echo $formCad->passwordField($cadModel, 'senha', array("id" => "cadSenha", 'class' => 'form-control e-mail_in', "autocomplete" => "off", "placeholder" => "Senha")); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="auth_login">
                                        <button class="ladda-button ladda-primary btn btn-primary" id="tryreg" data-style="zoom-out" style="font-size:18px; padding:10px 0;">
                                            Cadastrar
                                        </button>
                                    </div>
                                    
                                    
                                    <?php $this->endWidget(); ?>
                                </div>
                            </div>
                            <div class="btn-front">
                                <div class="authorization">

                                    <?php
                                    $formLogin = $this->beginWidget('CActiveForm', array(
                                        'htmlOptions' => array('class' => 'login-form'),
                                        'enableClientValidation' => true,
                                        'clientOptions' => array(
                                            'validateOnSubmit' => true,
                                            'errorMessage' => "{attribute} obrigatório",
                                        ),
                                    ));
                                    ?>
                                    <div class="authorization_form">
                                        <img src="<?php echo $baseUrlTheme; ?>/images/logorabbitpreto.png" alt="Rabbitbet" style="width: 280px;margin:0 0 70px 20px;" />
                                        <?php
                                        if ($this->getPageState('erroLogin')) {
                                            ?>
                                            <div class="alert alert-danger" style="position:absolute; z-index:1000; font-size: 14px; margin-top:-50px;padding:6px 10px;width:320px;">
                                                <button class="close" data-close="alert"></button>
                                                <center>E-mail ou Senha inválido</center>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="auth_input clearfix">
                                            <div class="icon">
                                                <i class="fa fa-envelope fa-2x"></i>
                                            </div>
                                            <?php echo $formLogin->textField($loginModel, 'email', array("id" => "logEmail", "placeholder" => "E-mail", 'class' => 'form-control e-mail_in', "autocomplete" => "off")); ?>
                                        </div>
                                        <div class="auth_input clearfix">
                                            <div class="icon">
                                                <i class="fa fa-key fa-2x"></i>
                                            </div>
                                            <?php echo $formLogin->passwordField($loginModel, 'senha', array("id" => "logSenha", "placeholder" => "Senha", 'class' => 'form-control e-mail_in', "autocomplete" => "off")); ?>
                                        </div>
                                    </div>
                                    <div class="auth_login">
                                        <button class="ladda-button ladda-primary btn btn-primary" id="try_login" data-style="zoom-out" style="font-size:18px; padding:10px 0;">
                                            Entrar
                                        </button>
                                        <div class='' id='loginresult'>
                                            <a href="#" style="font-size:14px;">Esqueceu a senha?</a>
                                        </div>
                                        <div style='padding-top:40px;text-align: center;font-weight: bold;' id='cadastroRapido'>
                                            <a href="#"style='color:#090;font-size: 22px;' class='auth_menu'>Cadastre-se agora</a>
                                            <br />
                                            <i style="color:#666;font-weight:100;font-size:16px;">(Rápido e Gratuito)</i>
                                        </div>
                                    </div>

                                    <?php $this->endWidget(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
