@extends('layouts.admin')
@section('content')
    <div class="pb-3">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('admin.new.index')}}">
                                    Головна
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{route('admin.new.create')}}">
                                    Створити новину
                                </a>
                            </li>

                        </ul>
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <form action="{{route('logout')}}" method="post">
                                    <button type="submit" class="nav-link d-flex align-items-center gap-2">Вийти</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Усі новини</h1>
                </div>
                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Стан новини</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $itemNews)
                          <tr>
                            <td>{{$itemNews->id}}</td>
                            <td>
                              <a href="{{route('new.show', $itemNews->id)}}">{{$itemNews->title}}</a>
                            </td>
                            <td>{{$itemNews->status_display ? 'Активна' : 'Неактивна'}}</td>
                         </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection
