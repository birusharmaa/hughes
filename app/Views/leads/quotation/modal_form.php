<?php echo form_open(get_uri("quotation/save"), array("id" => "quotation-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid">
        <?php echo view("leads/quotation/quotation_form_fields"); ?>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span>
        <?php echo app_lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span>
        <?php echo app_lang('save'); ?></button>
</div>
<?php echo form_close(); ?>


<script type="text/javascript">
    $(document).ready(function() {
        $("#quotation-form").appForm({
            onSuccess: function(result) {
                if (result.data) {
                    appAlert.success(result.message, {
                        duration: 10000
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $("#quotation-table").appTable({
                        newData: result.data,
                        dataId: result.id
                    });
                }
            }
        });
    });
</script>
    