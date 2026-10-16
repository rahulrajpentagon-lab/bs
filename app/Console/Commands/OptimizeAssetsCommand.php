<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeAssetsCommand extends Command
{
    protected $signature = 'assets:optimize {--skip-images : Skip JPEG compression}';

    protected $description = 'Minify frontend CSS/JS and compress JPEG images for faster page loads';

    public function handle(): int
    {
        $this->optimizeStylesheets();
        $this->optimizeScripts();

        if (! $this->option('skip-images')) {
            $this->optimizeImages();
        }

        return self::SUCCESS;
    }

    private function optimizeStylesheets(): void
    {
        $cssFiles = [
            public_path('assets/css/style.css'),
            public_path('assets/css/pages.css'),
        ];

        $css = '';
        foreach ($cssFiles as $file) {
            if (is_file($file)) {
                $css .= file_get_contents($file)."\n";
            }
        }

        $css = preg_replace('#/\*.*?\*/#s', '', $css) ?? $css;
        $css = preg_replace('/\s+/', ' ', $css) ?? $css;
        $css = preg_replace('/\s*([{}:;,>])\s*/', '$1', $css) ?? $css;
        $css = str_replace(';}', '}', $css);
        file_put_contents(public_path('assets/css/app.min.css'), trim($css));

        $this->info('CSS: public/assets/css/app.min.css ('.filesize(public_path('assets/css/app.min.css')).' bytes)');
    }

    private function optimizeScripts(): void
    {
        $jsPath = public_path('assets/js/app.js');
        $js = is_file($jsPath) ? file_get_contents($jsPath) : '';
        $js = preg_replace('#/\*.*?\*/#s', '', $js) ?? $js;
        $js = preg_replace('#^\s*//.*$#m', '', $js) ?? $js;
        $js = preg_replace('/\s+/', ' ', $js) ?? $js;
        file_put_contents(public_path('assets/js/app.min.js'), trim($js));

        $this->info('JS: public/assets/js/app.min.js ('.filesize(public_path('assets/js/app.min.js')).' bytes)');
    }

    private function optimizeImages(): void
    {
        if (! extension_loaded('gd')) {
            $this->warn('GD not loaded — skipped image compression.');

            return;
        }

        $groups = [
            ['pattern' => public_path('assets/images/works/*.jpg'), 'maxW' => 1280, 'maxH' => 1280, 'quality' => 72],
            ['pattern' => public_path('assets/images/hero/*.jpg'), 'maxW' => 900, 'maxH' => 900, 'quality' => 68],
            ['pattern' => public_path('assets/images/devices/*.jpg'), 'maxW' => 900, 'maxH' => 900, 'quality' => 70],
            ['pattern' => public_path('assets/images/logo/*.jpg'), 'maxW' => 600, 'maxH' => 600, 'quality' => 75],
        ];

        $beforeTotal = 0;
        $afterTotal = 0;

        foreach ($groups as $group) {
            foreach (glob($group['pattern']) ?: [] as $path) {
                $before = filesize($path) ?: 0;
                $beforeTotal += $before;

                $info = @getimagesize($path);
                if ($info === false || ($info[2] ?? null) !== IMAGETYPE_JPEG) {
                    $afterTotal += $before;
                    continue;
                }

                [$width, $height] = $info;
                $src = @imagecreatefromjpeg($path);
                if ($src === false) {
                    $afterTotal += $before;
                    continue;
                }

                $ratio = min($group['maxW'] / max($width, 1), $group['maxH'] / max($height, 1), 1);
                $newW = max(1, (int) round($width * $ratio));
                $newH = max(1, (int) round($height * $ratio));

                $dst = imagecreatetruecolor($newW, $newH);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $width, $height);
                imageinterlace($dst, true);
                imagejpeg($dst, $path, $group['quality']);
                imagedestroy($src);
                imagedestroy($dst);

                clearstatcache(true, $path);
                $after = filesize($path) ?: 0;
                $afterTotal += $after;
            }
        }

        $this->info(sprintf(
            'Images: %dKB -> %dKB (saved %dKB)',
            (int) round($beforeTotal / 1024),
            (int) round($afterTotal / 1024),
            (int) round(($beforeTotal - $afterTotal) / 1024)
        ));
    }
}
