<?php

namespace App\Http\Controllers;

use Illuminate\Encryption\Encrypter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstallationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Installation Controller
    |--------------------------------------------------------------------------
    |
    */

    public function __construct()
    {
        if ($this->isInstalled()) {
            abort(404);
        }
    }

    /**
     * Check for installation
     */
    public static function isInstalled()
    {
        return (\File::exists(base_path('.env'))) ? true : false;
    }

    /**
     * Installation view
     */
    public function getInstall(): View
    {
        return view('installation.install');
    }

    /**
     * Post installation
     */
    public function postInstall(Request $request): RedirectResponse
    {
        $email = $request->input('email', '');
        $pass = $request->input('pass', '');

        $APP_URL = $request->input('APP_URL', '');
        $APP_KEY = 'base64:'.base64_encode(
            Encrypter::generateKey(config('app.cipher'))
        );

        // Get .env.example file as blueprint
        $env = \File::get(base_path('.env.example'));

        $all = $request->except(['email', 'pass']);
        $all['APP_KEY'] = $APP_KEY;
        $all['APP_HOST'] = str_replace(['http://', 'https://'], '', $APP_URL);
        $all['DEBUG_EMAIL'] = $email;
        $all['APP_DEBUG'] = 'false';
        $all['APP_ENV'] = 'production';

        // Loop through .env.example and set config
        $new_env = '';

        foreach (preg_split("/((\r?\n)|(\r\n?))/", $env) as $line) {
            $cfg_found = false;

            foreach ($all as $key => $value) {
                if (starts_with($line, $key.'=')) {
                    $cfg_found = true;
                    if ($value == 'true' || $value == 'false' || is_numeric($value)) {
                        $new_env .= $key.'='.$value.''.PHP_EOL;
                    } else {
                        $new_env .= $key.'="'.$value.'"'.PHP_EOL;
                    }
                }
            }

            if (! $cfg_found) {
                $new_env .= $line.PHP_EOL;
            }
        }

        \File::put(base_path('.env'), $new_env);

        \Artisan::call('config:cache');

        \Artisan::call('migrate', [
            '--seed' => true,
            '--force' => true,
        ]);

        $user = \App\User::find(1);
        $user->email = $email;
        $user->password = bcrypt($pass);
        $user->save();

        return redirect(url('/'));
    }
}
