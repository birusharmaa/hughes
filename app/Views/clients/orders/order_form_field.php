<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Purchase Order No</lable>
            <input type="text" name="purchase_order" class="form-control" value="<?php echo $order_info->purchase_order; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Date</lable>
            <input type="date" name="purchase_date" class="form-control" id="purchase_date" value="<?php echo $order_info->order_date; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Customer’ Name</lable>
            <input type="text" value="<?php echo $clientInfo->company_name; ?>" class="form-control" readonly>
            <input type="hidden" name="client_id" value="<?php echo $clientInfo->id; ?>">
            <input type="hidden" name="order_id"  value="<?php echo $order_info->id; ?>">
            <input type="hidden" name="orderItem_id" value="">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <lable> Address Consignee</lable>
            <input type="text" name="address_consignee" value="" class="form-control" value="<?php echo $order_info->address_consignee; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable> Concern Person</lable>
            <input type="text" value="<?= $clientInfo->name_of_contact_person; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable> Mobile</lable>
            <input type="text" value=" <?= $clientInfo->mobile . "/ " . $clientInfo->phone; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable> GST</lable>
            <input type="text" value="<?= $clientInfo->gst_number ?>" class="form-control" readonly>
        </div>
    </div>
</div>

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
                    <div class="col-md-12 form_field_outer p-0">
                        <div class="row form_field_outer_row">
                            <div class="col-md-1">
                                <label>1.</label>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control w_90 prodd" name="products[]" id="products_1" placeholder="Enter product name." required />
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control w_90" name="qty[]" onchange="getTotalValue(1)" id="qty_1" placeholder="Enter Qty." required />
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control w_90" name="rate[]" onchange="getTotalValue(1)" id="rate_1" placeholder="Enter rate." required />
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control w_90" name="gst[]" onchange="getTotalValue(1)" id="gst_1" placeholder="Enter gst." required />
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control w_90" name="totalAmnt[]" readonly onchange="getTotalValue(1)" id="totalAmnt_1" placeholder="Total">
                            </div>
                            <div class="form-group col-md-1 add_del_btn_outer">
                                <button type="button" class="btn btn-danger btn_round remove_node_btn_frm_field" disabled>
                                    X
                                </button>
                            </div>
                        </div>
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
            <input type="text" name="application_charges" onchange="getTotalAmount(this.value)" class="form-control" required  value="<?php echo $order_info->application_charges; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <lable>Total Amount</lable>
            <input type="text" name="total_amount" id="total_amount" class="form-control" readonly value="<?php echo $order_info->total_amount; ?>">
        </div>
    </div>
</div>

<?php $address = $clientInfo->address . ", " . $clientInfo->city . ", " . $clientInfo->state . ", " . $clientInfo->zip . ", " . $clientInfo->country; ?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <lable>Bill will be raised in the name of.</lable>
            <input type="text" value="<?= $clientInfo->company_name; ?>" class="form-control" readonly>
        </div>

        <div class="form-group">
            <lable>Address</lable>
            <input type="text" value="<?= $address ?>" class="form-control" readonly>
        </div>
    </div>
</div>

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
            <div class="col-md-12 form_field_outer_second p-0">
                <div class="row form_field_outer_row_second">
                    <div class="col-md-2">
                        <label>1.</label>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="affected_area[]" id="affected_area_1" placeholder="Enter Affected Area." required />
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="pestgo_gel[]" id="pestgo_gel_1" placeholder="Enter Pestgo Gel (in kgs)." required />
                    </div>
                    <div class="form-group col-md-2 add_del_btn_outer_second">
                        <button type="button" class=" btn btn-danger btn_round remove_node_btn_frm_field_second" disabled>
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="form-group">
            <lable>Freight</lable><span class="text-mute text-sm"> FREIGHT CHARGES EXTRA AT ACTUALS (1800/-)</span>
            <input type="text" name="freight" class="form-control" required value="<?php echo $order_info->freight; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <lable>Mode of Transportation</lable>
            <input type="text" name="mode_of_transportation" class="form-control" required value="<?php echo $order_info->mode_of_transportation; ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Place</lable>
            <input type="text" name="place" class="form-control" required value="<?php echo $order_info->place; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Name</lable>
            <input type="text" name="name" class="form-control" required value="<?php echo $order_info->name; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Date</lable>
            <input type="date" name="date" class="form-control" required value="<?php echo $order_info->date; ?>">
        </div>
    </div>
</div>

<div class="row">
    <h4 class="text-center">MOVEMENT OF DOUCMENT ( Date & Time wise)</h4>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Receipt of Purchase order from Market</lable>
            <input type="datetime-local" name="purchase_order_receipt" class="form-control" id="purchase_order_receipt"  value="<?php echo $order_info->purchase_order_receipt; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Billing to Accounts</lable>
            <input type="datetime-local" name="billing_to_accounts" class="form-control" id="billing_to_accounts"  value="<?php echo $order_info->billing_to_accounts; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Despatch</lable>
            <input type="datetime-local" name="despatch" class="form-control" id="despatch" value="<?php echo $order_info->despatch; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Actual Despatch</lable>
            <input type="datetime-local" name="actual_despatch" class="form-control" id="actual_despatch" value="<?php echo $order_info->actual_despatch; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Despatch of Bills</lable>
            <input type="datetime-local" name="despatch_of_bills" class="form-control" id="despatch_of_bills" value="<?php echo $order_info->despatch_of_bills; ?>">
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
        var index = $(".form_field_outer").find(".form_field_outer_row").length + 1;
        $(".form_field_outer").append(`
        <div class="row form_field_outer_row">
        <div class="col-md-1"><label>${index}.</label></div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90 prodd" name="products[]"  id="products_${index}" placeholder="Enter product name." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="qty[]" onchange= "getTotalValue(${index})" id="qty_${index}" placeholder="Enter Qty." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="rate[]" onchange= "getTotalValue(${index})" id="rate_${index}" placeholder="Enter rate." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="gst[]" onchange= "getTotalValue(${index})" id="gst_${index}" placeholder="Enter gst." required/>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control w_90" name="totalAmnt[]" readonly onchange="getTotalValue(${index})" id="totalAmnt_${index}" placeholder="Total">
        </div>        
        <div class="form-group col-md-1 add_del_btn_outer">
            <button type="button" class="btn btn-danger btn_round remove_node_btn_frm_field" disabled>X</button>
        </div>
        </div>`);
        $(".form_field_outer").find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
        $(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
        $("#totalProductCount").val(index);
    })
    /**
     * Delete Append New product Field
     */
    $("body").on("click", ".remove_node_btn_frm_field", function() {
        $(this).closest(".form_field_outer_row").remove();
    });
    /**
     * Append New Location
     */
    $("body").on("click", ".add_new_frm_field_btn_second", function() {
        var index = $(".form_field_outer_second").find(".form_field_outer_row_second").length + 1;
        $(".form_field_outer_second").append(`<div class="row form_field_outer_row_second">
        <div class="col-md-2">
        <label>${index}.</label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="affected_area[]" id="affected_area_${index}" placeholder="Enter Affected Area." />
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="pestgo_gel[]" id="pestgo_gel_${index}" placeholder="Enter Pestgo Gel." />
        </div>
        <div type="button" class="form-group col-md-2 add_del_btn_outer_second">
            <button type="button" class=" btn btn-danger btn_round remove_node_btn_frm_field_second" disabled>Remove</button>
        </div>
        </div>`);
        $(".form_field_outer_second").find(".remove_node_btn_frm_field_second:not(:first)").prop("disabled", false);
        $(".form_field_outer_second").find(".remove_node_btn_frm_field_second").first().prop("disabled", true);
    });
    /**
     * Delete Append New Location
     */
    $("body").on("click", ".remove_node_btn_frm_field_second", function() {
        $(this).closest(".form_field_outer_row_second").remove();
    });

    function getTotalValue(ids) {
        let qty = $("#qty_" + ids).val();
        let rate = $("#rate_" + ids).val();
        let gst = $("#gst_" + ids).val();
        let total = qty * rate;
        var percent = (gst / 100) * total;
        total = total + percent;
        if (qty != '' && rate != '' && gst != '') {
            var final_total = $("#totalAmnt_" + ids).val(total);

            // var ttoal = $("#totalAmnt_" + ids).val();
            let total_value = 0;
            var prodLength = $('.prodd').length;
            
            for (let i = 1; i <= prodLength; i++) {
                finTot = $("#totalAmnt_" + i).val();
                total_value = parseInt(finTot) + parseInt(total_value);
                $("#total_amount").val(total_value);
            }
        }
     
    }

    function getTotalAmount(charge) {
        let total_value = 0;
        var prodLength = $('.prodd').length;
        
        for (let i = 1; i <= prodLength; i++) {
            finTot = $("#totalAmnt_" + i).val();
            total_value = parseInt(finTot) + parseInt(total_value);
            $("#total_amount").val(total_value);
        }

        var total_amount = $("#total_amount").val();
        if(total_amount==''){
            total_amount=0;
        }
        total_amount = parseInt(total_amount) + parseInt(charge);
        $("#total_amount").val(total_amount);
    }

    // $(document).ready(function() {
    //     setDatePicker("#purchase_date");
    //     setDatePicker("#purchase_order_receipt");
    //     setDatePicker("#billing_to_accounts");
    //     setDatePicker("#despatch");
    //     setDatePicker("#actual_despatch");
    //     setDatePicker("#despatch_of_bills");
    // });
</script>

