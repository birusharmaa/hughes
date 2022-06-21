
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Advice No.</lable>
            <input type="text" name="advice_no" class="form-control" value="<?php if($dispatch_info->advice_no){echo $dispatch_info->advice_no; }else echo "";?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>B.A. / Staff</lable>
            <input type="text" name="staff" class="form-control" value="<?php if($dispatch_info->staff){echo $dispatch_info->staff; }else echo "";?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Vendor Code</lable>
            <input type="text" name="vendor_code" value="<?php if($dispatch_info->vendor_code){echo $dispatch_info->vendor_code; }else echo "";?>" class="form-control">           
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <lable>Destination.</lable>
            <input type="text" name="destination" value="<?php if($dispatch_info->destination){echo $dispatch_info->destination; }else echo "";?>" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <lable>Distance in Kms</lable>
            <input type="text" name="distance_in_kms" value="<?php if($dispatch_info->distance_in_kms){echo $dispatch_info->distance_in_kms; }else echo "";?>" class="form-control">
        </div>
    </div>  
    <div class="col-md-4">
        <div class="form-group">
            <lable>Road Permit</lable>
            <input type="text" name="road_permit" value="<?php if($dispatch_info->road_permit){echo $dispatch_info->road_permit; }else echo "";?>" class="form-control">
        </div>
    </div>   
    <div class="col-md-4">
        <div class="form-group">
            <lable>Transporter</lable>
            <select name="transporter_id" class="form-control">
            <option value="">select</option>
                <?php if($transport_info){ foreach($transport_info as $key){ ?>
                    <option value="<?= $key->id; ?>" <?php if($dispatch_info->transporter_id==$key->id){echo "selected"; }?>><?php echo $key->transport_comp_name." ".$key->vhno ; ?></option>
                <?php } } ?>
            </select>
        </div>
    </div>  
</div>

<input type="hidden" name="client_id" value="<?php echo $client_info->id; ?>">
<input type="hidden" name="order_id"  value="<?php echo $model_info->id; ?>">
<input type="hidden" name="dispatch_order_id" value="<?php if($dispatch_info->id) {echo $dispatch_info->id;}else{echo 0;}?>">
<?php $address = $client_info->address . ", " . $client_info->city . ", " . $client_info->state . ", " . $client_info->zip . ", " . $client_info->country; ?>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <lable>Purchase Order No</lable>
            <br>
            <lable>Purchase Date</lable>  <br>           
            <lable> Terms of Delivery</lable> <br>
            <lable> Mobile</lable> <br>
            <lable> GST</lable> <br>
            
            <lable>Mode of Transportation</lable> <br>
            <lable>Freight</lable> <br>
        </div>
    </div>
    <div class="col-md-9">
        <?php echo $model_info->purchase_order; ?> <br>
        <?php echo $model_info->order_date; ?>    <br>     
        <?= $client_info->name_of_contact_person; ?>  <br> 
        <?php echo $client_info->mobile; if($client_info->phone) echo "/ ".$client_info->phone; ?> <br>
        <?= $client_info->gst_number ?> <br>
    
        <?php echo $model_info->mode_of_transportation; ?> <br>
        <?php echo $model_info->freight; ?> <br>
    </div>  
</div>


<div class="row">
    <div class="col-md-3">
        <div class="form-group">
        <lable>Address Billing</lable> <br>
        </div>
    </div>
    <div class="col-md-9">
    <?= $address ?> <br>
    </div>  
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <lable>Address Dispatch</lable> <br>    
        </div>
    </div>
    <div class="col-md-9">
        <?php echo $model_info->address_consignee; ?>  <br>
    </div>  
</div>
<?php 
$products = json_decode($model_info2->products);
$gst = json_decode($model_info2->gst);
$quantity = json_decode($model_info2->quantity);
$rate = json_decode($model_info2->rate);
$total = json_decode($model_info2->total);
$rowNum = count($products);  
$num=1;

for ($i=0;$i<$rowNum;$i++){ ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <lable>Product - Supply (<?= $num; ?>)</lable> <br>    
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <lable>Item (<?= $num; ?>)</lable> <br>  
                <lable>Quantity in Kgs</lable> <br>  
                <lable>Rate</lable> <br>  
                <lable>GST</lable> <br>  
            </div>
            <div class="col-md-9">
                <lable><?= $products[$i] ?></lable> <br>  
                <lable><?= $quantity[$i] ?></lable> <br>  
                <lable><?= $rate[$i] ?></lable> <br>  
                <lable><?= $gst[$i] ?></lable> <br>  
            </div>
        </div>
    </div>  
</div>

<?php $num++; }?>






