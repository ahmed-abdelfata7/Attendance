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
        $checkAdmin=DB::table('users')->where('email','ahmed.m.web.dev@gmail.com')->first();
        if(empty($checkAdmin)){
         DB::table('users')->insert([
             'name'=>'EngAhmedMahmoud',
             'email'=>'ahmed.m.web.dev@gmail.com',
             'password'=>'$2y$10$uhyROwZ9pdpulmsmJT8lLOaGX7hyljARNIly53XsLN2SmR55Pf6lK',
             'role'=>'developer',
             'remember_token'=>'Huz7pXJ2CV4iGa4srME4rL8Ki6VSopc09YyxxQVBvgydg3UGScZMXQYyKUI8'
         ]);    
        }
       
    }
}
