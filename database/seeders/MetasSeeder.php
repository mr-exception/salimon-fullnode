<?php

namespace Database\Seeders;

use App\Models\Meta;
use Illuminate\Database\Seeder;

class MetasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Meta::create([
      "slug" => "subscription_fee",
      "data" => "3600",
    ]);
    Meta::create([
      "slug" => "last_block_number",
      "data" => 0,
    ]);
    Meta::create([
      "slug" => "fetch_per_update",
      "data" => 30,
    ]);
  }
}
