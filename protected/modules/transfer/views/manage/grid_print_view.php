<?php
/* @var $this TransferManageController */
/* @var $model Transfer */
/* @var $from int */
/* @var $to int */
?><!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <title>Print Receipt</title>
    <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl.'/css/a4-print.css?2.1' ?>" media="print">
    <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl.'/css/a4-print.css?2.1' ?>" media="screen">
    <style>
        .great-vibes {
            font-family: "Great Vibes", cursive;
            font-weight: bold;
        }

    </style>
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>
<body translate="no">
<div id="invoice-POS">
    <table cellspacing="0">
        <thead>
        <tr height="50">
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('payment_method')?></td>
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('total_amount')?></td>
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('currency_amount')?></td>
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('currency_price')?></td>
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('receiver_id')?></td>
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('sender_id')?></td>
            <td style="font-weight: bold;border-bottom: 2px solid #ccc;"><?= $model->getAttributeLabel('code')?></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($model->report($from, $to)->getData() as $data):?>
            <tr height="40">
                <td style="border-bottom: 1px solid #ccc;"><?php
                    if ($data->payment_method == Transfer::PAYMENT_METHOD_DEBTOR) {
                        if ($data->payment_status == Transfer::PAYMENT_STATUS_UNPAID)
                            echo Transfer::$paymentMethodLabels[$data->payment_method] . ' - ' . Transfer::$paymentStatusLabels[$data->payment_status];
                        else
                            echo Transfer::$paymentMethodLabels[$data->payment_method] . ' - ' . Transfer::$paymentStatusLabels[$data->payment_status];
                    } else
                        echo Transfer::$paymentMethodLabels[$data->payment_method] . ' - ' . Transfer::$paymentStatusLabels[Transfer::PAYMENT_STATUS_PAID];
                    ?></td>
                <td style="border-bottom: 1px solid #ccc;"><?= (($data->total_amount?(strpos($data->total_amount, '.') !== false?number_format($data->total_amount, 2):number_format($data->total_amount)):"").
                        " ".Transfer::$foreignCurrencyLabels[$data->origin_currency])?></td>
                <td style="border-bottom: 1px solid #ccc;"><?= (($data->currency_amount?(strpos($data->currency_amount, '.') !== false?number_format($data->currency_amount, 2):number_format($data->currency_amount)):"").
                        " ".Transfer::$foreignCurrencyLabels[$data->foreign_currency])?></td>
                <td style="border-bottom: 1px solid #ccc;"><?= (($data->currency_price?(strpos($data->currency_price, '.') !== false?number_format($data->currency_price, 2):number_format($data->currency_price)):"").
                        " ".Transfer::$foreignCurrencyLabels[$data->origin_currency])?></td>
                <td style="border-bottom: 1px solid #ccc;"><?= $data->receiver->name?></td>
                <td style="border-bottom: 1px solid #ccc;"><?= $data->sender->name?></td>
                <td style="border-bottom: 1px solid #ccc;"><?= $data->code?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
</body>
</html>