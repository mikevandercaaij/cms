<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class='text-center'>Id</th>
                                    <th class='text-center'>Author</th>
                                    <th class='text-center'>Comment</th>
                                    <th class='text-center'>Email</th>
                                    <th class='text-center'>Status</th>
                                    <th class='text-center'>In Response to</th>
                                    <th class='text-center'>Date</th>
                                    <th class='text-center'>Approve</th>
                                    <th class='text-center'>Unapprove</th>
                                    <th class='text-center'>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php findAllComments(); ?>
                            <?php deleteComment(); ?>
                            <?php approveComment(); ?>
                            <?php unapproveComment(); ?>

                            </tbody>
                        </table>
