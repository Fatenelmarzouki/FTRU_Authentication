<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass not Confrmed</title>
    <link rel = "icon" href ="{{asset('img/FTRU.svg')}}"  type = "image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&family=Nunito:wght@300&family=Square+Peg&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('sass/main.css')}}">
</head>
<body>
    <section class="bg">
        <section class="error_container">
            <div class="all">
                <div class="error_image">
                    <img src="{{asset("img/error.gif")}}">
                </div>
                <div class="error_head">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <h1>{{$error}}</h1>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <section class="back_btn">
            <div class="link_cont">
                <a href="{{url()->previous()}}">Back</a>
            </div>
        </section>
    </section>
        <script>
            var section = document.getElementById("section");
            function removeSection() {
                section.parentNode.removeChild(section);
            }
            setTimeout(removeSection, 5000);
        </script>
</body>
</html>
