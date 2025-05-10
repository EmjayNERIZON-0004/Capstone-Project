@if(session('success'))
    <div id="success-modal" class="position-fixed top-50 start-50 translate-middle" style="z-index: 1100;">
        <div class="bg-white rounded-3 p-4 text-center" 
             style="border: 1px solid #ccc; width: 300px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
            
            <!-- Close Button -->
            <button type="button" id="close-button" class="btn-close position-absolute top-0 end-0 m-2" aria-label="Close"></button>
            
            <!-- Success Icon -->
            <div class="mb-3">
                <i class="fas fa-check text-success" style="font-size: 48px;"></i>
            </div>
            
            <!-- Success Message -->
            <p class="mb-0" style="font-family: sans-serif; font-size: 14px;">
                {{ session('success') }}
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let modal = document.getElementById("success-modal");
            let closeBtn = document.getElementById("close-button");

            // Close on button click
            closeBtn.addEventListener("click", function() {
                modal.remove();
            });

            // Auto-close after 5 seconds
            setTimeout(function() {
                modal.remove();
            }, 5000);
        });
    </script>
@endif
