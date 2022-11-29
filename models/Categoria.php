<?php

    class Categoria implements Model{

        private $id;
        private $nombre;
        
        /**
         * Class constructor.
         */
        public function __construct() {
            
        }

        function getId() {
            return $this->id;
        }
    
        function getNombre() {
            return $this->nombre;
        }
    
        function setId($id) {
            $this->id = $id;
        }
    
        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        // Me va a devolver todos los elementos
        public function findAll(){
            $db = Database::conectar();
            $findAll = $db->query("SELECT * FROM categorias;");
            return $findAll;
        }

        // Me devuelve el elemento filtrado por id
        public function findById(){
            $db = Database::conectar();
            return $db->query("SELECT * FROM categorias WHERE id=$this->id")->fetch_object();
        }

        // Insertar en la base de datos
        public function save(){
            $db = Database::conectar();
            $save = $db->query("INSERT INTO categorias (nombreCategoria) VALUES ('$this->nombre')");
        }

        // Actualizar en la base de datos filtrando por id
        public function update(){
            $db = Database::conectar();
            $update = $db->query("UPDATE categorias SET nombreCategoria='$this->nombre' WHERE id=$this->id");
        }

        // Eliminar en la base de datos filtrando por id
        public function delete(){
            $db = Database::conectar();
            $delete = $db->query("DELETE FROM categorias WHERE id=$this->id");
        }

        public function llamarPlantas(){
            $db = Database::conectar();
            $findAll = $db->query("SELECT * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.nombreCategoria= 'Plantas';");
            return $findAll;
        }
        public function llamarFlores(){
            $db = Database::conectar();
            $findAll = $db->query("SELECT * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.nombreCategoria= 'Flores';");
            return $findAll;
        }
        public function llamarRosas(){
            $db = Database::conectar();
            $findAll = $db->query("SELECT * FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id WHERE categorias.nombreCategoria= 'Rosas';");
            return $findAll;
        }
    }

?>