<?php

class User extends DatabaseConnection
{
    public function addUser()
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $role = $_POST['role'];

        // id 	name 	phone 	gender 	role 	username 	password 	created_at 	updated_at 	
        if ($name != "" && $phone != "" && $username != "" && $password != "" && $role != "") {

            if ($password == $cpassword) {
                $check = $this->connect()->prepare("SELECT * FROM `users` WHERE username = ? ");
                $check->execute([$username]);

                if ($check->rowCount() == 0) {
                    $stmt = $this->connect()->prepare("INSERT INTO users (name,username,phone,password,role,gender) VALUES(?,?,?,?,?,?)");
                    if ($stmt->execute([$name, $username, $phone, md5($password), $role, $gender])) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                    echo 3;
                }
            } else {
                echo 4;
            }
        } else {
            echo 2;
        }
    }

    public function fetchUser()
    {
        $data = $this->connect()->prepare("SELECT * FROM users");
        $data->execute();
        return $data->fetchAll();
    }

    public function userData($id)
    {
        $data = $this->connect()->prepare("SELECT * FROM users where id = ?");
        $data->execute([$id]);
        return $data->fetch();
    }

    public function deleteUser(){
        $id = $_POST['userID'];
        $DELETE = $this->connect()->prepare("DELETE FROM users WHERE id = ? ");
        $DELETE->execute([$id]);
        echo 1; //success
    }

    public function updateUser(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $role = $_POST['role'];

        $update = $this->connect()->prepare("UPDATE users SET name = ?, phone = ?, gender = ?, username = ?, role = ? where id = $id");
        if ($update->execute([$name, $phone, $gender, $username, $role])) {
             echo 1;
        } else {
             echo 0;
        }
        

    }

    public function changePassword(){
        session_start();
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $cpassword = $_POST['cpassword'];
        $username = $_SESSION['username'];
        $id = $_SESSION['userID'];

        $data = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND id = ? ");
        $data->execute([$username,md5($oldpassword),$id]);
        if ($cpassword == $newpassword) {
            if ($data->rowCount() == 1) {
                $update = $this->connect()->prepare("UPDATE users SET password = ? WHERE username = ? AND id = ? ");
                $update->execute([md5($newpassword),$username,$id]);
                echo 1; //success
            }else {
                echo 4; //for wrong current password
            }
        }else {
            echo 5; //for != cpass and newpass
        }
    }

}
