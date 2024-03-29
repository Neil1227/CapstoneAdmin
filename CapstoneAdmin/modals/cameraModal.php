         <div class="modal fade" id="discount" tabindex="-1" aria-labelledby="discountLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="discountLabel">PWD/Senior Discount</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                   <button id="openCameraBtn" class="btn btn-primary">Open Camera</button>

                  <!-- Camera container with a frame -->
                  <div class="camera-container">
                     <div class="camera-frame">
                        <!-- Video element to display the camera stream -->
                        <video id="cameraStream" autoplay style="width: 100%; max-width: 500px; border-radius: 8px;"></video>
                     </div>
                  </div>

                  <!-- Buttons for capturing, retaking, and proceeding with the photo -->
                  <div>
                     <button id="capturePhotoBtn" class="btn btn-success" style="display: none;">Capture Photo</button>
                     <button id="retakePhotoBtn" class="btn btn-danger" style="display: none;">Retake Photo</button>
                  </div>

                  <!-- Image element to display the captured photo -->
                     <form action="" method="post" enctype="multipart/form-data">
                     <img id="capturedPhoto" name= "captured_image" style="display: none; width:100%; max-width: 500px; margin-top: 10px; border-radius: 8px;">

                     <button type="submit" id="proceedBtn"  class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="checkout" style="display: none;">Proceed</button>
                  </form>   

                  <script>
                        let videoStream;
                        let photoCanvas;
                        let photoContext;

                        // Function to open the camera when the button is clicked
                        // Function to open the camera when the button is clicked
                        async function openCamera() {
                        try {
                           // Access the user's camera
                           videoStream = await navigator.mediaDevices.getUserMedia({ video: true });

                           // Display the camera stream in a video element
                           const videoElement = document.getElementById('cameraStream');
                           videoElement.srcObject = videoStream;

                           // Show the video element and the photo capture button
                           videoElement.style.display = 'block';
                           document.getElementById('capturePhotoBtn').style.display = 'block';

                           // Hide the retake and proceed buttons initially
                           document.getElementById('retakePhotoBtn').style.display = 'none';
                           document.getElementById('proceedBtn').style.display = 'none';

                           // Hide the "Open Camera" button
                           document.getElementById('openCameraBtn').style.display = 'none';

                           // Initialize canvas for capturing photos
                           photoCanvas = document.createElement('canvas');
                           photoContext = photoCanvas.getContext('2d');
                        } catch (error) {
                           console.error('Error accessing the camera:', error);
                        }
                        }

                        // Function to capture a photo
                        function capturePhoto() {
                           // Set the canvas size to match the video stream
                           photoCanvas.width = videoStream.getVideoTracks()[0].getSettings().width;
                           photoCanvas.height = videoStream.getVideoTracks()[0].getSettings().height;

                           // Draw the current frame from the video stream onto the canvas
                           photoContext.drawImage(document.getElementById('cameraStream'), 0, 0, photoCanvas.width, photoCanvas.height);

                           // Display the captured photo in an image element
                           const capturedPhotoElement = document.getElementById('capturedPhoto');
                           capturedPhotoElement.src = photoCanvas.toDataURL('image/png');
                           capturedPhotoElement.style.display = 'block';

                           // Show the retake and proceed buttons
                           document.getElementById('retakePhotoBtn').style.display = 'block';
                           document.getElementById('proceedBtn').style.display = 'block';

                           // Hide the capture button and the video stream
                           document.getElementById('capturePhotoBtn').style.display = 'none';
                           document.getElementById('cameraStream').style.display = 'none';
                        
                           // Stop the video stream (optional, depending on your use case)
                    <div class="modal-body text-center">
                    
                     <!-- Add a button to trigger camera capture -->
                           videoStream.getTracks().forEach(track => track.stop());

                           // Automatically download the captured photo
                           downloadCapturedPhoto();
                        }

                        // Function to download the captured photo
                        function downloadCapturedPhoto() {
                           // Retrieve the captured image as a Base64 string
                           const capturedImageBase64 = photoCanvas.toDataURL('image/png');

                           // Create a link element
                           const downloadLink = document.createElement('a');
                           downloadLink.href = capturedImageBase64;
                           downloadLink.download = 'captured_photo.png';

                           // Append the link to the document and trigger a click event to download the image
                           document.body.appendChild(downloadLink);
                           downloadLink.click();

                           // Remove the link from the document
                           document.body.removeChild(downloadLink);
                        }

                       

                        // Add event listeners to the buttons
                        document.getElementById('openCameraBtn').addEventListener('click', openCamera);
                        document.getElementById('capturePhotoBtn').addEventListener('click', capturePhoto);
                        document.getElementById('retakePhotoBtn').addEventListener('click', retakePhoto);
                        document.getElementById('proceedBtn').addEventListener('click', proceedWithPhoto);
                    
                  </script>
               </div>
            </div>
         </div>