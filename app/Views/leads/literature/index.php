<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('literature'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("leads/literature_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_literature'), array("class" => "btn btn-default", "title" => app_lang('add_literature'), "data-post-client_id" => $client_id)); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="literature-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#literature-table").appTable({
            source: '<?php echo_uri("Literature/list_data/client/" . $client_id) ?>',
            order: [
                [0, 'desc']
            ],
            columns: [{
                    title: '<?php echo "From" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Literature Date" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Literature File" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Literature Status" ?>',
                    "class": "w200"
                },
                {
                    title: '<i data-feather="menu" class="icon-16"></i>',
                    "class": "text-center option w100"
                }
            ]
        });
    });
    $(document).on('click', '.litstatus', function() {
        var dataId = $(this).attr("data-id");
        var datato = $(this).attr("data-to");
        $.ajax({
            url: "<?php echo_uri("Literature/status") ?>",
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