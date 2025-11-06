<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Lib\Env;
use Str;
use Session;

class SystemConfigurationController extends Controller
{
    /**
     * Constructor
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        //this middleware should be for POST request only
        if ($request->isMethod('post')) {
            $this->middleware('checkForDemoMode')->only('settings');
        }
    }

    /**
     * Show the form for configuring system configurations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request)
    {
        $data = [
            'list_menu' => 'system_configurations'
        ];
        
        if ($request->isMethod('post')) {

            // Update Environment Settings
            $this->updateEnvVariable('APP_ENV', $request->system_environment === 'local' ? 'local' : 'production');
            $this->updateEnvVariable('APP_DEBUG', $request->debug_mode === '0' ? 'false' : 'true');
            
            if ($request->maintenance == 'true') {
                $secret = Str::random(20);

                Artisan::call('down', ['--secret' => $secret]);

                Session::flash('success', __('Maintenance mode successfully updated.'));

                return redirect('admin/maintenance-mode?bypass_key=' . $secret);

            } else if($request->maintenance == 'false') {
                Artisan::call('up');
            }

            Session::flash('success', __('The :x has been successfully saved.', ['x' => __('System configuration')]));
            return back();
        }

        if (app()->isDownForMaintenance()) {
            $maintenance = json_decode(file_get_contents(storage_path() . '/framework/down'), true);
            $data['secret'] = $maintenance['secret'];
        }

        return view('admin.system.system-configuration', $data);
    }


    /**
     * Updates the value of a given key in the .env file if the new value and the current value
     * match a certain condition.
     *
     * @param string $key
     * @param string $newValue
     * @param string $trueValue
     * @param string $currentValue
     */
    private function updateEnvVariable($key, $value)
    {
        Env::set($key, $value);
    }
}
