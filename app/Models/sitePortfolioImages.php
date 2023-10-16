<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sitePortfolioImages extends Model
{
  use HasFactory;

  protected $table = 'site_portfolio_images';

  protected $fillable = ['id', 'locale', 'title', 'description', 'tab_name', 'image', 'created_at', 'updated_at'];

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

  protected function Image(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => is_null($value) ? ImageHelper::defaultByType('portfolio_images.jpg') :  ImageHelper::getImg('portfolio_images', $value),
    );
  }
}
