<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siteOurServicesSliders extends Model
{
  use HasFactory;

  protected $table = 'site_our_services_sliders';

  public $timestamps = false;

  protected $fillable = ['id', 'locale', 'title', 'logo'];

  protected function Logo(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => is_null($value) ? ImageHelper::defaultByType('our_services_sliders.jpg') :  ImageHelper::getImg('our_services_sliders', $value),
    );
  }
}
