<?php

namespace Modules\Admin\Http\Controllers;

use Arr, Str, Image, File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Settings;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller {
  public function index() {
    $settings_data = Settings::getSiteSettings();
    return view('admin::partials\setting', compact('settings_data'))->withoutShortcodes();
  }

  /**
   * Store a newly created resource in storage.
   * @param Request $request
   * @return Renderable
   */
  public function store(Request $request) {
    $setting_keys = array (
      'logo_title',
      'logo_svg',
      'favicon',
      'page_title',
      'meta_title',
      'post_page_title',
      'post_meta_title',
      'tag_page_title',
      'tag_meta_title',
    );

    $validator = Validator::make($request->all(), [
        'logo_title' => 'required|max:30',
        'page_title' => 'required|max:70',
        'meta_title' => 'required|max:70',
        'post_page_title' => 'required|max:70',
        'post_meta_title' => 'required|max:70',
        'tag_page_title' => 'required|max:70',
        'tag_meta_title' => 'required|max:70',
        'logo_svg' => 'required',
        'favicon' => 'required',
    ],
    $messages = [
      'required' => 'The :attribute field is required.',
      'max' => 'The :attribute field is too long!.',
    ]);

    if ($validator->fails()) {
      // return redirect('admin/settings')->withErrors($validator)->withInput();
      return response()->json([
        'status' => false,
        'message' => 'Setting Data has been saved!',
        'errors' => $validator->errors()
      ]);
    }

    // get existing settings data
    $settings_data = Settings::getSiteSettings();

    // check if setting data is already added to database
    $dateNow = now();

    $insert_data = array();
    $update_data = array();
    foreach ($setting_keys as $key) {
      if (isset($settings_data[$key]))
        $update_data[$key] = $request->input($key);
      else
        $insert_data[] = array('key' => $key, 'value' => $request->input($key), 'created_at' => $dateNow, 'updated_at' => $dateNow);
    }

    if (count($insert_data) > 0) {
      // do insert action
      Settings::insert($insert_data);
    }

    if (count($update_data) > 0) {
      foreach ($update_data as $key => $value) {
        $row = Settings::where('key', $key);
        $row->update(['value' => $value]);
      }
    }
    
    return response()->json([
      'status' => true,
      'message' => 'Setting Data has been saved!',
      'data' => $update_data
    ]);
  }
}
