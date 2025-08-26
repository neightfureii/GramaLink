<?php

class RandRModel {
    use Model;

    protected $table = 'rule_and_regulations'; // Specify your table name
    protected $allowedColumns = ['id', 'Rule_title', 'last_Updated', 'Description', 'status','pdf']; // Specify allowed columns for inserts/updates
}
