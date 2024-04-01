<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_detail';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function updateContactData($id, $data)
    {
        return $this->update($id, $data);
    }

}