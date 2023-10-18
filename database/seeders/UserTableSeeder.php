<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_manager = Role::where('name', 'manager')->first();
        $role_accontant = Role::where('name', 'accountant')->first();
        $role_seller = Role::where('name', 'seller')->first();
        $role_warehouse = Role::where('name', 'warehouse')->first();
        $role_user = Role::where('name', 'user')->first();

        $user = new User();
        $user->name = 'Admin';
        $user->surname = 'Admin';
        $user->rfc = 'ACBD1234ABC';
        $user->member_code = 'ABCD-1234';
        $user->email = 'admin@zoofish.com.mx';
        $user->phone = '1122334455';
        $user->password = bcrypt('Pass123456!.');
        $user->save();

        $user->roles()->attach($role_admin);

        // \Conekta\Conekta::setApiKey("key_3s2n2j8XXyrEShuVTBrx4g");
        // \Conekta\Conekta::setLocale('es');

        // $user = User::find($user->id);

        // try{
        //  $customer = \Conekta\Customer::create(
        //      [
        //          'name'  => $user->name,
        //          'email' => $user->email,
        //          'phone' => $user->phone,
        //      ]
        //  );
         

        // } catch (\Conekta\ParameterValidationError $error) {
        //  $bug = $error->getMessage();
        //  return response()->json(['bug' => $bug], 200);

        // } catch (\Conekta\Handler $error) {
        //  $bug = $error->getMessage();
        //  return response()->json(['bug' => $bug], 200);
        // }

        // $user->conekta_customer_id = $customer->id;
        // $user->save();

        // $user = new User();
        // $user->name = 'Admin USA';
        // $user->surname = 'Admin';
        // $user->email = 'admin@Zoofishusa.com';
        // $user->phone = '1122334455';
        // $user->password = bcrypt('Pass123456!.');
        // $user->save();

        // $user->roles()->attach($role_admin);

        // \Conekta\Conekta::setApiKey("key_3s2n2j8XXyrEShuVTBrx4g");
        // \Conekta\Conekta::setLocale('es');

        // $user = User::find($user->id);

        // try{
        //  $customer = \Conekta\Customer::create(
        //      [
        //          'name'  => $user->name,
        //          'email' => $user->email,
        //          'phone' => $user->phone,
        //      ]
        //  );
         

        // } catch (\Conekta\ParameterValidationError $error) {
        //  $bug = $error->getMessage();
        //  return response()->json(['bug' => $bug], 200);

        // } catch (\Conekta\Handler $error) {
        //  $bug = $error->getMessage();
        //  return response()->json(['bug' => $bug], 200);
        // }

        // $user->conekta_customer_id = $customer->id;
        // $user->save();

        // $user = new User();
        // $user->name = 'Gerente';
        // $user->surname = 'Gerente';
        // $user->email = 'gerente@zoofish.com.mx';
        // $user->phone = '1122334455';
        // $user->password = bcrypt('Pass123456!.');
        // $user->save();

        // $user->roles()->attach($role_manager);

        // $user = new User();
        // $user->name = 'Contador';
        // $user->surname = 'Contador';
        // $user->email = 'contador@zoofish.com.mx';
        // $user->phone = '1122334455';
        // $user->password = bcrypt('Pass123456!.');
        // $user->save();

        // $user->roles()->attach($role_accontant);

        // $user = new User();
        // $user->name = 'Vendedor';
        // $user->surname = 'Vendedor';
        // $user->email = 'vendedor@zoofish.com.mx';
        // $user->phone = '1122334455';
        // $user->password = bcrypt('Pass123456!.');
        // $user->save();

        // $user->roles()->attach($role_seller);

        // $user = new User();
        // $user->name = 'Almacén';
        // $user->surname = 'Almacén';
        // $user->email = 'almacen@zoofish.com.mx';
        // $user->phone = '1122334455';
        // $user->password = bcrypt('Pass123456!.');
        // $user->save();

        // $user->roles()->attach($role_warehouse);

        $user = new User();
        $user->name = 'Customer';
        $user->surname = 'Customer';
        $user->rfc = 'DBCA1234BCA';
        $user->member_code = 'DBCA-4321';
        $user->email = 'customer@zoofish.com.mx';
        $user->phone = '1122334455';
        $user->password = bcrypt('Pass123456!.');
        $user->save();

        $user->roles()->attach($role_user);

        // \Conekta\Conekta::setApiKey("key_3s2n2j8XXyrEShuVTBrx4g");
        // \Conekta\Conekta::setLocale('es');

        // $user = User::find($user->id);

        // try{
        //     $customer = \Conekta\Customer::create(
        //         [
        //             'name'  => $user->name,
        //             'email' => $user->email,
        //             'phone' => $user->phone,
        //         ]
        //     );

        //     } catch (\Conekta\ParameterValidationError $error) {
        //         $bug = $error->getMessage();
        //     return response()->json(['bug' => $bug], 200);

        //     } catch (\Conekta\Handler $error) {
        //         $bug = $error->getMessage();
        //     return response()->json(['bug' => $bug], 200);
        // }

        // $user->conekta_customer_id = $customer->id;
        // $user->save();
    }
}