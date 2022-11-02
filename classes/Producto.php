<?php 

    namespace App;

    class Producto extends ActiveRecord{
        protected static $tabla = 'producto';
        protected static $columnaDB = ['id', 'id_proveedor', 'nombre', 'inventario', 'precio', 'codigo'];

        public $id;
        public $id_proveedor;
        public $nombre;
        public $inventario;
        public $precio;
        public $codigo;

        public function __construct( $args = []){
            $this->id = $args['id'] ?? null;
            $this->id_proveedor = $args['id_proveedor'] ?? '';
            $this->nombre = $args['nombre'] ?? '';
            $this->inventario = $args['inventario'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->codigo = $args['codigo'] ?? '';
        }

        public function validar(){
            if(!$this->id_proveedor){
                self::$errores[] = 'El Proveedor es Obligatorio';
            }
            if(!$this->nombre){
                self::$errores[] = 'El Nombre es Obligatorio';
            }
            if(!$this->inventario){
                self::$errores[] = 'El Inventario es Obligatorio';
            }
            if(!$this->precio){
                self::$errores[] = 'El Precio es Obligatorio';
            }
            if(!$this->codigo){
                self::$errores[] = 'El Código es Obligatorio';
            }
            
            
            return self::$errores;
        }

        
        
    }