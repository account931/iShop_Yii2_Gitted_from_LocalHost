<?php
//Was  not  working->changed  in Conroller (actionRegister $model=new User();  to  $model=new SignupForm();+added in Conroller  use use app\models\SignupForm; +changed in SignupForm(model) rules (targetClass' => '/*common....*/  app\models\User') )
namespace app\models;
use Yii;
use app\models\User;
use yii\base\Model;
//use models\User;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    
 //mine  for  captcha
     public $captcha;
     public $verifyCode;//confirm  delete?
 //end  CAPTCHA
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'], //  the  problem was in blankspace in [targetClass' => '      app\models\User]
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required','message'=>"Passwords should not  be  blank  and  empty"],
            ['password_confirm','required'],
            ['password', 'string', 'min' => 4],
//my compare passwords  & confirm
 ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", /*'on' => 'update' */   ],
//Start captcha 
 ['captcha','captcha'], // add this code to your rules.
	 /*['captcha', 'required'],
	 ['captcha', 'captcha'],*/
	 //['verifyCode', 'captcha'],
// END Captcha
        ];
    }
//end  rules
//Mine  for  captcha
public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
                        'captcha' => 'Message',
        ];
    }
//end  mine  for  captcha
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->language='English';//  my  add  for  language  default  value(regcrashes  without  it)
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}