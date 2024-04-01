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
                    <h1>Testimonial</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add Testimonial" id="add_testimonial"><i
                            class="fas fa-plus"></i> Add Testimonial</button>
                </div>
            </div>
            <!-- Testimonial Form -->
            <div class="banner-from">
                <div class="banner_container" style="display: none;">
                    <form id="testimonialForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="name">Reviewer Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Reviewer Name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="review">Customer Review</label><span class="text-danger">*</span>
                                <textarea name="review" id="review" cols="30"  placeholder="Enter Customer Review" ></textarea>
                                <!-- <input type="text" class="form-control" id="review" name="review"
                                    placeholder="Enter Customer Review"> -->
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                        <div class="error-msg">
                            <span class="error"></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Testimonial Form End -->
            <!-- Edit Testimonial Form   -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Testimonial Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editTestimonialForm" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="id" id="testimonialId" val="">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="name">Reviewer Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editname" name="editname"
                                            placeholder="Enter Reviewer Name">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="review">Customer Review</label><span class="text-danger">*</span>
                                        <textarea name="editreview" id="editreview" cols="15"  placeholder="Enter Customer Review" ></textarea>
                                        <!-- <input type="text" class="form-control" id="editreview" name="editreview"
                                            placeholder="Enter Customer Review"> -->
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
            <!-- Edit Testimonial Form  End -->

            <div class="row mt-2">
                <table class="table table-bordered" id="testimonialTable">
                    <thead>
                        <th>S.no</th>
                        <th>Customer Review</th>
                        <th>Reviewer Name</th>
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
        $('#add_testimonial').click(function (e) {
            // console.log('clicked');
            e.preventDefault();
            $('.banner_container').show();
        });

        jQuery(document).ready(function (e) {
            $('#testimonialForm').bootstrapValidator({
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Reviewer Name"
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9\s]+$/,
                                message: 'The name can only consist of alphabetical letters, numbers, and spaces'
                            },
                        }
                    },
                    'review': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Customer Review"
                            },
                        }
                    },
                },
            }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var formData = $form.serialize();
                // console.log(formData);
                // Use AJAX to submit form data
                $.ajax({
                    url: "<?= base_url('admin/testimonial') ?>",
                    type: 'POST',
                    data: formData,
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

        var table = $('#testimonialTable').DataTable({
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
                url: "<?= base_url('admin/fetchTestimonial') ?>",
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
        var table = $('#testimonialTable').DataTable();
        $(document).on('click', '.statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var testimonialId = data[0];
            // console.log(testimonialId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/testimonialStatus') ?>",
                data: {
                    'id': testimonialId
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
            var testimonialId = data[0];
            // console.log(testimonialId);
            $('#testimonialId').val(testimonialId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/editTestimonial') ?>",
                data: {
                    'id': testimonialId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        var review = response.message.review;
                        var name = response.message.name;
                        $('#editreview').val(review);
                        $('#editname').val(name);
                    }
                },
            });
        });

        $(document).on('click', '#updatebtn', function (e) {
            e.preventDefault();
            // console.log('clicked');
            var $form = $('#editTestimonialForm');
            var formData = $form.serialize();
            // console.log(formData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/updateTestimonial') ?>",
                data: formData,
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        $('#exampleModal').hide();
                        window.location.reload();
                    } else {
                        var msg = response.message;
                        alert(msg);
                    }
                }
            });
        });

        $(document).on('click', '#deleteBanner', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var testimonialId = data[0];
            // console.log(testimonialId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteTestimonial') ?>",
                data: { 'id': testimonialId },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        table.ajax.reload(null, false);
                    }
                }
            });
        });

    });

</script>

<?= $this->endSection() ?>