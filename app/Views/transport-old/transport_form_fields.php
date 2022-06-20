
<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="transId" id="transId" value="<?php echo $trans->id; ?>">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="transDate">
                        <?php echo app_lang('date') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "transDate",
                        "name" => "transDate",
                        "value" => $trans->date,
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
    <div class="col-md-6">
        <input type="hidden" name="transId" id="transId" value="<?php echo $trans->id; ?>">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="address">
                        <?php echo app_lang('address') . "<span style='color:red!important;'>*</span>";  ?></label>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "address",
                        "name" => "address",
                        "value" => $trans->address,
                        "class" => "form-control",
                        "placeholder" => app_lang('address'),
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
    <div class="col-md-6">
        <input type="hidden" name="transId" id="transId" value="<?php echo $trans->id; ?>">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="gstno">
                        Gst Number <span style='color:red!important;'>*</span>
                        
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "gstno",
                        "name" => "gstno",
                        "value" => $trans->gstno,
                        "class" => "form-control",
                        "placeholder" => "Gst Number",
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
    <div class="col-md-6">
        <input type="hidden" name="transId" id="transId" value="<?php echo $trans->id; ?>">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="vhno">
                        Vehicle Number <span style='color:red!important;'>*</span>
                        
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "vhno",
                        "name" => "vhno",
                        "value" => $trans->vhno,
                        "class" => "form-control",
                        "placeholder" => "Vehicle Number",
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





</div>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        setDatePicker("#transDate");
    });
</script>