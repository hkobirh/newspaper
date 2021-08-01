<x-layouts :categories="$categories">

    <x-slot name="title">
        Home page
    </x-slot>

    <main class="container">

        <div class="row g-5">
            <div class="col-md-8">
                <div class="bg-light p-4">
                    <form action="{{route('user.signup')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center"><h3>Sign up form</h3></div>
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
                        <div class="mb-3">
                            <label for="first_name" class="form-label fw-bold">First name <font
                                    class="text-danger">*</font></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   value="{{old('first_name')}}" placeholder="Enter first name">
                            <span class="text-danger">
                                @error('first_name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label fw-bold">Last name <font
                                    class="text-danger">*</font></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{old('last_name')}}" placeholder="Enter last name">
                            <span class="text-danger">
                                @error('last_name')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email <font
                                    class="text-danger">*</font></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                                   placeholder="Enter email address">
                            <span class="text-danger">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password <font class="text-danger">*</font></label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Enter your password">
                            <span class="text-danger">
                                @error('password')
                                {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Image <font
                                    class="text-danger">*</font></label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-danger">
                                @error('image')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-info">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <x-about/>

                    <x-archives/>

                    <x-elsewhere/>
                </div>
            </div>
        </div>

    </main>
</x-layouts>
