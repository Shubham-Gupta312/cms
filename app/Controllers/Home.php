<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $banner = new \App\Models\BannerModel();
        $welcome = new \App\Models\WelcomeModel();
        $newsMedia = new \App\Models\NewsMediaModel();
        $testimonial = new \App\Models\TestimonialModel();
        $gallery = new \App\Models\HomeGalleryModel();

        $data['banner'] = $banner->where('status', 1)->orderBy('orderno', 'ASC')->findAll();
        $data['welcomeData'] = $welcome->findAll();
        $data['news'] = $newsMedia->where('status', 1)->findAll();
        $data['testimonial'] = $testimonial->where('status', 1)->findAll();
        $data['gallery'] = $gallery->where('status', 1)->findAll();
        return view('welcome_message', $data);

    }

    public function Frontabout()
    {
        $about = new \App\Models\AboutModel();

        $data['about'] = $about->findAll();
        return view('about', $data);
    }

    public function FronContact()
    {
        $contact = new \App\Models\ContactModel();
        $bank = new \App\Models\BankModel();

        $data['contact'] = $contact->findAll();
        $data['bank'] = $bank->findAll();
        return view('contact', $data);
    }

    public function FrontGallery()
    {
        $gallery = new \App\Models\GalleryModel();

        $data['gallery'] = $gallery->where('status', 1)->findAll();
        return view('gallery', $data);
    }

    public function enquiry()
    {
        if ($this->request->getMethod() == 'get') {
            return view('enquiry');
        } else if ($this->request->getMethod() == 'post') {
            $name = $this->request->getPost('fname');
            $rt = $this->request->getPost('roomtype');
            $pck = $this->request->getPost('package');
            $arrdt = $this->request->getPost('arrival_date');
            $depdt = $this->request->getPost('departure_date');
            $phn = $this->request->getPost('mobile');
            $email = $this->request->getPost('email');
            $msg = $this->request->getPost('comments');

            $data = [
                'name' => esc($name),
                'roomtype' => esc($rt),
                'package' => esc($pck),
                'arrivaldate' => esc($arrdt),
                'departuredate' => esc($depdt),
                'mobile' => esc($phn),
                'email' => esc($email),
                'message' => esc($msg)
            ];

            $enquiry = new \App\Models\EnquiryModel();

            $query = $enquiry->insert($data);

            if ($query) {
                $response = ['status' => 'true'];
            } else {
                $response = ['status' => 'false'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function aboutcoorg()
    {
        return view('aboutCoorg');
    }
    public function accomodation()
    {
        return view('accomodation');
    }
    public function activities()
    {
        return view('activities');
    }
    public function tarrifbooking()
    {
        return view('tarrifbooking');
    }

    public function banner()
    {
        if ($this->request->getMethod() == 'get') {
            return view('home/banner');
        } elseif ($this->request->getMethod() == 'post') {
            $orderno = $this->request->getPost('orderno');
            $image = $this->request->getFile('image');

            if ($image->isValid() && !$image->hasMoved()) {
                $newBannerName = $image->getRandomName();
                $image->move("../public/assets/uploads/banner", $newBannerName);
                $data = [
                    'orderno' => esc($orderno),
                    'banner' => $newBannerName
                ];

                $bannerModel = new \App\Models\BannerModel();
                try {
                    $query = $bannerModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'true', 'message' => 'Banner Added Successfully!'];
                    } else {
                        $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                    }
                    return $this->response->setJSON($response);
                } catch (\Exception $e) {
                    $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                    return $this->response->setStatusCode(500)->setJSON($response);
                }
            }
        }
    }

    public function fetchBanner()
    {
        try {
            $fetchBanner = new \App\Models\BannerModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];

            $fetchBanner->orderBy('id', 'DESC');


            $data['banner'] = $fetchBanner->findAll($length, $start);
            $totalRecords = $fetchBanner->countAll();
            $associativeArray = [];

            foreach ($data['banner'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['orderno'],
                    // 2 => '<img src="' . ASSET_URL . 'public/assets/uploads/banner/' . $row['banner'] . '" height="100px" width="200px">',
                    2 => '<img src="../assets/uploads/banner/' . $row['banner'] . '" height="100px" width="200px">',
                    3 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
                    4 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteBanner"><i class="fas fa-trash"></i></button>'
                );
            }


            if (empty($data['banner'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function bannerStatus()
    {
        try {
            $BannerStatus = new \App\Models\BannerModel();
            $id = $this->request->getPost('id');

            $currentStatus = $BannerStatus->getStatus(esc($id));

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updatedStatus = $BannerStatus->updateStatus($id, $newStatus);

            if ($updatedStatus) {
                $response = [
                    'status' => 'true',
                    'oldStatus' => $currentStatus,
                    'newStatus' => $newStatus
                ];
            } else {
                $response = [
                    'status' => 'false',
                    'message' => 'Failed to update product status.'
                ];
            }

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
            return $this->response->setStatusCode(500)->setJSON($response);
        }
    }

    public function editBanner()
    {
        $editBanner = new \App\Models\BannerModel();
        $id = $this->request->getPost('id');

        $bannerData = $editBanner->find($id);

        if ($bannerData) {
            $response = ['status' => 'true', 'message' => $bannerData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateBanner()
    {
        $updateBanner = new \App\Models\BannerModel();
        $id = $this->request->getPost('id');
        $orderno = $this->request->getPost('editorderno');
        $image = $this->request->getFile('editimage');

        $data = [
            'orderno' => esc($orderno)
        ];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $uploadPath = '../public/assets/uploads/banner';
            $image->move($uploadPath, $newName);

            $data['banner'] = $newName;
        } else {
            unset($data['banner']);
        }

        $response = $updateBanner->updateBanner(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Banner updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Failed to update banner']);
        }
    }

    public function deleteBanner()
    {
        $id = $this->request->getPost('id');

        $deleteModel = new \App\Models\BannerModel();

        $dltbnr = $deleteModel->deleteBanner(esc($id));

        if ($dltbnr) {
            $response = ['status' => 'true', 'message' => 'Delete Successfully!'];
        } else {
            $response = ['status' => 'false', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }

    public function wlcm_msg()
    {
        if ($this->request->getMethod() == 'get') {
            return view('home/wlcm_msg');
        } else if ($this->request->getMethod() == 'post') {
            $editorData = $this->request->getPost('editorData');

            $wlcmModel = new \App\Models\WelcomeModel();

            $existingData = $wlcmModel->first();
            if ($existingData) {
                $data = [
                    'message' => esc($editorData)
                ];
                $updated = $wlcmModel->update($existingData['id'], $data);

                if ($updated) {
                    $message = ['status' => 'true', 'message' => 'Updated successfully!'];
                } else {
                    $message = ['status' => 'false', 'message' => 'Failed to update!'];
                }
                return $this->response->setJSON($message);
            } else {
                $data = [
                    'message' => esc($editorData)
                ];
                // echo $data;
                $query = $wlcmModel->save($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'Data Saved!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            }

        }
    }

    public function checkWelcomeMessage()
    {
        $wlcmModel = new \App\Models\WelcomeModel();
        $existingData = $wlcmModel->first();

        if ($existingData) {
            $response = ['exists' => true];
        } else {
            $response = ['exists' => false];
        }

        return $this->response->setJSON($response);
    }

    public function fetchWelcomeMessage()
    {
        $wlcmModel = new \App\Models\WelcomeModel();
        $existingData = $wlcmModel->first();

        if ($existingData) {
            $response = [
                'status' => 'true',
                'editorData' => $existingData['message']
            ];
        } else {
            $response = ['status' => 'false'];
        }

        return $this->response->setJSON($response);
    }


    public function home_gallery()
    {
        if ($this->request->getMethod() == 'get') {
            return view('home/gallery');
        } else if ($this->request->getMethod() == 'post') {
            $image = $this->request->getFile('gallery');

            if ($image->isValid() && !$image->hasMoved()) {

                $newImageName = $image->getRandomName();
                $image->move("../public/assets/uploads/homegallery", $newImageName);
                $data = [
                    'gallery' => $newImageName
                ];

                $galleryModel = new \App\Models\HomeGalleryModel();
                try {
                    $query = $galleryModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'true', 'message' => 'Image Added Successfully!'];
                    } else {
                        $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                    }
                    return $this->response->setJSON($response);
                } catch (\Exception $e) {
                    $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                    return $this->response->setStatusCode(500)->setJSON($response);
                }
            }
        }
    }

    public function fetchGalleryImage()
    {
        try {
            $fetchGallery = new \App\Models\HomeGalleryModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];

            $fetchGallery->orderBy('id', 'DESC');

            $data['image'] = $fetchGallery->findAll($length, $start);
            $totalRecords = $fetchGallery->countAll();
            $associativeArray = [];

            foreach ($data['image'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => '<img src="../assets/uploads/homegallery/' . $row['gallery'] . '" height="100px" width="200px">',
                    2 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
                    // 2 => '<button class="btn btn-outline-success statusBtn">Active</button>',
                    3 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteBanner"><i class="fas fa-trash"></i></button>'
                );
            }


            if (empty($data['image'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function homeGalleryStatus()
    {
        try {
            $ImageGalleryStatus = new \App\Models\HomeGalleryModel();
            $id = $this->request->getPost('id');

            $currentStatus = $ImageGalleryStatus->getStatus(esc($id));

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updatedStatus = $ImageGalleryStatus->updateStatus($id, $newStatus);

            if ($updatedStatus) {
                $response = [
                    'status' => 'true',
                    'oldStatus' => $currentStatus,
                    'newStatus' => $newStatus
                ];
            } else {
                $response = [
                    'status' => 'false',
                    'message' => 'Failed to update product status.'
                ];
            }

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
            return $this->response->setStatusCode(500)->setJSON($response);
        }
    }

    public function editGalleryImage()
    {
        $editGalleryImage = new \App\Models\HomeGalleryModel();
        $id = $this->request->getPost('id');

        $galleryData = $editGalleryImage->find($id);

        if ($galleryData) {
            $response = ['status' => 'true', 'message' => $galleryData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateGalleryImage()
    {
        $updateGallery = new \App\Models\HomeGalleryModel();
        $id = $this->request->getPost('id');
        $image = $this->request->getFile('editgalleryimage');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $uploadPath = '../public/assets/uploads/homegallery';
            $image->move($uploadPath, $newName);

            $data['gallery'] = $newName;
        } else {
            unset($data['gallery']);
        }

        $response = $updateGallery->updateGallery(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Something went wrong!']);
        }
    }

    public function deleteImageGallery()
    {
        $id = $this->request->getPost('id');

        $deleteModel = new \App\Models\HomeGalleryModel();

        $dltimg = $deleteModel->deleteImageGallery(esc($id));

        if ($dltimg) {
            $response = ['status' => 'true', 'message' => 'Delete Successfully!'];
        } else {
            $response = ['status' => 'false', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }
    public function newsMedia()
    {
        if ($this->request->getMethod() == 'get') {
            return view('home/newsMedia');
        } else if ($this->request->getMethod() == 'post') {
            $news = $this->request->getPost('news');

            $data = [
                'news' => esc($news)
            ];

            $newsModel = new \App\Models\NewsMediaModel();
            try {
                $query = $newsModel->insert($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'News Added Successfully!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($response);
            }
        }
    }

    public function fetchNewsMedia()
    {
        try {
            $fetchNews = new \App\Models\NewsMediaModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];

            $fetchNews->orderBy('id', 'DESC');

            if (!empty($searchValue)) {
                $fetchNews->groupStart();
                $fetchNews->orLike('news', $searchValue);
                $fetchNews->groupEnd();
            }

            $data['newsMedia'] = $fetchNews->findAll($length, $start);
            $totalRecords = $fetchNews->countAll();
            $associativeArray = [];

            foreach ($data['newsMedia'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['news'],
                    2 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
                    // 2 => '<button class="btn btn-outline-success statusBtn">Active</button>',
                    3 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteBanner"><i class="fas fa-trash"></i></button>'
                );
            }


            if (empty($data['newsMedia'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function newsMediaStatus()
    {
        try {
            $newsMediaStatus = new \App\Models\NewsMediaModel();
            $id = $this->request->getPost('id');

            $currentStatus = $newsMediaStatus->getStatus(esc($id));

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updatedStatus = $newsMediaStatus->updateStatus($id, $newStatus);

            if ($updatedStatus) {
                $response = [
                    'status' => 'true',
                    'oldStatus' => $currentStatus,
                    'newStatus' => $newStatus
                ];
            } else {
                $response = [
                    'status' => 'false',
                    'message' => 'Failed to update status.'
                ];
            }

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
            return $this->response->setStatusCode(500)->setJSON($response);
        }
    }

    public function editNewsMedia()
    {
        $editNewsMedia = new \App\Models\NewsMediaModel();
        $id = $this->request->getPost('id');

        $editNewsMediaData = $editNewsMedia->find($id);

        if ($editNewsMediaData) {
            $response = ['status' => 'true', 'message' => $editNewsMediaData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateNewsMedia()
    {
        $updateNewsMedia = new \App\Models\NewsMediaModel();
        $id = $this->request->getPost('id');
        $news = $this->request->getPost('editnews');

        $data = [
            'news' => esc($news)
        ];

        $response = $updateNewsMedia->updateNewsMedia(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Something went wrong!']);
        }
    }

    public function deleteNewsMedia()
    {
        $id = $this->request->getPost('id');

        $deleteModel = new \App\Models\NewsMediaModel();

        $dltnews = $deleteModel->deleteNewsMedia(esc($id));

        if ($dltnews) {
            $response = ['status' => 'true', 'message' => 'Delete Successfully!'];
        } else {
            $response = ['status' => 'false', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }
    public function testimonial()
    {
        if ($this->request->getMethod() == 'get') {
            return view('home/testimonial');
        } elseif ($this->request->getMethod() == 'post') {
            $review = $this->request->getPost('review');
            $name = $this->request->getPost('name');

            $data = [
                'review' => esc($review),
                'name' => esc($name),
            ];

            $tesimonialModel = new \App\Models\TestimonialModel();
            try {
                $query = $tesimonialModel->insert($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'Testimonial Added Successfully!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($response);
            }
        }
    }

    public function fetchTestimonial()
    {
        try {
            $fetchTestimonial = new \App\Models\TestimonialModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];

            $fetchTestimonial->orderBy('id', 'DESC');

            if (!empty($searchValue)) {
                $fetchTestimonial->groupStart();
                $fetchTestimonial->orLike('review', $searchValue);
                $fetchTestimonial->orLike('name', $searchValue);
                $fetchTestimonial->groupEnd();
            }

            $data['testimonial'] = $fetchTestimonial->findAll($length, $start);
            $totalRecords = $fetchTestimonial->countAll();
            $associativeArray = [];

            foreach ($data['testimonial'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['review'],
                    2 => $row['name'],
                    3 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
                    // 2 => '<button class="btn btn-outline-success statusBtn">Active</button>',
                    4 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteBanner"><i class="fas fa-trash"></i></button>'
                );
            }


            if (empty($data['testimonial'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function testimonialStatus()
    {
        try {
            $newsMediaStatus = new \App\Models\TestimonialModel();
            $id = $this->request->getPost('id');

            $currentStatus = $newsMediaStatus->getStatus(esc($id));

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updatedStatus = $newsMediaStatus->updateStatus($id, $newStatus);

            if ($updatedStatus) {
                $response = [
                    'status' => 'true',
                    'oldStatus' => $currentStatus,
                    'newStatus' => $newStatus
                ];
            } else {
                $response = [
                    'status' => 'false',
                    'message' => 'Failed to update status.'
                ];
            }

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
            return $this->response->setStatusCode(500)->setJSON($response);
        }
    }

    public function editTestimonial()
    {
        $editTestimonial = new \App\Models\TestimonialModel();
        $id = $this->request->getPost('id');

        $editTestimonialData = $editTestimonial->find($id);

        if ($editTestimonialData) {
            $response = ['status' => 'true', 'message' => $editTestimonialData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateTestimonial()
    {
        $updateTestimonial = new \App\Models\TestimonialModel();
        $id = $this->request->getPost('id');
        $review = $this->request->getPost('editreview');
        $name = $this->request->getPost('editname');

        $data = [
            'review' => esc($review),
            'name' => esc($name)
        ];

        $response = $updateTestimonial->updateTestimonialData(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Something went wrong!']);
        }
    }

    public function deleteTestimonial()
    {
        $id = $this->request->getPost('id');

        $deleteModel = new \App\Models\TestimonialModel();

        $dltreview = $deleteModel->deleteTestimonialData(esc($id));

        if ($dltreview) {
            $response = ['status' => 'true', 'message' => 'Delete Successfully!'];
        } else {
            $response = ['status' => 'false', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }

    public function about()
    {
        if ($this->request->getMethod() == 'get') {
            return view('about/about');
        } elseif ($this->request->getMethod() == 'post') {
            $editorData = $this->request->getPost('editorData');

            $abtModel = new \App\Models\AboutModel();

            $existingData = $abtModel->first();
            if ($existingData) {
                $data = [
                    'about' => esc($editorData)
                ];
                $updated = $abtModel->update($existingData['id'], $data);

                if ($updated) {
                    $message = ['status' => 'true', 'message' => 'Updated successfully!'];
                } else {
                    $message = ['status' => 'false', 'message' => 'Failed to update!'];
                }
                return $this->response->setJSON($message);
            } else {
                $data = [
                    'about' => esc($editorData)
                ];
                // echo $data;
                $query = $abtModel->save($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'Data Saved!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            }
        }
    }

    public function fetchAbout()
    {
        $wlcmModel = new \App\Models\AboutModel();
        $existingData = $wlcmModel->first();

        if ($existingData) {
            $response = [
                'status' => 'true',
                'editorData' => $existingData['about']
            ];
        } else {
            $response = ['status' => 'false'];
        }

        return $this->response->setJSON($response);
    }

    public function checkAbout()
    {
        $abtModel = new \App\Models\AboutModel();
        $existingData = $abtModel->first();

        if ($existingData) {
            $response = ['exists' => true];
        } else {
            $response = ['exists' => false];
        }

        return $this->response->setJSON($response);
    }

    public function contact()
    {
        if ($this->request->getMethod() == 'get') {
            return view('contact/contact');
        } elseif ($this->request->getMethod() == 'post') {
            $add1 = $this->request->getPost('address1');
            $add2 = $this->request->getPost('address2');
            $state = $this->request->getPost('state');
            $country = $this->request->getPost('country');
            $pin = $this->request->getPost('pin');
            $phn1 = $this->request->getPost('phone1');
            $phn2 = $this->request->getPost('phone2');
            $email = $this->request->getPost('email');

            $data = [
                'address1' => esc($add1),
                'address2' => esc($add2),
                'state' => esc($state),
                'country' => esc($country),
                'pin' => esc($pin),
                'phone1' => esc($phn1),
                'phone2' => esc($phn2),
                'email' => esc($email)
            ];

            $contactModel = new \App\Models\ContactModel();
            try {
                $query = $contactModel->insert($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'Data Added Successfully!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($response);
            }

        }

    }

    public function fetchContact()
    {
        try {
            $fetchContact = new \App\Models\ContactModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];

            $fetchContact->orderBy('id', 'DESC');

            if (!empty($searchValue)) {
                $fetchContact->groupStart();
                $fetchContact->orLike('state', $searchValue);
                $fetchContact->orLike('country', $searchValue);
                $fetchContact->orLike('pin', $searchValue);
                $fetchContact->orLike('phone1', $searchValue);
                $fetchContact->orLike('phone2', $searchValue);
                $fetchContact->orLike('email', $searchValue);
                $fetchContact->groupEnd();
            }

            $data['contact'] = $fetchContact->findAll($length, $start);
            $totalRecords = $fetchContact->countAll();
            $associativeArray = [];

            foreach ($data['contact'] as $row) {
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['address1'] . ' ' . $row['address2'],
                    2 => $row['state'],
                    3 => $row['country'],
                    4 => $row['pin'],
                    5 => $row['phone1'],
                    6 => $row['phone2'],
                    7 => $row['email'],
                    8 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>'
                );
            }


            if (empty($data['contact'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function checkContact()
    {
        $cntctModel = new \App\Models\ContactModel();

        $data = $cntctModel->first();

        if ($data) {
            $response = ['status' => 'true'];
        } else {
            $response = ['status' => 'false'];
        }
        return $this->response->setJSON($response);
    }

    public function editContact()
    {
        $editContact = new \App\Models\ContactModel();
        $id = $this->request->getPost('id');

        $editContactData = $editContact->find($id);

        if ($editContactData) {
            $response = ['status' => 'true', 'message' => $editContactData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateContact()
    {
        $updateContact = new \App\Models\ContactModel();
        $id = $this->request->getPost('id');
        $add1 = $this->request->getPost('editaddress1');
        $add2 = $this->request->getPost('editaddress2');
        $state = $this->request->getPost('editstate');
        $country = $this->request->getPost('editcountry');
        $pin = $this->request->getPost('editpin');
        $phn1 = $this->request->getPost('editphone1');
        $phn2 = $this->request->getPost('editphone2');
        $email = $this->request->getPost('editemail');

        $data = [
            'address1' => esc($add1),
            'address2' => esc($add2),
            'state' => esc($state),
            'country' => esc($country),
            'pin' => esc($pin),
            'phone1' => esc($phn1),
            'phone2' => esc($phn2),
            'email' => esc($email)
        ];

        $response = $updateContact->updateContactData(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Something went wrong!']);
        }
    }

    public function bank()
    {
        if ($this->request->getMethod() == 'get') {
            return view('contact/bank');
        } elseif ($this->request->getMethod() == 'post') {
            $bank = $this->request->getPost('bank');
            $name = $this->request->getPost('name');
            $branch = $this->request->getPost('branch');
            $ac = $this->request->getPost('ac');
            $ifsc = $this->request->getPost('ifsc');
            $micr = $this->request->getPost('micr');

            $data = [
                'bank' => esc($bank),
                'name' => esc($name),
                'branch' => esc($branch),
                'ac' => esc($ac),
                'ifsc' => esc($ifsc),
                'micr' => esc($micr),
            ];

            $contactModel = new \App\Models\BankModel();
            try {
                $query = $contactModel->insert($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'Data Added Successfully!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($response);
            }
        }
    }

    public function fetchBankDetails()
    {
        try {
            $fetchBank = new \App\Models\BankModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];

            $fetchBank->orderBy('id', 'DESC');


            $data['bank'] = $fetchBank->findAll($length, $start);
            $totalRecords = $fetchBank->countAll();
            $associativeArray = [];

            foreach ($data['bank'] as $row) {
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['bank'],
                    2 => $row['branch'],
                    3 => $row['name'],
                    4 => $row['ac'],
                    5 => $row['ifsc'],
                    6 => $row['micr'],
                    7 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>'
                );
            }


            if (empty($data['bank'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function checkBank()
    {
        $bnkMdl = new \App\Models\BankModel();

        $data = $bnkMdl->first();

        if ($data) {
            $response = ['status' => 'true'];
        } else {
            $response = ['status' => 'false'];
        }
        return $this->response->setJSON($response);
    }

    public function editBank()
    {
        $editBank = new \App\Models\BankModel();
        $id = $this->request->getPost('id');

        $editBankData = $editBank->find($id);

        if ($editBankData) {
            $response = ['status' => 'true', 'message' => $editBankData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateBank()
    {
        $updateBank = new \App\Models\BankModel();
        $id = $this->request->getPost('id');
        $bnk = $this->request->getPost('editbank');
        $branch = $this->request->getPost('editbranch');
        $name = $this->request->getPost('editname');
        $ac = $this->request->getPost('editac');
        $ifsc = $this->request->getPost('editifsc');
        $micr = $this->request->getPost('editmicr');


        $data = [
            'bank' => esc($bnk),
            'branch' => esc($branch),
            'name' => esc($name),
            'ac' => esc($ac),
            'ifsc' => esc($ifsc),
            'micr' => esc($micr),
        ];

        $response = $updateBank->updateBankData(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Something went wrong!']);
        }
    }

    public function Gallery()
    {
        if ($this->request->getMethod() == 'get') {
            return view('gallery/gallery');
        } else if ($this->request->getMethod() == 'post') {
            $image = $this->request->getFile('gallery');

            if ($image->isValid() && !$image->hasMoved()) {

                $newImageName = $image->getRandomName();
                $image->move("../public/assets/uploads/Gallery", $newImageName);
                $data = [
                    'gallery' => $newImageName
                ];

                $galleryModel = new \App\Models\GalleryModel();
                try {
                    $query = $galleryModel->insert($data);

                    if ($query) {
                        $response = ['status' => 'true', 'message' => 'Image Added Successfully!'];
                    } else {
                        $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                    }
                    return $this->response->setJSON($response);
                } catch (\Exception $e) {
                    $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                    return $this->response->setStatusCode(500)->setJSON($response);
                }
            }
        }
    }

    public function fetchGallerydata()
    {
        try {
            $fetchGallery = new \App\Models\GalleryModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];

            $fetchGallery->orderBy('id', 'DESC');

            $data['image'] = $fetchGallery->findAll($length, $start);
            $totalRecords = $fetchGallery->countAll();
            $associativeArray = [];

            foreach ($data['image'] as $row) {
                $status = $row['status'];

                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger';
                    $buttonName = 'In-Active';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success';
                    $buttonName = 'Active';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => '<img src="../assets/uploads/Gallery/' . $row['gallery'] . '" height="100px" width="200px">',
                    2 => '<button class="btn ' . $buttonCSSClass . ' statusBtn">' . $buttonName . '</button>',
                    // 2 => '<button class="btn btn-outline-success statusBtn">Active</button>',
                    3 => '<button class="btn btn-outline-warning" id="editBanner" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-outline-danger" id="deleteBanner"><i class="fas fa-trash"></i></button>'
                );
            }


            if (empty($data['image'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_banner: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function GalleryStatus()
    {
        try {
            $ImageGalleryStatus = new \App\Models\GalleryModel();
            $id = $this->request->getPost('id');

            $currentStatus = $ImageGalleryStatus->getStatus(esc($id));

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updatedStatus = $ImageGalleryStatus->updateStatus($id, $newStatus);

            if ($updatedStatus) {
                $response = [
                    'status' => 'true',
                    'oldStatus' => $currentStatus,
                    'newStatus' => $newStatus
                ];
            } else {
                $response = [
                    'status' => 'false',
                    'message' => 'Failed to update product status.'
                ];
            }

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            $response = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
            return $this->response->setStatusCode(500)->setJSON($response);
        }
    }

    public function editGallery()
    {
        $editGalleryImage = new \App\Models\GalleryModel();
        $id = $this->request->getPost('id');

        $galleryData = $editGalleryImage->find($id);

        if ($galleryData) {
            $response = ['status' => 'true', 'message' => $galleryData];
        } else {
            $response = ['status' => 'false', 'message' => 'Data not Found!'];
        }
        return $this->response->setJSON($response);
    }

    public function updateGallery()
    {
        $updateGallery = new \App\Models\GalleryModel();
        $id = $this->request->getPost('id');
        $image = $this->request->getFile('editgalleryimage');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $uploadPath = '../public/assets/uploads/Gallery';
            $image->move($uploadPath, $newName);

            $data['gallery'] = $newName;
        } else {
            unset($data['gallery']);
        }

        $response = $updateGallery->updateGallery(esc($id), $data);
        if ($response) {
            return $this->response->setJSON(['status' => 'true', 'message' => 'Updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'false', 'message' => 'Something went wrong!']);
        }
    }

    public function deleteGallery()
    {
        $id = $this->request->getPost('id');

        $deleteModel = new \App\Models\GalleryModel();

        $dltimg = $deleteModel->deleteImageGallery(esc($id));

        if ($dltimg) {
            $response = ['status' => 'true', 'message' => 'Delete Successfully!'];
        } else {
            $response = ['status' => 'false', 'message' => 'Something went wrong!'];
        }
        return $this->response->setJSON($response);
    }

    public function enquirydata()
    {
        return view('enquiry/enquiry');
    }

    public function fetchEnquiryData()
    {
        try {
            $fetchEnquiry = new \App\Models\EnquiryModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];

            $fetchEnquiry->orderBy('id', 'DESC');

            if (!empty($searchValue)) {
                $fetchEnquiry->groupStart();
                $fetchEnquiry->orLike('name', $searchValue);
                $fetchEnquiry->orLike('roomtype', $searchValue);
                $fetchEnquiry->orLike('package', $searchValue);
                $fetchEnquiry->groupEnd();
            }

            $data['enquiry'] = $fetchEnquiry->findAll($length, $start);
            $totalRecords = $fetchEnquiry->countAll();
            $associativeArray = [];

            foreach ($data['enquiry'] as $row) {
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['name'],
                    2 => $row['roomtype'],
                    3 => $row['package'],
                    4 => date('d-m-Y', strtotime($row['arrivaldate'])),
                    5 => date('d-m-Y', strtotime($row['departuredate'])),
                    6 => $row['mobile'],
                    7 => $row['email'],
                    8 => $row['message']
                );
            }


            if (empty($data['enquiry'])) {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                );
            } else {
                $output = array(
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $totalRecords,
                    'data' => $associativeArray
                );
            }
            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in Enquiry Data: ' . $e->getMessage());
            // Return an error response
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

}
