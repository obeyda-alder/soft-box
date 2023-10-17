<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Models\siteConfig;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\siteLanguages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
  public function index(Request $request)
  {
    $config = siteConfig::get();
    return view('backEnd.content.config.index', compact('config'));
  }

  public function languages()
  {
    $languages = siteLanguages::get();
    return view('backEnd.content.config.languages', compact('languages'));
  }

  public function addLanguages(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'code' => 'required|string|max:10',
      'name' => 'required|string|max:100',
    ]);

    if ($validator->fails()) {
      $toReturn['message'] = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }

    try {
      siteLanguages::updateOrCreate(
        ['code' => $request->code],
        [
          'name' => $request->name,
          'status' => true,
        ]
      );

      return response()->json([
        'success' => true,
        'message' => 'Successfully saved'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  public function editLanguages(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id'      => 'required|exists:site_languages,id',
      'code'    => 'required|string|max:10|unique:site_languages,code,' . $request->id,
      'name'    => 'required|string|max:100',
      'status'  => 'nullable|string',
    ]);

    if ($validator->fails()) {
      $toReturn['message'] = 'fail';
      $messages = $validator->messages()->toArray();
      foreach ($messages as $key => $value) {
        $toReturn['errors'][$key] = $value[0];
      }
      return response()->json($toReturn, 200);
    }

    try {
      $languages = siteLanguages::findOrFail($request->id);
      if ($languages) {
        $languages->update([
          'code'    => $request->code,
          'name'    => $request->name,
          'status'  => $request->has('status') && $request->status == "on" ? true : false
        ]);
        $languages->save();
      }

      return response()->json([
        'success' => true,
        'message' => 'Successfully saved'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  protected function _validationConfig($request)
  {
    $rules = [];

    if ($request->input('key') === "status") {
      $rules['key'] = 'required|string|max:100';
      $rules['value'] = 'required|string|max:100';
    } elseif ($request->input('key') === "logo") {
      $rules['key'] = 'required|array';
      $rules['key.*'] = 'string|max:100';
      $rules['value'] = 'required|array';
      $rules['value.*'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
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
  }

  protected function _sortData($request)
  {
    $keys = $request->key;
    $values = $request->value ?? false;

    if (is_array($request->key)) {
      $keys = [];
      $values = [];
      foreach (array_keys(config('translatable.locales')) as $locale) {
        $keys[] = $request->key[$locale] . '_' . $locale;
        $values[] = ImageHelper::UploadWithResizeImage($request->value[$locale], 'configs');
      }
    } else {
      $keys = $keys;
      $values = $values;
    }

    return [
      'keys' => $keys,
      'values' => $values,
    ];
  }

  public function addConfig(Request $request)
  {
    $this->_validationConfig($request);

    try {
      $data = $this->_sortData($request);

      if (isset($data['keys']) && is_array($data['keys'])) {
        foreach ($data['keys'] as $index => $key) {
          $checkRecord = siteConfig::where('key', $key)->first();
          if ($checkRecord) {
            ImageHelper::deleteImg('configs', $checkRecord->getRawOriginal('value'));
            $checkRecord->update([
              'value' => $data['values'][$index] ?? false,
            ]);
          } else {
            siteConfig::create([
              'key' => $key,
              'value' => $data['values'][$index] ?? false,
            ]);
          }
        }
      } else {
        $checkRecord = siteConfig::where('key', $data['keys'])->first();
        if ($checkRecord) {
          $checkRecord->update([
            'value' => $data['values'],
          ]);
        } else {
          siteConfig::create([
            'key' => $data['keys'],
            'value' => $data['values'],
          ]);
        }
      }

      return response()->json([
        'success' => true,
        'message' => 'Successfully saved',
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'error' => $e->getMessage(),
      ], 500);
    }
  }


  public function deleteLanguages(Request $request)
  {
    try {
      $languages = siteLanguages::findOrFail($request->lang_id);
      $languages->delete();

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