<?php namespace Waka\SpatieBu;

use System\Classes\PluginBase;
use App;

/**
 * wbu Plugin Information File
 */
class Plugin extends PluginBase
{
    
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'waka.spatiebu::lang.plugin.name',
            'description' => 'waka.spatiebu::lang.plugin.description',
            'author'      => 'waka',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {
        App::register(\Spatie\Backup\BackupServiceProvider::class);
        $registeredAppPathConfig = require __DIR__ . '/config/backup.php';
        $registeredWcliAppPath = plugins_path('wcli/wconfig/config/backup.php');
        if (file_exists($registeredWcliAppPath)) {
            $registeredWcliAppPathConfig = require $registeredWcliAppPath;
            \Config::set('backup', $registeredWcliAppPathConfig);
        } else {
            \Config::set('backup', $registeredAppPathConfig);
        }

    }
}
