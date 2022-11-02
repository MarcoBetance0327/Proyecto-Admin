<?php

    namespace App;

    class Comidas extends ActiveRecord{
        protected static $tabla = 'comidas';
        protected static $columnaDB = ['id', 'nombre', 'tipo', 'precio', 'descripcion', 'imagen'];

        public $id;
        public $nombre;
        public $tipo;
        public $precio;
        public $descripcion;
        public $imagen;

        public function __construct($args = []){
            $this->id = $args['id'] ?? NULL;
            $this->nombre = $args['nombre'] ?? '';
            $this->tipo = $args['tipo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->imagen = $args['imagen'] ?? NULL;
        }

        public function validar(){
            if(!$this->nombre){
                self::$errores[] = 'El Nombre es obligatorio';
            }
            if(!$this->tipo){
                self::$errores[] = 'El Tipo de Sushi es obligatorio';
            }
            if(!$this->precio){
                self::$errores[] = 'El Precio es obligatorio';
            }
            if(!$this->descripcion){
                self::$errores[] = 'La Descripción es obligatoria';
            }
            if(!$this->imagen){
                self::$errores[] = 'La Imagen es obligatoria';
            }
            
            return self::$errores;
        }
    }