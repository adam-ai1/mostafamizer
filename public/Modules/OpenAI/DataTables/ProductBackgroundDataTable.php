<?php

namespace Modules\OpenAI\DataTables;

use App\DataTables\DataTable;
use Yajra\DataTables\Html\Column;
use Illuminate\Http\JsonResponse;
use Modules\OpenAI\Entities\Archive;
use Modules\OpenAI\Entities\ProductBackground;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProductBackgroundDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $background = $this->query();

        return DataTables::eloquent($background)
            ->addColumn('image', function ($background) {
                return '<img src="' .  $background->file_url  . '" alt="' . __('Image') . '" class ="data-table-image">';
            })
            ->editColumn('name', function ($background) {
                return trimWords($background->name, 40);
            })
            ->editColumn('user_id', function ($background) {
                return '<a href="' . route('users.edit', ['id' => $background->user_id]) . '">' . optional($background->user)->name . '</a>';
            })
            ->editColumn('status', function ($background) {
                return statusBadges(lcfirst($background->status));
            })
            ->editColumn('created_at', function ($background) {
                return timeZoneFormatDate($background->created_at);
            })
            ->rawColumns(['image', 'user_id', 'status'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $backgrounds = ProductBackground::with(['user'])->where('product_backgrounds.status', 'Active');
        return $this->applyScopes($backgrounds);

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
            new Column(['data'=> 'image', 'name' => 'image', 'title' => __('Image'), 'searchable' => true, 'orderable' => true, 'width'=>'15%']),
            new Column(['data'=> 'name', 'name' => 'product_backgrounds.name', 'title' => __('Name'), 'searchable' => true, 'orderable' => true, 'width'=>'20%']),
            (new Column(['data'=> 'user_id', 'name' => 'user.name', 'title' => __('Creator'), 'orderable' => true, 'searchable' => true, 'width'=>'25%']))->addClass('text-center'),
            (new Column(['data'=> 'status', 'name' => 'status', 'title' => __('Status'), 'orderable' => true, 'searchable' => true, 'width'=>'10%']))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width'=>'15%']))->addClass('text-center'),
        ];
    }

}
