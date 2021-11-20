<?php
// エラーを出力する
ini_set('display_errors', "On");

require_once './dbc.php';
$files = getAllFile();
?>

<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- オリジナルCSS -->
    <link rel="stylesheet" href="./css/style.css">

    <title>wan.chibi</title>
</head>

<body>
    <!-- ■ ヘッダーエリア -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="images/logo2.png" id="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <!-- ■ カルーセルエリア -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item carousel-item-ex active">
                <img src="images/title.png" class="d-block w-100 img-fluid" alt="写真">
            </div>
            <div class="carousel-item carousel-item-ex">
                <img src="images/concept1.png" class="d-block w-100 img-fluid" alt="concept1">
            </div>
            <div class="carousel-item carousel-item-ex">
                <img src="images/concept2.png" class="d-block w-100 img-fluid" alt="concept2">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <!-- ■ 投稿エリア -->
    <!-- TODO: uyload.php のコードを参考に画像とテキストの入力フォームを作成する -->
    <section class="section">
        <div class="container">
            <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
                <div class="mb-3">
                    <!-- <label for="exampleFormControlInput1" class="form-label">名前</label>
                    <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="名前"> -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                    <input name="img" type="file" accept="image/*" />
                </div>
                <div class="mb-3">
                    <h6>お名前</h6>
                    <textarea name="caption" placeholder="お名前（ニックネーム）" id="caption"></textarea>
                </div>
                <div class="mb-3">
                    <h6>ひとことメッセージ</h6>
                    <textarea name="caption" placeholder="メッセージ（140文字以下）" id="caption"></textarea>
                </div>
                <div class="mb-3">
                    <h6></h6>
                    <textarea name="caption" placeholder="メッセージ（140文字以下）" id="caption"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">投稿する</button>
                <!-- <input type="submit" value="送信" class="btn" /> -->
            </form>
        </div>
    </section>

    <!-- ■ 投稿一覧エリア -->
    <section class="section">
        <div class="container">
            <!-- TODO: データベース取得した投稿件数でループ -->
            <?php foreach ($files as $file): ?>

            <!-- Media object -->
            <div class="d-flex">
                <!-- 投稿画像 -->
                <!-- TODO: データベース取得した画像パスに修正 -->
                <img src="<?php echo "{$file['file_path']}"; ?>" alt="John Doe" class="me-3 rounded-circle"
                    style="width: 60px; height: 60px;" />
                <!-- タイトル＆本文 -->
                <div>
                    <!-- <h5 class="fw-bold">
                        ワンちゃんに癒やされた一日。。。（投稿タイトル）
                        <small class="text-muted">2021-10-03</small>
                    </h5> -->
                    <h5>田中太郎</h5>
                    <p>
                        <?php echo h("{$file['caption']}"); ?>
                    </p>
                </div>
            </div>

            <?php endforeach;?>
        </div>
    </section>

    <!-- ■ フッターエリア -->
    <footer>
        <div class="container">
            <p class="text-center">© 2021 Copyright: アニマルAPP</p>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>