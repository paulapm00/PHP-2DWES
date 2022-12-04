<?php 
    require_once 'models/Pedido.php';

    class PedidosController{
       
        public static function index(){
            if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
                
                echo $GLOBALS['twig']->render('pedidos/index.twig', 
                    [
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }
        }

        public static function show(){
            if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
               
                echo $GLOBALS['twig']->render('pedidos/show.twig', 
                    [
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }
        }


        /**
         * 
         */
        public static function save(){
            if(isset($_SESSION['carrito']) && isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
                
            }else{
                header('Location: '.URL.'?controller=pedido&action=login');
            }
        }

        
        /**
         * 
         */
        public static function delete(){
            if(isset($_SESSION['carrito']) && isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
                
            }else{
                header('Location: '.URL.'?controller=auth&action=login');
            }
        }
    }
?>