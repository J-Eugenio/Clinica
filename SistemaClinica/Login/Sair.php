<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

unset($_SESSION["id"]);
unset($_SESSION["nome"]);
unset($_SESSION["login"]);
unset($_SESSION["tipoUsuario"]);

header('Location: ../Telas/Index.php');
