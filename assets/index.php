<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CRDB BANK_PLC</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">CRDB BANK-PLC</a>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Report</h1>
                </div>
            </div>
             <?php $xml=simplexml_load_file("http://localhost/xml/audit_xml.xml");?>
            <div class="row">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Compiled report
                        </div>
                        <div class="panel-body"  id="dataTables-example" >
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="gradeU">
                                        <th>ACTION_NAME</th>
                                        <th>USERNAME</th>
                                        <th>TERMINAL</th>
                                        <th>TIMESTAMP</th>
                                        <th>SESSIONID</th>
                                        <th>REMARKS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($xml as $row) { ?>
                                    <tr class="gradeU">
                                        <td><?=$row->ACTION_NAME ?></td>
                                        <td><?=$row->USERNAME ?></td>
                                        <td ><?=$row->TERMINAL ?></td>
                                        <td ><?=$row->TIMESTAMP ?></td>
                                        <td ><?=$row->SESSIONID ?></td>
                                        <td><?=$row->REMARKS ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                                  <input type="button" id="exportpdf" value="Download PDF">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true

        });
    });

//===================================================

    //=========================================================
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

</body>

</html>
