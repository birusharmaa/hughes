<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="assessment_date">
                        <?php echo app_lang('date')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "assessment_date",
                        "name" => "assessment_date",
                        "value" => $assesData->date,
                        "class" => "form-control",
                        "placeholder" => app_lang('date'),
                        "autofocus" => true,
                        "autocomplete" => 'off',
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="session_id" value="<?php echo $login_user->id; ?>">
    <input type="hidden" name="client_id" value="<?php echo $model_info->id; ?>">
    <input type="hidden" name="assesment_id" value="<?php echo $assesData->id; ?>">
    <input type="hidden" name="assOldFile" value="<?php echo $assesData->file; ?>">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="tp_name">
                        <?php echo app_lang('tp_name')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    $user_det = array();
                    foreach ($owners_dropdown as $owners_dropdown_data) {
                        $user_det[$owners_dropdown_data['id']] = $owners_dropdown_data['text'];
                    }
                    echo form_dropdown("tp_name", $user_det, array($login_user->id), "class='form-control' name='tp_name' required");
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="ccp_name">
                        <?php echo app_lang('ccp_name')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "ccp_name",
                        "name" => "ccp_name",
                        "onkeydown" =>"return /[a-z ]/i.test(event.key)",
                        "value" => $model_info->name_of_contact_person,
                        "class" => "form-control",
                        "placeholder" => app_lang('ccp_name')
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
                    <label for="phone">
                        <?php echo app_lang('phone')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "phone",
                        "name" => "phone",
                        "value" => $assesData->phone,
                        "class" => "form-control",
                        "placeholder" => app_lang('phone'),
                        "autofocus" => true,
                        "onkeypress" =>"return isNumberKey(event)",
                        "maxlength"=>"10",
                        "autocomplete" => 'off',
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
                    <label for="area_assessment">
                        <?php echo app_lang('area_assessment')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "area_assessment",
                        "name" => "area_assessment",
                        "value" => $assesData->area,
                        "class" => "form-control",
                        "placeholder" => app_lang('area_assessment'),
                        "autofocus" => true,
                        "autocomplete" => 'off',
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
                    <label for="total_quantity">
                        <?php echo app_lang('total_quantity')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "total_quantity",
                        "name" => "total_quantity",
                        "value" => $assesData->quantity,
                        "class" => "form-control",
                        "placeholder" => app_lang('total_quantity'),
                        "autofocus" => true,
                        "autocomplete" => 'off',
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
                    <label for="details_measur">
                        <?php echo app_lang('details_measur')  . "<span style='color:red!important;'>*</span>";  ?>
                    </label>
                    <?php
                    echo form_textarea(array(
                        "id" => "details_measur",
                        "name" => "details_measur",
                        "value" => $assesData->details,
                        "class" => "form-control",
                        "placeholder" => app_lang('details_measur'),
                        "autofocus" => true,
                        "autocomplete" => 'off',
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
                    <label for="remark">
                        <?php echo app_lang('remark'); ?>
                    </label>
                    <?php
                    echo form_textarea(array(
                        "id" => "remark",
                        "name" => "remark",
                        "value" => $assesData->remark,
                        "class" => "form-control",
                        "placeholder" => app_lang('remark'),

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
                    <label for="cds_file"><?php echo app_lang('cds_file'); ?> </label>
                    <?php
                    echo form_upload(array(
                        "id" => "cds_file",
                        "name" => "cds_file",
                        "class" => "form-control",
                        "type" => "file",
                        "accept" => "application/pdf",
                        "placeholder" => app_lang('cds_file')
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php if (empty($assesData)) { ?>

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
                            $$assesData->status,
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
        setDatePicker("#assessment_date");

        // $('#tp_name').select({
        //     data: <?php // echo json_encode($owners_dropdown); 
                        ?>
        // });
        // $('#ccp_name').select2({
        //     data: <?php // echo json_encode($owners_dropdown); 
                        ?>
        // });
    });
</script>