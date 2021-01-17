<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function create(Request $request){

        try {
            $user = Auth::User();
            $id = "order-" . substr(sha1(time()), 1, 10);
            $new = new Order();
            $new->order_id = $id;
            $new->ordered_by = $user->id;
            $new->price = $request['price'];
            $new->order = json_encode($request['order']);

            foreach ($request['order'] as $var) {
                Image::where('id', $var['image_id']);
    //                ->decrement('quantity', $var['qty']);
            }
            $new->save();
            return $new;
        } catch (\Exception $e) {

            return response($e->getmessage(), 422);
        }
    }
    public function getOne($id)
    {
        try {
            $order = Order::where('order_id', $id)->get();

            if (count($order) === 0) {
                return response("id not found", 404);
            }
            $user = Auth::User();

            if (strcmp($user->id, $order[0]->ordered_by) !== 0) {
                return response("unauthorized action", 403);
            }

            $user =  User::where('user_id', $order[0]->ordered_by)->get();
            $order[0]->ordered_by = $user[0];
            $ord = [];
            foreach (json_decode($order[0]->order) as $item) {
                $item->product = Image::where('id', $item->id)->with(['brand', 'category'])->get();
                array_push($ord, $item);
            }
            $order[0]->order = $ord;
            return $order[0];
        } catch (\Exception $e) {

            return response($e->getmessage(), 422);
        }
    }


    public function allOrders()
    {
        try {
            $orders = Order::all();
            if(count($orders) === 0){
                return $orders;
            }
            $formattedOrders = [];
            foreach ($orders as $eachOrder) {
                $user = User::where('user_id', $eachOrder->ordered_by)->get();
                $ord = [];
                foreach (json_decode($eachOrder->order) as $item) {
                    $item->image = Image::where('id', $item->image_id)->with(['repository'])->get();
                    array_push($ord, $item);
                }
                $eachOrder->order = $ord;
                $eachOrder->ordered_by = $user;
                array_push($formattedOrders, $eachOrder);
            }
            return $formattedOrders;
        } catch (\Exception $e) {

            return response($e->getmessage(), 422);
        }
    }
}
