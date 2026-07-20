@if ($errors->any() || session('error_message'))
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
            @if (session('error_message'))
                <li>{{session('error_message')}}</li>
            @endif
        </ul>
    </div>
@endif