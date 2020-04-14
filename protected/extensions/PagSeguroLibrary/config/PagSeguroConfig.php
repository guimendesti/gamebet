<?php

/*
 ************************************************************************
 PagSeguro Config File
 ************************************************************************
 */

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = array();
$PagSeguroConfig['environment']['environment'] = "production";

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "pagamentos@passeisimulados.com.br";
$PagSeguroConfig['credentials']['token'] = "D7F43E0B5308434BA745D3BEBB2DBC3E";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = false;
$PagSeguroConfig['log']['fileLocation'] = "";
