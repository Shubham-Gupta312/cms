<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonial';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getStatus($id)
    {
        $query = $this->table('testimonial');
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

    public function updateTestimonialData($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTestimonialData($id)
    {
        return $this->where('id', $id)->delete();
    }
}