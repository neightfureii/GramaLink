<?php

class Announcement
{
    use Controller;
    
    public function index()
    {
        //check if logged in user
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT.'/login');
        }

        if ($_SESSION['user_role'] === 'gn') {
            header('Location:'.ROOT.'/gn/dashboard');
        } else if ($_SESSION['user_role'] === 'citizen') {
            header('Location:'.ROOT.'/citizen/home');
        }

        $userModel = new User();
        $userrole = $userModel->getRole();

        $model = new AnnouncementModel();
        $announcements = $model->getAll($userrole);

        $communityModel = new CommunityModel();
        $community_services = $communityModel->getAll($userrole);

        $Rulemodel = new RuleModel();
        $rules = $Rulemodel->getAll($userrole);

        $this->view('agn/Announcement', [
            'announcements' => $announcements,
            'community_services' => $community_services,
            'rules' => $rules
        ]);
    }  

    public function insertAnnouncement()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AnnouncementModel();
            $model->addNewAnnouncement($_POST);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }

    public function insertCommunityService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CommunityModel();
            $model->addNewCommunityService($_POST);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }

    public function insertRule()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new RuleModel();
            $model->addNewRule($_POST);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }

    public function editAnnouncement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AnnouncementModel();
            $model->updateAnnouncement($_POST);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }

    public function editCommunityService() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CommunityModel();
            $model->updateCommunityService($_POST);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }

    public function editRule() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new RuleModel();
            $model->updateRule($_POST);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }
    public function deleteAnnouncement() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AnnouncementModel();
            $model->deleteAnnouncement($_POST['id']);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }
    
    public function deleteCommunityService() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CommunityModel();
            $model->deleteCommunityService($_POST['id']);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }
    
    public function deleteRule() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new RuleModel();
            $model->deleteRule($_POST['id']);
        }
        header('Location: ' . ROOT . '/agn/Announcement');
        exit;
    }
    
}