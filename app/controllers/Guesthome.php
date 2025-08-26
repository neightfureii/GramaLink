<?php

class Guesthome
{
    use Controller;
    
    public function index()
    {
        $this->view('guestHome');
    }
}
