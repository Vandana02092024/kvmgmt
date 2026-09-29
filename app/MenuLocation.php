<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;
class MenuLocation extends Model
{
    protected $fillable = [
        'location_id',
        'menu_id',
        'status',
    ];

   //  public function menus()
   // {
   //     return $this->belongsTo('App\Menu','menu_id','id');
   // }

   // public function menu()
   // {
   //     return Menu::where('status',1)->get();
   // }
}
