<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@pandeco.com.br',
            'type' => 'admin',
            'password' => bcrypt('pandeco2018')
        ]);
        DB::table('users')->insert([
            'name' => 'client',
            'email' => 'client@pandeco.com.br',
            'type' => 'client',
            'password' => bcrypt('pandeco2018')
        ]);
        DB::table('users')->insert([
            'name' => 'company',
            'email' => 'company@pandeco.com.br',
            'type' => 'company',
            'password' => bcrypt('pandeco2018')
        ]);
        DB::table('clients')->insert([
            'user_id' => 2,
            'name' => 'client test',
            'cpf' => '564.882.560-92',
            'phone' => '(45)3252-0434',
            'cell_phone' => '(45)99815-8232'
        ]);
        DB::table('companies')->insert([
            'user_id' => 3,
            'cnpj' => '90.007.360/0001-08',
            'responsible_name' => 'company test',
            'responsible_phone' => '(45)3252-0434',
            'social_name' => 'company test',
            'fantasy_name' => 'company test',
            'phone' => '(45)99815-8232',
            'order_limit' => 2,
            'cell_phone' => '(45)99815-8232'
        ]);
        DB::table('statuses')->insert([
            'name' => 'pending'
        ]);
        DB::table('statuses')->insert([
            'name' => 'confirmed'
        ]);
        DB::table('statuses')->insert([
            'name' => 'closed'
        ]);
        DB::table('form_payments')->insert([
            'description' => 'A vista'
        ]);
        DB::table('locations')->insert([
            'city' => 'Toledo',
            'state' => 'Paraná',
            'address' => 'R. Francisco Alves',
            'number' => '420',
            'district' => 'Vila Pioneiro',
            'postal_code' => '85909-230',
            'observation' => 'nothing'
        ]);
        DB::table('client_location')->insert([
            'client_id' => 1,
            'location_id' => 1
        ]);
        DB::table('company_location')->insert([
            'company_id' => 1,
            'location_id' => 1
        ]);
        DB::table('orders')->insert([
            'client_id' => 1,
            'company_id' => 1,
            'status_id' => 1,
            'form_payment_id' => 1,
            'location_id' => 1,
            'price' => 10,
            'observation' => 'order test',
            'deliver' => 0,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('orders')->insert([
            'client_id' => 1,
            'company_id' => 1,
            'status_id' => 1,
            'form_payment_id' => 1,
            'location_id' => 1,
            'price' => 10,
            'observation' => 'order test2',
            'deliver' => 0,
            'created_at' => \Carbon\Carbon::now()
        ]);

    }
}
