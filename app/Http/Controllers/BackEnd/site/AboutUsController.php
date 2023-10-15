<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Models\siteAboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
  public function index()
  {
    $about_us = siteAboutUs::orderBy('locale')->get();
    return view('backEnd.content.aboutUs.index', compact('about_us'));
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "small_title_$locale" => "required|string|max:255",
        "title_$locale" => "required|string|max:255",
        "small_description_$locale" => "required|string|max:500",
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
        $about_us = [
          'locale'      => $locale,
          'small_title' => $request->input('small_title_' . $locale),
          'title'       => $request->input('title_' . $locale),
          'small_description' => $request->input('small_description_' . $locale),
          'description' => $request->input('description_' . $locale),
        ];

        $checkRecord = siteAboutUs::where('locale', $locale)->first();
        if ($checkRecord) {
          $checkRecord->update($about_us);
        } else {
          siteAboutUs::create($about_us);
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
