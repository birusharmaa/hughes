<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>HUGHES & HUGHES CHEM LIMITED DISPATCH ADVICE</title>
		<style>
			* {
				margin: 0;
				padding: 0;
				/* box-sizing: border-box; */
			}
			.bg-blue {
				background-color: #99ccff;
			}
			.bg-green {
				background-color: #c5e0b4;
			}
			.bg-gray {
				background-color: #c0c0c0;
			}
			.bg-yellow {
				background-color: #ffff00;
			}
			.mw-50 {
				max-width: 50px;
				min-width: 50px;
				width: 50px;
			}
			th {
				text-align: left;
			}
		</style>
	</head>
	<body style="padding:20px; padding-left:50px; margin-top:20px">
		<table cellspacing="0" border="0" width="100%">
			<tr>
				<td class="mw-50" colspan="3" style="text-align: center">
					<h3 style="margin-bottom:20px">HUGHES & HUGHES CHEM LIMITED DISPATCH ADVICE</h3>
				</td>
			</tr>
			<tr>
				<th class="mw-50">Advice No.</th>
				<td class="mw-50"><?= $dispatch_info->advice_no;?></td>
				<td class="mw-50" rowspan="25">Paid Basis</td>
			</tr>
			<tr>
				<th class="mw-50">B.A. / Staff</th>
				<td class="mw-50"><?= $dispatch_info->staff;?></td>
			</tr>
			<tr>
				<th class="mw-50">Vendor Code</th>
				<td class="mw-50"><?= $dispatch_info->vendor_code;?></td>
			</tr>
			<tr>
				<th class="mw-50">Purchase Order No.</th>
				<td class="mw-50"><?= $model_info->purchase_order;?></td>
			</tr>
			<tr>
				<th class="mw-50">Purchase Order Date</th>
				<td class="mw-50"><?php echo date('d-M-Y', strtotime($model_info->order_date));?></td>
			</tr>
			<tr>
				<th class="mw-50">Mode / Terms of Payment</th>
				<td class="mw-50">
					50% payment with order and remaining 50% on delivery
				</td>
			</tr>
			<tr>
				<th class="mw-50">Terms of Delivery</th>
				<td class="mw-50">   <?= $client_info->name_of_contact_person; ?>  Mob-   <?php echo $client_info->mobile; if($client_info->phone) echo "/ ".$client_info->phone; ?></td>
			</tr>
			<tr>
				<th class="mw-50">Despatched Through</th>
				<td class="mw-50"> <?php echo $model_info->mode_of_transportation; ?> <br></td>
			</tr>
			<tr>
				<th class="mw-50">Destination</th>
				<td class="mw-50"><?= $dispatch_info->destination;?></td>
			</tr>
			<tr>
				<th class="mw-50">Road Permit</th>
				<td class="mw-50"><?= $dispatch_info->road_permit;?></td>
			</tr>
			<tr>
				<th class="mw-50">Transporter</th>
				<td class="mw-50"><?= $transport_info->transport_comp_name;?></td>
			</tr>
			<tr>
				<th class="mw-50">Transporter ID</th>
				<td class="mw-50"><?= $transport_info->gstno;?></td>
			</tr>
			<tr>
				<th class="mw-50">Distance in Kms</th>
				<td class="mw-50"><?= $dispatch_info->distance_in_kms;?></td>
			</tr>
			<tr>
				<td class="mw-50" colspan="2">
					<table cellspacing="0" border="0" width="100%" style="border: 0">
						<tr>
							<th class="mw-50">Party Name</th>
							<th class="mw-50"><?= $client_info->company_name;?></th>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">
								i. Address Dispatch
							</td>
							<?php $address = $client_info->address . ", " . $client_info->city . ", " . $client_info->state . ", " . $client_info->zip . ", " . $client_info->country; ?>

							<td class="mw-50">
								<?php echo $model_info->address_consignee; ?>  <br>
							</td>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">
								ii. Address Billing
							</td>
							<td class="mw-50">
							<?= $address ; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="mw-50" colspan="2">
					<table cellspacing="0" border="0" width="100%" style="border: 0">
						<tr>
							<th class="mw-50" colspan="2">Particulars No. FOR BILLING</th>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">A. GST No.</td>
							<td class="mw-50">	<?= $client_info->gst_number; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="mw-50" colspan="2">
					<table cellspacing="0" border="0" width="100%" style="border: 0">
						<tr>
							<th class="mw-50" colspan="2">Contact Details</th>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">
								A. Name – Purchase
							</td>
							<td class="mw-50">
							<?= $client_info->name_of_contact_person; ?> (Purchase Asst.) Mob- <?= $client_info->mobile; ?>
							</td>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">B. Email</td>
							<td class="mw-50"><?= $client_info->email; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="mw-50" colspan="2">
					<table cellspacing="0" border="0" width="100%" style="border: 0">
					<?php 
						$products = json_decode($model_info2->products);
						$gst = json_decode($model_info2->gst);
						$quantity = json_decode($model_info2->quantity);
						$rate = json_decode($model_info2->rate);
						$total = json_decode($model_info2->total);
						$rowNum = count($products);  
						$num=1;
						$net_total=0;
								
						for ($i=0;$i<$rowNum;$i++){ ?>
						<tr>
							<th class="mw-50" colspan="2">Product - Supply (<?= $num; ?>)</th>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">1. Item</td>
							<td class="mw-50"><?= $products[$i]; ?></td>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">
								2. Quantity in Kgs
							</td>
							<td class="mw-50"><?= $quantity[$i]; ?></td>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">3. Basic Rate</td>
							<td class="mw-50"><?= $rate[$i]; ?>/-</td>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">3. GST</td>
							<td class="mw-50"><?= $gst[$i]; ?>%</td>
						</tr>
					
						<tr>
							<td class="mw-50" style="padding-left: 20px">Basic Sum</td>
							<td class="mw-50"><?= $total[$i]; $net_total= $net_total+$total[$i];  ?>/-</td>
						</tr>
						<?php $num++; }?>
						<tr>
							<td class="mw-50" style="padding-left: 20px">Freight</td>
							<td class="mw-50"> <?php echo $model_info->freight."/-"; $net_total=$net_total+$model_info->freight; ?> </td>
						</tr>
						<tr>
							<td class="mw-50" style="padding-left: 20px">Application Charges for Rs</td>
							<td class="mw-50"><?php echo $model_info->application_charges."/-"; $net_total=$net_total+$model_info->application_charges;  ?></td>
						</tr>
						<tr style="display:none">
							<td class="mw-50" style="padding-left: 20px">4. IGST @ 18%</td>
							<td class="mw-50">11520</td>
						</tr>
						<tr>
							<th class="mw-50">G Total - Supply</th>
							<td class="mw-50"><strong><?php echo $net_total; ?>/-</strong></td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<th class="mw-50" colspan="2">
					<p style="margin-top:20px; margin-bottom:20px">
						The Purchase Order Has Been Checked And Above Contents Is Verified For
						Billing.
					</p>
				</th>
			</tr>
			<tr>
				<td colspan="2">
					<table cellspacing="0" border="0" width="100%" style="border: 0">
						<tr>
							<th class="mw-50">Prepared By – <?php echo $user_info->first_name." ".$user_info->last_name ?></th>
							<th class="mw-50">Date - <?php echo date('d-M-Y', strtotime($dispatch_info->created_at));?></th>
							<th class="mw-50">Approved By -</th>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
