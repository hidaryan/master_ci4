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

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content border-sbottom">
                            <h4>PDF.js</h4>
                            <p>
                                PDF.js is a Portable Document Format (PDF) viewer that is built with HTML5.
                                PDF.js is community-driven and supported by Mozilla Labs. The goal is to create a general-purpose, web standards-based platform for parsing and rendering PDFs.
                                Full documentation: <a href="https://github.com/mozilla/pdf.js" target="_blank">https://github.com/mozilla/pdf.js</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
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

        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js-content'); ?>


<script id="script">
    //
    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    //

    /**
     * Asynchronously downloads PDF.
     */






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