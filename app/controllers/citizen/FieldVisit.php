<?php

class FieldVisit
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


        $visitModel = new FieldVisitA();
        $requests = $visitModel->getVisitRequestByUserId($_SESSION['user_id']);

        //Group by date
        if(!is_array($requests)){
            $requests = [];
        }
        $groupedRequests = [];
        foreach($requests as $req){
            $date = $req->visit_date;
            if (!isset($groupedRequests[$date])) {
                $groupedRequests[$date] = [];
            }
            $groupedRequests[$date][] = $req;
        }
        $data =[
            'groupedRequests' => $groupedRequests,
        ];

        $this->view('citizen/FieldVisit',$data);
    }

    public function visitRequestAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['request_id'] ?? null;
            $action = $_POST['action'] ?? null;
            if ($id && in_array($action, ['accept', 'reject'])) {
                $status = $action === 'accept' ? 'Accepted' : 'Rejected';
                $visitModel = new FieldVisitA();
                $visitModel->update($id, ['request_status' => $status]);
            }
        }
        header('Location: ' . ROOT . '/citizen/fieldvisit');
        exit;

    }
}
