@extends('layouts.admin')
@section('content')
    <div class="pb-3">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0">
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn" type="submit">{{__('Вийти')}}</button>
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
                            <th scope="col">Теги</th>
                            <th scope="col">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $itemNews)
                          <tr>
                            <td class="pt-3">{{$itemNews->id}}</td>
                            <td class="pt-3">
                              <a href="{{route('new.show', $itemNews->id)}}">{{$itemNews->title}}</a>
                            </td>
                            <td class="pt-3">{{$itemNews->status_display ? 'Активна' : 'Неактивна'}}</td>
                            <td class="pt-3">{{implode(',',$itemNews->tags->pluck('title')->toArray())}}</td>
                              <td>
                                  @auth()
                                      <div class="btn-group mb-1 pt-2 flex justify-content-between align-items-center">
                                          <div class="col-1 pt-1 me-1 rounded">
                                              <a href="{{route('admin.new.edit',$itemNews->id)}}" class="btn btn-primary text-white link-underline">{{__('Оновити')}}</a>
                                          </div>
                                          <div class="col-1">
                                              <form action="{{route('admin.new.destroy', $itemNews)}}" method="post" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('delete')
                                                  <button class= "btn btn-danger" type="submit" onclick="return confirm('Ви видалите новину остаточно. Ви впевнені ?')">Видалити</button>
                                              </form>
                                          </div>
                                          @endauth
                                      </div>
                              </td>
                         </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection
