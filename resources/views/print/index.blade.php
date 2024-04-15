<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $package->name ?? 'flightsgyani' }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 3.1cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3.1cm;
        }

        p {
            text-align: justify !important;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

        body {
            font-family: 'Roboto';
        }
    </style>
</head>

<body>
    <header>
        <!-- <img src="https://admin.pdes.com.np/admin/images/letter_header.png" width="100%"/> -->
        <img src="{{ asset('admin/images/letter_header.png') }}" width="100%" />

    </header>

    <footer>
        <!--<img src="https://admin.pdes.com.np/admin/images/letter_footer.png" width="100%"/> -->
        <img src="{{ asset('admin/images/letter_footer.png') }}" width="100%" />
    </footer>

    <main>
        <h2 style="margin-top: 5px; color:#269215">{{ $package->name ?? '' }} Itinerary</h2>

        @if ($itineraries->isNotEmpty())
            @foreach ($itineraries as $key => $item)
                <h3 style="color:#c1272f">Day {{ $key + 1 }}: {{ $item->title ?? '' }}</h3>
                <span style="margin-top: 4px"> {!! $item->description ?? '' !!}</span>
            @endforeach
        @else
            <p>Itinerary Not Available Yet</p>
        @endif

    </main>
</body>

</html>
