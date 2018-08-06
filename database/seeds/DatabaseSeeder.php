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
        DB::table('users')->insert([
            'name' => 'guest',
            'email' => 'guest@pandeco.com.br',
            'type' => 'guest',
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
            'cell_phone' => '(45)99815-8232',
            'opening_time' => '11:00:00',
            'observation' => 'Mussum Ipsum, cacilds vidis litro abertis. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.'
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
        DB::table('statuses')->insert([
            'name' => 'refused'
        ]);
        DB::table('statuses')->insert([
            'name' => 'refused'
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
            'receive_at' => \Carbon\Carbon::now()->toTimeString(),
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
        DB::table('ingredient_groups')->insert([
            'name' => 'Geral'
        ]);
        DB::table('ingredient_groups')->insert([
            'name' => 'Guarnição',
            'number_options' => 3
        ]);
        DB::table('ingredient_groups')->insert([
            'name' => 'Principal',
            'number_options' => 1
        ]);
        DB::table('ingredient_groups')->insert([
            'name' => 'Acompanhamento',
            'number_options' => 2
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 4,
            'name' => 'Arroz'
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 4,
            'name' => 'Feijão'
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 3,
            'name' => 'Carne bovina'
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 3,
            'name' => 'Carne suína'
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 2,
            'name' => 'Panqueca'
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 2,
            'name' => 'Lasanha'
        ]);
        DB::table('ingredients')->insert([
            'ingredient_group_id' => 2,
            'name' => 'Linguiça'
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'description' => 'Pedido de marmita',
            'date' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('products')->insert([
            'company_id' => 1,
            'description' => 'Pedido de marmita',
            'date' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 1
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 2
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 3
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 4
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 5
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 2,
            'ingredient_id' => 1
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 2,
            'ingredient_id' => 2
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 2,
            'ingredient_id' => 3
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 2,
            'ingredient_id' => 4
        ]);
        DB::table('ingredient_product')->insert([
            'product_id' => 2,
            'ingredient_id' => 5
        ]);
        DB::table('prices')->insert([
            'size' => 'P',
            'price' => 10,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('prices')->insert([
            'size' => 'M',
            'price' => 12,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('prices')->insert([
            'size' => 'G',
            'price' => 15,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('prices')->insert([
            'size' => 'Fitness',
            'price' => 12.5,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('prices')->insert([
            'size' => 'Especial',
            'price' => 14,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('price_product')->insert([
            'product_id' => 1,
            'price_id' => 2
        ]);
        DB::table('price_product')->insert([
            'product_id' => 2,
            'price_id' => 3
        ]);
        DB::table('tags')->insert([
            'name' => 'Chinesa',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('tags')->insert([
            'name' => 'Feijoada',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('worked_days')->insert([
            'company_id' => 1,
            'monday' => true,
            'sunday' => true,
            'tuesday' => true,
            'wednesday' => true,
            'thursday' => true,
            'friday' => true,
            'saturday' => true
        ]);
        DB::table('order_evaluations')->insert([
            'order_id' => 1,
            'note' => 4,
        ]);
        DB::table('order_evaluations')->insert([
            'order_id' => 2,
            'note' => 5,
        ]);
        DB::table('additionals')->insert([
            'name' => 'Refrigerante'
        ]);
        DB::table('additionals')->insert([
            'name' => 'Carne'
        ]);
        DB::table('additional_company')->insert([
            'company_id' => 1,
            'additional_id' => 1,
            'value' => 6.5
        ]);
        DB::table('additional_company')->insert([
            'company_id' => 1,
            'additional_id' => 2,
            'value' => 1.5
        ]);
        DB::table('additional_order')->insert([
            'order_id' => 1,
            'additional_id' => 2
        ]);
        DB::table('additional_order')->insert([
            'order_id' => 2,
            'additional_id' => 1
        ]);
    }
}
