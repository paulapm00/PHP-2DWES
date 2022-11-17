<?php 
    require_once 'models/User.php';

    class UsersController{
       
        /**
         * 
         */
        public static function index(){
            if(isset($_SESSION['identity'])){
                $user = new User();
                echo $GLOBALS["twig"]->render(
                    'users/index.twig', 
                    ['users' => $user->findAll()]
                );
            }else{
                header('Location: http://localhost/proyectos/2DAW-CLASE-PHP/?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function create(){
            if(isset($_SESSION['identity'])){
                echo $GLOBALS["twig"]->render(
                    'users/create.twig'
                );
            }else{
                header('Location: http://localhost/proyectos/2DAW-CLASE-PHP/?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function show(){
            if(isset($_SESSION['identity'])){
                $user = new User();
                echo $GLOBALS["twig"]->render(
                    'users/show.twig', 
                    ['user' => $user->findById($_GET['id'])]
                );
            }else{
                header('Location: http://localhost/proyectos/2DAW-CLASE-PHP/?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function edit(){
            if(isset($_SESSION['identity'])){
                $user = new User();
                echo $GLOBALS["twig"]->render(
                    'users/edit.twig', 
                    ['user' => $user->findById($_GET['id'])]
                );
            }else{
                header('Location: http://localhost/proyectos/2DAW-CLASE-PHP/?controller=auth&action=login');
            }
        }

        /**
         * 
         */
        public static function save(){
            $user = new User();
            $user->setNombre($_POST['nombre']);
            $user->setApellidos($_POST['apellidos']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->save($user);
            header("Location: http://localhost/proyectos/2DAW-CLASE-PHP/?controller=users&action=index");
        }

        /**
         * 
         */
        public static function update(){
            $user = new User();
            $user->setId($_POST['id']);
            $user->setNombre($_POST['nombre']);
            $user->setApellidos($_POST['apellidos']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->update();
            header("Location: http://localhost/proyectos/2DAW%20-%20DWES%20-%20PHP/09%20-%20controladores/?controller=users&action=index");
        }
        /**
         * 
         */
        public static function delete(){
            $user = new User();
            $user->setId($_GET['id']);
            $user->delete();
            header("Location: http://localhost/proyectos/2DAW%20-%20DWES%20-%20PHP/CLASE/11_07_2022-Controllers/?controller=users&action=index");
        }
    }
?>