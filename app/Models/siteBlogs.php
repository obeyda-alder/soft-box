<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siteBlogs extends Model
{
  use HasFactory;

  protected $table = 'site_blogs';

  protected $fillable = [
    'id',
    'locale',
    'title',
    'slug',
    'content',
    'excerpt',
    'author',
    'published_at',
    'status',
    'views',
    'likes',
    'logo',
    'created_at',
    'updated_at'
  ];

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

  protected function Logo(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => is_null($value) ? ImageHelper::defaultByType('blogs.jpg') :  ImageHelper::getImg('blogs', $value),
    );
  }
}
