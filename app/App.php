<?php

declare(strict_types=1);

// Your Code

// "transaction" is each data, "transactions" all of the data. transaction[date], transaction[check],
// transaction[desc], transaction[date], transaction[amount].

function getTransactions(string $directory):array
{
    $files = scandir($directory);
    $transactions = [];

    foreach ($files as $file) {
        if (is_dir($file))
            continue;

        $filePath = $directory . "\\" . $file;
        if (!file_exists($filePath))
            trigger_error('file '. $filePath . ' does not exists', E_USER_ERROR);

        $resource = fopen($filePath, 'r');
        fgetcsv(($resource)); // first line contains unnecessary explanatory information.
        $transaction = fgetcsv($resource);

        while($transaction != false)
        {
            array_push($transactions, $transaction); // make transactions free of "$", "," in separate func.
            $transaction = fgetcsv($resource);
        }

        fclose($resource);
    }

    return $transactions;
}

function getIncome(array $transactions) : float
{
    $totalIncome = 0.0;
    foreach ($transactions as $transaction)
    {
        if($transaction[3][0] != '-')
        {
            $number = substr($transaction[3], 1, strlen($transaction[3]));
            $totalIncome += (float)$number;
        }

    }
    return $totalIncome;
}

function getExpense(array $transactions) : float
{
    $totalIncome = 0.0;
    foreach ($transactions as $transaction)
    {
        if($transaction[3][0] == '-')
        {
            $number = substr($transaction[3], 2, strlen($transaction[3]));
            $totalIncome += floatval($number);
        }

    }
    return $totalIncome;
}
