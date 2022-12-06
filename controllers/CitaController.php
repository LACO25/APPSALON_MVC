<?php

namespace Controllers;

use MVC\Router;

class CitaController
{
    public static function index(Router $router)
    {
        session_start(); //inicio sesión ya que es una ruta protegida
        //debuguear($_SESSION['nombre']);

        isAuth(); // si no esta autenticado lo manda al login


        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}
