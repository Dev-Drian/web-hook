@props(['users'])

<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Register a New User
    </h1>

    <form method="POST" action="{{ route('token') }}" class="mt-6">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                Register
            </button>
        </div>
    </form>

    <h2 class="mt-8 text-2xl font-medium text-gray-900">
        Registered Users
    </h2>

    <table class="min-w-full mt-6 bg-white border border-gray-200">
        <thead>
            <tr>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Role
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        {{ $user->rol }}
                    </td>
                </tr>
            @empty
                no user
            @endforelse
        </tbody>
    </table>
</div>
