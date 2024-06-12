@extends('layouts.admin')
@section('content')
    <div class="container pb-3">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h1 m-0">{{ __('Додавання новини') }}</h1>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('new.index') }}">{{ __('Новини') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __("Додавання новини") }}</li>
                </ol>
            </div>
        </div>
        <div class="pb-3">
            <form action="{{ route('admin.new.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-6 mb-3">
                    <label for="title" class="form-label">{{ __('Заголовок') }}</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Введіть заголовок" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="text-danger pb-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="image" class="form-label">{{ __('Фото') }}</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    @error('image')
                    <div class="text-danger pb-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6 mb-3">
                    <label for="tags" class="form-label">{{ __('Теги') }}</label>
                    <input type="text" name="tags" class="form-control" id="tags" placeholder="Введіть теги через кому, без пропусків" value="{{ old('tags') }}" required>
                    @error('tags')
                    <div class="text-danger pb-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" col-6 mb-3">
                    <label for="summernote" class="form-label">{{ __('Текст новини') }}</label>
                    <textarea id="summernote" name="content" required>{{ old('content') }}</textarea>
                    @error('content')
                    <div class="text-danger pb-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status_display" class="form-label">{{ __("Показувати новину ?") }}</label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" id="option1" name="status_display" value="1" {{ old('status_display') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="option1">Так</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="option2" name="status_display" value="0" {{ old('status_display') == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="option2">Ні</label>
                    </div>
                    @error('status_display')
                    <div class="text-danger pb-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">{{ __('Додати') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
