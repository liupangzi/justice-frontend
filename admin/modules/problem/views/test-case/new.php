<input type="hidden" id="problem_id" value="<?= /** @var integer $problem_id */ $problem_id ?>">
<div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <span class="heading">Main</span>
        <ul class="list-unstyled">
            <li>
                <a href="/"> <i class="fa fa-tachometer"></i>Dashboard</a>
            </li>
        </ul>
        <span class="heading">Management</span>
        <ul class="list-unstyled">
            <li>
                <a href="/user"> <i class="fa fa-user-circle"></i>User</a>
            </li>
            <li class="active">
                <a href="/problem"> <i class="fa fa-question-circle"></i>Problem</a>
            </li>
            <li>
                <a href="/tag"> <i class="fa fa-tags"></i>Tag</a>
            </li>
        </ul>
    </nav>
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Add test case</h2>
            </div>
        </div>
        <section class="no-padding-top no-padding-bottom">
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-body">
                        <div class="row">
                            <div class="col">
                                <label for="input">Input</label>
                                <textarea class="form-control" rows="20" id="input"></textarea>
                            </div>
                            <div class="col">
                                <label for="output">Output</label>
                                <textarea class="form-control" rows="20" id="output"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="no-padding-top padding-bottom-sm">
            <div class="col-lg-12">
                <button class="btn btn-primary" id="submit">Add Test Case</button>
            </div>
        </section>
        <div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <input type="hidden" id="confirm">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="error_message"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom"><script>document.write((new Date()).getFullYear() + "");</script> &copy; Justice PLUS. Design by <a href="https://bootstrapious.com">Bootstrapious</a>.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#submit').on('click', function (event) {
            event.preventDefault();

            var input = $('#input').val(),
                output = $('#output').val(),
                problem_id = $('#problem_id').val(),
                error_message = $('#error_message'),
                error = $('#error');

            if (input.length === 0 || output.length === 0) {
                error_message.text("Please fill all the blanks");
                error.modal();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/problem/test-case/add',
                data: {
                    problem_id: problem_id,
                    input: input,
                    output: output
                },
                timeout: 3000,
                success: function (res) {
                    if (res.code === 0) {
                        location.href = '/problem/test-case?problem_id=' + problem_id
                    } else {
                        error_message.text(res.message);
                        error.modal();
                    }
                },
                error: function () {
                    error_message.text("An error occurred, please try later.");
                    error.modal();
                }
            });
        });
    });
</script>