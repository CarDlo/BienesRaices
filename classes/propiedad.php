<?php

namespace App;

class propiedad{

    //base de datos
    protected static $db;
    protected static $columnasDB = ['titulo', 'precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];

    //Validacion
    protected static $errores =[];

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

        //definir conexion a la base de datos
    public static function setDB($database){
            self::$db = $database;
    }

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

        //sanitizar datos
        $atributos = $this->sanitizarAtributos();
       // debugear($atributos);

       
        //debugear($string);
        
        //insertar en la base de datos
        $query = "INSERT INTO propiedades ( ";
        $query .= join(", ",array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '",array_values($atributos));
        $query .= " ') ";

       // debugear($query);

        $resultado = self::$db->query($query);
        return $resultado;
        //debugear($resultado);

    }
    //subida de archivos
    public function setImagen($imagen){
        if(!is_null($imagen)){
            $this->imagen = $imagen;
        }
    }
    //identificar las columnas d ela abse de datos
    public function atributos(){
        $atributos = [];

        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;

        }

        return $atributos;
    }

    //sanitizar datos
    public function sanitizarAtributos(){
        if (self::$db === null) {
            debugear('La conexión a la base de datos no está establecida.');
        }
        $atributos = $this->atributos();
        //debugear($atributos);
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
           
        }
        //debugear($sanitizado);
       return $sanitizado;
    }
    //Validacion
    public static function getErrores(){
        return self::$errores;
    }

    //validar 
    public function validar(){
    
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if(!$this->precio) {
            self::$errores[] = "Elige un precio";
        }
        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria";
        }
        if(!$this->habitaciones) {
            self::$errores[] = "Elige el número de habitaciones";
        }
        if(!$this->wc) {
            self::$errores[] = "Elige el número de baños";
        }
        if(!$this->estacionamiento) {
            self::$errores[] = "Elige el número de estacionamiento";
        }
        if(!$this->vendedores_id) {
            self::$errores[] = "Elige el vendedor";
        }
    //     if(!$this->imagen['name'] || $this->imagen['error']) {
    //         $errores[] = "La imagen es obligatoria";
    //     }

    //     //Validar por tamaño (1mb max)
    //     $medida = 100000000;
    //     if($this->imagen['size'] > $medida) {
    //         $errores[] = "La imagen es muy pesada";
    //     }
    return self::$errores;
    }
}