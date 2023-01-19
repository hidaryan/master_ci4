<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table      = 'md_dokument';
    protected $primaryKey = 'REF';
    protected $useTimestamps = true;
    protected $allowedFields = [];


    public function getNde($ID)
    {
    }
}
