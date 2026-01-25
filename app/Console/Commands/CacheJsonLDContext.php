<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class CacheJsonLDContext extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activitypub:cache-json-ld';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and cache JSON-LD contexts defined in config/jsonld.php';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storagePath = resource_path('jsonld/context/');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        $contextMap = config('jsonld.contextMap');

        foreach ($contextMap as $url => $path) {
            $this->info('Downloading ' . $url . ' to ' . $path);

            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/ld+json, application/json'
                ])->get($url);

                // Wait for the response if it's a Promise
                if (!$response instanceof Response) {
                    $response = $response->wait();
                }

                if ($response->failed()) {
                    $this->error('Failed to download ' . $url . ': ' . $response->status());
                    continue;
                }

                File::put($path, $response->body());
                $this->info('Downloaded ' . $url . ' to ' . $path);

            } catch (\Exception $e) {
                $this->error('Failed to download ' . $url . ': ' . $e->getMessage());
            }
        }
    }
}
