<?php

namespace Modules\MarketingBot\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\MarketingBot\Entities\MarketingCampaign;
use Carbon\Carbon;
use Modules\MarketingBot\Entities\Contact;

class DashboardService
{
    /**
     * Get comprehensive dashboard data including campaign counts and recent campaigns.
     * 
     * This method aggregates campaign statistics by status and retrieves the most
     * recent campaigns for dashboard display. It filters campaigns based on
     * their status and creation date to provide relevant metrics.
     * 
     * @return array Returns an array containing:
     *               - campaignCounts: Array of campaign counts by status
     *               - recentCampaigns: Collection of 5 most recent campaigns with metadata
     * 
     * @throws Exception When database query fails
     */
    public function dashboardData(): array
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                throw new Exception("User must be authenticated");
            }

            // Get campaign counts by status with optimized query
            $campaignCounts = MarketingCampaign::selectRaw('status, COUNT(*) as count')
                ->where('user_id', $userId)
                ->whereIn('status', ['running', 'scheduled', 'published'])
                ->where(function($query) {
                    $query->where('status', '!=', 'scheduled')
                        ->orWhere(function($q) {
                            $q->where('status', 'scheduled')
                                ->where('created_at', '>=', now()->subDays(30));
                        });
                })
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $totalContacts = Contact::where('user_id', $userId)->count();

            // Get recent campaigns with eager loading for better performance
            $recentCampaigns = MarketingCampaign::with(['metas'])
                ->where('user_id', $userId)
                ->latest()
                ->limit(5)
                ->get();

            return [
                'campaignCounts' => $campaignCounts,
                'recentCampaigns' => $recentCampaigns,
                'totalContacts' => $totalContacts
            ];
            
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve dashboard data: " . $e->getMessage());
        }
    }

    /**
     * Get campaign performance data for a specified number of days.
     * 
     * This method generates performance metrics for campaigns across different
     * channels over a specified time period. It creates a comprehensive dataset
     * showing campaign creation trends by channel and date.
     * 
     * @param int $days Number of days to analyze (default: 30, max: 365)
     * @return array Returns an array containing:
     *               - dates: Array of date strings in Y-m-d format
     *               - channels: Array of unique channel names
     *               - channelData: Nested array with campaign counts per channel per date
     * 
     * @throws Exception When invalid parameters or database query fails
     */
    public function campaignPerformance(int $days = 30): array
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                throw new Exception("User must be authenticated");
            }
            // Validate input parameters
            if ($days < 1 || $days > 365) {
                throw new Exception("Days parameter must be between 1 and 365");
            }

            $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            
            // Generate date range efficiently
            $dates = [];
            $currentDate = clone $startDate;
            
            while ($currentDate <= $endDate) {
                $dates[] = $currentDate->format('Y-m-d');
                $currentDate->addDay();
            }
            
            // Get unique channels with null filtering
            $channels = MarketingCampaign::distinct('channel')
                ->where('user_id', $userId)
                ->whereNotNull('channel')
                ->where('channel', '!=', '')
                ->pluck('channel')
                ->toArray();
            
            // Optimize query by getting all data in one go
            $campaignData = MarketingCampaign::select('channel', DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('user_id', $userId)
                ->whereNotNull('channel')
                ->where('channel', '!=', '')
                ->groupBy('channel', DB::raw('DATE(created_at)'))
                ->get()
                ->groupBy('channel');
            
            // Build channel data structure
            $channelData = [];
            foreach ($channels as $channel) {
                $channelData[$channel] = [];
                $channelCounts = $campaignData->get($channel, collect())->keyBy('date');
                
                foreach ($dates as $date) {
                    $channelData[$channel][] = $channelCounts->get($date, (object)['count' => 0])->count;
                }
            }
            
            return [
                'dates' => $dates,
                'channels' => $channels,
                'channelData' => $channelData
            ];
            
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve campaign performance data: " . $e->getMessage());
        }
    }

    /**
     * Get campaign counts grouped by channel for the current month.
     * 
     * @return array Returns an array containing:
     *               - channels: Array of channel names
     *               - campaignCounts: Campaign counts per channel for current month
     * 
     * @throws Exception When user is not authenticated or database query fails
     */
    public function campaignsByChannel(): array
    {
        $userId = auth()->id();
        
        if (!$userId) {
            throw new Exception("User must be authenticated");
        }
        try {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            
            // Get channels and campaign counts in a single optimized query
            $conversionData = MarketingCampaign::select('channel', DB::raw('COUNT(*) as count'))
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('user_id', $userId)
                ->whereNotNull('channel')
                ->where('channel', '!=', '')
                ->groupBy('channel')
                ->pluck('count', 'channel')
                ->toArray();
            
            return [
                'channels' => array_keys($conversionData),
                'conversions' => $conversionData
            ];
            
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve conversion data: " . $e->getMessage());
        }
    }

    /**
     * Get channel distribution data showing campaign counts per channel.
     * 
     * This method provides an overview of campaign distribution across
     * different marketing channels, helping identify the most active
     * channels in the system.
     * 
     * @return array Returns an array containing:
     *               - channels: Array of channel names
     *               - distribution: Array with channel names as keys and counts as values
     * 
     * @throws Exception When database query fails
     */
    public function channelDistribution(): array
    {
        try {

            $userId = auth()->id();
            if (!$userId) {
                throw new Exception("User must be authenticated");
            }

            // Get distribution data in a single optimized query
            $distributionData = MarketingCampaign::select('channel', DB::raw('COUNT(*) as count'))
                ->where('user_id', $userId)
                ->whereNotNull('channel')
                ->where('channel', '!=', '')
                ->groupBy('channel')
                ->pluck('count', 'channel')
                ->toArray();
            
            return [
                'channels' => array_keys($distributionData),
                'distribution' => $distributionData
            ];
            
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve channel distribution data: " . $e->getMessage());
        }
    }

    /**
     * Get contact growth data for the last 12 months.
     * 
     * This method analyzes contact creation trends over the past 12 months
     * to provide insights into contact growth patterns. It directly queries
     * the contacts table and groups results by month.
     * 
     * @return array Returns an array containing:
     *               - months: Array of month abbreviations (Jan, Feb, etc.)
     *               - counts: Array of contact counts for each month
     * 
     * @throws Exception When database query fails
     */
    public function contactGrowth(): array
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                throw new Exception("User must be authenticated");
            }
            $months = [];
            $contactCounts = [];
            
            // Get data for the last 12 months using a more efficient approach
            $startDate = Carbon::now()->subMonths(11)->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            
            // Get all campaign data for the last 12 months in one query
            $campaignData = Contact::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('user_id', $userId)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(function($item) {
                return Carbon::create($item->year, $item->month, 1)->format('Y-m');
            });
            
            // Generate month labels and counts
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $monthKey = $date->format('Y-m');
                $monthName = $date->format('M');
                
                $months[] = $monthName;
                $contactCounts[] = $campaignData->get($monthKey, (object)['count' => 0])->count;
            }
            
            return [
                'months' => $months,
                'counts' => $contactCounts
            ];
            
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve contact growth data: " . $e->getMessage());
        }
    }

}