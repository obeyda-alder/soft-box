<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siteLanguages extends Model
{
  use HasFactory;

  protected $table = 'site_languages';

  protected $fillable = ['id', 'code', 'name', 'status', 'created_at', 'updated_at'];

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

  public static function getLanguageData($status = true)
  {
    return self::where('status', $status)->pluck('name', 'code')->toArray();
  }
}
