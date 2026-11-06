<div class="hstack align-items-start justify-content-center justify-content-sm-start text-center text-sm-start gap-4 flex-wrap flex-sm-nowrap">
    <div class="position-relative w-max">
        <div class="d-flex align-items-center flex-wrap gap-3" data-uploader>
            <div class="avatar-item avatar-xl">
                <img class="img-fluid avatar-xl" alt="avatar image" data-default-src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" data-action="avatar-image">
            </div>

            <div class="file-upload position-absolute end-0 bottom-0">
                <span class="border-3 cursor-pointer border border-white h-30px w-30px rounded-circle bg-success d-flex align-items-center justify-content-center text-white" data-action="choose-file">
                    <i class="ri-camera-fill"></i>
                </span>
                <input class="file-upload-item" type="file" accept="image/*" data-action="file-input">
            </div>
        </div>
    </div>

    <div class="flex-grow-1">
        <div class="vstack gap-5 flex-sm-row mb-5 justify-content-center justify-content-sm-start">
            <div class="flex-grow-1">
                <h4 class="mb-2 fs-5 fw-semibold">Pixy Krovasky</h4>
                <ul class="d-flex flex-wrap gap-2 text-muted p-0 mb-0 justify-content-center justify-content-sm-start">
                    <li class="d-flex align-items-center gap-1">
                        <i class="ri-code-s-slash-line"></i>
                        <p class="mb-0">Developer</p>
                    </li>
                    <li class="d-flex align-items-center gap-1">
                        <i class="ri-map-pin-line"></i>
                        <p class="mb-0">New York</p>
                    </li>
                    <li class="d-flex align-items-center gap-1">
                        <i class="ri-calendar-2-line"></i>
                        <p class="mb-0">Joined March 17</p>
                    </li>
                </ul>
            </div>
            <div class="hstack justify-content-center justify-content-sm-start gap-2 flex-shrink-0">
                <button type="button" class="btn btn-outline-primary custom-toggle" aria-pressed="false">
                    <span class="icon-on">Unfollow</span>
                    <span class="icon-off">Follow</span>
                </button>
                <button type="button" class="btn btn-light text-muted d-inline-block">Hire Me</button>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-4 justify-content-center justify-content-sm-start">
            <div class="d-flex gap-3 align-items-center justify-content-center justify-content-sm-start flex-wrap text-center flex-grow-1">
                <div class="border border-dashed rounded p-3 min-w-176px">
                    <h5 class="fw-semibold text-primary fs-20 mb-1" data-target="75" data-duration="5">75</h5>
                    <p class="text-muted mb-0 fw-medium">Projects</p>
                </div>
                <div class="border border-dashed rounded p-3 min-w-176px">
                    <h5 class="fw-semibold text-success fs-20 mb-1" data-target="68" data-duration="5" data-suffix="%">68%</h5>
                    <p class="text-muted mb-0 fw-medium">Success Rate</p>
                </div>
                <div class="border border-dashed rounded p-3 min-w-176px">
                    <h5 class="fw-semibold text-info fs-20 mb-1" data-target="8620" data-duration="5" data-suffix="$">$8620</h5>
                    <p class="text-muted mb-0 fw-medium">Earning</p>
                </div>
            </div>
            <div class="d-flex align-items-center w-200px w-sm-300px flex-column my-2">
                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                    <span class="fw-semibold fs-6">Profile Compleation</span>
                    <span class="fw-bold fs-6">50%</span>
                </div>

                <div class="progress h-6px mx-3 w-100" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success w-50"></div>
                </div>
            </div>
        </div>

    </div>
</div>
