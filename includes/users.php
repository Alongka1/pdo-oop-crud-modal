<?php 

    require_once 'config.php';

    class Users extends Config {
        public function insert($fname, $lname, $email, $phonenumber) {
            $sql = "INSERT INTO tblusers(firstname, lastname, email, phonenumber) VALUES(:fname, :lname, :email, :phonenumber)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phonenumber' => $phonenumber
            ]);
            return true;
        }

        public function read() {
            $sql = "SELECT * FROM tblusers ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function readOne($id) {
            $sql = "SELECT * FROM tblusers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch();
            return $result;
        }

        public function update($id, $fname, $lname, $email, $phonenumber) {
            $sql = "UPDATE tblusers SET firstname = :fname, lastname = :lname, email = :email, phonenumber = :phonenumber WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phonenumber' => $phonenumber,
                'id' => $id,
            ]);
            return true;
        }

        public function delete($id) {
            $sql = "DELETE FROM tblusers WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        }
    }

?>