<template>
    <!-- The Modal -->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Login to Your Account</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Enter Username" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                    </div>

                    <div class="form-group">
                        <button type="submit">Login</button>
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <router-link :to="{ name: 'register' }" data-dismiss="modal" >Register</router-link> - <a href="#">Forgot Password</a>
                </div>

            </div>
        </div>
    </div>
</template>
