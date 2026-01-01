<?php

namespace App\Http\Controllers;

use App\Mail\TeamVerifiedMail;
use App\Models\Admin;
use App\Models\FreefireDuo;
use App\Models\FreefireSolo;
use App\Models\FreefireTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FreeFireController extends Controller
{
    public function team()
    {
        if (session()->has('username')) {
            $teams = FreefireTeam::all();
            $admin = Admin::all();
            return view('freefire_team', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }

    public function duo()
    {
        if (session()->has('username')) {
            $admin = Admin::all();
            $teams = FreefireDuo::all();
            return view('freefire_duo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
    public function solo()
    {
        if (session()->has('username')) {
            $teams = FreefireSolo::all();
            $admin = Admin::all();
            return view('freefire_solo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }

    private function generateEpass(
        $model,
        string $idField = 'id',
        string $filePrefix = 'epass',
        int $textY = 420,
        int $fontSize = 120
    ) {
        $manager = new ImageManager(new Driver());

        $baseImage = public_path('epass_template.png');

        if (!file_exists($baseImage)) {
            throw new \Exception('E-pass template not found');
        }

        $outputDir = public_path('epass/generated');
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Dynamic ID value
        $displayId = $model->{$idField};

        // Output path
        $outputPath = $outputDir . "/{$filePrefix}_{$displayId}.png";

        $img = $manager->read($baseImage);

        // Image dimensions
        $width = $img->width();

        // Draw ID text
        $img->text(
            $displayId,
            $width / 2,   // horizontal center
            $textY,       // vertical position
            function ($font) use ($fontSize) {
                // Optional font
                // $font->file(public_path('fonts/Montserrat-Bold.ttf'));
                $font->size($fontSize);
                $font->color('#000000');
                $font->align('center');
                $font->valign('middle');
            }
        );

        $img->save($outputPath);

        return $outputPath;
    }

    public function verifyTeam($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $team = FreefireTeam::findOrFail($id);

        // ✅ Generate E-Pass
        $epassPath = $this->generateEpass(
            $team,            // model
            'team_id',        // ID field (Free Fire usually has team_id)
            'freefire_team'   // file prefix
        );

        // ✅ Send Mail with E-Pass
        Mail::to($team->email)->send(
            new TeamVerifiedMail($team, $epassPath)
        );

        // ✅ Delete image after mail
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }


        // ✅ Mark as verified
        $team->verified = 1;
        $team->save();


        return back()->with('success', 'Free Fire Team verified & e-pass emailed successfully!');
    }
    public function verifyDuo($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $duo = FreefireDuo::findOrFail($id);

        // ✅ Mark as verified
        $duo->verified = 1;
        $duo->save();

        // ✅ Generate E-Pass
        $epassPath = $this->generateEpass(
            $duo,            // model
            'team_id',       // ID field (change to 'id' if needed)
            'freefire_duo'   // file prefix
        );

        // ✅ Send Mail with E-Pass
        Mail::to($duo->email)->send(
            new TeamVerifiedMail($duo, $epassPath)
        );

        // ✅ Delete image after mail
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }

        return back()->with('success', 'Free Fire Duo verified & e-pass emailed successfully!');
    }
    public function verifySolo($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $solo = FreefireSolo::findOrFail($id);

        // ✅ Mark as verified
        $solo->verified = 1;
        $solo->save();

        // ✅ Generate E-Pass
        $epassPath = $this->generateEpass(
            $solo,            // model
            'team_id',        // ID field (change to 'id' if applicable)
            'freefire_solo'   // file prefix
        );

        // ✅ Send Mail with E-Pass
        Mail::to($solo->email)->send(
            new TeamVerifiedMail($solo, $epassPath)
        );

        // ✅ Delete image after mail
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }

        return back()->with('success', 'Free Fire Solo verified & e-pass emailed successfully!');
    }
}
