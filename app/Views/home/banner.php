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
                    <h1>Home Banner</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add Banner" id="add_banner"><i
                            class="fas fa-plus"></i> Add Banner</button>
                </div>
            </div>
            <!-- Banner Form -->
            <div class="banner-from">
                <div class="banner_container" style="display: none;">
                    <form id="BannerForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="order no">Order No.</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynumbers" id="orderno" name="orderno"
                                    placeholder="Enter Banner Image Order Number">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="banner Image">Banner Image</label><span class="text-danger">*</span>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                        <div class="error-msg">
                            <span class="error"></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Banner Form End -->
            <!-- Edit Banner Form -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Banner Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editBannerForm" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="id" id="bannerId" val="">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="order no">Order No.</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlynumbers" id="editorderno"
                                            name="editorderno" placeholder="Enter Banner Image Order Number">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="banner Image">Banner Image</label><span class="text-danger">*</span>
                                        <input type="file" class="form-control" id="editimage" name="editimage">
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
            <!-- Edit Banner Form End -->

            <div class="row mt-2">
                <table class="table table-bordered" id="bannerTable">
                    <thead>
                        <th>S.no</th>
                        <th>Order No.</th>
                        <th>Banner Image</th>
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
        // only number allowed
        $('body').on('keyup', ".onlynumbers", function (event) {
            this.value = this.value.replace(/[^[0-9]]*/gi, '');
        });

        $('#add_banner').click(function (e) {
            // console.log('clicked');
            $('.banner_container').show();
        });
        jQuery(document).ready(function (e) {
            $('#BannerForm').bootstrapValidator({
                fields: {
                    'orderno': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Order Number"
                            },
                        }
                    },
                    'image': {
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
                    url: "<?= base_url('admin/banner') ?>",
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

        
        var table = $('#bannerTable').DataTable({
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
                url: "<?= base_url('admin/fetchBanner') ?>",
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
        var table = $('#bannerTable').DataTable();
        $(document).on('click', '.statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var bannerId = data[0];
            // console.log(bannerId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/bannerStatus') ?>",
                data: {
                    'id': bannerId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status === 'true') {
                        var newStatus = response.newStatus;
                        setButtonStyles(button, newStatus);
                    } else {
                        console.error('Failed to update product status.');
                    }
                }
            });
        });

        $(document).on('click', '#editBanner', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var bannerId = data[0];
            // console.log(bannerId);
            $('#bannerId').val(bannerId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/editBanner') ?>",
                data: {
                    'id': bannerId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        var orderno = response.message.orderno;
                        var bannerimg = response.message.banner;
                        $('#editorderno').val(orderno);
                    }
                },
            });
        });

        $(document).on('click', '#updatebtn', function (e) {
            e.preventDefault();
            // console.log('clicked');
            var $form = $('#editBannerForm');
            var formData = new FormData($form[0]);
            // console.log(formData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/updateBanner') ?>",
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
            var bannerId = data[0];
            // console.log(bannerId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteBanner') ?>",
                data: {'id': bannerId},
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