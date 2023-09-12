<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Javascripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- Project Files -->
    <link rel="stylesheet" href="css/jquery.bootstrap.year.calendar.css">
    <script src="js/jquery.bootstrap.year.calendar.js"></script>
    <!--Title-->
    <title>Jquery Bootstrap Year Calendar - i10n</title>
</head>
<body>
<div class="container">
    <div class="calendar"></div>
</div>
<script>
    $('.calendar').calendar({
        l10n:{
            jan: "Leden",
            feb: "Únor",
            mar: "Březen",
            apr: "Duben",
            may: "Květen",
            jun: "Červen",
            jul: "Červenec",
            aug: "Srpen",
            sep: "Září",
            oct: "Říjen",
            nov: "Listopad",
            dec: "Prosinec",
            mn: "Po",
            tu: "Ut",
            we: 'St',
            th: 'Čt',
            fr: 'Pá',
            sa: 'So',
            su: 'Ne'
        },
        startYear: 2022,
        maxYear: 2023,
        minYear: 2010,
    });
</script>
</body>
</html>