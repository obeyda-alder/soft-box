<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use App\Models\siteNavbarItem;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siteNavbar extends Model
{
  use HasFactory;

  protected $table = 'site_navbars';

  protected $fillable = ['id', 'logo', 'locale', 'key_contact', 'phone_number', 'created_at', 'updated_at'];

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
      get: fn ($value) => is_null($value) ? ImageHelper::defaultByType('navbar.jpg') :  ImageHelper::getImg('navbar', $value),
    );
  }

  // public function items()
  // {
  //   return $this->hasMany(siteNavbarItem::class, 'navbar_id');
  // }
}