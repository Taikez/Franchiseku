<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <h1>Hi, {{ $data['fromName'] }}!</h1>
    <br>
    <p>You have a new proposal request from {{ $data['userEmail'] }}. Please check your <a
            href="{{ $data['link'] }}">request</a> in the proposal requests page! Thank you for your attention.</p>
    <br>
    <p><b>Lots of Love,</b></p>
    <p><b>FranchiseKu Team</b></p>
</body>

</html>
