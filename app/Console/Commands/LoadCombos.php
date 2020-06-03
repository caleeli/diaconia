<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LoadCombos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:combos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = DB::connection('mysql');
        $base = file_get_contents(database_path('migrations/2020_05_25_115457_create_combo_revision_table.php'));
        $baseModel = file_get_contents(app_path('ComboRevision.php'));
        $seeder = ['// INICIO'];
        $seederUse = ['use App\\ComboRevision;'];
        foreach ($connection->select('show tables') as $row) {
            $table = $row->Tables_in_emprender;
            if ($table === 'combo_revision') {
                continue;
            }
            if (substr($table, 0, 6) === 'combo_') {
                // migration
                $migration = database_path('migrations/2020_05_25_115458_create_' . $table . '_table.php');
                $code = str_replace('combo_revision', $table, $base);
                $class = ucfirst(camel_case("create_{$table}_table"));
                $code = str_replace('CreateComboRevisionTable', $class, $code);
                file_put_contents($migration, $code);
                // Model
                $class = ucfirst(camel_case($table));
                $path = app_path($class . '.php');
                $code = str_replace('combo_revision', $table, $baseModel);
                $code = str_replace('ComboRevision', $class, $code);
                file_put_contents($path, $code);
                // Seeder
                $seederUse[] = "use App\\{$class};";
                $seeder[] = "        {$class}::insert([";
                $rows = $connection->table($table)->get();
                foreach ($rows as $row) {
                    $seeder[] = "            ['valor' => '" . addslashes($row->valor) . "', 'descripcion' => '" . addslashes($row->descripcion) . "'],";
                }
                $seeder[] = "        ]);";
                //break;
            }
        }
        // save seeder
        $seeder[] = '        // FIN';
        $seederUse[] = 'use Illuminate\\Database\\Seeder;';
        $path = database_path('seeds/CombosSeeder.php');
        $code = file_get_contents($path);
        $code = preg_replace('/\/\/ INICIO[\w\W]+\/\/ FIN/', implode("\n", $seeder), $code);
        $code = preg_replace('/use App\\\\ComboRevision;[\w\W]+use Illuminate\\\\Database\\\\Seeder;/', implode("\n", $seederUse), $code);
        file_put_contents($path, $code);
    }
}
