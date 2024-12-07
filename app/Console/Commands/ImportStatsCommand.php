<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Models\Campaign;
use App\Models\Term;
use App\Models\Stat;

class ImportStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-stats {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import stats from a CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        $path = storage_path($filename);

        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            return 1;
        }

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $records = iterator_to_array($csv->getRecords());

        # Get count of record
        $progressBar = $this->output->createProgressBar(count($records));
        $progressBar->start();

        foreach ($records as $record) {
            $progressBar->advance();
            // Skip if utm_campaign or utm_term is empty
            if (empty($record['utm_campaign']) || empty($record['utm_term']) || strtolower($record['utm_campaign']) == 'null' || strtolower($record['utm_term']) == 'null') {
                continue;
            }

            // Find campaign
            $campaign = Campaign::where('utm_campaign', $record['utm_campaign'])->first();

            // Find or create term
            $term = Term::firstOrCreate([
                'name' => $record['utm_term']
            ]);

            if ($campaign){
                // Create stat record
                Stat::create([
                    'campaign_id' => $campaign->id,
                    'term_id' => $term->id,
                    'revenue' => $record['revenue'],
                    'timestamp' => $record['monetization_timestamp'],
                ]);
            }
        }

        $progressBar->finish();

        $this->info('Stats imported successfully');
        return 0;
    }
}
