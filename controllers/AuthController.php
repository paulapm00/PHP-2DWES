<?php 
require_once 'models/Producto.php';
require_once 'models/Categoria.php';
    class AuthController{
        /**
         * Funcion que redirige a la vista del login
         */
        public function login(){
            echo $GLOBALS['twig']->render('auth/login.twig',
                [
                    'URL' => URL
                ]
            );
        }

        /**
         * Funcion que redirige a la vista del home
         */
        public function home(){
            if(isset($_SESSION['identity'])){
                echo $GLOBALS['twig']->render('home.twig', 
                    [
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }else{
                header('Location: '.URL.'?controller=index&action=index');
            }
        }
        public function register (){
            echo $GLOBALS['twig']->render('auth/register.twig', 
                    [
                        'URL' => URL
                    ]
                );
        }

        public function doRegister(){
            $user = new User();
                $user->setNombre($_POST['nombre']);
                $user->setApellidos($_POST['apellidos']);
                $user->setEmail($_POST['email']);
                if(isset($_POST['password'])){
                    $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
                }
                $user->save();//llama a la funcion save del models user e inserta los datos en la bas de datos
                header('Location: '.URL.'?controller=auth&action=login');
        }
        /**
         * Funcion que cierra la sesion siempre y cuando encuentre un $_SESSION['identity]
         */
        public function logout(){
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
            header('Location: '.URL.'?controller=auth&action=home');
        }

        public function doLogin(){
       
            /**
             * Recojo email y password de mi formulario de login
             * - Verificar si el email y el password coinciden con el de mi base de datos
             * - Debo tener en cuenta que mi password est?? encriptado. ??Metodo?
             * - Utilizo el modelo User para lanzar el metodo que comprueba si he introducido los datos correctamente.
             * 
             */

            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user_ok = $user->login(); // objeto usuario si correcto o false si no correcto

            /**
             * Almaceno en $user_ok el resultado de mi metodo login()
             * 
             * Compruebo si $user_ok es un objeto (este es caso true)
             * entonces almaceno el objeto $user_ok en mi $_SESSION con el
             * nombre 'identity'
             */

             /**
              * Debo distinguir a que vista llevo a mi administrador y a mi cliente. Deben ser distintas
              */
             
             if($user_ok && is_object($user_ok)){
                $_SESSION['identity'] = $user_ok;

                if(isset($_SESSION['admin'])){
                    // si nos indentificamos con un usuario admin nos lleva a la pagina de home 
                    header('Location: '.URL.'?controller=auth&action=home');
                }else{
                    /**en caso de no ser un usuario adminitrador nos lleva a la pagina de welcome que corresponde 
                     * a la pagina del cliente
                     *  */ 
                    header('Location: '.URL.'?controller=auth&action=welcome');
                }
             }else{
                header('Location: '.URL.'?controller=auth&action=login');
             }
        }

        /**
         * Funcion que me lleva a la vista de CLIENTE
         */
        public static function welcome(){
            if(isset($_SESSION['identity'])){
                $producto = new Producto();
                $categoria = new Categoria();
                echo $GLOBALS['twig']->render('welcome.twig', 
                        [
                            'productos' => $producto->findAll(),
                            'categorias' => $categoria->findAll(),
                            'identity' => $_SESSION['identity'],
                            'URL' => URL
                        ]
                    );
            }else{
                header('Location: '.URL.'?controller=index&action=index');
            }
        }
    }
?>