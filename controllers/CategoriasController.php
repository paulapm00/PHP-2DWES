<?php 
    require_once 'models/Producto.php';

    class CategoriasController{
       
        /**
         * 
         */
        public static function index(){
            if(isset($_SESSION['identity'])){
                $categoria = new Categoria();
                echo $GLOBALS["twig"]->render(
                    'categorias/index.twig', 
                    [
                        'categorias' => $categoria->findAll(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function create(){
            if(isset($_SESSION['identity'])){
                echo $GLOBALS["twig"]->render(
                    'categorias/create.twig',
                    [
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function show(){
            if(isset($_SESSION['identity'])){
                $categoria = new Categoria();
                $categoria->setId($_GET['id']);
                echo $GLOBALS["twig"]->render(
                    'categorias/show.twig', 
                    [
                        'categoria' => $categoria->findById(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function edit(){
            if(isset($_SESSION['identity'])){
                $categoria = new Categoria();
                $categoria->setId($_GET['id']);
                echo $GLOBALS["twig"]->render(
                    'categorias/edit.twig', 
                    [
                        'categoria' => $categoria->findById(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function save(){
            if(isset($_SESSION['identity'])){
                $categoria = new Categoria();
                $categoria->setNombre($_POST['nombre']);
                $categoria->save();
                header('Location: '.URL.'?controller=categorias&action=index');
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function update(){
            if(isset($_SESSION['identity'])){
                $categoria = new Categoria();
                $categoria->setId($_POST['id']);
                $categoria->setNombre($_POST['nombre']);
                $categoria->update();
                header('Location: '.URL.'?controller=categorias&action=index');
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }
        /**
         * 
         */
        public static function delete(){
            if(isset($_SESSION['identity'])){
                $categoria = new Categoria();
                $categoria->setId($_GET['id']);
                $categoria->delete();
                header('Location: '.URL.'?controller=categorias&action=index');
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }
        public static function indexPlantas(){
            if(isset($_SESSION['identity'])&& !isset($_SESSION['admin'])){
                $categoria = new Categoria();
                echo $GLOBALS["twig"]->render(
                    'categorias/indexPlantas.twig', 
                    [
                        'categorias' => $categoria->llamarPlantas(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=categorias&action=indexPlantas');
            }
        }
        public static function indexRosas(){
            if(isset($_SESSION['identity'])&& !isset($_SESSION['admin'])){
                $categoria = new Categoria();
                echo $GLOBALS["twig"]->render(
                    'categorias/indexRosas.twig', 
                    [
                        'categorias' => $categoria->llamarRosas(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=categorias&action=indexRosas');
            }
        }

        public static function indexFLores(){
            if(isset($_SESSION['identity'])&& !isset($_SESSION['admin'])){
                $categoria = new Categoria();
                echo $GLOBALS["twig"]->render(
                    'categorias/indexFlores.twig', 
                    [
                        'categorias' => $categoria->llamarFlores(),
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=categorias&action=indexFlores');
            }
        }
    }
?>