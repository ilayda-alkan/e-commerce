<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\User;
 
class UserSeeder extends Seeder
{
    
    public function run(): void
    {

        User::factory()->create([
            'name' => 'İlayda Alkan',
            'email' => 'alkan@admin.com',
            'password'=> 'admin'
        ]);
    }
}