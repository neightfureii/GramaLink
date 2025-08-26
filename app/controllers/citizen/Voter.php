<?php 

class Voter 
{
    use Controller;

    public function index()
    {
        

         //get next election date from database
         $electionDate =  new ElectionDate();
         $nextElection = $electionDate->getNextElection();
 
         //format the next election date
 
         
         $nextElectionDisplay = $nextElection ? date('Y-m-d', strtotime($nextElection[0]->election_date)) : 'Not scheduled';
         
        //get search parameter
        $search_center = $_GET['search_center'] ?? '';

        
        
          //get polling centers count
        $pollingCenters = new PollingCenter();
        // $pollingCenterCount = is_array($pollingCenterList) ? count($pollingCenterList) : 0;
        

        // Get polling centers with search filter
        if(!empty($search_center)){
            $pollingCenterList = $pollingCenters->searchByName($search_center);
        }else{
        $pollingCenterList = $pollingCenters->getAllPollingCenters();
        }

        $citizen_id = $_SESSION['user_id'];
        $citizenModel = new Citizen();
        $citizenDetails= $citizenModel->getCitizenID($citizen_id);
        

         
         $stats = [
            'nextElection' => $nextElectionDisplay,
            // 'pollingCenters' => $pollingCenter // Example date, replace with actual logic to fetch next election date
        ];


        $this->view('citizen/Voter', ['stats' => $stats, 'pollcenters' => $pollingCenterList, 'citizenDetails' => $citizenDetails]); 
    }

    public function register()
    {
        $voterModel = new Vote();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            

              // Check if a record with this NIC already exists
            $existingRecord = $voterModel->find(['nic_number' => $_POST['nicNumber']]);


            
            $formData=[
                'voting_method' => $_POST['votingMethod'],
                'nic_number' => $_POST['nicNumber'],
                'head_of_house' => $_POST['headofHouse'],
                'relationship' => $_POST['relationship'],
                'status' => 'pending',
                'submitted_at' => date('Y-m-d H:i:s')
            ];

            // Check if voter already exists by NIC
         $existingVoter = $voterModel->getVoterByNIC($formData['nic_number']);
         if($existingVoter) {
         $_SESSION['error_message_NIC'] = "Error: Voter with this NIC already exists.";
           header("Location: " . ROOT . '/citizen/voter');
          exit;
        } else {
             // Insert new voter record
             $voterModel->insert($formData);
        }

    }
    header('Location: ' . ROOT . '/citizen/residence' );
    exit;
    
    }

}