<?php

class Signup
{
    use Controller;

    public function index()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $citizen = new Citizen;

            $nic = $_POST['nic'] ?? '';
            $bcnumber = $_POST['bcnumber'] ?? '';

            // Verify NIC and BC Number
            $citizen_verified = false;
            if ($row = $citizen->first(['nic' => $nic])) {
                if ($row->bcnumber === $bcnumber) {
                    $citizen_verified = true;
                } else {
                    $citizen->errors['bcnumber'] = "Birth Certificate number does not match.";
                }
            } else {
                $citizen->errors['nic'] = "NIC does not exist in the records.";
            }

            $data['citizen_errors'] = $citizen->errors;
            // Proceed only if citizen verification is successful
            if ($citizen_verified) {
                $user = new User;
                // Validate user data
                if ($user->validate($_POST)) {
                    // Hash the password and add timestamp
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $_POST['date'] = date('Y-m-d H:i:s');

                    // Save to database
                    $user->insert($_POST);

                    // Redirect to login page
                    header('Location: login');
                    exit; // Ensure no further code execution
                }

                // Collect user validation errors
                $data['errors'] = $user->errors;
            }
        }

        // Load the signup view with data
        $this->view('Signup', $data);
    }
}