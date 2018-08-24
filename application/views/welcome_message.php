
<?php 
 include_once ('header.php') 
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Report</h1>
                </div>
            </div>
            <div class="row">	
                <div class="row">
			     <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Xml Data Report
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr >
                                        <th>REMARKS</th>
                                        <th>ACTION_NAME</th>
                                        <th>USERNAME</th>
                                        <th>TERMINAL</th>
                                        <th>TIMESTAMP</th>
                                        <th>SESSIONID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $row) { ?>
                                    <tr>
                                        <td><?=$row->REMARKS ?></td>
                                        <td><?=$row->ACTION_NAME ?></td>
                                        <td><?=$row->USERNAME ?></td>
                                        <td ><?=$row->TERMINAL ?></td>
                                        <td ><?=$row->TIMESTAMP ?></td>
                                        <td ><?=$row->SESSIONID ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                             <form method="" action="index.php/pdf_controller/generate_pdf_report">
                             <button class="btn btn-primary pull-right" id="submit-buttons" type="submit" ​​​​​>Create_pdf</button>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>
<?php 
 include_once ('footer.php'); 
 ?>
 <script>
 //===================================================
 $(document).ready(function() {

$("#exportpdf").click(function() {
    var pdf = new jsPDF('p', 'pt', 'ledger');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#dataTables-example')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme' : function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top : 80,
        bottom : 60,
        left : 60,
        width : 1000
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width' : margins.width, // max width of content on PDF
        'elementHandlers' : specialElementHandlers
    },

    function(dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('fileNameOfGeneretedPdf.pdf');
    }, margins);
});

});
 </script>
