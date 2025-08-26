<?php

class Feedbackview
{
    use Controller;
    
    public function index()
    {
        $this->view('citizen/Feedbackview');
    }


    public function popup($id){
        $feedbackModel = new FeedbackA();
        $feedbackData = $feedbackModel->where(['id' => $id]);
        $this->view('citizen/Feedbackview', ['feedbackData' => $feedbackData]); // Pass data to the view

    }
}
