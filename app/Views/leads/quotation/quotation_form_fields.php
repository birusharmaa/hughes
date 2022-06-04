<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="quotation_date">
                        <?php echo app_lang('date'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "quotation_date",
                            "name" => "quotation_date",
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
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label for="from">
                        <?php echo app_lang('product'); ?>
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
                            $model_info->product,
                            "class='select2 validate-hidden' data-rule-required='true' data-msg-required='" . app_lang('field_required') . "'"
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
                        <?php echo app_lang('quantity'); ?>
                    </label>
                    <?php
                    echo form_input(array(
                        "id" => "quantity",
                        "name" => "quantity",
                        "value" => $model_info->quantity,
                        "class" => "form-control",
                        "placeholder" => app_lang('quantity')
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
                        <?php echo app_lang('rate_of_supply'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "rate_of_supply",
                            "name" => "rate_of_supply",
                            "value" => $model_info->rate_of_supply,
                            "class" => "form-control",
                            "placeholder" => app_lang('rate_of_supply'),
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
                        <?php echo app_lang('rate_of_application'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "rate_of_application",
                            "name" => "rate_of_application",
                            "value" => $model_info->rate_of_application,
                            "class" => "form-control",
                            "placeholder" => app_lang('rate_of_application'),
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
                        <?php echo app_lang('freight'); ?>
                    </label>
                    <?php
                        echo form_input(array(
                            "id" => "freight",
                            "name" => "freight",
                            "value" => $model_info->freight,
                            "class" => "form-control",
                            "placeholder" => app_lang('freight'),
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
                            "value" => $model_info->other_terms,
                            "class" => "form-control",
                            "placeholder" => app_lang('other_terms'),
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
    setDatePicker("#quotation_date");
});
</script>