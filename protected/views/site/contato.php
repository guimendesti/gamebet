<?php
$baseUrl = Yii::app()->baseUrl;
$baseUrlTheme = Yii::app()->theme->baseUrl;
?>

<div class="middle_content pgContato">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <form action="#" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contacts-name">Nome</label>
                                <input type="text" class="form-control" name="nome" id="contacts-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contacts-email">E-mail</label>
                                <input type="email" class="form-control" name="email" id="contacts-email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contacts-assunto">Assunto</label>
                        <input type="assunto" class="form-control" name="assunto" id="contacts-assunto">
                    </div>
                    <div class="form-group">
                        <label for="contacts-message">Mensagem</label>
                        <textarea class="form-control" name="mensagem" rows="5" id="contacts-message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Enviar</button>
                </form>
            </div>
            <div class="col-md-4 col-sm-6">
                <ul class="listaContatos">
                    <li>
                        <i class="fa fa-phone fa-3x" style="color:#333;"></i>
                        <span>21 2342-2132</span>
                    </li>
                    <li>
                        <i class="fa fa-whatsapp fa-3x" style="color:#090;"></i>
                        <span>21 98899-9988</span>
                    </li>
                    <li>
                        <i class="fa fa-skype fa-3x" style="color:#069;"></i>
                        <span>rabbitbet</span>
                    </li>
                    <li>
                        <i class="fa fa-facebook fa-3x" style="color:#036;"></i>
                        <span>Rabbitbet </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>