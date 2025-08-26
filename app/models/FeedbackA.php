<?php

class FeedbackA
{
    use Model;

    //specify the table name

    protected $table = 'feedback';
    //define allowed column

    protected $allowedColumns = [
        'ID',
        'Name',
        'Email',
        'Status',
        'Mark_as_Read',
        'Text',
        'user_id'
    ];

    

    public function validate($data)
    {
        $this->errors = [];
        if(empty($data['Email']))
        {
            $this->errors['Email'] = "Email is required";

        }else
        if(!filter_var($data['Email'],FILTER_VALIDATE_EMAIL))
        {
            $this->errors['Email'] = "Email is not valid";
        }

        if(empty($this->errors))
        {
            return true;
        }
        return false;

    }

}