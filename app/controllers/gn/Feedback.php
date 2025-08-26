<?php

class Feedback
{
    use Controller;
    
    public function index()
    {
        $feedbackModel = new FeedbackA();

        $feedbackData = $feedbackModel->findAllwithoutlimit();

        $this->view('gn/feedback',['feedbackData' => $feedbackData]);
    }
    //update Feedback as Read
    public function markAsRead($id)
    {
        $feedbackModel = new FeedbackA();
        if (is_numeric($id)) {
            $data = ['Mark_as_Read' => 1];
    
            // Update feedback status
            if ($feedbackModel->update($id, $data)) {
                echo "Update successful!";
            } else {
                echo "Failed to update.";
                exit;
            }
    
            // Redirect to feedback page
            header("Location:" . ROOT . "/gn/feedback");
            exit;
        } else {
            die("Invalid feedback ID");
        }
    }


    //delete feedback

    public function delete($id = null)
    {
        if(!$id){
            die("No feedback ID provided .");
        }

        $feedbackModel = new FeedbackA();

        //call delete function inside the Model.php

        if($feedbackModel->delete($id)){
            
            header("Location: " . ROOT . "/gn/feedback");
            exit;

        }else{
            // die("Failed to delete feedback");
        }
    }
    


}

