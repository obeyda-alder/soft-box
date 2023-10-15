<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\siteOurServices;
use App\Http\Controllers\Controller;
use App\Models\siteOurServicesSliders;
use Illuminate\Support\Facades\Validator;

class OurServicesController extends Controller
{
  public function index()
  {
    $services = [];
    $services['our_services'] = siteOurServices::orderBy('locale')->get();
    $services['our_services_sliders'] = siteOurServicesSliders::orderBy('locale')->get();
    return view('backEnd.content.our-services.index', compact('services'));
  }
  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "small_title_$locale" => "required|string|max:255",
        "title_$locale" => "required|string|max:255",
        "description_$locale" => "required|string|max:500",
        "*.slide_title" => "array|string|max:255",
        "*.logo_slider" => "array|image|mimes:jpeg,png,jpg,gif|max:2048",
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
      $sliders = [];

      foreach (array_keys(config('translatable.locales')) as $locale) {
        $ourServicesData = [
          'locale' => $locale,
          'small_title' => $request->input('small_title_' . $locale),
          'title' => $request->input('title_' . $locale),
          'description' => $request->input('description_' . $locale),
        ];

        $ourService = siteOurServices::where('locale', $locale)->first();

        if ($ourService) {
          $ourService->update($ourServicesData);
        } else {
          siteOurServices::create($ourServicesData);
        }

        foreach ($request->slide_title[$locale] as $key => $title) {
          if (isset($request->logo_slider[$locale][$key])) {
            $uploadedLogo = ImageHelper::UploadWithResizeImage($request->logo_slider[$locale][$key], 'our_services_sliders');
            $sliders[] = [
              'title' => $title,
              'locale' => $locale,
              'logo' => $uploadedLogo,
            ];
          }
        }
      }

      foreach ($sliders as $slider) {
        $slid = new siteOurServicesSliders;
        $slid->locale = $slider['locale'];
        $slid->title = $slider['title'];
        $slid->logo = $slider['logo'];
        $slid->save();
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
    return siteOurServicesSliders::orderBy('locale')->get();
  }

  public function delete(Request $request)
  {
    try {
      $header = siteOurServicesSliders::findOrFail($request->card_id);
      $header->delete();

      ImageHelper::deleteImg('our_services_sliders', $header->getRawOriginal('logo'));

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
