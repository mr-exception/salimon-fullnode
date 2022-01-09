<?php

namespace App\Console\Commands;

use App\Models\Meta;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Jcsofts\LaravelEthereum\Facade\Ethereum;
use Jcsofts\LaravelEthereum\Lib\EthereumTransaction;

class CheckEthereum extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = "transactions:update";

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = "update transactions by new blocks from last fetch";

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
    $max_fetch = intval(Meta::whereSlug("fetch_per_update")->first()->data);
    $last_block = intval(Meta::whereSlug("last_block_number")->first()->data);

    $this->info("last block number: $last_block");
    $this->info("max fetch count: $max_fetch");

    $current_block = Ethereum::eth_blockNumber(true);

    if ($last_block === "none") {
      $block = Ethereum::eth_getBlockByNumber($current_block);
      $transactions = $block->transactions;
      foreach ($transactions as $transaction) {
        $this->info("pt");
        if (strtolower($transaction->to) === strtolower("0xAE11236A89455A8a7cE5b6212AD513ea8f82B298")) {
          $record = new Transaction();
          $record->address = $transaction->from;
          $record->date = time();
          $record->price = hexdec($transaction->value);
          $record->amount = intval(hexdec($transaction->value) / 3600);
          $record->save();
          $this->info("[" . $transaction->value . "] from " . $transaction->from);
        }
      }
      Meta::whereSlug("last_block_number")->update(["data" => $current_block]);
    } else {
      for ($i = 0; $i < $max_fetch && $last_block + $i + 1 <= $current_block; $i++) {
        $block = Ethereum::eth_getBlockByNumber($last_block + $i + 1);
        $transactions = $block->transactions;
        foreach ($transactions as $transaction) {
          $this->info("pt");
          if (strtolower($transaction->to) === strtolower("0xAE11236A89455A8a7cE5b6212AD513ea8f82B298")) {
            $record = new Transaction();
            $record->address = $transaction->from;
            $record->date = time();
            $record->price = hexdec($transaction->value);
            $record->amount = intval(hexdec($transaction->value) / 3600);
            $record->save();
            $this->info("[" . $transaction->value . "] from " . $transaction->from);
          }
        }
        Meta::whereSlug("last_block_number")->update(["data" => hexdec($block->number)]);
      }
    }

    for ($i = 0; $i < 25; $i++) {
      $value = rand(1, 100) * 3600;
      $transaction = new EthereumTransaction("0x533623adA667fE96672150E7A8452dDea6899320", "0xAE11236A89455A8a7cE5b6212AD513ea8f82B298", $value);
      Ethereum::eth_sendTransaction($transaction);
    }
    return 0;
  }
}
