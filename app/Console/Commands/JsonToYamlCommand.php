<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\File;

class JsonToYamlCommand extends Command
{
    protected $signature = 'json:yaml {inputFile=storage/app/anybox.json} {outputFile=storage/app/output.yml}';

    protected $description = 'Converts a JSON file to a YAML file with a custom structure compatible with static-marks';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $inputFile = $this->argument('inputFile');
        $outputFile = $this->argument('outputFile');

        if (!File::exists($inputFile)) {
            $this->error('Input file not found.');
            return 1;
        }

        $jsonContent = File::get($inputFile);
        $jsonData = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON content.');
            return 1;
        }

        // Filter out bookmarks with empty or whitespace-only titles
        $jsonData = array_filter($jsonData, function($bookmark) {
            return trim($bookmark['title']) !== '' && trim($bookmark['title']) !== '-';
        });

        $transformedData = $this->transformJsonToCompatibleYaml($jsonData);
        $yamlContent = $this->arrayToYaml(['Bookmarks' => $transformedData], 0);
        File::put($outputFile, $yamlContent);

        $this->info('Successfully converted JSON to custom YAML.');

        return 0;
    }

    private function transformJsonToCompatibleYaml(array $jsonData)
    {
        $yamlData = [];

        foreach ($jsonData as $bookmark) {
            $title = preg_replace('/[^A-Za-z0-9\s\-\|]+/', '', $bookmark['title']);
            $title = str_replace('|', ' ', $title);
            $title = str_replace('-', '', $title);
            $url = $bookmark['url'];

            $collections = $bookmark['collections'];

            foreach ($collections as $collection) {
                if (!array_key_exists($collection, $yamlData)) {
                    $yamlData[$collection] = [];
                }

                $yamlData[$collection][$title] = $url;
            }
        }

        return $yamlData;
    }


    private function arrayToYaml($array, $indent, $isListItem = false)
    {
        $yaml = '';
        $indentation = str_repeat('  ', $indent);

        foreach ($array as $key => $value) {
            if (trim($key) === '' || (is_string($value) && trim($value) === '')) {
                continue;
            }

            if ($isListItem) {
                $yaml .= $indentation . '- ';
            } else {
                $yaml .= $indentation;
            }

            $key = strpos($key, ':') !== false ? '\'' . $key . '\'' : $key;
            $value = is_string($value) && strpos($value, ':') !== false ? '\'' . $value . '\'' : $value;

            if (is_array($value) && !empty($value)) {
                $yaml .= $key . ":\n";
                $yaml .= $this->arrayToYaml($value, $indent + 1, $key === 'Bookmarks' || $isListItem);
            } else {
                if (!is_array($value)) {
                    $yaml .= $key . ': ' . $value . "\n";
                }
            }
        }

        return $yaml;
    }


}
