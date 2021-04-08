<?php
use yii\helpers\Url;
?>
<div class="jumbotron jumbotron-fluid">
    <p class="lead">
        <?= Yii::t('app','So, 12 words will be chosen that uniquely identify your wallet. The merit is of cryptography, in particular of the hierarchical deterministic concept, which, thanks to the use of some mathematical functions, allows users, starting from the seed, to recover everything.');  ?>
    </p>
    <p class="lead">
        <?php echo Yii::t('app','These random words will be unique in the world and will allow you to recover the contents of your wallet even in case of loss of your device.'); ?>
    </p>
    
    <div class="form-divider"></div>
    <div class="container">
      <div class="float-left">
        <button type="button" id="stepwizard_step2_prev" class="btn btn-warning btn-md prev-step">
          <i class="fa fa-backward"></i> <?php echo Yii::t('app','Previous');?></button>
      </div>
      <div class="float-right">
        <button type="button" id="stepwizard_step2_next" class="btn btn-primary btn-md next-step">
          <i class="fa fa-forward"></i><?php echo Yii::t('app','Next');?>
        </button>
      </div>
    </div>
</div>
