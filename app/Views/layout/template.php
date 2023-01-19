<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Arsip NDE | <?= $title ?></title>
    <link href="<?= base_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= base_url(); ?>/css/animate.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- PLUGIN -->
    <link href="<?= base_url(); ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- CUSTOM -->
    <link href="<?= base_url(); ?>/css/custom.css" rel="stylesheet">
    <style>

    </style>
    <?= $this->renderSection('css-content') ?>

</head>

<body class="md-skin">

    <div id="wrapper">
        <?= $this->include('layout/navbar'); ?>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
                        <form role="search" class="navbar-form-custom" method="post" action="#">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?= base_url('/logout') ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight mt-3" style="padding:0px">
                <div class="row ">
                    <div class="col-lg-12">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>

            </div>
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2019
                </div>
            </div>


        </div>
    </div>

    <div style="position: absolute; top: 70px; right: 20px; width:250px">
        <div class="toast toast1 toast-bootstrap" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="fa fa-newspaper-o"> </i>
                <strong class="mr-auto m-l-sm">Berhasil</strong>

                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <div class="col-xs toast-word"></div>

            </div>
        </div>

    </div>

    <div style="position: absolute; top: 70px; right: 20px; width:250px">
        <div class="toast toast2 toast-bootstrap" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <i class="fa fa-newspaper-o"> </i>
                <strong class="mr-auto m-l-sm">Gagal</strong>

                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <div class="col-xs toast-word"></div>

            </div>
        </div>

    </div>


    <!-- Mainly scripts -->
    <script src="<?= base_url(); ?>/js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url(); ?>/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Plugin scripts -->
    <script src="<?= base_url(); ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= base_url(); ?>/js/inspinia.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/pace/pace.min.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/chosen/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/js/plugins/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?= base_url(); ?>/js/plugins/pdfjs/pdf.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/jqueryMask/jquery.mask.min.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?= base_url(); ?>/js/plugins/currency.min.js"></script>

    <script>
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#data_pick .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy-mm-dd"
            });

            $('#data_pick2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: true,
                forceParse: false,
                autoclose: true,
                startDate: new Date(),
                format: "yyyy-mm-dd"
            });

            $('#data_pick3 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: true,
                forceParse: false,
                autoclose: true,
                startDate: '+1d',
                format: "yyyy-mm-dd"
            });



        });

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    //right_side += "00";
                    right_side += "";
                }

                // Limit decimal to only 2 digits
                //right_side = right_side.substring(0, 2);
                right_side = right_side.substring(0, 0);

                // join number by .
                //input_val = "$" + left_side + "." + right_side;
                input_val = left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                //input_val = "$" + input_val;
                input_val = input_val;

                // final formatting
                if (blur === "blur") {
                    //input_val += ".00";
                    input_val += "";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        function run_validate(response) {

            var field = response.field;
            var errorRes = response.error;

            for (key in errorRes) {
                var ketError = errorRes[key];
                $('#' + key).addClass('is-invalid');
                $('#error_' + key).html(ketError);
            }
        }
    </script>


    <?= $this->renderSection('js-content') ?>


</body>

</html>