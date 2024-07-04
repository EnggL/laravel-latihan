<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php
        if(isset($css) && is_array($css))
        {
            foreach($css as $key)
            {
                echo '<link rel="stylesheet" href="'.URL::asset('css/'.$key).'">';
            }
        }
        else
        {

        }
    ?>
</head>

<script>
    const base_url = "{{url('/')}}";
    const csrf = "{{csrf_token()}}";
</script>

<body>
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <a class="navbar-brand" href="/">
            <img src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" width="30" height="30"
                class="d-inline-block align-top" alt="">
            Latihan
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                    isset($active) ? "": $active = false;
                ?>
                <li class="nav-item {{$active == 'home' ? 'active':''}}">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{$active == 'students' ? 'active':''}}">
                    <a class="nav-link" href="/students">Students</a>
                </li>
                <li class="nav-item {{$active == 'class' ? 'active':''}}">
                    <a class="nav-link" href="/class">Kelas</a>
                </li>
                <li class="nav-item {{$active == 'ekskul' ? 'active':''}}">
                    <a class="nav-link" href="/ekskul">Ekskul</a>
                </li>
                <li class="nav-item {{$active == 'teachers' ? 'active':''}}">
                    <a class="nav-link" href="/teachers">Teachers</a>
                </li>
            </ul>
        </div>
    </nav>