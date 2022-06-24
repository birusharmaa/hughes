<?php

namespace App\Controllers;
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report_mis_payment extends Security_Controller
{

    function __construct()
    {
        parent::__construct();

        //check permission to access this module
        $this->init_permission_checker("client");
    }

    function list_data()
    {
        $options = [];
        if (!empty($this->request->getPost("start_date"))) {
            $options = [
                'start_date' => $this->request->getPost("start_date"),
                'end_date' => $this->request->getPost("end_date"),
            ];
        }
        if ($this->login_user->is_admin == 1) {
            $res =  $this->dispatch_advice_list_data_of_client('', $options);
        } else {
            $res =  $this->dispatch_advice_list_data_of_client($this->login_user->id, $options);
        }
        return $res;
    }

    private function _make_row($i, $data)
    {
        $row_data = array(
            '# ' . $i,
            $data->company_name,
            $data->address,
            $data->name_of_contact_person,
            $data->mobile,
        );
        return $row_data;
    }

    function dispatch_advice_list_data_of_client($client_id = 0, $date_option)
    {
        $options = array(
            "client_id" => $client_id
        );
        $options = array_merge($options, $date_option);

        $list_data = $this->Orders_model->get_mis_payment_reports($options)->getResult();
        $result = array();
        $i = 1;
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($i, $data);
            $i++;
        }
        echo json_encode(array("data" => $result));
    }

    function downloadExcel($from=null, $to=null){
        $start_date = "";
        if(!empty($from)){
            $start_date = date('Y-m-d', strtotime($from));
        }

        $end_date = "";
        if(!empty($from)){
            $end_date = date('Y-m-d', strtotime($to));
        }
       
        
        if ($this->login_user->is_admin == 1) {
            $options = array(
                "client_id" => '',
                'start_date'=> $start_date,
                'end_date'  => $end_date
            );
        } else {
            $options = array(
                "client_id" => $this->login_user->id,
                'start_date'=> $start_date,
                'end_date'  => $end_date
            );
        }
        $list_data = $this->Orders_model->get_mis_payment_reports($options)->getResult();



        $file_name = 'mis_payment' . date('Ymd') . '.xlsx';
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
        ->getStartColor()->setARGB('FFFF0000');

        if(!empty($start_date)){
            $date = date("d-m-Y", strtotime($start_date))." To ".date("d-m-Y", strtotime($end_date));
            $expect_date_first = "10-".date("m-Y", strtotime($start_date));
            $expect_date_second= "20-".date("m-Y", strtotime($start_date));
            $expect_date_third = "30-".date("m-Y", strtotime($start_date));
            $expect_date_fourth= date('M-Y', strtotime('+1 month', strtotime($start_date)));
        }else{
            $date = date("d-m-Y");
            $expect_date_first = "10-".date("m-Y");
            $expect_date_second= "20-".date("m-Y");
            $expect_date_third = "30-".date("m-Y");
            $expect_date_fourth= date('M-Y', strtotime('+1 month'));
        }
        
        $sheet->setCellValue('A1', 'MIS of Payment As On '.$date);
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];

        $styleArray_header_grad = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'e7e7a1',
                ],
                'endColor' => [
                    'argb' => 'FFFF00',
                ],
            ],
        ];
       
        
        $sheet->mergeCells("A1:H1");      
        $sheet->mergeCells("E2:H2");
        
        $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('D2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('F2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('G2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('H2')->applyFromArray($styleArray);
        // $sheet->setAutoSize(TRUE);
        
		$sheet->setCellValue('A2', 'Sr No');
		$sheet->setCellValue('B2', 'Particulars');
		$sheet->setCellValue('C2', 'Amount');
		$sheet->setCellValue('D2', 'Due Date');
		$sheet->setCellValue('E2', 'Expected Realisation');

        $sheet->setCellValue('A3', "");
        $sheet->setCellValue('B3', "");
        $sheet->setCellValue('C3', "");
        $sheet->setCellValue('D3', "");
        $sheet->setCellValue('E3', $expect_date_first);
        $sheet->setCellValue('F3', $expect_date_second);
        $sheet->setCellValue('G3', $expect_date_third);
        $sheet->setCellValue('H3', $expect_date_fourth);
        
        $k = 4;
        $i = 0;
        $grand_total = 0;
        foreach ($list_data as $data) {
            $j = 1;
            //Show clients name
            $sheet->setCellValue('A'.$k, chr(65+$i) );
            $sheet->setCellValue('B'.$k, $data->company_name);
            $sheet->setCellValue('C'.$k, "");
            $sheet->setCellValue('D'.$k, "");
            $sheet->setCellValue('E'.$k, "");
            $k++;

            $client_id = $data->id;

            //Get client order details
            $order_datails = $this->Orders_model->getOrderDetails($client_id);
            //Get bussiness/order details
            $final_amt = 0;
            foreach ($order_datails as $order_datail) {
                $final_amt = $final_amt+$order_datail->total_amount;
                $sheet->setCellValue('A'.$k, $j);
                $sheet->setCellValue('B'.$k, $order_datail->business_name);
                $sheet->setCellValue('C'.$k, to_currency($order_datail->total_amount));
                $sheet->setCellValue('D'.$k, date('d.m.Y', (strtotime($order_datail->order_date))+(86400*7)) );
                
                $payment_details = $this->Orders_model->getPeymentDetails($client_id);

                $tot = count($payment_details);
                
                $m = 0;
                $ind = chr(69+$m++).$k;
                foreach ($payment_details as $payment_detail) {
                    $sheet->setCellValue($ind, "A");
                    $sheet->setCellValue($ind, "B");
                    $sheet->setCellValue($ind, "C");
                    $sheet->setCellValue($ind, $payment_detail->amount);
                }

                

                $k++;
                $j++;
            }
            $grand_total = $grand_total+$final_amt;
            $sheet->setCellValue('A'.$k, "");
            $sheet->setCellValue('B'.$k, "TOTAL ".chr(65+$i));
            $sheet->setCellValue('C'.$k, to_currency($final_amt));
            $sheet->setCellValue('D'.$k, " ");
            $sheet->setCellValue('E'.$k, "");
            $spreadsheet->getActiveSheet()->getStyle('A'.$k)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B'.$k)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C'.$k)->applyFromArray($styleArray);
            $str = 'A'.$k.':'.'H'.$k;
            $sheet->getStyle($str)->applyFromArray($styleArray_header_grad);	
            
            if($i == (sizeof($list_data)-1)){
                $last = $k+1;
                $sheet->setCellValue('A'.$last, "");
                $sheet->setCellValue('B'.$last, "GRAND TOTAL");
                $sheet->setCellValue('C'.$last, to_currency($grand_total));
                $sheet->setCellValue('D'.$last, "");
                $sheet->setCellValue('E'.$last, "");

                $spreadsheet->getActiveSheet()->getStyle('A'.$last)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('B'.$last)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('C'.$last)->applyFromArray($styleArray);

                $str = 'A'.$last.':'.'H'.$last;
                $sheet->getStyle($str)->applyFromArray($styleArray_header_grad);	
            }
            $k++;
            $i++;
        }
       
        for ($l = 'A'; $l !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $l++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($l)->setAutoSize(TRUE);
            $spreadsheet->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal('center');
        }

        $writer = new Xlsx($spreadsheet);
		$writer->save($file_name);
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
		header('Content-Length:' . filesize($file_name));
		readfile($file_name);
		exit;
    }
}
