<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', static function ($routes) {
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::register');

    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');

    $routes->get('logout', 'AuthController::logout');

});

$routes->get('/', 'Home::index');
$routes->get('about', 'Home::Frontabout');
$routes->get('contact', 'Home::FronContact');
$routes->get('aboutcoorg', 'Home::aboutcoorg');
$routes->get('accomodation', 'Home::accomodation');
$routes->get('activities', 'Home::activities');
$routes->get('tarrifbooking', 'Home::tarrifbooking');
$routes->get('gallery', 'Home::FrontGallery');
$routes->get('enquiry', 'Home::enquiry');
$routes->post('enquiry', 'Home::enquiry');

$routes->group('admin', ['filter' => 'IsAdminFilter'], static function ($routes) {
    $routes->get('banner', 'Home::banner');
    $routes->post('banner', 'Home::banner');
    $routes->get('fetchBanner', 'Home::fetchBanner');
    $routes->post('bannerStatus', 'Home::bannerStatus');
    $routes->post('editBanner', 'Home::editBanner');
    $routes->post('updateBanner', 'Home::updateBanner');
    $routes->post('deleteBanner', 'Home::deleteBanner');

    $routes->get('welcomeMessage', 'Home::wlcm_msg');
    $routes->post('welcomeMessage', 'Home::wlcm_msg');
    $routes->post('updatewelcomeMessage', 'Home::wlcm_msg');
    $routes->post('checkWelcomeMessage', 'Home::checkWelcomeMessage');
    $routes->post('fetchWelcomeMessage', 'Home::fetchWelcomeMessage');

    $routes->get('gallery', 'Home::home_gallery');
    $routes->post('homeGallery', 'Home::home_gallery');
    $routes->get('fetchGalleryImage', 'Home::fetchGalleryImage');
    $routes->post('homeGalleryStatus', 'Home::homeGalleryStatus');
    $routes->post('editGalleryImage', 'Home::editGalleryImage');
    $routes->post('updateGalleryImage', 'Home::updateGalleryImage');
    $routes->post('deleteImageGallery', 'Home::deleteImageGallery');

    $routes->get('newsMedia', 'Home::newsMedia');
    $routes->post('newsMedia', 'Home::newsMedia');
    $routes->get('fetchNewsMedia', 'Home::fetchNewsMedia');
    $routes->post('newsMediaStatus', 'Home::newsMediaStatus');
    $routes->post('editNewsMedia', 'Home::editNewsMedia');
    $routes->post('updateNewsMedia', 'Home::updateNewsMedia');
    $routes->post('deleteNewsMedia', 'Home::deleteNewsMedia');

    $routes->get('testimonial', 'Home::testimonial');
    $routes->post('testimonial', 'Home::testimonial');
    $routes->get('fetchTestimonial', 'Home::fetchTestimonial');
    $routes->post('testimonialStatus', 'Home::testimonialStatus');
    $routes->post('editTestimonial', 'Home::editTestimonial');
    $routes->post('updateTestimonial', 'Home::updateTestimonial');
    $routes->post('deleteTestimonial', 'Home::deleteTestimonial');

    $routes->get('about', 'Home::about');
    $routes->post('about', 'Home::about');
    $routes->post('updateAbout', 'Home::about');
    $routes->post('checkAbout', 'Home::checkAbout');
    $routes->post('fetchAbout', 'Home::fetchAbout');

    $routes->get('gllery', 'Home::Gallery');
    $routes->post('Gallery', 'Home::Gallery');
    $routes->get('fetchGallerydata', 'Home::fetchGallerydata');
    $routes->post('GalleryStatus', 'Home::GalleryStatus');
    $routes->post('editGallery', 'Home::editGallery');
    $routes->post('updateGallery', 'Home::updateGallery');
    $routes->post('deleteGallery', 'Home::deleteGallery');

    $routes->get('contact', 'Home::contact');
    $routes->post('contact', 'Home::contact');
    $routes->get('fetchContact', 'Home::fetchContact');
    $routes->get('checkContact', 'Home::checkContact');
    $routes->post('editContact', 'Home::editContact');
    $routes->post('updateContact', 'Home::updateContact');

    $routes->get('bank', 'Home::bank');
    $routes->post('bank', 'Home::bank');
    $routes->get('fetchBankDetails', 'Home::fetchBankDetails');
    $routes->get('checkBank', 'Home::checkBank');
    $routes->post('editBank', 'Home::editBank');
    $routes->post('updateBank', 'Home::updateBank');

    $routes->get('enquirydata', 'Home::enquirydata');
    $routes->get('fetchEnquiryData', 'Home::fetchEnquiryData');
});

