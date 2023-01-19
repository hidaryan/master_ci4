<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table            = 'md_disposisi';
    protected $primaryKey       = 'ID_SURAT';
    protected $useTimestamps    = true;
    protected $allowedFields    = [];


    public function getNde($ID)
    {
    }
}
