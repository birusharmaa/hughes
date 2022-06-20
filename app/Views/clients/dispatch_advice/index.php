<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('dispatch_advice'); ?></h4>
        <!-- <div class="title-button-group">
            <?php // echo modal_anchor(get_uri("clients/order_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_order'), array("class" => "btn btn-default", "title" => app_lang('add_order'), "data-post-client_id" => $client_id)); ?>
        </div> -->
    </div> 
  
    <div class="table-responsive">
        <table id="dispatch-order-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>s

<script type="text/javascript">
    $(document).ready(function () { 
        $("#dispatch-order-table").appTable({
            source: '<?php echo_uri("DispatchAdvice/dispatch_advice_list_data_of_client/" . $client_id) ?>',
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
</script>