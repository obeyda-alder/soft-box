<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->CreateAdmin();
    User::factory(30)->create();
  }

  public function CreateAdmin()
  {
    $user = User::firstOrNew([
      'email' => 'admin@gmail.com',
    ]);

    $user->name          = "Admin";
    $user->email         = "admin@gmail.com";
    $user->status        = "ACTIVE";
    $user->phone_number  = "(+90) 548574522";
    $user->password      = '123321@@';
    $user->type          = "ADMIN";
    $user->save();
  }
}
