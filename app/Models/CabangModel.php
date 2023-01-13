<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table      = 't_cabang';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['kd_cab', 'nama_cab', 'singkatan', 'cab_konsul'];


    public function getCabangKosul($kd_cab)
    {
        return $this->where(['kd_cab' => $kd_ca])->first();
    }
}
