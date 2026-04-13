<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="photo" accept="image/">
        @error('photo')
            {{ $message }}
        @enderror
        @if(session('success'))
            {{ session('success') }}
        @endif
        <input type="submit" value="submit">
   </form>
   <img src="{{asset('storage/images/uJq4IiZtSjeUOds5kBYE2CqagukZDCb1i6YDfHHS.webp')}}" alt="">
</body>
</html>