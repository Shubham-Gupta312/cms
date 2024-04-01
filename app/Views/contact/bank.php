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
                    <h1>Bank Details</h1>
                </div>
            </div>
            <!-- Bank Form -->
            <div class="banner-from">
                <div class="banner_container">
                    <form id="addBank">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Bank Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlychars" id="bank" name="bank">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Branch Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlychars" id="branch" name="branch">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Account Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlychars" id="name" name="name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Account Number</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynumbers" id="ac" name="ac">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">IFSC Code</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlyalpnm" id="ifsc" name="ifsc">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">MICR Number</label><span class="text-danger">*</span>
                                <input type="text" class="form-control onlynumbers" id="micr" name="micr">
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Bank Form End -->
            <!-- Edit Contact Form -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Bank Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editBankForm">
                                <div class="row">
                                    <input type="hidden" name="id" id="bankId" val="">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Bank Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlychars" id="editbank" name="editbank">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Branch Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlychars" id="editbranch" name="editbranch">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Account Name</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlychars" id="editname" name="editname">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Account Number</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlynumbers" id="editac" name="editac">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">IFSC Code</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlyalpnm" id="editifsc" name="editifsc">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">MICR Number</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control onlynumbers" id="editmicr" name="editmicr">
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
            <!-- Edit Contact Form End -->

            <div class="row mt-2">
                <table class="table table-bordered" id="bankTable">
                    <thead>
                        <th>S.no</th>
                        <th>Bank Name</th>
                        <th>Branch Name</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>IFSC Code</th>
                        <th>MICR Number</th>
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
        $('body').on('keyup', ".onlychars", function (event) {
            this.value = this.value.replace(/[^[A-Za-z ]]*/gi, '');
        });

        $('body').on('keyup', ".onlyalpnm", function (event) {
            this.value = this.value.replace(/[^[A-Za-z0-9]]*/gi, '');
        });

        $('body').on('keyup', ".onlynumbers", function (event) {
            this.value = this.value.replace(/[^[0-9]]*/gi, '');
        });

        jQuery(document).ready(function (e) {
            $('#addBank').bootstrapValidator({
                fields: {
                    'bank': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Bank Name"
                            },
                        }
                    },
                    'branch': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Branch Name"
                            },
                        }
                    },
                    'name': {
                        validators: {
                            notEmpty: {
                                message: "Please Account Name"
                            },
                        }
                    },
                    'ac': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Account Number"
                            },
                        }
                    },
                    'ifsc': {
                        validators: {
                            notEmpty: {
                                message: "Please enter IFSC Code"
                            },
                        }
                    },
                    'micr': {
                        validators: {
                            notEmpty: {
                                message: "Please enter MICR Number"
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
                    url: "<?= base_url('admin/bank') ?>",
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

        var table = $('#bankTable').DataTable({
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
                url: "<?= base_url('admin/fetchBankDetails') ?>",
                type: "GET",
                error: function (xhr, error, thrown) {
                    // console.log("AJAX error:", xhr, error, thrown);
                }
            },
            drawCallback: function (settings) {
                // console.log('Table redrawn:', settings);
            }
        });

        $.ajax({
            method: "GET",
            url: "<?= base_url('admin/checkBank') ?>",
            success: function (response) {
                // console.log(response);
                if (response.status == 'true') {
                    $('.banner_container').hide();
                } else {
                    $('.banner_container').show();
                }
            }
        })

        $(document).on('click', '#editBanner', function (e) {
            e.preventDefault();
            var button = $(this);
            var data = table.row(button.closest('tr')).data();
            var bankId = data[0];
            // console.log(bankId);
            $('#bankId').val(bankId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/editBank') ?>",
                data: {
                    'id': bankId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        var bnk = response.message.bank;
                        var brnch = response.message.branch;
                        var name = response.message.name;
                        var ac = response.message.ac;
                        var ifsc = response.message.ifsc;
                        var micr = response.message.micr;
                        $('#editbank').val(bnk);
                        $('#editbranch').val(brnch);
                        $('#editname').val(name);
                        $('#editac').val(ac);
                        $('#editifsc').val(ifsc);
                        $('#editmicr').val(micr);
                    }
                },
            });
        });

        $(document).on('click', '#updatebtn', function (e) {
            e.preventDefault();
            // console.log('clicked');
            var $form = $('#editBankForm');
            var formData = $form.serialize();
            // console.log(formData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/updateBank') ?>",
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


    });

</script>

<?= $this->endSection() ?>