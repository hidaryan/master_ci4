<?php

namespace App\Models;

use CodeIgniter\Model;

class CaptchaModel extends Model
{
    function insert($data)
    {
        $this->db->insert('sample_data', $data);
    }
}
