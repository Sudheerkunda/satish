<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class HomeController extends Controller
{
    public function pending(){
    	return view('home');
    }
    public function order_completed($id)
    {
       date_default_timezone_set("Asia/Calcutta");
       date_default_timezone_get();
       $reg_date = date('Y-m-d H:i:s', time());
       $up       = OrderModels::where('Order_Code',$id)->update(['Order_Status'=>'Completed','Update_Date'=>$reg_date]);
       return redirect('pending');
    }
    public function view_details(Request $request)
    {
        $order_code  = $request->order_id;

        $questiondata = DB::table('y_orders as ord')->
				join('y_products as pro','pro.Product_Id','=','ord.Product_Id') ->select('ord.Order_Id', 'ord.Order_Code', 'ord.Product_Name','ord.Quantity','pro.Image','ord.Selling_Price','ord.Total_Price')->where('ord.Order_Code',$order_code)->where('ord.Status',1)->where('ord.Order_Status','Pending')->get();
        return response()->json($questiondata);
    }

    public function remove_product($id)
    {
       date_default_timezone_set("Asia/Calcutta");
       date_default_timezone_get();
       $reg_date = date('Y-m-d H:i:s', time());
       $up       = ProductModel::where('Product_Id',$id)->update(['Status'=>0,'Update_Date'=>$reg_date]);
       return redirect('ProductsList');
    }

    public function addproduct(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        date_default_timezone_get();
        $reg_date          = date('Y-m-d H:i:s', time());

        $category_id  = $request->category_id;
        $product_name = $request->product_name;
        $price        = $request->price;
        $img          = $request->file('image');
        if($category_id !='' && !empty($category_id))
        {
            $mydata   = [
                'Category_Id' => $category_id,
                'Product_Name' => $product_name,
                'Price' => $price,
                'status' => 1,
                'Reg_Date' => $reg_date,
                'Update_Date' => $reg_date
            ];
            $image = $request->file('image');
			$image_name = "http://programmingly.com/yumi/admin/public/images/products/".time()."_".$image->getClientOriginalName();
			$image->move('public/images/products',$image_name);
			$mydata = array_merge($mydata, ['Image' => $image_name]);

            $user_reg = new ProductModel($mydata);               
            $user_reg->save();
            $last_id = $user_reg->id;
            if($last_id>0){
                return redirect('add_product')->with('msg','Successfully Added!');
            }else{
            	return redirect('add_product')->with('msg','Failed,to add product!');
            }                     
        }else{
        	return redirect('add_product')->with('msg','Please Select Category!');
        }
    }
}
