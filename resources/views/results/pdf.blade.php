<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Journal Screening Result</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header { background: #2563eb; color: white; padding: 20px; border-radius: 8px; }
        .card { border: 1px solid #ddd; padding: 15px; margin-top: 15px; border-radius: 8px; }
        .title { font-size: 22px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>

@php
    $scores = [
        'Indexing Status' => $marks->section_2a ?? 0,
        'Peer Review Process' => $marks->section_2b ?? 0,
        'Editorial Board Verification' => $marks->section_2c ?? 0,
        'APC / Fee Transparency' => $marks->section_2d ?? 0,
        'Publication Ethics Guidelines' => $marks->section_2e ?? 0,
        'Spam / Mass Invitation' => $marks->section_3a ?? 0,
        'Rapid Publication Promise' => $marks->section_3b ?? 0,
        'Suspicious Indexing Claims' => $marks->section_3c ?? 0,
        'Misleading Website Information' => $marks->section_3d ?? 0,
        'Ethical Publishing Practices' => $marks->section_4a ?? 0,
        'Research Integrity Risk' => $marks->section_4b ?? 0,
    ];

    $average = round(array_sum($scores) / count($scores), 1);

    if ($average >= 8) {
        $classification = 'Suspected Predatory';
        $risk = 'High Risk';
    } elseif ($average >= 5) {
        $classification = 'Questionable';
        $risk = 'Medium Risk';
    } else {
        $classification = 'Legitimate';
        $risk = 'Low Risk';
    }
@endphp

<div class="header">
    <div class="title">Journal Screening Result Report</div>
    <p>Data-Driven Predatory Journal Screening System</p>
</div>

<div class="card">
    <h3>Journal Information</h3>
    <p><strong>Journal Name:</strong> {{ $journal->name }}</p>
    <p><strong>Website:</strong> {{ $journal->website }}</p>
    <p><strong>Publisher:</strong> {{ $journal->publisher }}</p>
    <p><strong>ISSN:</strong> {{ $journal->issn }}</p>
    <p><strong>Country:</strong> {{ $journal->country->name ?? '-' }}</p>
</div>

<div class="card">
    <h3>Final Result</h3>
    <p><strong>Average Score:</strong> {{ $average }}/10</p>
    <p><strong>Classification:</strong> {{ $classification }}</p>
    <p><strong>Risk Level:</strong> {{ $risk }}</p>
</div>

<div class="card">
    <h3>Score Distribution</h3>

    @php
        $scorePercent = ($average / 10) * 100;

        if ($average >= 8) {
            $barColor = '#22c55e';
            
        } elseif ($average >= 5) {
            $barColor = '#facc15';
        } else {
            $barColor = '#ef4444';
        }
    @endphp

    <p><strong>Average Score:</strong> {{ $average }}/10</p>
    <p><strong>Risk Level:</strong> {{ $risk }}</p>

    <div style="width: 100%; background: #e5e7eb; height: 24px; border-radius: 12px; overflow: hidden;">
        <div style="width: {{ $scorePercent }}%; background: {{ $barColor }}; height: 24px;"></div>
    </div>

    <p style="margin-top: 8px;">
        Score Distribution: {{ round($scorePercent) }}%
    </p>
</div>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Indicator</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($scores as $label => $score)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $label }}</td>
                <td>{{ $score }}/10</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p style="margin-top: 30px;">
    <strong>Generated At:</strong> {{ now()->format('d M Y, h:i A') }}
</p>

</body>
</html>