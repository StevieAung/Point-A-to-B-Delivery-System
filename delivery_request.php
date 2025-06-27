<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="bg-light min-vh-100">
    <div class="banner d-flex justify-content-between align-items-center px-4 py-2 bg-dark text-white">
        <div class="logo">
            <h3 class="mb-0">A TO B DELIVERY</h3>
        </div>
        <div>
            <a href="#" class="text-white mx-2 text-decoration-none">HOME</a>
            <a href="delivery_request.php" class="text-white mx-2 text-decoration-none fw-bold">DELIVERY</a>
            <a href="#" class="text-white mx-2 text-decoration-none">CAREER</a>
            <a href="#" class="text-white mx-2 text-decoration-none">CONTACT US</a>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-center mb-4">Request a Delivery</h2>
                    <form>
                        <div class="mb-3">
                            <label for="senderName" class="form-label">Sender Name</label>
                            <input type="text" class="form-control" id="senderName" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="pickupAddress" class="form-label">Pickup Address</label>
                            <input type="text" class="form-control" id="pickupAddress" placeholder="Enter pickup address" required>
                        </div>
                        <div class="mb-3">
                            <label for="deliveryAddress" class="form-label">Delivery Address</label>
                            <input type="text" class="form-control" id="deliveryAddress" placeholder="Enter delivery address" required>
                        </div>
                        <div class="mb-3">
                            <label for="packageDetails" class="form-label">Package Details</label>
                            <textarea class="form-control" id="packageDetails" rows="3" placeholder="Describe your package" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contactNumber" placeholder="Enter your phone number" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit Delivery Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>