<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\siteNewsLetter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NewsLetterController extends Controller
{
  public function index()
  {
    $news_letter = siteNewsLetter::orderBy('locale')->get();
    return view('backEnd.content.news-letter.index', compact('news_letter'));
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "small_title_$locale"                => "required|string|max:255",
        "title_$locale"                      => "required|string|max:255",
        "description_$locale"                => "required|string|max:500",
        "manager_name_$locale"               => "required|string|max:255",
        "info_manage_$locale"                => "required|string|max:255",
        "description_of_the_manager_$locale" => "required|string|max:500",
        "manager_logo_$locale"               => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
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
        $news_letter = [
          'locale'                      => $locale,
          'small_title'                 => $request->input('small_title_' . $locale),
          'title'                       => $request->input('title_' . $locale),
          'description'                 => $request->input('description_' . $locale),
          'manager_name'                => $request->input('manager_name_' . $locale),
          'info_manage'                 => $request->input('info_manage_' . $locale),
          'description_of_the_manager'  => $request->input('description_of_the_manager_' . $locale),
        ];

        if ($request->hasFile('manager_logo_' . $locale)) {
          $news_letter['manager_logo'] = ImageHelper::UploadWithResizeImage($request->file('manager_logo_' . $locale), 'news_letter');
        }


        $checkRecord = siteNewsLetter::where('locale', $locale)->first();
        if ($checkRecord) {
          if ($request->hasFile('manager_logo_' . $locale)) {
            ImageHelper::deleteImg('news_letter', $checkRecord->getRawOriginal('manager_logo'));
          }

          $checkRecord->update($news_letter);
        } else {
          siteNewsLetter::create($news_letter);
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
