<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\siteBlogs;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
  public function index()
  {
    return view('backEnd.content.blogs.index');
  }

  public function save(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "title_$locale"         => "required|string|max:255",
        "slug_$locale"          => "required|string|max:50",
        "content_$locale"       => "required|string",
        "published_at_$locale"  => "required|date",
        "excerpt_$locale"       => "required|string",
        "status_$locale"        => "required|in:active,unactive",
        "author_$locale"        => "required|string|max:255",
        "logo_$locale"          => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
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
        $blogs = [
          'locale'        => $locale,
          'title'         => $request->input('title_' . $locale),
          'slug'          => $request->input('slug_' . $locale),
          'content'       => $request->input('content_' . $locale),
          'excerpt'       => $request->input('excerpt_' . $locale),
          'author'        => $request->input('author_' . $locale),
          'published_at'  => $request->input('published_at_' . $locale),
          'status'        => $request->input('status_' . $locale),
        ];

        if ($request->hasFile('logo_' . $locale)) {
          $blogs['logo'] = ImageHelper::UploadWithResizeImage($request->file('logo_' . $locale), 'blogs');
        }

        siteBlogs::create($blogs);
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
    return siteBlogs::orderBy('locale')->get();
  }

  public function delete(Request $request)
  {
    try {
      $blogs = siteBlogs::findOrFail($request->card_id);
      $blogs->delete();

      ImageHelper::deleteImg('blogs', $blogs->getRawOriginal('logo'));

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
