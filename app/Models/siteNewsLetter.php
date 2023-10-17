<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siteNewsLetter extends Model
{
  use HasFactory;

  protected $table = 'site_news_letter';

  protected $fillable = ['id', 'locale', 'small_title', 'title', 'description', 'manager_name', 'info_manage', 'description_of_the_manager', 'manager_logo', 'created_at', 'updated_at'];

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

  protected function ManagerLogo(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => is_null($value) ? ImageHelper::defaultByType('news_letter.jpg') :  ImageHelper::getImg('news_letter', $value),
    );
  }
}
