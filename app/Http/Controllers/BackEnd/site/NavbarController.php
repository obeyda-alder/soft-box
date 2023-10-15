<?php

namespace App\Http\Controllers\BackEnd\site;

use Exception;
use App\Models\siteNavbar;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\siteNavbarItem;
use Illuminate\Support\Facades\Validator;

class NavbarController extends Controller
{
  public function index()
  {
    $navbar = siteNavbar::orderBy('locale')->get();
    $navbarItem = siteNavbarItem::orderBy('locale')->get();

    return view('backEnd.content.navbar.index', compact(['navbar', 'navbarItem']));
  }

  public function return_and_update_navbar(Request $request)
  {
    $rules = [];
    foreach (array_keys(config('translatable.locales')) as $locale) {
      $rules += [
        "key_contact_$locale"  => "required|string|max:255",
        "phone_number_$locale" => "required|string|max:255",
        "item_title_$locale"   => "required|array",
        "item_title_$locale"   => "required|array",
        "logo_$locale"         => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
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
        $site_navbar = [
          'locale'        => $locale,
          'key_contact'   => $request->input('key_contact_' . $locale),
          'phone_number'  => $request->input('phone_number_' . $locale),
        ];


        if ($request->input('item_title_' . $locale)) {
          foreach ($request->input('item_title_' . $locale) as $key => $items) {
            $site_navbar_items[$key][$locale] = $items;
          }
        }

        if ($request->hasFile('logo_' . $locale)) {
          $site_navbar['logo'] = ImageHelper::UploadWithResizeImage($request->file('logo_' . $locale), 'navbar');
        }

        $checkRecord = siteNavbar::where('locale', $locale)->first();
        if ($checkRecord) {
          $checkRecord->update($site_navbar);
        } else {
          siteNavbar::create($site_navbar);
        }
      }

      if ($site_navbar_items) {
        foreach ($site_navbar_items as $key => $item) {
          collect($item)->map(function ($k, $v) use ($request, $key) {
            if (siteNavbarItem::where('locale', $v)->count() < 5) {
              $van_item = siteNavbarItem::create([
                'locale' => $v,
                'title'  => $k,
                'order'  => $request->order[$key]
              ]);
              $van_item->save();
            } else {
              $van_item_ = siteNavbarItem::where('order', $request->order[$key])->first();
              if ($van_item_) {
                $van_item_->locale = $v;
                $van_item_->title  = $k;
                $van_item_->order  = $request->order[$key];
                $van_item_->save();
              }
            }
          });
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
