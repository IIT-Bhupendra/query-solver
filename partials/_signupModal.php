<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up for an iDiscuss account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/partials/_handlesignup.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="last name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="20"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="20"
                            placeholder="Confirm Password">
                        <small id="emailHelp" class="form-text text-muted">Be sure to enter same passwords.</small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3"
                            aria-describedby="invalidCheck3Feedback" required>
                        <label class="form-check-label" for="invalidCheck3">
                            Agree to terms and conditions
                        </label>
                        <div id="invalidCheck3Feedback" class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Sign Up</button>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </form>
        </div>
    </div>
</div>