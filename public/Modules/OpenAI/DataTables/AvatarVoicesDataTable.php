<?php

namespace Modules\OpenAI\DataTables;

use App\DataTables\DataTable;
use Yajra\DataTables\Html\Column;
use Illuminate\Http\JsonResponse;
use Modules\OpenAI\Entities\Voice;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AvatarVoicesDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $voice = $this->query();

        return DataTables::eloquent($voice)
            ->editColumn('name', function ($voice) {
                return empty($voice->name) ? '-' : ucfirst($voice->name);
            })
            ->editColumn('gender', function ($voice) {
                return ucfirst($voice->gender);
            })
            ->editColumn('status', function ($voice) {
                return statusBadges(lcfirst($voice->status));
            })
            ->editColumn('providers', function ($voice) {
                return ucFirst($voice->providers);
            })
            ->editColumn('user_id', function ($voice) {
                return '<a href="' . route('users.edit', ['id' => $voice->user_id]) . '">' . wrapIt(optional($voice->user)->name, 10) . '</a>';
            })
            ->editColumn('created_at', function ($voice) {
                return timeZoneFormatDate($voice->created_at);
            })
            ->editColumn('audio', function ($voice) {
                return '<audio controls class="audio-player">
                    <source src="' . $voice->file_name . '" type="audio/mpeg">
                </audio>';
            })

            ->rawColumns(['status', 'user_id', 'audio'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $voices = Voice::with(['metas', 'user'])->where(['status' => 'Active', 'type' => 'ai_persona'])->filter("Modules\\OpenAI\\Filters\\AvatarVoiceFilter");
        return $this->applyScopes($voices);
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
            new Column(['data'=> 'id', 'name' => 'id', 'title' => '', 'visible' => false, 'width' => '0%' ]),
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'orderable' => true]),
            (new Column(['data'=> 'gender', 'name' => 'gender', 'width' => '15%', 'title' => __('All Gender'), 'orderable' => true, 'searchable' => true, 'width' => '15%' ]))->addClass('text-center'),
            (new Column(['data'=> 'providers', 'name' => 'providers', 'width' => '15%', 'title' => __('Provider'), 'orderable' => true, 'searchable' => true, 'width' => '15%' ]))->addClass('text-center'),
            (new Column(['data'=> 'audio', 'name' => 'audio', 'title' => __('Audio'), 'orderable' => false, 'searchable' => false, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'user_id', 'name' => 'user_id', 'title' => __('Created By'), 'orderable' => true, 'searchable' => true, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'status', 'name' => 'status', 'title' => __('Status'), 'orderable' => true, 'searchable' => true, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width' => '10%' ]))->addClass('text-center'),
        ];
    }

    public function setViewData()
    {
        $statusCounts = $this->query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $this->data['groups'] = ['All' => $statusCounts->sum()] + $statusCounts->toArray();
    }

}
