
 <!-- jQuery -->

<script src="<?php echo base_url()."assets/"; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/metisMenu/metisMenu.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/morrisjs/morris.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>data/morris-data.js"></script>
<script src="<?php echo base_url()."assets/"; ?>dist/js/sb-admin-2.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/metisMenu/metisMenu.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>vendor/datatables-responsive/dataTables.responsive.js"></script>
<script src="<?php echo base_url()."assets/"; ?>dist/js/sb-admin-2.js"></script>
<script>
$(document).ready(function() {
	$('#dataTables-example').DataTable({
		responsive: true
	});
});

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
