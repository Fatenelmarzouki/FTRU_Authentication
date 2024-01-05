<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Your Password</title>
        <link rel = "icon" href ="{{asset('img/FTRU.svg')}}"  type = "image/svg+xml">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&family=Nunito:wght@300&family=Square+Peg&display=swap" rel="stylesheet">
        <style>
            .bg {
            font-family: "lora";
            }
            .bg .email_container .tlogo {
            width: 150px;
            height: 50px;
            margin: auto;
            margin-top: 20px;
            margin-bottom: 20px;
            }
            .bg .email_container .tlogo .top_logo {
            width: 100%;
            height: 100%;
            }
            .bg .email_container .tlogo .top_logo img {
            width: 100%;
            height: 100%;
            }
            .bg .email_container .hint {
            margin: auto;
            width: 80%;
            }
            .bg .email_container .hint p {
            color: #BBBBBB;
            }
            .bg .email_container .hint p span {
            color: #F0BFA3;
            /* text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.76); */
            }
            .bg .email_container .bottom_logo {
            width: 100px;
            height: 40px;
            margin: auto
            }
            .bg .email_container .bottom_logo img {
            width: 100%;
            height: 100%;
            }
            .bg .email_container .all {
                width: 80%;
                border-radius: 25px;
                box-shadow: 0px 0px 15px 5px rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(7px);
                background-color: rgba(255, 255, 255, 0.3);
                margin: auto;
                padding-bottom: 50px;
            }
            .bg .email_container .all .error_head h1 {
                color:#F0BFA3;
                text-align: center;
                font-size: 30px;
                padding-top: 20px
            }
            .bg .email_container .all .error_head .text_for {
                color: black;
                text-align: center;
                font-size: 15px;
                padding: 0px 10px

            }
            .bg .email_container .all .error_image {
            width: 150px;
            height: 150px;
            margin: auto;
            border-radius: 25px;
            margin-bottom: 30px;
            margin-top: 20px;
            }
            .bg .email_container .all .error_image img {
            width: 100%;
            height: 100%;
            border-radius: 25px;
            }
            .bg .email_container .all .error_head {
            color: #F0BFA3;
            text-align: center;
            }
            .bg .email_container .all .submit {
            padding: 5px 7px;
            border-radius: 8px;
            border-color: #B3ABAB;
            border-style: solid;
            color: #F0BFA3;
            display: block;
            margin: auto;
            width: 130px;
            border-width: 0.1px;
            background-color: transparent;
            text-decoration: none
            }
            .bg .email_container .all .submit:hover {
            color: rgb(255, 255, 255);
            background-color: #F0BFA3;
            border-color: #F0BFA3;
            }
            @media (min-width: 1024px) {
                .bg .email_container .all {
                    width: 60%;
                }
                .bg .email_container .all .error_head h1 {
                    font-size: 35px;
                }
                .bg .email_container .all .error_head .text_for {
                    font-size: 18px;
                }
                .bg .email_container .hint {
                    width: 30%;
                }
                .bg .email_container .all .submit {
                    width: 111px;
                }
            }
        </style>
    </head>
    <body style="font-family: 'lora'; background-color: #f1eee9; border-radius: 50px; padding: 30px 0px">
        <section class="bg">
            <section class="email_container">
                <section class="tlogo" >
                    <div class="top_logo">
                        <img src="{{ $message->embed(public_path("img/logo_email.png")) }}" alt="no">
                    </div>
                </section>

            <div class="all" >
                    <div class="error_head">
                        <h1>Welcome to our website</h1>

            <p class="text_for">Hello my Friend, to reset your password just use this link</p>
                    </div>
                    <div class="error_image">
                        <img src="{{ $message->embed(public_path("img/jo.jpeg")) }}" alt="no" >
                    </div>
                    <a href="{{ route('reset_pass', $token) }}" class="submit" >Reset Your Password</a>
                </div>
                <div class="hint">
                    <p>For your notes this masterpiece made by the most perfect web developers
                        <span>” Faten Elmarzouki ” & “ Rizk Ussef ”</span></p>
                </div>
                <div class="bottom_logo">
                    <img src="{{ $message->embed(public_path("img/ψυχή_email.png")) }}" alt="no">
                </div>
            </section>
        </section>

    </body>
</html>
