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
        <?php echo $form->dropDownList($model,'sender_id',CHtml::listData(Customers::model()->findAll(), 'id', 'name'),array(
            'class'=>'form-control select-picker',
            'data-live-search' => true,
        )); ?>
        <?php echo $form->error($model,'sender_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'receiver_id'); ?>
        <a href="#customer-modal" data-toggle="modal" class="btn btn-sm btn-info add-customer">+</a>
        <?php echo $form->dropDownList($model,'receiver_id',CHtml::listData(Customers::model()->findAll(), 'id', 'name'),array(
            'class'=>'form-control select-picker receiver-change-trigger',
            'data-live-search' => true,
            'data-fetch-url' => $this->createUrl('/customers/manage/fetchAccounts'),
            'data-target' => "#Transfer_receiver_account_id",
            'data-id' => $model->receiver_id,
        )); ?>
        <?php echo $form->error($model,'receiver_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'receiver_account_id'); ?>
        <a href="#account-customer-modal" data-toggle="modal" class="btn btn-sm btn-info add-customer">+</a>
        <?php echo $form->dropDownList($model,'receiver_account_id', $model->isNewRecord?[]:CHtml::listData(CustomerAccounts::getList($model->receiver_id), 'id', 'html'),array(
            'class'=>'form-control',
//            'disabled' => true,
            'prompt' => 'شماره حساب موردنظر را انتخاب کنید...'
        )); ?>
        <?php echo $form->error($model,'receiver_account_id'); ?>
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
        <div class="input-group" style="width: 50%">
            <?php echo $form->textField($model,'currency_price',array('maxlength'=>20,'class'=>'form-control digitFormat','placeholder'=>'نرخ پیش فرض (دلار: '.number_format(SiteSetting::getOption('dollar_price')).' ريال - درهم: '.number_format(SiteSetting::getOption('dirham_price')).' ريال - دلار: '.number_format(SiteSetting::getOption('dollar_price_dirham')).' درهم)')); ?>
            <span class="input-group-addon">$</span>
        </div>
        <?php echo $form->error($model,'currency_price'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'currency_amount'); ?> <small>(فروش)</small>
        <div class="input-group" style="width: 300px">
            <?php echo $form->textField($model,'currency_amount',array('maxlength'=>255,'class'=>'form-control digitFormat')); ?>
            <span class="input-group-addon" id="sell-label">-</span>
        </div>
        <?php echo $form->error($model,'currency_amount'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'total_amount'); ?> <small>(خرید)</small>
        <div class="input-group" style="width: 300px">
            <?php echo $form->textField($model,'total_amount',array('maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon" id="buy-label">-</span>
        </div>
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
                <?php $this->renderPartial('customers.views.manage._form', array('model'=>new Customers(), 'accModel'=>new CustomerAccounts('quick'), 'onlyMainFields' => true)); ?>
            </div>
        </div>
    </div>
</div>

<div id="account-customer-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">افزودن شماره حساب مشتری</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('customers.views.manage._account_form', array('model'=>new CustomerAccounts())); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('blur, keyup', '#Transfer_currency_amount, #Transfer_currency_price', function () {
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
                        $('.select-picker').selectpicker('refresh');
                        $('#customer-modal').modal("hide");
                    }
                }
            });
        }).on('click', '.save-customer-account', function (e) {
            e.preventDefault();
            var form = $('#account-customer-form');
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('/customers/manage/addAccount');?>',
                cache: false,
                type: 'post',
                dataType: 'json',
                data: form.serialize(),
                success: function (data) {
                    alert(data.message);
                    if (data.status) {
                        fetch($("select.receiver-change-trigger"));
                        $("#account-customer-modal").modal("hide");
                        form.find('input[type="text"]').each(function () {
                            $(this).val('');
                        });
                    }
                }
            });
        });
    });


    $("body").on("change", "select.receiver-change-trigger", function(){
        var el = $(this);
        fetch(el);
    });

    // fetch($("select.receiver-change-trigger"), $("#Transfer_receiver_account_id").data("id"));

    function fetch(el, id = false){
        var url = el.data("fetch-url"),
            target = el.data("target"),
            val = el.val();

        $(target).attr("disabled", "true");
        $("#account-customer-modal form #CustomerAccounts_customer_id").val(val);

        if(val !== ""){
            url = url + "/" + val;
            $.ajax({
                url: url,
                cache: false,
                type: "GET",
                dataType: "html",
                success: function(html){
                    $(target).html(html);
                    if(id)
                        $(target).find("[value=\""+id+"\"]").attr("selected", true);
                }
            });

            $(target).attr("disabled", false);
        }else{
            $(target).attr("disabled", true);
        }
    }

    function calculateCurrencyPrice() {
        if (!checkCurrency())
            return false;

        var originCountry = $('#Transfer_origin_country').val(),
            destinationCountry = $('#Transfer_destination_country').val(),
            foreignCurrency = $('#Transfer_foreign_currency').val(),
            amount = parseInt($('#Transfer_currency_amount').val().replace(',','')),
            totalAmount = 0,
            operator = '*',
            currency = 'dollar';
        setLabels(foreignCurrency, originCountry, destinationCountry);
        if (originCountry !== destinationCountry) {
            if (foreignCurrency === 'IRR')
                operator = '/';
            else if (foreignCurrency === 'AED' && (originCountry === 'AUSTRALIA' || destinationCountry === 'AUSTRALIA'))
                operator = '/';
            else
                operator = '*';

            if (originCountry === 'AUSTRALIA' || destinationCountry === 'AUSTRALIA') {
                currency = 'dollar';
                if (originCountry === 'EMIRATES' || destinationCountry === 'EMIRATES')
                    currency = 'dollarDirham';
            } else
                currency = 'dirham';

            totalAmount = calculator(amount, currency, operator);
        } else
            totalAmount = 0;

        $('#Transfer_total_amount').val(totalAmount)
            // .digitFormat();
    }

    function calculator(amount, currency, operator) {
        var dollarPrice = <?= SiteSetting::getOption('dollar_price')?>,
            dirhamPrice = <?= SiteSetting::getOption('dirham_price')?>,
            dollarPriceDirham = <?= SiteSetting::getOption('dollar_price_dirham')?>,
            currencyPrice = $('#Transfer_currency_price').val().replace(',','');

        if (currencyPrice !== '')
            dollarPrice = dirhamPrice = dollarPriceDirham = currencyPrice;

        var result = 0;
        switch (currency) {
            case 'dollar':
                result = amount * dollarPrice;
                if (operator === '/')
                    result = amount / dollarPrice;
                break;

            case 'dirham':
                result = amount * dirhamPrice;
                if (operator === '/')
                    result = amount / dirhamPrice;
                break;

            case 'dollarDirham':
                result = amount * dollarPriceDirham;
                if (operator === '/')
                    result = amount / dollarPriceDirham;
                break;
        }

        return result;
    }

    function checkCurrency() {
        var currency = $('#Transfer_foreign_currency').val(),
            originCountry = $('#Transfer_origin_country').val(),
            destinationCountry = $('#Transfer_destination_country').val();
        setLabels(currency, originCountry, destinationCountry);
        if (originCountry === destinationCountry) {
            alert('مبدا و مقصد نمی تواند یکسان باشد.');
            return false;
        }

        switch (currency) {
            case 'IRR':
                if (originCountry !== 'IRAN' && destinationCountry !== 'IRAN') {
                    alert('ارز انتخاب شده اشتباه است.');
                    return false;
                }
                break;

            case 'AUD':
                if (originCountry !== 'AUSTRALIA' && destinationCountry !== 'AUSTRALIA') {
                    alert('ارز انتخاب شده اشتباه است.');
                    return false;
                }
                break;

            case 'AED':
                if (originCountry !== 'EMIRATES' && destinationCountry !== 'EMIRATES') {
                    alert('ارز انتخاب شده اشتباه است.');
                    return false;
                }
                break;
        }
        return true;
    }
    setLabels($('#Transfer_foreign_currency').val(), $('#Transfer_origin_country').val(), $('#Transfer_destination_country').val());
    function setLabels(currency, originCountry, destinationCountry) {
        let sell = '-', buy = '-';
        switch (currency) {
            case 'IRR':
                sell = 'ریال ایران';
                if (originCountry === 'AUSTRALIA' || destinationCountry === 'AUSTRALIA')
                    buy = 'دلار استرالیا';
                else if (originCountry === 'EMIRATES' || destinationCountry === 'EMIRATES')
                    buy = 'درهم امارات';
                break;
            case 'AUD':
                sell = 'دلار استرالیا';

                if (originCountry === 'IRAN' || destinationCountry === 'IRAN')
                    buy = 'ریال ایران';
                else if (originCountry === 'EMIRATES' || destinationCountry === 'EMIRATES')
                    buy = 'درهم امارات';
                break;

            case 'AED':
                sell = 'درهم امارات';
                if (originCountry === 'IRAN' || destinationCountry === 'IRAN')
                    buy = 'ریال ایران';
                else if (originCountry === 'AUSTRALIA' || destinationCountry === 'AUSTRALIA')
                    buy = 'دلار استرالیا';
                break;
        }

        $("#sell-label").text(sell);
        $("#buy-label").text(buy);
    }
</script>