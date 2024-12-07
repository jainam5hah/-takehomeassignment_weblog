<h1>{{ $campaign->name }} - Hourly Breakdown</h1>

<table border="1">
    <thead>
        <tr>
            <th>Date</th>
            <th>Hour</th>
            <th>Revenue</th>
            <th>Clicks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stats as $stat)
            <tr>
                <td>{{ $stat->date }}</td>
                <td>{{ sprintf('%02d:00', $stat->hour) }}</td>
                <td>${{ number_format($stat->revenue, 2) }}</td>
                <td>{{ number_format($stat->clicks) }}</td>
            </tr>
        @endforeach
    </tbody>
</table> 