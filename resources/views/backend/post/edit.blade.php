@extends('backend.app')

@section('title','Create post')

@section('main-content')
    <div class="row mt-2">
        <div class="col-md-8 offset-2">
            <div class="bg-light p-4">
                <form action="{{route('post.update',$posts->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center"><h3>Update post</h3></div>
                    {{--                        @if($errors->any())
                                                <div class="alert-danger form-control mb-3">
                                                    <ul>
                                                        @foreach($errors->all() as $error)
                                                            <li>{{$error}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif--}}

                    @if(session('success'))
                        <div class="alert-success form-control mb-3 text-center">
                            {{ session('success')  }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert-danger form-control mb-3 text-center">
                            {{ session('error')  }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Category name <font
                                class="text-danger">*</font></label>

                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select one</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($posts->category_id == $category->id) ? 'selected':''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                                @error('category_id')
                            {{$message}}
                            @enderror
                            </span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Title <font
                                class="text-danger">*</font></label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{$posts->title}}">
                        <span class="text-danger">
                                @error('title')
                            {{$message}}
                            @enderror
                            </span>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold"> Description <font
                                class="text-danger">*</font></label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3">
                            {{$posts->description}}
                        </textarea>
                        <span class="text-danger">
                                @error('description')
                            {{$message}}
                            @enderror
                            </span>

                        <span class="text-danger">
                                @error('slug')
                            {{$message}}
                            @enderror
                       </span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Image <font
                                class="text-danger">*</font></label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img src="{{asset('uploads/post_images/'.$posts->image)}}" alt="#" class="img-thumbnail w-25 h-25">
                        <span class="text-danger">
                                @error('image')
                            {{$message}}
                            @enderror
                            </span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="margin-right: 5px">Status <font
                                class="text-danger">*</font></label>
                        <div class="col-sm-10 text-center d-inline-flex">
                            <div class="custom-control custom-radio custom-control-inline" style="margin-right: 5px">
                                <input type="radio" checked id="active" value="active" name="status"
                                       class="custom-control-input" {{$posts->status === 'active'? 'checked':''}}>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="inactive" value="inactive" name="status"
                                       class="custom-control-input" {{$posts->status === 'inactive'? 'checked':''}}>
                                <label class="custom-control-label" for="inactive">Inctive</label>
                            </div>
                        </div>

                    </div>

                    <div class="text-end">
                        <button class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
            <hr>
            {{--                    <div>
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
                                </div>--}}
        </div>
@endsection
