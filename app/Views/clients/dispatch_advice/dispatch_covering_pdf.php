<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Format of Dispatch Covering Letter</title>
	</head>
	<body>
		<p>REF: <?= $dispatch_info->advice_no; ?>/Linc Limited./01</p>
		<p>Date: 31.03.2022</p>
		<p style="text-align: right">Speed Post/Advance copy by Email</p>
		<p>Mr. <?= $client_info->company_name; ?> (Purchase Asst.)</p>
		<p>Mob- <?= $client_info->mobile; ?></p>
		<p><strong><?= $client_info->company_name; ?></strong></p>
		<p>
            <?= $client_info->address; ?>, <br />
			<?= $client_info->city; ?> <br />
			<?= $client_info->state; ?>, <br />
			Pin <?= $client_info->zip; ?>, <br />
			 <?= $client_info->country; ?>
		</p>
		<p>
			<strong>
				Subject : Material Dispatch Details: Purchase Order No. <?= $model_info->purchase_order;?> dated
				29.03.2022 against supply of 100 Kgs of Pestgo- A Non Toxic Bird
				Deterrent Gel.
			</strong>
		</p>
		<p>Dear Sir,</p>
		<div>
			<p>
				This is with reference to your Purchase Order mentioned above. We are
				pleased to inform you that we have dispatched your ordered material for
				door delivery. We are enclosing herewith the following to enable you to
				process our payment.
			</p>
			<ul>
				<li>
					The Copy of your Purchase Order, is enclosed as
					<strong>Annexure-A</strong>.
				</li>
				<li>
					Our Invoice No. <?= $covering_info->invoice_no;?> dated <?= $covering_info->invoice_date;?> for Rs. <?= $covering_info->invoice_amount;?>/- is
					enclosed as <strong>Annexure-</strong> B.
				</li>
				<li>
					Our Delivery Note. <?= $covering_info->delivery_note;?> dated <?= $covering_info->delivery_date;?>, is enclosed as
					<strong>Annexure-C</strong>.
				</li>
				<li>
					Docket Details of TCI Express Ltd. Docket No. <?= $covering_info->docket_no;?> dated
					<?= $covering_info->docket_date;?> on Paid Basis for Door Delivery is enclosed as
					<strong>Annexure-D</strong>.
				</li>
				<li>
					The Particulars of our Bank Account maintained with State Bank of
					India, is enclosed as <strong>Annexure-E</strong>.
				</li>
			</ul>
			<p>
				Kindly arrange to send us the payment as per payment terms of the
				aforesaid purchase order. For any clarification please contact
				undersigned on phone 011-47629920.
			</p>
			<p>
				We look forward for your continued patronage and ensure the best of
				services at all time.
			</p>
			<p>Thanking you,</p>
			<p>
				<strong>For HUGHES & HUGHES CHEM LTD</strong>
			</p>
			<br />
			<br />
			<p><strong>Soummya Sagar</strong></p>
			<p><strong>Post Sales Executive</strong></p>
		</div>
	</body>
</html>
