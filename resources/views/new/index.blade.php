@extends('layouts.admin')
@section('content')
    <main>
        <div class="container">
            <h1 class="card-title text-center" data-aos="fade-up">{{__("Новини")}}</h1>
            @auth()
                <div class="btn btn-primary">
                    <a href="{{route('admin.new.create')}}" class="text-white link-underline"> {{__('Додати новину')}}</a>
                </div>
            @endauth
            <section class=" pt-2 bg-body-tertiary">
                <div class="row">
                    <div class="row col-md-12">
                        @foreach($news as $itemNews)
                            <div class="card pt-2 m-3" style="width: 21rem;">
                                <img src="{{asset('storage/'. $itemNews->image)}}" class="card-img-top" alt="image news">
                                <div class="card-body">
                                    <a href="{{route("new.show", $itemNews->id)}}" class="">
                                        <h5 class="card-title card-link">{{$itemNews->title}}</h5>
                                    </a>
                                    <p class="card-text">{{$itemNews->updated_at->format('d M Y')}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <div class="pagination">
                {{$news->links()}}
            </div>
        </div>
    </main>
@endsection
