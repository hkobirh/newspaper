@extends("backend.app")

@section("title")
    Manage category
@endsection

@section("main-content")

    <div class="text-end">
        <a href="{{route('category.form')}}" class="btn btn-info mt-3">Create category</a>
    </div>
    <div class="mt-3">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>SL NO</td>
                <td>Category name</td>
                <td>Slug</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{++$loop->index}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>{{$category->status}}</td>
                    <td>
                        <a href="{{route('category.edit',$category->id)}}">Edit</a>
                        <form action="{{route('category.delete',$category->id)}}" method="post">
                            @csrf
                            <a href="{{route('category.delete',$category->id)}}" onclick="event.preventDefault(); this.closest('form').submit()">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
