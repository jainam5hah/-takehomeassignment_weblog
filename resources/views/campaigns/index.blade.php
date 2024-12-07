<table border="1">
    <thead>
        <tr>
            <th>Campaign</th>
            <th>Total Revenue</th>
            <th>Total Clicks</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->campaign->name }}</td>
                <td>${{ number_format($campaign->total_revenue, 2) }}</td>
                <td>{{ number_format($campaign->clicks) }}</td>
                <td>
                    <a href="{{ route('campaign', $campaign->campaign_id) }}">View Hourly</a>
                    <a href="{{ route('publishers', $campaign->campaign_id) }}">View Terms</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table> 