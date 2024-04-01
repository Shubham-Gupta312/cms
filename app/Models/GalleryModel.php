<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getStatus($id)
    {
        $query = $this->table('gallery');
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

    public function updateGallery($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteImageGallery($id)
    {
        return $this->where('id', $id)->delete();
    }
}