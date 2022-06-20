<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="quotation_date">
                        <?php echo app_lang('date') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "quotation_date",
                        "name" => "quotation_date",
                        "value" => $quotData->date,
                        "class" => "form-control",
                        "placeholder" => app_lang('date'),
                        "autocomplete" => 'off',
                        "autofocus" => true,
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
    <input type="hidden" name="quat_id" value="<?php echo $quotData->id; ?>">
    <input type="hidden" name="QuotOldFile" value="<?php echo $quotData->file; ?>">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('mode') . "<span style='color:red!important;'>*</span>";  ?></label>
                    <?php
                    $lead_source = array();
                    foreach ($sources as $source) {
                        $lead_source[$source->id] = $source->title;
                    }
                    echo form_dropdown("lead_source_id", $lead_source, array($quotData->mode), "class='form-control' data-rule-required='true' data-msg-required='" . app_lang('field_required') . "'");
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
                        <?php echo app_lang('product') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    $products = [
                        'product1' => 'Product 1',
                        'product2' => 'Product 2',
                        'product3' => 'Product 3',
                    ];
                    echo form_dropdown(
                        "product",
                        $products,
                        $quotData->product,
                        "class='select form-control validate-hidden' data-rule-required='true' data-msg-required='" . app_lang('field_required') . "'"
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="quantity">
                        <?php echo app_lang('quantity') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "quantity",
                        "name" => "quantity",
                        "value" => $quotData->quantity,
                        "onkeypress" =>"return isNumberKey(event)",
                        "class" => "form-control",
                        "placeholder" => app_lang('quantity'),
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
                    <label for="rate_of_supply">
                        <?php echo app_lang('rate_of_supply') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "rate_of_supply",
                        "name" => "rate_of_supply",
                        "onkeypress" =>"return isNumberKey(event)",
                        "value" => $quotData->supply_rate,
                        "class" => "form-control",
                        "placeholder" => app_lang('rate_of_supply'),
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
                    <label for="rate_of_application">
                        <?php echo app_lang('rate_of_application') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "rate_of_application",
                        "name" => "rate_of_application",
                        "onkeypress" =>"return isNumberKey(event)",
                        "value" => $quotData->app_rate,
                        "class" => "form-control",
                        "placeholder" => app_lang('rate_of_application'),
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
                    <label for="freight">
                        <?php echo app_lang('freight') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "freight",
                        "name" => "freight",
                        "value" => $quotData->freight,
                        "onkeypress" =>"return isNumberKey(event)",
                        "class" => "form-control",
                        "placeholder" => app_lang('freight'),
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
                    <label for="other_terms">
                        <?php echo app_lang('other_terms'); ?>
                    </label>
                    <?php
                    echo form_textarea(array(
                        "id" => "other_terms",
                        "name" => "other_terms",
                        "value" => $quotData->other_terms,
                        "class" => "form-control",
                        "placeholder" => app_lang('other_terms'),
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
                    <label for="file_upload"><?php echo app_lang('file_upload'); ?> </label>
                    <?php
                    echo form_upload(array(
                        "id" => "file_upload",
                        "name" => "file_upload",
                        "class" => "form-control",
                        "type" => "file",
                        "accept" => "application/pdf",
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (empty($quotData)) { ?>

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
                            $assesData->status,
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
        setDatePicker("#quotation_date");
    });
</script>