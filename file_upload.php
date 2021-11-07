<!doctype html>
<html lang="ja">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-3">

        <?php
//①ファイルの保存
//②DB接続
//③DBへの保存

require_once './dbc.php';

//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']); //1ファイルの保存
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'images/'; //アップロード先のファイルパスを決める
$save_filename = date('YmdHis') . $filename; //ファイル名を変えてあげる
$err_msgs = array();
$save_path = $upload_dir . $save_filename;

// ===== デバッグコード =====
// echo '$file =>';
// echo $file;
// echo '<br>';

// echo '$filename =>';
// echo $filename;
// echo '<br>';

// echo '$tmp_path =>';
// echo $tmp_path;
// echo '<br>';

// echo '$file_err =>';
// echo $file_err;
// echo '<br>';

// echo '$filesize =>';
// echo $filesize;
// echo '<br>';

// echo '$upload_dir =>';
// echo $upload_dir;
// echo '<br>';

// echo '$save_filename =>';
// echo $save_filename;
// echo '<br>';

// echo '$save_path =>';
// echo $save_path;
// echo '<br>';
// ===== デバッグコード =====

//お名前を取得
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

//キャプション（一言メッセージ）を取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

//お名前のバリデーション
//未入力かどうか調べる
if (empty($name)) {
    array_push($err_msgs, 'お名前を入力してください。');
}
//60字以内か
if (strlen($name) > 60) {
    array_push($err_msgs, 'お名前は60字以内で入力してください。');
}

//キャプションのバリデーション
//未入力かどうか調べる
if (empty($caption)) {
    array_push($err_msgs, 'キャプションを入力してください。');
}
//140字以内か
if (strlen($caption) > 140) {
    array_push($err_msgs, 'キャプションは140字以内で入力してください。');
}

//ファイルのバリデーション
//ファイルサイズが1MB未満か
if ($filesize > 1097152 || $file_err == 2) {
    array_push($err_msgs, 'ファイルサイズは2MB未満にしてください。');
}

//拡張子は画像形式か
$arrow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $arrow_ext)) {
    array_push($err_msgs, '画像ファイルを添付してください。');
}

//もし$err_msgsの配列に何も値が入ってなかったら、0だった場合ファイルを保存する処理を使う
if (count($err_msgs) === 0) {
    //ファイルはあるかどうか
    if (is_uploaded_file($tmp_path)) {
        if (move_uploaded_file($tmp_path, $save_path)) {
            echo $filename . 'を' . $upload_dir . 'アップしました。';
            //DBに保存（ファイル名、ファイルパス、キャプション)
            $result = fileSave($filename, $save_path, $name, $caption);

            if ($result) {
                echo 'データベースに保存しました。';
                // リダイレクト
                header("Location: ./#post-list");
            } else {
                echo 'データベースへの保存が失敗しました。';
            }
        } else {
            echo 'ファイルが保存できませんでした。';
        }
    } else {
        echo 'ファイルが選択されていません。';
        echo '<br>';
    }
} else {
    foreach ($err_msgs as $msg) {
        echo '<div class="alert alert-danger" role="alert">';
        echo $msg;
        echo '</div>';
    }
}

?>

        <a class="btn btn-primary" href="./#post-area" role="button">戻る</a>
    </div>
    <!-- /.container -->

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