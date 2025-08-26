<?php

class Login
{
    use Controller;
    
    public function index()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User;

            // Validate the login credentials
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if ($row = $user->first(['username' => $username])) {
                // Check if the password is correct
                if (password_verify($password, $row->password)) {
                    // Check if user is active
                    if ($row->is_active === 0) {
                        $user->errors['username'] = "Your account is not active. Please contact your administrator.";
                    } else {
                        // Authenticate user
                        $_SESSION['user_id'] = $row->user_id;
                        $_SESSION['user_role'] = $row->role;
                        
                        // Update last login
                        // Correct way to call update: update($id, $data, $id_column = 'id')
                        $user->update(
                            $row->user_id,  // First parameter: ID value
                            ['last_login' => date('Y-m-d H:i:s')],  // Second parameter: data to update
                            'user_id'  // Third parameter: ID column name
                        );
                        
                        // Redirect to appropriate dashboard based on user role
                        if($row->role === 'gn') {
                            header('Location: gn/dashboard');
                            exit; // Ensure no further code executes
                        } else if ($row->role === 'agn') {
                            header('Location: agn/dashboard');
                            exit; // Ensure no further code executes
                        } else if ($row->role === 'citizen') {
                            header('Location: citizen/home');
                            exit; // Ensure no further code executes
                        } else {
                            $user->errors['username'] = "Error retrieving user role";
                        }
                    }
                } else {
                    $user->errors['username'] = "Invalid username or password";
                }
            } else {
                $user->errors['username'] = "Invalid username or password";
            }

            $data['errors'] = $user->errors;
        }

        $this->view('Login', $data);
    }
}