<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
		<style>
			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
			}
			td {
				padding: 5px;
			}
		</style>
	</head>

    <?php              
        $products = json_decode($model_info2->products);
        $gst = json_decode($model_info2->gst);
        $quantity = json_decode($model_info2->quantity);
        $rate = json_decode($model_info2->rate);
        $total = json_decode($model_info2->total);
        $rowNumOne = count($products);  
        $affected_area = json_decode($model_info2->affected_area);
        $pestgo_gel = json_decode($model_info2->pestgo_gel);               
        $rowNumTwo = count($affected_area); 
    ?>
	<body>
		<p lang="en-US" align="center">
			<strong>HUGHES &amp; HUGHES CHEM LIMITED</strong>
		</p>
		<p lang="en-US" align="center">
			<strong>(An Indo-British Joint Venture)</strong>
		</p>
		<p lang="en-US" align="center">
			<strong>ORDER PROCESSING FORM</strong>
		</p>
		<table
			width="90%"
			style="margin-left: 5%; margin-right: 5%"
			cellpadding="7"
			cellspacing="0"
			border="1"
		>
			<tbody>
				<tr>
					<td>1.</td>
					<td colspan="3">
						Purchase Order No.: <?php echo $model_info->purchase_order; ?> 
						____Date: <?php echo date('d-M-Y', strtotime($model_info->order_date)); ?>
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td colspan="3">Customer’ Name: <?php echo $client_info->company_name; ?></td>
				</tr>
				<tr>
					<td>3.</td>
					<td colspan="3">
						Address Consignee: <?= $model_info->address_consignee; ?>
					</td>
				</tr>
				<tr>
					<td>4.</td>
					<td colspan="3">
						Concern Person: <?= $client_info->name_of_contact_person; ?> <br />
						Mobile: <?php echo $client_info->mobile; if($client_info->phone) echo "/".$client_info->phone; ?>
					</td>
				</tr>
				<tr>
					<td>5.</td>
					<td colspan="3">GST: <?= $client_info->gst_number; ?></td>
				</tr>
				<tr>
					<td>6.</td>
					<td colspan="3">
						<table
							style="width: 100%; text-align: center"
							border="1"
							cellspacing="0"
						>
							<thead>
								<tr>
									<th></th>
									<th>Product</th>
									<th>Qty.</th>
									<th>Rate</th>
									<th>GST</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>                              
                            <?php $num=1;  for ($i=0;$i<$rowNumOne;$i++){ ?>                         
								<tr>
									<td><?= $num ?>)</td>
									<td><?= $products[$i] ?></td>
									<td><?= $quantity[$i] ?></td>
									<td><?= $rate[$i] ?></td>
									<td><?= $gst[$i] ?>%</td>
									<td><?= $total[$i]."/-" ?></td>
								</tr>	
                            <?php $num++; } ?>							
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>7.</td>
					<td colspan="3">
						<table width="100%;">
							<tr>
								<td>
									(i) Application Charges for Rs.
									<?= $model_info->application_charges;?>/-
								</td>
							</tr>
							<tr>
								<td>
									(ii) Total Amount :
									<?= $model_info->total_amount;?>/-
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php $address = $client_info->address . ", " . $client_info->city . ", " . $client_info->state . ", " . $client_info->zip . ", " . $client_info->country; ?>
				<tr>
					<td>8.</td>
					<td colspan="3">
						Bill will be raised in the name of :
						<strong><?= $client_info->company_name; ?></strong> <br />
						<?= $address; ?>
					</td>
				</tr>
				<tr>
					<td>9.</td>
					<td colspan="3">
						<p>Location where Gel Proposal to be applied</p>
						<table
							width="100%"
							style="text-align: center"
							border="1"
							cellspacing="0"
						>
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Affected Area</th>
									<th>Pestgo Gel (in kgs)</th>
								</tr>
							</thead>
							<tbody>
                            <?php $num2=1; $totalValues=0;  for ($x=0;$x<$rowNumTwo;$x++){ ?>      
								<tr>
									<td><?= $num2; ?>)</td>
									<td><?= $affected_area[$x]?></td>
									<td><?php echo $pestgo_gel[$x];  $totalValues= $totalValues+$pestgo_gel[$x];?></td>
								</tr>
                                <?php $num2++; }?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="2">TOTAL</th>								
									<th><?php echo $totalValues; ?></th>
								</tr>
							</tfoot>
						</table>
					</td>
				</tr>
				<tr>
					<td>10.</td>
					<td colspan="3">
						Freight: FREIGHT CHARGES EXTRA AT ACTUALS (<?= $model_info->freight; ?>/-) including
					</td>
				</tr>
				<tr>
					<td>11.</td>
					<td colspan="3">Mode of Transportation: <?= $model_info->mode_of_transportation;?></td>
				</tr>
				<tr>
					<td>12.</td>
					<td colspan="3">
						Payment Terms as per P.O. For Material: 50% Advance & After delivery
						balance 50% Payment
					</td>
				</tr>
				<tr>
					<td>13.</td>
					<td colspan="3">
						<table width="100%">
							<tr>
								<td>Place : <?= $model_info->place;?></td>
								<td>Name : <?= $model_info->name;?></td>
								<td>Date : <?php echo date('d-M-Y',strtotime($model_info->date));?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th colspan="4">MOVEMENT OF DOUCMENT ( Date & Time wise)</th>
				</tr>			
				<tr>				
					<td>1. </td>
					<td>Receipt of Purchase order from Market</td>
					<td>Date:- <?php echo date('d-M-Y',strtotime($model_info->purchase_order_receipt));?></td>
					<td>Time:- <?php echo date('h:s A',strtotime($model_info->purchase_order_receipt));?></td>
				</tr>
				<tr>
					<td>2. </td>
					<td>Billing to Accounts</td>
					<td>Date:- <?php echo date('d-M-Y',strtotime($model_info->billing_to_accounts));?></td>
					<td>Time:- <?php echo date('h:s A',strtotime($model_info->billing_to_accounts));?></td>
				</tr>
				<tr>
					<td>3. </td>
					<td>or Despatch</td>
					<td>Date:- <?php echo date('d-M-Y',strtotime($model_info->despatch));?></td>
					<td>Time:- <?php echo date('h:s A',strtotime($model_info->despatch));?></td>
				</tr>
				<tr>
					<td>4. </td>
					<td>Actual Despatch</td>
					<td>Date:- <?php echo date('d-M-Y',strtotime($model_info->actual_despatch));?></td>
					<td>Time:- <?php echo date('h:s A',strtotime($model_info->actual_despatch));?></td>
				</tr>
				<tr>
					<td>5</td>
					<td>Despatch of Bills</td>
					<td>Date:- <?php echo date('d-M-Y',strtotime($model_info->despatch_of_bills));?></td>
					<td>Time:- <?php echo date('h:s A',strtotime($model_info->despatch_of_bills));?></td>
				</tr>
			</tbody>
		</table>
		<table
			width="90%"
			style="margin-left: 5%; margin-right: 5%; margin-top: 20px"
		>
			<tr>
				<td>Prepared By: ________</td>
				<td>Checked By : ________</td>
				<td>Approved By: ________</td>
			</tr>
		</table>
	</body>
</html>
