<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodic Table</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

    @for ($i = 1; $i < count($data); $i++) 
        <?php $status = ''?>
        <?php $netWorth = (float) str_replace(['$',','],'',$data[$i][5])?>
        @if($netWorth < 100000)
            <?php $status = 'low'?>
        @endif
        @if($netWorth >= 100000 && $netWorth < 200000)
            <?php $status = 'middle'?>
        @endif
        <div class="card <?= $status?>">
            <div class="header">
                <span>{{$data[$i][3]}}</span>
                <span>{{$data[$i][2]}}</span>
            </div>
            <img src="{{$data[$i][1]}}" alt="">
            <span class="name">{{$data[$i][0]}}</span>
            <span class="interest">{{$data[$i][4]}}</span>
        </div>
    @endfor

</body>

</html>