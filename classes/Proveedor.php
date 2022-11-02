<?php 

    namespace App;

    class Proveedor extends ActiveRecord{
        protected static $tabla = 'proveedor';
        protected static $columnaDB = ['id', 'nombre', 'telefono', 'direccion'];

        public $id;
        public $nombre;
        public $telefono;
        public $direccion;

        public function __construct( $args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
            $this->direccion = $args['direccion'] ?? '';
        }

        public function validar(){
            if(!$this->nombre){
                self::$errores[] = 'El Nombre es Obligatorio';
            }
            if(!$this->telefono){
                self::$errores[] = 'El Teléfono es Obligatorio';
            }
            if(!$this->direccion){
                self::$errores[] = 'La Dirección es Obligatorio';
            }
            
            
            return self::$errores;
        }

        
        
    }