<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'home_banner';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getStatus($id)
    {
        $query = $this->table('home_banner');
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

    public function updateBanner($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteBanner($id){
        return $this->where('id', $id)->delete();
    }
}