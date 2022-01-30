<?php

namespace App\Console\Commands;

use App\Models\ContractReport;
use App\Models\Transaction;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Jcsofts\LaravelEthereum\Facade\Ethereum;

class CollectShares extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = "shares:collect";

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = "collects share from recent submited contracts";

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }
  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $contract_reports = ContractReport::whereStatus(ContractReport::VERIFIED)
      ->limit(5000)
      ->get();
    $stats = [];

    foreach ($contract_reports as $report) {
      if (!isset($stats[$report->address])) {
        $stats[$report->address] = 0;
      }
      $stats[$report->address] += $report->share;
      $report->status = ContractReport::COLLECTED;
      $report->save();
    }

    foreach ($stats as $address => $amount) {
      Transaction::create([
        "address" => $address,
        "date" => time(),
        "amount" => $amount,
        "description" => "contract share",
        "type" => Transaction::IN,
      ]);
      $this->info("[$address]: $amount");
    }
    return 0;
  }
}
