<?php

use Illuminate\Database\Seeder;

class PaymentDaySeeder extends Seeder
{   
    /**
    * Run the database seeds.
    *
    * @return void
    */
   private $faker;

   public function run()
   {
       $this->faker = $faker = Faker\Factory::create();
       $tests = array(
           [
               'name' => 'Domingo'
           ],
           [
               'name' => 'Lunes'
           ],
           [
               'name' => 'Martes'
           ],
           [
               'name' => 'Miercoles'
           ],
           [
               'name' => 'Jueves'
           ],
           [
               'name' => 'Viernes'
           ],
           [
               'name' => 'Sabado'
           ]
       );

       foreach ($tests as $key) {
           DB::table('payment_day')->insert($key);
       }

   }
}
