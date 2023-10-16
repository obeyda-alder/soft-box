<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Models\siteFooter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FooterController extends Controller
{
  public function index()
  {
    $footer = siteFooter::orderBy('locale')->get();
    return view('backEnd.content.footer.index', compact('footer'));
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "copy_right_$locale"    => "required|string|max:255",
        "phone_number_$locale"  => "required|string|max:255",
        "email_$locale"         => "required|string|max:255",
        "working_hours_$locale" => "required|string|max:500",
        "address_$locale"       => "required|string|max:500",
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
      foreach (array_keys(config('translatable.locales')) as $locale) {
        $footer = [
          'locale'          => $locale,
          'copy_right'      => $request->input('copy_right_' . $locale),
          'phone_number'    => $request->input('phone_number_' . $locale),
          'email'           => $request->input('email_' . $locale),
          'working_hours'   => $request->input('working_hours_' . $locale),
          'address'         => $request->input('address_' . $locale),
        ];

        $checkRecord = siteFooter::where('locale', $locale)->first();
        if ($checkRecord) {
          $checkRecord->update($footer);
        } else {
          siteFooter::create($footer);
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
