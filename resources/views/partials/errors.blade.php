@if(count($errors))
    <div class="notification error closeable">
        @foreach ($errors->all() as $message)
            <p>{{ $message }}</p>
        @endforeach
        <a class="close"></a>
    </div>
@endif