<x-authenticate>
    <h1 class="text-3xl">Hello {{ Auth::user()["Full Name"] }}. You have logged in</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-orange-500 p-2 m-10 text-lg rounded-xl">Log out</button>
    </form>
</x-authenticate>