<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('order'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("clients/order_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_order'), array("class" => "btn btn-default", "title" => app_lang('add_order'), "data-post-client_id" => $client_id)); ?>
        </div>
    </div> 
  
    <div class="table-responsive">
        <table id="order-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () { 
        $("#order-table").appTable({
            source: '<?php echo_uri("orders/order_list_data_of_client/" . $client_id) ?>',
            order: [[0, "desc"]],
            filterDropdown: [<?php echo $custom_field_filters; ?>],
            columns: [
                {title: "<?php echo app_lang("order") ?>", "class": "w20p"},
                {title: "<?php echo app_lang("customer_name") ?>", "class": "w20p"},
                {title: "<?php echo app_lang("order_date") ?>", "iDataSort": 2, "class": "w20p"},
                {title: "<?php echo app_lang("amount") ?>", "class": "w20p"},
                {title: "<?php echo app_lang("status") ?>"}
                <?php echo $custom_field_headers; ?>,
                 {
                title: '<i data-feather="menu" class="icon-16"></i>',
                "class": "text-center option w120"
            }
            ],
            summation: [{column: 4, dataType: 'currency'}]
        });
    });

    $(document).on('click', '.orderStatusDropdown', function() {
        var value =$(this).attr('id');
        var order_id =$(this).attr('data-order-id');
        $.ajax({
            url: "<?php echo_uri("Orders/status") ?>",
            type: 'POST',
            data: {
                "statusId": value,
                "order_id": order_id
            },
            success: function(result) {
                result = JSON.parse(result);
                if (result.success) {
                    appAlert.success(result.message, {
                        duration: 10000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            }
        })
    })




</script>