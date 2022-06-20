
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="amount">
                        <?php echo app_lang('amount') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "amount",
                        "name" => "amount",
                        "value" => $paydata->amount,
                        "onkeypress" => "return isNumberKey(event)",
                        "class" => "form-control",
                        "placeholder" => app_lang('amount'),
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
                    <label for="payment_date">
                        <?php echo app_lang('payment_date') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "payment_date",
                        "name" => "payment_date",
                        "value" => $paydata->payment_date,
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
    <?php if ($paydata) { ?>
        <input type="hidden" name="client_id" value="<?php echo $paydata->clientId; ?>">
    <?php } else{ ?>
        <input type="hidden" name="client_id" value="<?php echo $model_info->id; ?>">
    <?php }  ?>

    <input type="hidden" name="id" value="<?php echo $paydata->id; ?>">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('mode') . "<span style='color:red!important;'>*</span>";  ?></label>
                    <?php
                    $payMeth = array();
                    foreach ($payment_methods as $payment_method) {
                        $payMeth[$payment_method->id] = $payment_method->title;
                    }
                    echo form_dropdown("cashPayMeth", $payMeth, array($quotData->mode), "class='form-control' data-rule-required='true' data-msg-required='" . app_lang('field_required') . "'");
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="invoice_id">
                        <?php echo app_lang('invoice_id') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "invoice_id",
                        "name" => "invoice_id",
                        "value" => $paydata->invoice_id,
                        "onkeypress" => "return isNumberKey(event)",
                        "class" => "form-control",
                        "placeholder" => app_lang('invoice_id'),
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
                    <label for="transaction_id">
                        <?php echo app_lang('transaction_id') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "transaction_id",
                        "name" => "transaction_id",
                        "value" => $paydata->transaction_id,
                        "onkeypress" => "return isNumberKey(event)",
                        "class" => "form-control",
                        "placeholder" => app_lang('transaction_id'),
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
                    <label for="note">
                        <?php echo app_lang('note'); ?>
                    </label>
                    <?php
                    echo form_textarea(array(
                        "id" => "note",
                        "name" => "note",
                        "value" => $paydata->note,
                        "class" => "form-control",
                        "placeholder" => app_lang('note'),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        setDatePicker("#payment_date");
    });
</script>