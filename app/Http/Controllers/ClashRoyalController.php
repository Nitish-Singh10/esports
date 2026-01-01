<?php

namespace App\Http\Controllers;

use App\Mail\TeamVerifiedMail;
use App\Models\Admin;
use App\Models\ClashRoyal;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class ClashRoyalController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = ClashRoyal::all();
            $admin = Admin::all();
            return view('clash_royal', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }

    private function generateEpass($team)
    {
        $manager = new ImageManager(new Driver());

        $baseImage = public_path('epass_template.png');

        if (!file_exists($baseImage)) {
            throw new \Exception('E-pass template not found');
        }

        $outputDir = public_path('epass/generated');
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $outputPath = $outputDir . "/team_{$team->team_id}.png";

        $img = $manager->read($baseImage);

        // 📌 IMAGE DIMENSIONS (important for centering)
        $width = $img->width();
        $height = $img->height();

        // 📌 PLACE TEXT IN WHITE SPACE
        $img->text(
            $team->team_id,
            $width / 2,        // horizontal center
            420,               // vertical position (inside white box)
            function ($font) {
                // $font->file(public_path('fonts/Montserrat-Bold.ttf')); // optional but recommended
                $font->size(120);          // 🔥 BIG TEXT
                $font->color('#000000');   // black for white background
                $font->align('center');
                $font->valign('middle');
            }
        );

        $img->save($outputPath);

        return $outputPath;
    }

    public function verify($id)
    {
        $team = ClashRoyal::findOrFail($id);

        $team->verified = 1;
        $team->save();

        // Generate e-pass
        $epassPath = $this->generateEpass($team);

        // Send mail
        Mail::to($team->email)->send(
            new TeamVerifiedMail($team, $epassPath)
        );

        // ✅ DELETE IMAGE AFTER MAIL
        if (File::exists($epassPath)) {
            File::delete($epassPath);
        }

        return redirect()->back()
            ->with('success', 'Team verified & e-pass emailed successfully!');
    }
}
