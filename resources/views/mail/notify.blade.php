<!DOCTYPE html>
<html>

<head>
    <title>Booking Details</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");

        body,
        p,
        h1,
        h2,
        h3 {
            margin: 0;
            padding: 0;
            font-family: "Roboto";
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px dotted #005294;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .booking-details {
            background-color: #f4f4f4;
            padding: 20px 25px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            gap: 15px;
        }

        .booking-title {
            font-size: 20px;
            color: #fff;
            text-align: center;
            font-weight: 400;
            background: #005294;
            padding: 10px 0 10px 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            margin-top: 15px;
        }

        .detail {
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: bold;
            color: #333;
        }

        .detail-value {
            float: right;
        }

        .company-logo {
            display: block;
            margin: 0 auto;
            max-width: 150px;
        }

        .services ul {
            margin: 5px;
        }

        .services ul li {
            font-size: 16px;
            color: #343a40;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <img class="company-logo" src="https://flightsgyani.com/frontend/images/logo.png" alt="Company Logo" width="150px"
            height="70px" />
        <h2 class="booking-title">Booking Details</h2>
        <div class="booking-details">
            <div class="detail">
                <span class="detail-label">Full Name:</span>
                <span class="detail-value">{{ $data->full_name ?? '' }}</span>
            </div>
            <div class="detail">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $data->email ?? '' }}</span>
            </div>
            <div class="detail">
                <span class="detail-label">Phone:</span>
                <span class="detail-value">{{ $data->phone ?? '' }}</span>
            </div>
            <div class="detail">
                <span class="detail-label">Package:</span>
                <span class="detail-value">{{ $data->package ?? '' }}</span>
            </div>

            <div class="detail">
                <span class="detail-label">Comment:</span>
                <span class="detail-value">{{ $data->comments ?? '' }}</span>
            </div>
        </div>
    </div>
</body>

</html>
