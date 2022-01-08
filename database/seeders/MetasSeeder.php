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
      "slug" => "plan_1month",
      "data" => json_encode([
        "title" => "1 month subscription",
        "description" => "30 days subsription plan",
        "price" => "1",
        "amount" => 30 * 24 * 3600,
      ]),
    ]);
    Meta::create([
      "slug" => "plan_3month",
      "data" => json_encode([
        "title" => "3 month subscription",
        "description" => "90 days subsription plan",
        "price" => "2",
        "amount" => 30 * 24 * 3600 * 3,
      ]),
    ]);
    Meta::create([
      "slug" => "plan_6month",
      "data" => json_encode([
        "title" => "6 month subscription",
        "description" => "180 days subsription plan",
        "price" => "3",
        "amount" => 30 * 24 * 3600 * 6,
      ]),
    ]);
  }
}
