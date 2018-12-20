<?php

namespace jiri\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use jiri\Jiri;
use jiri\Mail\JiriStarted;

class JiriStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jiri:start {jiri}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the jiri and sending email to user';
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
        $this->createToken();
        $this->sendEmail();
    }

    private function createToken()
    {
        foreach($this->jiri->judges as $judge){
            $judge->token = time() . '$' . $judge->id . '$' . $this->jiri->id;
            $judge->save();
        }
    }

    private function sendEmail(){
        foreach($this->jiri->judges as $judge){
            Mail::to($judge->email)->send(new JiriStarted($judge, $this->jiri));
        }
    }
}
