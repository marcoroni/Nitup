<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Product;
use App\User;
use App\Order;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function productJoin($id) {
        if(!empty(Product::where('product_id', $id)->get())) {
            //dd(Product::where('name', 'like', '%' . $product . '%')->get());
            $currentProduct = Product::where('product_id', $id)->first();

            if(empty(Order::where('product_id', $currentProduct->product_id)->where('user_id', \Auth::user()['id'])->first())) {
                Order::create(['product_id' => $currentProduct->product_id, 'user_id' => \Auth::user()['id'], 'amount' => 1]);
            } else {
                $orderAdd = Order::where('product_id', $currentProduct->product_id)->where('user_id', \Auth::user()['id'])->first();
                $orderAdd->amount += 1;
                $orderAdd->save();
            }

            $products = [];
            $user = User::where('id', \Auth::user()['id'])->first();
            //dd(\Auth::user('id'));
            $orders = Order::where('user_id', $user->id)->get();
            //dd($orders);
            $total = 0;
            $i = 0;
            foreach($orders as $order) {
                $name = Product::where('product_id', $order->product_id)->first()['name'];
                $total += Product::where('product_id', $order->product_id)->first()['price'] * $order->amount;
                $products[$i]['order_id'] = $order->order_id;
                $products[$i]['image'] = "<img class='product_image' src='/images/".$name."'>";
                $products[$i]['name'] =  substr($name, 0, strpos($name, "."));
                $products[$i]['price'] = "€" . number_format(Product::where('product_id', $order->product_id)->first()['price'], 2);
                $products[$i]['amount'] = $order->amount;
                $i++;
            }
            $total = number_format($total, 2);

            return view('master', ['section' => 'overview', 'user' => \Auth::user(), 'products' => $products, 'total' => $total]);
        }
        else {
            return redirect('/')->withErrors("dit product bestaat momenteel niet.");
        }
    }

    public function productOverview() {
        $user = User::where('id', \Auth::user()['id'])->first();
        $orders = Order::where('user_id', $user->id)->get();

        if(!empty(Order::where('user_id', $user->id)->first())) {
            $total = 0;
            $i = 0;
            $k = 'hier';
            foreach ($orders as $order) {
                $name = Product::where('product_id', $order->product_id)->first()['name'];
                $total += Product::where('product_id', $order->product_id)->first()['price'] * $order->amount;
                $products[$i]['order_id'] = $order->order_id;
                $products[$i]['image'] = "<img class='product_image' src='/images/".$name."'>";
                $products[$i]['name'] =  substr($name, 0, strpos($name, "."));
                $products[$i]['price'] = "€" . number_format(Product::where('product_id', $order->product_id)->first()['price'], 2);
                $products[$i]['amount'] = $order->amount;
                $i++;
            }

            //dd($orders);
            $total = number_format($total, 2);

            return view('master', ['section' => 'overview', 'user' => \Auth::user(), 'products' => $products, 'total' => $total]);
        } else {
            return redirect('/')->withErrors("U heeft momenteel geen bestellingen.");
        }
    }

    public function productDel(Request $request) {
        $order = Order::where('order_id', $request->get('order_id'))->first();
        if($order->amount == 1) {
            $order->delete();
            return redirect('/winkelwagen');
        }
        $order->amount-=1;
        $order->save();
        return redirect('/winkelwagen');
    }
    public function productAdd(Request $request) {
        $order = Order::where('order_id', $request->get('order_id'))->first();

        $order->amount+=1;
        $order->save();
        return redirect('/winkelwagen');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function productNewRequest(Request $request) {
        $validator = Validator($request->all(), [
            'product_desc'  => 'required',
            'product_cat'   => 'required',
            'product_price' => 'required|numeric',
            'product_image' => 'required'
        ]);

        if(!$validator->fails()) {
            $image = Input::file('product_image');
            $desc = $request->all()['product_desc'];
            $category = $request->all()['product_cat'];
            $price = $request->all()['product_price'];
            $fileName = $image->getClientOriginalName();

            if(in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
                if(empty(Product::where('name', $fileName)->first()) || Product::where('name', $fileName)->first() == null) {
                    Input::file('product_image')->move('images', $fileName);
                    Product::create(['name' => $fileName, 'description' => $desc, 'category' => $category, 'price' => $price]);

                    return redirect('/product/toevoegen');
                } else {
                    return redirect('/')->withErrors("de image bestaat al.");
                }

            } else {
                return redirect('/')->withErrors("het bestand moet een 'jpg', 'jpeg' of een 'png' zijn.");
            }
        } else {
            return redirect('/')->withErrors("een van de invoer elementen zijn leeg.");
        }
    }
}
