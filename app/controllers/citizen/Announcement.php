<?php

class Announcement
{
    use Controller;

    public function index()
    {
        $userModel = new User();
        $userrole = $userModel->getRole();

        $model = new AnnouncementModel();
        $user_id = $_SESSION['user_id'];
        $announcements = $model->getAnnouncements($user_id);

        $communityModel = new CommunityModel();
        $community_services = $communityModel->getAll($userrole); // Fetch all community services

        $Rulemodel = new RuleModel();
        $rules = $Rulemodel->getAll($userrole); // Fetch all rules

        $this->view('citizen/Announcement', [
            'announcements' => $announcements,
            'community_services' => $community_services,
            'rules' => $rules
        ]);
    }
}
