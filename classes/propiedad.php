<?php

namespace App;

class propiedad{

    //base de datos
    protected static $db;

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedores_id = $args['vendedores_id'] ?? '';
        $this->creado = date('Y/m/d');


    }
    public function guardar(){

        //insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedores_id)
        VALUES ('$this->titulo','$this->precio','$this->imagen','$this->descripcion','$this->habitaciones','$this->wc','$this->estacionamiento','$this->creado','$this->vendedores_id')";

        $resultado = self::$db->query($query);

    }
    //definir conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }
}