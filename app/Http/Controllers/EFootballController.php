<?php

namespace App\Http\Controllers;

use App\Mail\TeamVerifiedMail;
use App\Models\Admin;
use App\Models\EFootball;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class EFootballController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = EFootball::all();
            $admin = Admin::all();
            return view('e_football', compact('teams', 'admin'));
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


    public function verify($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $team = EFootball::findOrFail($id);

        // ✅ Mark as verified
        $team->verified = 1;
        $team->save();

        // ✅ Generate E-Pass
        $epassPath = $this->generateEpass(
            $team,           // model
            'team_id',       // ID field (change to 'id' if applicable)
            'efootball_team' // file prefix
        );

        // ✅ Send Mail with E-Pass
        Mail::to($team->email)->send(
            new TeamVerifiedMail($team, $epassPath, 'eFootball Team')
        );

        // ✅ Delete image after mail
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }

        return back()->with('success', 'eFootball Team verified & e-pass emailed successfully!');
    }
}
