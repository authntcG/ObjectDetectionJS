@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detect From Video</h5>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3 d-flex align-items-center" style="position: relative; height: 100%;">
                            <video id="videoPlayer" loop muted class="mb-3 img-fluid mx-auto" controls style="max-width: 100%; height: auto;"></video>
                            <canvas id="canvas" class="position-absolute top-0 start-0 end-0 bottom-0 mx-auto" style="max-width: 100%; height: auto;"></canvas>
                        </div>
                        <div class="col-12 mb-3">
                            <h6>Select Video File</h6>
                            <input type="file" class="form-control" id="videoFile" accept="video/*">
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
        const videoPlayer = document.getElementById('videoPlayer');
        const canvas = document.getElementById('canvas');
        const videoFileInput = document.getElementById('videoFile');
        const predictionLog = document.getElementById('predictionLog');

        let currentVideo;

        videoFileInput.addEventListener('change', function () {
            const file = videoFileInput.files[0];
            if (file) {
                if (currentVideo) {
                    currentVideo.pause();
                }

                const videoUrl = URL.createObjectURL(file);
                videoPlayer.src = videoUrl;

                videoPlayer.addEventListener('loadedmetadata', function () {
                    // Set canvas size to match the actual video dimensions
                    const videoWidth = videoPlayer.videoWidth;
                    const videoHeight = videoPlayer.videoHeight;
                    canvas.width = videoWidth;
                    canvas.height = videoHeight;

                    // Load COCO-SSD model
                    cocoSsd.load().then(model => detectObjects(model, videoPlayer));
                });
            }
        });

        function detectObjects(model, video) {
            const context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height);

            video.play();

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