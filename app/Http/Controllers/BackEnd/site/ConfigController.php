<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\siteConfig;
use App\Models\siteLanguages;
use Illuminate\Http\Request;
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

  public function addConfig(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'key'   => 'required|string|max:100',
      'value' => 'string|max:100',
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
      if ($request->has('key')) {
        $checkRecord = siteConfig::where('key', $request->key)->first();
        if ($checkRecord) {
          $checkRecord->update([
            'value' => $request->value ?? false
          ]);
        } else {
          siteConfig::create(
            [
              'key'   => $request->key,
              'value' => $request->value ?? false
            ]
          );
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
