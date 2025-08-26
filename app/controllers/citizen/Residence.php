<?php

class Residence
{
    use Controller;

    public function index()
    {
        $this->view('citizen/Residence');
    }

    public function verify() {
        $votemodel = new Vote();
        $_POST['id'] = $votemodel->getLastId();

        if(!empty($_POST['id'])) {
            
             // Handle file upload for document proof
             $documentProofName = '';
             if(isset($_FILES['documentProof']) && $_FILES['documentProof']['error'] == 0) {
                 $uploadDir = 'uploads/documents/';
                 
                 // Create directory if it doesn't exist
                 if(!file_exists($uploadDir)) {
                     mkdir($uploadDir, 0777, true);
                 }
                 
                 $documentProofName = time() . '_' . $_FILES['documentProof']['name'];
                 $destination = $uploadDir . $documentProofName;
                 
                 // Move uploaded file
                 if(move_uploaded_file($_FILES['documentProof']['tmp_name'], $destination)) {
                     $documentProofName = '/' . $destination; // Store path in database
                 }
             }
            $newData = [
                'duration_of_residence' => $_POST['duration'],
                 
                 'document_proof' => $documentProofName,
            ];

            $update = $votemodel->updateVote($newData,['id'=> $_POST['id']]);

            header("Location: " . ROOT . '/citizen/dashboard' );
     
    }
}
}