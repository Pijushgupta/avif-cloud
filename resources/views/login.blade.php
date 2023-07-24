@extends('layouts.login.login')
@include('layouts.login.nav')
@section('content')
{{-- login/register area --}}
<div>
	<div class="container mx-auto px-2">
		<div class="h-screen flex justify-center items-center">
			<div id="login" class="w-[350px] border rounded-lg ">
				<h2 class="px-4 py-2 border-b">Login</h2>
				@if(Session::has('error'))
					<p class="error">Session Error</p>
				@endif
				
				
				<form action="{{ route('login')}}"  class="flex flex-col mb-0 p-4" method="POST">
					@csrf
					@method('post')
					<input name="email" type="email" placeholder="Email" class="border-gray-300  w-full  my-1 text-sm rounded" />
					@if($errors->has('email'))
					<p class="error">{{$errors->first('email')}}</p>
					@endif
					
					<input name="password" type="password" placeholder="Password" class="border-gray-300 w-full  my-1 text-sm rounded" />
					@if($errors->has('password'))
					<p class="error">{{$errors->first('password')}}</p>
					@endif

					<div class="flex flex-row justify-between items-center mt-1">
						
						<label for="remember" class="cursor-pointer "><input id="remember" name="remember" type="checkbox"  class="mr-2"/>Remembar me </label>
						<input name="submit" type="submit" value="Login" class="bg-blue-900 text-white rounded py-2 cursor-pointer px-4">
					</div>
					<a href="/recoverPassword" class="mt-3 underline">Forgot password</a>
					
				</form>
			</div>

	</div>
	</div>
</div>	
{{-- login/register area --}}
@endsection