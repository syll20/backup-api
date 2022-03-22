<div>
@if ($errors->any())
    <div class="alert alert-danger text-red-600 font-bold">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>