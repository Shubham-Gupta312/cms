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


  <style>
    .astronomy {
      background-color: #0c0c0c;
    }
  </style>

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





  <div class="slider">

    <div id="jssor_1"
      style="position:relative;margin:0 auto;top:0px;left:0px;width:1920px;height:800px;overflow:hidden;visibility:hidden;">



      <div data-u="slides"
        style="cursor:default;position:relative;top:0px;left:0px;width:1920px;height:800px;overflow:hidden;">

        <?php
        if (empty($banner)) {
          echo "No Data Found!";
        } else {
          foreach ($banner as $data) {
            echo '<div>';

            echo '<img data-u="image" src="../assets/uploads/banner/' . $data['banner'] . '" />';

            echo '</div>';
          }
        }
        ?>
      </div>





      <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1"
        data-scale="0.5" data-scale-bottom="0.75">

        <div data-u="prototype" class="i" style="width:16px;height:16px;">

          <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">

            <path class="b"
              d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z">
            </path>

          </svg>

        </div>

      </div>



    </div>

  </div>





  <div class="welcome">

    <div class="welcomewrapp">

  
      <?php
      if (!empty($welcomeData)) {
        // echo $welcomeData[0]['message'];
        $message = $welcomeData[0]['message'];
        echo htmlspecialchars_decode($message);
      } else {
        echo "No welcome message found.";
      }
      ?>
    </div>

  </div>





  <div class="welcome aboutcoorg sectioncoorg">

    <div class="container-fluid">

      <div class="row">

        <div class="sectionmentorche">

          <div class="aboutmid">

            <h1>About Coorg</h1>

            <p>Coorg is 1,593 square miles of undulating topography carpeted in every shade of green.

              High up in these coffee covered hills, the sacred Cauvery river is born. An ideal destination

              for honeymooners, leisure & adventure seeking patrons. A must see hill station for all.</p>

          </div>



        </div>



        <div class="sectionmentorche po">

          <img src="../assets2/images/aboutcoorg.png" alt="" class="img-fluid ">

        </div>

      </div>

    </div>



  </div>





  <div class="welcome aboutbook sectionbook">

    <div class="container">

      <h2>Reserve Your Room</h2> <a href="#" class="btn btn-success">Book your Room</a>

    </div>

  </div>





  <div class="welcome aboutnews sectionnews">

    <div class="container-fluid">

      <div class="row">

        <div class="sectionmentoratt">

          <div class="packages">

            <h3>Packages</h3>



            <div class="row">

              <div class="sectionmentorchr">

                <div class="package_box">

                  <span class="over">
                    <h2>Honeymoon Packages</h2>
                  </span>

                  <img src="../assets2/images/package1.jpg" alt="" class="img-fluid">

                </div>

              </div>

              <div class="sectionmentorchr">

                <div class="package_box">

                  <span class="over">
                    <h2>Anniversary Packages</h2>
                  </span>

                  <img src="../assets2/images/package2.jpg" alt="" class="img-fluid">

                </div>

              </div>

              <div class="sectionmentorchr">

                <div class="package_box">

                  <span class="over">
                    <h2>Birthday Packages</h2>
                  </span>

                  <img src="../assets2/images/package3.jpg" alt="" class="img-fluid">

                </div>

              </div>

            </div>



          </div>

        </div>

        <div class="sectionmentorchr">

          <div class="newsupdates">

            <h3>News & Media</h3>

            <ul>

            
              <?php
              if (empty($news)) {
                echo "No news available.";
              } else {
                foreach ($news as $row) {
                  echo "<li>" . $row['news'] . "</li>";
                }
              }
              ?>

            </ul>

          </div>

        </div>

      </div>

    </div>

  </div>


  <div class="welcome astronomy sectioncoorg">

    <div class="container-fluid">

      <div class="row">

        <div class="sectionmentorrbrh po">

          <a href="http://bas.org.in/" target="_blank"> <img src="../assets2/images/bas.jpg" alt="" class="img-fluid ">
          </a>

        </div>

      </div>

    </div>



  </div>


  <div class="gallery welcome sectiongallery">

    <div class="container-fluid">

      <h2>Gallery</h2>



      <div class="owl-carousel owl-theme" id="two">
        <?php
        if (empty($gallery)) {
          echo "No Data Found";
        } else {
          foreach ($gallery as $data) {
            echo "<div class='item'>
              <div class='galimg'><a href='../assets/uploads/homegallery/{$data['gallery']}' rel='prettyPhoto[gallery1]'><img src='../assets/uploads/homegallery/{$data['gallery']}' alt=''></a></div>
            </div>";
          }
        }
        ?>



      </div>



    </div>

  </div>



  <div class="testimonials welcome sectiontestimonials">

    <div class="container-fluid">

      <h2>Testimonials</h2>



      <div class="owl-carousel owl-theme" id="one">
        <?php
        if (empty($testimonial)) {
          echo "No Reviews Yet";
        } else {
          foreach ($testimonial as $data) {
            echo "<div class='item'>
              <div class='texttesti'>
                <p>{$data['review']}</p>
                <i>- {$data['name']},</i>
              </div>
            </div>";
          }
        }
        ?>


      </div>



    </div>





  </div>



  <footer class="footer">

    Copyright © 2019 Cauvery All Rights Reserved

  </footer>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="../assets2/js/bootstrap.js"></script>

  <script src="../assets2/js/jssor.slider.min.js" type="text/javascript"></script>
  <script type="text/javascript">

    jssor_1_slider_init = function () {



      var jssor_1_SlideshowTransitions = [

        { $Duration: 500, $Delay: 30, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2049, $Easing: $Jease$.$OutQuad },

        { $Duration: 500, $Delay: 80, $Cols: 8, $Rows: 4, $Clip: 15, $SlideOut: true, $Easing: $Jease$.$OutQuad },

        { $Duration: 1000, x: -0.2, $Delay: 40, $Cols: 12, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Assembly: 260, $Easing: { $Left: $Jease$.$InOutExpo, $Opacity: $Jease$.$InOutQuad }, $Opacity: 2, $Outside: true, $Round: { $Top: 0.5 } },

        { $Duration: 2000, y: -1, $Delay: 60, $Cols: 15, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraight, $Easing: $Jease$.$OutJump, $Round: { $Top: 1.5 } },

        { $Duration: 1200, x: 0.2, y: -0.1, $Delay: 20, $Cols: 8, $Rows: 4, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $Jease$.$InWave, $Top: $Jease$.$InWave, $Clip: $Jease$.$OutQuad }, $Round: { $Left: 1.3, $Top: 2.5 } }

      ];



      var jssor_1_options = {

        $AutoPlay: 1,

        $SlideshowOptions: {

          $Class: $JssorSlideshowRunner$,

          $Transitions: jssor_1_SlideshowTransitions,

          $TransitionsOrder: 1

        },

        $ArrowNavigatorOptions: {

          $Class: $JssorArrowNavigator$

        },

        $BulletNavigatorOptions: {

          $Class: $JssorBulletNavigator$

        }

      };



      var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);



      /*#region responsive code begin*/



      var MAX_WIDTH = 1920;



      function ScaleSlider() {

        var containerElement = jssor_1_slider.$Elmt.parentNode;

        var containerWidth = containerElement.clientWidth;



        if (containerWidth) {



          var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);



          jssor_1_slider.$ScaleWidth(expectedWidth);

        }

        else {

          window.setTimeout(ScaleSlider, 30);

        }

      }



      ScaleSlider();



      $Jssor$.$AddEvent(window, "load", ScaleSlider);

      $Jssor$.$AddEvent(window, "resize", ScaleSlider);

      $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);

      /*#endregion responsive code end*/

    };

  </script>

  <script type="text/javascript">jssor_1_slider_init();</script>

  <script src="../assets2/js/owl.carousel.js"></script>

  <script src="../assets2/js/prettyPhoto.js"></script>

  <script src="../assets2/js/owl.single.js"></script>

</body>

</html>