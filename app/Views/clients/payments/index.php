<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('payment'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("clients/paymentModel"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_payment'), array("class" => "btn btn-default", "title" => app_lang('add_payment'), "data-post-client_id" => $client_id)); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="payment-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#payment-table").appTable({
            source: '<?php echo_uri("Payment/list_data/client/" . $client_id) ?>',
            order: [
                [0, 'desc']
            ],
            columns: [{
                    title: '<?php echo app_lang("invoice_id") ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo app_lang("payment_date") ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo app_lang("payment_method") ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo app_lang("note") ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo app_lang("amount") ?>',
                    "class": "w200"
                },
                {
                    title: '<i data-feather="menu" class="icon-16"></i>',
                    "class": "text-center option w100"
                }
            ]
        });
    });

</script>