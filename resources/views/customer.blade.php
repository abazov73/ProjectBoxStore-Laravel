@extends('layout')

@section('content')
<div class="m-2">
    <a style="width: 200px" class="btn btn-success button-fixed"
       href="/customer/edit/">
        Добавить
    </a>
</div>
<div class="table-responsive">
    <table class="table table-info table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Отчество</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
        <tr>
            <th style="text-align: center" scope="row">{{$loop->iteration}}</th>
            <td>{{$customer->last_name}}</td>
            <td>{{$customer->first_name}}</td>
            <td>{{$customer->middle_name}}</td>
            <td style="width: 10%">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-warning button-fixed button-sm"
                       href="/customer/edit/{{$customer->id}}">
                       Изменить
                    </a>
                    {{-- <button type="button" class="btn btn-danger button-fixed button-sm"
                            th:attr="onclick=|confirm('Удалить запись?') && document.getElementById('remove-${customer.id}').click()|">
                        <i class="fa fa-trash" aria-hidden="true"></i> Удалить
                    </button> --}}
                </div>
                {{-- <form th:action="@{/customer/delete/{id}(id=${customer.id})}" method="post">
                    <button th:id="'remove-' + ${customer.id}" type="submit" style="display: none">
                        Удалить
                    </button>
                </form> --}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection