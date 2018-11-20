<?php
//My model (No SQL DB connection) for User Information input in view/products/checkout.php
namespace app\models;
use Yii;
use yii\base\Model;

//Search form for searching
class Produc_Check_out_UserInfoForm extends Model   //ProductUserInfoForm
{
    public $username;
	public $mobile; // without declare it crashes
    public $address; // without declare it crashes
   
    private $_user = false;
	
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
		
		 // username and password are both required
            [['username', 'mobile','address'], 'required'], //required fields
            
            ['q', 'string', 'message'=>'Wrong name'],
			['mobile', 'number', 'message'=>' Integers Only'],
			['username', 'match', 'pattern' => '/^[a-z]\w*$/i' ],  //'/^[a-z]\w*$/i'
           
        ];
    }
	
    public function attributeLabels()
    {
        return [
            'q' => 'Name',
			'mobile' => 'Phone number',
            
        ];
    }
}
?>