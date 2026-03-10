<?php
// Test PDF Generation
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'application/app.php';

// Get first invoice
$invoice = ORM::for_table('sys_invoices')->order_by_desc('id')->find_one();

if ($invoice) {
    echo "Invoice found: " . $invoice['id'] . "<br>";
    echo "Attempting to generate PDF...<br>";
    
    // Try to generate PDF
    Invoice::pdf($invoice['id'], 'inline');
} else {
    echo "No invoices found in database";
}
?>
