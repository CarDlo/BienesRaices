<?php

namespace App;

class ActiveRecord{

      //base de datos
      protected static $db;
      protected static $columnasDB = [];
  
      protected static $tabla = '';
      //Validacion
      protected static $errores =[];
  

  
          //definir conexion a la base de datos
      public static function setDB($database){
              self::$db = $database;
      }
  

  
      public function guardar(){
          if(isset($this->id)){
              //actualizar
              $this->actualizar();
          }else{
  
              //nueva propiedad
              $this->crear();
              //debugear('entro a crear');
          }
      }
  
      public function crear(){
  
          //sanitizar datos
          $atributos = $this->sanitizarAtributos();
         // debugear($atributos);
  
         
          //debugear($string);
          
          //insertar en la base de datos
          $query = "INSERT INTO " . static::$tabla . " ( ";
          $query .= join(", ",array_keys($atributos));
          $query .= " ) VALUES (' ";
          $query .= join("', '",array_values($atributos));
          $query .= " ') ";
  
          //debugear($query);
  
          $resultado = self::$db->query($query);
          //debugear($resultado);
          return $resultado;
          //debugear($resultado);
  
      }
      public function actualizar(){
          //sanitizar datos
          $atributos = $this->sanitizarAtributos();
  
          $valores = [];
          foreach($atributos as $key => $value){
              $valores[] = "{$key}='{$value}'";
          }
         
          $query = " UPDATE " . static::$tabla . " SET ";
          $query .= join(', ', $valores);
          $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
          $query .= " LIMIT 1 ";
          
          $resultado = self::$db->query($query);
          if($resultado) {
              //redireccionar al usuario
              header('Location: /admin?mensaje=2');
          }
  
      }
      //eliminar un registro
      public function eliminar(){
          $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
          $resultado = self::$db->query($query);
          if($resultado) {
              $this->borrarImagen();
              header('Location: /admin?mensaje=3');
          }
      }
      public function borrarImagen(){
           //Eliminar archivo
           $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
           if($existeArchivo){
               unlink(CARPETA_IMAGENES . $this->imagen);
           }
      }
      //subida de archivos
      public function setImagen($imagen){
  
          //elimina imagen previa
          if($this->id){
              $this->borrarImagen();
          }
  
          if($imagen){
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
          if(!$this->imagen) {
              self::$errores[] = "La imagen es obligatoria";
          }
  
      return self::$errores;
      }
      //lista toddas las propiedades
      public static function all(){
          $query = "SELECT * FROM " . static::$tabla;
  
          $resultado = self::consultarSQL($query);
          return $resultado;
  
      }
      // busca una propiedad por su ID
      public static function find($id){
          $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
          $propiedad = self::consultarSQL($query);
          return array_shift($propiedad);
      }
  
  
      public static function consultarSQL($query){
          //consultar DB
          $resultado = self::$db->query($query);
          //debugear($resultado);
          //iterar resultado
          $array = [];
          while($propiedad = $resultado->fetch_assoc()){
              $array[] = self::crearObjeto($propiedad);
          }
          //liberar la memoria
          $resultado->free();
          //devolver el array
          return $array;
      }
      public static function crearObjeto($registro){
  
          $objeto = new static;
          foreach($registro as $key => $value){
              if(property_exists($objeto, $key)){
                  $objeto->$key = $value;
              }
          }
          return $objeto;
      }
  
      //sincronizar  el objeto en memoria con los cambios realizados por el usuario
      public function sincronizar($args = []){
          foreach($args as $key => $value){
              if(property_exists($this, $key) && !is_null($value)){
                  $this->$key = $value;
              }
          }
      }

}