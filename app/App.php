<?php

declare(strict_types=1);

// Your Code

// "transaction" is each data, "transactions" all of the data. transaction[date], transaction[check],
// transaction[desc], transaction[date], transaction[amount].

function getTransactions(string $directory):array
{
    echo "-------------------------------------------";
    echo "<br>";


    $files = scandir($directory);
    array_splice($files, 0, 2);
    foreach ($files as $file) {
        $resource = fopen("c:\\xampp\\htdocs\\file-parse-php8\\transaction_files\\" . $file, 'r');

        $transaction = fgetcsv($resource);
        $transactions = [];
        while($transaction != false)
        {
            array_push($transactions, $transaction);
            $transaction = fgetcsv($resource);
        }
        fclose($resource);
    }

    echo "<pre>";
    print_r($transactions);
    echo "</pre>";

    return $transactions;
}
