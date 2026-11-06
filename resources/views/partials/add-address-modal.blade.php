<!-- Add New Address Modal -->
<div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title">Add New Address</h5>
                    <div class="modal-subtitle text-muted fs-13">Add new address for express delivery</div>
                </div>
                <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-large-line fw-semibold"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewAddressForm" class="row g-5">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressFirstName">First Name</label>
                        <input type="text" id="modalAddressFirstName" name="modalAddressFirstName" class="form-control" placeholder="John">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressLastName">Last Name</label>
                        <input type="text" id="modalAddressLastName" name="modalAddressLastName" class="form-control" placeholder="Doe">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Country</label>
                        <select id="modalAddressCountry" name="modalAddressCountry" class="form-select">
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                        <input type="text" id="modalAddressAddress1" name="modalAddressAddress1" class="form-control" placeholder="12, Business Park">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                        <input type="text" id="modalAddressAddress2" name="modalAddressAddress2" class="form-control" placeholder="Mall Road">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressLandmark">Landmark</label>
                        <input type="text" id="modalAddressLandmark" name="modalAddressLandmark" class="form-control" placeholder="Nr. Hard Rock Cafe">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressCity">City</label>
                        <input type="text" id="modalAddressCity" name="modalAddressCity" class="form-control" placeholder="Los Angeles">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressState">State</label>
                        <input type="text" id="modalAddressState" name="modalAddressState" class="form-control" placeholder="California">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                        <input type="text" id="modalAddressZipCode" name="modalAddressZipCode" class="form-control" placeholder="99950">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add New Address Modal -->
