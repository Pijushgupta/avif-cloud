@extends('layouts.login.login')
@include('layouts.login.nav')
@section('content')
{{-- login/register area --}}
<div>
	<div class="container mx-auto px-2">
		<div class="h-screen flex justify-center items-center">
			<div id="login" class="w-[350px] border rounded-lg ">
				<h2 class="px-4 py-2 border-b" >Register</h2>
				@if(Session::has('error'))
					<p class="error">Session Error</p>
				@endif
				
				
				<form action="{{ route('register')}}"  class="flex flex-col mb-0 p-4" method="POST">
					@csrf
					@method('post')
                    <input name="fname" value="{{old('fname')}}" type="text" placeholder="First name" class="border-gray-300  w-full  my-1 text-sm rounded" />
					@if($errors->has('fname'))
					<p class="error">{{$errors->first('fname')}}</p>
					@endif
                    <input name="lname" value="{{old('lname')}}" type="text" placeholder="Last name" class="border-gray-300  w-full  my-1 text-sm rounded" />
					@if($errors->has('lname'))
					<p class="error">{{$errors->first('lname')}}</p>
					@endif

					<input name="email" value="{{old('email')}}" type="email" placeholder="Email" class="border-gray-300  w-full  my-1 text-sm rounded" />
					@if($errors->has('email'))
					<p class="error">{{$errors->first('email')}}</p>
					@endif
					
					
					<div class="relative">
						<input name="password" type="text"  placeholder="Password: minimum 12 charecters" class="border-gray-300 w-full  my-1 text-sm rounded reg-pass" />
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-8 h-8 absolute top-2 right-1 border-l pl-1 pass-fill" data="reg-pass"> <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z" /> </svg>
					  
					</div>
					
					@if($errors->has('password'))
					<p class="error">{{$errors->first('password')}}</p>
					@endif

                    <input name="password_confirmation"  type="text" placeholder="Confirm Password" class="border-gray-300 w-full  my-1 text-sm rounded reg-pass" />
					@if($errors->has('confirmPassword'))
					<p class="error">{{$errors->first('password_confirmation')}}</p>
					@endif

					<div class="flex flex-row justify-end items-center mt-1 ">
						
						
						<input name="submit" type="submit" value="Register" class="bg-blue-900 text-white rounded py-2 cursor-pointer px-4">
					</div>
					
				</form>
			</div>

	</div>
	</div>
</div>	
{{-- login/register area --}}
@endsection