<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table = 'bank_detail';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function updateBankData($id, $data)
    {
        return $this->update($id, $data);
    }

}