<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
  public static function collection($resource)
  {
    $page = intval(request()->input('page', 1));
    $page_size = intval(request()->input('page_size', 10));

    $collection = $resource
      ->offset(($page - 1) * $page_size)
      ->limit($page_size)
      ->get();
    $response = parent::collection($collection);

    // meta generation
    $total = $resource->count();
    $total_page = ceil($total / $page_size);

    $last_modify = null;
    $last_modified_record = $resource->orderBy('updated_at', 'desc')->first();
    if ($last_modified_record) {
      $date = Carbon::createFromDate($last_modified_record->updated_at);
      $last_modify = $date->timestamp;
    }

    // return the data
    return [
      'data' => $response,
      'meta' => [
        'total' => $total,
        'page' => intval($page),
        'page_size' => intval($page_size),
        'total_page' => $total_page,
        'last_modified' => $last_modify,
      ],
    ];
  }

  public function withDates($data)
  {
    $data['created_at'] = Carbon::createFromDate($this->created_at)->timestamp;
    $data['updated_at'] = Carbon::createFromDate($this->updated_at)->timestamp;
    return $data;
  }
}
