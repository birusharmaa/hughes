<div class="card m-4">
    <div class="table-responsive">
        <table id="report-table" class="display" cellspacing="0" width="100%">            
        </table>

        <table id="reportTable" class="display" cellspacing="0" width="100%">            
        </table>
    </div>
</div>

<script type="text/javascript">
    loadClientsTable = function (selector) {
        var showInvoiceInfo = true;
        if (!"<?php echo $show_invoice_info; ?>") {
            showInvoiceInfo = false;
        }

        var showOptions = true;
        if (!"<?php echo $can_edit_clients; ?>") {
            showOptions = false;
        }

        var quick_filters_dropdown = <?php echo view("clients/quick_filters_dropdown"); ?>;
        if (window.selectedClientQuickFilter){
            var filterIndex = quick_filters_dropdown.findIndex(x => x.id === window.selectedClientQuickFilter);
            if ([filterIndex] > - 1){
                //match found
                quick_filters_dropdown[filterIndex].isSelected = true;
            }
        }

        $(selector).appTable({
            source: '<?php echo_uri("report_leads/list_data") ?>',
            columns: [
                {title: "<?php echo 'S.No';?>"},
                {title: "<?php echo app_lang("status") ?>"},
                {title: "<?php echo 'Total Leads';?>"}
            ],
            rangeDatepicker: [{
                startDate: {
                    name: "start_date",
                    value: ""
                },
                endDate: {
                    name: "end_date",
                    value: ""
                },
                showClearButton: true
            }],
            // printColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>')
        });
    };
    
    // loadLeadTable = function (selector) {
    //     var showInvoiceInfo = true;
    //     if (!"<?php echo $show_invoice_info; ?>") {
    //         showInvoiceInfo = false;
    //     }

    //     var showOptions = true;
    //     if (!"<?php echo $can_edit_clients; ?>") {
    //         showOptions = false;
    //     }

    //     var quick_filters_dropdown = <?php echo view("clients/quick_filters_dropdown"); ?>;
    //     if (window.selectedClientQuickFilter){
    //         var filterIndex = quick_filters_dropdown.findIndex(x => x.id === window.selectedClientQuickFilter);
    //         if ([filterIndex] > - 1){
    //             //match found
    //             quick_filters_dropdown[filterIndex].isSelected = true;
    //         }
    //     }
    //     $(selector).appTable({
    //         source: '<?php echo_uri("report_leads/list_data") ?>',
    //         columns: [
    //             {title: "<?php echo 'S.No';?>"},
    //             {title: "<?php echo 'Total Leads';?>"},
    //             {title: "<?php echo app_lang("status") ?>"}
    //         ],
    //         rangeDatepicker: [{
    //             startDate: {
    //                 name: "start_date",
    //                 value: ""
    //             },
    //             endDate: {
    //                 name: "end_date",
    //                 value: ""
    //             },
    //             showClearButton: true
    //         }],
    //         xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>')
    //     });
    // }

    
    $(document).ready(function () {
        loadClientsTable("#report-table");
        //loadLeadTable("#reportTable");
        $("#reportTable_wrapper").addClass("d-none");
        $(".buttons-excel").find('span').text('').append('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download icon-16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download') ;
    });
</script>