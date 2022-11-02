<?php 

    namespace App;

    class Ventas extends ActiveRecord{
        protected static $tabla = 'venta';
        protected static $columnaDB = ['id', 'fecha'];

        public $id;
        public $fecha;

        public function __construct( $args = []){
            $this->id = $args['id'] ?? null;
            $this->fecha = $args['fecha'] ?? '';
        }

        /*public function validar(){
            if(!$this->email){
                self::$errores[] = 'El Email es obligatorio';
            }
            if(!$this->password){
                self::$errores[] = 'El Password es obligatorio';
            }
            
            return self::$errores;
        }*/

    }