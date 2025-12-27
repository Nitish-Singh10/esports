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

        // Base template
        $baseImage = public_path('epass_template.png');

        if (!file_exists($baseImage)) {
            throw new \Exception('E-pass template not found');
        }

        // ✅ PUBLIC directory
        $outputDir = public_path('epass/generated');

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Output file
        $outputPath = $outputDir . "/team_{$team->team_id}.png";

        $img = $manager->read($baseImage);

        // Add team ID
        $img->text(
            'TEAM ID: ' . $team->team_id,
            400,
            550,
            function ($font) {
                $font->size(36);
                $font->color('#ffffff');
            }
        );

        $img->save($outputPath);

        return $outputPath; // full public path
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
