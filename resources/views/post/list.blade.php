<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3> List post</h3>
@foreach($posts as $post)
{{$post->title}}
@endforeach
</body>
</html>