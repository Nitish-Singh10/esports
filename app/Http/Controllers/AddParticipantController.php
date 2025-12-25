<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BgmiDuo;
use App\Models\BgmiSolo;
use App\Models\BgmiTeam;
use App\Models\ClashRoyal;
use App\Models\CodSolo;
use App\Models\CodTeam;
use App\Models\EFootball;
use App\Models\FCSolo;
use App\Models\FreefireDuo;
use App\Models\FreefireSolo;
use App\Models\FreefireTeam;
use App\Models\Valorant;
use Illuminate\Http\Request;

class AddParticipantController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('addform', compact('admin'));
    }

    /**
     * Generate unique registration ID
     */
    private function generateRegistrationId(string $game, string $category): string
    {
        $prefixMap = [
            'BGMI' => [
                'Squad' => 'BGTE',
                'Duo' => 'BGDO',
                'Solo' => 'BGSO',
            ],
            'FREE_FIRE' => [
                'Squad' => 'FFTE',
                'Duo' => 'FFDO',
                'Solo' => 'FFSO',
            ],
            'VALORANT' => [
                'Solo' => 'VLSO',
            ],
            'EFOOTBALL' => [
                'Solo' => 'EFSO',
            ],
            'CLASH_ROYALE' => [
                'Solo' => 'CRSO',
            ],
            'COD' => [
                'Solo' => 'CDSO',
                'Squad' => 'CDTE',
            ],
            'FC' => [
                'Solo' => 'FCSO',
            ],
        ];

        $prefix = $prefixMap[$game][$category] ?? 'GEN';

        // HHMMSS + random → 5 digits
        $timePart = now()->format('His');
        $randomPart = random_int(10000, 99999);

        return $prefix . substr($timePart . $randomPart, 0, 5);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string',
            'category' => 'required|string',
            'fullname' => 'required|string|max:255',
            'class' => 'nullable|string|max:255',
            'rollno' => 'nullable|string|max:255',
            'phoneno' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'payment' => 'required|in:upi,cash',
            'transaction' => 'nullable|string|max:255',
            'college' => 'required|string|max:255',
        ]);

        // Generate registration ID
        $registrationId = $this->generateRegistrationId(
            $validated['game'],
            $validated['category']
        );

        $commonData = [
            'team_id' => $registrationId,
            'name' => $validated['fullname'],
            'class' => $validated['class'],
            'rollno' => $validated['rollno'],
            'phone_no' => $validated['phoneno'],
            'email' => $validated['email'],
            'pay_mode' => $validated['payment'],
            'transaction_id' => $validated['transaction'] ?? 'CASH',
            'college' => $validated['college'],
            'added_by' => auth()->user()->name ?? 'admin',
        ];

        /* ---------------- BGMI ---------------- */
        if ($validated['game'] === 'BGMI') {
            if ($validated['category'] === 'Squad') {
                BgmiTeam::create($commonData);
                return back()->with('success', "BGMI Squad registered (ID: $registrationId)");
            }

            if ($validated['category'] === 'Duo') {
                BgmiDuo::create($commonData);
                return back()->with('success', "BGMI Duo registered (ID: $registrationId)");
            }

            if ($validated['category'] === 'Solo') {
                BgmiSolo::create($commonData);
                return back()->with('success', "BGMI Solo registered (ID: $registrationId)");
            }
        }

        /* ---------------- FREE FIRE ---------------- */
        if ($validated['game'] === 'FREE_FIRE') {
            if ($validated['category'] === 'Squad') {
                FreefireTeam::create($commonData);
                return back()->with('success', "Free Fire Squad registered (ID: $registrationId)");
            }

            if ($validated['category'] === 'Duo') {
                FreefireDuo::create($commonData);
                return back()->with('success', "Free Fire Duo registered (ID: $registrationId)");
            }

            if ($validated['category'] === 'Solo') {
                FreefireSolo::create($commonData);
                return back()->with('success', "Free Fire Solo registered (ID: $registrationId)");
            }
        }

        /* ---------------- VALORANT ---------------- */
        if ($validated['game'] === 'VALORANT' && $validated['category'] === 'Solo') {
            Valorant::create($commonData);
            return back()->with('success', "Valorant Solo registered (ID: $registrationId)");
        }

        /* ---------------- EFOOTBALL ---------------- */
        if ($validated['game'] === 'EFOOTBALL' && $validated['category'] === 'Solo') {
            EFootball::create($commonData);
            return back()->with('success', "EFootball Solo registered (ID: $registrationId)");
        }

        /* ---------------- CLASH ROYALE ---------------- */
        if ($validated['game'] === 'CLASH_ROYALE' && $validated['category'] === 'Solo') {
            ClashRoyal::create($commonData);
            return back()->with('success', "Clash Royale Solo registered (ID: $registrationId)");
        }

        return back()->with('error', 'Invalid game or category');
    }
}
