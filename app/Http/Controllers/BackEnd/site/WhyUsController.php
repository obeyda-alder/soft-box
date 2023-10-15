<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Models\siteWhyUs;
use Illuminate\Http\Request;
use App\Models\siteWhyUsItems;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WhyUsController extends Controller
{
  public function index()
  {
    $us = [];
    $us['why_us'] = siteWhyUs::orderBy('locale')->get();
    $us['why_us_items'] = siteWhyUsItems::orderBy('locale')->get();
    return view('backEnd.content.why-us.index', compact('us'));
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "small_title_$locale" => "required|string|max:255",
        "title_$locale" => "required|string|max:255",
        "description_$locale" => "required|string|max:500",
        "item_title" => "required|array|min:3|max:3",
        "item_description" => "required|array|min:3|max:3",
        "*.item_title" => "array|string",
        "*.item_description" => "array|string",
        "box_title" => "required|array|min:3|max:3",
        "box_box_number" => "required|array|min:3|max:3",
        "*.box_title" => "array|string",
        "*.box_title" => "array|string",
      ];
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      $toReturn['message'] = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }

    try {
      $items = [];
      foreach (array_keys(config('translatable.locales')) as $locale) {
        $about_us = [
          'locale'      => $locale,
          'small_title' => $request->input('small_title_' . $locale),
          'title'       => $request->input('title_' . $locale),
          'description' => $request->input('description_' . $locale),
        ];

        $checkRecord = siteWhyUs::where('locale', $locale)->first();
        if ($checkRecord) {
          $checkRecord->update($about_us);
        } else {
          siteWhyUs::create($about_us);
        }

        foreach ($request->item_title[$locale] as $key => $title) {
          if (isset($request->item_description[$locale][$key])) {
            $items[] = [
              'locale'      => $locale,
              'type'        => 'ITEM',
              'title'       => $title,
              'description' => $request->item_description[$locale][$key],
            ];
          }
        }

        foreach ($request->box_title[$locale] as $key => $title) {
          if (isset($request->box_box_number[$locale][$key])) {
            $items[] = [
              'locale'      => $locale,
              'type'        => 'BOX',
              'title'       => $title,
              'box_number'  => $request->box_box_number[$locale][$key],
            ];
          }
        }
      }

      siteWhyUsItems::truncate();
      foreach ($items as $item) {
        siteWhyUsItems::create($item);
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
