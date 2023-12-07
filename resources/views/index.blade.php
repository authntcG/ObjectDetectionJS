@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Live Camera</h5>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3 d-flex align-items-center" style="position: relative; height: 100%;">
                            <video id="webcam" width="640" height="480" class="mb-3 img-fluid mx-auto" autoplay style="max-width: 100%; height: auto;"></video>
                            <canvas id="canvas" class="position-absolute top-0 start-0 end-0 bottom-0 mx-auto" style="max-width: 100%; height: auto;"></canvas>
                        </div>
                        <div class="col-12 mb-3">
                            <h6>Select Camera</h6>
                            <select class="form-select" id="cameraDropdown"></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6>Detected Objects Log</h6>
                            <textarea id="predictionLog" class="form-control" rows="4" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const cameraDropdown = document.getElementById('cameraDropdown');
        const predictionLog = document.getElementById('predictionLog');

        // Get the list of available cameras
        const cameras = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = cameras.filter(device => device.kind === 'videoinput');

        // Populate the camera dropdown with available cameras
        videoDevices.forEach((device, index) => {
            const option = document.createElement('option');
            option.value = device.deviceId;
            option.text = device.label || `Camera ${index + 1}`;
            cameraDropdown.add(option);
        });

        // Initialize the default camera
        const defaultCameraId = videoDevices.length > 0 ? videoDevices[0].deviceId : null;
        await initCamera(defaultCameraId);

        // Event listener for camera dropdown change
        cameraDropdown.addEventListener('change', async function () {
            const selectedCameraId = cameraDropdown.value;
            await initCamera(selectedCameraId);
        });

        async function initCamera(cameraId) {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    deviceId: cameraId ? {
                        exact: cameraId
                    } : undefined
                }
            });
            video.srcObject = stream;

            // Load COCO-SSD model
            const model = await cocoSsd.load();
            detectObjects(model);
        }

        function detectObjects(model) {
            const context = canvas.getContext('2d');
            canvas.width = video.width;
            canvas.height = video.height;

            async function detect() {
                const predictions = await model.detect(video);

                context.clearRect(0, 0, canvas.width, canvas.height);
                predictionLog.value = ''; // Clear previous predictions

                // Draw bounding boxes and labels
                predictions.forEach(prediction => {
                    context.beginPath();
                    context.rect(
                        prediction.bbox[0],
                        prediction.bbox[1],
                        prediction.bbox[2],
                        prediction.bbox[3]
                    );
                    context.lineWidth = 2;
                    context.strokeStyle = 'red';
                    context.fillStyle = 'red';
                    context.stroke();
                    context.fillText(
                        `${prediction.class} (${Math.round(prediction.score * 100)}%)`,
                        prediction.bbox[0],
                        prediction.bbox[1] > 10 ? prediction.bbox[1] - 5 : 10
                    );

                    // Display prediction in textarea
                    predictionLog.value += `${prediction.class}: ${Math.round(prediction.score * 100)}%\n`;
                });

                requestAnimationFrame(detect);
            }

            detect();
        }
    });
</script>
@endpush

@endsection