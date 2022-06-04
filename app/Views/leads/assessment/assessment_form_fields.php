<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="assessment_date">
                        <?php echo app_lang('date'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "assessment_date",
                            "name" => "assessment_date",
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
                    <label for="tp_name">
                        <?php echo app_lang('tp_name'); ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "tp_name",
                        "name" => "tp_name",
                        "value" => $model_info->owner_id ? $model_info->owner_id : $login_user->id,
                        "class" => "form-control",
                        "placeholder" => app_lang('tp_name')
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
                    <label for="ccp_name">
                        <?php echo app_lang('ccp_name'); ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "ccp_name",
                        "name" => "ccp_name",
                        "value" => $model_info->owner_id ? $model_info->owner_id : $login_user->id,
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
                        <?php echo app_lang('phone'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "phone",
                            "name" => "phone",
                            "value" => $model_info->phone,
                            "class" => "form-control",
                            "placeholder" => app_lang('phone'),
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
                        <?php echo app_lang('area_assessment'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "area_assessment",
                            "name" => "area_assessment",
                            "value" => $model_info->area_assessment,
                            "class" => "form-control",
                            "placeholder" => app_lang('area_assessment'),
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
                        <?php echo app_lang('total_quantity'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "total_quantity",
                            "name" => "total_quantity",
                            "value" => $model_info->total_quantity,
                            "class" => "form-control",
                            "placeholder" => app_lang('total_quantity'),
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
                        <?php echo app_lang('details_measur'); ?>
                    </label>
                    <?php
                        echo form_textarea(array(
                            "id" => "details_measur",
                            "name" => "details_measur",
                            "value" => $model_info->details_measur,
                            "class" => "form-control",
                            "placeholder" => app_lang('details_measur'),
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
                            "value" => $model_info->remark,
                            "class" => "form-control",
                            "placeholder" => app_lang('remark'),
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
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

</div>

<script>
$(document).ready(function() {
    $(".select2").select2();
    setDatePicker("#assessment_date");

    $('#tp_name').select2({
        data: <?php echo json_encode($owners_dropdown); ?>
    });
    $('#ccp_name').select2({
        data: <?php echo json_encode($owners_dropdown); ?>
    });
});
</script>