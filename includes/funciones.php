<?php

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
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool
{
    if ($actual !== $proximo) {
        return true;
    }
    return false;
}


// Function que revisa que el usuario este autenticado 

function isAuth(): void
{
    if (!isset($_SESSION['login'])) { //si no esta en true
        header(('Location: /')); // que inicie sesion
    }
}

function isAdmin(): void
{
    if (!isset($_SESSION['admin'])) { //si existe esa funcion
        header('Location: /');
    }
}
