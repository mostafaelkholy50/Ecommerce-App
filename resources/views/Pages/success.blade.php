<x-app-layout>
    <div class="container text-center mt-5 mb-5" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
        <!-- Success Message -->
        <div class="alert alert-success py-5">
            <h1 class="display-1">
                <i class="bi bi-check-circle-fill"></i>
            </h1>
            <h2>Payment Successful!</h2>
            <p>Click the button below to view your order.</p>
            <!-- Button to trigger audio, counter and redirect -->
            <button id="play-sound-btn" class="btn btn-primary mt-3">
                View Order
            </button>
            <!-- Element to display the countdown -->
            <p id="countdown-text" class="mt-3"></p>
        </div>

        <!-- Audio Element -->
        <audio id="notification-sound" src="{{ asset('assets/img/صوت.mp3') }}"></audio>
    </div>

    <!-- JavaScript to play audio, show counter and redirect after 4 seconds -->
    <script>
        document.getElementById('play-sound-btn').addEventListener('click', function() {
            let audio = document.getElementById('notification-sound');
            audio.play().catch(function(error) {
                console.log("Audio play was prevented:", error);
            });
            // Disable the button to prevent multiple clicks
            this.disabled = true;

            // Start a 4-second countdown
            let counter = 4;
            const countdownText = document.getElementById('countdown-text');
            countdownText.textContent = "Redirecting in " + counter + " seconds...";

            const interval = setInterval(function() {
                counter--;
                countdownText.textContent = "Redirecting in " + counter + " seconds...";
                if (counter <= 0) {
                    clearInterval(interval);
                    window.location.href = "{{ route('user.order') }}";
                }
            }, 1000);
        });
    </script>
</x-app-layout>
