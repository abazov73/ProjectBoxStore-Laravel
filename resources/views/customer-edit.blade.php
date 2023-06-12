@extends('layout')
@section('content')
<form @if ($customer != null)
action="/customer/{{$customer->id}}"
@else
action="/customer"
@endif  method="post">
    @if ($customer != null) <input name="_method" type="hidden" value="PUT"> @endif
    <div class="mb-3">
      <label for="last_name" class="form-label">Фамилия</label>
      <input type="text" class="form-control" id="last_name" name="last_name" required="true" @if ($customer != null) value="{{$customer->last_name}}" @endif>
    </div>
    <div class="mb-3">
      <label for="first_name" class="form-label">Имя</label>
      <input type="text" class="form-control" id="first_name" name="first_name" required="true" @if ($customer != null) value="{{$customer->first_name}}" @endif>
    </div>
    <div class="mb-3">
      <label for="middle_name" class="form-label">Отчество</label>
      <input type="text" class="form-control" id="middle_name" name="middle_name" required="true" @if ($customer != null) value="{{$customer->middle_name}}" @endif>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-primary button-fixed">
        Добавить
      </button>
      <a class="btn btn-secondary button-fixed" href="/customer">
        Назад
      </a>
    </div>
  </form>
@endsection