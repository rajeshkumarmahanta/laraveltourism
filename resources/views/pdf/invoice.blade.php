<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Travel Booking Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 25px;
            color: #000;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .section {
            margin-bottom: 25px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
        }

        .section-header {
            background: #f5f5f5;
            padding: 12px 16px;
            border-bottom: 1px solid #dcdcdc;
            font-weight: bold;
        }

        .section-body {
            padding: 18px 16px 20px 16px;
        }

        .row {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .col-half {
            width: 48%;
            margin-right: 4%;
            margin-bottom: 15px;
        }

        .col-half:nth-child(2n) {
            margin-right: 0;
        }

        label {
            font-weight: bold;
            color: #666;
            display: block;
            margin-bottom: 2px;
        }

        p {
            margin: 0 0 6px 0;
        }

        .id-image-box {
            margin-top: 10px;
            padding: 8px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            display: inline-block;
        }

        img {
            width: 120px;
            height: auto;
            border-radius: 4px;
        }

        hr {
            border: none;
            border-top: 1px solid #cecece;
            margin: 20px 0;
        }

        .footer-text {
            text-align: center;
            margin-top: 40px;
            color: #555;
        }

        @page {
            margin: 20px 30px;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- Header -->
    <div class="section">
        <div class="section-header">Travel Booking Details</div>
    </div>

    <!-- Personal Information -->
    <div class="section">
        <div class="section-header">Personal Information</div>

        <div class="section-body">
            <div class="row">

                <div class="col-half">
                    <label>Name</label>
                    <p>{{ $booking->name }}</p>
                </div>

                <div class="col-half">
                    <label>Email</label>
                    <p>{{ $booking->email }}</p>
                </div>

                <div class="col-half">
                    <label>Phone</label>
                    <p>{{ $booking->phone }}</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Travel Information -->
    <div class="section">
        <div class="section-header">Travel Information</div>

        <div class="section-body">
            <div class="row">

                <div class="col-half">
                    <label>Travel Date</label>
                    <p>{{ $booking->travel_date }}</p>
                </div>

                <div class="col-half">
                    <label>Number of Travelers</label>
                    <p>{{ $booking->travenlers_no }} Travelers</p>
                </div>

                <div class="col-half">
                    <label>Pickup Address</label>
                    <p>{{ $booking->pickup_address }}</p>
                </div>

                <div class="col-half">
                    <label>Tour</label>
                    <p>{{ $tour->title }}</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Identification -->
    <div class="section">
        <div class="section-header">Identification</div>

        <div class="section-body">

            <label>ID Type</label>
            <p>{{ $booking->id_type }}</p>

            <label>ID Document</label>

            <div class="id-image-box">
                <img src="{{ public_path($booking->id_image) }}" alt="ID Document">
            </div>

        </div>
    </div>

    <!-- Additional Message -->
    <div class="section">
        <div class="section-header">Additional Message</div>

        <div class="section-body">
            <p>{{ $booking->additional_message }}</p>
        </div>
    </div>

    <!-- Footer -->
    <p class="footer-text">
        This is a system-generated document. No signature required.
    </p>

</div>
</body>
</html>
