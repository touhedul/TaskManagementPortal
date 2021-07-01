<?php

namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class AdminDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.admins.datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '');
        // ->addColumn('details',function($dataTable){
        //     return Str::limit($dataTable->details,50);
        // })
        // ->addColumn('image', function ($dataTable) {
        //     return "<img src='".asset('images/'.$dataTable->image)."'/>";
        // })
        // ->addColumn('file',function($dataTable){
        //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
        // })
        // ->rawColumns(['details', 'action', 'image', 'file']);
    }

    public function query(Admin $model)
    {
        return $model->newQuery()->where('super_admin', 0)->latest();
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
            'dom'       => 'lBfrtip',
            'lengthMenu' => [[20, 40, 60, 100, -1], ['20', '40', '60', '100', 'All']],
            'stateSave' => true,
            'oLanguage' => [
                'sLengthMenu' => "_MENU_",
            ],
            'buttons' => ['create', 'csv', 'excel', 'print', 'reset'],
            ]);
    }

    protected function getColumns()
    {
        return [
            'Sl', 'name',
            'email',
        ];
    }

    protected function filename()
    {
        return 'admins_datatable_' . time();
    }
}
