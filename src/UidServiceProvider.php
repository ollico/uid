<?php

namespace Ollico\Uid;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class UidServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/uid.php' => config_path('uid.php'),
        ]);

        Blueprint::macro('uid', function(?string $columnName = null): void {
            $name = $columnName ?: Config::get('uid.column_name');

            $this->string($name, Config::get('uid.column_length'))
                ->nullable()
                ->default(null)
                ->unique()
                ->index();
        });

        Blueprint::macro('dropUid', function(?string $columnName = null): void {
            $this->dropColumn($columnName ?: Config::get('uid.column_name'));
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/uid.php', 'uid'
        );
    }
}
