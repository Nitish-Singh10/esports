<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;
    public $epassPath;

    public function __construct($team, $epassPath)
    {
        $this->team = $team;
        $this->epassPath = $epassPath;
    }

    public function build()
    {
        return $this->subject('Your Clash Royal Team is Verified 🎮')
            ->view('team_verified')
            ->attach($this->epassPath, [
                'as' => 'ClashRoyal_Epass.png',
                'mime' => 'image/png',
            ]);
    }
}
