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
                    <h1>Contact Details</h1>
                </div>

            </div>
            <!-- Contact Form -->
            <div class="banner-from">
                <div class="banner_container">
                    <form id="addAddress">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Address Line 1</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="address1" name="address1">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Address Line 2</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="address2" name="address2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">State</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="state" name="state">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Country</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="country" name="country">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Pin Code</label><span class="text-danger">*</span>
                                <input type="tel" class="form-control onlynumbers" maxlength="6" id="pin" name="pin">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Phone Number 1</label><span class="text-danger">*</span>
                                <input type="tel" class="form-control onlynumbers" maxlength="10" id="phone1"
                                    name="phone1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Phone Number 2</label>
                                <input type="tel" class="form-control onlynumbers" maxlength="10" id="phone2"
                                    name="phone2">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="title">Email-Id</label><span class="text-danger">*</span>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <button type="submit" id="save" name="save" class="btn btn-primary mt-2">Submit</button>
                        <div class="error-msg">
                            <span class="error"></span>
                    </form>
                </div>
            </div>
            <!-- Contact Form End -->
            <!-- Edit Contact Form -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Contact Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editContactForm">
                                <div class="row">
                                    <input type="hidden" name="id" id="contactId" val="">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Address Line 1</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editaddress1" name="editaddress1">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Address Line 2</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editaddress2" name="editaddress2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">State</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editstate" name="editstate">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Country</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editcountry" name="editcountry">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Pin Code</label><span class="text-danger">*</span>
                                        <input type="tel" class="form-control onlynumbers" maxlength="6" id="editpin"
                                            name="editpin">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Phone Number 1</label><span class="text-danger">*</span>
                                        <input type="tel" class="form-control onlynumbers" maxlength="10"
                                            id="editphone1" name="editphone1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Phone Number 2</label>
                                        <input type="tel" class="form-control onlynumbers" maxlength="10"
                                            id="editphone2" name="editphone2">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="title">Email-Id</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editemail" name="editemail">
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
                <table class="table table-bordered" id="ContactTable">
                    <thead>
                        <th>S.no</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Pin Code</th>
                        <th>Phone Number 1</th>
                        <th>Phone Number 2</th>
                        <th>Email-Id</th>
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

        $('body').on('keyup', ".onlynumbers", function (event) {
            this.value = this.value.replace(/[^[0-9.]]*/gi, '');
        });

        jQuery(document).ready(function (e) {
            $('#addAddress').bootstrapValidator({
                fields: {
                    'address1': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Address Line 1"
                            },
                        }
                    },
                    'address2': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Address Line 2"
                            },
                        }
                    },
                    'state': {
                        validators: {
                            notEmpty: {
                                message: "Please enter State"
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\s]+$/,
                                message: 'The State can only consist of alphabetical letters and spaces'
                            }
                        }
                    },
                    'country': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Country"
                            },
                            regexp: {
                                regexp: /^[a-zA-Z\s]+$/,
                                message: 'The Country can only consist of alphabetical letters, spaces'
                            },
                        }
                    },
                    'pin': {
                        validators: {
                            notEmpty: {
                                message: "Please enter PIN Code"
                            },
                        }
                    },
                    'phone1': {
                        validators: {
                            notEmpty: {
                                message: "Please enter Phone Number 1"
                            },
                        }
                    },
                    'email': {
                        validators: {
                            notEmpty: {
                                message: "Please enter email."
                            },
                            regexp: {
                                regexp: /^[_A-Za-zA-Z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[a-z0-9-]+)*(\.[A-Za-z]{2,10})$/,
                                message: 'Please enter a valid email id'
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
                    url: "<?= base_url('admin/contact') ?>",
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

        var table = $('#ContactTable').DataTable({
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
                url: "<?= base_url('admin/fetchContact') ?>",
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
            url: "<?= base_url('admin/checkContact') ?>",
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
            var contactId = data[0];
            // console.log(contactId);
            $('#contactId').val(contactId);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/editContact') ?>",
                data: {
                    'id': contactId
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        var add1 = response.message.address1;
                        var add2 = response.message.address2;
                        var state = response.message.state;
                        var country = response.message.country;
                        var pin = response.message.pin;
                        var phn1 = response.message.phone1;
                        var phn2 = response.message.phone2;
                        var email = response.message.email;
                        $('#editaddress1').val(add1);
                        $('#editaddress2').val(add2);
                        $('#editstate').val(state);
                        $('#editcountry').val(country);
                        $('#editpin').val(pin);
                        $('#editphone1').val(phn1);
                        $('#editphone2').val(phn2);
                        $('#editemail').val(email);
                    }
                },
            });
        });

        $(document).on('click', '#updatebtn', function (e) {
            e.preventDefault();
            // console.log('clicked');
            var $form = $('#editContactForm');
            var formData = $form.serialize();
            // console.log(formData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/updateContact') ?>",
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