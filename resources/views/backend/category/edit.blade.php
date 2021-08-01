
@extends('backend.app')

@section('title','Update category')

@section('main-content')
    <div class="row mt-2">
        <div class="col-md-8 offset-2">
                <div class="bg-light p-4">
                    <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center"><h3>Update category</h3></div>
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
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{$category->name}}" placeholder="Enter first name"
                                   onkeyup="convertToSlug(this.value,'#slug')">
                            <span class="text-danger">
                                @error('name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label fw-bold">Slug <font
                                    class="text-danger">*</font></label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                   value="{{$category->slug}}"
                                   onkeyup="convertToSlug(this.value,'#slug')">
                            <span class="text-danger">
                                @error('slug')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="margin-right: 5px">Status <font
                                    class="text-danger">*</font></label>
                            <div class="col-sm-10 text-center d-inline-flex">
                                <div class="custom-control custom-radio custom-control-inline" style="margin-right: 5px">
                                    <input type="radio" checked id="active"  {{$category->status === 'active'? 'checked':''}} value="active" name="status" class="custom-control-input">
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="inactive"  {{$category->status === 'inactive'? 'checked':''}} value="inactive"  name="status" class="custom-control-input">
                                    <label class="custom-control-label" for="inactive">Inctive</label>
                                </div>
                            </div>

                        </div>

                        <div class="text-end">
                            <button class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div>
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
        </div>
   </div>
@endsection
