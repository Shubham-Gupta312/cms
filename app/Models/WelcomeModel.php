<?php

namespace App\Models;

use CodeIgniter\Model;

class WelcomeModel extends Model
{
    protected $table      = 'welcome_message';
    protected $primaryKey = 'id';
    protected $protectFields = [];
}