<?php 

/**
 * home class
 */
class Editform
{
	use Controller;

	public function index()
	{

		$this->view('agn/editform');
	}

    // public function popup($id){
    //     $randrModel = new RandRModel();
    //     $Ruledata = $randrModel->where(['id' => $id]);
    //     $this->view('agn/viewmore', ['Ruledata' => $Ruledata]); // Pass data to the view

    // }

    
    

    public function editform($id)
    {
        $randrModel = new RandRModel();
        
        // Fetch record by ID
        $Editdata = $randrModel->where(['id' => $id]);
        
        if (!empty($Editdata)) {
            // Render the edit form view with the data
            $this->view('agn/editform', ['Editdata' => $Editdata]);
        } else {
            // Redirect or show an error if the record is not found
            header("Location: " . ROOT . "/agn/RandR");
        }
    }

    public function update_form()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedata = new RandRModel();
            $id = $_POST['id'];
    
            $data = [
                'Rule_title' => !empty($_POST['Rule_title']) ? $_POST['Rule_title'] : $existingData['Rule_title'],
                'Description' => !empty($_POST['Description']) ? $_POST['Description'] : $existingData['Description'],
                'status' => !empty($_POST['status']) ? $_POST['status'] : $existingData['status'],
            ];
    
            if ($updatedata->update($id, $data)) {
                // Redirect back to the RandR page
                header("Location: " . ROOT . "/agn/RandR");
            } else {
                die("Update failed");
            }
        }
    }
    
}




