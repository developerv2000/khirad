<h1>Новое сообщение из сайта <a href="{{ route('home') }}" target="_blank">{{ route('home') }}</a></h1>
<p><b>Имя : </b>{{$request->name}}</p>
<p><b>Почта : </b>{{$request->email}}</p>
<p><b>Тема : </b>{{$request->theme}}</p>
<p><b>Текст : </b>{{$request->body}}</p>