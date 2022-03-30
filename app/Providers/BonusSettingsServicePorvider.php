<?php

namespace App\Providers;
use App\Models\Backend\BonusSettings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class BonusSettingsServicePorvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('bonus_settings', function(){
            return new BonusSettings();
        });
        $loader = AliasLoader::getInstance();
        $loader->alias('bonus_settings',BonusSettings::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if(!App::runningInConsole() && count(Schema::getColumnListing('bonus_settings'))){
            $settings = BonusSettings::all();
            foreach ($settings as $bonusSetting) {
                Config::set('bonus_settings.'.$bonusSetting->name,$bonusSetting->value);
            }
        }
    }
}
