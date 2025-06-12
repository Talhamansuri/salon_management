<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Services Catalog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
        }

        .sidebar {
            background-color: #fff;
            width: 200px;
            padding: 20px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .sidebar ul {
            padding: 0;
        }

        .sidebar li {
            list-style: none;
            margin-bottom: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            display: block;
            padding-top: 8px;
            padding-bottom: 8px;
            transition: all 0.3s ease;
            height: 50px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        .sidebar a:hover {
            background-color: #f2f2f2;
            color: #000;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        .service {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .service img {
            margin-right: 20px;
            max-width: 100px;
        }

        .service h3 {
            margin-top: 0;
        }

        .service p {
            margin-bottom: 5px;
        }

        .service .price {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Service Categories</h2>
            <ul>
                <li><a href="#hair">Hair</a></li>
                <li><a href="#nails">Nails</a></li>
                <li><a href="#skincare">Skincare</a></li>
                <li><a href="#massage">Massage</a></li>
            </ul>
        </div>
        <div class="content">
            <h2 id="hair">Hair Services</h2>
            <div class="service">
                <img src="haircut.jpg" alt="Haircut">
                <div>
                    <h3>Haircut</h3>
                    <p>Description of haircut service...</p>
                    <p class="price">$50</p>
                </div>
            </div>
            <div class="service">
                <img src="haircoloring.jpg" alt="Hair Coloring">
                <div>
                    <h3>Hair Coloring</h3>
                    <p>Description of hair coloring service...</p>
                    <p class="price">$80</p>
                </div>
            </div>
            <div class="service">
                <img src="hairstyling.jpg" alt="Hair Styling">
                <div>
                    <h3>Hair Styling</h3>
                    <p>Description of hair styling service...</p>
                    <p class="price">$60</p>
                </div>
            </div>
            
            <h2 id="nails">Nail Services</h2>
            <div class="service">
                <img src="manicure.jpg" alt="Manicure">
                <div>
                    <h3>Manicure</h3>
                    <p>Description of manicure service...</p>
                    <p class="price">$25</p>
                </div>
            </div>
            <div class="service">
                <img src="pedicure.jpg" alt="Pedicure">
                <div>
                    <h3>Pedicure</h3>
                    <p>Description of pedicure service...</p>
                    <p class="price">$35</p>
                </div>
            </div>
            
            <h2 id="skincare">Skincare Services</h2>
            <div class="service">
                <img src="facial.jpg" alt="Facial">
                <div>
                    <h3>Facial</h3>
                    <p>Description of facial service...</p>
                    <p class="price">$70</p>
                </div>
            </div>
            <div class="service">
                <img src="exfoliation.jpg" alt="Exfoliation">
                <div>
                    <h3>Exfoliation</h3>
                    <p>Description of exfoliation service...</p>
                    <p class="price">$50</p>
                </div>
            </div>
            
            <h2 id="massage">Massage Services</h2>
            <div class="service">
                <img src="swedishmassage.jpg" alt="Swedish Massage">
                <div>
                    <h3>Swedish Massage</h3>
                    <p>Description of Swedish massage service...</p>
                    <p class="price">$90</p>
                </div>
            </div>
            <div class="service">
                <img src="deeptissuemassage.jpg" alt="Deep Tissue Massage">
                <div>
                    <h3>Deep Tissue Massage</h3>
                    <p>Description of deep tissue massage service...</p>
                    <p class="price">$100</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
