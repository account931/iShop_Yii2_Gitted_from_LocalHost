<?php

namespace app\models;
// This SQL model to save Order Unique ID, user and the whole order passesd from JS Object by ajax
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $order_id
 * @property string $order_unique_ID
 * @property string $order_user_name
 * @property string $order_date
 * @property string $order_product
 * @property int $order_pcs
 * @property double $order_price
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_unique_ID', 'order_user_name', 'order_product', 'order_pcs', 'order_price'], 'required'],
            [['order_date'], 'safe'],
            [['order_pcs'], 'integer'],
            [['order_price'], 'number'],
            [['order_unique_ID', 'order_user_name', 'order_product'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'order_unique_ID' => 'Order Unique  ID',
            'order_user_name' => 'Order User Name',
            'order_date' => 'Order Date',
            'order_product' => 'Order Product',
            'order_pcs' => 'Order Pcs',
            'order_price' => 'Order Price',
        ];
    }
}
