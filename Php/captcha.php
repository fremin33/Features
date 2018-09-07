<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Captcha Google</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <form action="captcha.php" method="post"></form>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <span class="msg-error error"></span>
    <div class="g-recaptcha" id="recaptcha" data-sitekey="PUBLIC_KEY"></div>
</body>

</html>


<script>
    $(document).ready(function () {
        $('#send').click(function () {
            var $captcha = $('#recaptcha'),
                response = grecaptcha.getResponse();
            if (response.length === 0) {
                $('.msg-error').text("Veuillez valider le champ captcha");
                return false;
            }
        })
    });
</script>

<?php
function send_mail()
{
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6Ld7O1sUAAAAAOfHZs4q0FayVpQoHjamgMDKMzNR";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha);
    $responseKeys = json_decode($response, true);
    if ($responseKeys['success']) {
    } else {
        echo 'You are a spammer';
    }
};
?>