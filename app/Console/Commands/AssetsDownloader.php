<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AssetsDownloader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloading assets';

    //protected $url = 'http://rickp.sch.bme.hu/program';
    protected $url = 'http://152.66.180.21/program';

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
        $files = [
            '/mix-manifest.json',
            /*'/fonts/FontAwesome.otf',
            '/fonts/fontawesome-webfont.eot',
            '/fonts/fontawesome-webfont.svg',
            '/fonts/fontawesome-webfont.ttf',
            '/fonts/fontawesome-webfont.woff',
            '/fonts/fontawesome-webfont.woff2',
            '/fonts/glyphicons-halflings-regular.eot',
            '/fonts/glyphicons-halflings-regular.svg',
            '/fonts/glyphicons-halflings-regular.ttf',
            '/fonts/glyphicons-halflings-regular.woff',
            '/fonts/glyphicons-halflings-regular.woff2' */
        ];

        foreach ($files as $file) {
            $this->download($file);
        }

        $manifest = json_decode(file_get_contents(base_path('public/mix-manifest.json')), true);

        $this->download($manifest['/js/app.js']);
        $this->download($manifest['/css/app.css']);
    }

    private function download($file)
    {
        exec('wget '. $this->url . $file .' -O public'. $file);
    }
}
