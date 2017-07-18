<?php

use Illuminate\Database\Seeder;
use App\Address;
use App\AddType;
use App\Order;
use App\PaymentType;
use App\Phone;
use App\PhoneType;
use App\Product;
use App\ProductOrderLine;
use App\Space;
use App\SpaceOrderLine;
use App\User;



class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // call our class and run our seeds
        $this->call('OrderAppSeeder');
        $this->command->info('order app seeds finished.'); // show information in the command line after everything is run
    }

}

// our own seeder class
// usually this would be its own file
class orderAppSeeder extends Seeder {

    public function run() {

        // clear our database ------------------------------------------
		// addresses, addresstypes, orders, paymenttypes, phones, phonetypes, productorderline,products, spaceorderline, spaces, users
        	
		DB::table('phones')->delete();
		DB::table('phonetypes')->delete();
		DB::table('productorderline')->delete();
		DB::table('addresses')->delete();
		DB::table('addresstypes')->delete();	
		DB::table('products')->delete();
		DB::table('spaceorderline')->delete();
		DB::table('spaces')->delete();
		DB::table('orders')->delete();
		DB::table('paymenttypes')->delete();
		DB::table('users')->delete();
       

        // seed our users table -----------------------
        // we'll create 2 user

        $userAdmin = User::create(array(
            'firstName' => 'Admin',
			'lastName' => 'Of This',
            'email' => 'root@example.com',
            'password' => bcrypt('root123456'),
        ));
		
		// make this admin
		$userAdmin->staff = True;
		$userAdmin->save();
		
		$userTest = User::create(array(
            'firstName' => 'Tester',
			'lastName' => 'Of This',
            'email' => 'test@example.com',
            'password' => bcrypt('xyz123456'),
        ));

        

        $this->command->info('The user is added');

        // seed our phonetypes table ------------------------
		
		$mobilePhone = PhoneType::create(array(
			'phoneType' => 'Mobile'
		));
		
		$companyPhone = PhoneType::create(array(
			'phoneType' => 'Company'
		));
		
		$homePhone = PhoneType::create(array(
			'phoneType' => 'Home'
		));
		
		$this->command->info('The phoneType is added');
		
		// seed our addresstypes table ------------------------
		
		$homeAddress = AddType::create(array(
			'addType' => 'Home'
		));
		
		$companyAddress = AddType::create(array(
			'addType' => 'Company'
		));		
		
		$this->command->info('The addType is added');
		
		// seed our phones table ------------------------
        
        Phone::create(array(
            'number'  => '123456789',
            'user_id' => $userAdmin->id,
			'phoneType' => $mobilePhone->phoneType,
        ));
		
		Phone::create(array(
            'number'  => '987654321',
            'user_id' => $userTest->id,
			'phoneType' => $companyPhone->phoneType,
        ));
		
		$this->command->info('The phones is added');
		
		// seed our addresses table ------------------------
        // addr1	addr2	city	state	postalCode	prefered	user_id	created_at	updated_at	addType

        $address1 = Address::create(array(
            'addr1'  => '639 38th st.',
			'city' => 'RockIsland',
			'state' => 'IL',
			'postalCode' => '61201',
            'user_id' => $userAdmin->id,
			'addType' => $homeAddress->addType,
        ));
		
		Address::create(array(
            'addr1'  => '639 38th st.',
			'city' => 'RockIsland',
			'state' => 'IL',
			'postalCode' => '61201',
            'user_id' => $userTest->id,
			'addType' => $companyAddress->addType,
        ));	
		
		$this->command->info('The addresses is added');
		
		// seed our paymenttypes table ------------------------
		
		$Paypal = PaymentType::create(array(
			'paymentType' => 'Paypal'
		));
		
		$Check = PaymentType::create(array(
			'paymentType' => 'Check'
		));
		
		$this->command->info('The paymentType is added');
		
		// seed our orders table ------------------------
		// paymentType	status	total_price	unpaid_price	user_id
		
		$order1 = Order::create(array(
			'paymentType' => $Paypal->paymentType,
			'status' => 'pending',
			'total_price' => 100,
			'unpaid_price' => 100,
			'user_id' => $userTest->id,
		));
		
		$order2 = Order::create(array(
			'paymentType' => $Check->paymentType,
			'status' => 'paid',
			'total_price' => 50,
			'unpaid_price' => 50,
			'user_id' => $userTest->id,
		));
		
		$order3 = Order::create(array(
			'paymentType' => $Paypal->paymentType,
			'status' => 'pending',
			'total_price' => 50,
			'unpaid_price' => 50,
			'user_id' => $userAdmin->id,
		));
		
		$this->command->info('The order is added');
		
		// seed our spaces table ------------------------
		// row	col	note	price	availability	created_at	updated_at	user_id
		
		$space1 = Space::create(array(
			'row' => '1',
			'col' => 'A',
			'price' =>  50,
			'availability' => 'Reserved',
			'user_id' => $userTest->id,			
		));
		
		$space2 = Space::create(array(
			'row' => '1',
			'col' => 'B',
			'price' => 50,
			'availability' => 'Reserved',
			'user_id' => $userTest->id,			
		));
		
		$space3 = Space::create(array(
			'row' => '2',
			'col' => 'A',
			'price' => 50,
			'availability' => 'Reserved',
			'user_id' => $userTest->id,			
		));
		
		$space4 = Space::create(array(
			'row' => '2',
			'col' => 'B',
			'price' => 50,
			'availability' => 'Reserved',
			'user_id' => $userAdmin->id,			
		));
		
		$this->command->info('The spaces is added');
		
		// seed our products table ------------------------
		// id price	description	created_at	updated_at	in stock

		
		$product1 = Product::create(array(
			'id' => 'OFFBlueS',
			'price' => 25,
			'description' => 'official tshirt in blue size S',
			'in stock' => 100,
		));
		
		$this->command->info('The products added');
		
		// seed our spaceorderline table ------------------------
		
		SpaceOrderLine::create(array(
			'order_id' => $order1->id,
			'space_id' => $space1->id,
			'price' => 50,
		));
		
		SpaceOrderLine::create(array(
			'order_id' => $order1->id,
			'space_id' => $space2->id,
			'price' => 50,
		));

		SpaceOrderLine::create(array(
			'order_id' => $order2->id,
			'space_id' => $space3->id,
			'price' => 50,
		));
		
		$this->command->info('The spaceorderline is added');
		
		// seed our productorderline table ------------------------
		
		ProductOrderLine::create(array(
			'order_id' => $order1->id,
			'product_id' => $product1->id,
			'quantity' => 2,
			'price' => 100,
			'address_id' => $address1->id,
		));
		
		$this->command->info('The productorderline is added');
		 
		

        /* // link our bears to picnics ---------------------
        // for our purposes we'll just add all bears to both picnics for our many to many relationship
        $bearLawly->picnics()->attach($picnicYellowstone->id);
        $bearLawly->picnics()->attach($picnicGrandCanyon->id);

        $bearCerms->picnics()->attach($picnicYellowstone->id);
        $bearCerms->picnics()->attach($picnicGrandCanyon->id);

        $bearAdobot->picnics()->attach($picnicYellowstone->id);
        $bearAdobot->picnics()->attach($picnicGrandCanyon->id);

        $this->command->info('They are terrorizing picnics!'); */

    }

}
