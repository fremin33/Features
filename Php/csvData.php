<?php

// Open file in write mode
$file = fopen('ps_orders.csv', 'w');

// Save the header column
fputcsv($file, array('Numero Facture', 'Date Facture', 'Montant HT', 'Montant TVA', 'Montant TTC', 'Libellé client', 'Société'));

// Connect to BDD with PDO
$db = new PDO('mysql:host=localhost;dbname=mercerine_prod', 'root', 'root');


$results = $db->query("
    SELECT 
        CONCAT('FA',LPAD(oi.id_order_invoice, 6, '0')) AS `Numéro Facture`,
        oi.date_add AS `Date Facture`,
        o.total_paid_tax_excl AS `Montant HT`,
        o.total_paid_tax_incl - o.total_paid_tax_excl AS `Montant TVA`,
        o.total_paid_tax_incl AS `Montant TTC`,
        CONCAT(firstname,' ',lastname) AS `Libellé client`,
        a.company AS `Société`
        FROM `ps_orders` o
    INNER JOIN ps_order_invoice oi ON o.id_order=oi.id_order
    INNER JOIN ps_address a ON a.id_address=o.id_address_invoice
    WHERE valid=1
    AND (oi.date_add < '2018-05-01 00:00:00')
    ORDER BY `oi`.`date_add`  DESC
");

$results = $results->fetchAll();

// Save each row of the data
foreach ($results as $row) {
    $data = array();
    array_push($data, $row[0],$row[1], $row[2], $row[3], $row[4], $row[5], $row[6]); 
    fputcsv($file, $data, ';');
}

// Close the file
fclose($file);
