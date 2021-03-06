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
    $fonts = Settings::getFontsList();
    $disable_shortcode = true;

    // Get all available templates.
    $current_template = $settings_data['app_template'];

    $app_templates = Settings::getTemplates('app_template', $settings_data['app_template']);
    $blog_templates = Settings::getTemplates('blog_template', $settings_data['blog_template']);
    $post_templates = Settings::getTemplates('post_template', $settings_data['post_template']);
    $page_templates = Settings::getTemplates('page_template', $settings_data['page_template']);
    $tag_templates = Settings::getTemplates('tag_template', $settings_data['tag_template']);
    $profile_templates = Settings::getTemplates('profile_template', $settings_data['profile_template']);

    // Get social icon info.
    if (isset($settings_data['socials'])) {
      $socials = unserialize($settings_data['socials']);
    } else {
      $socials = [];
    }
    return view('admin::partials.setting', compact('settings_data', 'fonts', 'disable_shortcode', 'app_templates', 'blog_templates', 'post_templates', 'page_templates', 'tag_templates', 'profile_templates', 'socials'))->withoutShortcodes();
  }

  /**
   * Store a newly created resource in storage.
   * @param Request $request
   * @return Renderable
   */
  public function store(Request $request) {
    $setting_keys = [
      'logo_title',
      'logo_svg',
      'favicon',
      'page_title',
      'meta_title',
      'post_page_title',
      'post_meta_title',
      'tag_page_title',
      'tag_meta_title',
      'profile_page_title',
      'profile_meta_title',
      'font_logo',
      'font_primary',
      'font_secondary',
      'tracker_script',
      'reg_en_fullname',
      'reg_en_verify_email',
      'notify_from_email',
      'template_email_confirm',
      'template_forgot_password',
      'app_template',
      'blog_template',
      'post_template',
      'page_template',
      'tag_template',
      'profile_template',
      'socials'
    ];

    $checkbox_keys = [
      'reg_en_fullname',
      'reg_en_verify_email'
    ];

    $validator = Validator::make($request->all(), [
        'logo_title' => 'required|max:30',
        'page_title' => 'required|max:70',
        'meta_title' => 'required|max:70',
        'post_page_title' => 'required|max:70',
        'post_meta_title' => 'required|max:70',
        'tag_page_title' => 'required|max:70',
        'tag_meta_title' => 'required|max:70',
        'profile_page_title' => 'required|max:100',
        'profile_meta_title' => 'required|max:100',
        'logo_svg' => 'required',
        'favicon' => 'required',
        'font_logo' => 'required',
        'font_primary' => 'required',
        'font_secondary' => 'required'
    ],
    $messages = [
      'required' => 'The :attribute field is required.',
      'max' => 'The :attribute field is too long!.',
    ]);

    if ($validator->fails()) {
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
      $default_val = '';
      if (in_array($key, $checkbox_keys)) {
        $default_val = 'off';
      }

      $req_param = !empty($request->input($key)) ? $request->input($key) : $default_val;

      if ($key == 'socials') {
        foreach($req_param as $idx => $social) {
          if (empty($social['icon']) && empty($social['link'])) {
            unset($req_param[$idx]);
          }
        }
        $req_param = serialize($req_param);
      }

      if (isset($settings_data[$key]))
        $update_data[$key] = $req_param;
      else
        $insert_data[] = array('key' => $key, 'value' => $req_param, 'created_at' => $dateNow, 'updated_at' => $dateNow);
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
