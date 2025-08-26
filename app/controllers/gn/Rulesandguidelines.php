<?php

class Rulesandguidelines
{
    use Controller;
    
    public function index()
    {
        $Rulemodel = new RuleModel();
        $RuleData = $Rulemodel->findAll();

        $this->view('gn/rulesandguidelines',['RuleData' => $RuleData]);
    }
}