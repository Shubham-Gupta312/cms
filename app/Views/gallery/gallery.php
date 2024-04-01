<?= $this->extend('inc/snippet.php'); ?>
<?= $this->section('content'); ?>

<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->

<div id="main-wrapper-rmvd">

    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add Gallery" id="add_Gallery"><i
                            class="fas fa-plus"></i> Add Gallery</button>
                </div>
            </div>
            <!-- Gallery Form -->
            <div class="banner-from">
                <div class="banner_container" style="display: none;">
                    <form id="addGallery">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <label for="title">Gallery Image</label><span class="text-danger">*</span>
                                <input type="file" class="form-control" id="gallery" name="gallery">
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                        <div class="error-msg">
                            <span class="error"></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Gallery Form End -->
            <!-- Edit Gallery Form -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Gallery Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editGalleryForm" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="id" id="galleryImageId" val="">
                                    <div class="col-lg-12 col-md-6">
                                        <label for="Gallery Image">Gallery Image</label><span class="text-danger">*</span>
                                        <input type="file" class="form-control" id="editgalleryimage" name="editgalleryimage">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" name="updatebtn" id="updatebtn">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Gallery Form End -->

            <div class="row mt-2">
                <table class="table table-bordered" id="GalleryTable">
                    <thead>
                        <th>S.no</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- Row -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2024 Copyright by Cauvery Resort
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>

<script>
    $(document).ready(function () {
        $('#add_Gallery').click(function (e) {
            // console.log('clicked');
            e.preventDefault();
            $('.banner_container').show();
        });

        jQuery(document).ready(function (e) {
            $('#addGallery').bootstrapValidator({
                fields: {
                    'gallery': {
                        validators: {
                            notEmpty: {
                                message: "Please Choose Image File"
                            },
                            file: {
                                extension: 'jpeg,jpg,png', // Allow JPEG, JPG, and PNG extensions
                                type: 'image/jpeg,image/png', // Specify MIME types for JPEG and PNG images
                                // maxSize: 1024 * 1024,
                                message: 'The selected file is not valid',
                                fileSize: {
                                    message: 'The file size must be less than 1MB',
                                    max: 1024 * 1024 // 1MB limit
                                }
                            },
                        }
                    },
                },
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var formData = new FormData($form[0]);
                // console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('admin/Gallery') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // console.log(response);
                        if (response.status === 'true') {
                            $('input').val('');
                            $('.banner_container').hide();
                            table.ajax.reload(null, false);
                        } else {
                            var msg = response.message;
                            $('.error').text(msg).css('color', 'red');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });
        });

        var table = $('#GalleryTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            "fnCreatedRow": function (row, data, index) {
                var pageInfo = table.page.info(); // Get page information
                var currentPage = pageInfo.page; // Current page index
                var pageLength = pageInfo.length; // Number of rows per page
                var rowNumber = index + 1 + (currentPage * pageLength); // Calculate row number
                $('td', row).eq(0).html(rowNumber); // Update index colum
            },
            ajax: {
                url: "<?= base_url('admin/fetchGallerydata') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            }
        });

        function setButtonStyles(button, newStatus) {
            if (newStatus === 0) {
                button.removeClass('btn-outline-success').addClass('btn-outline-danger').text('In-Active');
            } else if (newStatus === 1) {
                button.removeClass('btn-outline-danger').addClass('btn-outline-success').text('Active');
            }
        }
        var table = $('#GalleryTable').DataTable();
        $(document).on('click', '.statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var galleryImageId = data[0];
            // console.log(galleryImageId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/GalleryStatus') ?>",
                data: {
                    'id': galleryImageId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status === 'true') {
                        var newStatus = response.newStatus;
                        setButtonStyles(button, newStatus);
                    } else {
                        console.error('Failed to update Image status.');
                    }
                }
            });
        });

        $(document).on('click', '#editBanner', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var galleryImageId = data[0];
            // console.log(galleryImageId);
            $('#galleryImageId').val(galleryImageId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/editGallery') ?>",
                data: {
                    'id': galleryImageId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        var bannerimg = response.message.banner;
                    }
                },
            });
        });

        $(document).on('click', '#updatebtn', function (e) {
            e.preventDefault();
            // console.log('clicked');
            var $form = $('#editGalleryForm');
            var formData = new FormData($form[0]);
            // console.log(formData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/updateGallery') ?>",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // console.log(response);
                    if(response.status == 'true'){
                        $('#exampleModal').hide();
                        window.location.reload();
                    }else{
                        var msg = response.message;
                        alert(msg);
                    }
                }
            });
        });

        $(document).on('click', '#deleteBanner', function(e){
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var galleryImageId = data[0];
            // console.log(galleryImageId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteGallery') ?>",
                data: {'id': galleryImageId},
                success: function(response){
                    // console.log(response);
                    if(response.status == 'true'){
                        table.ajax.reload(null, false);
                    }
                }
            }); 
        });

    });

</script>

<?= $this->endSection() ?>