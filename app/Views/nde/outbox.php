<?= $this->extend('layout/template'); ?>

<?= $this->section('css-content'); ?>



<?= $this->endSection(); ?>

<?= $this->section('content'); ?>


<div class="row">
    <div class="col-lg">
        <div class="ibox">
            <div class="ibox-title" style="margin-bottom:2px">
                <h5><?= $title ?></h5>
            </div>

            <div class="ibox-content">
                <!--  <div class="row">
                    <div class="col-lg-6 float-left">
                        <div class="form-group"><label class="col-form-label">Periode Minggu</label>
                            <select data-placeholder="Pilih" id="id_periode_week" name="id_periode_week" class="form-control chosen-select col-lg-5" tabindex="1">

                            </select>
                            <a class="btn btn-success btn-facebook btn-outline" id="btn_report" style="padding: 5px 10px;">
                                <i class="fa fa-file-o"> </i>&nbsp;&nbsp;Report
                            </a>
                            <a class="btn btn-success btn-facebook btn-outline" style="padding: 5px 10px;" onclick="modalSubmitDsar()">
                                <i class="fa fa-send-o"> </i>&nbsp;&nbsp;Submit DSAR
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-sm-12 b-r" id="div_table">
                        <table id="table_data" class="table table-striped table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TANGGAL SURAT</th>
                                    <th>NOMOR SURAT</th>
                                    <th>PERIHAL</th>
                                    <th>DARI</th>
                                    <th>KEPADA</th>
                                    <th>TEMBUSAN</th>
                                    <th>GROUP SURAT</th>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="modal inmodal" id="modalOpenNDE" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 80%;">
                        <div class="modal-content animated bounceInRight p-3">
                            <div class="text-center pdf-toolbar">
                                <div class="btn-group">
                                    <button id="prev" class="btn btn-white">
                                        <i class="fa fa-long-arrow-left"></i> <span class="d-none d-sm-inline">Previous</span>
                                    </button>
                                    <button id="next" class="btn btn-white">
                                        <i class="fa fa-long-arrow-right"></i> <span class="d-none d-sm-inline">Next</span>
                                    </button>
                                    <button id="zoomin" class="btn btn-white">
                                        <i class="fa fa-search-minus"></i> <span class="d-none d-sm-inline">Zoom In</span>
                                    </button>
                                    <button id="zoomout" class="btn btn-white">
                                        <i class="fa fa-search-plus"></i> <span class="d-none d-sm-inline">Zoom Out</span>
                                    </button>
                                    <button id="zoomfit" class="btn btn-white"> 100%</button>
                                    <span class="btn btn-white hidden-xs">Page: </span>

                                    <div class="input-group">
                                        <input type="text" class="form-control" id="page_num">

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-white" id="page_count">/ 22</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-center m-t-md">
                                <canvas id="the-canvas" class="pdfcanvas border-left-right border-top-bottom b-r-md"></canvas>
                            </div>




                            <div class="row pl-5">
                                <div id="divlampiran">


                                </div>

                            </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-content'); ?>

<script>
    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1.25,
        zoomRange = 0.15,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

    $(document).ready(function() {

        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-xs action';


        var table = $('#table_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php base_url() ?>/NdeController/tableOutbox",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "scrollX": true,
            "scrollY": '600px',
            "scrollCollapse": false,
            "columns": [{
                    'targets': 0,
                    "searchable": false,
                    "width": "2%"
                    //  "render": function(data) {
                    //      return '<img class="rounded-circle" src="img/profile/' + data + '" class="avatar" width="50" height="50"/>';
                    //  }

                },
                {
                    'targets': 1,
                    "width": "5%"
                },
                {
                    'targets': 2,
                    "width": "8%"
                },
                {
                    'targets': 3,
                    "searchable": false,
                    "width": "15%"
                },
                {
                    'targets': 4,
                    "searchable": false,
                    "width": "15%"
                },
                {
                    'targets': 5,
                    "width": "20%"
                },
                {
                    'targets': 6,
                    "width": "10%"
                },
                {
                    'targets': 7,
                    "searchable": false,
                    "width": "10%"
                },
                {
                    "targets": 8,
                    "width": "10%",
                    "orderable": "false",
                    "className": "text-center",
                    "data": null,
                    "width": "5%",
                    "orderable": "false",
                    "className": "text-center",
                    "defaultContent": '<button class="btn btn-white btn-bitbucket btn-xs" data-toggle="tooltip" data-placement="bottom" title="VIEW NDE" id="btn-view-nde"><i class="fa fa-folder-open-o"></i></button>&nbsp;'

                }
            ],
            "dom": '<"html5buttons"B>lTfgitp',
            "buttons": [{
                extend: 'excelHtml5',
                text: '<button class="btn btn-success btn-xs" type="button"><i class="fa fa-file-excel-o"></i></button>',
                titleAttr: 'Excel'
            }]
        });

        $('#table_data tbody').on('click', '#btn-view-nde', function() {
            var data = table.row($(this).parents('tr')).data();

            $('#modalOpenNDE').modal('show');

            $.ajax({
                url: "<?php base_url() ?>/NdeController/getNdeByID",
                type: 'get',
                data: {
                    "ref": data[8]
                },
                dataType: 'json',
                success: function(res) {

                    //render PDF
                    var url = "<?= base_url(); ?>" + res.LOKASI_SURAT;
                    PDFJS.getDocument(url).then(function(pdfDoc_) {
                        pdfDoc = pdfDoc_;
                        var documentPagesNumber = pdfDoc.numPages;
                        document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

                        $('#page_num').on('change', function() {
                            var pageNumber = Number($(this).val());

                            if (pageNumber > 0 && pageNumber <= documentPagesNumber) {
                                queueRenderPage(pageNumber, scale);
                            }

                        });
                        // Initial/first page rendering
                        renderPage(pageNum, scale);
                    });

                    //craete link lampiran

                    var lokasi_lampiran = res.LOKASI_ATTACHMENT;
                    var array_loklam = lokasi_lampiran.split(",")
                    var link = " <h3>Lampiran</h3></br>";

                    if (lokasi_lampiran != '') {

                        for (let index = 0; index < array_loklam.length; index++) {
                            let linklam = array_loklam[index];
                            let namafile = linklam.split("/");
                            link += '<a href="download/' + namafile[3] + '/' + namafile[4] + '/' + namafile[5] + '/' + namafile[6] + '">' + namafile[6] + '</a></br>';
                        }
                    } else {
                        link += 'tidak ada lampiran';
                    }

                    $('#divlampiran').html(link);

                    //alert(array_loklam[0]);

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });



        });



    });



    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num, scale) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport(scale);
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });

            page.render({
                canvasContext: ctx,
                viewport: viewPort
            }).then(() => {
                storeCanvas();
            });
        });

        // Update page counters
        document.getElementById('page_num').value = num;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num, scale);
        }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        var scale = pdfDoc.scale;
        queueRenderPage(pageNum, scale);
    }
    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        var scale = pdfDoc.scale;
        queueRenderPage(pageNum, scale);
    }
    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Zoom in page.
     */
    function onZoomIn() {
        if (scale >= pdfDoc.scale) {
            return;
        }
        scale += zoomRange;
        var num = pageNum;
        renderPage(num, scale)
    }
    document.getElementById('zoomin').addEventListener('click', onZoomIn);

    /**
     * Zoom out page.
     */
    function onZoomOut() {
        if (scale >= pdfDoc.scale) {
            return;
        }
        scale -= zoomRange;
        var num = pageNum;
        queueRenderPage(num, scale);
    }
    document.getElementById('zoomout').addEventListener('click', onZoomOut);

    /**
     * Zoom fit page.
     */
    function onZoomFit() {
        if (scale >= pdfDoc.scale) {
            return;
        }
        scale = 1;
        var num = pageNum;
        queueRenderPage(num, scale);
    }
    document.getElementById('zoomfit').addEventListener('click', onZoomFit);
</script>

<?= $this->endSection(); ?>