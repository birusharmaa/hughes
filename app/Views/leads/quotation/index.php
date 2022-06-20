<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('quotation'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("leads/quotation_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_quotation'), array("class" => "btn btn-default", "title" => app_lang('add_quotation'), "data-post-client_id" => $client_id)); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="quotation-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#quotation-table").appTable({
            source: '<?php echo_uri("Quotation/list_data/client/" . $client_id) ?>',
            order: [
                [0, 'desc']
            ],
            columns: [{
                    title: '<?php echo "Date" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Quantity" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Supply Rate" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Application Rate" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Freight" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Status" ?>',
                    "class": "w200"
                },
                {
                    title: '<i data-feather="menu" class="icon-16"></i>',
                    "class": "text-center option w100"
                }
            ]
        });
    });
    $(document).on('click', '.status', function() {
        var dataId = $(this).attr("data-id");
        var datato = $(this).attr("data-to");
        $.ajax({
            url: "<?php echo_uri("Quotation/status") ?>",
            type: 'POST',
            data: {
                "id": dataId,
                "to": datato
            },
            success: function(result) {
                result = JSON.parse(result);
                if (result.data) {
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