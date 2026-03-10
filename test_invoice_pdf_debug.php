<?php
// Direct PDF test
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'application/app.php';

// Get first invoice
$d = ORM::for_table('sys_invoices')->order_by_desc('id')->find_one();

if (!$d) {
    die("No invoice found");
}

echo "Testing PDF generation for invoice: " . $d['id'] . "<br>";

// Get invoice items
$items = ORM::for_table('sys_invoiceitems')->where('invoiceid', $d['id'])->order_by_asc('id')->find_many();
echo "Items: " . count($items) . "<br>";

// Get account
$a = ORM::for_table('crm_accounts')->find_one($d['userid']);
echo "Account: " . $a['account'] . "<br>";

// Create simple HTML
$html = '<html><body>';
$html .= '<h1>Invoice #' . $d['invoicenum'] . '</h1>';
$html .= '<p>Company: ' . $config['CompanyName'] . '</p>';
$html .= '<p>Customer: ' . $a['account'] . '</p>';
$html .= '<p>Amount: ' . $d['total'] . '</p>';
$html .= '</body></html>';

echo "HTML Length: " . strlen($html) . "<br>";

// Try creating mPDF
try {
    $mpdf = new \Mpdf\Mpdf();
    echo "mPDF created successfully<br>";
    
    $mpdf->WriteHTML($html);
    echo "HTML written to PDF<br>";
    
    // Try to output
    $filename = 'test_invoice_' . date('YmdHis') . '.pdf';
    $filepath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;
    
    $mpdf->Output($filepath, 'F');
    echo "PDF written to: " . $filepath . "<br>";
    
    if (file_exists($filepath)) {
        echo "File exists!<br>";
        echo "File size: " . filesize($filepath) . " bytes<br>";
    } else {
        echo "File does not exist!<br>";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    echo $e->getTraceAsString();
}
?>
