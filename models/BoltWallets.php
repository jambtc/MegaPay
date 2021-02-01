<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bolt_wallets".
 *
 * @property int $id_wallet
 * @property int $id_user
 * @property string $wallet_address
 * @property string $blocknumber
 */
class BoltWallets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bolt_wallets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'wallet_address'], 'required'],
            [['id_user'], 'integer'],
            [['wallet_address', 'blocknumber'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_wallet' => Yii::t('app', 'Id Wallet'),
            'id_user' => Yii::t('app', 'Id User'),
            'wallet_address' => Yii::t('app', 'Wallet Address'),
            'blocknumber' => Yii::t('app', 'Blocknumber'),
        ];
    }
}
