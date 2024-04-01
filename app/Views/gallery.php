<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">



    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/gallery/logo.png">

    <link rel="stylesheet" href="../assets2/css/bootstrap.css">

    <link rel="stylesheet" href="../assets2/css/owl.carousel.css">

    <link rel="stylesheet" href="../assets2/css/owl.theme.default.css">

    <link rel="stylesheet" href="../assets2/css/prettyPhoto.css">



    <title>Cauvery Resorts, Cauvery Resorts near Madikeri, Cauvery Resorts near Talacauvery, Cauvery Resorts near
        Bhagamandala, Cauvery Resorts near Coorg,
        Cottages near talacauvery, Cottages near Bhagamandala, Home Stay near talacauvery, Home Stay near Bhagamandala,
        accommodation near talacauvery,
        accommodation near Bhagamandala, Rooms near Bhagamandala, Rooms near talacauvery </title>

    <meta content="Cauvery Resorts, Cauvery Resorts near Madikeri, Cauvery Resorts near Talacauvery, Cauvery Resorts near Bhagamandala, Cauvery Resorts near Coorg, 
    Cottages near talacauvery, Cottages near Bhagamandala, Home Stay near talacauvery, Home Stay near Bhagamandala, accommodation near talacauvery, 
    accommodation near Bhagamandala, Rooms near Bhagamandala, Rooms near talacauvery" name="description">


    <meta content="Cauvery Resorts, Cauvery Resorts near Madikeri, Cauvery Resorts near Talacauvery, Cauvery Resorts near Bhagamandala, Cauvery Resorts near Coorg, 
    Cottages near talacauvery, Cottages near Bhagamandala, Home Stay near talacauvery, Home Stay near Bhagamandala, accommodation near talacauvery, 
    accommodation near Bhagamandala, Rooms near Bhagamandala, Rooms near talacauvery" name="keywords">

</head>

<body>



    <div class="topbar">

        <div class="leftbar float-left"><i class="fa fa-phone"></i>+91-944-9485133</div>

        <div class="rightbar float-right"> <i class="fa fa-envelope"></i> cauveryresorts@gmail.com</div>

    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="#"> <img src="../assets2/images/logo.png" alt="Cauvery Resorts"> </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">

                    <a class="nav-link" href="<?= base_url() ?>">Home</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('about') ?>">About us</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('aboutcoorg') ?>">About Coorg</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('accomodation') ?>">Accommodation</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('activities') ?>">Activities</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('tarrifbooking') ?>">Tariff & Booking</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('gallery') ?>">Gallery</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('enquiry') ?>">Enquiry</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?= base_url('contact') ?>">Contact Us</a>

                </li>

            </ul>



        </div>

    </nav>





    <div class="subcontainer sectioncontainer">



        <div class="headersuper lacterheader">

            Gallery

        </div>



        <div class="mastersection">

            <div class="container">


                <div class="row gallery">
                    <?php
                    if (empty($gallery)) {
                        echo "No Data Found";
                    } else {
                        foreach ($gallery as $data) {
                            echo "<div class='sectionmentortin'>
                                    <div class='galimg'>
                                        <a href='../assets/uploads/Gallery/{$data['gallery']}' rel='prettyPhoto[gallery1]'>
                                            <img class='img-fluid' src='../assets/uploads/Gallery/{$data['gallery']}' alt=''>
                                        </a>
                                    </div>
                                </div>";
                        }
                    }
                    ?>
                </div>





            </div>

        </div>

    </div>



    <footer class="footer">

        Copyright © 2019 Cauvery All Rights Reserved

    </footer>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="../assets2/js/bootstrap.js"></script>



    <script src="../assets2/js/owl.carousel.js"></script>

    <script src="../assets2/js/prettyPhoto.js"></script>

    <script src="../assets2/js/owl.single.js"></script>

</body>

</html>