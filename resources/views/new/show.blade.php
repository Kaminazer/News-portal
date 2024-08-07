@extends('layouts.admin')
@section('content')
    <main class="container-fluid">
        <div class="mb-2 pt-5 d-flex justify-content-between align-items-center">
            <div class="col-sm-6">
                <h1 class="card-header" data-aos="fade-up">{{$itemNews->title}}</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end align-items-center">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item ">
                        <a href="javascript:history.back()">{{__('Попередня сторінка')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{$itemNews->title}}</li>
                </ol>
            </div>
        </div><!-- /.row -->
        <div class="container">
            @auth()
                <div class="btn-group mb-1 pt-2 flex justify-content-around align-items-center">
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
                @guest()
                    <small class="text-danger"> Щоб видалити або змінити новину увійдіть або зареєструйтесь на сайті! </small>
                @endguest

                <p class="card-subtitle mb-5" data-aos="fade-up" data-aos-delay="200">Створено : {{$itemNews->created_at->format('F d,  Y')}}</p>

            <section class="text-center" data-aos="fade-up" data-aos-delay="300">
                <img src="{{asset('storage/' . $itemNews->image)}}" alt="image" class="img-thumbnail">
            </section>
            <section class="card-text mt-4">
                {!!  $itemNews->content!!}
            </section>
            <div>
                <a href="{{route('new.show', $previousNewsId)}}">Previous new</a>
                <a href="{{route('new.show', $nextNewsId)}}">Next new</a>
            </div>
        </div>
    </main>
@endsection
