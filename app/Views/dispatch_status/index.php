<div class="table-responsive">
    <div class="tab-title clearfix no-border">
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("dispatch_status/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_dispatch_status'), array("class" => "btn btn-default", "title" => app_lang('add_dispatch_status'), "id" => "order-status-add-btn")); ?>
        </div>
    </div>
    <table id="dispatch-status-table" class="display no-thead b-t b-b-only no-hover" cellspacing="0" width="100%">
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#dispatch-status-table").appTable({
            source: '<?php echo_uri("dispatch_status/list_data") ?>',
            order: [
                [0, "asc"]
            ],
            hideTools: true,
            displayLength: 100,
            columns: [{
                    visible: false
                },
                {
                    title: '<?php echo app_lang("title"); ?>'
                },
                {
                    title: '<i data-feather="menu" class="icon-16"></i>',
                    "class": "text-center option w100"
                }
            ],
            onInitComplete: function() {
                //apply sortable
                $("#dispatch-status-table").find("tbody").attr("id", "custom-field-table-sortable");
                var $selector = $("#custom-field-table-sortable");

                Sortable.create($selector[0], {
                    animation: 150,
                    chosenClass: "sortable-chosen",
                    ghostClass: "sortable-ghost",
                    onUpdate: function(e) {
                        appLoader.show();
                        //prepare sort indexes 
                        var data = "";
                        $.each($selector.find(".field-row"), function(index, ele) {
                            if (data) {
                                data += ",";
                            }

                            data += $(ele).attr("data-id") + "-" + index;
                        });

                        //update sort indexes
                        $.ajax({
                            url: '<?php echo_uri("dispatch_status/update_field_sort_values") ?>',
                            type: "POST",
                            data: {
                                sort_values: data
                            },
                            success: function() {
                                appLoader.hide();
                            }
                        });
                    }
                });

            }

        });
    });
</script>