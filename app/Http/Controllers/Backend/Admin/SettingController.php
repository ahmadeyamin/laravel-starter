<?php

namespace App\Http\Controllers\Backend\Admin;

use Storage;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.admin.setting.index');
    }

    public function update(Request $r)
    {
        // return $r;

        switch ($r->action) {
            case 'basic':
                return $this->basic($r);
                break;
            case 'env':
                return $this->env($r);
                break;
            case 'integration':
                return $this->integration($r);
                break;
            default:
                return abort(404);
                break;
        }
    }

    public function basic($r)
    {
        Setting::set('app.title',$r->filled('app_title') ? $r->get('app_title') : null);
        Setting::set('app.description',$r->filled('app_description') ? $r->get('app_description') : null);
        Setting::set('app.email',$r->filled('app_email') ? $r->get('app_email') : null);
        Setting::set('app.tags',$r->filled('app_tags') ? $r->get('app_tags') : null);

        if ($r->hasFile('app_logo')) {
            Storage::disk('public')->delete(Setting::get('app.logo'));
            Setting::set('app.logo',Storage::disk('public')->putFile('logos', $r->file('app_logo')));
        }

        return redirect()->back()->withInput(['basic'])->with('success','Website Settings Updated');
    }

    public function env($r)
    {
        foreach ($r->except(['_token','action']) as $key => $value) {
            Setting::set($key,$r->filled($key) ? $value : null);
        }

        // Artisan::call("env:set MAIL_PORT='". $r->mail_port ."'");
        // Artisan::call("env:set MAIL_MAILER='". $r->mail_mailer ."'");
        // Artisan::call("env:set MAIL_HOST='". $r->mail_host ."'");
        // Artisan::call("env:set MAIL_USERNAME='". $r->mail_username ."'");
        // Artisan::call("env:set MAIL_PASSWORD='". $r->mail_password ."'");
        // Artisan::call("env:set MAIL_ENCRYPTION='". $r->mail_encryption ."'");
        // Artisan::call("env:set MAIL_FROM_NAME='". $r->mail_from_name ."'");
        // Artisan::call("env:set MAIL_FROM_ADDRESS='". $r->mail_from_address ."'");

        return redirect()->back()->withInput(['env'])->with('success','Website Settings Updated');
    }

    public function integration($r)
    {

        foreach ($r->except(['_token','action']) as $key => $value) {
            $r->filled($key) ? Setting::set($key,$value) : '';
        }

        // Artisan::call("env:set FACEBOOK_CLIENT_ID='". $r->facebook_client_id ."'");
        // Artisan::call("env:set FACEBOOK_CLIENT_SECRET='". $r->facebook_client_secret ."'");
        // Artisan::call("env:set TWITTER_CLIENT_ID='". $r->twitter_client_id ."'");
        // Artisan::call("env:set TWITTER_CLIENT_SECRET='". $r->twitter_client_secret ."'");
        // Artisan::call("env:set GITHUB_CLIENT_ID='". $r->github_client_id ."'");
        // Artisan::call("env:set GITHUB_CLIENT_SECRET='". $r->github_client_secret ."'");

        return redirect()->back()->withInput(['integration'])->with('success','Website Settings Updated');
    }
}
