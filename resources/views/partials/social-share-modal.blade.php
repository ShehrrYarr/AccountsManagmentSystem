<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share on social network</h5>
                <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-large-line fw-semibold"></i></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">To reach the highest traffic view, share this product</p>

                <!-- Share Buttons -->
                <div class="d-flex flex-wrap justify-content-center gap-4 mb-4">
                    <button class="btn btn-facebook share-button"><i class="ri-facebook-line fs-4"></i></button>
                    <button class="btn btn-twitter share-button"><i class="ri-twitter-line fs-4"></i></button>
                    <button class="btn btn-whatsapp share-button"><i class="ri-whatsapp-line fs-4"></i></button>
                    <button class="btn btn-linkedin share-button"><i class="ri-linkedin-line fs-4"></i></button>
                </div>

                <p class="text-muted">or copy the link</p>

                <!-- Copy Link Input -->
                <div class="input-group">
                    <input type="text" class="form-control" id="shareLink" value="" readonly>
                    <button class="btn btn-outline-primary" id="copyButton" type="button"><i class="ri-clipboard-line fs-5"></i> Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>
