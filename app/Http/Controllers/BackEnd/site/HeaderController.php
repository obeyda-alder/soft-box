<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Models\siteHeaders;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HeaderController extends Controller
{
  public function index()
  {
    return view('backEnd.content.header.index');
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "slide_small_title_$locale" => "required|string|max:255",
        "slide_title_$locale" => "required|string|max:255",
        "slide_description_$locale" => "nullable|string|max:500",
        "slid_image_$locale" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
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
        $site_headers = [
          'locale'      => $locale,
          'small_title' => $request->input('slide_small_title_' . $locale),
          'title'       => $request->input('slide_title_' . $locale),
          'description' => $request->input('slide_description_' . $locale),
        ];

        if ($request->hasFile('slid_image_' . $locale)) {
          $site_headers['logo'] = ImageHelper::UploadWithResizeImage($request->file('slid_image_' . $locale), 'headers');
        }

        siteHeaders::create($site_headers);
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

  public function data()
  {
    return siteHeaders::orderBy('locale')->get();
  }

  public function delete(Request $request)
  {
    try {
      $header = siteHeaders::findOrFail($request->card_id);
      $header->delete();

      ImageHelper::deleteImg('headers', $header->getRawOriginal('logo'));

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
