<x-layouts :categories="$categories">

    <x-slot name="title">
        Home page
    </x-slot>

    <main class="container">

        <div class="row g-5">
            <div class="col-md-8">
                <div class="bg-light p-4">
                    <form action="{{route('user.login')}}" method="post">
                        @csrf
                        <div class="text-center"><h3>Login</h3></div>
                        @if(session('success'))
                            <div class="alert-success form-control mb-3 text-center">
                                {{ session('success')  }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email address <font
                                    class="text-danger">*</font></label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{old('email')}}" placeholder="Enter your email address">
                            <span class="text-danger">
                                @error('email')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password <font
                                    class="text-danger">*</font></label>
                            <input type="password" class="form-control" id="password" name="password"
                                   value="{{old('password')}}" placeholder="Password">
                            <span class="text-danger">
                                @error('password')
                                {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-info">Sign in</button>
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
