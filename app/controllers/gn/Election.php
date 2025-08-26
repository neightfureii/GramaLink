<?php 

class Election
{
    use Controller;
    
    public function index()
    {
         // Create a Voter model instance to fetch voter data
        $voters = new Vote();

        // Get filter parameters
        $status_filter = $_GET['status'] ?? 'all';

        // Get filtered voters based on status
        if($status_filter != 'all'){
            $voterList = $voters->getVoterStatus($status_filter);
        }else{
            $voterList = $voters->getAllVoters();
        }
        

        //check if $voters is an array before counting
        $votercount = is_array($voterList) ? count($voterList) : 0;

        //get next election date from database
        $electionDate =  new ElectionDate();
        $nextElection = $electionDate->getNextElection();

        //format the next election date

        
        $nextElectionDisplay = $nextElection ? date('Y-m-d', strtotime($nextElection[0]->election_date)) : 'Not scheduled';
        
        //format the next election date - handle both array and object return 

        // if(is_array($nextElection) && !empty($nextElection)) {
        //     $nextElectionDisplay = date('Y-m-d', strtotime($nextElection[0]->election_date));
        // } elseif (is_object($nextElection)) {
        //     $nextElectionDisplay = date('Y-m-d', strtotime($nextElection->election_date));
        // } else {
        //     $nextElectionDisplay = 'Not scheduled';
        // }

        //get polling centers count
        $pollingCenters = new PollingCenter();
        $pollingCenterList = $pollingCenters->getAllPollingCenters();
        $pollingCenterCount = is_array($pollingCenterList) ? count($pollingCenterList) : 0;


        //prepare statistics for the dashboard
        $stats = [
            'registeredVoters' => $votercount,
            'nextElection' => $nextElectionDisplay, 
            'pollingCenters' => $pollingCenterCount 

        ];

        //pass data to the view

        $data = [
            'stats' => $stats,
            'voters' => $voterList ?: []
        ];

        $this->view('gn/Election',$data);
        // $this->view('gn/Election');
    }

    public function updateDate()
    {
        $electionDateModel = new ElectionDate();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $formData = [
                'election_date' => $_POST['election-Date'],
                'election_type' => $_POST['election-type'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // check if date is in future
            $currentDate = date('Y-m-d');
            $electionDate = date('Y-m-d', strtotime($formData['election_date']));
            if ($electionDate < $currentDate) {
                // Handle the case where the election date is in the past
                // You can display an error message or redirect to an error page
                $_SESSION['error_message'] = "Error: You cannot set an election date in the past.";
                header("Location: " . ROOT . '/gn/election' );
                exit;
            }

            $electionDateModel->insert($formData) ;
            header("Location: " . ROOT . '/gn/election' );
            exit;
                  
                
            } 
        
    }

    public function updatePollingCenter()
    {
        $pollingCenterCountModel = new PollingCenter();
        if ($_SERVER['REQUEST_METHOD']== 'POST'){
            $formData = [
                'name' => $_POST['polling-center-name'],
                'address' => $_POST['polling-center-address'],
                'contact' => $_POST['polling-center-contact']
            ];

            //check if polling center already exists
            $existingPollingCenter = $pollingCenterCountModel->getPollingCenterByName($formData['name']);
            if($existingPollingCenter){
                $_SESSION['error_message_polling'] = "Error: Polling center already exists.";
                header("Location: " . ROOT . '/gn/election' );
                exit;
            }

            //check center contact number
            $contact = $formData['contact'];
            if(!preg_match('/^\d{10}$/', $contact)){
                $_SESSION['error_message_number'] = "Error: Invalid contact number. Check it.";
                header("Location: " . ROOT . '/gn/election' );
                exit;
            }
            $pollingCenterCountModel->insert($formData);
            header("Location: " . ROOT . '/gn/election' );
            exit;
        }
    }

    public function updateStatus($nic, $status)
    {
    $voteModel = new Vote();
    $voteModel->updateStatus($nic, $status);
    header("Location: " . ROOT . '/gn/election' );
    }

    public function deleteVoter(){
        $voteModel = new Vote();
        $voteModel->deleteVoter();
        header("Location: " . ROOT . '/gn/election' );
    }
}