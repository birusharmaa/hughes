<div id="page-content" class="page-wrapper clearfix">
    <div class="card clearfix">
        <div class="tab-title clearfix">
            <h4>Transporter</h4>
            <div class="title-button-group">
                <?php echo modal_anchor(get_uri("transport/transport_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> Add Transport", array("class" => "btn btn-default", "title" => "Add Transport", "data-post-client_id" => $client_id)); ?>
            </div>
        </div>
        <div class="table-responsive">
            <table id="transportation-table" class="display" cellspacing="0" width="100%">
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#transportation-table").appTable({
            source: '<?php echo_uri("Transport/list_data") ?>',
            order: [
                [0, 'desc']
            ],
            columns: [{
                    title: '<?php echo "Date" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Address" ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "GST No." ?>',
                    "class": "w200"
                },
                {
                    title: '<?php echo "Vehicle Number" ?>',
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