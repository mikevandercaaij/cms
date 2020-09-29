<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class='text-center'>Id</th>
                                    <th class='text-center'>Username</th>
                                    <th class='text-center'>Firstname</th>
                                    <th class='text-center'>Lastname</th>
                                    <th class='text-center'>Email</th>
                                    <th class='text-center'>Role</th>
                                    <th class='text-center'>Make User Admin</th>
                                    <th class='text-center'>Make User Subscriber</th>
                                    <th class='text-center'>Edit</th>
                                    <th class='text-center'>Delete</th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                            <?php findAllUsers(); ?>
                            <?php deleteUsers(); ?>
                            <?php makeUserAdmin(); ?>
                            <?php makeUserSub(); ?>
                            </tbody>
                        </table>
