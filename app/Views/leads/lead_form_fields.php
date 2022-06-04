<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="company_name">
                        <?php echo app_lang('company_name')."<span style='color:red!important;'>*</span>"; ?>
                    </label>
                    <?php
            echo form_input(array(
                "id" => "company_name",
                "name" => "company_name",
                "value" => $model_info->company_name,
                "class" => "form-control",
                "placeholder" => app_lang('company_name'),
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
                    <label for="lead_source_id"><?php echo app_lang('source')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            $lead_source = array();

            foreach ($sources as $source) {
                $lead_source[$source->id] = $source->title;
            }

            echo form_dropdown("lead_source_id", $lead_source, array($model_info->lead_source_id), "class='select2'");
            ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="nature_of_industry"><?php echo app_lang('nature_of_industry')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            $lead_source = array();

            foreach ($industry as $source) {
                $lead_source[$source->id] = $source->title;
            }

            echo form_dropdown("nature_of_industry", $lead_source, array($model_info->nature_of_industry), "class='select2'");
            ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="name_of_contact_person"><?php echo app_lang('name_of_contact_person')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_input(array(
                "id" => "name_of_contact_person",
                "name" => "name_of_contact_person", 
                "value" => $model_info->name_of_contact_person,
                "class" => "form-control",
                "placeholder" => app_lang('cpName')
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
                    <label for="designation"><?php echo app_lang('designation'); ?></label>
                    <?php
            echo form_input(array(
                "id" => "designation",
                "name" => "designation",
                "value" => $model_info->designation,
                "class" => "form-control",
                "placeholder" => app_lang('designation')
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
                    <label for="mobile"><?php echo app_lang('mobile')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_input(array(
                "id" => "mobile",
                "name" => "mobile",
                "value" => $model_info->mobile,
                "class" => "form-control",
                "placeholder" => app_lang('mobile')
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
                    <label for="phone"><?php echo app_lang('telephone'); ?>
                        <small>(optional)</small> </label>
                    <?php
            echo form_input(array(
                "id" => "phone",
                "name" => "phone",
                "value" => $model_info->phone,
                "class" => "form-control",
                "placeholder" => app_lang('telephone')
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
                    <label for="email"><?php echo app_lang('email')."<span style='color:red!important;'>*</span>"; ?> </label>
                    <?php
            echo form_input(array(
                "id" => "email",
                "name" => "email",
                "type" => "email",
                "value" => $model_info->email,
                "class" => "form-control",
                "placeholder" => app_lang('email')
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
                    <label for="website"><?php echo app_lang('website'); ?>
                        <small>(optional)</small></label>
                    <?php
            echo form_input(array(
                "id" => "website",
                "name" => "website",
                "value" => $model_info->website,
                "class" => "form-control",
                "placeholder" => app_lang('website')
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
                    <label for="agent_id"><?php echo app_lang('agent')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_input(array(
                "id" => "agent_id",
                "name" => "agent_id",
                "value" => $model_info->owner_id ? $model_info->owner_id : $login_user->id,
                "class" => "form-control",
                "placeholder" => app_lang('agent')
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
                    <label for="product"><?php echo app_lang('product')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_input(array(
                "id" => "product",
                "name" => "product",
                "value" => $model_info->product,
                "class" => "form-control",
                "placeholder" => app_lang('product')
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
                    <label for="affected_area"><?php echo app_lang('affected_area'); ?>
                        <small>(optional)</small> </label>
                    <?php
            echo form_input(array(
                "id" => "affected_area",
                "name" => "affected_area",
                "value" => $model_info->affected_area,
                "class" => "form-control",
                "placeholder" => app_lang('affected_area')
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
                "id" => "cds_upload",
                "name" => "cds_upload",
                "class" => "form-control",
                "type" => "file",
                "value" => $model_info->cds_upload,
                "accept" => "application/pdf",
                "placeholder" => app_lang('cds_file')
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
                    <label for="enquiry_date" date_section"><?php echo app_lang('enquiry_date')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_input(array(
                "id" => "enquiry_date",
                "name" => "enquiry_date",
                "value" => $model_info->enquiry_date,
                "class" => "form-control",
                "autocomplete" => "off",
                "placeholder" => app_lang('enquiry_date')
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
                    <label for="address"><?php echo app_lang('address')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_textarea(array(
                "id" => "address",
                "name" => "address",
                "value" => $model_info->address ? $model_info->address : "",
                "class" => "form-control",
                "placeholder" => app_lang('address')
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
                    <label for="state"><?php echo app_lang('state')."<span style='color:red!important;'>*</span>"; ?></label>
                    <?php
            echo form_input(array(
                "id" => "state",
                "name" => "state",
                "value" => $model_info->state ? $model_info->state : "",
                "class" => "form-control",
                "placeholder" => app_lang('state')
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
                    <label for="remarks" date_section"><?php echo app_lang('remark'); ?>
                        <small>(optional)</small> </label>
                    <?php
            echo form_textarea(array(
                "id" => "remarks",
                "name" => "remarks",
                "value" => $model_info->remarks,
                "class" => "form-control",
                "autocomplete" => "off",
                "placeholder" => app_lang('remark')
            ));
            ?>
                </div>
            </div>
        </div>
    </div>
</div>















<!-- <div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="vat_number"><?php echo app_lang('vat_number'); ?></label>
            <?php
            echo form_input(array(
                "id" => "vat_number",
                "name" => "vat_number",
                "value" => $model_info->vat_number,
                "class" => "form-control",
                "placeholder" => app_lang('vat_number')
            ));
            ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="lead_status_id"><?php echo app_lang('status'); ?></label>
            <?php
            foreach ($statuses as $status) {
                $lead_status[$status->id] = $status->title;
            }

            echo form_dropdown("lead_status_id", $lead_status, array($model_info->lead_status_id), "class='select2'");
            ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="owner_id"><?php echo app_lang('owner'); ?></label>
            <?php
            echo form_input(array(
                "id" => "owner_id",
                "name" => "owner_id",
                "value" => $model_info->owner_id ? $model_info->owner_id : $login_user->id,
                "class" => "form-control",
                "placeholder" => app_lang('owner')
            ));
            ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="city"><?php echo app_lang('city'); ?></label>
            <?php
            echo form_input(array(
                "id" => "city",
                "name" => "city",
                "value" => $model_info->city,
                "class" => "form-control",
                "placeholder" => app_lang('city')
            ));
            ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="state"><?php echo app_lang('state'); ?></label>
            <?php
            echo form_input(array(
                "id" => "state",
                "name" => "state",
                "value" => $model_info->state,
                "class" => "form-control",
                "placeholder" => app_lang('state')
            ));
            ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="zip"><?php echo app_lang('zip'); ?></label>
            <?php
            echo form_input(array(
                "id" => "zip",
                "name" => "zip",
                "value" => $model_info->zip,
                "class" => "form-control",
                "placeholder" => app_lang('zip')
            ));
            ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="country"><?php echo app_lang('country'); ?></label>
            <?php
            echo form_input(array(
                "id" => "country",
                "name" => "country",
                "value" => $model_info->country,
                "class" => "form-control",
                "placeholder" => app_lang('country')
            ));
            ?>
        </div>
    </div>
</div>
<?php if ($login_user->is_admin && get_setting("module_invoice")) { ?>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="currency"><?php echo app_lang('currency'); ?></label>
            <?php
                echo form_input(array(
                    "id" => "currency",
                    "name" => "currency",
                    "value" => $model_info->currency,
                    "class" => "form-control",
                    "placeholder" => app_lang('keep_it_blank_to_use_default') . " (" . get_setting("default_currency") . ")"
                ));
                ?>
        </div>
    </div>
</div>
<div class="form-group bg-danger">
    <div class="row">
        <div class="col-md-12">
            <label for="currency_symbol"><?php echo app_lang('currency_symbol'); ?></label>
            <?php
                echo form_input(array(
                    "id" => "currency_symbol",
                    "name" => "currency_symbol",
                    "value" => $model_info->currency_symbol,
                    "class" => "form-control",
                    "placeholder" => app_lang('keep_it_blank_to_use_default') . " (" . get_setting("currency_symbol") . ")"
                ));
                ?>
        </div>
    </div>
</div>
<?php } ?> -->

<?php 
// echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column));
?>

<script type="text/javascript">
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
    setDatePicker("#enquiry_date");
    $(".select2").select2();

    <?php if (isset($currency_dropdown)) { ?>
    if ($('#currency').length) {
        $('#currency').select2({
            data: <?php echo json_encode($currency_dropdown); ?>
        });
    }
    <?php } ?>

    $('#owner_id').select2({
        data: <?php echo json_encode($owners_dropdown); ?>
    });
    $('#agent_id').select2({
        data: <?php echo json_encode($owners_dropdown); ?>
    });

});
</script>