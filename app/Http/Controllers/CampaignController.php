<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Stat;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display list of campaigns and aggregate revenue for each campaign
     */
    public function index()
    {
        // Aggregate revenue by campaign
        $campaigns = Stat::select(
            'campaign_id',
            DB::raw('SUM(revenue) as total_revenue'),
            DB::raw('COUNT(*) as clicks')
        )
            ->with('campaign:id,name') // Eager load campaign names
            ->groupBy('campaign_id')
            ->get();

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Display a specific campaign with a hourly breakdown of all revenue
     */
    public function show(Campaign $campaign)
    {
        $stats = Stat::select(
            DB::raw('DATE(timestamp) as date'),
            DB::raw('strftime("%H", timestamp) as hour'),
            DB::raw('SUM(revenue) as revenue'),
            DB::raw('COUNT(*) as clicks')
        )
            ->where('campaign_id', $campaign->id)
            ->groupBy('date', 'hour')
            ->orderBy('date')
            ->orderBy('hour')
            ->get();

            return view('campaigns.hourly', compact('campaign', 'stats'));
    }

    /**
     * Display a specific campaign with the aggregate revenue by utm_term
     */
    public function publishers(Campaign $campaign)
    {
        $stats = Stat::select(
            'term_id',
            DB::raw('SUM(revenue) as revenue'),
            DB::raw('COUNT(*) as clicks')
        )
            ->with('term:id,name')
            ->where('campaign_id', $campaign->id)
            ->groupBy('term_id')
            ->orderByDesc('revenue')
            ->get();

        return view('campaigns.terms', compact('campaign', 'stats'));
    }
}
