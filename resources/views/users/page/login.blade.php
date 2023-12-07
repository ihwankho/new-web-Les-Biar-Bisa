<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-primary/50 font-poppins grid place-items-center h-screen">
        <form class="bg-white p-8 shadow-md rounded-md" action="/login" method="post">
            @method('POST')
            @csrf

            <h1 class="text-2xl text-center my-2 text-primary font-bold">Login User</h1>
            <p class="mb-5 text-center">Please login with your account</p>

            <label class="block" for="username">
                <span class="block font-semibold text-primary">Username</span>
                <input placeholder="Input your username here" class="p-2 outline-none border rounded-md border-primary"
                    type="text" name="username" id="username">
            </label>
            <label class="block mt-3" for="password">
                <span class="block font-semibold text-primary">Password</span>
                <input placeholder="Input your password here" class="p-2 outline-none border rounded-md border-primary"
                    type="password" name="password" id="password">
            </label>

            <button class="w-full bg-primary p-2 text-center font-semibold text-white mt-3 mb-2 rounded-md"
                type="submit">Login Now</button>
        </form>
    </div>
</body>

</html>
