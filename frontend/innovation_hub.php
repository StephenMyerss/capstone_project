<?php
include("../database/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovation Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container header">
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
        <a href="../index.php"
           class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png"
                 alt="">
        </a>
        <ul class="nav align-items-center">
            <li class="nav-item fs-5"><a href="../index.php" class="color nav-link" draggable="true">Back to home</a>
            </li>
        </ul>
    </header>
</div>

<div class="container">
    <div class="px-4 my-5 text-center">
        <img class="custom-rounded img-fluid d-block mx-auto mb-4" src="../innovationImages/smrt_logo_dark.png"
             alt="" width="250" height="250">
        <h1 class="display-4 fw-bold text-body-emphasis">Innovation Hub</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Innovation begins with you. The smrt innovation hub is a user-friendly innovation
                engine software that fosters
                a culture of creativity, collaboration, and continous improvement within organizations.</p>
        </div>
    </div>
</div>

<div class="container">
    <form method="post">

        <div class="container ">
            <div class="mx-auto col-md-6 fs-5 form-check py-3 justify-content-center">
                <input class="form-check-input border-4" type="checkbox" value="" id="defaultCheck1" name="anonymous">
                <label class="fw-bold form-check-label" for="defaultCheck1">Anonymous Post</label>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 fs-5">
                <label class="fw-bold" for="firstname">First name</label>
                <input name="first_name" type="text" class="form-control border-3">
            </div>
            <div class="col-md-3 fs-5">
                <label class="fw-bold" for="lastname">Last name</label>
                <input name="last_name" type="text" class="form-control border-3">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="mx-auto col-md-6 fs-5 form-group py-3">
                <label class="fw-bold" for="exampleFormControlInput1">Job title</label>
                <input name="job_title" type="text" class="form-control border-3" id="exampleFormControlInput1">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="mx-auto col-md-6 fs-5 form-group mb-3">
                <label class="fw-bold" for="exampleFormControlInput1">Email</label>
                <input name="email" type="text" class="form-control border-3" id="exampleFormControlInput1">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="mx-auto col-md-6 fs-5 form-group">
                <label class="fw-bold" for="exampleFormControlSelect1">Company</label>
                <select class="form-control border-3" id="exampleFormControlSelect1" name="company">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="mx-auto col-md-6 fs-5 form-group py-3">
                <label class="fw-bold" for="exampleFormControlTextarea1">Innovation idea</label>
                <textarea name="idea_text" class="form-control border-3" id="exampleFormControlTextarea1"
                          rows="3"></textarea>
            </div>
        </div>

        <div class="text-center py-3">
            <button name="submit" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">Submit
            </button>
        </div>
    </form>

</div>

<div class="container mt-auto">
    <footer class="py-3 my-4 border-top border-dark">
        <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
    </footer>
</div>
</body>
</html>

<?php
include("../php_scripts/idea_submission.php");
?>