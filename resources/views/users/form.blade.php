<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">User Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <a href="{{ route('users-list') }}" class="text-success">
                        <span><img class="mr-2" src="../assets/images/logo-icon.png" alt="" height="18"></span>
                    </a>
                </div>

                <form class="pl-3 pr-3" action="#" id="user_form">
                    <input type="hidden" id="user_id" name="user_id">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="user_id" id="user_id_ed">
                        <div class="form-group col-md-6">
                            <label for="username">Name</label>
                            <input class="form-control" type="text" id="name"
                                   required="" name="name" placeholder="Michael Zenaty">
                            <span class="text-danger" id="name_error"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="surname">Surname</label>
                            <input class="form-control" type="text" id="surname"
                                   required="" name="surname" placeholder="Enter Surname">
                            <span class="text-danger" id="surname_error"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="id">South African Id Number</label>
                            <input class="form-control" type="number" required=""
                                   id="south_african_id" name="south_african_id"
                                   placeholder="Enter South African Id Number">
                            <span class="text-danger" id="south_african_id_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Mobile Number</label>
                            <input class="form-control" type="text" required=""
                                   id="mobile_number" name="mobile_number" placeholder="Enter your mobile no">
                            <span class="text-danger" id="mobile_number_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Address</label>
                            <input class="form-control" type="email" required=""
                                   id="email" name="email" placeholder="Enter your email">
                            <span class="text-danger" id="email_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Birth Date</label>
                            <input class="form-control" type="date" required=""
                                   id="dob" name="dob">
                            <span class="text-danger" id="dob_error"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="language">Select Language</label>
                            <select class="form-control" aria-label="Default select example" name="language"
                                    id="lang">
                                <option selected value="">Select Language</option>
                                <option value="English">English</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Arabic">Arabic</option>
                                <option value="Mandarin">Mandarin</option>
                            </select>
                            <span class="text-danger" id="language_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="interest">Interests </label>
                            <input class="form-control" type="text" data-role="tagsinput" name="interests"
                                   id="interests" placeholder="Enter your interest" required>
                            <span class="text-danger" id="interests_error"></span>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                        data-dismiss="modal" id="close">Close
                </button>
                <button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
            </div>
        </div>
    </div>
</div>
