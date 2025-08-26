<?php

class PendingComplaint
{
    use Controller;

    public function index(){
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }
    
        if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        } else if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        }
        
        $compalintModel = new ComplaintM();

        $result  = $compalintModel->getpendingcomplaintCount();
        
        if(!is_array($result)){
            $result =[];
        }
        $groupedComplaints =[];
        foreach($result as $complaint){
            $gn_id = $complaint->gn_id;
            $gn_name = $complaint->gn_name;
            if(!isset($groupedComplaints[$gn_id])){
                $groupedComplaints[$gn_id] =[
                    'gn_name' => $gn_name,
                    'complaints' => []
                ];
            }
            $images = $compalintModel->getComplaintImages($complaint->complaint_id);
            if(!is_array($images)){
                $images =[];
            }
            $groupedComplaints[$gn_id]['complaints'][] =[
                'complaint' => $complaint,
                'images' => $images,
            ];
           
        }

        $data = [
            'groupedComplaints' =>$groupedComplaints
        ];
    
        $this->view('agn/PendingComplaint', $data);
    }
    
}
