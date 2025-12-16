<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\AudioAd;

class AudioAdsDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $audioAds = $this->query();

        return DataTables::eloquent($audioAds)
            ->editColumn('title', function ($ad) {
                return '<a data-bs-toggle="tooltip" data-bs-placement="top" title="' . e($ad->title) . '" href="' . route('admin.features.audio-ads.view', ['id' => techEncrypt($ad->id)]) . '">' . trimWords(ucfirst($ad->title), 60) . '</a>';
            })
            ->editColumn('user_id', function ($ad) {
                return '<a href="' . route('users.edit', ['id' => $ad->user_id]) . '">' . optional($ad->user)->name . '</a>';
            })
            ->editColumn('status', function ($ad) {
                $statusColors = [
                    'pending' => 'warning',
                    'processing' => 'info',
                    'completed' => 'success',
                    'failed' => 'danger',
                ];
                $color = $statusColors[$ad->status] ?? 'secondary';
                return '<span class="badge badge-' . $color . '">' . ucfirst($ad->status) . '</span>';
            })
            ->editColumn('ad_style', function ($ad) {
                return ucfirst(str_replace('_', ' ', $ad->ad_style ?? 'N/A'));
            })
            ->editColumn('target_platform', function ($ad) {
                return ucfirst($ad->target_platform ?? 'N/A');
            })
            ->editColumn('created_at', function ($ad) {
                return timeZoneFormatDate($ad->created_at);
            })
            ->addColumn('action', function ($ad) {
                $html = '<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . __('View') . '" title="' . __('View') . '" href="' . route('admin.features.audio-ads.view', ['id' => techEncrypt($ad->id)]) . '" class="action-icon"><i class="feather icon-eye"></i></a>&nbsp;';
                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\AudioAdsAdminController@delete'])) {
                    $html  .= '<form method="POST" action="' . route('admin.features.audio-ads.delete', ['id' => $ad->id]) . '" id="delete-audio-ad-' . $ad->id . '" accept-charset="UTF-8" class="display_inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a class="action-icon confirm-delete" type="button" data-id=' . $ad->id . ' data-delete="audio-ad" data-label="Delete" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Audio Ad')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . __('Delete') . '" title="' . __('Delete') . '">  
                                    <i class="feather icon-trash"></i>
                                </span> 
                            </a>
                            </form>';
                }
                return $html;
            })
            ->rawColumns(['title', 'user_id', 'status', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $audioAds = AudioAd::with(['user:id,name'])
            ->select([
                'audio_ads.id',
                'audio_ads.title',
                'audio_ads.ad_style',
                'audio_ads.target_platform',
                'audio_ads.status',
                'audio_ads.user_id',
                'audio_ads.created_at',
            ])
            ->orderBy('id', 'desc');
        
        return $this->applyScopes($audioAds);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('dataTableBuilder')
            ->minifiedAjax()
            ->selectStyleSingle()
            ->columns($this->getColumns())
            ->parameters(dataTableOptions(['dom' => 'Bfrtip']));
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            new Column(['data' => 'id', 'name' => 'id', 'title' => '', 'visible' => false, 'width' => '0%']),
            new Column(['data' => 'title', 'name' => 'title', 'title' => __('Title'), 'searchable' => true, 'orderable' => true, 'width' => '30%']),
            (new Column(['data' => 'ad_style', 'name' => 'ad_style', 'title' => __('Style'), 'searchable' => false, 'orderable' => true, 'width' => '12%']))->addClass('text-center'),
            (new Column(['data' => 'target_platform', 'name' => 'target_platform', 'title' => __('Platform'), 'searchable' => false, 'orderable' => true, 'width' => '12%']))->addClass('text-center'),
            (new Column(['data' => 'status', 'name' => 'status', 'title' => __('Status'), 'searchable' => false, 'orderable' => true, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data' => 'user_id', 'name' => 'user.name', 'title' => __('Created By'), 'orderable' => true, 'searchable' => true, 'width' => '12%']))->addClass('text-center'),
            (new Column(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width' => '14%']))->addClass('text-center'),
            new Column(['data' => 'action', 'name' => 'action', 'title' => '', 'width' => '10%', 'visible' => true, 'orderable' => false, 'searchable' => false, 'className' => 'text-right align-middle']),
        ];
    }
}
