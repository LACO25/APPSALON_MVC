<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;

class ServicioController
{

    public static function index(Router $router)
    {
        session_start();
        isAdmin(); //si no es admin  lo regresal menu
        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAdmin(); //si no es admin  lo regresal menu
        $servicio = new Servicio;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servicio->sincronizar($_POST); //sincroniza con los datos del objeto existente con el nuevo

            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas

        ]);
    }

    public static function actualizar(Router $router)
    {
        session_start();
        isAdmin(); //si no es admin  lo regresal menu
        $id = is_numeric($_GET['id']);
        //debuguear($id);
        if (!$id) {
            return;
        }
        $servicio = Servicio::find($_GET['id']);
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas

        ]);
    }


    public static function eliminar()
    {
        session_start();
        isAdmin(); //si no es admin  lo regresal menu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            $servicio = Servicio::find($id);
            //debuguear($servicio);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    }
}
