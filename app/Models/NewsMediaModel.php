<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsMediaModel extends Model
{
    protected $table = 'newsmedia';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getStatus($id)
    {
        $query = $this->table('newsmedia');
        $query->where('id', $id);
        $result = $query->get()->getRow();
        if ($result) {
            $status = $result->status;
            return $status;
        } else {
            return null;
        }
    }

    public function updateStatus($id, $newStatus)
    {
        return $this->set(['status' => $newStatus])->where('id', $id)->update();
    }

    public function updateNewsMedia($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteNewsMedia($id)
    {
        return $this->where('id', $id)->delete();
    }
}