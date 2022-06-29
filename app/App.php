<?php

declare(strict_types=1);

// Your Code

// "transaction" is each data, "transactions" all of the data. transaction[date], transaction[check],
// transaction[desc], transaction[date], transaction[amount].

function getTransactions(string $directory, ?callable $transactionHandler):array
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
        fgetcsv(($resource)); // first line contains unnecessary headers.
        $transaction = fgetcsv($resource);

        while($transaction != false)
        {

            array_push($transactions, $transactionHandler($transaction));
            $transaction = fgetcsv($resource);
        }

        fclose($resource);
    }

    return $transactions;
}

function extractTransaction(array $transactionRow) : array
{
    $amount = str_replace(['$', ','], '', $transactionRow[3]);
    return [
        'date' => $transactionRow[0],
        'check' => $transactionRow[1],
        'description' => $transactionRow[2],
        'amount' => (float)$amount
        ];
}

function getIncome(array $transactions) : float
{
    $totalIncome = 0.0;
    foreach ($transactions as $transaction)
    {
        if($transaction['amount'] > 0)
        {
            $totalIncome += $transaction['amount'];
        }

    }
    return $totalIncome;
}

function getExpense(array $transactions) : float
{
    $totalIncome = 0.0;
    foreach ($transactions as $transaction)
    {
        if($transaction['amount'] < 0)
        {
            $totalIncome += $transaction['amount'];
        }

    }
    return $totalIncome;
}
