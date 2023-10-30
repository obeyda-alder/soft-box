<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\siteLatestInCrope;
use Illuminate\Support\Facades\Validator;

class LatestInCropeController extends Controller
{
  public function index()
  {
    $latest_in_crope = siteLatestInCrope::orderBy('locale')->get();
    return view('backEnd.content.latest-in-crope.index', compact('latest_in_crope'));
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "small_title_$locale" => "required|string|max:255",
        "title_$locale" => "required|string|max:255",
        "description_$locale" => "required|string|max:500",
      ];
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      $toReturn['message']               = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }

    try {
      foreach (array_keys(config('translatable.locales')) as $locale) {
        $latest_in_crope = [
          'locale'        => $locale,
          'small_title'   => $request->input('small_title_' . $locale),
          'title'         => $request->input('title_' . $locale),
          'description'   => $request->input('description_' . $locale),
        ];

        $checkRecord = siteLatestInCrope::where('locale', $locale)->first();
        if ($checkRecord) {
          $checkRecord->update($latest_in_crope);
        } else {
          siteLatestInCrope::create($latest_in_crope);
        }
      }

      return response()->json([
        'success' => true,
        'message' => 'successfully saved',
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'error' => $e->getMessage(),
        'message' => 'you hava some error'
      ], 401);
    }
  }
}
