<?php

namespace App\Models;

use CodeIgniter\Model;

class EnquiryModel extends Model
{
    protected $table      = 'enquirytable';
    protected $primaryKey = 'id';
    protected $protectFields = [];
}