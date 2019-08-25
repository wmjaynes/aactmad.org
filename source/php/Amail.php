<?php

namespace Aactmad;

use Mailgun\Mailgun;
use function getenv;

class Amail
{
    protected $mailgunApiKey;
    protected $mailgun;
    protected $domain;

    public function __construct()
    {
        $this->mailgunApiKey = getenv('MAILGUN_API_KEY');
        $this->domain = getenv('MAILGUN_DOMAIN');
        $this->mailgun = Mailgun::create($this->mailgunApiKey);
    }

    public function send($args) {
        $this->mailgun->messages()->send($this->domain, $args);
    }

    public function dump() {
        return print_r(['key'=>$this->mailgunApiKey, 'domain'=>$this->domain], true);
    }
}
