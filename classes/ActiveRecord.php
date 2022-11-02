<?php 
/* 
            Se llama al archivo App para la conexión a la base de datos, y se declaran las variables como estaticos para ser llamadas por las funciones
            @Jose Rodriguez */
    namespace App;

    class ActiveRecord{
        // Base de Datos
        protected static $db;
        protected static $columnaDB = [];
        protected static $tabla = '';

        // Errores
        protected static $errores = [];

        // Definir la conexión a la BD
        public static function setDB($database){
            self::$db = $database;
        }

        public static function consultarSQL($query){
            // Consultar la base de datos
            $resultado = self::$db->query($query);
            
            // Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }

            // Liberar Memoria
            $resultado->free();

            // Retornar los resultados
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

        public function atributos(){
            $atributos = [];
            foreach(static::$columnaDB as $columna){
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }

        public static function all(){
            $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC ";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        /* 
            Funcion que llama una funcion que evalua por medio una validación si el id es null, si es null 
            entonces se llamara la función crear, si no es null entonces la función de actualizar
            @MARCO BETANCE 
        */

        public function guardar(){
            if(!is_null($this->id)){
                $this->actualizar();
            }else{
                $this->crear();
            }
        }

        /* 
            Esta función es parte del CRUD, esta primeramente me sanitizara los datos elementos evitando inyección de código
            lo sanitiza y después insertara en la tabla correspondiente por medio del static::$tabla
            @MARCO BETANCE 
        */

        public function crear(){

            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();

            // Insertar en la base de datos
            $query = "INSERT INTO " . static::$tabla . "(";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' ";
            $query .= join("', '", array_values($atributos));
            $query .= " ') ";

            $resultado = self::$db->query($query);

            if($resultado){
                // Redireccionar al usuario
                header('Location: /');
            }
        }

        /* 
            Esta función es similar a la función de crear, la única diferencia es que este seleccionara el id del producto
            si encuentra el id entonces el formulario mostrará los elementos del 
            @MARCO BETANCE 
        */

        public function actualizar(){
            //Sanitizar los atributos
            $atributos = $this->sanitizarAtributos();

            $valores = [];

            foreach($atributos as $key => $value){
                $valores[] = "{$key} = '{$value}'";
            }

            $query = "UPDATE " . static::$tabla . " SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' " . " LIMIT 1 ";

            $resultado = self::$db->query($query);

            if($resultado){
                header('Location: /menu.php');
            }
        }

        /* MARCO BETANCE */

        public function eliminar(){
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id);
            $resultado = self::$db->query($query);

            if($resultado){
                $this->borrarImagen();
                header('Location: /');
            }
        }

        public function eliminarProveedores(){
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id);
            $resultado = self::$db->query($query);

            if($resultado){
                $this->borrarImagen();
                header('Location: /proveedores.php');
            }
        }

        /* 
            Se realiza una consulta por el tipo y se muestra de manera descendente
            @Jose Rodriguez */
        public static function buscador($busqueda){
            $query = "SELECT * FROM " . static::$tabla . " WHERE codigo = '${busqueda}' ";

            $resultado = self::consultarSQL($query);

            return $resultado;
        }
         /* 
            Se realiza una consulta por el atributo cantidad y muestra el resultado condicionando el limite de elementos
            @Jose Rodriguez */
        public static function get($cantidad){
            $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC" . " LIMIT " . $cantidad;

            $resultado = self::consultarSQL($query);

            return $resultado;
        }
        /* 
            Se realiza una busqueda por id en la tabla y los muestra en un arreglo
            @Jose Rodriguez */
        public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id} " . "LIMIT 1";

            $resultado = self::consultarSQL($query);

            return array_shift($resultado);
        }

        /* MARCO BETANCE */

        public function setImagen($imagen){
            // Elimina la imagen previa
            if(!is_null($this->id)){
                $this->borrarImagen();
            }

            // Asignar al atributo de imagen el nombre de la imagen
            if($imagen){
                $this->imagen = $imagen;
            }
        }

        /* MARCO BETANCE */

        // Eliminar archivo
        public function borrarImagen(){
            // Comprobar si existe el archivo
            $existeArchivo = file_exists('../imagenes/' . $this->imagen);
            if($existeArchivo){
                unlink('../imagenes/' . $this->imagen);
            } 
        }

        /* 
            Se validan los errores y se guardan en un arreglo para mostrarlos en pantalla
            @Jose Rodriguez */
        public static function getErrores(){
            return static::$errores;
        }

        public function validar(){
            static::$errores = [];
            return static::$errores;
        }
        /* 
            Sanitizar impide que se ingresen fragmentos de codigo en los 
            @Jose Rodriguez */
        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];

            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$db->escape_string($value);
            }

            return $sanitizado;
        }

        /* MARCO BETANCE */

        public function sincronizar( $args = []){
            foreach($args as $key => $value){
                if(property_exists($this, $key) && !is_null($value)){
                    $this->$key = $value;
                }
            }
        }
    }