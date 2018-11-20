Shop Yii2

1.We use our custom layout design, we changed it in view/layout/main.php. Original Yii layout is stored in main_Original.php. To get the original view - rename main_Original.php to main.php.

2.All available products are in Products Sql DB, we display this DB content in view/shop.php, forming the id of each item by construction {product name + price}. We need such id, to manipulate the data in JS module window, when u click on a product(split the id and get each array element). Module window (single product pop-up) is One for all products, we just html() it with relevant data from the id clicked.

3.All selected products are added to JS Object; when u visit CART, object elements are dynamically displayed, Total sum is calculated.

4.When in Cart u click CheckOut (Place an Order), JS Object parsed to string and send by JS Ajax to Yii Controller, parses by php and added to Orders Sql.
Client side JS Object is cleared and set to empty.


//-----------------

Ajax shop part, how works
It all runs in ProductsController,it is the core controller, SiteController for sign in/sign up Only, OrdersController/ByuersController is for quick CRUD only
1.actionCheckout.php checks fields filled by user (with Models/Produc_Check_out_UserInfoForm.php) and sends ajax request to actionGetajaxorderdata(). 
#As <form> is created with Yii2, to ensure that Submit Button won"t reload the page, we add {return false;} in construction {$("#myForm").on("beforeSubmit", function (event, messages) }, (it allows to run Model Validation).
#Long term error in ajax happened as it used incorrect URL, which returned 404 "Not found " or 403 "No access". (Had to define URL to var, outside the Ajax part).
#Js Object with all products should be processd with { JSON.stringify(productsObject) } to convert js object to string.
#Unique_Order_Id is generated in views/checkout.php with function  generateUUID(),  it will be INSERTED both to 2 DB (Orders,Buyers) to make Inner Join.

2.actionGetajaxorderdata() receives ajax request, get passed vars with $_Post request.

#Received vars, we echo in JSON format with {\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; }, (this Json will be used to form the answer back in ajax, in views/checkout.php and for console.log (res)(just for test)).
#Save received vars to 2  SQL DB(Orders(orders+orderID),Buyers (orderID+userInfo)).
#To save Js Object with all products(converted to string), we use ???, and save by {$arrayDecoded = json_decode(Yii::$app->request->post('orderObject'), true);}
#DB Buyer contains field {status} which  is {0} by default. It means that the order is recorded but not processed yet.

3.Ajax gets the aswer from actionGetajaxorderdata(), makes { log.console (res)}, form the aswer and html() it to view.
#To use Loader Spinner while the Ajax is running, we put an <img style="display:none; position:absolute"> + JQ show/hide Loader {$(document).ajaxSend(function(event, request, settings)} = {$(document).ajaxComplete(function(event, request, settings)}


//----------------------------------------

Placed -  the section for orders, which were placed, but not processed by admin (i.e have status=0). Based on Inner Join.
How it works.
1.ControllerProduct: Select all buyers from SQL Buyers with status=0. In table Buyers we have fields with name, contacts and uniqueID only and no ordered products. It returnes an array, which length will be used for 1st for () loop and lenght to Selected and count the quantity of every order [3, 2]
2.Controller: In for () loop based onSelect Buyers lenght, finds all orders for a specified ID, count them and add value to a new array.
3.Controller: Select Inner Join from Buyers and Orders join on unique Id.
4.View/Products/Placed.php: we use double for()  loop, 1st for() iterates over Buyer lenght(all buyers from SQL Buyers where status=0) and display a buyer info. Second inner for() loop itetates over quantity of odrers [3, 2, 5] lengh and display relevant Inner Join SQL results, by changing iterator start/end values according formula.



==========================================================================================

------ My Yii2 Advance set up -------
1. Call Command Line and go to needed folder:  cmd -> cd[пробел]folder. U can hint folders by TAB.(i.e  C:\Users\Dima\Downloads\domains\....)
2. cmd->php init (run command)
------ END My Yii2 Advance set up -------
