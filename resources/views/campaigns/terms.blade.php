<h1>{{ $campaign->name }} - UTM Terms Breakdown</h1>

<table border="1">
    <thead>
        <tr>
            <th>UTM Term</th>
            <th>Revenue</th>
            <th>Clicks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stats as $stat)
            <tr>
                <td>{{ $stat->term->name ?: 'N/A' }}</td>
                <td>${{ number_format($stat->revenue, 2) }}</td>
                <td>{{ number_format($stat->clicks) }}</td>
            </tr>
        @endforeach
    </tbody>
</table> 