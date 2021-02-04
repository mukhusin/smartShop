<?php 
  
    class Auth extends DatabaseConnection
    {

        public function Authentication(){
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $data = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ? ");
            $data->execute([$username,md5($password)]);
            if ($data->rowCount() == 1) {
                $userData = $data->fetch();
                session_start();
                $_SESSION['username'] = $userData['username'];
                $_SESSION['role'] = $userData['role'];
                $_SESSION['userID'] = $userData['id'];
                 echo 1;
            } else {
                echo 0;
            }
            
        }

        public function logout(){
            session_destroy();
            header('location: ../');
        }

        public function sessionValues($value){
            echo $_SESSION[$value];
        }

        public function redirect(){
            session_start();
            if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
                 if ($_SESSION['role'] == 'Saler') {
                     header('location: ../saler/');
                 }

                 if ($_SESSION['role'] == 'Manager') {
                    header('location: ../manager/');
                 }

            }else {
                session_destroy();
                header('location: ../');
            }
        }
    }
    

?>