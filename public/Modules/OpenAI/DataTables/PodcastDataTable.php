<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Podcast;

class PodcastDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $podcasts = $this->query();

        return DataTables::eloquent($podcasts)
            ->editColumn('title', function ($podcast) {
                return '<a data-bs-toggle="tooltip" data-bs-placement="top" title="' . e($podcast->title) . '" href="' . route('admin.features.podcast.view', ['id' => techEncrypt($podcast->id)]) . '">' . trimWords(ucfirst($podcast->title), 60) . '</a>';
            })
            ->editColumn('user_id', function ($podcast) {
                return '<a href="' . route('users.edit', ['id' => $podcast->user_id]) . '">' . optional($podcast->user)->name . '</a>';
            })
            ->editColumn('status', function ($podcast) {
                $statusColors = [
                    'pending' => 'warning',
                    'processing' => 'info',
                    'completed' => 'success',
                    'failed' => 'danger',
                ];
                $color = $statusColors[$podcast->status] ?? 'secondary';
                return '<span class="badge badge-' . $color . '">' . ucfirst($podcast->status) . '</span>';
            })
            ->editColumn('tier', function ($podcast) {
                $tierColors = [
                    'free' => 'secondary',
                    'premium' => 'primary',
                ];
                $color = $tierColors[$podcast->tier] ?? 'secondary';
                return '<span class="badge badge-' . $color . '">' . ucfirst($podcast->tier) . '</span>';
            })
            ->editColumn('provider', function ($podcast) {
                return ucfirst($podcast->provider ?? 'N/A');
            })
            ->editColumn('created_at', function ($podcast) {
                return timeZoneFormatDate($podcast->created_at);
            })
            ->addColumn('action', function ($podcast) {
                $html = '<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . __('View') . '" title="' . __('View') . '" href="' . route('admin.features.podcast.view', ['id' => techEncrypt($podcast->id)]) . '" class="action-icon"><i class="feather icon-eye"></i></a>&nbsp;';
                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\PodcastAdminController@delete'])) {
                    $html  .= '<form method="POST" action="' . route('admin.features.podcast.delete', ['id' => $podcast->id]) . '" id="delete-podcast-' . $podcast->id . '" accept-charset="UTF-8" class="display_inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a class="action-icon confirm-delete" type="button" data-id=' . $podcast->id . ' data-delete="podcast" data-label="Delete" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Podcast')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . __('Delete') . '" title="' . __('Delete') . '">  
                                    <i class="feather icon-trash"></i>
                                </span> 
                            </a>
                            </form>';
                }
                return $html;
            })
            ->rawColumns(['title', 'user_id', 'status', 'tier', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $podcasts = Podcast::with(['user:id,name'])
            ->select([
                'podcasts.id',
                'podcasts.title',
                'podcasts.topic',
                'podcasts.status',
                'podcasts.tier',
                'podcasts.provider',
                'podcasts.user_id',
                'podcasts.created_at',
            ])
            ->orderBy('id', 'desc');
        
        return $this->applyScopes($podcasts);
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
            (new Column(['data' => 'status', 'name' => 'status', 'title' => __('Status'), 'searchable' => false, 'orderable' => true, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data' => 'tier', 'name' => 'tier', 'title' => __('Tier'), 'searchable' => false, 'orderable' => true, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data' => 'provider', 'name' => 'provider', 'title' => __('Provider'), 'searchable' => false, 'orderable' => true, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data' => 'user_id', 'name' => 'user.name', 'title' => __('Created By'), 'orderable' => true, 'searchable' => true, 'width' => '15%']))->addClass('text-center'),
            (new Column(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width' => '15%']))->addClass('text-center'),
            new Column(['data' => 'action', 'name' => 'action', 'title' => '', 'width' => '10%', 'visible' => true, 'orderable' => false, 'searchable' => false, 'className' => 'text-right align-middle']),
        ];
    }
}
