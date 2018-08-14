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

        DB::table('tags')->insert([
            'name' => 'Chinesa',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('tags')->insert([
            'name' => 'Feijoada',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('additionals')->insert([
            'name' => 'Refrigerante'
        ]);
        DB::table('additionals')->insert([
            'name' => 'Carne'
        ]);
    }
}
