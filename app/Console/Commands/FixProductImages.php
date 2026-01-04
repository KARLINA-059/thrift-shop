<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FixProductImages extends Command
{
    protected $signature = 'products:fix-images';
    protected $description = 'Rename files in public/images to slug-safe names and update products.image accordingly';

    public function handle()
    {
        $dir = public_path('images');
        if (! is_dir($dir)) {
            $this->error("Directory not found: $dir");
            return 1;
        }

        $files = scandir($dir);
        $map = [];

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) continue;
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (! is_file($path)) continue;

            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $name = pathinfo($file, PATHINFO_FILENAME);
            $slug = Str::slug($name);
            $newName = $slug . ($ext ? '.' . $ext : '');

            if ($newName === $file) continue;

            $newPath = $dir . DIRECTORY_SEPARATOR . $newName;
            if (file_exists($newPath)) {
                $this->warn("Target exists, skipping: $newName");
                continue;
            }

            if (@rename($path, $newPath)) {
                $map[$file] = $newName;
                $this->info("Renamed: $file -> $newName");
            } else {
                $this->error("Failed to rename: $file");
            }
        }

        // Update DB records
        foreach ($map as $old => $new) {
            $affected = DB::table('products')
                ->where('image', $old)
                ->orWhere('image', 'images/' . $old)
                ->orWhere('image', 'images/products/' . $old)
                ->update(['image' => $new]);

            $this->info("DB updated for $old -> $new (rows: $affected)");
        }

        $this->info('Finished processing images.');
        return 0;
    }
}
