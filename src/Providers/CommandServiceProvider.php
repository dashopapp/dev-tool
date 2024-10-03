<?php

namespace Dashopapp\DevTool\Providers;

use Dashopapp\Base\Supports\ServiceProvider;
use Dashopapp\DevTool\Commands\LocaleCreateCommand;
use Dashopapp\DevTool\Commands\LocaleRemoveCommand;
use Dashopapp\DevTool\Commands\Make\ControllerMakeCommand;
use Dashopapp\DevTool\Commands\Make\FormMakeCommand;
use Dashopapp\DevTool\Commands\Make\ModelMakeCommand;
use Dashopapp\DevTool\Commands\Make\PanelSectionMakeCommand;
use Dashopapp\DevTool\Commands\Make\RequestMakeCommand;
use Dashopapp\DevTool\Commands\Make\RouteMakeCommand;
use Dashopapp\DevTool\Commands\Make\SettingControllerMakeCommand;
use Dashopapp\DevTool\Commands\Make\SettingFormMakeCommand;
use Dashopapp\DevTool\Commands\Make\SettingMakeCommand;
use Dashopapp\DevTool\Commands\Make\SettingRequestMakeCommand;
use Dashopapp\DevTool\Commands\Make\TableMakeCommand;
use Dashopapp\DevTool\Commands\PackageCreateCommand;
use Dashopapp\DevTool\Commands\PackageMakeCrudCommand;
use Dashopapp\DevTool\Commands\PackageRemoveCommand;
use Dashopapp\DevTool\Commands\PluginCreateCommand;
use Dashopapp\DevTool\Commands\PluginMakeCrudCommand;
use Dashopapp\DevTool\Commands\RebuildPermissionsCommand;
use Dashopapp\DevTool\Commands\TestSendMailCommand;
use Dashopapp\DevTool\Commands\ThemeCreateCommand;
use Dashopapp\DevTool\Commands\WidgetCreateCommand;
use Dashopapp\DevTool\Commands\WidgetRemoveCommand;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            TableMakeCommand::class,
            ControllerMakeCommand::class,
            RouteMakeCommand::class,
            RequestMakeCommand::class,
            FormMakeCommand::class,
            ModelMakeCommand::class,
            PackageCreateCommand::class,
            PackageMakeCrudCommand::class,
            PackageRemoveCommand::class,
            TestSendMailCommand::class,
            RebuildPermissionsCommand::class,
            LocaleRemoveCommand::class,
            LocaleCreateCommand::class,
        ]);

        if (version_compare(get_core_version(), '7.0.0', '>=')) {
            $this->commands([
                PanelSectionMakeCommand::class,
                SettingControllerMakeCommand::class,
                SettingRequestMakeCommand::class,
                SettingFormMakeCommand::class,
                SettingMakeCommand::class,
            ]);
        }

        if (class_exists(\Dashopapp\PluginManagement\Providers\PluginManagementServiceProvider::class)) {
            $this->commands([
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }

        if (class_exists(\Dashopapp\Theme\Providers\ThemeServiceProvider::class)) {
            $this->commands([
                ThemeCreateCommand::class,
            ]);
        }

        if (class_exists(\Dashopapp\Widget\Providers\WidgetServiceProvider::class)) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
