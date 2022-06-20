<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('from') . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "from",
                        "name" => "formName",
                        "class" => "form-control",
                        "value" => $login_user->email,
                        "autofocus" => true,
                        "readonly" => true,
                        "autocomplete" => "off",
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ));
                    ?>
                </div>
                <input type="hidden" name="from" value="<?php echo $login_user->id ?>">
            </div>
        </div>
    </div>
    <?php if ($client_info) {   ?>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="from">
                            <?php echo app_lang('to')  . "<span style='color:red!important;'>*</span>";  ?>
                        </label>
                        <?php
                        echo form_input(array(
                            "id" => "toName",
                            "name" => "toName",
                            "value" =>  $client_info->email,
                            "class" => "form-control",
                            "placeholder" => app_lang('to'),
                            "autocomplete" => "off",
                            "autofocus" => true,
                            "readonly" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                        ?>
                    </div>
                    <input type="hidden" name="to" value="<?php echo $client_info->id ?>">
                    <input type="hidden" name="litId" value="<?php echo $model_info->id ?>">
                    <input type="hidden" name="litOldFile" value="<?php echo $model_info->lit_file ?>">
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="from">
                            <?php echo app_lang('to')  . "<span style='color:red!important;'>*</span>";  ?>
                        </label>
                        <?php
                        echo form_input(array(
                            "id" => "toName",
                            "name" => "toName",
                            "value" =>  $model_info->email,
                            "class" => "form-control",
                            "placeholder" => app_lang('to'),
                            "autocomplete" => "off",
                            "autofocus" => true,
                            "readonly" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                        ?>
                    </div>
                    <input type="hidden" name="to" value="<?php echo $model_info->id ?>">
                </div>
            </div>
        </div>
    <?php }  ?>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="literature_date">
                        <?php echo app_lang('date')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "literature_date",
                        "name" => "literature_date",
                        "value" => $model_info->lit_date,
                        "class" => "form-control",
                        "placeholder" => app_lang('date'),
                        "autocomplete" => "off",
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
                    <label for="source"><?php echo app_lang('source') . "<span style='color:red!important;'>*</span>";  ?></label>
                    <?php
                    $lead_source = array();
                    foreach ($sources as $source) {
                        $lead_source[$source->id] = $source->title;
                    }
                    echo form_dropdown("lead_source_id", $lead_source, array($model_info->lead_source_id), "class='form-control'");
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="add_literature_file"><?php echo app_lang('add_literature_file') . "<span style='color:red!important;'>*</span>";  ?> </label>
                    <?php
                    if ($client_info) {
                        echo form_upload(array(
                            "id" => "add_literature_file",
                            "name" => "add_literature_file",
                            "class" => "form-control",
                            "type" => "file",
                            "accept" => "application/pdf",
                            "placeholder" => app_lang('add_literature_file'),
                        ));
                    } else {
                        echo form_upload(array(
                            "id" => "add_literature_file",
                            "name" => "add_literature_file",
                            "class" => "form-control",
                            "type" => "file",
                            "accept" => "application/pdf",
                            "placeholder" => app_lang('add_literature_file'),
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (empty($client_info)) { ?>

        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="from">
                            <?php echo app_lang('status'); ?>
                        </label>
                        <?php
                        $status = [
                            '0' => 'Create',
                            '1' => 'Sent',
                        ];
                        echo form_dropdown(
                            "status",
                            $status,
                            $quotData->product,
                            "class='select form-control validate-hidden' data-rule-required='true' data-msg-required='" . app_lang('field_required') . "'"
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
</div>
<script>
    $(document).ready(function() {
        $(".select2").select2();
        setDatePicker("#literature_date");
    });
</script>