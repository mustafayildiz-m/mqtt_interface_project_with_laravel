<!-- resources/views/mail/template.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alarm Durumu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border: 1px solid #e2e2e2;
        }


        .logo img {
            max-width: 200px;
            height: auto;
        }

        .content {
            margin-top: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .content ul {
            list-style-type: none;
            padding: 0;
        }

        .content ul li {
            margin-bottom: 5px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }


        .logo img {
            max-width: 50% !important;

        }

        .message {
            text-align: center;
            background-color: #d9fc03;
            padding: 15px;
            border-radius: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #fd0000;
            margin-bottom: 20px;
        }

        .details {
            font-size: 12px;
            color: #333333;
        }

        .details strong {
            color: black;
        }


        .custom-list li {
            margin-bottom: 10px;
        }

        li {
            margin-left: 0 !important;
        }

    </style>
</head>

<body>
<div class="container">
    <div class="content">
        <p>Merhaba,</p>
        <p><strong>{{\App\Models\Device::where('serial_no',$obj['serial_no'])->first()->device_name}} </strong> isimli
            cihazınızın alarm durumu!</p>

        <div class="details" style="margin-left: 15px;">
            <p><strong>Cihaz Seri No :</strong> {{$obj['serial_no']}}</p>
            <p><strong>Durum :</strong> @if($obj['parsedObj']['state']==='alarm')
                    <span style="color: red">Alarm </span>
                @else
                    <span style="color: red">Kritik Alarm </span>
                @endif </p>
            <p @if(
    $obj['parsedObj']['temp'] <= $obj['deviceLimits']['crit_temp_min'] ||
    $obj['parsedObj']['temp'] <= $obj['deviceLimits']['temp_min'] ||
    $obj['parsedObj']['temp'] >= $obj['deviceLimits']['temp_max'] ||
    $obj['parsedObj']['temp'] >= $obj['deviceLimits']['crit_temp_max']
    ) style="color: red" @endif><strong>Isı Değeri :</strong>
                {{$obj['parsedObj']['temp']}} &deg;C</p>
            <p @if(
    $obj['parsedObj']['humd'] <= $obj['deviceLimits']['crit_moisture_min'] ||
    $obj['parsedObj']['humd'] <= $obj['deviceLimits']['moisture_min'] ||
    $obj['parsedObj']['humd'] >= $obj['deviceLimits']['moisture_max'] ||
    $obj['parsedObj']['humd'] >= $obj['deviceLimits']['crit_moisture_max']
    ) style="color: red" @endif><strong>Nem Değeri :</strong> % {{$obj['parsedObj']['humd']}}</p>
            <p><strong>Alarm Zamanı : </strong> <?php
                                                //$obj['parsedObj']['timestamp']
                                                date_default_timezone_set('Europe/Istanbul');
                                                $dateTime = \Carbon\Carbon::createFromTimestamp($obj['parsedObj']['timestamp']);
                                                $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

                                                print turkishDate('j F Y , l', explode(' ', $formattedDateTime)[0]) . PHP_EOL . explode(' ', $formattedDateTime)[1] . '<br>';

                                                ?></p>
            <p style="margin-top: -5px;"><strong>Bulunduğu
                    Bölge: </strong> {{printUpperSubtree4Mail(\App\Models\Zone::where(['work_space_id' => $obj['allowed_workspace_id']])->get()->toArray(), $obj['zone'])}}
            </p>

            <hr>
            <ul class="details">
                <p>Cihazınıza tanımlı limitler!</p>
                <li><strong>Isı :</strong> {{$obj['deviceLimits']['temp_min']}}°C - {{$obj['deviceLimits']['temp_max']}}
                    °C
                </li>
                <li><strong>Nem :</strong> %{{$obj['deviceLimits']['moisture_min']}} -
                    %{{$obj['deviceLimits']['moisture_max']}}
                </li>
                <li><strong>Kritik Isı :</strong> {{$obj['deviceLimits']['crit_temp_min']}}°C
                    - {{$obj['deviceLimits']['crit_temp_max']}}
                    °C
                </li>
                <li><strong>Kritik Nem :</strong> %{{$obj['deviceLimits']['crit_moisture_min']}} -
                    %{{$obj['deviceLimits']['crit_moisture_max']}}
                </li>
            </ul>
        </div>
    </div>

    {{--    {{route('report',['workspace'=>$obj['allowed_workspace_id'],'serial'=>$obj['serial_no']])}}--}}
    <div style="text-align: center; margin: auto;">
        <a href="{{\Illuminate\Support\Facades\URL::to(route('report',['workspace'=>$obj['allowed_workspace_id'],'serial'=>$obj['serial_no']]))}}"
           style="display: inline-block; background-color: #2E3093; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 20px;">Cihaz Raporuna Git</a>
    </div>


    <div class="footer">
        <img src="https://drive.google.com/uc?export=view&id=1tLpKpz0Z7VHuNFC-Vnv9P4518Mx_Mfll" alt="superLOG"
             width="150">
        <br>
        superLOG &copy; {{ date('Y') }}
    </div>
</div>
</body>

</html>
