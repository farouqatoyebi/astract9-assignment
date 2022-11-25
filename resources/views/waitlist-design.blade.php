<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        .object-fit-cover{
            object-fit: cover;
            object-position: center;
            height: inherit;
        }

        .object-fit-contain{
            object-fit: contain;
            object-position: center;
            height: inherit;
        }
        .btn-primary {
            background-color: rgb(51, 102, 153)
        }
    </style>
</head>
<body>
    <div class="container-fluid px-4">
        <div class="row align-items-center vh-100">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="text-center">
                            <h1 class="h1" style="font-size: 40px">Join our waitlist and get NGN 500 instantly</h1>
                            <h4 class="h4"><img src="{{ asset('images/paybot_logo.jpg') }}" alt="" width="200px" class="img-fluid mt-2 mb-4"></h4>
                            <p>Paybot by Finnova is an AI-Powered WhatsApp Banking and Service rendering personalized solutions to collect digital payments.</p>
                        </div>

                        <div class="form">
                            <form action="" class="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" name="" id="" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label for="">WhatsApp Phone Number</label>
                                    <input type="tel" name="" id="" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-8 mx-auto">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                                Join
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="vh-75">
                    {{-- <img src="{{ asset('images/girl.png') }}" alt="" class="img-fluid object-fit-contain"> --}}
                    <img src="{{ asset('images/side-image.jpg') }}" alt="" class="img-fluid object-fit-contain"><br/>
                </div>
                {{-- <img src="{{ asset('images/side-image.jpg') }}" alt="" class="img-fluid"><br/> --}}
                <div class="text-right">
                    <img src="{{ asset('images/web_logo.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>