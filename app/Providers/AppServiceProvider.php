<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade; // Mengimpor facade Blade untuk mendaftarkan direktif custom
use Illuminate\Support\ServiceProvider; // Mengimpor class ServiceProvider sebagai kelas dasar

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Di sini biasanya akan mendaftarkan binding dalam container, namun tidak ada yang dilakukan di sini
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mendaftarkan direktif custom 'moneyFormat' untuk digunakan di Blade
        Blade::directive('moneyFormat', function ($amount) {
            // Mengembalikan string PHP untuk memformat jumlah uang dalam format Rp
            return "<?php echo 'Rp' . number_format($amount, 0, ',', '.'); ?>";
        });
    }
}
