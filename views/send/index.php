<?php

use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

use drsdre\wizardwidget;
use app\components\WebApp;
use app\assets\QRCodeReaderAsset;

QRCodeReaderAsset::register($this);

$this->title = Yii::$app->id;
$form = ActiveForm::begin([
    'id' => 'send-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n{error}\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-12 control-label'],
    ],

]);

include('send_js.php');
include('qrcodescanner_js.php');
// include ('nfc-reader_js.php');

$sendForm->from = $fromAddress;
?>


<div class="dash-balance">
    <div class="dash-content relative">
        <h3 class="w-text"><?= Yii::t('app', 'Send token') ?></h3>

    </div>
</div>


<section class="bal-section container">
    <div id="content">
        <div class="ref-card c4 pb-0 mb-0 pr-0">
            <div class="content-head">
                <div class="d-flex justify-content-between">
                    <div>
                        <?= Yii::t('app', 'Balance on: ') ?></br>
                        <a href="<?= Url::to(['settings/nodes/update']) ?>">
                            <?= $node->blockchain->denomination ?>
                        </a>
                    </div>
                    <div class="ref-card c11" style="min-width:150px;">
                        <div class="d-flex flex-column">
                            <div class="">
                                <div class="d-flex flex-row">
                                    <span class="mr-2">
                                        <small class="ml-2"><i class="fa fa-star star-total-balance fa-sm"></i></small>
                                    </span>
                                    <span class="h5 text-dark" id="total-balance">
                                        <?php
                                        //WebApp::si_formatter($balance) 
                                        echo Yii::$app->formatter->asDecimal(
                                            ($balance / (10 ** $node->smartContract->decimals)),
                                            [
                                                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                                                NumberFormatter::MAX_FRACTION_DIGITS => $node->smartContract->decimals,
                                            ]
                                        );
                                        ?>
                                    </span>
                                    <small class="ml-1"><?= $node->smartContract->symbol ?></small>
                                </div>
                            </div>
                            <div class="">
                                <div class="d-flex flex-row">
                                    <span class="mr-2">
                                        <small class="ml-2"><i class="fab fa-ethereum fa-sm"></i></small>
                                    </span>
                                    <span class="h5 text-dark" id="total-balance_gas">
                                        <?php
                                        //WebApp::si_formatter($balance_gas) 
                                        echo Yii::$app->formatter->asDecimal(
                                            $balance_gas,
                                            8
                                        );
                                        ?>
                                    </span>
                                    <!-- <span id="total-balance_gas2"><?= $balance_gas ?></span> -->
                                    <small class="ml-1"><?= $node->blockchain->symbol ?></small>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<section class="wallets-list container">
    <div class="wallet-address">


        <!-- <div class="txt-left"> -->
        <?php
        // $fieldOptions1 = [
        //     'inputTemplate' => '
        //         <div class="form-row-group with-icons">
        // 			<div class="form-row no-padding">
        // 				<i class="fas fa-wallet text-primary"></i>
        //                 {input}
        //             </div>
        // 		</div>',
        //     'inputOptions' => ['class' => ['widget' => 'form-element']]
        //
        // ];
        ?>
        <!-- DA -->
        <!-- <div class="group"> -->
        <?= $form->field($sendForm, 'from')->hiddenInput(['readonly' => true])->label(false) ?>
        <!-- </div> -->
        <!-- </div> -->

        <!-- <div class="form-mini-divider"></div> -->

        <div class="txt-left">
            <?php
            $fieldOptions2 = [
                'inputTemplate' => '
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding" >
						<i id="activate-camera-btn" class="fa fa-camera text-primary"></i>
                        {input}
                    </div>
                </div>',
                'inputOptions' => ['class' => ['widget' => 'form-element']]
            ];
            // $fieldOptions2 = [
            //     'inputTemplate' => '
            //     <div class="form-row-group with-icons">
            //         <div class="form-row no-padding" >
            // 			<i id="activate-camera-btn" class="fa fa-camera text-primary"></i>
            // 			// <span id="activate-nfc-reader" class="ml-5">
            // 			// <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            //             //     <path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V4h16v16zM18 6h-5c-1.1 0-2 .9-2 2v2.28c-.6.35-1 .98-1 1.72 0 1.1.9 2 2 2s2-.9 2-2c0-.74-.4-1.38-1-1.72V8h3v8H8V8h2V6H6v12h12V6z"/>
            //             // </svg>
            // 			// </span>
            //             {input}
            //         </div>
            //     </div>',
            //     'inputOptions' => ['class' => ['widget' => 'form-element']]
            // ];
            ?>
            <div class="group">
                <?= $form->field($sendForm, 'to', $fieldOptions2)
                    ->textInput(['autofocus' => true, 'validate'])
                    ->hint(Yii::t('app', 'Insert address or press camera to scan')) ?>
            </div>
        </div>

        <div class="form-mini-divider"></div>

        <div class="txt-left calc-crr">
            <!-- IMPORTO -->
            <?php
            $fieldOptions3 = [
                'inputTemplate' => '
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding" >
						<i class="fas fa-star text-primary"></i>

                    {input}
                    </div>
                </div>',
                'inputOptions' => ['class' => ['widget' => 'form-element']]
            ];
            ?>

            <div class="group">
                <?= $form->field($sendForm, 'amount', $fieldOptions3)->textInput(['type' => 'number']) ?>
                <?= $form->field($sendForm, 'balance')->hiddenInput(['value' => $balance])->label(false) ?>
                <?= $form->field($sendForm, 'balance_gas')->hiddenInput(['value' => $balance_gas])->label(false) ?>
            </div>
        </div>
        <div class="form-mini-divider"></div>
        <div class="txt-left">
            <!-- MESSAGGIO -->
            <?php
            $fieldOptions4 = [
                'inputTemplate' => '
				<!--<label class="col-lg-12 control-label text-left" for="sendform-memo">' . $sendForm->getAttributeLabel('memo') . '</label>-->
				<div class="form-row-group with-icons">
					<div class="form-row no-padding" >
						<i class="fas fa-comment text-primary"></i>
						{input}
					</div>
				</div>',
                'inputOptions' => ['class' => ['widget' => 'form-element']]
            ];
            ?>
            <div class="group">
                <?= $form->field($sendForm, 'memo', $fieldOptions4)->textarea([
                    'rows' => 6, 'cols' => 50
                ])->label() ?>
            </div>
        </div>
        <div class="form-mini-divider"></div>
        <div class="txt-left">
            <?= $form->errorSummary($sendForm, ['id' => 'error-summary', 'class' => 'col-lg-12']) ?>
        </div>

        <div class="form-mini-divider"></div>


        <div><a href="#" class="button circle block yellow" data-popup="sellOrder" id="getCheckedButton1"><?= Yii::t('app', 'Send token') ?></a></div>



        <!--POPUP HTML CONTENT START -->
        <div class="popup-overlay" id="sellOrder" style="padding: 5px;"> <!-- if you dont want overlay add class .no-overlay -->
            <div class="popup-container add bg-transparent">
                <div class="popup-content wallet-address h-100">

                    <img src="css/img/content/crypto-buy.png" class="img-buy mt-20" alt="">

                    <div class="no-hide-content">
                        <div class="send-v2__form-row " style="background-color: aliceblue;">
                            <div class="send-v2__form-label"><?= Yii::t('app', 'Asset:') ?></div>
                            <div class="send-v2__form-field">
                                <div class="send-v2__asset-dropdown">
                                    <div class="send-v2__asset-dropdown__input-wrapper">

                                        <div class="send-v2__asset-dropdown__asset">
                                            <div class="send-v2__asset-dropdown__asset-data">
                                                <div class="send-v2__asset-dropdown__symbol text-center">
                                                    <span class="ml-auto currency-display-component__text h5 js-initial-amount"><?= WebApp::si_formatter($balance) ?></span>
                                                    <span class="ml-auto currency-display-component__text h5 js-final-amount" style="display:none;"></span>
                                                    <small class="currency-display-component__suffix"><?= $node->smartContract->symbol ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="send-v2__form-row " style="background-color: aliceblue;">
                            <div class="send-v2__form-label"><?= Yii::t('app', 'Amount to send:') ?></div>
                            <div class="send-v2__form-field">
                                <div class="send-v2__asset-dropdown">
                                    <div class="send-v2__asset-dropdown__input-wrapper">
                                        <div class="send-v2__asset-dropdown__asset">
                                            <div class="send-v2__asset-dropdown__asset-data">
                                                <div class="send-v2__asset-dropdown__name">
                                                    <div class="m-auto currency-display-component" title="">
                                                        <span class="h4 currency-display-component__text amount-to-send"></span>
                                                        <span class="h5 currency-display-component__suffix"><?= $node->smartContract->symbol ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="send-v2__form-row " style="background-color: aliceblue;">
                            <div class="send-v2__form-label"><?= Yii::t('app', 'Transaction fee:') ?></div>
                            <div class="send-v2__form-field">
                                <div class="send-v2__asset-dropdown">
                                    <div class="send-v2__asset-dropdown__input-wrapper">
                                        <div class="send-v2__asset-dropdown__asset">
                                            <div class="send-v2__asset-dropdown__asset-data">
                                                <div class="send-v2__asset-dropdown__name">
                                                    <div class="m-auto currency-display-component h6" title="">
                                                        <span class="currency-display-component__text mr-2" id="amount-to-send-gas"></span> Gwei
                                                        <span class="currency-display-component__suffix"><?= $node->blockchain->symbol ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ref-card c10 transaction-details list-unstyled mt-5" style="display: none;">
                    </div>
                    <div>
                        <a href="#" class="pay-submit hide-content">
                            <button class="js-confirm-submit more-btn mb-10 disabled">
                                <?= Yii::t('app', 'Confirm') ?>
                            </button>
                        </a>
                    </div>
                    <div style="display: none;" class="mt-3 pay-close float-right"><a href="<?= Url::to(['/wallet/index']) ?> " />
                        <button type="button" class="btn button circle block green"><?= Yii::t('app', 'Close') ?></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--POPUP HTML CONTENT END -->
        <!-- POPUP HTML CAMERA QRCODE READER -->
        <div class="popup-overlay" id="cameraPopup">
            <div class="popup-container add">
                <div class="popup-content txt-center">
                    <div class="modal-header">
                        <h3 class="text-secondary"><?php echo Yii::t('app', 'Camera scan'); ?></h3>
                        <button id='camera-close' type="button" class="close float-right" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='camera-body'>
                        <center>
                            <div id="video-content" class="embed-responsive embed-responsive-3by4 text-center">
                                <!-- <h2>This is some content</h2> -->
                                <p>
                                    <video muted playsinline id="qr-video"></video>
                                </p>
                            </div>
                        </center>
                    </div>

                </div>
            </div>
        </div>
        <!--POPUP CAMERA QRCODE END -->
        <!-- POPUP NFC READER -->
        <div class="popup-overlay" id="nfcReaderPopup">
            <div class="popup-container add">
                <div class="popup-content txt-center">
                    <div class="modal-header">
                        <h3 class="text-secondary"><?php echo Yii::t('app', 'NFC scan'); ?></h3>
                        <button id='nfc-close' type="button" class="close float-right" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body" id='nfc-body'>
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V4h16v16zM18 6h-5c-1.1 0-2 .9-2 2v2.28c-.6.35-1 .98-1 1.72 0 1.1.9 2 2 2s2-.9 2-2c0-.74-.4-1.38-1-1.72V8h3v8H8V8h2V6H6v12h12V6z" />
                            </svg>
                        </center>
                    </div>

                </div>
            </div>
        </div>
        <!--POPUP NFC CONTENT END -->
    </div>






</section>

<?php ActiveForm::end(); ?>