<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MatchProductImages extends Command
{
    protected $signature = 'products:match-images';
    protected $description = 'Try to match product names to files in public/images and update products.image accordingly';

    public function handle()
    {
        $dir = public_path('images');
        if (! is_dir($dir)) {
            $this->error("Directory not found: $dir");
            return 1;
        }

        $files = array_values(array_filter(scandir($dir), function($f) use ($dir) {
            return ! in_array($f, ['.', '..']) && is_file($dir . DIRECTORY_SEPARATOR . $f);
        }));

        $this->info('Found ' . count($files) . ' files in public/images');

        $updated = 0;

        $products = DB::table('products')->select('id','name','image')->get();
        foreach ($products as $p) {
            $slug = Str::slug($p->name);
            // try to find a file that contains slug
            $match = null;
            foreach ($files as $f) {
                $fNoExt = pathinfo($f, PATHINFO_FILENAME);
                if (Str::contains($fNoExt, $slug) || Str::contains($f, $slug)) {
                    $match = $f;
                    break;
                }
            }

            if ($match) {
                // if DB already has the same value, skip
                if ($p->image === $match) continue;
                DB::table('products')->where('id', $p->id)->update(['image' => $match]);
                $this->info("Updated product {$p->id} ({$p->name}): {$p->image} -> {$match}");
                $updated++;
            }
        }

        $this->info("Done. Updated $updated products.");
        return 0;
    }
}
