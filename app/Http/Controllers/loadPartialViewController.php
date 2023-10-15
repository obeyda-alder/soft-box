<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loadPartialViewController extends Controller
{
  public function loadPartial(Request $request)
  {
    $data = [
      '_id'           => $request->_id,
      'title'         => $request->title,
      'placeholder'   => $request->placeholder,
      'help'          => $request->help,
      'icon'          => $request->icon,
      'input_type'    => $request->input_type,
      'input_name'    => $request->input_name,
      'has_count'     => $request->has_count,
      'count_name'    => $request->count_name,
      'count_value'   => $request->count_value,
    ];

    if ($request->type == "input") {
      $html = view('_partials.input', $data)->render();
    }

    return response()->json(['html' => $html]);
  }
}
