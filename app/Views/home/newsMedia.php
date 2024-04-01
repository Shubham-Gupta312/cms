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
                    <h1>New's & Media</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <button class="btn btn-outline-primary" title="Add New's & Media" id="add_newsMedia"><i
                            class="fas fa-plus"></i> Add News & Media</button>
                </div>
            </div>
            <!-- News Media Form -->
            <div class="banner-from">
                <div class="banner_container" style="display: none;">
                    <form id="addnewsMedia">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <label for="title">News & Media</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="news" name="news" placeholder="Enter Text">
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
            <!-- News Media Form End -->
            <!-- Edit News Media Form  -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit New's & Media Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editNewsForm" enctype="multipart/form-data">
                                <div class="row">
                                <input type="hidden" name="id" id="newsId" val="">
                                    <div class="col-lg-12 col-md-6">
                                        <label for="title">News & Media</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editnews" name="editnews"
                                            placeholder="Enter Text">
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
            <!-- Edit News Media Form  End -->

            <div class="row mt-2">
                <table class="table table-bordered" id="newsMediaTable">
                    <thead>
                        <th>S.no</th>
                        <th>News & Media</th>
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
        $('#add_newsMedia').click(function (e) {
            e.preventDefault();
            // console.log('clicked');
            $('.banner_container').show();
        });

        jQuery(document).ready(function (e) {
            $('#addnewsMedia').bootstrapValidator({
                fields: {
                    'news': {
                        validators: {
                            notEmpty: {
                                message: "Please enter News"
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
                    url: "<?= base_url('admin/newsMedia') ?>",
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

        var table = $('#newsMediaTable').DataTable({
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
                url: "<?= base_url('admin/fetchNewsMedia') ?>",
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
        var table = $('#newsMediaTable').DataTable();
        $(document).on('click', '.statusBtn', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var newsId = data[0];
            // console.log(newsId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/newsMediaStatus') ?>",
                data: {
                    'id': newsId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status === 'true') {
                        var newStatus = response.newStatus;
                        setButtonStyles(button, newStatus);
                    } else {
                        console.error('Failed to update status.');
                    }
                }
            });
        });

        $(document).on('click', '#editBanner', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var newsId = data[0];
            // console.log(newsId);
            $('#newsId').val(newsId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/editNewsMedia') ?>",
                data: {
                    'id': newsId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        var news = response.message.news;
                        $('#editnews').val(news);
                    }
                },
            });
        });

        $(document).on('click', '#updatebtn', function (e) {
            e.preventDefault();
            // console.log('clicked');
            var $form = $('#editNewsForm');
            var formData = $form.serialize();
            // console.log(formData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/updateNewsMedia') ?>",
                data: formData,
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
            var newsId = data[0];
            // console.log(newsId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/deleteNewsMedia') ?>",
                data: {'id': newsId},
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