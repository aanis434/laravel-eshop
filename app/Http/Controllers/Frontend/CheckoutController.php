<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PlaceOrderRequest;
use App\User;
use App\Customer;
use App\Order;
use App\OrderDetails;
use App\ShippingAddress;
use App\BillingAddress;
use Session;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Http\Traits\StockTrait;
use Carbon\Carbon;

class CheckoutController extends Controller
{
	use StockTrait;

	public function index()
	{
		return view('frontend.checkout');
	}

	public function placeOrder(PlaceOrderRequest $request)
	{
		$currentDate = Carbon::now()->timezone('Asia/Dhaka');
		$currentDate = $currentDate->toDateString();

		$customer_id = Auth::id();

		if ($request->create_account == true) {

			$user = User::create($request->only(['email', 'name', 'password']));

			$customerInputs = [];
			$customerInputs['user_id'] = $customer_id = $user->id;
			$customerInputs['name'] = $request->name;
			$customerInputs['phone'] = $request->phone;
			$customerInputs['address'] = $request->address;
			$customerInputs['email'] = $request->email;

			$customer = Customer::create($customerInputs);
		}

		$cartItems = Cart::content();

		$orders = [];
		$orders['customer_id'] = $customer_id; // send to user table incremented id
		$orders['amount'] = $amount = Cart::subtotal(2, '.', '');
		$orders['total_amount'] = $amount;
		$orders['notes'] = $request->notes;
		$orders['payment_type'] = $request->payment_type;
		$orders['order_no'] = rand(3, 5);

		$order = Order::create($orders);
		$order_id = $order->id;

		$orderDetailsInputs = [];

		foreach ($cartItems as $key => $item) {

			$orderDetailsInputs['order_id'] = $order_id;
			$orderDetailsInputs['product_id'] = $product_id = $item->id;
			$orderDetailsInputs['price'] = (float) $item->price;
			$orderDetailsInputs['qty'] = $qty = $item->qty;
			$orderDetailsInputs['total_price'] = (float) $item->subtotal;

			$orderDetails = OrderDetails::create($orderDetailsInputs);

			$this->stockOut($product_id, $qty, $flag = "sale");
			$this->stock_report($product_id, $qty, $type = 'sale', $currentDate);
		}

		$billingAddressInputs = [];
		$billingAddressInputs['name'] = $request->name;
		$billingAddressInputs['phone'] = $request->phone;
		$billingAddressInputs['alternative_phone'] = $request->alternative_phone;
		$billingAddressInputs['address'] = $request->address;
		$billingAddressInputs['order_id'] = $order_id;

		$billingAddress = BillingAddress::create($billingAddressInputs);

		if ($request->different_shipping_address == true) {

			$shippingAddressInputs = [];
			$shippingAddressInputs['name'] = $request->shipping_name;
			$shippingAddressInputs['phone'] = $request->shipping_phone;
			$shippingAddressInputs['alternative_phone'] = $request->shipping_alternative_phone;
			$shippingAddressInputs['address'] = $request->shipping_address;
			$shippingAddressInputs['order_id'] = $order_id;

			$shippingAddress = ShippingAddress::create($shippingAddressInputs);
		} else {
			$shippingAddress = ShippingAddress::create($billingAddressInputs);
		}

		Cart::destroy();
		return redirect('track-order')->with('status', 'Your Order Placed Successfully!');
	}
}
