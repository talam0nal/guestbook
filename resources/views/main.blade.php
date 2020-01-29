@extends ('layouts.layout')

@section ('content')
    <div class="container">

        {{-- Сообщения --}}
        <div class="row">
            <div class="col-12">
                @foreach ($messages as $message)

                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $message->created_at }} {{ $message->user->email }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $message->text }}</p>
                            @if ($message->image)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <img src="{{ Storage::url($message->image) }}">
                                    </div>
                                </div>
                            @endif
                            @auth
                                <a href="#" class="btn btn-primary btn-sm reply-btn" data-id="{{ $message->id }}">Ответить</a>
                            @endauth
                        </div>
                    </div>

                    <div class="row replies-list">
                        @if (count($message->replies))
                            @foreach ($message->replies as $reply)
                                <div class="col-sm-11 offset-sm-1 col-11 offset-1">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            {{ $reply->created_at }} {{ $reply->user->email }}
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">{{ $reply->text }}</p>
                                            @if ($reply->image)
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <img src="{{ Storage::url($reply->image) }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @auth
                        <div class="row mb-3 hidden reply{{ $message->id }} reply-form">
                            <div class="col-sm-11 offset-sm-1 col-11 offset-1">
                                <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $message->id }}">
                                    <input type="hidden" class="validate-destination" value="{{ route('messages.validate') }}">
                                    <div class="form-group">
                                        <label for="text">Ответ:</label>
                                        <textarea class="form-control text" id="text" rows="3" name="text" required placeholder="Введите сообщение"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Изображение:</label>
                                        <input type="file" name="image" class="form-control-file file-picker" id="image" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-success send-message">Ответить</button>
                                    <div class="alert alert-primary mt-3 notification hidden" role="alert">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endauth

                @endforeach
            </div>
        </div>

        {{-- Форма отправки сообщения --}}
        <div class="row">
            <div class="col-12 col-lg-6">
                @auth
                    <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="parent_id" value="0">
                        <input type="hidden" class="validate-destination" value="{{ route('messages.validate') }}">
                        <div class="form-group">
                            <label for="text">Сообщение:</label>
                            <textarea class="form-control text" id="text" rows="3" name="text" required placeholder="Введите сообщение"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Изображение:</label>
                            <input type="file" name="image" class="form-control-file file-picker" id="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success send-message">Отправить сообщение</button>
                        <div class="alert alert-primary mt-3 notification hidden" role="alert">
                        </div>
                    </form>
                    @else
                        <div class="alert alert-primary" role="alert">
                            Только авторизованнные пользователи могут оставлять сообщения
                        </div>
                @endauth
            </div>
        </div>

        {{-- Пагинация --}}
        <div class="row mt-3">
            <div class="col-12">
                {{ $messages->links() }}
            </div>
        </div>

    </div>
@endsection