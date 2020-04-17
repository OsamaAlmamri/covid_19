<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $timestamps = false;
}
//
/// Get the store instance
//setting();
//
//// Get values
//setting('foo');
//setting('foo.bar');
//setting('foo', 'default value');
//setting()->get('foo');
//
//// Set values
//setting(['foo' => 'bar']);
//setting(['foo.bar' => 'baz']);
//setting()->set('foo', 'bar');
//
//// Method chaining
//setting(['foo' => 'bar'])->save();

//
//Setting::set('foo', 'bar');
//Setting::get('foo', 'default value');
//Setting::get('nested.element');
//Setting::forget('foo');
//$settings = Setting::all();
//
?>
