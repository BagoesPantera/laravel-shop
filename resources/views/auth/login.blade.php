<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/lux/bootstrap.min.css" integrity="sha512-RI2S7J+KOTIVVh6JxrBRNIxJjIioHORVNow+SSz2OMKsDLG5y/YT6iXEK+R0LlKBo/Uwr1O063yT198V6AZh4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/lux/bootstrap.rtl.min.css" integrity="sha512-HTAZCwhj2s2OzMZrBJX5D8qBhYXA2KAG5G983UY1D+zsWTwj/FBpiAijY8gG1XqSF8EyJlkue9BcjG2jlhxj9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <title>AYOTI</title>
</head>
<body>
<section id="home-content" class="container">
    <div
        class="row justify-content-center align-items-center"
        style="height: 100vh"
    >
        <form class="col-4" action="{{ route('login.post') }}" method="post">
            @csrf
            <p class="h4 mb-5">Login to Ayoti Admin</p>

            @error('msg')
            <div class="container">
                <div
                    class="alert alert-danger alert-dismissible fade show mt-4"
                    role="alert"
                >
                    {{ $message }}
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                </div>
            </div>
            @enderror

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                />
            </div>
            <button type="submit" class="btn btn-dark mt-4 px-4">Login</button>

        </form>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
