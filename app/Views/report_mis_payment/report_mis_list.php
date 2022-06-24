<div class="card m-4">
    <div class="table-responsive">
        <table id="misPaymentTable" class="display" cellspacing="0" width="100%">            
        </table>

        <table id="reportTable" class="display" cellspacing="0" width="100%">            
        </table>
    </div>
</div>

<script type="text/javascript">
    loadClientsTable = function (selector) {
        $(selector).appTable({
            source: '<?php echo_uri("report_mis_payment/list_data") ?>',
            radioButtons: [{ text: '<button type="button" id="achorTagDown" class="btn btn-default form-control" style="color:#595959" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download icon-16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download</button>'}],
            columns: [
                {title: "<?php echo app_lang("s_n") ?>"},
                {title: "<?php echo app_lang("name") ?>"},
                {title: "<?php echo app_lang("address") ?>"},
                {title: "<?php echo app_lang("name_of_contact_person") ?>"},
                {title: "<?php echo app_lang("mobile") ?>"},
            ],
            
            rangeDatepicker: [{
                startDate: {
                    name: "start_date",
                    value: "",
                    onclikFun: 'abc()'
                },
                endDate: {
                    name: "end_date",
                    value: "",
                },
                showClearButton: true
            }],
            // printColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>'),
            //xlsColumns: combineCustomFieldsColumns([0, 1, 2, 3, 4, 5, 6], '<?php echo $custom_field_headers; ?>')
        });
    };

    $(document).on('click', '#achorTagDown' ,function(){
        // alert('asdfasdf');
        var start_date = $(document).find('button[name="start_date"]').text();
        var end_date = $(document).find('button[name="end_date"]').text();
        var anchorUrl = '<?php echo_uri("report_mis_payment/downloadExcel") ?>/'+start_date + '/' +end_date;
        location.href = anchorUrl;
    })
    
    $(document).ready(function () {
        loadClientsTable("#misPaymentTable");
        $("#reportTable_wrapper").addClass("d-none");
        $(".buttons-excel").find('span').text('').append('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download icon-16"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download') ;

        // var current_url = "";
        // var hidden_value = "";
        // var anchorUrl = '<?php echo_uri("report_mis_payment/downloadExcel") ?>'+current_url+current_url;
        // $("#achorTagDown").attr('href', anchorUrl);
        // $(document).find('button[name="start_date"]').attr('onclick', 'startDateChange()');
        //$(document).find('button[name="start_date"]').attr('onclick', 'endDateChange()');
    });

    // function ClickMe(){
    //     $.ajax({
    //         'url' : '<?php echo_uri("report_mis_payment/downloadExcel") ?>',
    //         'type': 'post',
    //         success:function(res){
    //             res = JSON.parse(res);
    //             var filename = "mis_payment_report.xlsx";
    //             var element = document.createElement("a");
    //             element.setAttribute(
    //                 "href",
    //                 "data:text/plain;charset=utf-8," + encodeURIComponent(res)
    //             );
    //             element.setAttribute("download", filename);
    //             element.style.display = "none";
    //             document.body.appendChild(element);
    //             element.click();
    //             document.body.removeChild(element);
    //         },
    //         error:function(err){}
    //     })
    // }
    function startDateChange(){
        let valueOfStartDate = $(document).find('button[name="start_date"]');
        valueOfStartDate = valueOfStartDate[0].innerText;
        console.log(valueOfStartDate);
    }

    // $(document).on('change', '.input-group', function(){
    //     setTimeout(function(){
    //         let valueOfStartDate = $(document).find('button[name="start_date"]');
    //         valueOfStartDate = valueOfStartDate[0].innerText;

    //         let valueOfEndDate = $(document).find('button[name="end_date"]');
    //         valueOfEndDate = valueOfEndDate[0].innerText;
    //          console.log(valueOfStartDate);
    //          console.log(valueOfEndDate);
    //         // var anchorUrl = '<?php echo_uri("report_mis_payment/downloadExcel") ?>/'+valueOfStartDate+'/'+valueOfEndDate;
    //         // $("#achorTagDown").attr('href', anchorUrl);
    //     },200);
    // })
</script>