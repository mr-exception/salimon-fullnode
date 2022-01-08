<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jcsofts\LaravelEthereum\Facade\Ethereum;
use Jcsofts\LaravelEthereum\Lib\EthereumTransaction;

class SubscriptionsController extends Controller
{
  public function checkWallet(Request $request)
  {
    // "0x49bb851d669a19a7570CBFd9dE4116E7B5e8e6e8"
    $response = Ethereum::eth_getBlockByNumber(2);
    return $response;
  }
}
