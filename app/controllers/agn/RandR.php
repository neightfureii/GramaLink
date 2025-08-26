<?php

class RandR {
    use Controller;

    public function index() {
        $randrModel = new RandRModel();
        $Ruledata = $randrModel->findAll(); // Fetch all data
        $this->view('agn/RandR', ['Ruledata' => $Ruledata]); // Pass data to the view
    }

    public function create() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $randrModel = new RandRModel();
            $data = []; // Initialize data array for potential errors
    
            // Validate and handle file upload
            $filePath = null;
            if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                // Define upload directory
                $uploadDir = URLROOT . '/../public/uploads/';
                
                // Ensure upload directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                // Get file details
                $fileTmpPath = $_FILES['document']['tmp_name'];
                $fileName = basename($_FILES['document']['name']);
                $fileSize = $_FILES['document']['size'];
                $fileType = $_FILES['document']['type'];
    
                // Validate file type (optional but recommended)
                $allowedTypes = ['application/pdf'];
                if (!in_array($fileType, $allowedTypes)) {
                    $data['errors'][] = "Invalid file type. Only PDFs are allowed.";
                }
    
                // Validate file size (optional, example: limit to 5MB)
                if ($fileSize > 5 * 1024 * 1024) {
                    $data['errors'][] = "File is too large. Maximum size is 5MB.";
                }
    
                // If no errors, proceed with upload
                if (empty($data['errors'])) {
                    // Create a unique filename
                    $uniqueFileName = uniqid() . '_' . $fileName;
                    $destination = $uploadDir . $uniqueFileName;
    
                    // Move the uploaded file
                    if (move_uploaded_file($fileTmpPath, $destination)) {
                        // Store relative path in database
                        $filePath = '/uploads/' . $uniqueFileName;
                    } else {
                        $data['errors'][] = "Failed to move uploaded file.";
                    }
                }
            }
            // $data =[
            //     'Rule_title' => $_POST['Rule_title'],
            //     'Description' => $_POST['Description'],
            //     'status' => $_POST['status'],
            // ];
            // if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
            //     $target_dir = "profile-images/";
            //     if (!is_dir($target_dir)) {
            //         mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
            //     }

            //     $file_name = basename($_FILES['pdf']['name']);
            //     $target_file = $target_dir . uniqid() . "_" . $file_name;

            //     // Validate image type
            //     $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //     $allowed_types = ['jpg', 'jpeg', 'png', 'gif','pdf'];
            //     if (!in_array($file_type, $allowed_types)) {
            //         $_SESSION['error'] = "Only PDF,JPG, JPEG, PNG & GIF files are allowed.";
            //         $this->view('agn/EditRandR', $data);
            //         return;
            //     }

            //     // Check if the file is a valid image
            //     if (getimagesize($_FILES['pdf']['tmp_name']) === false) {
            //         $_SESSION['error'] = "The selected file is not a valid image.";
            //         $this->view('agn/EditRandR', $data);
            //         return;
            //     }

            //     // Move the uploaded file to the target directory
            //     if (move_uploaded_file($_FILES['pdf']['tmp_name'], $target_file)) {
            //         $data['pdf'] = $target_file; // Add the file path to the $data array
            //     } else {
            //         $_SESSION['error'] = "Failed to upload the profile picture.";
            //         $this->view('agn/EditRandR', $data);
            //         return;
            //     }
            // }
            // Prepare data for database insertion
            $data = array_merge($data, [
                'Rule_title' => $_POST['Rule_title'] ?? '',
                'Description' => $_POST['Description'] ?? '',
                'status' => $_POST['status'] ?? 'Inactive',
                'pdf' => $filePath
            ]);
           
    
            // Check for any errors before insertion
            if (empty($data['errors'])) {
                try {
                    $randrModel->insert($data);
                    print_r($data);
                    header("Location: " . ROOT . "/agn/RandR");
                    exit;
                } catch (Exception $e) {
                    $data['errors'][] = "Database insertion failed: " . $e->getMessage();
                }
            }
    
            // If there are errors, you might want to re-render the form with error messages
            $this->view('agn/CreateRandR', $data);
        }
    
        $this->view('agn/CreateRandR');
    }
    

    public function edit($id) {
        $randrModel = new RandRModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description']
            ];
            $randrModel->update($id, $data);
            header("Location: /RandR");
        }

        $item = $randrModel->first(['id' => $id]);
        $this->view('agn/EditRandR', ['item' => $item]);
    }


    public function where($id){
        $randrModel = new RandRModel();
        $Ruledata = $randrModel->where(['id' => $id]);
        $this->view('agn/RandR', ['Ruledata' => $Ruledata]); // Pass data to the view

    }

    
    public function delete($id) {
        $randrModel = new RandRModel();
        if($randrModel->delete($id))
        {
            header("Location: " . ROOT . "/agn/RandR");
            exit;
        }else{
            header("Location: " . ROOT . "/agn/RandR");
        }
        
    }
}
