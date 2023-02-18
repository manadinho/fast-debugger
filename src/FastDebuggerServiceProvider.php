<?php
namespace Manadinho\FastDebugger;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

class FastDebuggerServiceProvider extends ServiceProvider{

    public function boot()
    {
        if (! $this->app->has('blade.compiler')) {
            return $this;
        }
    
        $this->callAfterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            Blade::directive('fast', function ($expression) {
                return "<?php fast($expression); ?>";
            });
        });
    
        return $this;
    }

    public function register()
    {
        
    }
}