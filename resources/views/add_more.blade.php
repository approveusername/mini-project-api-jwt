@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="user-form" method="POST" action="{{ route('add_more.store') }}" enctype="multipart/form-data">
        @csrf
        <div id="user-container" class="container">
            @php
                $users = session('saved_users') ?? old('users', [['name' => '', 'email' => '', 'address' => '', 'gender' => '', 'images' => [''], 'languages' => ['']]]);
            @endphp
            @foreach ($users as $index => $user)
                <div class="user-entry row g-3 mb-4" id="user-{{ $index }}">
                    <div class="col-md-4">
                        <input type="text" class="form-control @error("users.$index.name") is-invalid @enderror" name="users[{{ $index }}][name]" value="{{ $user['name'] }}" placeholder="Name">
                        @error("users.$index.name") <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="email" class="form-control @error("users.$index.email") is-invalid @enderror" name="users[{{ $index }}][email]" value="{{ $user['email'] }}" placeholder="Email">
                        @error("users.$index.email") <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <textarea class="form-control @error("users.$index.address") is-invalid @enderror" name="users[{{ $index }}][address]" placeholder="Address">{{ $user['address'] }}</textarea>
                        @error("users.$index.address") <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <select class="form-select @error("users.$index.gender") is-invalid @enderror" name="users[{{ $index }}][gender]">
                            <option value="male" {{ $user['gender'] == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user['gender'] == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user['gender'] == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error("users.$index.gender") <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 languages">
                        @foreach ($user['languages'] ?? [''] as $langIndex => $language)
                            <div class="input-group mb-2" id="language-{{ $index }}-{{ $langIndex }}">
                                <input type="text" class="form-control @error("users.$index.languages.$langIndex") is-invalid @enderror" name="users[{{ $index }}][languages][{{ $langIndex }}]" value="{{ $language }}" placeholder="Language">
                                @if ($langIndex > 0) <button type="button" class="btn btn-danger remove-language">Delete</button> @endif
                                @error("users.$index.languages.$langIndex") <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-success add-language">Add Language</button>
                    </div>
                    <div class="col-md-4 user-images">
                        @foreach ($user['images'] ?? [''] as $imgIndex => $image)
                            <div class="input-group mb-2" id="image-{{ $index }}-{{ $imgIndex }}">
                                <input type="file" class="form-control @error("users.$index.images.$imgIndex") is-invalid @enderror" name="users[{{ $index }}][images][{{ $imgIndex }}]" accept="image/*">
                                @if ($imgIndex > 0) <button type="button" class="btn btn-danger remove-image">Delete</button> @endif
                                @error("users.$index.images.$imgIndex") <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-success add-image">Add Image</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-end">
            <button type="button" id="add-user" class="btn btn-primary">Add User</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        let userIndex = {{ count($users) }};
        
        // Add new user
        $('#add-user').click(() => {
            const newUserDiv = `
                <div class="user-entry row g-3 mb-4" id="user-${userIndex}">
                    <div class="col-md-4"><input type="text" class="form-control" name="users[${userIndex}][name]" placeholder="Name"></div>
                    <div class="col-md-4"><input type="email" class="form-control" name="users[${userIndex}][email]" placeholder="Email"></div>
                    <div class="col-md-4"><textarea class="form-control" name="users[${userIndex}][address]" placeholder="Address"></textarea></div>
                    <div class="col-md-4">
                        <select class="form-select" name="users[${userIndex}][gender]">
                            <option value="male">Male</option><option value="female">Female</option><option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 languages">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="users[${userIndex}][languages][]" placeholder="Language">
                        </div>
                        <button type="button" class="btn btn-success add-language">Add Language</button>
                    </div>
                    <div class="col-md-4 user-images">
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" name="users[${userIndex}][images][]" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-success add-image">Add Image</button>
                    </div>
                    <div class="col-12"><button type="button" class="btn btn-danger remove-user">Remove User</button></div>
                </div>`;
            $('#user-container').append(newUserDiv);
            userIndex++;
        });

        // Add new language
        $(document).on('click', '.add-language', function () {
            const userDiv = $(this).closest('.user-entry');
            const langIndex = userDiv.find('.languages input').length;
            userDiv.find('.languages').append(`
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="users[${userDiv.index()}][languages][${langIndex}]" placeholder="Language">
                    <button type="button" class="btn btn-danger remove-language">Delete</button>
                </div>`);
        });

        // Add new image
        $(document).on('click', '.add-image', function () {
            const userDiv = $(this).closest('.user-entry');
            const imgIndex = userDiv.find('.user-images input').length;
            userDiv.find('.user-images').append(`
                <div class="input-group mb-2">
                    <input type="file" class="form-control" name="users[${userDiv.index()}][images][${imgIndex}]" accept="image/*">
                    <button type="button" class="btn btn-danger remove-image">Delete</button>
                </div>`);
        });

        // Remove user/language/image
        $(document).on('click', '.remove-user', function () { $(this).closest('.user-entry').remove(); });
        $(document).on('click', '.remove-language', function () { $(this).closest('.input-group').remove(); });
        $(document).on('click', '.remove-image', function () { $(this).closest('.input-group').remove(); });
    });
</script>
@endsection
