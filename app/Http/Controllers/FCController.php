<?php

namespace App\Http\Controllers;

use App\Mail\TeamVerifiedMail;
use App\Models\Admin;
use App\Models\CodSolo;
use App\Models\CodTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FCController extends Controller
{
    public function team()
    {
        if (session()->has('username')) {
            $teams = CodTeam::all();
            $admin = Admin::all();
            return view('cod_mobile_team', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }

    public function solo()
    {
        if (session()->has('username')) {
            $teams = CodSolo::latest()->get();
            $admin = Admin::all();
            return view('cod_mobile_solo', compact('teams', 'admin'));
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

        $team = CodTeam::findOrFail($id);

        // ✅ Mark as verified
        $team->verified = 1;
        $team->save();

        // ✅ Generate E-Pass
        $epassPath = $this->generateEpass(
            $team,          // model
            'team_id',      // ID field (change to 'id' if needed)
            'cod_team'      // file prefix
        );

        // ✅ Send Mail with E-Pass
        Mail::to($team->email)->send(
            new TeamVerifiedMail($team, $epassPath)
        );

        // ✅ Delete image after mail
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }

        return back()->with('success', 'COD Team verified & e-pass emailed successfully!');
    }

    public function verifySolo($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $solo = CodSolo::findOrFail($id);

        // ✅ Mark as verified
        $solo->verified = 1;
        $solo->save();

        // ✅ Generate E-Pass
        $epassPath = $this->generateEpass(
            $solo,        // model
            'team_id',    // ID field (change to 'id' if applicable)
            'cod_solo'    // file prefix
        );

        // ✅ Send Mail with E-Pass
        Mail::to($solo->email)->send(
            new TeamVerifiedMail($solo, $epassPath)
        );

        // ✅ Delete image after mail
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }

        return back()->with('success', 'COD Solo verified & e-pass emailed successfully!');
    }
}
