<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'ivanov',
            'email' => 'ivanov@test.test',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'petrov',
            'email' => 'petrov@test.test',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('locations')->insert([
            'id' => 1,
            'title' => 'Школа',
            'address' => 'улица Иванова',
        ]);

        DB::table('locations')->insert([
            'id' => 2,
            'title' => 'Магазин',
            'address' => 'улица Петрова',
        ]);

        DB::table('locations')->insert([
            'id' => 3,
            'title' => 'Почта',
            'address' => 'улица Сидорова',
        ]);

        DB::table('shipments')->insert([
            'id' => 1,
            'title' => 'Продукты',
            'cost' => 100,
        ]);

        DB::table('shipments')->insert([
            'id' => 2,
            'title' => 'Лекарства',
            'cost' => 55,
        ]);

        DB::table('shipments')->insert([
            'id' => 3,
            'title' => 'Одежда',
            'cost' => 65,
        ]);

        DB::table('tasks')->insert([
            'id' => 1,
            'title' => 'забрать из магазина',
            'user_id' => 1,
            'location_id' => 2,
            'complete' => 0,
        ]);

        DB::table('tasks_shipments')->insert([
            'id' => 1,
            'task_id' => 1,
            'shipment_id' => 1,
            'is_for_give_out' => 0,
            'complete' => 0,
        ]);

        DB::table('tasks_shipments')->insert([
            'id' => 2,
            'task_id' => 1,
            'shipment_id' => 2,
            'is_for_give_out' => 0,
            'complete' => 0,
        ]);

        DB::table('tasks')->insert([
            'id' => 2,
            'title' => 'Доставить в школу',
            'user_id' => 1,
            'location_id' => 1,
            'complete' => 0,
        ]);

        DB::table('tasks_shipments')->insert([
            'id' => 3,
            'task_id' => 2,
            'shipment_id' => 1,
            'is_for_give_out' => 1,
            'complete' => 0,
        ]);

        DB::table('tasks_shipments')->insert([
            'id' => 4,
            'task_id' => 2,
            'shipment_id' => 2,
            'is_for_give_out' => 1,
            'complete' => 0,
        ]);

        DB::table('tasks_shipments')->insert([
            'id' => 5,
            'task_id' => 2,
            'shipment_id' => 3,
            'is_for_give_out' => 0,
            'complete' => 0,
        ]);

        DB::table('tasks')->insert([
            'id' => 3,
            'title' => 'Отнести на почту',
            'user_id' => 1,
            'location_id' => 3,
            'complete' => 0,
        ]);

        DB::table('tasks_shipments')->insert([
            'id' => 6,
            'task_id' => 3,
            'shipment_id' => 3,
            'is_for_give_out' => 1,
            'complete' => 0,
        ]);
    }
}
