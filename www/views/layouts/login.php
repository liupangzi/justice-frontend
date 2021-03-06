<?php use yii\helpers\Html; ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link href="<?= Yii::$app->params['staticFile']['SemanticUI']['css'] ?>" rel="stylesheet">
    <script src="<?= Yii::$app->params['staticFile']['jQuery'] ?>"></script>
    <script src="<?= Yii::$app->params['staticFile']['SemanticUI']['js'] ?>"></script>
    <?= Html::csrfMetaTags() ?>
    <title>Justice PLUS - Login</title>
    <!--suppress CssUnusedSymbol -->
    <style type="text/css">
        body {  background-color: #DADADA;  }
        body > .grid {  height: 100%;  }
        .image {  margin-top: -100px;  }
        .column {  max-width: 450px;  }
    </style>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?= /** @var string $content */ $content ?>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#auth').on('click', function () {
                var email = $('#email'), password = $('#password');
                var modal = $('#modal_content'), s_modal = $('.small.modal');

                if (email.val().length === 0) {
                    modal.text('Please input your email address.');
                    s_modal.modal('show');
                    return;
                }

                if (password.val().length === 0) {
                    modal.text('Please input your password.');
                    s_modal.modal('show');
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: '/login/auth',
                    data: {
                        email: email.val(),
                        password: password.val()
                    },
                    timeout: 3000,
                    success: function (res) {
                        if (res.code === 0) {
                            location.href = '/';
                        } else {
                            modal.text(res.message);
                            s_modal.modal('show');
                        }
                    },
                    error: function () {
                        modal.text("An error occurred. Please login later.");
                        s_modal.modal('show');
                    }
                });
            });
        });
    </script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>