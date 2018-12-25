<?php

namespace jiri\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use jiri\Jiri;
use jiri\Mail\JiriEnded;

class JiriStop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jiri:stop {jiri}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'stop the jiri';
    protected $jiri;

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
        $jiri_id = $this->argument('jiri');
        $this->jiri = Jiri::findOrFail($jiri_id)->load('judges');
        $this->destroyToken();
        $this->sendEmail();

    }

    private function destroyToken()
    {
        foreach($this->jiri->judges as $judge){
            $judge->token = NULL;
            $judge->save();
        }
    }

    private function sendEmail(){
        foreach($this->jiri->judges as $judge){
            Mail::to($judge->email)->send(new JiriEnded($judge, $this->jiri));
        }
    }
}
