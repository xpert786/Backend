<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Image Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <!-- Description Input and Button Section -->
            <div class="col-12 d-flex align-items-center">
                <input type="text" id="description" class="form-control me-2" placeholder="Enter a description" aria-label="Description">
                <button id="generate-btn" class="btn generate-btn">Generate</button>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Image Preview Section -->
            <div id="main-container" class="row">
                <!-- Images will be appended here -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('generate-btn').addEventListener('click', function() {
            const description = document.getElementById('description').value;
            if (!description) {
                alert('Please enter a description.');
                return;
            }

            // Replace 'YOUR_ACCESS_TOKEN' with your actual Shutterstock API access token
            const apiKey = 'your_token_here';
            const url = `https://api.shutterstock.com/v2/images/search?query=${encodeURIComponent(description)}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${apiKey}`
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Check the data format in the console

                // Clear previous results
                const mainContainer = document.getElementById('main-container');
                mainContainer.innerHTML = '';

                // Assuming the data contains an array of images
                const imageUrls = data.data.map(image => image.assets.preview.url); // Adjust based on actual response format

                // Add images to the main container
                imageUrls.forEach(url => {
                    const colElement = document.createElement('div');
                    colElement.classList.add('col-md-3'); // 4 images per row in medium and larger screens

                    const placeholder = document.createElement('div');
                    placeholder.classList.add('image-placeholder');

                    const imgElement = document.createElement('img');
                    imgElement.src = url;
                    imgElement.alt = 'Image';
                    imgElement.classList.add('img-fluid');

                    placeholder.appendChild(imgElement);
                    colElement.appendChild(placeholder);

                    mainContainer.appendChild(colElement);
                });

                // Handle case where no images are returned
                if (imageUrls.length === 0) {
                    const colElement = document.createElement('div');
                    colElement.classList.add('col-12'); // Full width if no images

                    const placeholder = document.createElement('div');
                    placeholder.classList.add('image-placeholder');
                    placeholder.innerHTML = '<p>No images found</p>';

                    colElement.appendChild(placeholder);
                    mainContainer.appendChild(colElement);
                }
            })
            .catch(error => {
                console.error('Error fetching images:', error);
                alert('An error occurred while fetching images.');
            });
        });
    </script>

</body>
</html>