<x-authenticate>
   
    <h1 class="text-center bg-orange-500 p-3 text-2xl min-w-screen sm:min-w-150 md:min-w-190 lg:min-w-250 rounded-t-xl">Registration Form</h1>
    <div class="px-4 py-1 bg-green-400 sm:min-w-150 md:min-w-190 lg:min-w-250 rounded-b-xl">
        <form action="../join" method="POST" id="form">
            @csrf
            <fieldset class="border-1 border-white sm:max-w-140 md:max-w-180 lg:max-w-235">
                <legend class="text-center text-lg">Personal Information</legend>
                <table>
                    <tr>
                        <td><label for="fname" class="text-blue-600 min-w-30 text-lg px-1">Full Name: <span class="text-red-700">*</span></label></td>
                        <td class="pb-1">
                            <input type="text" class="text-black bg-white h-7 text-md px-2 mx-1 mt-1 grow min-w-65 @error('fname') border-red-700 border @enderror" name="fname" value="{{ old('fname') }}" placeholder="First Name" id="fname" required>
                            <input type="text" class="text-black bg-white h-7 text-md px-2 mt-1 mx-1 grow min-w-65 @error('mname') border-red-700 border @enderror" name="mname" value="{{ old('mname') }}" placeholder="Middle Name" id="mname">
                            <input type="text" class="text-black bg-white h-7 text-md px-2 ml-1 mt-1 grow min-w-65 @error('lname') border-red-700 border @enderror" name="lname" value="{{ old('lname') }}" placeholder="Last Name" id="lname" required>
                            <span class="text-red-700 text-sm" id="nameErr">
                                @error('fname'){{$message."  " }} @enderror
                                @error('mname') {{ $message."  "}} @enderror
                                @error('lname') {{$message}} @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dob" class="text-blue-600 text-lg px-1">Birth Date: <span class="text-red-700">*</span></label></td>
                        <td class="py-1">
                            <input type="date" name="dob" id="dob" name="dob" value="{{ old('dob') }}" class="bg-white text-black h-7 mx-1" required>
                            <span class="text-red-700 text-sm" id="dobErr">@error('dob') {{ $message }} @enderror</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="gender" class="text-blue-600 text-lg px-1">Gender: <span class="text-red-700">*</span></label></td>
                        <td class="text-black text-md">
                            <input type="radio" name="gender" name="gender" id="male" value="male" @if (old('gender' )=='male') checked @endif> Male
                            <input type="radio" name="gender" name="gender" id="female" value="female" @if (old('gender' )=='female') checked @endif> Female
                            <span class="text-red-700 text-sm" id="genderError">@error('gender') {{ $message }} @enderror</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="uid" class="text-blue-600 min-w-30 text-lg px-1">Mobile No: <span class="text-red-700">*</span></label></td>
                        <td class="p-1">
                            <input type="number" class="grow w-100 h-7 text-black bg-white px-2" name="phone" id="phone" value="{{ old('phone') }}" required>
                            <span id="phoneErr" class="text-red-700 text-sm">@error('phone') {{$message}} @enderror</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="address" class="text-blue-600 text-lg px-1">Address: <span class="text-red-700">*</span></label></td>
                        <td class="p-1">
                            <textarea name="address" id="address" class="bg-white text-md text-black p-1 min-w-100 @error('address') textarea-error @enderror" name="address" rows="2", maxlength="255" required>{{ old('address') }}</textarea>
                            <span class="text-red-700 text-sm" id="addressErr">@error('address') {{$message}} @enderror</span>
                        </td>
                    </tr>
                </table>
            </fieldset><br>
            <fieldset class="border-1 border-white sm:max-w-140 md:max-w-185 lg:max-w-235">
                <legend class="text-center text-lg">Login Information</legend>
                <table class="mt-1 table-fixed">
                    <tr>
                        <td><label for="uid" class="text-blue-600 min-w-30 my-2 text-lg px-5">Email: <span class="text-red-700">*</span></label></td>
                        <td>
                            <input type="email" class="grow min-w-105 h-7 text-black bg-white px-2" value="{{ old('email') }}" name="email" id="email" required>
                            <span id="uidError" class="text-red-700 text-sm">@error('email') {{ $message }} @enderror</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="password" class="text-blue-600 min-w-30 text-lg my-2 px-5">Password:<span class="text-red-700">*</span></label></td>
                        <td class="pt-2">
                            <input type="password" class="grow min-w-105 h-7 text-blue-800 bg-red-100" name="password" value="{{ old('password') }}" id="password" required>
                            <span id="pwErr" class="text-red-700 text-sm">@error('password') {{ $message }} @enderror</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-5"><label for="confirm" class="text-blue-600 min-w-30 text-lg my-2 text-center">Confirm: <span class="text-red-700">*</span></label></td>
                        <td class="py-2">
                            <input type="password" class="grow min-w-105 h-7 text-blue-800 bg-red-100" name="confirm" value="{{ old('confirm') }}" id="confirm" required>
                            <span id="confirmErr" class="text-red-700 text-sm">@error('confirm') {{ $message }} @enderror</span>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <p class="text-lg text-black">
                <input type="checkbox" name="terms" id="terms" class="m-3 p-3" required @if (old('terms')=='on') checked @endif>
                I accept the terms and conditions
            </p>
            <div class="justify-around flex flex-row my-5">
                                <input type="submit" class="p-2 bg-blue-700 border-1 border-green-500 text-xl rounded-xl"  id="submit" value="Register">
                                <input type="reset" class="p-2 bg-orange-700 border-1 border-red-500 text-xl rounded-xl" id="reset" value="Clear">
                            </div>
            <p class="text-sm text-blue-700">Already have an account? <a href="../login" class="text-lg underline text-orange-700 ml-5">Login now</a></p>
        </form>
    </div>
</x-authenticate>