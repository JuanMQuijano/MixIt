<?php

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/../src/imgPrendas/');
define('CARPETA_IMAGENES2', $_SERVER['DOCUMENT_ROOT'] . '/build/imgPrendas/');

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = strip_tags($html);
    return $s;
}

//Funcion que revisa que el usuario este autenticado
function isNotLogged(): void
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['login'])) {
        header('Location: /iniciar-sesion');
    }
}

function isLogged(): void
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['login'])) {
        header('Location: /');
    }
}
