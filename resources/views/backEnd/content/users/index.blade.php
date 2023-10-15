@extends('backEnd/layouts/navbarLayout')

@empty($type)
    @section('title', __('menu.users.title'))
@else
@section('title', __('menu.users.' . $type))
@endempty

@section('aboveContent')
<div class="above-content mt-4">
    <div class="m-filter">
        {{-- .. --}}
    </div>
    <div class="m-buttons">
        @empty(!$type)
            <a href="{{ route('admin:users:create', ['type' => $type]) }}" type="button"
                class="btn bg-gradient-info w-100 mx-2">@lang('admin.create')</a>
        @endempty
        <a href="javascript:;" type="button" id="refresh" class="btn bg-gradient-info w-100 mx-2">@lang('admin.refresh')</a>
    </div>
</div>
@endsection

@section('content')
<table class="table data-table">
    <thead>
        <tr>
            <th>@lang('admin.datatable_view.users.image')</th>
            {{-- <th>@lang('admin.datatable_view.users.id')</th> --}}
            <th>@lang('admin.datatable_view.users.name')</th>
            <th>@lang('admin.datatable_view.users.email')</th>
            <th>@lang('admin.datatable_view.users.type')</th>
            <th>@lang('admin.datatable_view.users.created_at')</th>
            <th>@lang('admin.datatable_view.users.actions')</th>
        </tr>
    </thead>
</table>
@endsection

@section('page-script')
<script>
    $(function() {
        $.extend(options, {
            ajax: {
                url: "{!! route('admin:users:dataTable') !!}",
                method: "GET",
                data: {
                    'type': "{!! $type !!}"
                },
            },
            columns: [{
                    data: 'image',
                    name: 'image'
                },
                // {
                //     data: 'id',
                //     name: 'id'
                // },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return dataTableActions(data, type, row, meta);
                    }
                }
            ]
        });

        let table = $('.data-table').DataTable(options);
        $("#refresh").on("click", function(e) {
            e.preventDefault(), table.ajax.reload();
        });
    });
</script>
@endsection
