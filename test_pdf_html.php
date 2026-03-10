<?php
// Test PDF HTML generation
require 'application/app.php';

// Get first invoice
$d = ORM::for_table('sys_invoices')->order_by_desc('id')->find_one();

if ($d) {
    echo "Invoice found: " . $d['id'] . "<br>";
    
    // Get all needed variables
    $items = ORM::for_table('sys_invoiceitems')->where('invoiceid', $d['id'])->order_by_asc('id')->find_many();
    $trs_c = ORM::for_table('sys_transactions')->where('iid', $d['id'])->count();
    $trs = ORM::for_table('sys_transactions')->where('iid', $d['id'])->order_by_desc('id')->find_many();
    $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
    $cf = ORM::for_table('crm_customfields')->where('showinvoice', 'Yes')->order_by_asc('id')->find_many();
    
    // Calculate due
    $i_credit = $d['credit'];
    $i_due = $d['total'] - $d['credit'];
    
    // Display ID
    $dispid = $d['cn'] != '' ? $d['cn'] : $d['id'];
    
    echo "Account: " . $a['account'] . "<br>";
    echo "Amount: " . $d['total'] . "<br>";
    echo "HTML template test will load...<br>";
    
    // Try loading template
    ob_start();
    $pdf_tpl = 'application/lib/invoices/pdf-x2.php';
    @include $pdf_tpl;
    $html = ob_get_clean();
    
    echo "HTML Generated: " . strlen($html) . " bytes<br>";
    if (empty($html)) {
        echo "ERROR: No HTML generated!<br>";
    } else {
        echo "Success! First 500 chars:<br>";
        echo "<pre>" . htmlspecialchars(substr($html, 0, 500)) . "</pre>";
    }
} else {
    echo "No invoices found";
}
?>
