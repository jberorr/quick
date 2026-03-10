<?php
Class Invoice
{

    public static function gen_email($iid, $etpl)
    {

        global $config;

        $d = ORM::for_table('sys_invoices')->find_one($iid);

        if ($etpl == 'created') {
            $e = ORM::for_table('sys_email_templates')->where('tplname', 'Invoice:Invoice Created')->find_one();
        } elseif ($etpl == 'reminder') {
            $e = ORM::for_table('sys_email_templates')->where('tplname', 'Invoice:Invoice Payment Reminder')->find_one();
        } elseif ($etpl == 'overdue') {
            $e = ORM::for_table('sys_email_templates')->where('tplname', 'Invoice:Invoice Overdue Notice')->find_one();
        } elseif ($etpl == 'confirm') {
            $e = ORM::for_table('sys_email_templates')->where('tplname', 'Invoice:Invoice Payment Confirmation')->find_one();
        } elseif ($etpl == 'refund') {
            $e = ORM::for_table('sys_email_templates')->where('tplname', 'Invoice:Invoice Refund Confirmation')->find_one();
        } else {
            $d = false;
            $e = false;
        }

        if ($d) {

            $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
            if ($d['cn'] != '') {
                $dispid = $d['cn'];
            } else {
                $dispid = $d['id'];
            }
            $invoice_num = $d['invoicenum'] . $dispid;
            //parse template
            $total = $d['total'];
            $credit = $d['credit'];
            $due_amount = $total - $credit;
            $tax = $d['tax'];
            $taxrate = $d['taxrate'];
            $subtotal = $d['subtotal'];
            $subject = new Template($e['subject']);
            $subject->set('business_name', $config['CompanyName']);
            $subject->set('invoice_id', $invoice_num);
            $subj = $subject->output();
            $message = new Template($e['message']);
            $message->set('name', $a['account']);
            $message->set('customer_name', $a['account']);
            $message->set('client_name', $a['account']);
            $message->set('company', $a['company']);
            $message->set('business_name', $config['CompanyName']);
            $message->set('invoice_url', U . 'client/iview/' . $d['id'] . '/token_' . $d['vtoken']);
            $message->set('invoice_id', $invoice_num);
            $message->set('invoice_status', $d['status']);
            $message->set('invoice_amount_paid', number_format($credit, 2, $config['dec_point'], $config['thousands_sep']));
            $message->set('invoice_due_amount', number_format($due_amount, 2, $config['dec_point'], $config['thousands_sep']));
            $message->set('invoice_taxname', $d['taxname']);
            $message->set('invoice_tax_amount', number_format($tax, 2, $config['dec_point'], $config['thousands_sep']));
            $message->set('invoice_tax_rate', number_format($taxrate, 2, $config['dec_point'], $config['thousands_sep']));
            $message->set('invoice_subtotal', number_format($subtotal, 2, $config['dec_point'], $config['thousands_sep']));
            $message->set('invoice_due_date', date($config['df'], strtotime($d['duedate'])));
            $message->set('invoice_date', date($config['df'], strtotime($d['date'])));
            $message->set('invoice_amount', number_format($total, 2, $config['dec_point'], $config['thousands_sep']));
            $message_o = $message->output();

            $gen = array();

            $gen['cid'] = $a['id'];
            $gen['name'] = $a['account'];
            $gen['email'] = $a['email'];
            $gen['subject'] = $subj;
            $gen['body'] = $message_o;

            return $gen;



        }

        else{
            return false;
        }


    }


    public static function pdf($id,$r_type='',$token=''){

        global $config,$_L;

        // Get invoice data
        $d = ORM::for_table('sys_invoices')->find_one($id);
        if (!$d) {
            die('Invoice not found');
        }

        // Verify token if provided
        if($token != ''){
            $token = str_replace('token_','',$token);
            $vtoken = $d['vtoken'];
            if($token != $vtoken){
                die('Token verification failed');
            }
        }

        // Get invoice items and related data
        $items = ORM::for_table('sys_invoiceitems')->where('invoiceid', $id)->order_by_asc('id')->find_many();

        // Get customer data
        $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
        
        // Calculate due amount
        $i_credit = $d['credit'];
        $i_due = '0.00';
        $i_total = $d['total'];
        
        if($d['credit'] != '0.00'){
            $i_due = $i_total - $i_credit;
        }
        else{
            $i_due = $d['total'];
        }

        // Prepare display ID
        if($d['cn'] != ''){
            $dispid = $d['cn'];
        }
        else{
            $dispid = $d['id'];
        }

        $in = $d['invoicenum'].$dispid;

        // Generate professional invoice HTML
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8" /><style>';
        $html .= 'body { font-family: Arial, sans-serif; color: #333; margin: 0; padding: 20px; }';
        $html .= 'table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }';
        $html .= 'th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }';
        $html .= 'th { background-color: #2c3e50; color: white; font-weight: bold; }';
        $html .= 'tr:nth-child(even) { background-color: #f5f5f5; }';
        $html .= '.header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #2c3e50; padding-bottom: 20px; }';
        $html .= '.header h1 { color: #2c3e50; margin: 0 0 10px 0; font-size: 24px; }';
        $html .= '.header h2 { color: #666; margin: 0; font-size: 18px; }';
        $html .= '.company-info { margin-bottom: 20px; font-size: 12px; }';
        $html .= '.invoice-details { margin-bottom: 20px; }';
        $html .= '.section-title { font-weight: bold; margin-top: 15px; margin-bottom: 10px; font-size: 13px; background-color: #ecf0f1; padding: 8px; }';
        $html .= '.total-row { font-weight: bold; background-color: #e8f5e9; }';
        $html .= '.total-amount { color: #27ae60; font-size: 14px; font-weight: bold; }';
        $html .= '.summary-table { width: 50%; margin-left: auto; margin-top: 20px; margin-bottom: 20px; }';
        $html .= '.summary-table td { border: 1px solid #ddd; padding: 8px; }';
        $html .= '</style></head><body>';

        // Header
        $html .= '<div class="header">';
        $html .= '<h1>' . htmlspecialchars($config['CompanyName']) . '</h1>';
        $html .= '<h2>INVOICE</h2>';
        $html .= '</div>';

        // Company and Invoice Details
        $html .= '<div class="company-info">';
        $html .= '<p><strong>Invoice Number:</strong> ' . htmlspecialchars($d['invoicenum'] . $dispid) . '</p>';
        $html .= '<p><strong>Invoice Date:</strong> ' . htmlspecialchars($d['date']) . '</p>';
        $html .= '<p><strong>Due Date:</strong> ' . htmlspecialchars($d['duedate']) . '</p>';
        $html .= '<p><strong>Status:</strong> <strong style="color: #2c3e50;">' . htmlspecialchars($d['status']) . '</strong></p>';
        if ($config['caddress']) {
            $html .= '<p><strong>Address:</strong> ' . htmlspecialchars($config['caddress']) . '</p>';
        }
        $html .= '</div>';

        // Bill To
        $html .= '<div class="section-title">BILL TO:</div>';
        $html .= '<div style="margin-bottom: 20px; font-size: 12px;">';
        if ($a) {
            if ($a['company']) {
                $html .= '<p><strong>' . htmlspecialchars($a['company']) . '</strong></p>';
            }
            $html .= '<p>' . htmlspecialchars($a['account']) . '</p>';
            if ($a['address']) {
                $html .= '<p>' . htmlspecialchars($a['address']) . '</p>';
            }
            if ($a['city'] || $a['state'] || $a['zip']) {
                $html .= '<p>' . htmlspecialchars(trim($a['city'] . ' ' . $a['state'] . ' ' . $a['zip'])) . '</p>';
            }
            if ($a['country']) {
                $html .= '<p>' . htmlspecialchars($a['country']) . '</p>';
            }
            if ($a['phone']) {
                $html .= '<p><strong>Phone:</strong> ' . htmlspecialchars($a['phone']) . '</p>';
            }
            if ($a['email']) {
                $html .= '<p><strong>Email:</strong> ' . htmlspecialchars($a['email']) . '</p>';
            }
        }
        $html .= '</div>';

        // Line Items
        $html .= '<div class="section-title">INVOICE ITEMS</div>';
        $html .= '<table>';
        $html .= '<thead><tr>';
        $html .= '<th>Description</th>';
        $html .= '<th style="text-align: right; width: 80px;">Price</th>';
        $html .= '<th style="text-align: right; width: 80px;">Quantity</th>';
        $html .= '<th style="text-align: right; width: 80px;">Total</th>';
        $html .= '</tr></thead>';
        $html .= '<tbody>';
        
        if ($items && count($items) > 0) {
            foreach ($items as $item) {
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($item['description']) . '</td>';
                $html .= '<td style="text-align: right;">' . htmlspecialchars($item['cost']) . '</td>';
                $html .= '<td style="text-align: right;">' . htmlspecialchars($item['qty']) . '</td>';
                $html .= '<td style="text-align: right;" style="font-weight: bold;">' . htmlspecialchars($item['total']) . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="4" style="text-align: center; font-style: italic;">No items</td></tr>';
        }
        
        $html .= '</tbody>';
        $html .= '</table>';

        // Summary Table
        $html .= '<table class="summary-table">';
        $html .= '<tr><td><strong>Subtotal:</strong></td><td style="text-align: right;">' . htmlspecialchars($d['subtotal']) . '</td></tr>';
        if ($d['discount'] != '0.00') {
            $html .= '<tr><td><strong>Discount:</strong></td><td style="text-align: right;">-' . htmlspecialchars($d['discount']) . '</td></tr>';
        }
        if ($d['tax'] != '0.00') {
            $html .= '<tr><td><strong>Tax (' . htmlspecialchars($d['taxrate']) . '%):</strong></td><td style="text-align: right;">' . htmlspecialchars($d['tax']) . '</td></tr>';
        }
        $html .= '<tr class="total-row"><td><strong>TOTAL:</strong></td><td style="text-align: right;" class="total-amount">' . htmlspecialchars($d['total']) . '</td></tr>';
        if ($d['credit'] != '0.00') {
            $html .= '<tr><td><strong>Amount Paid (Credit):</strong></td><td style="text-align: right;">-' . htmlspecialchars($d['credit']) . '</td></tr>';
            $html .= '<tr class="total-row"><td><strong>AMOUNT DUE:</strong></td><td style="text-align: right;" class="total-amount">' . htmlspecialchars($i_due) . '</td></tr>';
        }
        $html .= '</table>';

        // Footer
        $html .= '<div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ccc; font-size: 11px; color: #666; text-align: center;">';
        $html .= '<p>Thank you for your business!</p>';
        if ($config['CompanyEmail']) {
            $html .= '<p>Email: ' . htmlspecialchars($config['CompanyEmail']) . '</p>';
        }
        $html .= '</div>';

        $html .= '</body></html>';

        // Clear output buffers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        // Prepare filename
        $filename = 'Invoice_' . preg_replace('/[^a-zA-Z0-9]/', '_', $d['invoicenum'] . $dispid) . '_' . date('Ymd') . '.pdf';

        // Send headers FIRST before any output
        header('Content-Type: application/pdf', true);
        header('Content-Transfer-Encoding: binary', true);
        header('Accept-Ranges: bytes', true);
        
        if ($r_type == 'dl') {
            // Download - force browser to download
            header('Content-Disposition: attachment; filename="' . $filename . '"', true);
            $output_type = 'D';
        } elseif ($r_type == 'store') {
            // Store to file/temp - we'll set temp dir path for mPDF to store
            $output_type = 'F';
        } else {
            // View in browser (default)
            header('Content-Disposition: inline; filename="' . $filename . '"', true);
            $output_type = 'I';
        }
        
        header('Cache-Control: no-cache, no-store, must-revalidate', true);
        header('Pragma: no-cache', true);
        header('Expires: 0', true);
        header('Connection: close', true);

        // Generate PDF using mPDF from vendor directory
        try {
            // Use absolute path to ensure vendor autoload is found
            if (!class_exists('\Mpdf\Mpdf')) {
                require_once dirname(__FILE__) . '/../../vendor/autoload.php';
            }
            
            $mpdf = new \Mpdf\Mpdf([
                'tempDir' => sys_get_temp_dir(),
                'format' => 'A4',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 20,
                'margin_bottom' => 20,
                'orientation' => 'P',
                'allow_output_buffer' => true
            ]);
            
            // Set document properties
            $mpdf->SetTitle($config['CompanyName'] . ' - Invoice ' . $filename);
            $mpdf->SetAuthor($config['CompanyName']);
            
            // Write HTML to PDF
            $mpdf->WriteHTML($html);
            
            // Output PDF based on type
            if ($output_type == 'F') {
                // Store to file
                $store_path = 'storage/temp/' . $filename;
                $mpdf->Output($store_path, 'F');
            } else {
                // Output to browser (inline or download)
                $mpdf->Output($filename, $output_type);
            }
            
            
        } catch (Exception $e) {
            // Clear any previous output
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            
            // Send error headers
            header('Content-Type: text/html; charset=utf-8', true);
            header('Content-Disposition: inline', true);
            
            // Log the error
            error_log('PDF Generation Error for Invoice ' . $id . ': ' . $e->getMessage());
            error_log('Stack Trace: ' . $e->getTraceAsString());
            
            // Output error message
            echo '<h1>PDF Generation Error</h1>';
            echo '<p><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<details><summary>Technical Details</summary><pre>';
            echo htmlspecialchars($e->getTraceAsString());
            echo '</pre></details>';
        }

        exit;
    }


    public static function forSingleItem($cid,$item,$amount,$repeat='One Time'){

        global $config;

        $datetime = date("Y-m-d H:i:s");

        $today = date('Y-m-d');


        $discount_type = 'f';
        $discount_value = '0.00';

        $actual_discount = '0.00';

        $fTotal = $amount;

        $taxval = '0.00';

        $taxname = '';

        $taxrate = '0.00';

        $notes = '';

        $invoicenum = '';

        $r = '0';
        $nd = $today;

        $cn = '';

        $currency = 0;
        $currency_symbol = $config['currency_code'];
        $currency_rate = 1.0000;

        $u = ORM::for_table('crm_accounts')->find_one($cid);

        if(!$u){
            return false;
        }



        // check billing cycle

        $idate = $today;
        $its = strtotime($idate);

        if ($repeat == '0' || $repeat == 'One Time' || $repeat == 'Free Account') {
            $r = '0';
        } elseif ($repeat == 'week1') {
            $r = '+1 week';
            $nd = date('Y-m-d', strtotime('+1 week', $its));
        } elseif ($repeat == 'weeks2') {
            $r = '+2 weeks';
            $nd = date('Y-m-d', strtotime('+2 weeks', $its));
        } elseif ($repeat == 'Monthly') {


            $r = '+1 month';
            $nd = date('Y-m-d', strtotime('+1 month', $its));

        } elseif ($repeat == 'months2') {
            $r = '+2 months';
            $nd = date('Y-m-d', strtotime('+2 months', $its));
        } elseif ($repeat == 'Quarterly') {
            $r = '+3 months';
            $nd = date('Y-m-d', strtotime('+3 months', $its));
        } elseif ($repeat == 'Semi-Annually') {
            $r = '+6 months';
            $nd = date('Y-m-d', strtotime('+6 months', $its));
        } elseif ($repeat == 'Annually') {
            $r = '+1 year';
            $nd = date('Y-m-d', strtotime('+1 year', $its));
        } elseif ($repeat == 'Biennially') {
            $r = '+2 years';
            $nd = date('Y-m-d', strtotime('+2 years', $its));
        } elseif ($repeat == 'Triennially') {
            $r = '+3 years';
            $nd = date('Y-m-d', strtotime('+3 years', $its));
        } else {
           // $msg .= 'Date Parsing Error <br> ';
        }


        //

        $vtoken = _raid(10);
        $ptoken = _raid(10);
        $d = ORM::for_table('sys_invoices')->create();
        $d->userid = $cid;
        $d->account = $u->account;
        $d->date = $today;
        $d->duedate = $today;
        $d->datepaid = $datetime;
        $d->subtotal = $amount;
        $d->discount_type = $discount_type;
        $d->discount_value = $discount_value;
        $d->discount = $actual_discount;
        $d->total = $fTotal;
        $d->tax = $taxval;
        $d->taxname = $taxname;
        $d->taxrate = $taxrate;
        $d->vtoken = $vtoken;
        $d->ptoken = $ptoken;
        $d->status = 'Unpaid';
        $d->notes = $notes;
        $d->r = $r;
        $d->nd = $nd;
        //others
        $d->invoicenum = $invoicenum;
        $d->cn = $cn;
        $d->tax2 = '0.00';
        $d->taxrate2 = '0.00';
        $d->paymentmethod = '';

        // Build 4550

        $d->currency = $currency;
        $d->currency_symbol = $currency_symbol;
        $d->currency_rate = $currency_rate;


        //
        $d->save();
        $invoiceid = $d->id();




        // Add Invoice Items

        $sqty = 1;
        $samount = $amount;
        $ltotal = $amount;


        $d = ORM::for_table('sys_invoiceitems')->create();
        $d->invoiceid = $invoiceid;
        $d->userid = $cid;
        $d->description = $item;
        $d->qty = $sqty;
        $d->amount = $samount;
        $d->total = $ltotal;



        $d->taxed = '0';


        //others
        $d->type = '';
        $d->relid = '0';
        $d->itemcode = '';
        $d->taxamount = '0.00';
        $d->duedate = date('Y-m-d');
        $d->paymentmethod = '';
        $d->notes = '';

        $d->save();

        $msg = Invoice::gen_email($invoiceid,'created');



        if($msg){
            $subj = $msg['subject'];
            $message_o = $msg['body'];
            $email = $msg['email'];
            $name = $msg['name'];
        }
        else{
            $subj = '';
            $message_o = '';
            $email = '';
            $name = '';
        }

        if($email != ''){


            Invoice::pdf($invoiceid,'store');

            $attachment_path = 'application/storage/temp/Invoice_'.$invoiceid.'.pdf';
            $attachment_file = 'Invoice_'.$invoiceid.'.pdf';
            Notify_Email::_send($name, $email, $subj, $message_o, $u->id, $invoiceid, '', '', $attachment_path, $attachment_file);
        }

        return $invoiceid;


    }


    public static function cloneInvoice($id)
    {


        $inv = ORM::for_table('sys_invoices')->find_one($id);

        if ($inv) {

            $vtoken = _raid(10);
            $ptoken = _raid(10);
            $d = ORM::for_table('sys_invoices')->create();
            $d->userid = $inv->userid;
            $d->account = $inv->account;
            $d->date = $inv->date;
            $d->duedate = $inv->duedate;
            $d->datepaid = $inv->datepaid;
            $d->subtotal = $inv->subtotal;
            $d->discount_type = $inv->discount_type;
            $d->discount_value = $inv->discount_value;
            $d->discount = $inv->discount;
            $d->total = $inv->total;
            $d->tax = $inv->tax;
            $d->taxname = $inv->taxname;
            $d->taxrate = $inv->taxrate;
            $d->vtoken = $vtoken;
            $d->ptoken = $ptoken;
            $d->status = 'Unpaid';
            $d->notes = $inv->notes;
            $d->r = $inv->r;
            $d->nd = $inv->nd;
            //others
            $d->invoicenum = $inv->invoicenum;
            $d->cn = $inv->cn;
            $d->tax2 = $inv->tax2;
            $d->taxrate2 = $inv->taxrate2;
            $d->paymentmethod = $inv->paymentmethod;

            // Build 4550

            $d->currency = $inv->currency;
            $d->currency_symbol = $inv->currency_symbol;
            $d->currency_rate = $inv->currency_rate;
            $d->save();
            $invoiceid = $d->id();

            $items = ORM::for_table('sys_invoiceitems')->where('invoiceid', $id)->order_by_asc('id')->find_array();
            foreach ($items as $item) {
                $t = ORM::for_table('sys_invoiceitems')->create();
                $t->invoiceid = $invoiceid;
                $t->userid = $item['userid'];
                $t->description = $item['description'];
                $t->qty = $item['qty'];
                $t->amount = $item['amount'];
                $t->total = $item['total'];
                $t->taxed = $item['taxed'];
                $t->type = '';
                $t->relid = '0';
                $t->itemcode = '';
                $t->taxamount = '0.00';
                $t->duedate = date('Y-m-d');
                $t->paymentmethod = '';
                $t->notes = '';
                $t->save();
            }

            return $invoiceid;



        }

        return false;

    }

}