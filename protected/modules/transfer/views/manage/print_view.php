<?php
/** @var $this TransferManageController */
/** @var $model Transfer */
/** @var $mode string */

?><!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <title>Print Receipt</title>
    <?php if(strtolower($mode) == 'a4'): ?>
        <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl.'/css/a4-print.css' ?>" media="print">
        <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl.'/css/a4-print.css' ?>" media="screen">
    <?php elseif($mode == 'pos'): ?>
        <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl.'/css/pos-print.css' ?>" media="print">
        <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl.'/css/pos-print.css' ?>" media="screen">
    <?php endif; ?>
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
<?php if(strtolower($mode) == 'a4'): ?>
    <table border=0 cellpadding=0 cellspacing=0 style='border-collapse:collapse;table-layout:fixed;border:2.0pt solid black;border-right: none'>
        <tbody>
        <tr height=50 style='mso-height-source:userset;height:37.5pt'>
            <td colspan=7 class=xl65 style='border-right:2.0pt solid black;width: 100%'><font
                    class="font5">naseem</font><font class="font0"> </font><font class="font5">exchange</font></td>
        </tr>
        <tr height=50 style='mso-height-source:userset;height:37.5pt;border-top-style: double'>
            <td colspan=7 class=xl92 style='border-right:2.0pt solid black'><b>order no:</b> <?= $model->code ?></td>
        </tr>
        <tr height=31 style='mso-height-source:userset;height:23.25pt;border-top-style: double'>
            <td colspan=7 class=xl92 style='border-right:2.0pt solid black;'><b>date:</b> <?= date('d/m/Y', $model->date) ?></td>
        </tr>
        <tr height=22 style='height:16.5pt;border-top-style: double'>
            <td colspan=6 class=xl71 style='border-right:2.0pt solid black;border-bottom-style: solid !important;'><b>NAME:</b> <?= $model->sender->name ?></td>
            <td rowspan=5 class=xl68 style='border-right:2.0pt solid black;border-top:none'>sender</td>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td colspan=6 class=xl74 style='border-right:2.0pt double black'><b>MOBILE:</b> <?= $model->sender->mobile ?></td>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td colspan=6 class=xl74 style='border-right:2.0pt double black'><b>AD:</b> <?= $model->sender->address ?></td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=6 rowspan=2 class=xl77 style='border-right:2.0pt solid black;
  border-bottom:2.0pt double black'><b>scan licence:</b></td>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td height=21 style='height:15.75pt'></td>
        </tr>
        <tr height=22 style='height:16.5pt;border-top-style:double;'>
            <td colspan=6 class=xl71 style='border-right:2.0pt double black;border-top:2.0pt double black;'><b>NAME:</b> <?= $model->receiver->name ?></td>
            <td rowspan=3 class=xl68 style='border-right:2.0pt solid black;'>receiver</td>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td colspan=6 class=xl74 style='border-right:2.0pt solid black'><b>ACCOUNT NUMBER:</b> <?= $model->receiverAccount?$model->receiverAccount->account_number:"--" ?></td>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td colspan=6 class=xl74 style='border-right:2.0pt solid black'><b>MOBILE:</b> <?= $model->receiver->mobile ?></td>
        </tr>
        <tr height=50 style='mso-height-source:userset;height:37.5pt;border-top:2.0pt double black;'>
            <td colspan=2 class=xl103 style='border-right:.0pt solid black'><?= Transfer::$foreignCurrencyShortEnLabels[$model->origin_currency] ?></td>
            <td colspan=2 class=xl103 style='border-right:.0pt solid black;border-left:
  none'>RATE</td>
            <td colspan=2 class=xl95 style='border-right:.0pt solid black;border-left:
  none'><?= Transfer::$foreignCurrencyShortEnLabels[$model->foreign_currency] ?></td>
            <td rowspan=4 class=xl68 style='border-bottom:2.0pt double black'>DETAILS</td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=2 rowspan=3 class=xl97 style='border-right:.0pt solid black;
  border-bottom:2.0pt double black'><?= number_format($model->total_amount) ?></td>
            <td colspan=2 rowspan=3 class=xl97 style='border-right:.0pt solid black;
  border-bottom:2.0pt double black'><?= $model->currency_price != floor($model->currency_price)?number_format($model->currency_price,strlen($model->currency_price) - strpos($model->currency_price,'.')-1):number_format($model->currency_price) ?></td>
            <td colspan=2 rowspan=3 class=xl97 style='border-right:.0pt solid black;
  border-bottom:2.0pt double black'><?= number_format($model->currency_amount) ?></td>
        </tr>
        <tr height=20 style='height:15.0pt'>
        </tr>
        <tr height=21 style='height:15.75pt'>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td colspan=7 rowspan=2 class=xl105 style='border-right:2.0pt solid black;
  border-bottom:1.5pt solid black'>signature</td>
        </tr>
        <tr height=43 style='mso-height-source:userset;height:32.25pt'>
            <td height=43 style='height:32.25pt'></td>
        </tr>
        <tr height=21 style='height:15.75pt'>
            <td colspan=7 class=xl83 style='border-right:1.0pt solid black'>Add: <?= SiteSetting::getOption('foreign_address') ?></td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=7 class=xl89 style='border-right:1.0pt solid black'>Add: <?= SiteSetting::getOption('foreign_address2') ?></td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=7 class=xl89 style='border-right:1.0pt solid black'>Phone number: <?= SiteSetting::getOption('tel_code').' '.SiteSetting::getOption('tel') ?></td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=7 class=xl89 style='border-right:1.0pt solid black'>LICENSE: IN0100584398-001</td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=7 class=xl89 style='border-right:1.0pt solid black'>Email: <?= SiteSetting::getOption('master_email') ?></td>
        </tr>
        <tr height=20 style='height:15.0pt'>
            <td colspan=7 class=xl89 style='border-right:1.0pt solid black'>Website: www.naseemexchange.com.au</td>
        </tr>
        <tr height=64 style='mso-height-source:userset;height:48.0pt'>
            <td colspan=7 class=xl86 style='border-right:1.0pt solid black'>morteza hemmati</td>
        </tr>
        </tbody>
    </table>
<?php elseif($mode == 'pos'): ?>
    <center id="top">
        <div class="logo"></div>
        <div class="info">
            <h2>Naseem Exchange</h2>
            <h3>money transfer invoice</h3>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->

<!--    <div id="mid">-->
<!--        <div class="info">-->
<!--            <h2>Contact Info</h2>-->
<!--            <p>-->
<!--                Address : street city, state 0000</br>-->
<!--                Email   : JohnDoe@gmail.com</br>-->
<!--                Phone   : 555-555-5555</br>-->
<!--            </p>-->
<!--        </div>-->
<!--    </div><!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle border2x border2x-side">
                    <td><b>Order No.</b> <?= $model->code ?></td>
                    <td><b>Order Date:</b> <?= date('d/m/Y', $model->date) ?></td>
                </tr>
                <tr class="tabletitle border2x-side">
                    <td><b>Customer Code:</b> <?= $model->sender->code ?></td>
                    <td><b>Branch No.</b> <?= "AU ".$model->branch->id ?></td>
                </tr>
            </table>
            <table>
                <tr class="tabletitle border2x">
                    <td colspan="2"><b>Order Details:</b></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Country:</b></td>
                    <td class="text-uppercase"><?= "$model->origin_country to $model->destination_country" ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Foreign Currency:</b></td>
                    <td><?= Transfer::$foreignCurrencyEnLabels[$model->foreign_currency] ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Currency Amount:</b></td>
                    <td><?= number_format($model->currency_amount).' '.$model->foreign_currency ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Total Amount:</b></td>
                    <td><?= number_format($model->total_amount).' '.$model->origin_currency ?></td>
                </tr>

                <!--Sender Details-->
                <tr class="tabletitle border2x">
                    <td colspan="2"><b>Sender Information:</b></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Country:</b></td>
                    <td class="text-uppercase"><?= $model->origin_country ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Full Name:</b></td>
                    <td><?= $model->sender->name ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Address:</b></td>
                    <td><?= $model->sender->address ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Mobile:</b></td>
                    <td><?= $model->sender->mobile ?></td>
                </tr>

                <!--Receiver Details-->
                <tr class="tabletitle border2x">
                    <td colspan="2"><b>Receiver Information:</b></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Country:</b></td>
                    <td class="text-uppercase"><?= $model->destination_country ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Full Name:</b></td>
                    <td><?= $model->receiver->name ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Address:</b></td>
                    <td><?= $model->receiver->address ?></td>
                </tr>
                <tr class="tabletitle details">
                    <td><b>Mobile:</b></td>
                    <td><?= $model->receiver->mobile ?></td>
                </tr>
            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            <p class="legal pre-line">Money orders will be send by the naseem exchange money transfer rules available at our website.
                <br>
                <strong>AUSTRAC:</strong> IND100584398001
                <?= $model->branch->address ?>
            </p>
        </div>

    </div><!--End InvoiceBot-->
<!--    <div class="page-break"></div>-->
<?php endif; ?>
</div><!--End Invoice-->
</body>
</html>