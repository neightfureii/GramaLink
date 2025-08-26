<?php

class User {
    use Model;

    protected $table = 'users';

    protected $allowedColumns = [
        'username',
        'email',
        'mobileNumber',
        'password',
        'role',
        'created_at',
        'last_login',
    ];

    public function validate($data) {
        $this->errors = [];

        if (empty($data['username'])) {
            $this->errors['username'] = 'Username is required';
        }

        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format';
        }

        if (empty($data['mobileNumber'])) {
            $this->errors['mobileNumber'] = 'Mobile number is required';
        } elseif (!preg_match('/^[0-9]{10}$/', $data['mobileNumber'])) {
            $this->errors['mobileNumber'] = 'Invalid mobile number format';
        }
        
        if (empty($data['password'])) {
            $this->errors['password'] = 'Password is required';
        } elseif (strlen($data['password']) < 8) {
            $this->errors['password'] = 'Password must be at least 8 characters long';
        }

        //check if confirmpassword matched password
        if (!empty($data['confirmpassword']) && $data['confirmpassword']!= $data['password']) {
            $this->errors['confirmpassword'] = 'Passwords do not match';
        }

        if (empty($data['terms'])) {
            $this->errors['terms'] = 'You must agree to the terms';
        }

        return empty($this->errors);
    }

    public function getRole() {
        $sql = "SELECT role FROM $this->table WHERE user_id = :user_id";
        $params = [':user_id' => $_SESSION['user_id']];
        return $this->query($sql, $params)[0]->role ?? null;
    }

    public function getUserById($user_id)
    {
        $query = "SELECT * 
          FROM users 
          LEFT JOIN citizen ON users.user_id = citizen.user_id 
          LEFT JOIN gndivisions g ON g.gn_division_id = citizen.gn_division_id
          WHERE users.user_id = :id";

        $params = ['id' => $user_id];

        return $this->query($query, $params)[0] ?? null;
    }

    public function getCitizenById($user_id) {
        $query = "SELECT * 
          FROM users 
          LEFT JOIN citizen ON users.user_id = citizen.user_id 
          WHERE users.user_id = :id";

        $params = ['id' => $user_id];

        return $this->query($query, $params)[0] ?? null;
    }

    public function getGNById($user_id)
    {
        $query = "SELECT users.*, gn.* 
          FROM users 
          LEFT JOIN gn ON users.user_id = gn.user_id 
          WHERE users.user_id = :id";

        $params = ['id' => $user_id];

        return $this->query($query, $params)[0] ?? null;
    }

    public function storeResetToken($email, $token)
    {
        $con = $this->connect();
        $stmt = $con->prepare("INSERT INTO password_resets(email,token) VALUES (?,?)
            ON DUPLICATE KEY UPDATE token = VALUES(token),created_at = NOW()");
        $stmt->execute([$email,$token]);    
    }

    public function getResetToken($token)
    {
        $con = $this->connect();
        $stmt = $con->prepare("SELECT * FROM password_resets WHERE token =? AND created_at >= NOW() - INTERVAL 1 HOUR");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updatePassword($email,$newPassword)
    {
        $hashedPassword = password_hash($newPassword,PASSWORD_DEFAULT);
        $con = $this->connect();
        $stmt = $con->prepare("UPDATE users SET password = ? WHERE email = ?");
        return $stmt->execute([$hashedPassword,$email]);

    }

    public function deleteResetToken($token)
    {
        $con = $this->connect();
        $stmt = $con->prepare("DELETE FROM password_resets WHERE token = ?");
        return $stmt->execute([$token]);
    }

    public function updatePwd($user_id, $pwd) {
        $query = "UPDATE $this->table SET password = :password WHERE user_id = :id";
        $params = [
            ':password' => $pwd,
            ':id' => $user_id
        ];
        return $this->query($query, $params);
    }

    public function getGNByIdAll($user_id)
    {
        $query = "SELECT users.*, gn.*, gndivisions.*, users.is_active AS user_is_active, gn.is_active AS gn_is_active 
          FROM users 
          LEFT JOIN gn ON users.user_id = gn.user_id 
          LEFT JOIN gndivisions ON gndivisions.gn_division_id = gn.gn_division_id 
          WHERE users.user_id = :id";

        $params = ['id' => $user_id];

        return $this->query($query, $params)[0] ?? null;
    }

    public function getAGNById($user_id)
    {
        $query = "SELECT users.*, agn.* 
          FROM users 
          LEFT JOIN agn ON users.user_id = agn.user_id 
          WHERE users.user_id = :id";

        $params = ['id' => $user_id];

        return $this->query($query, $params)[0] ?? null;
    }

    public function addNewGNUser($data) {
        $query = "INSERT INTO $this->table (username, password, email, mobileNumber, role) VALUES (:username, :password, :email, :mobileNumber, :role)";
        $params = [
            ':username' => $data['gnEmployeeIdadd'],
            ':password' => $data['password'],
            ':email' => $data['gnEmailadd'],
            ':mobileNumber' => $data['gnContactadd'],
            ':role' => 'gn'
        ];

        return $this->query($query, $params);
    }

    public function addNewCitizenUser($data) {
        $query = "INSERT INTO $this->table (username, password, email, mobileNumber, image, role) VALUES (:username, :password, :email, :mobileNumber, :image, :role)";
        $params = [
            ':username' => $data['citizenEmail'],
            ':password' => password_hash($data['citizenNIC'], PASSWORD_DEFAULT),
            ':email' => $data['citizenEmail'],
            ':mobileNumber' => $data['citizenContact'],
            ':image' => $data['imagePath'],
            ':role' => 'citizen'
        ];

        return $this->query($query, $params);
    }

    public function getUserIDLastGN() {
        $query = "SELECT user_id FROM $this->table WHERE role = 'gn' ORDER BY user_id DESC LIMIT 1";
        return $this->query($query)[0]->user_id ?? null;
    }

    public function getUserIDLastCitizen() {
        $query = "SELECT user_id FROM $this->table WHERE role = 'citizen' ORDER BY user_id DESC LIMIT 1";
        return $this->query($query)[0]->user_id ?? null;
    }

    public function updateProfileImage($user_id, $imagePath) {
        $query = "UPDATE $this->table SET image = :imagePath WHERE user_id = :id";
        $params = [
            ':imagePath' => $imagePath,
            ':id' => $user_id
        ];
        return $this->query($query, $params);
    }

    public function updateUserFromRequest($data) {
        if ($data->image != null) {
            $sql = "UPDATE $this->table SET image = :image WHERE user_id = :user_id";
            $params[':image'] = $data->image;
        } else if ($data->email != null) {
            $sql = "UPDATE $this->table SET email = :email WHERE user_id = :user_id";
            $params[':email'] = $data->email;
        } else if ($data->mobileNumber != null) {
            $sql = "UPDATE $this->table SET mobileNumber = :mobileNumber WHERE user_id = :user_id";
            $params[':mobileNumber'] = $data->mobileNumber;
        }
        $params['user_id'] = $data->user_id;
        return $this->query($sql, $params);
    }

    public function getPhoneNumberByUserId($user_id) {
        $query = "SELECT mobileNumber FROM $this->table WHERE user_id = :id";
        $params = [':id' => $user_id];
        return $this->query($query, $params)[0] ?? null;

    }

    public function updateCitizen($data) {
        $query = "UPDATE $this->table SET mobileNumber = :mobileNumber, email = :email WHERE user_id = :user_id";
        $params = [
            ':mobileNumber' => $data['mobileNumber'],
            ':email' => $data['email'],
            ':user_id' => $data['user_id']
        ];

        return $this->query($query, $params);
    }

    public function updateContactDetails($user_id, $email, $mobileNumber) {
        $query = "UPDATE $this->table SET email = :email, mobileNumber = :mobileNumber WHERE user_id = :user_id";
        $params = [
            ':email' => $email,
            ':mobileNumber' => $mobileNumber,
            ':user_id' => $user_id
        ];
        try {
            $this->query($query, $params);
            return true; 
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteUser($user_id) {
        $query = "UPDATE $this->table SET is_active = 0 WHERE user_id = :id";
        $params = [':id' => $user_id];
        return $this->query($query, $params);
    }
}
