<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Exception;
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
    $max_fetch = env("FETCH_PER_UPDATE");
    $last_block = env("LAST_BLOCK_NUMBER");

    $this->info("last block number: $last_block");
    $this->info("max fetch count: $max_fetch");

    $current_block = Ethereum::eth_blockNumber(true);

    if ($last_block === 0) {
      $block = Ethereum::eth_getBlockByNumber($current_block);
      $transactions = $block->transactions;
      foreach ($transactions as $transaction) {
        if (strtolower($transaction->to) === strtolower(env("ETH_ADDRESS"))) {
          $record = new Transaction();
          $record->address = $transaction->from;
          $record->date = time();
          $record->price = hexdec($transaction->value);
          $record->amount = intval(hexdec($transaction->value) / 3600);
          $record->save();
          $this->info("[" . $record->price . " = " . $record->amount . "hrs] from " . $transaction->from . " on block " . hexdec($block->number));
        }
      }
      setEnv("LAST_BLOCK_NUMBER", $current_block);
    } else {
      $i = 0;
      $last_fetched_block = $last_block;
      try {
        for ($i; $i < $max_fetch && $last_block + $i + 1 <= $current_block; $i++) {
          $block = Ethereum::eth_getBlockByNumber($last_block + $i + 1);
          $transactions = $block->transactions;
          foreach ($transactions as $transaction) {
            if (strtolower($transaction->to) === strtolower(env("ETH_ADDRESS"))) {
              $record = new Transaction();
              $record->address = $transaction->from;
              $record->date = time();
              $record->price = hexdec($transaction->value);
              $record->amount = intval(hexdec($transaction->value) / 3600);
              $record->save();
              $this->info("[" . $record->price . " = " . $record->amount . "hrs] from " . $transaction->from . " on block " . hexdec($block->number));
            }
          }
          $last_fetched_block = hexdec($block->number);
        }
      } catch (Exception $e) {
        $this->error($e->getMessage());
      }
      setEnv("LAST_BLOCK_NUMBER", $last_fetched_block);
    }
    return 0;
  }
}
