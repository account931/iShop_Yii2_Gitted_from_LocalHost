<?php
// Main Controller, SiteController responsible for sign ui, sign up ONLY
namespace app\controllers;

use Yii;
use app\models\Products; // model for All products in DB Products
use app\models\Products_Search;
use app\models\Buyers; //  Model for DB, which contains Customer name, cell, address, unique order ID, total sum. The order itself si in ORDERS DB SQL
use app\models\Orders;// This SQL model to save Order Unique ID, user and the whole order passesd from JS Object by ajax

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//use yii\db\ActiveQuery;

use app\models\Produc_Check_out_UserInfoForm; //My model (No SQL DB connection) for User Information input in view/products/checkout.php
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
	public $sql_status_buyers = "unknown"; // used in save_to_Buyers_DB() // NOT USED
	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

	
	
	
	public function accessRules() {
    return array(
        array(
            'allow',
            'actions' => array('getajaxorderdata', 'checkout'),
            'users'   => array('*'),
        ),
    );
}
	
	
	
	
	
	
	
    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Products_Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pr_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pr_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	
	
	
	
	
	
	// Display all available products items from SQL DB
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	
	public function actionShop()
    {
		 $query=Products::find()->orderBy ('pr_id DESC') /*->andFilterWhere(['like', 'sData_text', Yii::$app->getRequest()->getQueryParam('q')])*/  /*->where(['sData_text'=>Yii::$app->getRequest()->getQueryParam('q') ])*/ ->all();

        return $this->render('shop', [
               'query' => $query, //is in model
        ]);
    }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
	// Display a Page with you products, when clicked CHECK_OUT
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	
	public function actionCheckout()
    {
        //My model (No SQL DB connection) for User Information input in view/products/checkout.php
		$searchModel = new Produc_Check_out_UserInfoForm();
		
        return $this->render('checkout', [
               'searchModel' => $searchModel, //is in model
        ]);
    }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  



	
	
	// Gets Ajax data from User check out order(checkout.php) //gets ajax with Orders object, Unique order number, User address, mobile, 
	//and echo the Php Json data to be dispalyed back in checkout.php with JS

	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	
	public function actionGetajaxorderdata()
    {
		
		
		
		
		 //$this->sql_status_buyers = "HZ";
		// Saves values to Buyers DB, saves Customer name, cell, address, unique order ID, total sum. The order itself is in ORDERS DB SQL ---------------------------------------
	    function save_to_Buyers_DB() {
			 try {
			 
			     $customerModel = new Buyers();
			     $customerModel->b_name = Yii::$app->request->post('userName'); // $_POST from ajaxed checkout.php
			     $customerModel->b_mobile = Yii::$app->request->post('userCell');
			     $customerModel->b_address = Yii::$app->request->post('userAddress');
			     $customerModel->b_status = "0";
			     $customerModel->b_order_unique_id = Yii::$app->request->post('uniqueOrderNumber');
			     $customerModel->b_total_sum = Yii::$app->request->post('orderTotalSum');
			     
				 
			     if ($customerModel->save(false)) {
				    $_SESSION['status'] = "SQL Buyers OK";	 // use $_SESSION['status'] as declaring public var causes crash
			     }
			    
				 //throw new \Exception('Error!'); // this line caused catch part, even if all is OK
			     } catch (\Exception $ex) { 
			         $_SESSION['status'] = "SQL Buyers Catched initaited";			 
			      }
			
		 }	
         // END save_to_Buyers_DB() -------------
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 //-------------------------------------
         function save_to_Orders_DB() {
			 
			 try {
				 
				 //$array = explode(' ', Yii::$app->request->post('orderObject'));
				 $arrayDecoded = json_decode(Yii::$app->request->post('orderObject'), true);  // Convert ajax string to php Array, should use second parametr {true}, to use as $var['el'], not (4var->el)
				 //$one = reset ($arrayDecoded); //1st elementt of array
				 //$two = reset ($one); //1st elementt of array
                 
			     //$ordersModel = new Orders(); //must be inside foreach Loop, otherwise will record the last loop only
				 $timeStamp = date("Y-m-d H:i:s"); //Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
				 
			     foreach ($arrayDecoded as $k => $v) {
			 
			         $ordersModel = new Orders(); //must be inside foreach Loop,  otherwise will record the last loop only
			         $ordersModel->order_user_name = Yii::$app->request->post('userName'); // $_POST from ajaxed checkout.php
			         $ordersModel->order_unique_ID = Yii::$app->request->post('uniqueOrderNumber');  //unique Order ID, generated in checkout.php and sent by ajax
				     $ordersModel->order_date = $timeStamp; // date("Y-m-d H:i:s");  //current date
				     $ordersModel->order_product =  $k;// Name of current product //$one['price']; //!!!!!!!!!!
				     $ordersModel->order_pcs = $v['quantity']; // Quantiyu of current product //2;//Yii::$app->request->post('orderObject')[0]['quantity'];
				     $ordersModel->order_price = $v['price']; //2.2;//Yii::$app->request->post('orderObject')[0]['price'];
			  
			     
				 
			         if ($ordersModel->save(false)) {
				         $_SESSION['status_orders'] = "SQL Orders OK";	 // use $_SESSION['status'] as declaring public var causes crash
			         }
				 } // foreach
				 
				 //throw new \Exception('Error!'); // this line caused catch part, even if all is OK
			     } catch (\Exception $ex) { 
			         $_SESSION['status_orders'] = "SQL Orders Catched initaited";			 
			      }
		 }			 
	     // END save_to_Orders_DB() -------------
		 
		 
		 
		 
		 
		 

		 
		 
		 
		 
		
		
	    // check if received Ajax and POST request	from checkout.php
        $dataZ = Yii::$app->request->post();
            if (isset($dataZ)) {
			
                if (Yii::$app->request->isAjax) { 
				    $test = "Ajax Worked, recognized!";
				} else {
                    $test = "Ajax Worked, not recognized!";
				}
            } else {
                $test = "Ajax failed 100%";
            }

		   // Get variables with data from JS ajax request from checkout.php
		   $searchname =  Yii::$app->request->post('searchname'); //test name
		   //$controller = $_POST['controller']; // gets controller from js ajax
		   $controller =  Yii::$app->request->post('controller'); // gets controller from js ajax, Yii version
		   $userName =    Yii::$app->request->post('userName'); // gets user fields from form
		   $userCell =    Yii::$app->request->post('userCell'); // gets user fields from form
		   $userAddr =    Yii::$app->request->post('userAddress'); // gets user fields from form
		   $orderNumber = Yii::$app->request->post('uniqueOrderNumber'); // get unique Order number, generated in checkout.php in JS generateUUID()
		   $allOrders =   Yii::$app->request->post('orderObject'); // get all OrdersObject
		   
		   //caliing functions to save to Buyres and Orders
		   save_to_Buyers_DB();
		   save_to_Orders_DB();
		   
		   
		   
		  // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => $test, // return ajx status
             'code' => 100,
		     'name' => $searchname,         // test name 
			 'controller' => $controller,   // current controller
			 'userformData' => $userName,   // current name
			 'userCell' => $userCell,       // cell
			 'userAddr' => $userAddr,       // address
			 'orderNumber' => $orderNumber, // unique Order number, generated in checkout.php in JS generateUUID()
			 'allOrders' => $allOrders, // unique Order number, generated in checkout.php in JS generateUUID
			 'totalSum' => Yii::$app->request->post('orderTotalSum'), // unique Order number, generated in checkout.php in JS generateUUID
			 'sql_status_buyers' => $_SESSION['status'], // status for saving to Buyers DB, defined in save_to_Buyers_DB()
			 'sql_status_orders' => $_SESSION['status_orders'], // status for saving to Orders DB, defined in save_to_Orders_DB()
			    
          ]; 
		
		
		

	        /*
		    return $this->render('ajax', [
               //'searchModel' => $searchModel, //is in model
			   'ress' => $search , //is in model
			   'arrayDecoded' => $arrayDecoded , //is in model
        ]);
		*/
		
    }
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
	
	
	
	// Display all placed Orders with status 0, intended for Admin Only, uses InnerJoin
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	
	public function actionPlaced()
	{
		
		
		
		
		// finds all Buyers-----------------
		$buyersResults = Buyers::find() 
		                ->orderBy ('b_id DESC')
		                 ->where(['b_status' => '0' ]) //finds with 0 status
		                 ->all();
								
		$countBuyOrders_quantity = array(); // empty array that will contain quantity of every order, ie [2, 4, 6] = means 3 orders, 1st contain 2 products, 2nd - 4 products
	    
		foreach($buyersResults as $key ){
		    $results = Orders::find() 
		               ->orderBy ('order_id DESC')  
				       ->where(['order_unique_ID' => $key['b_order_unique_id'] ])  
				       ->all(); //finds all orders from ORDERS SQL where buyer.orderID matches Ordres.orderID
				
			$count = count ( $results ); // count them, ie amount of orders in Orders SQL for a given unique orderID
			array_push($countBuyOrders_quantity, $count); // add to array a quantity of products for every Order, ie [2, 4, 6]
		}
		// END finds all Buyers------------
		
		
		
		
		
		
		
		//Inner Join--------
        $query = new \yii\db\Query;  //must be {$query = new \yii\db\Query;} not{$query = new Query;}, adding {use yii\db\Query} won't help
        $query  ->select(['b_name', 'b_order_unique_id', 'order_user_name',  'order_unique_ID', 'order_product', 'order_pcs', 'order_price'])  //columns list
                ->from('orders')  //table1
                 ->join( 'INNER JOIN', 
                     'buyers', //table2
                     'buyers.b_order_unique_id=orders.order_unique_ID' //table2.column = table1.column
                  ); 
        $command = $query->createCommand();
        $query = $command->queryAll(); 
		// END Inner Join------------
		
		
		
		
		 
		return $this->render('placed', [
            'query' => $query, //Inner Join result (based on Buyres/Orders Sql)
			'buyersResults' => $buyersResults, // all buyers
			'countBuyOrders_quantity' => $countBuyOrders_quantity, // array that contains quantity of every order, ie [2, 4, 6] = means 3 orders, 1st contain 2 products, 2nd - 4 products
			
			
        ]);
		
	}
	
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
	
	
	
	
	
	
	
	// Display all placed Orders for a specific Logged User, link to this is visible in layout/main.php for Logged only
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	
	public function actionUserordershistory()
	{
		
		
		 
		return $this->render('userOrdersHistory', [/*
            'query' => $query, //Inner Join result (based on Buyres/Orders Sql)
			'buyersResults' => $buyersResults, // all buyers
			'countBuyOrders_quantity' => $countBuyOrders_quantity, // array that contains quantity of every order, ie [2, 4, 6] = means 3 orders, 1st contain 2 products, 2nd - 4 products
			*/
			
        ]);
		
	}
	
	
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************  
	
	
	
	




	
	
}
