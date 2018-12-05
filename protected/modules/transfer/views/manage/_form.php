<?php
/* @var $this TransferManageController */
/* @var $model Transfer */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('resetForm','document.getElementById("transfer-form").reset();');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transfer-form',
	'enableAjaxValidation'=>true,

)); ?>
    <style>
        .add-customer{
            border-radius: 50%;
            font-size: 15px;
            padding: 1px 7px;
            margin-right: 15px;
            margin-bottom: 5px;
        }
    </style>
    <div class="message"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'sender_id'); ?>
        <a href="#customer-modal" data-toggle="modal" class="btn btn-sm btn-info add-customer">+</a>
        <?php echo $form->dropDownList($model,'sender_id',CHtml::listData(Customers::model()->findAll(), 'id', 'name'),array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'sender_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'receiver_id'); ?>
        <a href="#customer-modal" data-toggle="modal" class="btn btn-sm btn-info add-customer">+</a>
        <?php echo $form->dropDownList($model,'receiver_id',CHtml::listData(Customers::model()->findAll(), 'id', 'name'),array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'receiver_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'origin_country'); ?>
        <?php echo $form->dropDownList($model,'origin_country',Transfer::$countryLabels,array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'origin_country'); ?>
    </div>

    <div class="form-group">
        <?php if($model->isNewRecord) $model->destination_country = 'AUSTRALIA';?>
        <?php echo $form->labelEx($model,'destination_country'); ?>
        <?php echo $form->dropDownList($model,'destination_country',Transfer::$countryLabels,array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'destination_country'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'foreign_currency'); ?>
        <?php echo $form->dropDownList($model,'foreign_currency',Transfer::$foreignCurrencyLabels,array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'foreign_currency'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'currency_price'); ?>
        <?php echo $form->textField($model,'currency_price',array('maxlength'=>20,'class'=>'form-control','placeholder'=>'نرخ پیش فرض (دلار: '.number_format(SiteSetting::getOption('dollar_price')).' ريال - درهم: '.number_format(SiteSetting::getOption('dirham_price')).' ريال - دلار: '.number_format(SiteSetting::getOption('dollar_price_dirham')).' درهم)')); ?>
        <?php echo $form->error($model,'currency_price'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'currency_amount'); ?>
        <?php echo $form->numberField($model,'currency_amount',array('maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'currency_amount'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'total_amount'); ?>
        <?php echo $form->numberField($model,'total_amount',array('maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'total_amount'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'payment_method'); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo $form->radioButtonList($model,'payment_method', Transfer::$paymentMethodLabels); ?>
            </div>
        </div>
        <?php echo $form->error($model,'payment_method'); ?>
    </div>

    <div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

<div id="customer-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">افزودن مشتری</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('customers.views.manage._form', array('model'=>new Customers(), 'onlyMainFields' => true)); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('blur, keyup', '#Transfer_currency_amount', function () {
            calculateCurrencyPrice();
        }).on('change', '#Transfer_destination_country, #Transfer_origin_country', function () {
            calculateCurrencyPrice();
        }).on('change', '#Transfer_foreign_currency', function () {
            checkCurrency();
        }).on('click', '.save-customer', function (e) {
            e.preventDefault();
            var form = $('#customers-form');
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('/customers/manage/create');?>',
                type: 'post',
                dataType: 'json',
                data: form.serialize(),
                success: function (data) {
                    alert(data.message);
                    if (data.status) {
                        $('#Transfer_sender_id').append('<option value="' + data.id + '">' + data.name + '</option>');
                        $('#Transfer_receiver_id').append('<option value="' + data.id + '">' + data.name + '</option>');
                        form.find('input[type="text"]').each(function () {
                            $(this).val('');
                        });
                    }
                }
            });
        });
    });

    function calculateCurrencyPrice() {
        if (!checkCurrency())
            return false;

        var originCountry = $('#Transfer_origin_country').val(),
            destinationCountry = $('#Transfer_destination_country').val(),
            foreignCurrency = $('#Transfer_foreign_currency').val(),
            amount = parseInt($('#Transfer_currency_amount').val()),
            totalAmount = 0,
            operator = '*',
            currency = 'dollar';

        if (originCountry != destinationCountry) {
            if (foreignCurrency == 'IRR')
                operator = '/';
            else if (foreignCurrency == 'AED' && (originCountry == 'AUSTRALIA' || destinationCountry == 'AUSTRALIA'))
                operator = '/';
            else
                operator = '*';

            if (originCountry == 'AUSTRALIA' || destinationCountry == 'AUSTRALIA') {
                currency = 'dollar';
                if (originCountry == 'EMIRATES' || destinationCountry == 'EMIRATES')
                    currency = 'dollarDirham';
            } else
                currency = 'dirham';

            totalAmount = calculator(amount, currency, operator);
        } else
            totalAmount = 0;

        $('#Transfer_total_amount').val(totalAmount)
    }

    function calculator(amount, currency, operator) {
        var dollarPrice = <?= SiteSetting::getOption('dollar_price')?>,
            dirhamPrice = <?= SiteSetting::getOption('dirham_price')?>,
            dollarPriceDirham = <?= SiteSetting::getOption('dollar_price_dirham')?>,
            currencyPrice = $('#Transfer_currency_price').val();

        if (currencyPrice != '')
            dollarPrice = dirhamPrice = dollarPriceDirham = currencyPrice;

        var result = 0;
        switch (currency) {
            case 'dollar':
                result = amount * dollarPrice;
                if (operator == '/')
                    result = amount / dollarPrice;
                break;

            case 'dirham':
                result = amount * dirhamPrice;
                if (operator == '/')
                    result = amount / dirhamPrice;
                break;

            case 'dollarDirham':
                result = amount * dollarPriceDirham;
                if (operator == '/')
                    result = amount / dollarPriceDirham;
                break;
        }

        return result;
    }

    function checkCurrency() {
        var currency = $('#Transfer_foreign_currency').val(),
            originCountry = $('#Transfer_origin_country').val(),
            destinationCountry = $('#Transfer_destination_country').val();

        if (originCountry == destinationCountry) {
            alert('مبدا و مقصد نمی تواند یکسان باشد.');
            return false;
        }

        switch (currency) {
            case 'IRR':
                if (originCountry != 'IRAN' && destinationCountry != 'IRAN') {
                    alert('ارز انتخاب شده اشتباه است.');
                    return false;
                }
                break;

            case 'AUD':
                if (originCountry != 'AUSTRALIA' && destinationCountry != 'AUSTRALIA') {
                    alert('ارز انتخاب شده اشتباه است.');
                    return false;
                }
                break;

            case 'AED':
                if (originCountry != 'EMIRATES' && destinationCountry != 'EMIRATES') {
                    alert('ارز انتخاب شده اشتباه است.');
                    return false;
                }
                break;
        }
        return true;
    }
</script>