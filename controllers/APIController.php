<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all(); //obtengo todos los servicios
        echo json_encode($servicios);
    }

    public static function guardar()
    {
        // Almacena la cita y devuelve el id
        $cita = new Cita($_POST); //toma todos los valores coincidentes que le lleguen a mi url
        $resultado = $cita->guardar(); //lo guardamos

        $id = $resultado['id'];
        // $respuesta = [
        //     'cita' => $cita
        // ];

        //almacena los servicios con el id de la cita
        $idServicios = explode(',', $_POST['servicios']);
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio,
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //retornamos una respuesta
        // $respuesta = [
        //     'resultado' => $resultado,
        // ];

        echo json_encode(['resultado' => $resultado]); //lo que regreso de la peticion

    }

    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id); //buscamos la cita seleccionada
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']); //nos regresa a la misma pagina de donde venimos
        }
    }
}
