<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\JournalMark;
use Barryvdh\DomPDF\Facade\Pdf;


class ScreeningController extends Controller
{
    public function index()
    {
        $journals = \App\Models\Journal::with('country')

        ->when(request('search'), function ($query) {

            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('publisher', 'like', '%' . request('search') . '%')
                ->orWhere('issn', 'like', '%' . request('search') . '%');

        })

        ->latest()
        ->get();

        $totalScreened = $journals->count();

        $legitimate = 0;
        $questionable = 0;
        $predatory = 0;

        foreach ($journals as $journal) {

            $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

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

            // FOLLOW YOUR CLASSIFICATION TABLE
            if ($average >= 8) {

                $legitimate++;
              

            } elseif ($average >= 5) {

                $questionable++;

            } else {

                $predatory++;

            }
        }

        return view('screen-journal.index', compact(
            'journals',
            'totalScreened',
            'legitimate',
            'questionable',
            'predatory'
        ));
    }

    public function create()
    {
        $countries = \App\Models\Country::orderBy('name')->get();

        return view('screen-journal.create', compact('countries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'required|url|max:255',
            'publisher' => 'required|string|max:255',
            'issn' => 'required|string|max:50',
            'country_id' => 'required|exists:countries,id',

            'section_2a' => 'required|integer|min:1|max:10',
            'section_2b' => 'required|integer|min:1|max:10',
            'section_2c' => 'required|integer|min:1|max:10',
            'section_2d' => 'required|integer|min:1|max:10',
            'section_2e' => 'required|integer|min:1|max:10',

            'section_3a' => 'required|integer|min:1|max:10',
            'section_3b' => 'required|integer|min:1|max:10',
            'section_3c' => 'required|integer|min:1|max:10',
            'section_3d' => 'required|integer|min:1|max:10',

            'section_4a' => 'required|integer|min:1|max:10',
            'section_4b' => 'required|integer|min:1|max:10',
        ]);

        $journal = Journal::create([
            'name' => $request->name,
            'website' => $request->website,
            'publisher' => $request->publisher,
            'issn' => $request->issn,
            'country_id' => $request->country_id,

            'user_id' => auth()->id(),
        ]);

        JournalMark::create([
            'journal_id' => $journal->id,

            'section_2a' => $request->section_2a,
            'section_2b' => $request->section_2b,
            'section_2c' => $request->section_2c,
            'section_2d' => $request->section_2d,
            'section_2e' => $request->section_2e,

            'section_3a' => $request->section_3a,
            'section_3b' => $request->section_3b,
            'section_3c' => $request->section_3c,
            'section_3d' => $request->section_3d,

            'section_4a' => $request->section_4a,
            'section_4b' => $request->section_4b,
        ]);

        return redirect()
            ->route('screen-journal.index')
            ->with('success', 'Journal screening has been submitted successfully.');
    }

    public function show(Journal $journal)
    {
        $journal->load(['country']);

        $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

        return view('screen-journal.show', compact('journal', 'marks'));
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();

        return redirect()
            ->route('screen-journal.index')
            ->with('success', 'Journal screening has been deleted successfully.');
    }

    public function results()
    {
        $journals = \App\Models\Journal::with('country')->latest()->get();

        $totalScreened = $journals->count();

        $legitimate = 0;
        $questionable = 0;
        $predatory = 0;

        foreach ($journals as $journal) {
            $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

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
                $legitimate++;
            } elseif ($average >= 5) {
                $questionable++;
            } else {
                $predatory++;
            }
        }

        return view('results.index', compact(
            'journals',
            'totalScreened',
            'legitimate',
            'questionable',
            'predatory'
        ));
    }

    public function resultShow(Journal $journal)
    {
        $journal->load('country');

        $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

        return view('results.show', compact('journal', 'marks'));
    }

    public function reports()
    {
        $journals = \App\Models\Journal::latest()->get();

        $totalScreened = $journals->count();
        $legitimate = 0;
        $questionable = 0;
        $predatory = 0;
        $totalScore = 0;
        $scoredCount = 0;

        foreach ($journals as $journal) {
            $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

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

            $totalScore += $average;
            $scoredCount++;

            if ($average >= 8) {
                $legitimate++;
            } elseif ($average >= 5) {
                $questionable++;
            } else {
                $predatory++;
            }
        }

        $overallAverage = $scoredCount > 0 ? round($totalScore / $scoredCount, 1) : 0;

        return view('reports.index', compact(
            'totalScreened',
            'legitimate',
            'questionable',
            'predatory',
            'overallAverage'
        ));
    }

    public function countryReport()
    {
        $countries = \App\Models\Country::with('journals')->orderBy('name')->get();

        $countryReports = [];

        foreach ($countries as $country) {
            $total = 0;
            $legitimate = 0;
            $questionable = 0;
            $predatory = 0;

            foreach ($country->journals as $journal) {
                $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

                if (!$marks) {
                    continue;
                }

                $score =
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

                $average = round($score / 11, 1);

                $total++;

                if ($average >= 8) {
                    $legitimate++;
                } elseif ($average >= 5) {
                    $questionable++;
                } else {
                    $predatory++;
                }
            }

            if ($total > 0) {
                $countryReports[] = [
                    'country' => $country->name,
                    'total' => $total,
                    'legitimate' => $legitimate,
                    'questionable' => $questionable,
                    'predatory' => $predatory,
                ];
            }
        }

        return view('reports.country', compact('countryReports'));
    }

    public function trendReport()
    {
        $monthlyData = \App\Models\Journal::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return view('reports.trend', compact('monthlyData'));
    }

    public function trendMonth($year, $month)
    {
        $journals = \App\Models\Journal::with('country')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->latest()
            ->get();

        $monthName = \DateTime::createFromFormat('!m', $month)->format('F');

        return view('reports.trend-month', compact('journals', 'year', 'month', 'monthName'));
    }

    public function riskDistribution()
    {
        $journals = \App\Models\Journal::all();

        $legitimate = 0;
        $questionable = 0;
        $predatory = 0;

        foreach ($journals as $journal) {

            $marks = \App\Models\JournalMark::where('journal_id', $journal->id)->first();

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

                $predatory++;

            } elseif ($average >= 5) {

                $questionable++;

            } else {

                $legitimate++;

            }
        }

        $totalData = max(($legitimate + $questionable + $predatory), 1);

        return view('reports.risk', compact(
            'legitimate',
            'questionable',
            'predatory',
            'totalData'
        ));
    }

    public function userActivity()
    {
        $users = \App\Models\User::withCount('journals')
            ->with('role')
            ->latest()
            ->get();

        return view('reports.user-activity', compact('users'));
    }

    public function userActivityShow(\App\Models\User $user)
    {
        $journals = \App\Models\Journal::with('country')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('reports.user-activity-show', compact('user', 'journals'));
    }

    public function exportPdf(Journal $journal)
    {
        $journal->load('country');

        $marks = JournalMark::where('journal_id', $journal->id)->first();

        $pdf = Pdf::loadView('results.pdf', compact('journal', 'marks'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('journal-screening-result-' . $journal->id . '.pdf');
    }
}
