<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\VoxChat\Entities\VoxConversation;

class VoxChatDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $conversations = $this->query();

        return DataTables::eloquent($conversations)
            ->editColumn('title', function ($conversation) {
                $title = $conversation->title ?? $conversation->display_title ?? __('Conversation #') . $conversation->id;
                return '<a data-bs-toggle="tooltip" data-bs-placement="top" title="' . e($title) . '" href="' . route('admin.features.voxchat.view', ['id' => techEncrypt($conversation->id)]) . '">' . trimWords(ucfirst($title), 60) . '</a>';
            })
            ->editColumn('user_id', function ($conversation) {
                return '<a href="' . route('users.edit', ['id' => $conversation->user_id]) . '">' . optional($conversation->user)->name . '</a>';
            })
            ->editColumn('ai_model', function ($conversation) {
                return '<span class="badge badge-primary">' . ($conversation->ai_model ?? 'gpt-4o') . '</span>';
            })
            ->addColumn('messages_count', function ($conversation) {
                return $conversation->messages_count ?? $conversation->messages()->count();
            })
            ->editColumn('total_tokens', function ($conversation) {
                return number_format($conversation->total_tokens ?? 0);
            })
            ->editColumn('created_at', function ($conversation) {
                return timeZoneFormatDate($conversation->created_at);
            })
            ->addColumn('action', function ($conversation) {
                $html = '<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . __('View') . '" title="' . __('View') . '" href="' . route('admin.features.voxchat.view', ['id' => techEncrypt($conversation->id)]) . '" class="action-icon"><i class="feather icon-eye"></i></a>&nbsp;';
                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\VoxChatAdminController@delete'])) {
                    $html  .= '<form method="POST" action="' . route('admin.features.voxchat.delete', ['id' => $conversation->id]) . '" id="delete-voxchat-' . $conversation->id . '" accept-charset="UTF-8" class="display_inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a class="action-icon confirm-delete" type="button" data-id=' . $conversation->id . ' data-delete="voxchat" data-label="Delete" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Conversation')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="' . __('Delete') . '" title="' . __('Delete') . '">  
                                    <i class="feather icon-trash"></i>
                                </span> 
                            </a>
                            </form>';
                }
                return $html;
            })
            ->rawColumns(['title', 'user_id', 'ai_model', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $conversations = VoxConversation::with(['user:id,name'])
            ->withCount('messages')
            ->select([
                'vox_chat_conversations.id',
                'vox_chat_conversations.title',
                'vox_chat_conversations.ai_model',
                'vox_chat_conversations.voice_gender',
                'vox_chat_conversations.total_tokens',
                'vox_chat_conversations.user_id',
                'vox_chat_conversations.created_at',
            ])
            ->orderBy('id', 'desc');
        
        return $this->applyScopes($conversations);
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
            new Column(['data' => 'title', 'name' => 'title', 'title' => __('Conversation'), 'searchable' => true, 'orderable' => true, 'width' => '30%']),
            (new Column(['data' => 'ai_model', 'name' => 'ai_model', 'title' => __('AI Model'), 'searchable' => false, 'orderable' => true, 'width' => '12%']))->addClass('text-center'),
            (new Column(['data' => 'messages_count', 'name' => 'messages_count', 'title' => __('Messages'), 'searchable' => false, 'orderable' => false, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data' => 'total_tokens', 'name' => 'total_tokens', 'title' => __('Tokens'), 'searchable' => false, 'orderable' => true, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data' => 'user_id', 'name' => 'user.name', 'title' => __('User'), 'orderable' => true, 'searchable' => true, 'width' => '14%']))->addClass('text-center'),
            (new Column(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width' => '14%']))->addClass('text-center'),
            new Column(['data' => 'action', 'name' => 'action', 'title' => '', 'width' => '10%', 'visible' => true, 'orderable' => false, 'searchable' => false, 'className' => 'text-right align-middle']),
        ];
    }
}
