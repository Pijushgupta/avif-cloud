<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use function inertia;


class Dashboard extends Controller
{
    /**
     * this to remove user out of session, aka logout
     * @return redirect()
     */
	public function logout(){
		Auth::logout();
		return redirect('/');
	}

    /**
     * This to load the dashboard never the method directly
     * Always use the route via redirect function

     * @return
     */
	public function dashboard(){
        //$user = Cashier::findBillable($stripeId);

       // dd($user);

        return inertia('Create');


	}

    public function create(){
        return inertia('Create');
    }

    public function checkout($productId){

        if(empty($productId)) return false;

        //getting product from database
       $product =  \App\Models\Product::find($productId);

        // checking if product exits or not
       if($product === null) return false;



       //getting user address which is required for stripe checkout
        $userAddress = Auth::user()->address;

       if(empty($userAddress)){
           return inertia('Address',['productId'=>$productId]);
       }

       $address = unserialize($userAddress);
       if(empty($address['address']) || empty($address['postalCode']) || empty($address['city']) || empty($address['state']) || empty($address['country'])){
           return inertia(
               'Address',
               [
                   'productId'=>$productId,
                   'address'=>$address['address'],
                   'postalCode' =>$address['postalCode'],
                   'city' =>$address['city'],
                   'state' =>$address['state'],
                   'country' =>$address['country'],

               ]);
       }


       //dd($product);




       $stripe = new StripeClient(env('STRIPE_SECRET'));

        //customer details
        try {
            $stripe->customers->create([
                'name' => (string)Auth::user()->name,
                'address' => [
                    'line1' => (string)$address['address'],
                    'postal_code' => (string)$address['postalCode'],
                    'city' => (string)$address['city'],
                    'state' => (string)$address['state'],
                    'country' => (string)$address['country'],
                ],
            ]);
        } catch (ApiErrorException $e) {
            $error = $e->getError()->message;
            return inertia('Exception',['exception'=> $error]);
        }

        /**
         * charge in local currency for india
         * govt rule - india
         */
        $currency = 'usd';

        $visibleAmount = $product->price;
        /**
         * stripe takes lowest unit of current currency
         * so amount x 100
         */
        $amount = $product->price * 100;

        if(strtoupper((string)$address['country']) === 'IN'){
            $currency = 'inr';
            $amount = $amount * 82;
            $visibleAmount = $visibleAmount * 82;
        }




        /**
         * product details
         */

        try {
            $response = $stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => $currency,
                'description' => $product->title . ' - Cloud Image conversion service',
                'shipping' => [
                    'name' => (string)Auth::user()->name,
                    'address' => [
                        'line1' => (string)$address['address'],
                        'postal_code' => (string)$address['postalCode'],
                        'city' => (string)$address['city'],
                        'state' => (string)$address['state'],
                        'country' => (string)$address['country'],
                    ],
                ],
                'automatic_payment_methods' => ['enabled' => true],
            ]);
        } catch (ApiErrorException $e) {
            $error = $e->getError()->message;
            return inertia('Exception',['exception'=> $error]);
        }


        $clientSecret = $response->client_secret;


        if($clientSecret){
            return inertia('Checkout',[
                'amount'=> $visibleAmount,
                'currency'=>$currency,
                'clientSecret'=>$clientSecret,
                'apiStripe'=> env('STRIPE_KEY')
            ]);
        }else{
            //return false;
        }


    }

    public static function addAddress($address){
        $address->validate([
            'productId' => 'required',

            'address'=>'required',
            'postalCode'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
        ]);

        $productId = strip_tags(trim($address->productId));

        $addressLine = strip_tags(trim($address->address));
        $postalCode = strip_tags(trim($address->postalCode));
        $city = strip_tags(trim($address->city));
        $state = strip_tags(trim($address->state));
        $country = strip_tags(trim($address->country));
        $addr= serialize([
            'address'=>$addressLine,
            'postalCode'=>$postalCode,
            'city'=>$city,
            'state'=>$state,
            'country'=>$country,
            ]);
        Auth::user()->update(['address'=>$addr]);


        if($address->productId){
            return redirect('/dashboard/checkout/'.$productId);
        }

        return redirect('/dashboard/create');


    }

    public function PaymentStatus($paymentIntent){

        if(empty($paymentIntent)) return;

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        //return inertia('PaymentStatus',['status'=>'failed','tid'=>$paymentIntent]);

        try{
            $payment_status = $stripe->paymentIntents->retrieve($paymentIntent);

            $payment_status = array('amount'=>$payment_status->amount, 'currency'=>$payment_status->currency,'status'=>$payment_status->status,'tid'=>$paymentIntent);
            return inertia('PaymentStatus',$payment_status);

        }catch (ApiErrorException $e){
            $error = $e->getError()->message;
            return inertia('Exception',['exception'=> $error]);
        }

    }
}
