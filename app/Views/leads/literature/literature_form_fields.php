<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('from'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "from",
                            "name" => "from",
                            "value" => $model_info->from,
                            "class" => "form-control",
                            "placeholder" => app_lang('from'),
                            "autofocus" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('to'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "to",
                            "name" => "to",
                            "value" => $model_info->to,
                            "class" => "form-control",
                            "placeholder" => app_lang('to'),
                            "autofocus" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="literature_date">
                        <?php echo app_lang('date'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "literature_date",
                            "name" => "literature_date",
                            "value" => $model_info->date,
                            "class" => "form-control",
                            "placeholder" => app_lang('date'),
                            "autofocus" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('mode'); ?>
                    </label>
                    <?php
                        $modes = [
                            'mail' => 'Mail',
                            'whatsapp' => 'Whatsapp',
                            'post' => 'Post',
                        ];
                        echo form_dropdown(
                            "mode",
                            $modes,
                            $model_info->mode,
                            "class='select2 validate-hidden' data-rule-required='true' data-msg-required='" . app_lang('field_required') . "'"
                        );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".select2").select2();
    setDatePicker("#literature_date");
});
</script>