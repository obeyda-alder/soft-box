<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\sitePortfolio;
use App\Models\sitePortfolioImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
  public function index()
  {
    $portfolios = [];
    $portfolios['portfolios'] = sitePortfolio::orderBy('locale')->get();
    $portfolios['portfolios_images'] = sitePortfolioImages::orderBy('locale')->get();
    return view('backEnd.content.portfolio.index', compact('portfolios'));
  }

  public function saveTabs(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "tab_title_$locale" => "required|string|max:255",
        "tab_name_$locale" => "required|string|max:255",
        "tab_description_$locale" => "required|string|max:500",
        "tab_image_$locale" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
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
        $portfolios_images = [
          'locale'      => $locale,
          'title' => $request->input('tab_title_' . $locale),
          'tab_name'       => $request->input('tab_name_' . $locale),
          'description' => $request->input('tab_description_' . $locale),
        ];

        if ($request->hasFile('tab_image_' . $locale)) {
          $portfolios_images['image'] = ImageHelper::UploadWithResizeImage($request->file('tab_image_' . $locale), 'portfolio_images');
        }

        sitePortfolioImages::create($portfolios_images);
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

  public function saveSection(Request $request)
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
        $portfolios = [
          'locale'      => $locale,
          'small_title' => $request->input('small_title_' . $locale),
          'title'       => $request->input('title_' . $locale),
          'description' => $request->input('description_' . $locale),
        ];

        $checkRecord = sitePortfolio::where('locale', $locale)->first();
        if ($checkRecord) {
          $checkRecord->update($portfolios);
        } else {
          sitePortfolio::create($portfolios);
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

  public function dataImages()
  {
    return sitePortfolioImages::orderBy('locale')->get();
  }

  public function deleteImages(Request $request)
  {
    try {
      $portfolios_images = sitePortfolioImages::findOrFail($request->card_id);
      $portfolios_images->delete();

      ImageHelper::deleteImg('portfolio_images', $portfolios_images->getRawOriginal('image'));

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