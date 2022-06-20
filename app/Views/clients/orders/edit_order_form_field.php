
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Purchase Order No</lable>
            <input type="text" name="purchase_order" class="form-control" value="<?php echo $model_info->purchase_order; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Date</lable>
            <input type="date" name="purchase_date" class="form-control" id="purchase_date" value="<?php echo $model_info->order_date; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Customer’ Name</lable>
            <input type="text" value="<?php echo $client_info->company_name; ?>" class="form-control" readonly>
            <input type="hidden" name="client_id" value="<?php echo $client_info->id; ?>">
            <input type="hidden" name="order_id"  value="<?php echo $model_info->id; ?>">
            <input type="hidden" name="orderItem_id" value="<?php echo $model_info2->id; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <lable> Address Consignee</lable>
            <input type="text" name="address_consignee" 
             class="form-control" 
             value="<?php echo $model_info->address_consignee; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable> Concern Person</lable>
            <input type="text" value="<?= $client_info->name_of_contact_person; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable> Mobile</lable>
            <input type="text" value=" <?php echo $client_info->mobile; if($client_info->phone) echo "/ ".$client_info->phone; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable> GST</lable>
            <input type="text" value="<?= $client_info->gst_number ?>" class="form-control" readonly>
        </div>
    </div>
</div>
<!-- Products -->
<div class="row">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12 form_sec_outer_task border">
                <div class="row">
                    <div class="col-md-12 bg-light p-2 mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="frm_section_n">Products</h4>
                                <button type="button" class="btn btn-primary add_new_frm_field_btn">Add More </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label>S.No.</label>
                    </div>
                    <div class="col-md-2">
                        <label>Product</label>
                    </div>
                    <div class="col-md-2">
                        <label>Qty.</label>
                    </div>
                    <div class="col-md-2">
                        <label>Rate</label>
                    </div>
                    <div class="col-md-2">
                        <label>GST</label>
                    </div>
                    <div class="col-md-2">
                        <label>Total</label>
                    </div>
                    <div class="col-md-1">
                        <label>Action</label>
                    </div>
                </div>
                <div class="col-md-12 p-0">
                    <div class="col-md-12 form_field_outer_edit p-0">
                        <?php 
                            $products = json_decode($model_info2->products);
                            $gst = json_decode($model_info2->gst);
                            $quantity = json_decode($model_info2->quantity);
                            $rate = json_decode($model_info2->rate);
                            $total = json_decode($model_info2->total);
                            $rowNum = count($products);  
                            $num=1;

                            for ($i=0;$i<$rowNum;$i++){ ?>
                            <div class="row form_field_outer_edit_row">
                                <div class="col-md-1">
                                    <label><?= $num; ?>.</label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control w_90 prodd" 
                                    name="products[]" id="edit_products_<?= $num; ?>" 
                                    value="<?= $products[$i];?>" required />
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control w_90" 
                                    name="qty[]" onkeyup="getTotalValue_edit(<?= $num; ?>)" 
                                    id="edit_qty_<?= $num; ?>" value="<?= $quantity[$i];?>"
                                    placeholder="Enter Qty." required />
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control w_90" 
                                    name="rate[]" onkeyup="getTotalValue_edit(<?= $num; ?>)" 
                                    id="edit_rate_<?= $num; ?>" value="<?= $rate[$i];?>"
                                    placeholder="Enter rate." required />
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control w_90" 
                                    name="gst[]" onkeyup="getTotalValue_edit(<?= $num; ?>)" 
                                    id="edit_gst_<?= $num; ?>" value="<?= $gst[$i];?>"
                                    placeholder="Enter gst." required />
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control w_90" 
                                    name="totalAmnt[]" readonly 
                                    onkeyup="getTotalValue_edit(<?= $num; ?>)" 
                                    value="<?= $total[$i];?>"
                                    id="edit_totalAmnt_<?= $num; ?>" placeholder="Total">
                                </div>
                                <div class="form-group col-md-1 add_del_btn_outer">
                                    <button type="button" class="btn btn-danger btn_round remove_node_btn_frm_field" <?php if($num==1)echo "disabled"; ?>>
                                        X
                                    </button>
                                </div>
                            </div>
                        <?php $num++; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <lable>Application Charges for Rs.</lable>
            <input type="text" name="application_charges" id="edit_app_charge"
             onchange="getTotalAmount_edit(this.value)" class="form-control"
              required  value="<?php echo $model_info->application_charges; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <lable>Total Amount</lable>
            <input type="text" name="total_amount" id="edit_total_amount" class="form-control" readonly value="<?php echo $model_info->total_amount; ?>">
        </div>
    </div>
</div>

<?php $address = $client_info->address . ", " . $client_info->city . ", " . $client_info->state . ", " . $client_info->zip . ", " . $client_info->country; ?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <lable>Bill will be raised in the name of.</lable>
            <input type="text" value="<?= $client_info->company_name; ?>" class="form-control" readonly>
        </div>

        <div class="form-group">
            <lable>Address</lable>
            <input type="text" value="<?= $address ?>" class="form-control" readonly>
        </div>
    </div>
</div>
<!-- Location -->
<div class="row">
    <div class="col-md-12 form_sec_outer_task border">
        <div class="row">
            <div class="col-md-12 bg-light p-2 mb-3">
                <h4 class="frm_section_n">Location where Gel Proposal to be applied</h4>

                <button type="button" class="btn btn-primary btn add_new_frm_field_btn_second"><i class="fas fa-plus add_icon"></i> Add More</button>
            </div>

            <div class="col-md-2">
                <label>Sr. No.</label>
            </div>
            <div class="col-md-4">
                <label>Affected Area</label>
            </div>
            <div class="col-md-4">
                <label> Pestgo Gel (in kgs) </label>
            </div>
            <div class="col-md-2">
                <label>Action</label>
            </div>
        </div>
        <div class="col-md-12 p-2">
            <div class="col-md-12 form_field_outer_edit_second p-0">
            <?php 
                $affected_area = json_decode($model_info2->affected_area);
                $pestgo_gel = json_decode($model_info2->pestgo_gel);               
                $rowNum = count($affected_area);  
                $num=1;

                for ($i=0;$i<$rowNum;$i++){ ?>
                <div class="row form_field_outer_edit_row_second">
                    <div class="col-md-2">
                        <label><?= $num; ?>.</label>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" 
                        name="affected_area[]" id="edit_affected_area_1" 
                        value="<?php echo $affected_area[$i]?>" required />
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" 
                        name="pestgo_gel[]" id="edit_pestgo_gel_1" 
                        value="<?php echo $pestgo_gel[$i]?>" required />
                    </div>
                    <div class="form-group col-md-2 add_del_btn_outer_second">
                        <button type="button" class=" btn btn-danger btn_round remove_node_btn_frm_field_second" <?php if($num==1)echo "disabled"; ?>>
                            Remove
                        </button>
                    </div>
                </div>

                <?php $num++; }?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="form-group">
            <lable>Freight</lable><span class="text-mute text-sm"> FREIGHT CHARGES EXTRA AT ACTUALS (1800/-)</span>
            <input type="text" name="freight" class="form-control" required value="<?php echo $model_info->freight; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <lable>Mode of Transportation</lable>
            <input type="text" name="mode_of_transportation" class="form-control" required value="<?php echo $model_info->mode_of_transportation; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Place</lable>
            <input type="text" name="place" class="form-control" required value="<?php echo $model_info->place; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Name</lable>
            <input type="text" name="name" class="form-control" required value="<?php echo $model_info->name; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Date</lable>
            <input type="date" name="date" class="form-control" required value="<?php echo $model_info->date; ?>">
        </div>
    </div>
</div>

<div class="row">
    <h4 class="text-center">MOVEMENT OF DOUCMENT ( Date & Time wise)</h4>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Receipt of Purchase order from Market</lable>
            <input type="datetime-local" name="purchase_order_receipt"
            class="form-control" id="purchase_order_receipt" 
            value="<?php echo Date('Y-m-d\TH:i',strtotime($model_info->purchase_order_receipt)) ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Billing to Accounts</lable>
            <input type="datetime-local" name="billing_to_accounts" 
            class="form-control" id="billing_to_accounts"  
            value="<?php echo Date('Y-m-d\TH:i',strtotime($model_info->billing_to_accounts)) ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Despatch</lable>
            <input type="datetime-local" name="despatch" 
            class="form-control" id="despatch" 
            value="<?php echo Date('Y-m-d\TH:i',strtotime($model_info->despatch)) ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Actual Despatch</lable>
            <input type="datetime-local" name="actual_despatch" 
            class="form-control" id="actual_despatch" 
            value="<?php echo Date('Y-m-d\TH:i',strtotime($model_info->actual_despatch)) ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Despatch of Bills</lable>
            <input type="datetime-local" name="despatch_of_bills" 
            class="form-control" id="despatch_of_bills" 
            value="<?php echo Date('Y-m-d\TH:i',strtotime($model_info->despatch_of_bills)) ?>">
        </div>
    </div>
    <!-- <input type="text" name="totalProductCount" id="totalProductCount" value="1">
    <button id="check">gdfg</button> -->
</div>

<script type="text/javascript">
    /**
     * Append New product Field
     */
    $("body").on("click", ".add_new_frm_field_btn", function() {
        var index = $(".form_field_outer_edit").find(".form_field_outer_edit_row").length + 1;
        $(".form_field_outer_edit").append(`
        <div class="row form_field_outer_edit_row">
        <div class="col-md-1"><label>${index}.</label></div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90 prodd" name="products[]"  
            id="edit_products_${index}" placeholder="Enter product name." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="qty[]" onchange= "getTotalValue_edit(${index})" id="edit_qty_${index}" placeholder="Enter Qty." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="rate[]" 
            onchange= "getTotalValue_edit(${index})" id="edit_rate_${index}" 
            placeholder="Enter rate." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="gst[]" onchange= "getTotalValue_edit(${index})" id="edit_gst_${index}" placeholder="Enter gst." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="totalAmnt[]" readonly 
            onchange="getTotalValue_edit(${index})" id="edit_totalAmnt_${index}" placeholder="Total">
        </div>        
        <div class="form-group col-md-1 add_del_btn_outer">
            <button type="button" class="btn btn-danger btn_round remove_node_btn_frm_field" disabled>X</button>
        </div>
        </div>`);
        $(".form_field_outer_edit").find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
        $(".form_field_outer_edit").find(".remove_node_btn_frm_field").first().prop("disabled", true);
        $("#totalProductCount").val(index);
    })
    /**
     * Delete Append New product Field
     */
    $("body").on("click", ".remove_node_btn_frm_field", function() {
        $(this).closest(".form_field_outer_edit_row").remove();
    });
    /**
     * Append New Location
     */
    $("body").on("click", ".add_new_frm_field_btn_second", function() {
        var index = $(".form_field_outer_edit_second").find(".form_field_outer_edit_row_second").length + 1;
        $(".form_field_outer_edit_second").append(`<div class="row form_field_outer_edit_row_second">
        <div class="col-md-2">
        <label>${index}.</label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="affected_area[]" id="edit_affected_area_${index}" placeholder="Enter Affected Area." />
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="pestgo_gel[]" id="edit_pestgo_gel_${index}" placeholder="Enter Pestgo Gel." />
        </div>
        <div type="button" class="form-group col-md-2 add_del_btn_outer_second">
            <button type="button" class=" btn btn-danger btn_round remove_node_btn_frm_field_second" disabled>Remove</button>
        </div>
        </div>`);
        $(".form_field_outer_edit_second").find(".remove_node_btn_frm_field_second:not(:first)").prop("disabled", false);
        $(".form_field_outer_edit_second").find(".remove_node_btn_frm_field_second").first().prop("disabled", true);
    });
    /**
     * Delete Append New Location
     */
    $("body").on("click", ".remove_node_btn_frm_field_second", function() {
        $(this).closest(".form_field_outer_edit_row_second").remove();
    });

    function getTotalValue_edit(ids) {
        let qty = $("#edit_qty_" + ids).val();
        let rate = $("#edit_rate_" + ids).val();
        let gst = $("#edit_gst_" + ids).val();
        let total = qty * rate;
        var percent = (gst / 100) * total;
        total = total + percent;
     

        if (qty != '' && rate != '' && gst != '') {
            var final_total = $("#edit_totalAmnt_" + ids).val(total);
            let total_value = 0;
            var prodLength = $('.prodd').length;
            for (let i = 1; i <= prodLength; i++) {
                finTot = $("#edit_totalAmnt_" + i).val();
                total_value = parseInt(finTot) + parseInt(total_value);
                $("#edit_total_amount").val(total_value);
            }
            let grand_total = parseInt($("#edit_total_amount").val())+parseInt($('#edit_app_charge').val());
            $("#edit_total_amount").val(grand_total);
        }
     
    }

    function getTotalAmount_edit(charge) {
        var total_amount = $("#edit_total_amount").val();
        total_amount = parseInt(total_amount) + parseInt(charge);
        $("#edit_total_amount").val(total_amount);
    }

</script>

