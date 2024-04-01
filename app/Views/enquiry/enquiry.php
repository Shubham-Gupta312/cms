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
                    <h1>Enquiry Form Data</h1>
                </div>
            </div>

            <div class="row mt-2">
                <table class="table table-bordered" id="EnquiryTable">
                    <thead>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Room Type</th>
                        <th>Package Type</th>
                        <th>Arrival Date</th>
                        <th>Deprature Date</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Message</th>
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
    var table = $('#EnquiryTable').DataTable({
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
            url: "<?= base_url('admin/fetchEnquiryData') ?>",
            type: "GET",
            error: function (xhr, error, thrown) {
                // console.log("AJAX error:", xhr, error, thrown);
            }
        },
        drawCallback: function (settings) {
            // console.log('Table redrawn:', settings);
        }
    });
</script>


<?= $this->endSection() ?>