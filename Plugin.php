<?php namespace Jhendess\RestrictAccess;

use App;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use System\Classes\PluginBase;

/**
 * RestrictAccess Plugin Information File
 */
class Plugin extends PluginBase {

    public $require = ['KurtJensen.Passage'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails() {
        return [
            'name' => 'RestrictAccess',
            'description' => 'Restrict access to single pages using access rights from the passage plugin. Provides also an error handler which redirects 403 errors to /403',
            'author' => 'Jakob Hendeß',
            'icon' => 'icon-files-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register() {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot() {
        App::error(function (AccessDeniedHttpException $exception) {
            return \Redirect::to("/");
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents() {
        return [
            'Jhendess\RestrictAccess\Components\RestrictAccess' => 'restrictAccess'
        ];
    }

    /**
     * Register as snippets for static page.
     * @return array
     */
    public function registerPageSnippets() {
        return $this->registerComponents();
    }
}
