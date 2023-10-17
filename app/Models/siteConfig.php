<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siteConfig extends Model
{
  use HasFactory;

  protected $table = 'site_config';

  protected $fillable = ['id', 'key', 'value', 'created_at', 'updated_at'];

  protected function CreatedAt(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => Carbon::parse($value)->format('Y-m-d h:i'),
      set: fn ($value) => Carbon::parse($value)->format('Y-m-d h:i'),
    );
  }

  protected function UpdatedAt(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => Carbon::parse($value)->format('Y-m-d h:i'),
      set: fn ($value) => Carbon::parse($value)->format('Y-m-d h:i'),
    );
  }

  protected function Value(): Attribute
  {
    return Attribute::make(
      get: function ($value) {
        if (Str::startsWith($this->key, 'logo_')) {
          // $locale = Str::replaceFirst('logo_', '', $this->key);
          // if ($locale == 'en' || $locale == 'ar') {
          return is_null($value) ? ImageHelper::defaultByType('configs.jpg') : ImageHelper::getImg('configs', $value);
          // }
        }
        return $value;
      }
    );
  }
}