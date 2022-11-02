<?php 

    namespace App;

    class Detalles extends ActiveRecord{
        protected static $tabla = 'detalles';
        protected static $columnaDB = ['id', 'id_venta', 'id_producto', 'cantidad', 'precio'];

        public $id;
        public $id_venta;
        public $id_producto;
        public $cantidad;
        public $precio;

        public function __construct( $args = []){
            $this->id = $args['id'] ?? null;
            $this->email = $args['id_venta'] ?? '';
            $this->id_producto = $args['id_producto'] ?? '';
            $this->email = $args['cantidad'] ?? '';
            $this->password = $args['precio'] ?? '';
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