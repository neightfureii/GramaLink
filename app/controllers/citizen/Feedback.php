<?php

class Feedback
{
    use Controller;
    
    public function index()
    {
        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }

        if ($_SESSION['user_role'] === 'agn') {
            header('Location:'.ROOT.'/agn/dashboard');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }

        $feedback = new FeedbackA();
        $currentUserId = $_SESSION['user_id'] ?? null;

        $feedbackData = [];
        $isSucess = false; //Track success status

        if($currentUserId){
            $feedbackData = $feedback->where(['user_id' => $currentUserId]);
        }
        // $feedbackData = $feedback->findAll();
        $data = [
            'errors' => [], //initialize errors
            'feedbackData' => $feedbackData,
            'isSucess' => $isSucess,
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $formData = [
                'Name' => $_POST['name'] ?? null,
                'Email' => $_POST['email'] ?? null,
                'Text' => $_POST['text'] ?? null,
                'Rating' => $_POST['rating'] ?? null,
                'user_id' => $currentUserId,
            ];

            //mark rating
            if($formData['Rating'] == 1)
            {
                $formData['Status'] = 'Exemplary Service';
            }
            elseif($formData['Rating'] == 2){
                $formData['Status'] = 'Above Expectations';
            }elseif($formData['Rating'] == 3){
                $formData['Status'] = 'Meets Expectations';
            }elseif($formData['Rating'] == 4){
                $formData['Status'] = 'Below Expectations';
            }elseif($formData['Rating'] == 5){
                $formData['Status'] = 'Unacceptable Service';
            }


            if($feedback->validate($formData))
            {
                $feedback->insert($formData);
                $isSucess = true;
                $data['isSucess'] = $isSucess;
                header("Location: " . ROOT . "/citizen/feedback");
            }else{
                $data['errors'] = $feedback->errors;
            }

        }
        $this->view('citizen/Feedback',$data);
    }

    public function Edit($id)
    {
        $feedbackModel = new FeedbackA();
        if (is_numeric($id)) {
            $data = ['Text'=> 1];
    
            // Update feedback status
            if ($feedbackModel->update($id, $data)) {
                echo "Update successful!";
            } else {
                echo "Failed to update.";
                exit;
            }
    
            // Redirect to feedback page
            header("Location:" . ROOT . "/citizen/feedback");
            exit;
        } else {
            die("Invalid feedback ID");
        }
    }
}

