
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Invoice No.</lable>
            <input type="text" name="invoice_no" class="form-control" value="<?php if($covering_info->invoice_no){echo $covering_info->invoice_no; }else echo "";?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Invoice Date</lable>
            <input type="date" name="invoice_date" class="form-control" value="<?php if($covering_info->invoice_date){echo $covering_info->invoice_date; }else echo "";?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Invoice Amount</lable>
            <input type="text" name="invoice_amount" value="<?php if($covering_info->invoice_amount){echo $covering_info->invoice_amount; }else echo "";?>" class="form-control">           
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Delivery Note.</lable>
            <input type="text" name="delivery_note" value="<?php if($covering_info->delivery_note){echo $covering_info->delivery_note; }else echo "";?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Delivery Date.</lable>
            <input type="date" name="delivery_date" value="<?php if($covering_info->delivery_date){echo $covering_info->delivery_date; }else echo "";?>" class="form-control">
        </div>
    </div>  
  
    <div class="col-md-4">
        <div class="form-group">
            <lable>Docket No.</lable>
            <input type="text" name="docket_no" value="<?php if($covering_info->docket_no){echo $covering_info->docket_no; }else echo "";?>" class="form-control">
        </div>
    </div>   
    <div class="col-md-4">
        <div class="form-group">
            <lable>Docket Date.</lable>
            <input type="date" name="docket_date" value="<?php if($covering_info->docket_date){echo $covering_info->docket_date; }else echo "";?>" class="form-control">
        </div>
    </div>   
 
</div>

<input type="hidden" name="client_id" value="<?php echo $client_info->id; ?>">
<input type="hidden" name="order_id"  value="<?php echo $model_info->id; ?>">
<input type="hidden" name="cover_id" value="<?php if($covering_info->id) {echo $covering_info->id;}else{echo 0;}?>">
<?php $address = $client_info->address . ", " . $client_info->city . ", " . $client_info->state . ", " . $client_info->zip . ", " . $client_info->country; ?>









