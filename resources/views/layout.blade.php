<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8"/>
  <title>BoxStore</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="icon" href="{{asset('/favicon.ico')}}">
  <link href="{{asset('/css/app.css')}}" rel="stylesheet">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<header>
  <div class="d-flex flex-row headerContainer">
    <nav class="navbar navbar-expand-md">
      <div class="container-fluid" id="navigationMenu">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-row ml-3 ms-3 mt-auto mb-auto align-items-center">
          <a>
            <img src="{{ asset('/images/logo.png') }}" alt="*" width="60" height="60" class="align-text-top"/>
          </a>
          <div id="logoName">
            <a href="/">boxStore</a>
          </div>
        </div>
        <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav" id="headerNavigation">
            <a class="nav-link headNav" href="/customer">Клиенты</a>
            <a class="nav-link headNav" href="/store">Магазины</a>
            <a class="nav-link headNav" href="/product">Товары</a>
            <a class="nav-link headNav" href="/order">Заказы</a>
            <a class="nav-link headNav" href="/addToStore">Доставка</a>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
<div class="container-fluid">
  <div class="container container-padding">
    @yield('content')
  </div>
</div>
</body>
</html>