<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateProductFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-product-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product files with correct data from rightProductData folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating product files...');

        // Define the paths
        $sourcePath = resource_path('views/main/rightProductData');
        $destPath = resource_path('views/main');

        // Process each product file
        for ($i = 3; $i <= 12; $i++) {
            $sourceFile = "{$sourcePath}/product{$i}.blade.php";
            $destFile = "{$destPath}/product{$i}.blade.php";

            if (!file_exists($sourceFile)) {
                $this->error("Source file not found: product{$i}.blade.php");
                continue;
            }

            // Read the source file (with correct data)
            $sourceContent = file_get_contents($sourceFile);

            // Read the destination file (with modern functionality)
            $destContent = file_get_contents($destFile);

            // Extract the parameters section from the source file
            preg_match('/<div id="parameterFrame".*?<\/div>\s*<div id="reviewFrame"/s', $sourceContent, $sourceMatches);
            if (empty($sourceMatches)) {
                $this->error("Could not find parameters section in source file: product{$i}.blade.php");
                continue;
            }
            $sourceParams = $sourceMatches[0];
            $sourceParams = substr($sourceParams, 0, strrpos($sourceParams, '<div id="reviewFrame"'));

            // Extract the image URL from the source file
            preg_match('/<img src="(.*?)"/', $sourceContent, $imageMatches);
            $imageUrl = $imageMatches[1] ?? null;

            if (!$imageUrl) {
                $this->error("Could not find image URL in source file: product{$i}.blade.php");
                continue;
            }

            // Replace the parameters section in the destination file
            $destContent = preg_replace(
                '/(<div id="parameterFrame".*?)(<div id="reviewFrame")/s',
                $sourceParams . '$2',
                $destContent
            );

            // Replace the image URL in the destination file
            $destContent = preg_replace(
                '/<img src=".*?"/',
                '<img src="' . $imageUrl . '"',
                $destContent
            );

            // Write the updated content back to the destination file
            file_put_contents($destFile, $destContent);

            $this->info("Updated product{$i}.blade.php");
        }

        $this->info('Product files updated successfully!');
    }
}
