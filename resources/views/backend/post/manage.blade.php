@extends("backend.app")

@section("title")
    Manage posts
@endsection

@section("main-content")
<div class="text-end">
    <a href="{{route('post.form')}}" class="btn btn-info mt-3">Create post</a>
</div>
    <div>
        <table class="table table-bordered table-striped table-hover mt-3">
            <tr>
                <td>SL NO</td>
                <td>Title</td>
                <td>Description</td>
                <td>Status</td>
                <td>Image</td>
                <td>Action</td>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{++$loop->index}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->status}}</td>
                    <td>
                        <img src="{{asset('uploads/post_images/'.$post->image)}}" alt="#" class="img-thumbnail" style="max-width: 150px; max-height: 100px;">
                    </td>
                    <td>
                        <a href="{{route('post.edit',$post->id)}}">Edit</a>
                        <form action="{{route('post.delete',$post->id)}}" method="post">
                            @csrf
                            <a href="{{route('post.delete',$post->id)}}" onclick="event.preventDefault(); this.closest('form').submit()">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
