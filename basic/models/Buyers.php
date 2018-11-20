<?php
// Model for DB, which contains Customer name, cell, address, unique order ID, total sum. The order itself is in ORDERS DB SQL
namespace app\models;

use Yii;

/**
 * This is the model class for table "buyers".
 *
 * @property int $b_id
 * @property string $b_name
 * @property string $b_mobile
 * @property string $b_address
 * @property string $b_order_unique_id
 * @property string $b_status
 * @property integer $b_total_sum
 @property integer $b_time
 */
class Buyers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buyers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_name', 'b_mobile', 'b_address', 'b_order_unique_id', 'b_total_sum'], 'required'],
            [['b_status'], 'string'],
            [['b_total_sum'], 'number'], // make sure that total sum is NUMBER not INT, to save in SQL as float(154.8), be sure to set SQL field to FLOAT
            [['b_name', 'b_mobile', 'b_order_unique_id'], 'string', 'max' => 77],
            [['b_address'], 'string', 'max' => 88],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b_id' => 'B ID',
            'b_name' => 'B Name',
            'b_mobile' => 'B Mobile',
            'b_address' => 'B Address',
            'b_order_unique_id' => 'B Order Unique ID',
            'b_status' => 'B Status',
            'b_total_sum' => 'B Total Sum',
        ];
    }
}
