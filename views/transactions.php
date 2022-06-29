<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- YOUR CODE -->
                <?php
                if (!empty($transactions))
                {
                    foreach ($transactions as $transaction)
                    {
                        ?>
                        <tr>
                            <td><?php
                                    $date = date_create($transaction[0]);
                                    echo date_format($date, 'M d, Y');
                                ?></td>
                            <td><?php echo $transaction[1] ?></td>
                            <td><?php echo $transaction[2] ?></td>
                            <td style=" color: <?php if($transaction[3][0] != '-') echo "green"; else echo "red";
                              ?>"><?php echo $transaction[3] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?php echo "$".getIncome($transactions); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?php echo "-$".getExpense($transactions)?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?php echo "$".getIncome($transactions) - getExpense($transactions); ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
