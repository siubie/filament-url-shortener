<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel 11 QR Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <form class="text-center" action="{{ route('qr.generate') }}" method="get" accept-charset="utf-8">
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Laravel 11 QR Code</h2>
                <button class="btn btn-success" type="submit">Generate</button>
                <a href="{{ asset('qr.png') }}" class="btn btn-primary" download>Download</a><br>
                <img class="img-thumbnail" src="{{ asset('qr.png') }}" width="150" height="150"
                    style="margin-top: 20px">
            </div>
        </div>
    </form>
</body>

</html>
