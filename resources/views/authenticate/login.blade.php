<x-authenticate>
    @error('error')
    <span class="text-red-700 my-5 text-lg">{{$message}}</span>
    @enderror
    <h1 class="text-center bg-orange-500 p-3 text-2xl min-w-150 rounded-t-xl">Login Form</h1>
    <div class="p-4 bg-orange-300 min-w-150 rounded-b-xl">
        <form action="../in" class="justify-center items-center" method="post" id="form">
            @csrf
            <table class="mt-4 table-fixed">
                <tr class="m-5">
                    <td><label for="uid" class="text-blue-600 w-30 text-xl px-5">Email:</label></td>
                    <td>
                        <input type="text" class="grow min-w-105 h-10 text-black bg-white px-2" id="email" value="{{old('email')}}" name="email" placeholder="example@gmail.com" required>
                        <span id="uidError" class="text-red-700">@error('email') {{$message}} @enderror</span>
                    </td>
                </tr>
                <tr>
                    <td><label for="password" class="text-blue-600 w-30 text-xl my-5 px-5">Password:</label></td>
                    <td>
                        <input type="password" class="grow min-w-105 h-10 text-blue-800 mt-5 bg-red-100" name="password" value="{{old('password')}}" id="password" required>
                        <span id="pwErr" class="text-red-700">@error('password') {{$message}} @enderror</span>
                    </td>
                </tr>
                <tr>
                    <td class="p-2" colspan="2">
                        <div class="justify-around flex flex-row mt-5">
                            <input type="submit" class="p-2 bg-blue-700 border-1 border-green-500 text-xl rounded-xl"  id="submit" value="Login">
                            <input type="reset" class="p-2 bg-orange-700 border-1 border-red-500 text-xl rounded-xl" id="reset" value="Clear">
                        </div>
                    </td>
                </tr>
            </table><br>
            <p class="text-sm text-blue-700">Don't have an account? <a href="../register" class="text-lg underline text-green-700 ml-5">Register now</a></p>
        </form>
    </div>
</x-authenticate>