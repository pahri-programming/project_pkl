<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .profile-card {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .profile-icon {
            font-size: 80px;
            color: #0d6efd;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="profile-card">
    
        <i class="bi bi-person-circle profile-icon"></i>
        <h3>Profile</h3>
        <h5 class="mb-1 fs-3"> {{  Auth::user()->name }} </h5>

        <hr>
        <div class="text-start">
            <span class="mb-1 d-block">{{ Auth::user()->isAdmin == 1 ? 'admin' : '' }}</span>
            <p class="mb-0 d-flex align-items-center gap-2">
                <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
            </p>
        </div>

        <a href="/admin" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

</body>

</html>