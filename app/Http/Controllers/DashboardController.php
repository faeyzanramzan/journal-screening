<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\JournalMark;

class DashboardController extends Controller
{
    public function index()
    {
        $journals = Journal::latest()->get();

        $totalJournals = $journals->count();

        $highTrust = 0;
        $moderateTrust = 0;
        $riskyJournals = 0;

        foreach ($journals as $journal) {
            $marks = JournalMark::where('journal_id', $journal->id)->first();

            if (!$marks) {
                continue;
            }

            $total =
                ($marks->section_2a ?? 0) +
                ($marks->section_2b ?? 0) +
                ($marks->section_2c ?? 0) +
                ($marks->section_2d ?? 0) +
                ($marks->section_2e ?? 0) +
                ($marks->section_3a ?? 0) +
                ($marks->section_3b ?? 0) +
                ($marks->section_3c ?? 0) +
                ($marks->section_3d ?? 0) +
                ($marks->section_4a ?? 0) +
                ($marks->section_4b ?? 0);

            $average = round($total / 11, 1);

            if ($average >= 8) {
                $riskyJournals++;
            } elseif ($average >= 5) {
                $moderateTrust++;
            } else {
                $highTrust++;
            }
        }

        return view('dashboard', compact(
            'journals',
            'totalJournals',
            'highTrust',
            'moderateTrust',
            'riskyJournals'
        ));
    }
}