<?php

namespace Modules\OpenAI\DataTables;

use App\DataTables\DataTable;
use Yajra\DataTables\Html\Column;
use Illuminate\Http\JsonResponse;
use Modules\OpenAI\Entities\Avatar;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AvatarDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $avatar = $this->query();

        return DataTables::eloquent($avatar)
        ->editColumn('image', function ($avatar) {
            return '<img class="object-fit-cover" src="' . $avatar->image_url  . '" alt="' . __('image') . '" width="50" height="50">';
        })
        ->editColumn('name', function ($avatar) {
            return ucfirst($avatar->name);
        })
        ->editColumn('gender', function ($avatar) {
            return ucfirst($avatar->gender);
        })
        ->editColumn('type', function ($avatar) {
            return ucfirst(str_replace('_', ' ', $avatar->type));
        })
        ->editColumn('provider', function ($avatar) {
            return ucfirst($avatar->provider);
        })
        ->editColumn('user_id', function ($avatar) {
            return '<a href="' . route('users.edit', ['id' => $avatar->user_id]) . '">' . wrapIt(optional($avatar->user)->name, 10) . '</a>';
        })
        ->editColumn('created_at', function ($avatar) {
            return timeZoneFormatDate($avatar->created_at);
        })

        ->rawColumns([ 'image', 'status', 'user_id', 'action'])
        ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $avatars = Avatar::with(['metas', 'user'])
            ->join('avatar_metas', 'avatars.id', '=', 'avatar_metas.owner_id')
            ->where('avatar_metas.key', 'image_url')
            ->where([
                'avatars.status' => 'Active'
            ])
            ->select([
                'avatars.id',
                'avatars.avatar_id',
                'avatars.name',
                'avatars.gender',
                'avatars.provider',
                'avatars.type',
                'avatars.user_id',
                'avatar_metas.value as image_url',
                'avatars.created_at',
            ])->filter();

        return $this->applyScopes($avatars);
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
            new Column(['data' => 'image', 'name' => 'picture', 'title' => __('Picture'), 'orderable' => false, 'searchable' => false]),
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'orderable' => true]),
            (new Column(['data'=> 'gender', 'name' => 'gender', 'width' => '15%', 'title' => __('All Gender'), 'orderable' => true, 'searchable' => true, 'width' => '15%' ]))->addClass('text-center'),
            (new Column(['data'=> 'provider', 'name' => 'provider', 'width' => '15%', 'title' => __('Provider'), 'orderable' => true, 'searchable' => true, 'width' => '15%' ]))->addClass('text-center'),
            (new Column(['data'=> 'type', 'name' => 'type', 'title' => __('Feature'), 'orderable' => true, 'searchable' => true, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'user_id', 'name' => 'user_id', 'title' => __('Created By'), 'orderable' => true, 'searchable' => true, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'avatars.created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width' => '10%' ]))->addClass('text-center'),
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
